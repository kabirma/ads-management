@extends('front.layout.app')

@section('content')
    <style>
         .page-banner-section {
                background-image: url({{asset("front/assets/images/PhotoE.jpg")}});
            }
    </style>
    <!-- Page Banner Start -->
    <div class="section page-banner-section">
        <div class="container">
            <div class="page-banner-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Page Banner Content Start -->
                        <div class="page-banner text-center">
                            <h2 class="title">About Us</h2>

                        </div>
                        <!-- Page Banner Content End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner End -->
    <!-- About Section Start -->
    <div class="meeta-about-section section-padding">
        <div class="container">

            <div class="row gy-5 align-items-center">
                <div class="col-lg-6">

                    <!-- About Images Start -->
                    <div class="meeta-about-images">
                        <div class="image">
                            <img src="{{asset($setting->about_image)}}" alt="About">
                        </div>
                    </div>
                    <!-- About Images End -->

                </div>
                <div class="col-lg-6">

                    <!-- Section Title Start -->
                    <div class="meeta-section-title-2 meeta-about-title">
                        <h4 class="sub-title">{{$setting->name}}</h4>
                        <h2 class="main-title"><?= $setting->about_heading ?></h2>
                    </div>
                    <!-- Section Title End -->

                    <!-- About Content Start -->
                    <div class="meeta-about-content">
                        <?= $setting->about_content ?>

                    </div>
                    <!-- About Content End -->

                </div>
            </div>

        </div>
    </div>
    <!-- About Section End -->



@endsection