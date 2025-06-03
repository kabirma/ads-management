@extends('admin.layouts.master')

@section('content')
    <style>
        .select2-container--default .select2-selection--multiple {
            background: transparent;
            border: 1px solid transparent;
            border-radius: 4px;
            color: white;
            background-image: linear-gradient(135deg, #2e3e4a, #0c2c3e), linear-gradient(to right, #38afc3, #1487b3);
            background-origin: border-box;
            background-clip: padding-box, border-box;
        }

        .select2-container--default .select2-selection--single {
            background: linear-gradient(to right, #1487b3, #38afc3) !important;
            color: white !important;
            border: none;
            border-radius: 4px;
        }


        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background: linear-gradient(to right, #1487b3, #38afc3);
            color: white;
        }

        .select2-container--default .select2-selection--single {
            background-color: #38afc3 !important;
            color: white;
            border: none;
        }

        /* Highlighted (hovered or keyboard-selected) dropdown item */
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #0f6b91 !important;
            /* background on hover/focus */
            color: white !important;
            /* text color */
        }


        .select2-container .select2-dropdown {
            background-color: #1487b3 !important;
            /* or any color you want */
            color: white;
            /* text color */
        }

        /* Style the selected option in the dropdown list */
        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #1487b3 !important;
            color: white !important;
            font-weight: bold;
        }


        /* #map_2 {
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
                                                                            } */
    </style>
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics ">
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item active"> <span class="badge badge-light-primary">Edit
                                    {{ $title }}</span>
                            </li>
                        </ol>
                        <a href="{{ route('view.package') }}" class="btn btn-sm btn-primary primary-btn waves-effect addnew">
                            <i class="fa fa-list"></i> <span>View {{ $title }}</span>
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            <form action="{{ route('save.package') }}" method="post" class="row"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ isset($record) ? $record->id : 0 }}">

                                <div class="form-group col-md-6">
                                    <label for="name">{{ __('messages.Name') }}</label>
                                    <input id="name" name="name" value="{{ isset($record) ? $record->name : '' }}"
                                        type="text" required class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="price">{{ __('messages.Price') }}</label>
                                    <input id="price" name="price" value="{{ isset($record) ? $record->price : '' }}"
                                        type="number" required class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="time">{{ __('messages.SocialMedia') }}</label>
                                    <select name="social_media[]" id="" class="form-control  select2" multiple>
                                        <option
                                            <?= isset($record) && in_array('facebook', explode('?=', $record->social_media)) ? 'selected' : '' ?>
                                            value="facebook">
                                            {{ __('messages.Facebook') }}</option>
                                        <option
                                            <?= isset($record) && in_array('tiktok', explode('?=', $record->social_media)) ? 'selected' : '' ?>
                                            value="tiktok">{{ 'messages.TikTok' }}</option>
                                        <option
                                            <?= isset($record) && in_array('youtube', explode('?=', $record->social_media)) ? 'selected' : '' ?>
                                            value="youtube">{{ 'messages.Youtube' }}</option>
                                        <option
                                            <?= isset($record) && in_array('google', explode('?=', $record->social_media)) ? 'selected' : '' ?>
                                            value="google">{{ 'messages.Google' }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="is_popular">{{ __('messages.isPopular') }}?</label>
                                    <input id="is_popular" name="is_popular"
                                        {{ isset($record) && isset($record->is_popular) ? 'checked' : '' }}
                                        type="checkbox">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="features">{{ __('messages.Features') }}</label>
                                    <div id="featuresArea">
                                        @if (!isset($record))
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="features[]"
                                                        placceholder="Features">
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="#" class="btn btn-secondary primary-btndash"
                                                        id="addFeatures"><i class="fa fa-plus"></i></a>
                                                </div>
                                            </div>
                                        @else
                                            @foreach (explode('?=', $record->features) as $key => $feature)
                                                <div class="row mt-2">
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control"
                                                            value="{{ $feature }}" name="features[]"
                                                            placceholder="Features">
                                                    </div>
                                                    @if ($key > 0)
                                                        <div class="col-md-2">
                                                            <a href="#" class="btn btn-danger removeFeature"><i
                                                                    class="fa fa-times"></i></a>
                                                        </div>
                                                    @else
                                                        <div class="col-md-2">
                                                            <a href="#" class="btn btn-secondary" id="addFeatures"><i
                                                                    class="fa fa-plus"></i></a>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>


                                </div>



                                <div class="form-group col-md-12">
                                    <hr>
                                    <button class="btn btn-primary primary-btn"><i class="fa fa-check"></i>
                                        {{ __('messages.SAVE') }}</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(".select2").select2();

        // CKEDITOR.replace('ckeditor');
        $("#addFeatures").click(function() {
            $("#featuresArea").append(
                '<div class="row mt-2"><div class="col-md-10"> <input type="text" class="form-control" name="features[]" placceholder="Features"> </div> <div class="col-md-2"> <a href="#0" class="btn btn-danger removeFeature"><i class="fa fa-times"></i></a> </div></div>'
            );
        });

        $(document).on("click", ".removeFeature", function() {
            $(this).parent().parent().remove();
        })
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
