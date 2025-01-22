@extends('front.layout.app')

@section('content')
	@php
        $tags = explode(',',$setting->tags);
		$series = explode(',',$setting->series);
	@endphp
    <style>
         .page-banner-section {
                background-image: url({{asset("front/assets/images/PhotoD.jpg")}});
            }
        .nice-select {
            width: 100%;
			height: 37px;
			line-height: 26px;
        }

        .form-group {
            margin-bottom: 2%;
        }
    </style>
    <style>
        #map {
            height: 500px;
        }

        #map2 {
            height: 500px;
        }

        .controls {
            margin-top: 10px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 300px;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        #pac-input2 {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 300px;
        }

        #pac-input2:focus {
            border-color: #4d90fe;
        }

        .pac-container {
            font-family: Roboto;
        }

        #type-selector {
            color: #fff;
            background-color: #4d90fe;
            padding: 5px 11px 0px 11px;
        }

        #type-selector label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }

        #target {
            width: 345px;
        }

        .image_container {
            position: relative;
            text-align: center;
            color: white;
        }

        .image_container img {
            height: 100px;
            width: 100%;
        }

        .top-right {
            position: absolute;
            top: 8px;
            right: 16px;
            color: white;
            border-radius: 50%;
            background-color: #EA5455;
            height: 20px;
            width: 20px;
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
                            <h2 class="title">Create Concerts</h2>
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
                <!-- Event List Top Bar Start -->
                <div class="event-list-top-bar">
                    <div class="row">
                        <div class="col-lg-12">
                            @if (Session::has('success'))
                                <div class="alert alert-success text-center" style="background-color:#fdfd96">
                                    <i class="fa fa-check"></i> {{ Session::get('success') }}
                                </div>
                            @endif

                            @if (Session::has('error'))
                                <div class="alert alert-danger text-center" style="background-color:#fdfd96">
                                    <i class="fa fa-times"></i> {{ Session::get('error') }}
                                </div>
                            @endif
                            <form action="{{ route('event_save') }}" method="post" class="row"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group col-md-12">
                                    <label for="title">Title</label>
                                    <input id="title" name="title" type="text" required class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="genre">Category</label>
									<select id="genre" name="genre" class="form-control">
                                        @foreach($tags as $tag)
											<option value="{{$tag}}">{{$tag}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="genre">Series</label>
                                    <select id="series" name="series" class="form-control">
                                        @foreach($series as $serie)
                                            <option value="{{$serie}}">{{$serie}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date">Date</label>
                                    <input id="date" name="date" type="date" required class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="genre">Start Time</label>
                                    <input id="start_time" name="start_time" type="time" required class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="description">Address</label>
                                    <input type="hidden" class="form-control" id="address" placeholder="Event Address"
                                        name="location">
                                    <input type="hidden" id="longitude" name="longitude">
                                    <input type="hidden" id="latitude" name="latitude">
                                    <input id="pac-input" class="controls" required type="text" placeholder="Search Box">
                                    <div id="map"></div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="ckeditor" class="form-control" cols="30" rows="10"></textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="image">Image</label>
                                    <input id="image" name="image" type="file" class="form-control">

                                </div>

                                <div class="form-group col-md-12">
                                    <label for="image">Gallery</label>
                                    <input id="image" name="gallery[]" type="file" multiple class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <hr>
                                    <button class="btn btn-primary">Create Event</button>
                                </div>
                            </form>
                        </div>


                    </div>

                </div>
                <!-- Event List Top Bar End -->


            </div>
        </div>
    </div>
    <!-- Event List End -->
@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyBDymzR-k83U6xBmrlrTFF2cqYNWysHK0U">
    </script>
    <script>
        CKEDITOR.replace('ckeditor');
    </script>

    <script>
        /* script */
        function initialize() {
            var latlng = new google.maps.LatLng({{ isset($record) ? $record->latitude : '47.087767' }},
                {{ isset($record) ? $record->longitude : '-119.7190647' }});
            var map = new google.maps.Map(document.getElementById('map'), {
                center: latlng,
                zoom: 12
            });
            var marker = new google.maps.Marker({
                map: map,
                position: latlng,
                draggable: true,
                anchorPoint: new google.maps.Point(0, -29)
            });
            var input = document.getElementById('pac-input');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            var geocoder = new google.maps.Geocoder();
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);
            var infowindow = new google.maps.InfoWindow();
            autocomplete.addListener('place_changed', function() {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }

                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
                bindDataToForm(place.formatted_address, place.geometry.location.lat(), place.geometry.location
                    .lng());
                infowindow.setContent(place.formatted_address);
                infowindow.open(map, marker);

            });
            // this function will work on marker move event into map
            google.maps.event.addListener(marker, 'dragend', function() {
                geocoder.geocode({
                    'latLng': marker.getPosition()
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            bindDataToForm(results[0].formatted_address, marker.getPosition().lat(), marker
                                .getPosition().lng());
                            infowindow.setContent(results[0].formatted_address);
                            infowindow.open(map, marker);
                        }
                    }
                });
            });
        }

        function bindDataToForm(address, lat, lng) {
            document.getElementById('address').value = address;
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endsection
