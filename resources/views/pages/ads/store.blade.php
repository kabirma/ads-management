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

        #imageRadio input[type="radio"] {
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

        #imageRadio label img{
            height:100px;
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

        .ai-suggestion{
            font-weight:500;
            color: #938AF4;
        }
        .form-group label{
            display: flex;
            justify-content: space-between;  
        }
    </style>
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item active"> <span class="badge badge-light-primary">{{ __("messages.ADD")}}
                                    {{ $title }}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            @if (Session::has('error'))
                                <div class="alert alert-danger text-center">
                                    <i class="fa fa-times"></i> {{ Session::get('error') }}
                                </div>
                            @endif
                        
                            <form action="{{ route('save.ads') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ isset($record) ? $record->id : 0 }}">

                                <div class="row">
                                    <div class="col-md-12 steps" id="step1">
                                         <div class="step-heading">
                                            <h2>{{__("messages.ChooseYourMedia")}}</h2>
                                         </div>
                                        
                                        <ul id="imageRadio">
                                            <li><input type="radio" name="social_media" disabled value="facebook" id="facebook" />
                                                <label for="facebook"> <i class="fab fa-facebook"></i> </label>
                                            </li>
                                            <li><input type="radio" name="social_media"  @if(isset($social_media)) @if($social_media == 'tiktok') checked @endif @else checked @endif value="tiktok" id="tiktok" />
                                                <label for="tiktok"><i class="fab fa-tiktok"></i></label>
                                            </li>
                                            <li><input type="radio" name="social_media" disabled value="twitter" id="twitter" />
                                                <label for="twitter"><i class="fab fa-twitter"></i></label>
                                            </li>
                                            <li><input type="radio" name="social_media" disabled value="google" id="google" />
                                                <label for="google"><i class="fab fa-google"></i></label>
                                            </li>
                                            <li><input type="radio" name="social_media" @if(isset($social_media)) @if($social_media == 'snapchat') checked @endif @else @endif value="snapchat" id="snapchat" />
                                                <label for="snapchat"><i class="fab fa-snapchat"></i></label>
                                            </li>
                                           
                                        </ul>
                                    </div>

                                    <div class="col-md-12 steps" id="step2">
                                        <div class="important-note">
                                            <div class="note-header">
                                                <div class="note-heading">
                                                    <i class="fa fa-bell"></i>
                                                    <h2>{{__("messages.IMPORTANTNOTE")}}</h2>
                                                </div>
                                                <p><strong>{{__("messages.Content")}}</strong></p>
                                            </div>
                                            <div class="note-content">
                                                <ol>
                                                    <li>{{__("messages.Promotion")}}</li>
                                                    <li>{{__("messages.Offensive")}}</li>
                                                    <li>{{__("messages.IllegalActivities")}}</li>
                                                    <li>{{__("messages.Medicines")}}</li>
                                                </ol>
                                            </div>
                                            <p class="note-warning">
                                                    {{__("messages.Warning")}}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-12 steps" id="step3">
                                        <div class="step-heading">
                                            <h2>{{__("messages.Goal")}}</h2>
                                         </div>
                                        <ul id="imageRadio">
                                            <li class='tiktok_goal'><input type="radio" name="goal" checked value="TRAFFIC" id="tk1" />
                                                <label for="tk1"> <img src="{{asset('front/images/cost-per-click.png')}}" alt="">
                                                    <h4>{{ __("messages.WebsiteTraffic") }}</h4>
                                                    <p>{{__("messages.GetMoreWebsiteVisits")}}</p>
                                                </label>
                                            </li>
                                            <li class='tiktok_goal'><input type="radio" name="goal" value="TRAFFIC" id="tk2" />
                                                <label for="tk2"> <img src="{{asset('front/images/video-chat.png')}}" alt="">
                                                    <h4>{{__("messages.Reach")}}</h4>
                                                    <p>{{__("messages.IncreaseTheOverallReach")}}</p>
                                                </label>
                                            </li>

                                            <li class='snapchat_goal'><input type="radio" name="goal" checked value="WEB_CONVERSION" id="sc1" />
                                                <label for="sc1"> <img src="{{asset('front/images/cost-per-click.png')}}" alt="">
                                                    <h4>{{ __("messages.WebsiteTraffic") }}</h4>
                                                    <p>{{ __("messages.GetMoreWebsiteVisits")}}</p>
                                                </label>
                                            </li>
                                            <li class='snapchat_goal'><input type="radio" name="goal" value="ENGAGEMENT" id="sc2" />
                                                <label for="sc2"> <img src="{{asset('front/images/video-chat.png')}}" alt="">
                                                    <h4>{{ __("messages.Reach")}}</h4>
                                                    <p>{{ __("messages.IncreaseTheOverallReach")}}</p>
                                                </label>
                                            </li>

                                            <li class='snapchat_goal'><input type="radio" name="goal" value="BRAND_AWARENESS " id="sc3" />
                                                <label for="sc3"> <img src="{{asset('front/images/web.png')}}" alt="">
                                                    <h4>{{__("messages.BrandPromotion")}}</h4>
                                                    <p>{{__("messages.IncreaseBrandAwareness")}}</p>
                                                </label>
                                            </li>
                                           
                                        </ul>
                                    </div>

                                    <div class="col-md-12 steps" id="step4">
                                        <div class="step-heading">
                                            <h2>{{__("messages.ChooseYourContent")}}</h2>
                                         </div>
                                        <div class="titleRow row">
                                            <div class="form-group col-md-12">
                                                <label for="title">{{__("messages.Title")}} @if(isset($ai_sugguested)) <small class="ai-suggestion">(<i class="fa-solid fa-robot"></i>
                                                    {{__("messages.AISuggested")}} )</small> @endif</label>
                                                <input id="title" name="title" type="text" @if(isset($name)) value="{{$name}}" @endif class="form-control">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="description">{{__("messages.Description")}} @if(isset($ai_sugguested)) <small class="ai-suggestion">(<i class="fa-solid fa-robot"></i>
                                                    {{__("messages.AISuggested")}} )</small> @endif</label>
                                                <textarea name="description" class="form-control" cols="30" rows="10"> @if(isset($name)){{$description}}@endif</textarea>
                                            </div>
                                            <div class="form-group col-md-6" id="callTOActionArea">
                                                <label for="call_to_action">{{__("messages.CallToAction")}}</label>
                                                <select name="call_to_action" id="call_to_action" class="form-control">
                                                    <option class="tiktok" selected value="BOOK_NOW">{{__("messages.BookNow")}}</option>
                                                    <option class="tiktok" value="CONTACT_US">{{__("messages.ContactUs")}}</option>
                                                    <option class="tiktok" value="APPLY_NOW">{{__("messages.ApplyNow")}}</option>
                                                    <option class="tiktok" value="CALL_NOW">{{__("messages.CallNow")}}</option>
                                                    <option class="tiktok" value="LEARN_MORE">{{__("messages.LearnMore")}}</option>
                                                    <option class="tiktok" value="READ_MORE">{{__("messages.ReadMore")}}</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6" id="websiteUrlArea">
                                                <label for="website_url">{{__("messages.WebsiteUrl")}}</label>
                                                <input id="website_url" name="website_url" type="text" required class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12 steps" id="step5">
                                        <div class="step-heading">
                                            <h2>{{__("messages.UploadMedia")}}</h2>
                                        </div>
                                        <div class="titleRow">
                                            <div class="form-group col-md-12">
                                                <label for="website_url">{{__("messages.ChooseMediaType")}}</label>
                                                <select name="media_type" id="media_type" class="form-control">
                                                    <option selected value="1">{{__("messages.Image")}}</option>
                                                    <option value="2">{{__("messages.Video")}}</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12" id="media_image">
                                                <label for="image">{{__("messages.Image")}}</label>
                                                <input id="image" name="image" type="file" accept="image/*" class="form-control">
                                                <small id="error-message" style="color: red; display: none;"></small>
                                            </div>
                                            <div class="form-group col-md-12" id="media_video">
                                                <label for="video">{{__("messages.Video")}}</label>
                                                <input id="video" name="video" type="file" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 steps" id="step6">
                                        <div class="step-heading">
                                            <h2>{{__("messages.ChooseDurationBudget")}}</h2>
                                        </div>
                                        <div class="titleRow row">
                                            <div class="form-group col-md-12">
                                                <label for="dates">
                                                    {{__("messages.ScheduleDates")}}
                                                    @if(isset($ai_sugguested))
                                                        <small class="ai-suggestion">(<i class="fa-solid fa-robot"></i> {{__("messages.AISuggested")}})</small>
                                                    @endif
                                                </label>
                                                <input id="dates" name="dates" type="text" required class="form-control">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="budget">
                                                    {{__("messages.Budget")}}
                                                    @if(isset($ai_sugguested))
                                                        <small class="ai-suggestion">(<i class="fa-solid fa-robot"></i> {{__("messages.AISuggested")}})</small>
                                                    @endif
                                                </label>
                                                <input id="budget" name="budget" @if(isset($budget)) value="{{$budget}}" @endif type="number" required class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 steps" id="step7">
                                        <div class="step-heading">
                                            <h2>{{__("messages.ChooseDemographic&Location")}}</h2>
                                         </div>
                                        <div class="titleRow row">
                                            <div class="form-group col-md-12">
                                                <label for="gender">{{__("messages.Gender")}}  @if(isset($ai_sugguested)) <small class="ai-suggestion">(<i class="fa-solid fa-robot"></i>  {{__("messages.AISuggested")}})</small> @endif</label>
                                                <select name="gender" id="gender" class="form-control">
                                                    <option @if(isset($gender) && strtolower($gender) == 'male') selected @else @endif value="Male">{{__("messages.Male")}}</option>
                                                    <option @if(isset($gender) && strtolower($gender) == 'female') selected @else @endif value="Female">{{__("messages.Female")}}</option>
                                                    <option @if(isset($gender) && strtolower($gender) == 'both') selected @else @endif value="Both">{{__("messages.Both")}}</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="age_group">{{__("messages.AgeGroup")}}  @if(isset($ai_sugguested)) <small class="ai-suggestion">(<i class="fa-solid fa-robot"></i>  {{__("messages.AISuggested")}})</small> @endif</label>
                                                <select name="age_group" id="age_group" class="form-control">
                                                    <option @if(isset($age) && strtolower($age) == '18') selected @else @endif value="18">{{__("messages.MaxAge18")}}</option>
                                                    <option @if(isset($age) && strtolower($age) == '30') selected @else @endif value="30">{{__("messages.MaxAge30")}}</option>
                                                    <option @if(isset($age) && strtolower($age) == '0') selected @else @endif value="0">{{__("messages.AnyAge")}}</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="location">{{__("messages.Locations")}}</label>
                                                <select name="location[]" id="location" class="form-control select2" multiple>
                                                    <option value="">{{__("messages.SelectCountry")}}</option>
                                                    <option value="SA">{{__("messages.SaudiArabia")}}</option>
                                                    <option value="AE">{{__("messages.UnitedArabEmirates")}}</option>
                                                    <option value="QA">{{__("messages.Qatar")}}</option>
                                                    <option value="BH">{{__("messages.Bahrain")}}</option>
                                                    <option value="KW">{{__("messages.Kuwait")}}</option>
                                                    <option value="OM">{{__("messages.Oman")}}</option>
                                                    <option value="YE">{{__("messages.Yemen")}}</option>
                                                    <option value="IQ">{{__("messages.Iraq")}}</option>
                                                    <option value="SY">{{__("messages.Syria")}}</option>
                                                    <option value="LB">{{__("messages.Lebanon")}}</option>
                                                    <option value="JO">{{__("messages.Jordan")}}</option>
                                                    <option value="PS">{{__("messages.Palestine")}}</option>
                                                    <option value="EG">{{__("messages.Egypt")}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                 
                                </div>

                                <div class="form-group col-md-12 text-center">
                                    <hr>
                                    <button type="button" class="btn btn-secondary prev"><i class="fa fa-arrow-left"></i>
                                        {{__("messages.Back")}}</button>
                                    <button type="button" class="btn btn-dark next" id="nextButton"><i class="fa fa-arrow-right"></i>
                                        {{__("messages.Next")}}</button>
                                    <button class="btn btn-primary createAd"><i class="fa fa-checkbox"></i> {{__("messages.CreateAd")}}</button>
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
            autoApply: true, 
            timePicker: true,
            startDate: moment().add(1, 'days'),
            endDate: moment().add({{$days+1}}, 'days'),
            minDate: moment().add(1, 'days'), 
            locale: { format: 'YYYY-MM-DD hh:mm A' },
        });
        $('.steps').hide();
        $('#step1').show();
        var stepCount = 1;
        var finalCount = 7;
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
        var mediaType  = 'image'

        $("#media_type").change(function(){
            if($(this).val() == 1){
                $("#media_image").show();
                $("#media_video").hide();
            }else{
                $("#media_image").hide();
                $("#media_video").show();
            }
        })

        $("input[name='social_media']").change(function() {
            $("#call_to_action option").hide();

            if($(this).val() === 'snapchat'){
                $("#callTOActionArea").hide();
                $("#websiteUrlArea").removeClass("col-md-6");
                $("#websiteUrlArea").addClass("col-md-12");
            }else if($(this).val() === 'tiktok'){
                $(".tiktok").show();
                $("#callTOActionArea").show();
                $("#websiteUrlArea").addClass("col-md-6");
                $("#websiteUrlArea").removeClass("col-md-12");
            }
        })

        $("#media_type").change();

        CKEDITOR.replace('ckeditor');
    
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
                        // Allowed image sizes

                        var socialMedia = $("input[name='social_media']:checked").val();

                        const snapchatallowedSizes = [
                            { width: 1080 , height: 1920 }
                        ]

                        const tiktokallowedSizes = [
                            { width: 720, height: 1280 },
                            { width: 1200, height: 628 },
                            // { width: 640, height: 640 },
                            // { width: 640, height: 100 },
                            // { width: 600, height: 500 },
                            // { width: 640, height: 200 }
                        ];

                        // Check if the uploaded image matches any of the allowed sizes
                        if(socialMedia == 'snapchat'){
                            const isValidSize = snapchatallowedSizes.some(size => size.width === width && size.height === height);

                        }else if(socialMedia == 'tiktok'){
                            const isValidSize = tiktokallowedSizes.some(size => size.width <= width && size.height <= height);
                        }

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

            $("#step1 input").change(function(){
                var currentVal = $("#step1 input:checked").val();
                $("#step3 ul li").hide();
                if(currentVal == 'tiktok'){
                    $(".tiktok_goal").show();
                }
                else if(currentVal == 'snapchat'){
                    $(".snapchat_goal").show();
                }
            })

            $("#step1 input").change();
        </script>

   
@endsection
