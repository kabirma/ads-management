@extends('front.layout.master')
@section('title', 'Contact Us')
@section('meta')
    <meta name="description"
        content="Get in touch with SparkNext for inquiries, support, or feedback. We are here to assist you with your social media campaign needs.">
    <meta name="keywords" content="SparkNext, contact us, support, inquiries, social media campaigns, feedback">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection

@section('content')

    <!-- Hero Section -->
    <section class="contact-section">
        <div class="contact-hero-bg">
            <!-- background image add through css -->
        </div>
        <p class="contact-title">
            We'd love to hear from you!
        </p>
        <div class="contact-title-parent d-flex justify-content-center">
            <p class="price-subtitle text-center">
                If you have any questions, feedback, or inquiries, please feel free to reach out using the form
                below or through our contact details.
            </p>
        </div>

        <div class="contact-hero-darkcircle position-relative">
            <img src="{{ asset('assets/front_new/images/info-card-darkcircle.png') }}" alt="">
        </div>
    </section>

    <!-- get in touch section -->
    <section class="contact-info-section ">
        <div class="container">
            <div class="row m-0 p-0 justify-content-center g-4">

                <!-- contact card dark circle container -->
                <div class="dark-circle-container position-relative">
                    <img src="{{ asset('assets/front_new/images/contact-card-darkimage.png') }} " class="contact-bottom-img"
                        alt=" image not found">
                    <img src="{{ asset('assets/front_new/images/contact-card-darkimage.png') }}" class="contact-right-img"
                        alt=" image not found">
                    <img src="{{ asset('assets/front_new/images/contact-card-darkimage.png') }}"
                        class="contact-bottom-imgtwo" alt=" image not found">
                    <img src="{{ asset('assets/front_new/images/mission-glow-img.png') }}" class="contact-sect-darkimage"
                        alt="image not found">
                </div>

                <!-- info glowing lighting -->
                <div class="info-glowing-cricle-container position-relative">
                    <img src="{{ asset('assets/front_new/images/info-lighting-glowimage.png') }} "
                        class="info-glowing-large-image" alt="image not found">
                    <img src="{{ asset('assets/front_new/images/info-lighting-glowimage.png') }}"
                        class="info-glowing-firstright" alt="">
                    <img src="{{ asset('assets/front_new/images/contact-right-secondimg.png') }}"
                        class="info-glowing-secondright" alt="">

                </div>


                <!-- Phone -->
                <div class="col-md-6 col-lg-12 d-flex justify-content-center position-relative">
                    <!-- card glow image top -->
                    <div class="contact-card-glowimage position-absolute">
                        <!-- use background image here -->
                    </div>
                    <div class="contact-box gradient-border d-flex align-items-center justify-content-center  py-3">
                        <div class="d-flex align-items-center text-center">
                            <div class="phon-icon">
                                <img src="{{ asset('assets/front_new/images/phone.png') }}" alt="" width="39"
                                    height="39">
                            </div>
                            <div class="ms-3">
                                <small class="d-block">Phone Number</small>
                                <strong class="text-white">+966543652153</strong>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Email -->
                <div class="col-md-6 col-lg-12 d-flex justify-content-center position-relative">
                    <!-- card glow image top -->
                    <div class="contact-card-glowimage position-absolute">
                        <!-- use background image here -->
                    </div>
                    <div class="contact-box gradient-border p-4 d-flex align-items-center justify-content-center px-4 py-3">
                        <div class="d-flex justify-content-center align-items-start">
                            <img src="{{ asset('assets/front_new/images/email.png') }}" alt="" width="39"
                                height="39">
                            <div class="ms-3">
                                <small class="d-block">Email</small>
                                <strong class="text-white">info@sahlah.net</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="col-md-6 col-lg-12 d-flex justify-content-center position-relative">
                    <!-- card glow image top -->
                    <div class="contact-card-glowimage position-absolute">
                        <!-- use background image here -->
                    </div>
                    <div class="contact-box gradient-border p-4 d-flex align-items-center justify-content-center px-4 py-3">
                        <div class="d-flex justify-content-center align-items-start">
                            <img src="{{ asset('assets/front_new/images/location.png') }}" alt="" width="39"
                                height="39">
                            <div class="ms-3">
                                <small class="d-block">Address</small>
                                <strong class="text-white">SA, Dhahran, 2345</strong>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
