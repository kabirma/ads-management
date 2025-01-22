@extends('layouts.master')

@section('content')
    <style>
        #map_2 {
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

        .image_container img{
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
                        <a href="{{ route('view.spot_light_event') }}" class="btn btn-sm btn-primary waves-effect addnew">
                            <i class="fa fa-list"></i> <span>View {{ $title }}</span>
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            <form action="{{ route('save.spot_light_event') }}" method="post" class="row"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ isset($record) ? $record->id : 0 }}">

                                <div class="form-group col-md-12">
                                    <label for="artist">Artist</label>
                                    <input id="artist" name="artist" value="{{ isset($record) ? $record->artist : '' }}"
                                        type="text" required class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date">Date</label>
                                    <input id="date" name="date" value="{{ isset($record) ? $record->date : '' }}"
                                        type="date" required class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="time">Time</label>
                                    <input id="time" name="time"
                                        value="{{ isset($record) ? $record->time : '' }}" type="time" required
                                        class="form-control">
                                </div>
                         

                                <div class="form-group col-md-12">
                                    <label for="description">Venue</label>
                                    <input type="hidden" value="{{ isset($record) ? $record->location : '' }}"
                                        class="form-control" id="address" placeholder="Event Address" name="location">
                                    <input type="hidden" id="longitude" name="longitude"
                                        value="{{ isset($record) ? $record->longitude : '' }}">
                                    <input type="hidden" id="latitude" name="latitude"
                                        value="{{ isset($record) ? $record->latitude : '' }}">
                                    <input id="pac-input" class="controls" required type="text"
                                        value="{{ isset($record) ? $record->location : '' }}" placeholder="Search Box">
                                    <div id="map_2"></div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control ckeditor" cols="30" rows="10">{{ isset($record) ? $record->description : '' }}</textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="about">About</label>
                                    <textarea name="about" class="form-control ckeditor" cols="30" rows="10">{{ isset($record) ? $record->about : '' }}</textarea>
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
                                    <hr>
                                    <button class="btn btn-primary"><i class="fa fa-check"></i> SAVE</button>
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
        // CKEDITOR.replace('ckeditor');
    </script>

<script>
    /* script */
    function initialize() {
        var latlng = new google.maps.LatLng({{ isset($record) ? $record->latitude : '47.087767' }},
            {{ isset($record) ? $record->longitude : '-119.7190647' }});
        var map = new google.maps.Map(document.getElementById('map_2'), {
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
