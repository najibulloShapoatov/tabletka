<!doctype html>
<html class="no-js" lang="en">


<!-- Mirrored from demo.hasthemes.com/adomx-preview/light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 Jan 2020 13:15:54 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Панель управления</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
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


    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/public/assets/css/vendor/bootstrap.min.css">

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="/public/assets/css/vendor/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="/public/assets/css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="/public/assets/css/vendor/themify-icons.css">
    <link rel="stylesheet" href="/public/assets/css/vendor/cryptocurrency-icons.css">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="/public/assets/css/plugins/plugins.css">

    <!-- Helper CSS -->
    <link rel="stylesheet" href="/public/assets/css/helper.css">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="/public/assets/css/style.css">

    <!-- Custom Style CSS Only For Demo Purpose -->
    <link id="cus-style" rel="stylesheet" href="/public/assets/css/style-primary.css">
    <link id="cus-style" rel="stylesheet" href="/public/assets/css/custom.css">
    @yield('styles')

</head>

<body>

<div class="main-wrapper">


    <!-- Header Section Start -->
    <div class="header-section">
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center">

                <!-- Header Logo (Header Left) Start -->
                <div class="header-logo col-auto">
                    <a href="/">
                        <svg width="247" height="62" viewBox="0 0 247 62" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M74.0929 25.708C73.7942 25.708 73.5329 25.6053 73.3089 25.4C73.0849 25.176 72.9729 24.9053 72.9729 24.588C72.9729 24.2707 73.0849 24 73.3089 23.776C73.5329 23.552 73.7942 23.44 74.0929 23.44H84.5089C84.8075 23.44 85.0689 23.552 85.2929 23.776C85.5355 24 85.6569 24.2707 85.6569 24.588C85.6569 24.8867 85.5449 25.148 85.3209 25.372C85.0969 25.596 84.8262 25.708 84.5089 25.708H81.0649C80.8969 25.708 80.8129 25.792 80.8129 25.96V36.488C80.8129 36.8987 80.6635 37.2533 80.3649 37.552C80.0662 37.8507 79.7115 38 79.3009 38C78.8902 38 78.5355 37.8507 78.2369 37.552C77.9382 37.2533 77.7889 36.8987 77.7889 36.488V25.96C77.7889 25.792 77.7049 25.708 77.5369 25.708H74.0929ZM95.7119 30.664C94.1813 30.664 93.0239 30.9253 92.2399 31.448C91.4746 31.952 91.0919 32.6427 91.0919 33.52C91.0919 34.2107 91.2973 34.78 91.7079 35.228C92.1186 35.676 92.6133 35.9 93.1919 35.9C94.4239 35.9 95.4039 35.5173 96.1319 34.752C96.8786 33.968 97.2519 32.904 97.2519 31.56V30.888C97.2519 30.7387 97.1679 30.664 96.9999 30.664H95.7119ZM92.4919 38.28C91.2226 38.28 90.1773 37.8693 89.3559 37.048C88.5533 36.2267 88.1519 35.144 88.1519 33.8C88.1519 32.1573 88.7773 30.888 90.0279 29.992C91.2786 29.0773 93.1733 28.62 95.7119 28.62H96.9999C97.1679 28.62 97.2519 28.536 97.2519 28.368V28.06C97.2519 27.0707 97.0186 26.38 96.5519 25.988C96.0853 25.596 95.2453 25.4 94.0319 25.4C92.9493 25.4 91.6613 25.624 90.1679 26.072C89.8879 26.1653 89.6173 26.128 89.3559 25.96C89.1133 25.7733 88.9919 25.5307 88.9919 25.232C88.9919 24.8587 89.1039 24.5227 89.3279 24.224C89.5519 23.9253 89.8413 23.7387 90.1959 23.664C91.5399 23.328 92.8186 23.16 94.0319 23.16C96.3839 23.16 97.9986 23.58 98.8759 24.42C99.7533 25.26 100.192 26.8 100.192 29.04V36.628C100.192 37.0013 100.052 37.328 99.7719 37.608C99.5106 37.8693 99.1933 38 98.8199 38C98.4466 38 98.1199 37.8693 97.8399 37.608C97.5786 37.328 97.4386 37.0013 97.4199 36.628L97.3919 35.928C97.3919 35.9093 97.3826 35.9 97.3639 35.9C97.3266 35.9 97.3079 35.9093 97.3079 35.928C96.2253 37.496 94.6199 38.28 92.4919 38.28ZM106.742 30.86V31.14C106.742 32.6333 107.097 33.828 107.806 34.724C108.516 35.6013 109.421 36.04 110.522 36.04C111.736 36.04 112.678 35.6107 113.35 34.752C114.022 33.8933 114.358 32.652 114.358 31.028V31V30.972C114.358 29.404 114.013 28.1813 113.322 27.304C112.632 26.408 111.745 25.96 110.662 25.96C109.486 25.96 108.534 26.3987 107.806 27.276C107.097 28.1347 106.742 29.3293 106.742 30.86ZM110.662 38.28C108.497 38.28 106.836 37.636 105.678 36.348C104.521 35.0413 103.942 33.1653 103.942 30.72V24.84C103.942 22.1707 104.596 20.248 105.902 19.072C107.228 17.8773 109.328 17.28 112.202 17.28C113.434 17.28 114.48 17.2333 115.338 17.14C115.637 17.1027 115.898 17.1867 116.122 17.392C116.346 17.5787 116.458 17.8213 116.458 18.12C116.458 18.4373 116.346 18.7267 116.122 18.988C115.917 19.2307 115.656 19.3613 115.338 19.38C114.256 19.4733 113.21 19.52 112.202 19.52C110.112 19.52 108.674 19.8933 107.89 20.64C107.125 21.368 106.742 22.7213 106.742 24.7V25.932C106.742 25.9507 106.752 25.96 106.77 25.96C106.808 25.96 106.826 25.9507 106.826 25.932C107.872 24.4573 109.384 23.72 111.362 23.72C113.005 23.72 114.368 24.3827 115.45 25.708C116.552 27.0333 117.102 28.7973 117.102 31C117.102 33.352 116.542 35.1533 115.422 36.404C114.321 37.6547 112.734 38.28 110.662 38.28ZM120.455 38.168C120.157 38.2053 119.886 38.1213 119.643 37.916C119.419 37.7107 119.307 37.4493 119.307 37.132C119.307 36.8147 119.419 36.5347 119.643 36.292C119.867 36.0493 120.147 35.9 120.483 35.844C121.454 35.6573 122.107 35.1907 122.443 34.444C122.779 33.6973 122.947 32.3627 122.947 30.44V25.036C122.947 24.6067 123.106 24.2333 123.423 23.916C123.741 23.5987 124.114 23.44 124.543 23.44H132.691C133.121 23.44 133.494 23.5987 133.811 23.916C134.129 24.2333 134.287 24.6067 134.287 25.036V36.6C134.287 36.992 134.147 37.328 133.867 37.608C133.606 37.8693 133.279 38 132.887 38C132.495 38 132.159 37.8693 131.879 37.608C131.618 37.328 131.487 36.992 131.487 36.6V25.988C131.487 25.82 131.413 25.736 131.263 25.736H125.915C125.766 25.736 125.691 25.82 125.691 25.988V30.944C125.691 33.4827 125.318 35.2653 124.571 36.292C123.843 37.3 122.471 37.9253 120.455 38.168ZM143.917 25.344C141.789 25.344 140.594 26.604 140.333 29.124C140.295 29.292 140.37 29.376 140.557 29.376H146.829C146.978 29.376 147.053 29.292 147.053 29.124C146.941 26.604 145.895 25.344 143.917 25.344ZM144.617 38.28C142.283 38.28 140.482 37.6453 139.213 36.376C137.962 35.1067 137.337 33.2213 137.337 30.72C137.337 28.2187 137.897 26.3333 139.017 25.064C140.155 23.7947 141.789 23.16 143.917 23.16C147.799 23.16 149.806 25.4373 149.937 29.992C149.955 30.44 149.797 30.8133 149.461 31.112C149.125 31.4107 148.733 31.56 148.285 31.56H140.529C140.379 31.56 140.305 31.6347 140.305 31.784C140.529 34.6587 142.059 36.096 144.897 36.096C145.886 36.096 146.857 35.9373 147.809 35.62C148.089 35.5267 148.35 35.564 148.593 35.732C148.835 35.9 148.957 36.1333 148.957 36.432C148.957 36.7867 148.845 37.104 148.621 37.384C148.397 37.664 148.107 37.8507 147.753 37.944C146.726 38.168 145.681 38.28 144.617 38.28ZM153.417 25.708C153.118 25.708 152.857 25.6053 152.633 25.4C152.409 25.176 152.297 24.9053 152.297 24.588C152.297 24.2707 152.409 24 152.633 23.776C152.857 23.552 153.118 23.44 153.417 23.44H163.833C164.132 23.44 164.393 23.552 164.617 23.776C164.86 24 164.981 24.2707 164.981 24.588C164.981 24.8867 164.869 25.148 164.645 25.372C164.421 25.596 164.15 25.708 163.833 25.708H160.389C160.221 25.708 160.137 25.792 160.137 25.96V36.488C160.137 36.8987 159.988 37.2533 159.689 37.552C159.39 37.8507 159.036 38 158.625 38C158.214 38 157.86 37.8507 157.561 37.552C157.262 37.2533 157.113 36.8987 157.113 36.488V25.96C157.113 25.792 157.029 25.708 156.861 25.708H153.417ZM170.668 37.58C170.388 37.86 170.043 38 169.632 38C169.221 38 168.876 37.86 168.596 37.58C168.316 37.3 168.176 36.9547 168.176 36.544V24.896C168.176 24.4853 168.316 24.14 168.596 23.86C168.876 23.58 169.221 23.44 169.632 23.44C170.043 23.44 170.388 23.58 170.668 23.86C170.967 24.14 171.116 24.4853 171.116 24.896V29.852C171.116 29.8707 171.125 29.88 171.144 29.88L171.2 29.852L176.184 24.588C176.912 23.8227 177.808 23.44 178.872 23.44H179.18C179.479 23.44 179.684 23.58 179.796 23.86C179.927 24.14 179.889 24.3827 179.684 24.588L174.224 30.272C174.131 30.3653 174.131 30.4773 174.224 30.608L179.712 36.824C179.917 37.048 179.955 37.3 179.824 37.58C179.712 37.86 179.497 38 179.18 38H178.872C177.827 38 176.949 37.5987 176.24 36.796L171.2 31.028C171.181 31.0093 171.163 31 171.144 31C171.125 31 171.116 31.0093 171.116 31.028V36.544C171.116 36.9547 170.967 37.3 170.668 37.58ZM189.966 30.664C188.435 30.664 187.278 30.9253 186.494 31.448C185.729 31.952 185.346 32.6427 185.346 33.52C185.346 34.2107 185.551 34.78 185.962 35.228C186.373 35.676 186.867 35.9 187.446 35.9C188.678 35.9 189.658 35.5173 190.386 34.752C191.133 33.968 191.506 32.904 191.506 31.56V30.888C191.506 30.7387 191.422 30.664 191.254 30.664H189.966ZM186.746 38.28C185.477 38.28 184.431 37.8693 183.61 37.048C182.807 36.2267 182.406 35.144 182.406 33.8C182.406 32.1573 183.031 30.888 184.282 29.992C185.533 29.0773 187.427 28.62 189.966 28.62H191.254C191.422 28.62 191.506 28.536 191.506 28.368V28.06C191.506 27.0707 191.273 26.38 190.806 25.988C190.339 25.596 189.499 25.4 188.286 25.4C187.203 25.4 185.915 25.624 184.422 26.072C184.142 26.1653 183.871 26.128 183.61 25.96C183.367 25.7733 183.246 25.5307 183.246 25.232C183.246 24.8587 183.358 24.5227 183.582 24.224C183.806 23.9253 184.095 23.7387 184.45 23.664C185.794 23.328 187.073 23.16 188.286 23.16C190.638 23.16 192.253 23.58 193.13 24.42C194.007 25.26 194.446 26.8 194.446 29.04V36.628C194.446 37.0013 194.306 37.328 194.026 37.608C193.765 37.8693 193.447 38 193.074 38C192.701 38 192.374 37.8693 192.094 37.608C191.833 37.328 191.693 37.0013 191.674 36.628L191.646 35.928C191.646 35.9093 191.637 35.9 191.618 35.9C191.581 35.9 191.562 35.9093 191.562 35.928C190.479 37.496 188.874 38.28 186.746 38.28Z" fill="#009BFD"/>
                            <rect x="20.8438" width="20.2909" height="62" rx="10.1455" fill="#009BFD" fill-opacity="0.7"/>
                            <rect y="41.083" width="20.2909" height="62" rx="10.1455" transform="rotate(-90 0 41.083)" fill="#009BFD" fill-opacity="0.7"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M30.9931 0C25.3899 0 20.8477 4.54227 20.8477 10.1455V30.9376V41.083H30.9732C30.9798 41.083 30.9865 41.083 30.9931 41.083H51.7852C57.3884 41.083 61.9306 36.5408 61.9306 30.9376C61.9306 25.3344 57.3884 20.7921 51.7852 20.7921L41.1386 20.7921V10.1454C41.1386 4.54227 36.5963 0 30.9931 0Z" fill="#009BFD"/>
                        </svg>
                    </a>
                </div><!-- Header Logo (Header Left) End -->

                <!-- Header Right Start -->
                <div class="header-right flex-grow-1 col-auto">
                    <div class="row justify-content-between align-items-center">

                        <!-- Side Header Toggle & Search Start -->
                        <div class="col-auto">
                            <div class="row align-items-center">

                                <!--Side Header Toggle-->
                                <div class="col-auto"><button class="side-header-toggle"><i class="zmdi zmdi-menu"></i></button></div>

                                {{--<!--Header Search-->
                                <div class="col-auto">

                                    <div class="header-search">

                                        <button class="header-search-open d-block d-xl-none"><i class="zmdi zmdi-search"></i></button>

                                        <div class="header-search-form">
                                            <form action="#">
                                                <input type="text" placeholder="Search Here">
                                                <button><i class="zmdi zmdi-search"></i></button>
                                            </form>
                                            <button class="header-search-close d-block d-xl-none"><i class="zmdi zmdi-close"></i></button>
                                        </div>

                                    </div>
                                </div>--}}

                            </div>
                        </div><!-- Side Header Toggle & Search End -->

                        <!-- Header Notifications Area Start -->
                        <div class="col-auto">

                            <ul class="header-notification-area">

                                <!--Language-->{{--
                                <li class="adomx-dropdown position-relative col-auto">
                                    <a class="toggle" href="#"><img class="lang-flag" src="assets/images/flags/flag-1.jpg" alt=""><i class="zmdi zmdi-caret-down drop-arrow"></i></a>

                                    <!-- Dropdown -->
                                    <ul class="adomx-dropdown-menu dropdown-menu-language">
                                        <li><a href="#"><img src="assets/images/flags/flag-1.jpg" alt=""> English</a></li>
                                        <li><a href="#"><img src="assets/images/flags/flag-2.jpg" alt=""> Japanese</a></li>
                                        <li><a href="#"><img src="assets/images/flags/flag-3.jpg" alt=""> Spanish </a></li>
                                        <li><a href="#"><img src="assets/images/flags/flag-4.jpg" alt=""> Germany</a></li>
                                    </ul>

                                </li>

                                <!--Mail-->
                                <li class="adomx-dropdown col-auto">
                                    <a class="toggle" href="#"><i class="zmdi zmdi-email-open"></i><span class="badge"></span></a>

                                    <!-- Dropdown -->
                                    <div class="adomx-dropdown-menu dropdown-menu-mail">
                                        <div class="head">
                                            <h4 class="title">You have 3 new mail.</h4>
                                        </div>
                                        <div class="body custom-scroll">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <div class="image"><img src="assets/images/avatar/avatar-2.jpg" alt=""></div>
                                                        <div class="content">
                                                            <h6>Sub: New Account</h6>
                                                            <p>There are many variations of passages of Lorem Ipsum available. </p>
                                                        </div>
                                                        <span class="reply"><i class="zmdi zmdi-mail-reply"></i></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="image"><img src="assets/images/avatar/avatar-1.jpg" alt=""></div>
                                                        <div class="content">
                                                            <h6>Sub: Mail Support</h6>
                                                            <p>There are many variations of passages of Lorem Ipsum available. </p>
                                                        </div>
                                                        <span class="reply"><i class="zmdi zmdi-mail-reply"></i></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="image"><img src="assets/images/avatar/avatar-2.jpg" alt=""></div>
                                                        <div class="content">
                                                            <h6>Sub: Product inquiry</h6>
                                                            <p>There are many variations of passages of Lorem Ipsum available. </p>
                                                        </div>
                                                        <span class="reply"><i class="zmdi zmdi-mail-reply"></i></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="image"><img src="assets/images/avatar/avatar-1.jpg" alt=""></div>
                                                        <div class="content">
                                                            <h6>Sub: Mail Support</h6>
                                                            <p>There are many variations of passages of Lorem Ipsum available. </p>
                                                        </div>
                                                        <span class="reply"><i class="zmdi zmdi-mail-reply"></i></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </li>

                                <!--Notification-->
                                <li class="adomx-dropdown col-auto">
                                    <a class="toggle" href="#"><i class="zmdi zmdi-notifications"></i><span class="badge"></span></a>

                                    <!-- Dropdown -->
                                    <div class="adomx-dropdown-menu dropdown-menu-notifications">
                                        <div class="head">
                                            <h5 class="title">You have 4 new notification.</h5>
                                        </div>
                                        <div class="body custom-scroll">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <i class="zmdi zmdi-notifications-none"></i>
                                                        <p>There are many variations of pages available.</p>
                                                        <span>11.00 am   Today</span>
                                                    </a>
                                                    <button class="delete"><i class="zmdi zmdi-close-circle-o"></i></button>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="zmdi zmdi-block"></i>
                                                        <p>There are many variations of pages available.</p>
                                                        <span>11.00 am   Today</span>
                                                    </a>
                                                    <button class="delete"><i class="zmdi zmdi-close-circle-o"></i></button>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="zmdi zmdi-info-outline"></i>
                                                        <p>There are many variations of pages available.</p>
                                                        <span>11.00 am   Today</span>
                                                    </a>
                                                    <button class="delete"><i class="zmdi zmdi-close-circle-o"></i></button>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="zmdi zmdi-shield-security"></i>
                                                        <p>There are many variations of pages available.</p>
                                                        <span>11.00 am   Today</span>
                                                    </a>
                                                    <button class="delete"><i class="zmdi zmdi-close-circle-o"></i></button>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="zmdi zmdi-notifications-none"></i>
                                                        <p>There are many variations of pages available.</p>
                                                        <span>11.00 am   Today</span>
                                                    </a>
                                                    <button class="delete"><i class="zmdi zmdi-close-circle-o"></i></button>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="zmdi zmdi-block"></i>
                                                        <p>There are many variations of pages available.</p>
                                                        <span>11.00 am   Today</span>
                                                    </a>
                                                    <button class="delete"><i class="zmdi zmdi-close-circle-o"></i></button>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="zmdi zmdi-info-outline"></i>
                                                        <p>There are many variations of pages available.</p>
                                                        <span>11.00 am   Today</span>
                                                    </a>
                                                    <button class="delete"><i class="zmdi zmdi-close-circle-o"></i></button>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="zmdi zmdi-shield-security"></i>
                                                        <p>There are many variations of pages available.</p>
                                                        <span>11.00 am   Today</span>
                                                    </a>
                                                    <button class="delete"><i class="zmdi zmdi-close-circle-o"></i></button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="footer">
                                            <a href="#" class="view-all">view all</a>
                                        </div>
                                    </div>

                                </li>--}}

                                <!--User-->
                                <li class="adomx-dropdown col-auto">
                                    <a class="toggle" href="#">
                                            <span class="user">
                                        <span class="avatar">
                                            @if($userInfo->image)
                                            <img src="/public/uploads/users/{{ $userInfo->id . '/'. $userInfo->image }}" alt="">
                                            @else
                                                <img src="/public/images/default-avatar.jpg" alt="">
                                            @endif
                                            <span class="status"></span>
                                            </span>
                                            <span class="name">{!! $userInfo->name !!}</span>
                                            </span>
                                    </a>

                                    <!-- Dropdown -->
                                    <div class="adomx-dropdown-menu dropdown-menu-user">
                                        {{--<div class="head">
                                            <h5 class="name"><a href="#">Madison Howard</a></h5>
                                            <a class="mail" href="#">mailnam@mail.com</a>
                                        </div>--}}
                                        <div class="body">
                                            <ul>
                                                <li><a data-id="{{$userInfo->id}}" id="edit_user"><i class="zmdi zmdi-account"></i>Профиль</a></li>
{{--                                                <li><a href="#"><i class="zmdi zmdi-settings"></i>Setting</a></li>--}}
                                                <li><a href="{{ url('/logout') }}"><i class="zmdi zmdi-lock-open"></i>Выход</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                </li>

                            </ul>

                        </div><!-- Header Notifications Area End -->

                    </div>
                </div><!-- Header Right End -->

            </div>
        </div>
    </div><!-- Header Section End -->

@include('includes.side_bar')

   @yield('content')

@include('includes.footer')

</div>

<!-- Modal -->
<div class="modal fade" id="edit_user_modal">
    <div class="modal-dialog modal-lg">
        <div id="edit_user_modal_body" class="modal-content">

        </div>
    </div>
</div>

<!-- JS
============================================ -->

<!-- Global Vendor, plugins & Activation JS -->
<script src="/public/assets/js/vendor/modernizr-3.6.0.min.js"></script>
<script src="/public/assets/js/vendor/jquery-3.3.1.min.js"></script>
<script src="/public/assets/js/vendor/popper.min.js"></script>
<script src="/public/assets/js/vendor/bootstrap.min.js"></script>
<!--Plugins JS-->
<script src="/public/assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="/public/assets/js/plugins/tippy4.min.js.js"></script>
<!--Main JS-->
<script src="/public/assets/js/main.js"></script>
<script src="/public/assets/js/jquery.growl.js"></script>
<script src="/public/assets/js/jquery.slimscroll.min.js"></script>
<script src="/public/assets/js/jquery.app.js"></script>
<script src="/public/assets/js/plugins/summernote/summernote-bs4.min.js"></script>
<script src="/public/assets/js/plugins/toastr/toastr.min.js"></script>
<script src="/public/assets/js/custom.js"></script>
@yield('scripts')


</body>
</html>
