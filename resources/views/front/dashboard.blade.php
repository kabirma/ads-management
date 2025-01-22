@extends('front.layout.app')

@section('content')
    <style>
        .nice-select {
            margin-top: 7%;
            width: 90%;
            border: none;
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
                            <h2 class="title">My Concerts</h2>
                        </div>
                        <!-- Page Banner Content End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner End -->

    <!-- Event List Start -->
    <div class="meeta-event-list section-padding">
        <div class="container">
            <div class="meeta-event-list-wrap">
               
               
                <!-- Event List Content Start -->
                <div class="event-list-content-wrap">
                    <div class="">
                        <div class="" id="grid">
                            <div class="row">
                                @if(count($events))
                                @foreach ($events as $event)
                                <div class="col-lg-4 col-sm-6">
                                    <!-- Event List Item Start -->
                                    <div class="event-list-item">
                                        <div class="event-img">
                                            <a href="{{route("event_detail",$event->id)}}"><img src="{{asset($event->image)}}"
                                                    alt="{{$event->title}}"></a>
                                        </div>
                                        <div class="event-list-content">
                                            <div class="event-price">
                                                <span class="cat">{{$event->genre}}</span>
                                            </div>
                                            <h3 class="title"><a href="{{route("event_detail",$event->id)}}">
                                            {{$event->title}}    
                                            </a></h3>
                                            <div class="meta-data">
                                                <span><i class="fas fa-calendar"></i>{{$event->date}}</span>
                                                <span><i class="fas fa-map-marker-alt"></i> {{Str::substr($event->location, 0, 20) }}...</span>
                                            </div>
                                            <div class="event-desc">
                                                <p>
                                                    <?= Str::substr(strip_tags($event->description),0,120); ?>...
                                                </p>
                                            </div>
                                            <br>
                                            <a class="btn-2" href="{{route("event_detail",$event->id)}}">View Details</a>
                                        </div>
                                    </div>
                                    <!-- Event List Item End -->
                                </div>
                                @endforeach
                                @else
                                <div class="alert alert-danger">No Concerts Found.</div>
                                @endif
                            </div>
                        </div>
                  
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    <!-- Event List End -->
@endsection
