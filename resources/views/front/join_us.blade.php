@extends('front.layout.master')
@section('title', 'Join Us')
@section('meta')
    <meta name="description"
        content="Join SparkNext and be part of a team that is revolutionizing social media campaigns. Explore career opportunities and contribute to innovative marketing solutions.">
    <meta name="keywords"
        content="SparkNext, careers, join us, social media campaigns, marketing solutions, job opportunities">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection

<style>
    .joinus-section {
        overflow: hidden;
    }
</style>

@section('content')
    <!-- Hero Section -->

    <!-- Hero Section -->
    <section class="joinus-section g-0 m-0 p-0">
        <!-- main join us top circle large image -->
        <div class="join-us-main-image">
            <img src="{{ asset('assets/front_new/images/join-us-bg.png') }}" alt="">
        </div>
        <div class="main-heading">
            <h1>JOIN US</h1>
            <p>On This Journey</p>
        </div>

        <!-- info card glow images -->
        <div class="lighting-glowimage position-relative">
            <img src="{{ asset('assets/front_new/images/info-lighting-glowimage.png') }}" alt="img not found">
        </div>
        <!-- info card small dark glow circle -->
        <div class="info-darkcircle-glowimage position-relative">
            <img src="{{ asset('assets/front_new/images/info-card-darkcircle.png') }}" alt="img not found">
        </div>

        <!-- join us right dark  glow circle glow -->
        <div class="info-leftcircle-glowimage position-relative">
            <img src=" {{ asset('assets/front_new/images/service-right-circle.png') }}" alt="img not found">
        </div>
        <!-- join us right info glow image -->
        <div class="join-rightcircle-glowimage position-relative">
            <img src="{{ asset('assets/front_new/images/join-us-left-glowimage.png') }}" alt="img not found">
        </div>
        <!-- join us  left info glow image -->
        <div class="join-rightcircle-glowimage position-relative">
            <img src="{{ asset('assets/front_new/images/mission-glow-img.png') }}" alt="img not found">
        </div>

        <!-- join us bottom glow image -->
        <div class="join-bottomcircle-glowimage position-relative">
            <img src="{{ asset('assets/front_new/images/info-lighting-glowimage.png') }}" alt="img not found">
        </div>

        <div class="info-box ">
            <p>
                Whether you’re a startup looking to make your mark or an established brand seeking to revitalize
                your social media strategy, Sahalah is here to help you shine. Let’s embark on this exciting journey
                together and redefine what’s possible in social media marketing.
            </p>
            <p class="info-box-second-para">Connect with us today and discover how we can elevate your campaigns to
                new heights!</p>
            <div>
                <button type="button" class="btn join-info-btn primary-btn btn-blue">Log In</button>
                <button type="button" class="btn  btn-dark-outline">Get Started</button>
            </div>
        </div>

        <div class="faq">
            <h2>Frequently Asked Questions</h2>
            <button type="button" class="btn ask-question-btn">Ask Question</button><br>
            <button type="button" class="btn ask-question-btntwo">Ask Question</button>
        </div>

        <!-- monthly and annually cards -->

        <section class="join-us-card">

        </section>
    </section>
@endsection
