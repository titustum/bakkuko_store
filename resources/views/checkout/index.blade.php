<!-- resources/views/checkout/index.blade.php -->

<x-main-layout>
    <div class="relative bg-indigo-900">
        <div class="px-4 py-16 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">Checkout</h1>
        </div>
    </div>

    <div class="px-4 py-4 mx-auto mt-8 max-w-7xl sm:px-6 lg:px-8">
        <div class="flex flex-col">
            @foreach($cartItems as $cartItem)
                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <img src="{{ asset('uploads/' . $cartItem->product->image_url) }}" alt="{{ $cartItem->product->name }}"
                             class="object-cover w-20 h-20 rounded">
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-800">{{ $cartItem->product->name }}</h3>
                            <p class="text-sm text-gray-600">AUD $ {{ number_format($cartItem->product->price, 2) }}</p>
                            <p class="text-sm text-gray-600">Quantity: {{ $cartItem->quantity }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <p class="font-medium text-indigo-600">AUD $ {{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Cart Total -->
        <div class="flex justify-between mt-8 font-semibold">
            <p>Total:</p>
            <p>AUD $ {{ number_format($total, 2) }}</p>
        </div>

        <!-- Stripe Payment Form -->
        <div class="mt-6">
            <form id="payment-form" action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <input type="hidden" name="amount" value="{{ $total * 100 }}">  <!-- Amount in cents -->

                <div id="card-element"></div>
                <button id="submit" class="px-4 py-2 mt-4 text-white bg-indigo-600 rounded hover:bg-indigo-700">Pay Now</button>
            </form>
        </div>
    </div>

    <!-- Stripe JS -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ $stripeKey }}");
        const elements = stripe.elements();
        const cardElement = elements.create("card");
        cardElement.mount("#card-element");

        const form = document.getElementById("payment-form");
        const submitButton = document.getElementById("submit");

        form.addEventListener("submit", async (event) => {
            event.preventDefault();

            // Disable the submit button to prevent multiple clicks
            submitButton.disabled = true;

            // Get the client secret from the backend
            const {clientSecret} = await fetch("{{ route('checkout.process') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    amount: document.querySelector('input[name="amount"]').value,
                }),
            }).then(response => response.json());

            // Use the Stripe.js API to handle the payment
            const {error, paymentIntent} = await stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: "Customer Name",  // Optionally get customer name from form
                    },
                },
            });

            if (error) {
                // Show error message to the user
                alert(error.message);
            } else if (paymentIntent.status === "succeeded") {
                // Payment successful, redirect to a success page
                window.location.href = "/order-success";
            }
        });
    </script>
</x-main-layout>
