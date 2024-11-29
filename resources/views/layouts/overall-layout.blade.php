<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Meta Keywords -->
    <meta name="keywords" content="African culture, e-commerce, online shopping, clothing, shoes, African heritage, marketplace, African fashion, local sellers, African designs">
    <!-- Meta Author -->
    <meta name="author" content="BAKKUO Team">

     <!-- Meta Description for SEO -->
     <meta name="description" content="BAKKUO is an innovative e-commerce platform promoting African culture. Discover unique clothing and shoes from local sellers.">

     <!-- Open Graph Meta Tags for Social Media Sharing -->
     <meta property="og:title" content="BAKKUO - Your Destination for Unique African Fashion">
     <meta property="og:description" content="Discover exclusive African clothing and shoes from local sellers. Shop now to celebrate African heritage!">
     <meta property="og:image" content="URL_to_an_image_for_OG_preview.jpg">
     <meta property="og:url" content="https://www.bakkuo.com">
     <meta property="og:type" content="website">

     <!-- Twitter Card Meta Tags -->
     <meta name="twitter:card" content="summary_large_image">
     <meta name="twitter:title" content="BAKKUO - Your Destination for Unique African Fashion">
     <meta name="twitter:description" content="Shop the best of African clothing, shoes, and accessories. Celebrate African heritage with exclusive designs.">
     <meta name="twitter:image" content="URL_to_an_image_for_Twitter_preview.jpg">

    <title>
        @if (Route::currentRouteName() == 'welcome')
            BAKKUO - Home Page | Discover Unique African Fashion - Shop Now!
        @elseif (Route::currentRouteName() == 'products.index')
            BAKKUO - Products Page | Exclusive African Clothing & Shoes - Shop Today!
        @elseif (Route::currentRouteName() == 'categories.index')
            BAKKUO - Categories Page | Explore Our Diverse Collection - Shop Now!
        @elseif (Route::currentRouteName() == 'product.show')
            BAKKUO - Product | Buy Unique African Fashion - Limited Time Offer!
        @elseif (Route::currentRouteName() == 'category.show')
            BAKKUO - Product | Discover African Heritage - Shop Now!
        @elseif (Route::currentRouteName() == 'cart.index')
            BAKKUO - Your Cart | Check Out Our Best Deals - Complete Your Purchase!
        @elseif (Route::currentRouteName() == 'checkout.index')
            BAKKUO - Checkout Page | Finalize Your Order - Fast & Secure Checkout!
        @else
            BAKKUO - Your Shopping Destination | Exclusive African Designs - Shop Today!
        @endif
    </title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.bunny.net">
     <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('/favicon.svg') }}" type="image/svg+xml">

    <!-- For browsers that do not support SVG -->
    <link rel="icon" href="https://bakkuo.com/favicon.ico" type="image/x-icon">

     <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Fallback CSS and JS for production -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <script src="{{ mix('js/app.js') }}"></script>
    @endif


</head>
<body class="min-h-screen bg-white">

    {{ $slot }}

</body>
</html>

