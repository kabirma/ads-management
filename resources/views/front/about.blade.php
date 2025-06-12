@extends('front.layout.master')
@section('title', 'About Us')
@section('meta')
    <meta name="description"
        content="Learn about SparkNext, a platform dedicated to transforming how brands launch and manage their social media campaigns.">
    <meta name="keywords"
        content="SparkNext, social media campaigns, digital presence, AI-driven marketing, brand empowerment">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="sn-section" style="margin-top: 70px;">
        <div class="about-top-glow-img">
            <img src="{{ asset('assets/front_new/images/about-glow-top-img.png') }}" alt="">
        </div>
        <div class="about-right-glow-img">
            <img src="{{ asset('assets/front_new/images/about-glow-right-img.png') }}" alt="">
        </div>
        <h1 class="sn-title">
            Welcome to <span class="sn-highlight">SparkNext</span>,<br />
            Where Innovation Meets Creativity!
        </h1>
        <p class="sn-subtitle">
            We are a passionate team dedicated to transforming how brands launch and manage
            their social media campaigns. In a world where digital presence is crucial,
            our mission is to empower businesses of all sizes with the tools they need to succeed online.
        </p>

        <div class="sn-venn-container">
            <div class="sn-venn sn-venn1"></div>
            <div class="sn-venn sn-venn2"></div>
            <div class="sn-venn sn-venn3"></div>
            <div class="sn-venn-label sn-label1 mt-3">Social Media <br> Campaigns</div>
            <div class="sn-venn-label sn-label2">Empower <br> Businesses</div>
            <div class="sn-venn-label sn-label3">Digital <br> Presence</div>
        </div>



        <!-- service card section -->
        <section class="about-card-service-section mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-7">
                        <div class="about-service-contents ms-5">
                            <h6 class="vision-hero-title">Our vision</h6>
                            <p class="vision-hero-para">At SparkNext, we envision a future where every brand can harness the
                                power of artificial
                                intelligence to craft compelling and effective social media campaigns. We believe that
                                with the right guidance and technology, anyone can create impactful content that
                                resonates with their audience.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-5">
                        <div class="about-service-img d-flex justify-content-center align-items-start">
                            <img src="{{ asset('assets/front_new/images/about-service-img.png') }}" class="img-fluid"
                                alt="">
                        </div>
                    </div>
                </div>



                <!-- our mission row -->
                <!-- our mission glow image -->
                <div class="glow-wrapper position-relative">
                    <div class="our-mission-glow-img position-relative">
                        <img src="{{ asset('assets/front_new/images/mission-glow-img.png') }}" alt="">
                    </div>
                    <div class="row g-0 m-0 p-0">
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="about-mission-img d-flex justify-content-center align-items-start">
                                <img src="{{ asset('assets/front_new/images/about-mission-img.png') }}" class="img-fluid"
                                    alt="">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="about-mission-contents">
                                <h6 class="mission-hero-title mt-5">Our Mission</h6>
                                <p class="mission-hero-para">At SparkNext, we envision a future where every brand can
                                    harness the power of artificial
                                    intelligence to craft compelling and effective social media campaigns. We believe that
                                    with the right guidance and technology, anyone can create impactful content that
                                    resonates with their audience.</p>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </section>




    </section>


@endsection
