<!DOCTYPE html>
<html lang="en">

<head>

    <title>@yield('title') | Таблетка</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/public/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/public/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="/public/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/public/images/favicon/favicon.ico">

    <link href="/public/frontend/src/css/css2.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/public/frontend/src/vendor/font-awesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="/public/frontend/src/vendor/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="/public/frontend/src/vendor/animate.css/animate.css">
    <link rel="stylesheet" href="/public/frontend/src/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="/public/frontend/src/vendor/slick-carousel/slick/slick.css" />
    <link rel="stylesheet" href="/public/frontend/src/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">

    <link rel="stylesheet" href="/public/frontend/src/css/jquery.growl.css">
    <link rel="stylesheet" href="/public/frontend/src/css/theme.css">
    <link rel="stylesheet" href="/public/frontend/src/css/custom.css">
    @yield('styles')

    <style>
        .preloader {
            position: absolute;
            top: 50%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%)
        }
    </style>
</head>

<body class="">
<div class="preloader">
    <div class="spinner-grow-my text-info" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="main-wrapper d-none">
@include('frontend.inc.header')

@include('frontend.inc.side-bar')


@yield('content')


@include('frontend.inc.footer')
</div>

<!-- ################################################################################################################### -->
<!-- ################################################################################################################### -->
<!-- #############################-----Scripts----------########################################################### -->
<!-- ################################################################################################################### -->
<!-- ################################################################################################################### -->

<script src="/public/frontend/src/vendor/jquery/dist/jquery.min.js"></script>
<script src="/public/frontend/src/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>
<script src="/public/frontend/src/vendor/popper.js/dist/umd/popper.min.js"></script>
<script src="/public/frontend/src/vendor/bootstrap/bootstrap.min.js"></script>
<script src="/public/frontend/src/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="/public/frontend/src/vendor/multilevel-sliding-mobile-menu/dist/jquery.zeynep.js"></script>
<script src="/public/frontend/src/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="/public/frontend/src/vendor/slick-carousel/slick/slick.min.js"></script>

<script src="/public/frontend/src/js/hs.core.js"></script>
<script src="/public/frontend/src/js/components/hs.unfold.js"></script>
<script src="/public/frontend/src/js/components/hs.malihu-scrollbar.js"></script>
<script src="/public/frontend/src/js/components/hs.slick-carousel.js"></script>
<script src="/public/frontend/src/js/components/hs.show-animation.js"></script>
<script src="/public/frontend/src/js/components/hs.selectpicker.js"></script>
<script>
    $(window).load(function() {
        $('.preloader').fadeOut('slow');
        $('.main-wrapper').removeClass('d-none');
    });
</script>

@yield('scripts')


<script src="/public/frontend/src/js/jquery.growl.js"></script>
<script src="/public/frontend/src/js/main.js"></script>

<script>
    $(document).on('ready', function () {
        // initialization of unfold component
        $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

        // initialization of malihu scrollbar
        $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

        // initialization of slick carousel
        $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

        // initialization of show animations
        $.HSCore.components.HSShowAnimation.init('.js-animation-link');

        // init zeynepjs
        var zeynep = $('.zeynep').zeynep({
            onClosed: function () {
                // enable main wrapper element clicks on any its children element
                $("body main").attr("style", "");

                console.log('the side menu is closed.');
            },
            onOpened: function () {
                // disable main wrapper element clicks on any its children element
                $("body main").attr("style", "pointer-events: none;");

                console.log('the side menu is opened.');
            }
        });

        // handle zeynep overlay click
        $(".zeynep-overlay").click(function () {
            zeynep.close();
        });

        // open side menu if the button is clicked
        $(".cat-menu").click(function () {
            if ($("html").hasClass("zeynep-opened")) {
                zeynep.close();
            } else {
                zeynep.open();
            }
        });
    });
</script>

<!-- ################################################################################################################### -->
<!-- ################################################################################################################### -->
<!-- #########################-----END Scripts----------########################################################### -->
<!-- ################################################################################################################### -->
<!-- ################################################################################################################### -->

</body>

</html>
