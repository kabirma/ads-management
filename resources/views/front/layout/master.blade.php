<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    @yield('meta')
    <title>@yield('title', 'Home')</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" /> --}}
    <link href="{{ asset('assets/admin/bootstrap/css/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />


    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- custom css file -->
    <link rel="stylesheet" href="{{ asset('assets/front_new/css/uistyle.css') }}">

    <!-- media queries css -->
    <link rel="stylesheet" href="{{ asset('assets/front_new/css/media-queries.css') }}">

</head>

<body>

    <section class="home-section">
        <div class="container">
            <div class="row">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg fixed-top">
                    <div class="container">
                        <a class="navbar-brand" href="#">
                            <img src="{{ asset('assets/front_new/images/main-logo.svg') }}" alt="Logo"
                                class="nav-main-logo">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('index') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('about') }}">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pricing') }}">Pricing</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('join_us') }}">Join Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="get-started-btn primary-btn">Get Started <img
                                            src="{{ asset('assets/front_new/images/getstarted-btn-arrow.png') }}"
                                            alt="">
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Hero Section -->

        @yield('content')
        <!-- footer -->
        <section class="footer-section p-3">
            <div class="container footer-container">
                <div class="row">
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="footer-header">
                            <div class="footer-logo mb-3">
                                <img src="{{ asset('assets/front_new/images/main-logo.svg') }}" alt="">
                            </div>
                            <div class="footer-description">
                                <p>Manage all your ads platform form a single portal.
                                    Copyright © 2025 Sahllah.All Rights Reserved.</p>
                            </div>
                            <div class="footer-icons d-flex g-5">
                                <a href=""><img src="{{ asset('assets/front_new/images/footer-ink-icon.png') }}"
                                        alt=""></a>
                                <a href=""><img src=" {{ asset('assets/front_new/images/footer-fb-icon.png') }}"
                                        alt=""></a>
                                <a href=""><img
                                        src=" {{ asset('assets/front_new/images/twit-footer-icon.png') }}"
                                        alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="links-header">
                            <h6>Useful links</h6>
                        </div>
                        <div class="page-quick-links">
                            <ul>
                                <li><a href="">Home</a></li>
                                <li><a href="">ABout Us</a></li>
                                <li><a href="">Pricing</a></li>
                                <li><a href="">Join Us</a></li>
                                <li><a href="">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="links-header">
                            <h6 class="ms-5">Support</h6>
                        </div>
                        <div class="support-head">
                            <ul>
                                <li><a href="">Privacy and Policy</a></li>
                                <li><a href="">Terms and conditions</a></li>
                            </ul>
                        </div>

                    </div>
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="links-header">
                            <h6>Get In Touch</h6>
                        </div>
                        <div class="get-touch">
                            <ul>
                                <li><a href="">+966543652153
                                    </a></li>
                                <li><a href="">info@sahllah.net</a></li>
                                <li><a href=""> SA , Dahrahn , 2345</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>







    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function setActive(clickedCard) {
            const allCards = document.querySelectorAll('.service-card');
            allCards.forEach(card => card.classList.remove('active'));
            clickedCard.classList.add('active');
        }
    </script>
</body>

</html>
