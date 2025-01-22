@extends('front.layout.app')


@section('content')
<style>
    .page-banner-section {
        background-image: url({{asset('storage/images/homepage/PhotoM.jpg')}});
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
                        <h2 class="title">{{$spotlight_events->artist}}</h2>
                    </div>
                    <!-- Page Banner Content End -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Banner End -->

<!-- Speaker Single Start -->
<div class="meeta-speaker-single section-padding">
    <div class="container">
        <div class="meeta-speaker-single-wrap">
            <div class="row">

                <div class="col-lg-4">
                    <!-- Speaker Image Box Start -->
                    <div class="speaker-image-box text-center">
                        <img src="{{asset($spotlight_events->image)}}" alt="">

                    </div>
                    <!-- Speaker Image Box End -->
                    <div class="speaker-single-right" style="padding-left:0px">
                        <!-- Speaker Single Info Start -->
                        <div class="speaker-single-info-wrap">

                            <div class="speaker-info">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="speaker-info-list">
                                            <ul>
                                                <li>
                                                    <p class="title">Date:</p>
                                                    <p>{{date("F d,Y", strtotime($spotlight_events->date))}}</p>
                                                </li>
                                                <li>
                                                    <p class="title">Time:</p>
                                                    <p>{{date("H:i A", strtotime($spotlight_events->time))}}</p>
                                                </li>
                                                <li>
                                                    <p class="title">Address :</p>
                                                    <p>{{$spotlight_events->location}}</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Speaker Single Info End -->

                    </div>
                    <br>

                    <div class="event-map">
                        <div class="google-map">
                            <div id="googleMap" style="width:100%;height:400px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <!-- Speaker Single Right Start -->
                    <div class="speaker-single-right">
                        <!-- Speaker Single Info Start -->
                        <div class="speaker-single-info-wrap">

                            <div class="speaker-biography">
                                <h3 class="main-title">{{$spotlight_events->artist}}</h3>
                                <p>
                                    <?= $spotlight_events->description ?>
                                </p>
                            </div>
                            <div class="speaker-info">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="speaker-info-desc">
                                            <h3 class="main-title">About</h3>
                                            <p>
                                                <?= $spotlight_events->about ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Speaker Single Info End -->

                    </div>
                    <!-- Speaker Single Right End -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Speaker Single End -->

@endsection

@section('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDymzR-k83U6xBmrlrTFF2cqYNWysHK0U"></script>
<script>
    let map;

    async function initMap() {
        const position = {
            lat: {{ $spotlight_events->latitude }},
            lng: {{ $spotlight_events->longitude }}
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
            title: "{{ $spotlight_events->title }}",
        });
    }

    initMap();
</script>
@endsection