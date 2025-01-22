@extends('front.layout.app')

@section('content')
<style>
    .page-banner-section {
        background-image: url({{asset('storage/images/homepage/PhotoC.webp')}});
    }
</style>

<!-- Page Banner Start -->
<div class="section page-banner-section">
    <div class="shape-2"></div>
    <div class="container">
        <div class="page-banner-wrap">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Banner Content Start -->
                    <div class="page-banner text-center">
                        <h2 class="title">{{ $event->title }}</h2>
                    </div>
                    <!-- Page Banner Content End -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Banner End -->

<!-- Event Single Start -->
<div class="meeta-event-single section-padding">
    <div class="container">
        <div class="meeta-event-single-wrap">
            <div class="row">

                <div class="col-lg-8">
                    <!-- Event Single Content Start -->
                    <div class="event-single-content">
                        <!-- Video Start -->
                        <div class="meeta-video-section-2">
                            <img src="{{ asset($event->image) }}" alt="{{ $event->title }}">
                        </div>
                        <!-- Video End -->
                        <p>
                            <?= $event->description ?>
                        </p>

                    </div>
                    <!-- Event Single Content End -->
                </div>
                <div class="col-lg-4">
                    <!-- Event Single Sidebar Start -->
                    <div class="event-single-sidebar">
                        <div class="sidebar-item">

                            <div class="event-details">
                                <h3 class="sidebar-title">Details</h3>
                                <ul>
                                    <li>
                                        <h5 class="title">Start:</h5>
                                        <p>{{ date('F d', strtotime($event->date)) }} @
                                            {{ date('h:i A', strtotime($event->start_time)) }}
                                        </p>
                                    </li>
                                    {{-- <li>--}}
                                        {{-- <h5 class="title">End:</h5>--}}
                                        {{-- <p>{{ date('F d', strtotime($event->date)) }} @--}}
                                            {{-- {{ date('h:i A', strtotime($event->end_time)) }}</p>--}}
                                        {{-- </li>--}}
                                    <li>
                                        <h5 class="title">Location :</h5>
                                        <p>{{ $event->location }}</p>
                                    </li>
                                </ul>
                                <br>
                                @if (Session::has('success'))
                                    <div class="alert alert-success text-center">
                                        <i class="fa fa-check"></i> {{ Session::get('success') }}
                                    </div>
                                @endif

                                @if (!$interested)
                                    @if (Auth::guard('customer')->check())

                                        <a class="btn-2" href="{{ route('event_interested', $event->id) }}">Add to Favorite</a>
                                    @else
                                        <a class="btn-2" href="{{ route('google_login', $event->id) }}">Add to Favorite</a>
                                    @endif
                                @else
                                    <div class="alert alert-primary text-center">
                                        Event is added as favorite
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="sidebar-item">
                            <div class="event-map">
                                <h3 class="sidebar-title">Location Map</h3>
                                <div class="google-map">
                                    <div id="googleMap" style="width:100%;height:400px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Event Single Sidebar End -->
                </div>
                <div class="col-lg-12">
                    <br>
                    <!-- Gallery Start -->
                    <div class="row g-0">

                        @foreach ($event->galleries as $gallery)
                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                <!-- Single Gallery Start -->
                                <div class="single-gallery">
                                    <div class="gallery-image">
                                        <img src="{{ asset($gallery->image) }}"
                                            style="height: 250px;width:100%;object-fit:cover" alt="Gallery">
                                    </div>
                                    <div class="gallery-content">
                                        <div class="gallery-content-wrap">
                                            <a href="{{ asset($gallery->image) }}" class="gallery-plus image-popup">
                                                <span></span>
                                            </a>
                                            <h4 class="gallery-title"><a href="#">{{ $event->title }}</a></h4>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Gallery End -->
                            </div>
                        @endforeach
                    </div>
                    <!-- Gallery End -->
                </div>
                <div class="col-lg-12">
                    <hr>

                    <h2>Behind the Scenes</h2>
                </div>
                <div class="col-lg-12">
                    <br>
                    <!-- Gallery Start -->
                    <div class="row g-0">

                        @foreach ($event->bts_events as $bts)
                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                <!-- Single Gallery Start -->
                                <div class="single-gallery">
                                    <div class="gallery-image">
                                        <img src="{{ asset($bts->image) }}"
                                            style="height: 250px;width:100%;object-fit:cover" alt="Gallery">
                                    </div>
                                    <div class="gallery-content">
                                        <div class="gallery-content-wrap">
                                            <a href="{{ asset($bts->image) }}" class="gallery-plus image-popup">
                                                <span></span>
                                            </a>
                                            <h4 class="gallery-title"><a href="#">
                                                    <?=  $bts->summary ?>
                                                </a></h4>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Gallery End -->
                            </div>
                        @endforeach
                    </div>
                    <!-- Gallery End -->
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Event Single End -->
@endsection
@section('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDymzR-k83U6xBmrlrTFF2cqYNWysHK0U"></script>
<script>
    let map;

    async function initMap() {
        const position = {
            lat: {{ $event->latitude }},
            lng: {{ $event->longitude }}
            };

        const {
            Map
        } = await google.maps.importLibrary("maps");
        const {
            AdvancedMarkerElement
        } = await google.maps.importLibrary("marker");

        map = new Map(document.getElementById("googleMap"), {
            zoom: 15,
            center: position,
            mapId: "googleMap",
        });

        const marker = new AdvancedMarkerElement({
            map: map,
            position: position,
            title: "{{ $event->title }}",
        });
    }

    initMap();
</script>
@endsection