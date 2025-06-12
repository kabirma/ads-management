@extends('front.layout.master')
@section('title', 'Join Us')
@section('meta')
    <meta name="description"
        content="Join SparkNext and be part of a team that is revolutionizing social media campaigns. Explore career opportunities and contribute to innovative marketing solutions.">
    <meta name="keywords"
        content="SparkNext, careers, join us, social media campaigns, marketing solutions, job opportunities">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection

@section('content')
    <!-- Hero Section -->
    <!-- Hero Section -->
    <section class="pricing-section" style="margin-top: 70px;">
        <div class="pricing-hero-bg">
            <!-- background image add through css -->
        </div>
        <p class="price-title">
            Our Plans
        </p>
        <div class="pricing-title-parent d-flex justify-content-center">
            <p class="price-subtitle text-center">
                We believe we have created the most efficient SaaS landing page for your users. <br> Landing page
                with
                features that will convince you to use it for your SaaS business.
            </p>
        </div>


        <!-- monthly and annually cards -->

        <section class="annual-card">
            <div class="container py-5">
                <!-- Toggle Tabs -->
                <ul class="nav nav-pills justify-content-center mb-4 pricing-tab" id="pricingTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active primary-btn" id="monthly-tab" data-bs-toggle="pill"
                            data-bs-target="#monthly" type="button" role="tab">Monthly</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link primary-btn" id="annual-tab" data-bs-toggle="pill" data-bs-target="#annual"
                            type="button" role="tab">Annual</button>
                    </li>


                </ul>

                <div class="tab-content mt-5" id="pricingTabContent">
                    <!-- monthly annual card -->
                    <div class="tab-pane fade show active" id="monthly" role="tabpanel">
                        <div class="row text-center justify-content-center g-0" style="margin-top: 100px;">
                            <div class="col-md-4">
                                <div class="card annual-custom-card" id="annual-custom-card">
                                    <h4>FREE</h4>
                                    <div class="price">$0 <small>/mo</small></div>
                                    <span>per month</span>
                                    <hr class="pricing-hr">
                                    <ul class="feature-list">
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }} " alt="">
                                            &nbsp;1 User Account
                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}" alt="">
                                            &nbsp;10 Team Members
                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt="">&nbsp; Unlimited Emails
                                            Accounts

                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt="">&nbsp; Set And Manage
                                            Permissions

                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}" alt="">
                                            &nbsp;API & extension
                                            support

                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}" alt="">
                                            &nbsp;Developer
                                            support
                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}" alt="">
                                            &nbsp;A/B Testing
                                        </li>

                                    </ul>
                                    <div class="singup-parent-btn d-flex justify-content-center">

                                        <button type="button" class="btn btn-custom">Sign Up</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card popular">
                                    <div class="pro-parent-image">
                                        <img src="{{ asset('assets/front_new/images/pro-card-img.png') }}"
                                            class="pro-card-image" alt="image  not found">
                                    </div>

                                    <div class="price">$49 <small>/mo</small></div>
                                    <span>per month</span>
                                    <ul class="feature-list">
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt="">&nbsp; 5 User Account
                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt="">&nbsp; 500 Team Members
                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt="">&nbsp; Unlimited Emails
                                            Accounts</li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt="">&nbsp; Set And Manage
                                            Permissions</li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt="">&nbsp; API & extension
                                            support</li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt="">&nbsp; Developer
                                            support</li>
                                        <li><img src="../assets/images/cross-sign.png" alt="">&nbsp; A/B Testing
                                        </li>
                                    </ul>
                                    <div class="singup-parent-btn d-flex justify-content-center">

                                        <button type="button" class="btn btn-custom">Sign Up</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card  annual-custom-card" id="ultra-card">
                                    <h4>ULTRA</h4>
                                    <div class="price">$99 <small>/mo</small></div>
                                    <span>per month</span>
                                    <hr class="pricing-hr">
                                    <ul class="feature-list">
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}" alt="">
                                            &nbsp;1 User Account
                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}" alt="">
                                            &nbsp;10 Team Members
                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt="">&nbsp; Unlimited Emails
                                            Accounts

                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt="">&nbsp; Set And Manage
                                            Permissions

                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt=""> &nbsp;API &
                                            extension
                                            support

                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt=""> &nbsp;Developer
                                            support
                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt=""> &nbsp;A/B Testing
                                        </li>
                                    </ul>

                                    <div class="singup-parent-btn d-flex justify-content-center">

                                        <button type="button" class="btn btn-custom">Sign Up</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- annual card section -->
                    <div class="tab-pane fade" id="annual" role="tabpanel">
                        <div class="row text-center justify-content-center">
                            <div class="col-md-4">
                                <div class="card annual-custom-card" id="annual-custom-card">
                                    <h4>FREE</h4>
                                    <div class="price">$0 <small>/mo</small></div>
                                    <span>per month</span>
                                    <hr class="pricing-hr">
                                    <ul class="feature-list">
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt=""> &nbsp;1 User Account
                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt=""> &nbsp;10 Team
                                            Members
                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt="">&nbsp; Unlimited
                                            Emails
                                            Accounts

                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt="">&nbsp; Set And Manage
                                            Permissions

                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt=""> &nbsp;API &
                                            extension
                                            support

                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt=""> &nbsp;Developer
                                            support
                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt=""> &nbsp;A/B Testing
                                        </li>

                                    </ul>
                                    <div class="singup-parent-btn d-flex justify-content-center">

                                        <button type="button" class="btn btn-custom">Sign Up</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card popular">
                                    <div class="pro-parent-image">
                                        <img src="../assets/images/pro-card-img.png" class="pro-card-image"
                                            alt="image  not found">
                                    </div>
                                    <div class="price">$499 <small>/yr</small></div>
                                    <span>per month</span>
                                    <ul class="feature-list">
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt="">&nbsp; 5 User Account
                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt="">&nbsp; 500 Team
                                            Members
                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt="">&nbsp; Unlimited
                                            Emails
                                            Accounts</li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt="">&nbsp; Set And Manage
                                            Permissions</li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt="">&nbsp; API &
                                            extension
                                            support</li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt="">&nbsp; Developer
                                            support</li>
                                        <li><img src="../assets/images/cross-sign.png" alt="">&nbsp; A/B Testing
                                        </li>
                                    </ul>
                                    <div class="singup-parent-btn d-flex justify-content-center">

                                        <button type="button" class="btn btn-custom">Sign Up</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card  annual-custom-card" id="ultra-card">
                                    <h4>ULTRA</h4>
                                    <div class="price">$99 <small>/mo</small></div>
                                    <span>per month</span>
                                    <hr class="pricing-hr">
                                    <ul class="feature-list">
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt=""> &nbsp;1 User Account
                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt=""> &nbsp;10 Team
                                            Members
                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt="">&nbsp; Unlimited
                                            Emails
                                            Accounts

                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt="">&nbsp; Set And Manage
                                            Permissions

                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt=""> &nbsp;API &
                                            extension
                                            support

                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt=""> &nbsp;Developer
                                            support
                                        </li>
                                        <li><img src="{{ asset('assets/front_new/images/tick-sign.png') }}"
                                                alt=""> &nbsp;A/B Testing
                                        </li>
                                    </ul>

                                    <div class="singup-parent-btn d-flex justify-content-center">

                                        <button type="button" class="btn btn-custom">Sign Up</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>



    </section>



@endsection
