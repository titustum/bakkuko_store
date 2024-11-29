<x-main-layout>
    <div class="relative overflow-hidden bg-gradient-to-r from-indigo-900 to-purple-900">
        <div class="relative z-10 px-4 py-16 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl animate-fade-in">
                Contact Us
            </h1>
            <p class="mt-4 text-xl text-indigo-200 animate-fade-in-delay">
                Have questions? We're here to help!
            </p>
        </div>
    </div>

    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 py-8">
        <section class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Contact Info -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-3xl font-semibold text-indigo-600 mb-4">Get in Touch</h2>
                <p class="text-lg text-gray-700 mb-4">
                    Whether you have a question, need assistance with an order, or just want to learn more about BAKKUKO, we are here for you.
                </p>
                <div class="mb-4">
                    <h3 class="text-xl font-semibold text-indigo-600">Email Us</h3>
                    <p class="text-lg text-gray-700">For general inquiries or support, reach out to us at:</p>
                    <a href="mailto:support@bakkuko.com" class="text-indigo-600 hover:text-indigo-700 mt-2 text-lg">
                        support@bakkuko.com
                    </a>
                </div>
                <div class="mb-4">
                    <h3 class="text-xl font-semibold text-indigo-600">Call Us</h3>
                    <p class="text-lg text-gray-700">You can reach us at our customer support number:</p>
                    <a href="tel:+123456789" class="text-indigo-600 hover:text-indigo-700 mt-2 text-lg">
                        +123-456-789
                    </a>
                </div>
                <div class="mb-4">
                    <h3 class="text-xl font-semibold text-indigo-600">Our Address</h3>
                    <p class="text-lg text-gray-700">Visit us at our headquarters:</p>
                    <p class="text-lg text-gray-700">BAKKUKO, 123 African Lane, City, Country</p>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-3xl font-semibold text-indigo-600 mb-4">Send Us a Message</h2>
                <form action="/send-message" method="POST">
                    <div class="grid grid-cols-1 gap-6 mb-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="text-lg font-semibold text-gray-700">Full Name</label>
                            <input type="text" id="name" name="name" required class="mt-2 w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" />
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="text-lg font-semibold text-gray-700">Email Address</label>
                            <input type="email" id="email" name="email" required class="mt-2 w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" />
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="text-lg font-semibold text-gray-700">Message</label>
                            <textarea id="message" name="message" required rows="4" class="mt-2 w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="w-full p-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none">
                        Send Message
                    </button>
                </form>
            </div>
        </section>
    </div>
</x-main-layout>
