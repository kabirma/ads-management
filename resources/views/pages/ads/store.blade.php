@extends('layouts.master')

@section('content')
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

        .image_container i{
            height: 100px;
            width: 100%;
        }

        .top-right {
            position: absolute;
            top: 8px;
            right: 16px;
            color:white;
            border-radius: 50%;
            background-color: #EA5455;
            height: 20px;
            width: 20px;
        }

        #imageRadio {
            list-style-type: none;
            text-align:center
        }

        #imageRadio li {
            display: inline-block;
        }

        #imageRadio input[type="radio"][id^="cb"] {
            display: none;
        }

        #imageRadio label {
            border: 1px solid #fff;
            padding: 10px;
            display: block;
            position: relative;
            margin: 10px;
            cursor: pointer;
        }

        #imageRadio label:before {
            background-color: white;
            color: white;
            content: " ";
            display: block;
            border-radius: 50%;
            border: 1px solid grey;
            position: absolute;
            top: -5px;
            left: -5px;
            width: 25px;
            height: 25px;
            text-align: center;
            line-height: 28px;
            transition-duration: 0.4s;
            transform: scale(0);
        }

        #imageRadio label i {
            font-size:75px;
            transition-duration: 0.2s;
            transform-origin: 50% 50%;
        }

        #imageRadio :checked + label {
            border:1px solid #968DF3;
        }

        #imageRadio :checked + label:before {
            content: "✓";
            background-color:#5BBE25;
            transform: scale(1);
        }

        #imageRadio :checked + label i {
            transform: scale(0.9);
            z-index: -1;
            color: #968DF3;
        }

        .important-note {
            border-radius: 8px;
            padding: 20px;
            max-width: 600px;
            margin: 20px auto;
            font-family: Arial, sans-serif;
        }

        .note-header {
            margin-bottom: 15px;
            text-align: center;
        }

        .note-heading {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
            justify-content: center;
        }

        .note-header i {
            font-size:25px;
            color:#e74c3c;
        }

        .note-header h2 {
            color: #555555;
            font-size: 24px;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .note-content{
            background-color: #fdf7eb; /* Light background */
            border: 1px solid #f5c976; /* Border matching light theme */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            border-radius: 8px;
            padding: 10px 20px;
            max-width: 600px;
            margin: 20px auto;
            font-family: Arial, sans-serif;
        }

        .note-content p {
            margin: 10px 0;
            color: #333333;
        }

        .note-content ol {
            margin: 10px 0;
            padding-left: 20px;
            color: #333333;
        }

        .note-content ol li {
            margin: 8px 0;
            font-size: 16px;
            color: #e74c3c; /* Red for emphasis */
            font-weight: bold;
        }

        .note-warning {
            margin-top: 20px;
            font-size: 14px;
            color: #666666;
            text-align: center;
            font-weight: bold;
        }

    </style>
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item active"> <span class="badge badge-light-primary">Edit
                                    {{ $title }}</span>
                            </li>
                        </ol>
                        <a href="{{ route('view.ads') }}" class="btn btn-sm btn-primary waves-effect addnew">
                            <i class="fa fa-list"></i> <span>View {{ $title }}</span>
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            <form action="{{ route('save.ads') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ isset($record) ? $record->id : 0 }}">

                                <div class="row">
                                    <div class="col-md-12 steps" id="step1">
                                        <ul id="imageRadio">
                                            <li><input type="radio" name="test" id="cb1" />
                                                <label for="cb1"> <i class="fab fa-facebook"></i> </label>
                                            </li>
                                            <li><input type="radio" name="test" id="cb2" />
                                                <label for="cb2"><i class="fab fa-tiktok"></i></label>
                                            </li>
                                            <li><input type="radio" name="test" id="cb3" />
                                                <label for="cb3"><i class="fab fa-twitter"></i></label>
                                            </li>
                                            <li><input type="radio" name="test" id="cb4" />
                                                <label for="cb4"><i class="fab fa-google"></i></label>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-md-12 steps" id="step2">
                                        <div class="important-note">
                                            <div class="note-header">
                                                <div class="note-heading">
                                                    <i class="fa fa-bell"></i>
                                                    <h2>IMPORTANT NOTE</h2>
                                                </div>
                                                <p><strong>Content Not Accepted for Ads:</strong></p>
                                            </div>
                                            <div class="note-content">
                                                <ol>
                                                    <li>Promotions of IPTV / Unofficial or Counterfeit Brand</li>
                                                    <li>Offensive / Adult or Pornographic Material</li>
                                                    <li>Illegal Activities / Drugs</li>
                                                    <li>Medicines, fake followers</li>
                                                </ol>
                                            </div>
                                            <p class="note-warning">
                                                    Using any of this ad content may result in your ad being disapproved or your ad account being suspended.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-12 steps" id="step3">
                                        <ul id="imageRadio">
                                            <li><input type="radio" name="test" id="cb5" />
                                                <label for="cb5"> <img src="https://cdn.sweply.com/ui-images/obj-sales.svg" alt="">
                                                    <h4>Website Traffic</h4>
                                                    <p>Get more website visits</p>
                                                </label>
                                            </li>
                                            <li><input type="radio" name="test" id="cb6" />
                                                <label for="cb6"> <img src="https://cdn.sweply.com/ui-images/obj-video-view.svg" alt="">
                                                    <h4>Video Views</h4>
                                                    <p>Increase video views among your target audience</p>
                                                </label>
                                            </li>
                                           
                                        </ul>
                                    </div>

                                </div>



                                <div class="form-group col-md-6">
                                    <label for="title">Title</label>
                                    <input id="title" name="title" value="{{ isset($record) ? $record->title : '' }}"
                                        type="text" required class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="genre">Genre</label>
                                    <select id="genre" name="genre" class="form-control">
                                        @foreach($tags as $tag)
                                        <option value="{{$tag}}" {{ isset($record) && $record->genre == $tag ??   'selected' }}>{{$tag}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date">Date</label>
                                    <input id="date" name="date" value="{{ isset($record) ? $record->date : '' }}"
                                        type="date" required class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="genre">Series</label>
                                    <select id="series" name="series" class="form-control">
                                        <option value="">Select Series</option>
                                        @foreach($series as $tag)
                                            <option value="{{$tag}}" {{ isset($record) && $record->series == $tag ?   'selected' : '' }}>{{$tag}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="genre">Start Time</label>
                                    <input id="start_time" name="start_time"
                                        value="{{ isset($record) ? $record->start_time : '' }}" type="time" required
                                        class="form-control">
                                </div>

                                <div class="form-group col-md-3" style="display: none">
                                    <label for="end_time">End Time</label>
                                    <input id="end_time" name="end_time"
                                        value="{{ isset($record) ? $record->end_time : '' }}" type="time" value="0"
                                        class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="description">Address</label>
                                    <input type="hidden" value="{{ isset($record) ? $record->location : '' }}"
                                        class="form-control" id="address" placeholder="Event Address" name="location">
                                    <input type="hidden" id="longitude" name="longitude"
                                        value="{{ isset($record) ? $record->longitude : '' }}">
                                    <input type="hidden" id="latitude" name="latitude"
                                        value="{{ isset($record) ? $record->latitude : '' }}">
                                    <input id="pac-input" class="controls" required type="text"
                                        value="{{ isset($record) ? $record->location : '' }}" placeholder="Search Box">
                                    <div id="map"></div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="ckeditor" class="form-control" cols="30" rows="10">{{ isset($record) ? $record->description : '' }}</textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="image">Image</label>
                                    <input id="image" name="image" type="file" class="form-control">
                                    @if(isset($record))
                                    <br>
                                    <img src="{{asset($record->image)}}" style="height:100px">
                                    @endif
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="image">Gallery</label>
                                    <input id="image" name="gallery[]" type="file" multiple class="form-control">
                                    @if(isset($record))
                                    <br>
                                    <div class="row">
                                        @foreach($record->galleries as $gallery)
                                        <div class="col-md-2">
                                            <div class="image_container">
                                                <img src="{{asset($gallery->image)}}">
                                                <a href="{{route("delete.event.image",$gallery->id)}}" class="top-right"><i class="fa fa-times"></i></a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group col-md-12 text-center">
                                    <hr>
                                    <button type="button" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back</button>
                                    <button type="button" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Next</button>
                                    <button class="btn btn-primary"><i class="fa fa-checkbox"></i> Create Ad</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- Dashboard Analytics end -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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
