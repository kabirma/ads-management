@extends('front.layout.app')

@section('content')
<style>
    .page-banner-section {
        background-image: url({{asset('storage/images/homepage/PhotoO.jpg')}});
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
                            <h2 class="title">Make a Donation</h2>

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

                <div class="col-lg-12">


                    <!-- About Content Start -->
                    <div class="meeta-about-content">
                        Summer Concert Freebies is a labor of love and does not turn a profit from its existence. However, it does take money, alot time and effort to pull the concert information together for all to enjoy. If you would like to make a donation to support the work of Summer Concert Freebies, please contact us at <a style="color:dodgerblue" href="mailto:summerconcertfreebies@gmail.com">summerconcertfreebies@gmail.com</a> and include "Make a Donation" in the subject line. We will respond with details on how to donate. Your generosity would be very much appreciated. All donations are welcomed; no amount is too small. Regardless of whether you choose to donate, if you're reading this we consider you a valuable supporter and for that we thank you!!
<br><br>
                        <b>Wishing you a summer filled with live music.
                        </b>

                    </div>
                    <!-- About Content End -->

                </div>
            </div>

        </div>
    </div>
    <!-- About Section End -->


@endsection