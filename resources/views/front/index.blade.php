@extends('front.layout.master')
@section('title', 'Home')
@section('meta')
    <meta name="description" content="SparkNext - Your all-in-one platform for managing social media ads and campaigns.">
    <meta name="keywords" content="SparkNext, social media management, ad management, TikTok, Snapchat, Google Tools">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection

@section('content')
    <section class="hero-section">
        <div class="hero-overlay"></div>

        <div class="hero-content">

        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="hero-topleft-btn">
                        <button type="button" class="tool-button">
                            <img src="{{ asset('assets/front_new/images/hero-snapchat-btn-logo.png') }} " alt="">
                            Snap
                            Chat</button>
                    </div>
                </div>
                <div class="col-md-3"> </div>

                <div class="col-md-3">
                    <div class="hero-topright-btn">
                        <button type="button" class="tool-button">
                            <img src="{{ asset('assets/front_new/images/google-toolicon.png') }}" alt="">
                            &nbsp;Google
                            Tools</button>
                    </div>
                </div>
            </div>

            <!-- heading row -->
            <div class="row">
                <div class="header-row position-relative">
                    <h6>SparkNext</h6>
                    <div class="hero-top-title text-center d-inline-flex">

                        <p>
                            Manage <span style="color: #38afc3;">all</span>
                            <span style="color: #38afc3;">your</span>
                            <span style="color: #38afc3;">ads</span>
                            <span class="platform-gradient">platform</span> form
                            <br>
                            <span style="color: #1487B3;">a</span>
                            <span style="color: #38afc3;">single</span>
                            <span class="signle-portal"> portal.</span>
                        </p>

                    </div>
                </div>
            </div>

            <div class="row align-items-center ">
                <div class="col-md-6 ">
                    <div class="tittok-tool-main-btn d-flex justify-content-end">
                        <button class="tiktok-tool-button">
                            <img src="{{ asset('assets/front_new/images/tiktok-btn-logo.png') }}" alt=""> TikTok
                            Tool
                        </button>
                    </div>

                </div>
                <div class="col-md-6">
                    <img src="{{ asset('assets/front_new/images/hero-dashboardimg.png') }}" alt="Dashboard Image"
                        class="dashboard-image">
                </div>
            </div>
            <!-- Footer Logo -->
            <div class="logo-icon">
                <img src="{{ asset('assets/front_new/images/Hero-footer-logo.png') }}" alt="Footer Logo"
                    style="width: 72px; height: 75px; margin-top: 30px;">
            </div>

            <!-- Line Art Background -->
            <div class="line-art position-relative">
                <img src="{{ asset('assets/front_new/images/hero-footer-line.png') }}" alt="">
            </div>

        </div>
    </section>

    <!-- service card section -->
    <section class="service-card-section py-5">
        <div class="service-right-circleimg position-relative">
            <img src="{{ asset('assets/front_new/images/service-right-circle.png') }}" alt="img not found">
        </div>
        <div class="services-section container">
            <h2 class="services-title"></h2>



            <div class="row justify-content-center mt-5 p-4">
                <div class="card-heading-row">
                    <p>What We Offer?</p>
                </div>
                <!-- second card glow image -->
                <div class="card-top-lighting-bottom-glow position-relative">
                    <img src="{{ asset('assets/front_new/images/service-cart-top-glow.png') }} " alt="img not found">
                </div>
                <div class="col-md-6 col-lg-4 ">
                    <div class="service-card service-gradient-border" onclick="setActive(this)">
                        <div class="card-icon-glow position-relative">
                            <img src="{{ asset('assets/front_new/images/service-card-left-glow.png') }}"
                                class="card-icon-white-glow" alt="">
                        </div>


                        <img src="{{ asset('assets/front_new/images/insights-card-icon.png') }} " class="mt-4"
                            alt="AI Icon" width="65" height="65" />

                        <h5>AI-Powered Insights</h5>
                        <hr class="w-100 m-0 p-0 border-top mt-4"
                            style="position: relative; left: 0; right: 0; width: 100vw; border: 2px solid #38AFC3 !important;">
                        <p class="service-card-para">Our platform analyzes market trends and audience behavior,
                            helping you tailor your campaigns for maximum impact.</p>
                        <div class="card-seq-no d-flex justify-content-end">
                            <span>01</span>
                        </div>

                    </div>

                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="service-card service-gradient-border" onclick="setActive(this)">
                        <div class="card-icon-glow position-relative">
                            <img src=" {{ asset('assets/front_new/images/card-img-glow.png') }} "
                                class="card-icon-white-glow" alt="">
                        </div>
                        <img src="{{ asset('assets/front_new/images/user-card-icon.png') }} " class="mt-4"
                            alt="Tools Icon" width="65" height="65" />
                        <h5>User-Friendly Tools</h5>
                        <hr class="w-100 m-0 p-0 border-top mt-4"
                            style="position: relative; left: 0; right: 0; width: 100vw; border: 2px solid #38AFC3 !important;">
                        <p class="service-card-para">We provide intuitive tools that make it easy to create,
                            schedule, and manage your social media posts.</p>
                        <div class="card-seq-no d-flex justify-content-end">
                            <span>02</span>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-lg-4">
                    <div class="service-card service-gradient-border " onclick="setActive(this)">
                        <div class="card-icon-glow position-relative">
                            <img src="{{ asset('assets/front_new/images/service-card-left-glow.png') }}"
                                class="card-icon-white-glow" alt="">
                        </div>
                        <img src="{{ asset('assets/front_new/images/supoort-card-icon.png') }}" class="mt-4"
                            alt="Support Icon" width="65" height="65" />
                        <h5>Comprehensive Support</h5>
                        <hr class="w-100 m-0 p-0 border-top mt-4"
                            style="position: relative; left: 0; right: 0; width: 100vw; border: 2px solid #38AFC3 !important;">
                        <p class="service-card-para">
                            Our team of experts is here to guide you every step of the way, ensuring your campaigns
                            are optimized for success.
                        </p>
                        <div class="card-seq-no d-flex justify-content-end">
                            <span>03</span>
                        </div>
                        <div class="third-card-glowimg">
                            <img src="{{ asset('assets/front_new/images/service-card-left-glow.png') }}" alt="">
                        </div>
                    </div>

                </div>



            </div>
            <!-- left corner glow image -->
            <div class="service-left-circleimg position-relative">
                <img src="{{ asset('assets/front_new/images/service-left-circle.png') }} " alt="img not found">
            </div>
            <!--service first card glow image  -->
            <div class="card-lighting-bottom-glow position-relative">
                <img src="{{ asset('assets/front_new/images/card-bottom-lighting-glow.png') }} " alt="img not found">
            </div>

            <button type="button" class="learn-btn primary-btn">Learn more about us</button>
        </div>
    </section>
@endsection
