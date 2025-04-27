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

        #mediaArea img{
            height:200px!important;
            width:auto;
        }
        .loading-overlay {
            display: none;
            background: rgba(255, 255, 255, 0.7);
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            top: 0;
            z-index: 9998;
            align-items: center;
            justify-content: center;
        }

        .loading-overlay.is-active {
            display: flex;
        }
    </style>
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"> 
                                <span class="badge badge-light-primary">{{ __("messages.ADD")}}
                                    {{ $title }}
                                </span>
                            </li>
                        </ol>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            <div class="alert alert-danger text-center" id="error">
                                <i class="fa fa-times"></i> <span id="errorMessage"></span>
                            </div>

                            <div class="alert alert-success text-center" id="success">
                                <i class="fa fa-check"></i> <span id="successMessage"></span>
                            </div>
                        
                            <form action="{{ route('save.ads') }}" method="post" id="adForm" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ isset($record) ? $record->id : 0 }}">
                                <div class="loading-overlay" id="loader">
                                    <dotlottie-player
                                        src="https://lottie.host/0b9fb8be-cfaf-467c-bb48-dd461b508487/l8zI4IHnpj.lottie"
                                        background="transparent"
                                        speed="1"
                                        style="width: 300px; height: 300px"
                                        loop
                                        autoplay
                                    ></dotlottie-player>
                                </div>
                                <div class="row">
                                    @if(isset($ai_sugguested) && $ai_sugguested== 1)
                                        <div class="col-md-12" style="text-align: right">
                                            <button type="button" class="btn btn-secondary btn-sm" id="suggestAi"><i class="fa-solid fa-robot"></i> {{__("messages.NeedHelpWithContent")}}</button>
                                        </div>
                                    @endif
                                    <div class="col-md-12 steps" id="step1">
                                         <div class="step-heading">
                                            <h2>{{__("messages.ChooseYourMedia")}}</h2>
                                            @if(isset($ai_sugguested) && $ai_sugguested== 1) <h4 class="ai-suggestion">(<i class="fa-solid fa-robot"></i>
                                                    {{__("messages.AISuggested")}} {{$social_media}})</h4> @endif
                                         </div>
                                        <ul id="imageRadio">
                                            <li><input type="radio" name="social_media" disabled value="facebook" id="facebook" />
                                                <label for="facebook"> <i class="fab fa-facebook"></i> </label>
                                            </li>
                                            <li><input type="radio" name="social_media"  @if(isset($social_media)) @if(strtolower($social_media) == 'tiktok') checked @endif @else checked @endif value="tiktok" id="tiktok" />
                                                <label for="tiktok"><i class="fab fa-tiktok"></i></label>
                                            </li>
                                            <li><input type="radio" name="social_media" disabled value="twitter" id="twitter" />
                                                <label for="twitter"><i class="fab fa-twitter"></i></label>
                                            </li>
                                            <li><input type="radio" name="social_media" disabled value="google" id="google" />
                                                <label for="google"><i class="fab fa-google"></i></label>
                                            </li>
                                            <li><input type="radio" name="social_media" @if(isset($social_media)) @if(strtolower($social_media) == 'snapchat') checked @endif @else @endif value="snapchat" id="snapchat" />
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
                                            <li class='tiktok_goal'><input @if(isset($goal)) @if($goal == 'TRAFFIC') checked @endif @else @endif  type="radio" name="goal" checked value="TRAFFIC" id="tk1" />
                                                <label for="tk1"> <img src="{{asset('front/images/cost-per-click.png')}}" alt="">
                                                    <h4>{{ __("messages.WebsiteTraffic") }}</h4>
                                                    <p>{{__("messages.GetMoreWebsiteVisits")}}</p>
                                                </label>
                                            </li>
                                            <li class='tiktok_goal'><input @if(isset($goal)) @if($goal == 'TRAFFIC') checked @endif @else @endif  type="radio" name="goal" value="TRAFFIC" id="tk2" />
                                                <label for="tk2"> <img src="{{asset('front/images/video-chat.png')}}" alt="">
                                                    <h4>{{__("messages.Reach")}}</h4>
                                                    <p>{{__("messages.IncreaseTheOverallReach")}}</p>
                                                </label>
                                            </li>

                                            <li class='snapchat_goal'><input @if(isset($goal)) @if($goal == 'WEB_CONVERSION') checked @endif @else @endif  type="radio" name="goal" checked value="WEB_CONVERSION" id="sc1" />
                                                <label for="sc1"> <img src="{{asset('front/images/cost-per-click.png')}}" alt="">
                                                    <h4>{{ __("messages.WebsiteTraffic") }}</h4>
                                                    <p>{{ __("messages.GetMoreWebsiteVisits")}}</p>
                                                </label>
                                            </li>
                                            <li class='snapchat_goal'><input @if(isset($goal)) @if($goal == 'ENGAGEMENT') checked @endif @else @endif  type="radio" name="goal" value="ENGAGEMENT" id="sc2" />
                                                <label for="sc2"> <img src="{{asset('front/images/video-chat.png')}}" alt="">
                                                    <h4>{{ __("messages.Reach")}}</h4>
                                                    <p>{{ __("messages.IncreaseTheOverallReach")}}</p>
                                                </label>
                                            </li>

                                            <li class='snapchat_goal'><input @if(isset($goal)) @if($goal == 'BRAND_AWARENESS') checked @endif @else @endif  type="radio" name="goal" value="BRAND_AWARENESS " id="sc3" />
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
                                                <label for="title">{{__("messages.Title")}} @if(isset($ai_sugguested) && $ai_sugguested== 1) <small class="ai-suggestion">(<i class="fa-solid fa-robot"></i>
                                                    {{__("messages.AISuggested")}} )</small> @endif</label>
                                                <input id="title" name="title" type="text" class="form-control">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="description">{{__("messages.Description")}} @if(isset($ai_sugguested) && $ai_sugguested== 1) <small class="ai-suggestion">(<i class="fa-solid fa-robot"></i>
                                                    {{__("messages.AISuggested")}} )</small> @endif</label>
                                                <textarea name="description" class="form-control" cols="30" rows="10" id="description"></textarea>
                                            </div>
                                            <div class="form-group col-md-6" id="callTOActionArea">
                                                <label for="call_to_action">{{__("messages.CallToAction")}}</label>
                                                <select name="call_to_action" id="call_to_action" class="form-control">
                                                    <option class="tiktok" @if(isset($call_to_action)) @if($call_to_action == 'BOOK_NOW') selected @endif @else selected @endif value="BOOK_NOW">{{__("messages.BookNow")}}</option>
                                                    <option class="tiktok" @if(isset($call_to_action)) @if($call_to_action == 'CONTACT_US') selected @endif @else @endif value="CONTACT_US">{{__("messages.ContactUs")}}</option>
                                                    <option class="tiktok" @if(isset($call_to_action)) @if($call_to_action == 'APPLY_NOW') selected @endif @else @endif value="APPLY_NOW">{{__("messages.ApplyNow")}}</option>
                                                    <option class="tiktok" @if(isset($call_to_action)) @if($call_to_action == 'CALL_NOW') selected @endif @else @endif value="CALL_NOW">{{__("messages.CallNow")}}</option>
                                                    <option class="tiktok" @if(isset($call_to_action)) @if($call_to_action == 'LEARN_MORE') selected @endif @else @endif value="LEARN_MORE">{{__("messages.LearnMore")}}</option>
                                                    <option class="tiktok" @if(isset($call_to_action)) @if($call_to_action == 'READ_MORE') selected @endif @else @endif value="READ_MORE">{{__("messages.ReadMore")}}</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6" id="websiteUrlArea">
                                                <label for="website_url">{{__("messages.WebsiteUrl")}}</label>
                                                <input id="website_url" name="website_url" @if(isset($website_url)) value="{{$website_url}}" @endif type="text" required class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12 steps" id="step5">
                                        <div class="step-heading">
                                            <h2>{{__("messages.UploadMedia")}}</h2>
                                        </div>
                                        <div class="titleRow">
                                           
                                            <div class="form-group col-md-12 text-center">
                                                <div id="mediaArea" class="mb-2">
                                                    @if(isset($media) && isset($media_type))
                                                        @if($media_type == "1")
                                                            <img src="{{asset($media)}}" height="200">
                                                        @else
                                                            <video width="320" height="240" controls>
                                                                <source src="{{asset($media)}}" type="video/mp4">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        @endif
                                                    @endif
                                                </div>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#imageModal">
                                                    <i class="fa fa-image"></i> Choose Media
                                                </button>
                                                <input type="hidden" id="selectedMedia" name="media" value="{{isset($media) ? $media : ''}}">
                                                <input type="hidden" id="selectedType" name="media_type" value="{{isset($media_type) ? $media_type : ''}}">
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
                                                    @if(isset($ai_sugguested) && $ai_sugguested== 1)
                                                        <small class="ai-suggestion">(<i class="fa-solid fa-robot"></i> {{__("messages.AISuggested")}})</small>
                                                    @endif
                                                </label>
                                                <input id="dates" name="dates" type="text" required class="form-control">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="budget">
                                                    {{__("messages.Budget")}}
                                                    @if(isset($ai_sugguested) && $ai_sugguested== 1)
                                                        <small class="ai-suggestion">(<i class="fa-solid fa-robot"></i> {{__("messages.AISuggested")}})</small>
                                                    @endif
                                                </label>
                                                <input id="budget" name="budget" type="number" required class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 steps" id="step7">
                                        <div class="step-heading">
                                            <h2>{{__("messages.ChooseDemographic&Location")}}</h2>
                                         </div>
                                        <div class="titleRow row">
                                            <div class="form-group col-md-12">
                                                <label for="gender">{{__("messages.Gender")}}  @if(isset($ai_sugguested) && $ai_sugguested== 1) <small class="ai-suggestion">(<i class="fa-solid fa-robot"></i>  {{__("messages.AISuggested")}})</small> @endif</label>
                                                <select name="gender" id="gender" class="form-control">
                                                    <option value="male">{{__("messages.Male")}}</option>
                                                    <option value="female">{{__("messages.Female")}}</option>
                                                    <option value="both">{{__("messages.Both")}}</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="age_group">{{__("messages.AgeGroup")}}  @if(isset($ai_sugguested) && $ai_sugguested== 1) <small class="ai-suggestion">(<i class="fa-solid fa-robot"></i>  {{__("messages.AISuggested")}})</small> @endif</label>
                                                <select name="age_group" id="age_group" class="form-control">
                                                    <option value="18">{{__("messages.MaxAge18")}}</option>
                                                    <option value="30">{{__("messages.MaxAge30")}}</option>
                                                    <option value="0">{{__("messages.AnyAge")}}</option>
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
                                <input type="hidden" name="step" value="1" id="stepNo">
                                <div class="form-group col-md-12 text-center">
                                    <hr>
                                    <button type="button" class="btn btn-secondary prev"><i class="fa fa-arrow-left"></i>
                                        {{__("messages.Back")}}</button>
                                    <button type="button" class="btn btn-success" id="saveDraft"><i class="fa fa-save"></i>
                                        {{__("messages.SAVE_AND_CLOSE")}}</button>
                                    <button type="button" class="btn btn-dark next" id="nextButton"><i class="fa fa-arrow-right"></i>
                                        {{__("messages.Next")}}</button>
                                    <button type="button" class="btn btn-primary createAd"><i class="fa fa-checkbox"></i> {{__("messages.CreateAd")}}</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <input type="hidden" value="0" id="draftId">
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
       
        var stepCount = {{isset($step_count) ? $step_count : 1}};
        function showStep(){
            $(".steps").hide();
            $("#step"+stepCount).show();
        }
        var finalCount = 7;
        $(".createAd").hide();
        if(stepCount === 1){
            $(".prev").hide();
        }
        if(stepCount === finalCount){
            $(".next").hide();
            $(".createAd").show();
        }
        $("#stepNo").val(stepCount)
        showStep();
        $(".next").click(function(){
            $(".alert").hide();
            $(".prev").show();
            ++stepCount;
            showStep();
            if(stepCount === finalCount){
                $(this).hide();
                $(".createAd").show();
            }
            $("#stepNo").val(stepCount);
        })

        $(".prev").click(function(){
            $(".createAd").hide();
            $(".next").show();
            --stepCount;
            showStep();
            if(stepCount === 1){
                $(this).hide();
                $(".createAd").show();
            }
            $("#stepNo").val(stepCount);
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

            $("#saveDraft").click(function(){
                saveDraft();
            })

            function saveDraft(){
                var formData = $("#adForm").serialize();
                $.ajax({
                    url: '{{route('save.draft')}}',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        window.location.href = "{{route('view.ads')}}"
                    },
                    error: function (xhr) {
                        // console.log('Error:', xhr.responseText);
                    }
                });
            }

            $(".alert").hide();
            $(".createAd").click(function(){
                $("#loader").addClass("is-active");
                $(".alert").hide();
                var formData = $("#adForm").serialize();
                $.ajax({
                    url: '{{route('save.ads')}}',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        $("#loader").removeClass("is-active");

                        response = JSON.parse(response);
                        if(response[0] == 200){
                            $("#success").show();
                            $("#successMessage").text(response[1]);
                            setTimeout(() => {
                                window.location.href = "{{route('view.ads')}}"
                            }, 2000);
                        } else {
                            let error = response[1].error.error.error;
                            $("#error").show();
                            $("#errorMessage").text(error)
                        }
                    },
                    error: function (xhr) {
                        $("#loader").removeClass("is-active");
                        $("#error").show();
                        $("#errorMessage").text(xhr.responseText)
                        // console.log('Error:', xhr.responseText);
                    }
                });
            })
           
            @if(isset($title) && isset($ai_sugguested) && $ai_sugguested== 1)
                $(".ai-suggestion").hide();
                $("#suggestAi").click(function(){
                    $(".ai-suggestion").show();

                    // $("#title").val('{{$name}}')
                    // $("#description").val('{{$description}}')

                    type(0, $("#title"), "{{$name}}");
                    type(0, $("#description"), "{{$description}}");
                    $("#budget").val('{{$budget}}')
                    $("#age_group").val('{{strtolower($age)}}')
                    $("#gender").val('{{strtolower($gender)}}')
                });


                function type(index, input, text) {
                    if (index < text.length) {
                        input.val(input.val() + text.charAt(index));
                        index++;
                        setTimeout(function() {
                            type(index, input, text);
                        }, 50);
                    }
                }
            @endif
        </script>
        <script
            src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"
            type="module"
        ></script>

@endsection
