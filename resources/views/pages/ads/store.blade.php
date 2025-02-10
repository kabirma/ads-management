@extends('layouts.master')

@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
        .step-heading{
            
            text-align:center;
            margin-bottom:1.5%;
        }

        .step-heading h2{
            font-size:45px;
            font-weight:bold;
            color:#938AF4;
        }

        .titleRow{
            padding:1% 15%;
        }

    </style>
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item active"> <span class="badge badge-light-primary">Add
                                    {{ $title }}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            <form action="{{ route('save.ads') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ isset($record) ? $record->id : 0 }}">

                                <div class="row">
                                    <div class="col-md-12 steps" id="step1">
                                         <div class="step-heading">
                                            <h2>Choose Your Media</h2>
                                         </div>
                                        <ul id="imageRadio">
                                            <li><input type="radio" name="social_media" disabled value="facebook" id="cb1" />
                                                <label for="cb1"> <i class="fab fa-facebook"></i> </label>
                                            </li>
                                            <li><input type="radio" name="social_media"  checked value="tiktok" id="cb2" />
                                                <label for="cb2"><i class="fab fa-tiktok"></i></label>
                                            </li>
                                            <li><input type="radio" name="social_media" disabled value="twitter" id="cb3" />
                                                <label for="cb3"><i class="fab fa-twitter"></i></label>
                                            </li>
                                            <li><input type="radio" name="social_media" disabled value="google" id="cb4" />
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
                                        <div class="step-heading">
                                            <h2>Choose Your Goal</h2>
                                         </div>
                                        <ul id="imageRadio">
                                            <li><input type="radio" name="goal" checked value="TRAFFIC" id="cb6" />
                                                <label for="cb6"> <img src="https://cdn.sweply.com/ui-images/obj-sales.svg" alt="">
                                                    <h4>Website Traffic</h4>
                                                    <p>Get more website visits</p>
                                                </label>
                                            </li>
                                            <li><input type="radio" name="goal" value="TRAFFIC" id="cb7" />
                                                <label for="cb7"> <img src="https://cdn.sweply.com/ui-images/obj-video-view.svg" alt="">
                                                    <h4>Reach</h4>
                                                    <p>Increase the overall reach</p>
                                                </label>
                                            </li>
                                           
                                        </ul>
                                    </div>

                                    <div class="col-md-12 steps" id="step4">
                                        <div class="step-heading">
                                            <h2>Choose Your Content</h2>
                                         </div>
                                        <div class="titleRow row">
                                            <div class="form-group col-md-12">
                                                <label for="title">Title</label>
                                                <input id="title" name="title" type="text" required class="form-control">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="description">Description</label>
                                                <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="call_to_action">Call to Action</label>
                                                <select name="call_to_action" id="call_to_action" class="form-control">
                                                    <option selected value="BOOK_NOW">Book Now</option>
                                                    <option value="CONTACT_US">Contact Us</option>
                                                    <option value="APPLY_NOW">Apply Now</option>
                                                    <option value="CALL_NOW">Call Now</option>
                                                    <option value="LEARN_MORE">Learn More</option>
                                                    <option value="READ_MORE">Read More</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="website_url">Website Url</label>
                                                <input id="website_url" name="website_url" type="text" required class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12 steps" id="step5">
                                        <div class="step-heading">
                                            <h2>Upload Media</h2>
                                         </div>
                                        <div class="titleRow">
                                            <div class="form-group col-md-12">
                                                <label for="website_url">Choose Media Type</label>
                                                <select name="media_type" id="media_type" class="form-control">
                                                    <option selected value="1">Image</option>
                                                    <option value="2">Video</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12" id="media_image">
                                                <label for="image">Image</label>
                                                <input id="image" name="image" type="file" accept="image/*"  class="form-control">
                                                <small id="error-message" style="color: red; display: none;"></small>
                                            </div>
                                            <div class="form-group col-md-12" id="media_video">
                                                <label for="video">Video</label>
                                                <input id="video" name="video" type="file"  class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12 steps" id="step6">
                                        <div class="step-heading">
                                            <h2>Choose Duration & Budget</h2>
                                         </div>
                                        <div class="titleRow row">
                                            <div class="form-group col-md-12">
                                                <label for="dates">Schedule Dates</label>
                                                <input id="dates" name="dates" type="text" required class="form-control">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="budget">Budget</label>
                                                <input id="budget" name="budget" type="number" required class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                 
                                </div>

                                <div class="form-group col-md-12 text-center">
                                    <hr>
                                    <button type="button" class="btn btn-secondary prev"><i class="fa fa-arrow-left"></i> Back</button>
                                    <button type="button" class="btn btn-dark next" id="nextButton"><i class="fa fa-arrow-right"></i> Next</button>
                                    <button class="btn btn-primary createAd"><i class="fa fa-checkbox"></i> Create Ad</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- Dashboard Analytics end -->

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
   
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyBDymzR-k83U6xBmrlrTFF2cqYNWysHK0U">
    </script>
    
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        $('input[name="dates"]').daterangepicker({
            autoApply: true, // Auto-selects dates without needing the Apply button
            minDate: moment().add(1, 'days'), // Start date must be from tomorrow
            locale: { format: 'YYYY-MM-DD' }, // Format: YYYY-MM-DD
        }, function(start, end, label) {
            let minEndDate = start.clone().add(2, 'days'); // Ensure the end date is at least +1 day
            if (end.isSame(start, 'day')) {
                $('input[name="dates"]').data('daterangepicker').setEndDate(minEndDate); // Force +1 day
            }
        });
        $('.steps').hide();
        $('#step1').show();
        var stepCount = 1;
        var finalCount = 6;
        $(".createAd").hide();
        if(stepCount === finalCount){
            $(".prev").hide();
        }

        $(".next").click(function(){
            $(".prev").show();
            ++stepCount;
            $(".steps").hide();
            $("#step"+stepCount).show();
            if(stepCount === finalCount){
                $(this).hide();
                $(".createAd").show();
            }
        })

        $(".prev").click(function(){
            $(".next").show();
            --stepCount;
            $(".steps").hide();
            $("#step"+stepCount).show();
            if(stepCount === finalCount){
                $(this).hide();
            }
        })


        $("#media_type").change(function(){
            if($(this).val() == 1){
                $("#media_image").show();
                $("#media_video").hide();
            }else{
                $("#media_image").hide();
                $("#media_video").show();
            }
        })

        $("#media_type").change();

        CKEDITOR.replace('ckeditor');
    </script>


        <script>
             document.getElementById('image').addEventListener('change', function (event) {
                const file = event.target.files[0]; // Get the selected file
                const errorMessage = document.getElementById('error-message');
                const submitButton = document.getElementById('nextButton');

                if (file) {
                    const img = new Image();
                    img.src = URL.createObjectURL(file); 

                    img.onload = function () {
                        const width = img.width;
                        const height = img.height;
                        console.log(width,height);
                        // Allowed image sizes
                        const allowedSizes = [
                            { width: 720, height: 1280 },
                            { width: 1200, height: 628 },
                            // { width: 640, height: 640 },
                            // { width: 640, height: 100 },
                            // { width: 600, height: 500 },
                            // { width: 640, height: 200 }
                        ];

                        // Check if the uploaded image matches any of the allowed sizes
                        const isValidSize = allowedSizes.some(size => size.width === width && size.height === height);

                        if (!isValidSize) {
                            errorMessage.innerText = "Invalid image size. Allowed sizes: 720x1280, 1200x628, 640x640, 640x100, 600x500, 640x200 pixels.";
                            errorMessage.style.display = "block";
                            submitButton.disabled = true;
                        } else {
                            errorMessage.style.display = "none";
                            submitButton.disabled = false;
                        }
                    };
                }
            });
        </script>

   
@endsection
