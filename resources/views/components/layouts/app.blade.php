<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="robots" content="index, follow" />
    <title>Mioca - Handmade Goods eCommerce HTML Template</title>
    <meta name="description" content="Mioca - Handmade Goods eCommerce HTML Template" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Add site Favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon/favicon.ico" type="image/png">


    {{-- <!-- vendor css (Icon Font) -->
    <link rel="stylesheet" href="/assets/css/vendor/bootstrap.bundle.min.css" />
    <link rel="stylesheet" href="/assets/css/vendor/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="/assets/css/vendor/font.awesome.css" />

    <!-- plugins css (All Plugins Files) -->
    <link rel="stylesheet" href="/assets/css/plugins/animate.css" />
    <link rel="stylesheet" href="/assets/css/plugins/swiper-bundle.min.css" />
    <link rel="stylesheet" href="/assets/css/plugins/jquery-ui.min.css" />
    <link rel="stylesheet" href="/assets/css/plugins/nice-select.css" />
    <link rel="stylesheet" href="/assets/css/plugins/venobox.css" /> --}}

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <link rel="stylesheet" href="/assets/css/vendor/vendor.min.css" />
    <link rel="stylesheet" href="/assets/css/plugins/plugins.min.css" />
    {{-- <link rel="stylesheet" href="/assets/css/style.min.css"> --}}

    <!-- Main Style -->
    <link rel="stylesheet" href="/assets/css/style.css" />

</head>

<body>
    <x-layouts.header></x-layouts.header>
    <div class="offcanvas-overlay"></div>

    <x-wishlist></x-wishlist>
    <x-cart-side-bar></x-cart-side-bar>
    <x-menu></x-menu>

    {{ $slot }}

    <x-layouts.footer></x-layouts.footer>

    <x-search></x-search>

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <script src="/assets/js/vendor/vendor.min.js"></script>
    <script src="/assets/js/plugins/plugins.min.js"></script>

    <!-- Main Js -->
    <script src="/assets/js/main.js"></script>

    @stack('other-scripts')
</body>

</html>
