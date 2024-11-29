<x-main-layout>
    <div class="relative bg-gradient-to-br from-indigo-900 to-purple-900">
        <div class="px-4 py-16 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">Checkout</h1>
        </div>
    </div>

    <div class="px-4 py-4 mx-auto mt-8 max-w-7xl sm:px-6 lg:px-8">
        <div class="flex flex-col">
            @foreach($cartItems as $cartItem)
                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <img src="{{ asset('storage/' . $cartItem->product->image_url) }}" alt="{{ $cartItem->product->name }}"
                             class="object-contain w-20 h-20 rounded">
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

                <div class="my-3 flex items-center space-x-2">
                    <label for="delivery_address">Delivery Address:</label>
                    <input type="text" name="delivery_address" class="flex-grow" placeholder="Enter delivery address">
                </div>

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

            // Fetch the client secret from the backend
            const response = await fetch("{{ route('checkout.process') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    amount: document.querySelector('input[name="amount"]').value, // The amount in cents
                }),
            });

            if (!response.ok) {
                alert('Error: Failed to retrieve client secret');
                submitButton.disabled = false;
                return;
            }

            const { clientSecret } = await response.json();

            // Confirm the payment with Stripe
            const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
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
                submitButton.disabled = false;
            } else if (paymentIntent.status === "succeeded") {
                alert("Successfully paid!!");

                // Send the payment intent ID and amount to the backend to create the order
                fetch("{{ route('checkout.success') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        payment_id: paymentIntent.id,
                        total_amount: document.querySelector('input[name="amount"]').value,  // The total amount from frontend
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data)
                    if (data.order_id) {
                        // Redirect to the success page with the order ID
                        window.location.href = "{{ route('checkout.success') }}?order_id=" + data.order_id;
                    } else {
                        alert("Error: Unable to create order.");
                    }
                })
                .catch(error => {
                    alert("Error: " + error.message);
                    submitButton.disabled = false;
                });
            }
        });
    </script>

</x-main-layout>
