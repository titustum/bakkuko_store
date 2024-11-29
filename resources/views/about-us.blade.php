<x-main-layout>
        <div class="relative overflow-hidden bg-gradient-to-r from-indigo-900 to-purple-900">
            <div class="relative z-10 px-4 py-16 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl animate-fade-in">
                    About BAKKUO
                </h1>
                <p class="mt-4 text-xl text-indigo-200 animate-fade-in-delay">
                    Connecting customers with the richness of African culture through fashion
                </p>
            </div>
        </div>


    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 py-8">

        <!-- Mission Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-semibold text-indigo-600">Our Mission</h2>
            <p class="text-lg text-gray-700 mt-4">
                At BAKKUKO, we aim to bring African culture closer to the world through a unique e-commerce platform that
                showcases traditional and contemporary African clothing and shoes. Our mission is to provide a seamless
                online shopping experience that connects customers with local sellers, celebrating African heritage in every product.
            </p>
        </section>

        <!-- Vision Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-semibold text-indigo-600">Our Vision</h2>
            <p class="text-lg text-gray-700 mt-4">
                We envision a global marketplace where the diversity and richness of African fashion can be experienced
                by people all over the world. We are dedicated to supporting local sellers while making African fashion accessible
                and affordable to a wider audience.
            </p>
        </section>

        <!-- How the Project Came About Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-semibold text-indigo-600">How BAKKUKO Came About</h2>
            <p class="text-lg text-gray-700 mt-4">
                The idea for BAKKUKO was born out of our shared passion for African culture and fashion. We recognized the need for
                a platform that could bridge the gap between local African artisans and global consumers. With a growing demand for
                unique, culturally rich clothing and accessories, we set out to create a marketplace that highlights the beauty of African
                craftsmanship and supports local sellers. Our team came together, driven by a shared vision to bring African heritage
                to the forefront of global fashion, and BAKKUKO was born.
            </p>
        </section>

        <!-- Why Choose Us Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-semibold text-indigo-600">Why Choose BAKKUKO?</h2>
            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-indigo-600">Authenticity</h3>
                    <p class="text-gray-700 mt-4">
                        All our products are sourced directly from local artisans and sellers across Africa, ensuring
                        the authenticity and quality of each item.
                    </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-indigo-600">Seamless Shopping Experience</h3>
                    <p class="text-gray-700 mt-4">
                        With a user-friendly interface, secure payment options, and efficient customer support, shopping at BAKKUKO
                        is a breeze.
                    </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-indigo-600">Support Local Artisans</h3>
                    <p class="text-gray-700 mt-4">
                        By purchasing from BAKKUKO, you're supporting local African artisans and helping preserve cultural heritage.
                    </p>
                </div>
            </div>
        </section>

        <!-- Team Members Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-semibold text-indigo-600">Meet the Team</h2>
            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <img src="https://st2.depositphotos.com/9998432/48435/v/600/depositphotos_484354202-stock-illustration-default-avatar-photo-placeholder-grey.jpg" alt="Team Member 1" class="w-24 h-24 mx-auto rounded-full">
                    <h3 class="text-xl font-bold text-indigo-600 mt-4">Thomas</h3>
                    <p class="text-gray-700 mt-2">Frontend Developer</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <img src="https://st4.depositphotos.com/9998432/23741/v/450/depositphotos_237418842-stock-illustration-person-gray-photo-placeholder-woman.jpg" alt="Team Member 2" class="w-24 h-24 mx-auto rounded-full">
                    <h3 class="text-xl font-bold text-indigo-600 mt-4">Babra</h3>
                    <p class="text-gray-700 mt-2">Backend Developer</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <img src="https://st3.depositphotos.com/9998432/13335/v/600/depositphotos_133351928-stock-illustration-default-placeholder-man-and-woman.jpg" alt="Team Member 3" class="w-24 h-24 mx-auto rounded-full">
                    <h3 class="text-xl font-bold text-indigo-600 mt-4">Kennedy</h3>
                    <p class="text-gray-700 mt-2">Project Manager/Database Manager</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <img src="https://st2.depositphotos.com/9998432/48435/v/600/depositphotos_484354184-stock-illustration-default-avatar-photo-placeholder-grey.jpg" alt="Team Member 4" class="w-24 h-24 mx-auto rounded-full">
                    <h3 class="text-xl font-bold text-indigo-600 mt-4">Oliver</h3>
                    <p class="text-gray-700 mt-2">Project Coordinator/DevOps</p>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="text-center mt-12">
            <p class="text-xl text-gray-800">Join us in celebrating the beauty of African fashion.</p>
            <a href="{{ route('products.index') }}" class="mt-6 inline-block bg-indigo-600 text-white text-lg px-8 py-3 rounded-lg hover:bg-indigo-700">
                Start Shopping
            </a>
        </section>
    </div>
</x-main-layout>
