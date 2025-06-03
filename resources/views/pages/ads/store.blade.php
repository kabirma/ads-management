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

        .image_container i {
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

        #imageRadio {
            list-style-type: none;
            text-align: center
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
            font-size: 75px;
            transition-duration: 0.2s;
            transform-origin: 50% 50%;
        }

        #imageRadio :checked+label {
            border: 1px solid #968DF3;
        }

        #imageRadio :checked+label:before {
            content: "✓";
            background-color: #5BBE25;
            transform: scale(1);
        }

        #imageRadio :checked+label i {
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

        #imageRadio label img {
            height: 100px;
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
            font-size: 25px;
            color: #e74c3c;
        }

        .note-header h2 {
            color: #555555;
            font-size: 24px;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .note-content {
            background-color: #fdf7eb;
            /* Light background */
            border: 1px solid #f5c976;
            /* Border matching light theme */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
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
            color: #e74c3c;
            /* Red for emphasis */
            font-weight: bold;
        }

        .note-warning {
            margin-top: 20px;
            font-size: 14px;
            color: #666666;
            text-align: center;
            font-weight: bold;
        }

        .step-heading {

            text-align: center;
            margin-bottom: 1.5%;
        }

        .step-heading h2 {
            font-size: 45px;
            font-weight: bold;
            color: #938AF4;
        }

        .titleRow {
            padding: 1% 15%;
        }

        .ai-suggestion {
            font-weight: 500;
            color: #938AF4;
        }

        .form-group label {
            display: flex;
            justify-content: space-between;
        }

        #mediaArea img {
            height: 200px !important;
            width: auto;
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

        .budgetTab a {
            background-color: transparent;
            color: #968DF3;
            border: 2px solid #968DF3;
            border-radius: 10px;
        }

        .budgetTypeActive {
            background-color: #968DF3 !important;
            color: white !important;
            border-color: #968DF3 !important;
        }

        .budgetTab {
            display: flex;
            justify-content: center;
        }

        .budgetTab li {
            text-decoration: none;
            list-style: none;
            margin-right: 10px;
        }

        .button-group-pills {
            display: flex;
        }

        .button-group-pills input {
            list-style: none;
        }

        .button-group-pills .btn {
            border-radius: 20px;
            line-height: 1.2;
            margin-bottom: 15px;
            margin-left: 10px;
            border-color: #968DF3;
            background-color: #FFF;
            color: #968DF3;
        }

        .button-group-pills .btn.active {
            border-color: #968DF3;
            background-color: #968DF3;
            color: #FFF;
            box-shadow: none;
        }

        .button-group-pills .btn:hover {
            border-color: rgb(139, 129, 253);
            background-color: rgb(139, 129, 253);
            color: #FFF;
        }

        .recommended_budget label {
            height: 100px;
            align-items: center;
            text-align: center;
        }

        .recommended_budget label div {
            padding: 1% 2%;
        }

        .button-group-pills label div {
            margin-left: 10px;
            margin-right: 10px;
        }

        .recommended_budget .active h4 {
            color: white;
        }

        .recommended_budget h4 {
            color: #968DF3;
        }


        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .ad-preview {
            width: 100%;
            max-width: 150px;
            margin: 10px 0;
        }

        .wallet {
            background: linear-gradient(135deg, #968DF3, #968DF3);
            color: white;
            text-align: center;
            border-radius: 10px 10px 0px 0px;
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        .wallet p {
            margin: 0;
            font-size: 14px;
        }

        .wallet h2 {
            margin: 5px 0 0;
            font-size: 28px;
            color: white;
        }

        .terms a {
            color: #968DF3;
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
        }

        .left-side {
            background: whitesmoke;
            padding: 0px;
            border-radius: 0px 0px 10px 10px;
        }

        .left-side .card {
            margin: 2%;
        }

        .right-side .card {
            background: linear-gradient(135deg, rgba(243, 242, 253, 0.21), rgb(255, 255, 255));
        }

        .card h3 {
            margin-bottom: 2%;
            text-transform: uppercase;
        }

        .right-side {
            padding-top: 1%;
        }

        .col-md-4.left-side span {
            right: 20px;
            position: absolute;
        }

        #steps {
            text-align: center;
            margin: 50px auto;
        }

        .step {
            width: 40px;
            height: 40px;
            background-color: white;
            display: inline-block;
            border: 4px solid;
            border-color: whitesmoke;
            border-radius: 50%;
            color: #cdd0da;
            font-weight: 600;
            text-align: center;
            line-height: 35px;
        }

        .step:first-child {
            line-height: 40px;
        }

        .step:nth-child(n+2) {
            margin: 0 0 0 100px;
            transform: translate(0, -4px);
        }

        .step:nth-child(n+2):before {
            width: 75px;
            height: 3px;
            display: block;
            background-color: whitesmoke;
            transform: translate(-95px, 21px);
            content: "";
        }

        .step:after {
            width: 150px;
            display: block;
            transform: translate(-55px, 3px);
            color: #818698;
            content: attr(data-desc);
            font-weight: 400;
            font-size: 13px;
        }

        .step:first-child:after {
            transform: translate(-55px, -1px);
        }

        .step.active {
            border-color: #968DF3;
            color: #968DF3;
        }

        .step.active:before {
            background: linear-gradient(to right, #58bb58 0%, #73b5e8 100%);
        }

        .step.active:after {
            color: #968DF3;
        }

        .step.done {
            background-color: #968DF3;
            border-color: #968DF3;
            color: white;
        }

        .step.done:before {
            background-color: #968DF3;
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
                                <span class="badge badge-light-primary">{{ __('messages.ADD') }}
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

                            <div id="steps">
                                <div class="step active step1" data-desc="{{ __('messages.CampaignSocialMedia') }}">1</div>
                                <div class="step step2" data-desc="{{ __('messages.ImportantNotes') }}">2</div>
                                <div class="step step3" data-desc="{{ __('messages.CampaignGoal') }}">3</div>
                                <div class="step step4" data-desc="{{ __('messages.CampaignContent') }}">4</div>
                                <div class="step step5" data-desc="{{ __('messages.CampaignMedia') }}">5</div>
                                <div class="step step6" data-desc="{{ __('messages.DurationBudget') }}">6</div>
                                <div class="step step7" data-desc="{{ __('messages.DemographicLocation') }}">7</div>
                                <div class="step step8" data-desc="{{ __('messages.Summary') }}">8</div>
                            </div>

                            <form action="{{ route('save.ads') }}" method="post" id="adForm"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ isset($record) ? $record->id : 0 }}">
                                <div class="loading-overlay" id="loader">
                                    <dotlottie-player
                                        src="https://lottie.host/0b9fb8be-cfaf-467c-bb48-dd461b508487/l8zI4IHnpj.lottie"
                                        background="transparent" speed="1" style="width: 300px; height: 300px" loop
                                        autoplay></dotlottie-player>
                                </div>
                                <div class="row">
                                    @if (isset($ai_sugguested) && $ai_sugguested == 1)
                                        <div class="col-md-12" style="text-align: right">
                                            <button type="button" class="btn btn-secondary btn-sm" id="suggestAi"><i
                                                    class="fa-solid fa-robot"></i>
                                                {{ __('messages.NeedHelpWithContent') }}</button>
                                        </div>
                                    @endif
                                    <div class="col-md-12 steps" id="step1">
                                        <div class="step-heading">
                                            <h2>{{ __('messages.ChooseYourMedia') }}</h2>
                                            @if (isset($ai_sugguested) && $ai_sugguested == 1)
                                                <h4 class="ai-suggestion">(<i class="fa-solid fa-robot"></i>
                                                    {{ __('messages.AISuggested') }} {{ $social_media }})</h4>
                                            @endif
                                        </div>
                                        <ul id="imageRadio">
                                            <li><input type="radio" name="social_media" disabled value="facebook"
                                                    id="facebook" />
                                                <label for="facebook"> <i class="fab fa-facebook"></i> </label>
                                            </li>
                                            <li><input type="radio" name="social_media"
                                                    @if (isset($social_media)) @if (strtolower($social_media) == 'tiktok') checked @endif
                                                @else checked @endif value="tiktok" id="tiktok"
                                                />
                                                <label for="tiktok"><i class="fab fa-tiktok"></i></label>
                                            </li>
                                            <li><input type="radio" name="social_media" disabled value="twitter"
                                                    id="twitter" />
                                                <label for="twitter"><i class="fab fa-twitter"></i></label>
                                            </li>
                                            <li><input type="radio" name="social_media" disabled value="google"
                                                    id="google" />
                                                <label for="google"><i class="fab fa-google"></i></label>
                                            </li>
                                            <li><input type="radio" name="social_media"
                                                    @if (isset($social_media)) @if (strtolower($social_media) == 'snapchat') checked @endif
                                                @else @endif value="snapchat" id="snapchat" />
                                                <label for="snapchat"><i class="fab fa-snapchat"></i></label>
                                            </li>

                                        </ul>
                                    </div>

                                    <div class="col-md-12 steps" id="step2">
                                        <div class="important-note">
                                            <div class="note-header">
                                                <div class="note-heading">
                                                    <i class="fa fa-bell"></i>
                                                    <h2>{{ __('messages.IMPORTANTNOTE') }}</h2>
                                                </div>
                                                <p><strong>{{ __('messages.Content') }}</strong></p>
                                            </div>
                                            <div class="note-content">
                                                <ol>
                                                    <li>{{ __('messages.Promotion') }}</li>
                                                    <li>{{ __('messages.Offensive') }}</li>
                                                    <li>{{ __('messages.IllegalActivities') }}</li>
                                                    <li>{{ __('messages.Medicines') }}</li>
                                                </ol>
                                            </div>
                                            <p class="note-warning">
                                                {{ __('messages.Warning') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-12 steps" id="step3">
                                        <div class="step-heading">
                                            <h2>{{ __('messages.Goal') }}</h2>
                                        </div>

                                        <ul id="imageRadio">
                                            <li class='tiktok_goal'><input
                                                    @if (isset($goal)) @if ($goal == 'TRAFFIC') checked @endif
                                                @else @endif type="radio" name="goal"
                                                value="TRAFFIC" id="tk1" />
                                                <label for="tk1"> <img
                                                        src="{{ asset('front/images/cost-per-click.png') }}"
                                                        alt="">
                                                    <h4>{{ __('messages.WebsiteTraffic') }}</h4>
                                                    <p>{{ __('messages.GetMoreWebsiteVisits') }}</p>
                                                </label>
                                            </li>
                                            <li class='tiktok_goal'><input
                                                    @if (isset($goal)) @if ($goal == 'LEAD_GENERATION') checked @endif
                                                @else @endif type="radio" name="goal"
                                                value="LEAD_GENERATION" id="tk2" />
                                                <label for="tk2"> <img
                                                        src="{{ asset('front/images/video-chat.png') }}" alt="">
                                                    <h4>{{ __('messages.Reach') }}</h4>
                                                    <p>{{ __('messages.IncreaseTheOverallReach') }}</p>
                                                </label>
                                            </li>

                                            <li class='snapchat_goal'><input
                                                    @if (isset($goal)) @if ($goal == 'WEB_CONVERSION') checked @endif
                                                @else @endif type="radio" name="goal"
                                                value="WEB_CONVERSION" id="sc1" />
                                                <label for="sc1"> <img
                                                        src="{{ asset('front/images/cost-per-click.png') }}"
                                                        alt="">
                                                    <h4>{{ __('messages.WebsiteTraffic') }}</h4>
                                                    <p>{{ __('messages.GetMoreWebsiteVisits') }}</p>
                                                </label>
                                            </li>
                                            <li class='snapchat_goal'><input
                                                    @if (isset($goal)) @if ($goal == 'ENGAGEMENT') checked @endif
                                                @else @endif type="radio" name="goal"
                                                value="ENGAGEMENT" id="sc2" />
                                                <label for="sc2"> <img
                                                        src="{{ asset('front/images/video-chat.png') }}" alt="">
                                                    <h4>{{ __('messages.Reach') }}</h4>
                                                    <p>{{ __('messages.IncreaseTheOverallReach') }}</p>
                                                </label>
                                            </li>

                                            <li class='snapchat_goal'><input
                                                    @if (isset($goal)) @if ($goal == 'BRAND_AWARENESS') checked @endif
                                                @else @endif type="radio" name="goal"
                                                value="BRAND_AWARENESS " id="sc3" />
                                                <label for="sc3"> <img src="{{ asset('front/images/web.png') }}"
                                                        alt="">
                                                    <h4>{{ __('messages.BrandPromotion') }}</h4>
                                                    <p>{{ __('messages.IncreaseBrandAwareness') }}</p>
                                                </label>
                                            </li>

                                        </ul>
                                    </div>

                                    <div class="col-md-12 steps" id="step4">
                                        <div class="step-heading">
                                            <h2>{{ __('messages.ChooseYourContent') }}</h2>
                                        </div>
                                        <div class="titleRow row">
                                            <div class="form-group col-md-12">
                                                <label for="campaigName">{{ __('messages.CampaignTitle') }}</label>
                                                <input id="campaigName" name="campaigName" value="{{ $campaignName }}"
                                                    type="text" readonly class="form-control">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="title">{{ __('messages.Title') }} @if (isset($ai_sugguested) && $ai_sugguested == 1) <small
                                                            class="ai-suggestion">(<i class="fa-solid fa-robot"></i>
                                                            {{ __('messages.AISuggested') }} )</small> @endif
                                                </label>
                                                <input id="title" name="title"
                                                    @if (isset($name)) value="{{ $name }}" @endif
                                                    type="text" class="form-control">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="description">{{ __('messages.Description') }} @if (isset($ai_sugguested) && $ai_sugguested == 1) <small
                                                            class="ai-suggestion">(<i class="fa-solid fa-robot"></i>
                                                            {{ __('messages.AISuggested') }} )</small> @endif
                                                </label>
                                                <textarea name="description" class="form-control" cols="30" rows="10" id="description"> @if (isset($name)){{ $description }}@endif</textarea>
                                            </div>
                                            <div class="form-group col-md-6" id="callTOActionArea">
                                                <label for="call_to_action">{{ __('messages.CallToAction') }}</label>
                                                <select name="call_to_action" id="call_to_action" class="form-control">
                                                    <option class="tiktok"
                                                        @if (isset($call_to_action)) @if ($call_to_action == 'BOOK_NOW') selected @endif
                                                    @else selected @endif
                                                        value="BOOK_NOW">{{ __('messages.BookNow') }}</option>
                                                    <option class="tiktok"
                                                        @if (isset($call_to_action)) @if ($call_to_action == 'CONTACT_US') selected @endif
                                                    @else @endif
                                                        value="CONTACT_US">{{ __('messages.ContactUs') }}</option>
                                                    <option class="tiktok"
                                                        @if (isset($call_to_action)) @if ($call_to_action == 'APPLY_NOW') selected @endif
                                                    @else @endif
                                                        value="APPLY_NOW">{{ __('messages.ApplyNow') }}</option>
                                                    <option class="tiktok"
                                                        @if (isset($call_to_action)) @if ($call_to_action == 'CALL_NOW') selected @endif
                                                    @else @endif
                                                        value="CALL_NOW">{{ __('messages.CallNow') }}</option>
                                                    <option class="tiktok"
                                                        @if (isset($call_to_action)) @if ($call_to_action == 'LEARN_MORE') selected @endif
                                                    @else @endif
                                                        value="LEARN_MORE">{{ __('messages.LearnMore') }}</option>
                                                    <option class="tiktok"
                                                        @if (isset($call_to_action)) @if ($call_to_action == 'READ_MORE') selected @endif
                                                    @else @endif
                                                        value="READ_MORE">{{ __('messages.ReadMore') }}</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6" id="websiteUrlArea">
                                                <label for="website_url">{{ __('messages.WebsiteUrl') }}</label>
                                                <input id="website_url" name="website_url"
                                                    @if (isset($website_url)) value="{{ $website_url }}" @endif
                                                    type="text" required class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12 steps" id="step5">
                                        <div class="step-heading">
                                            <h2>{{ __('messages.UploadMedia') }}</h2>
                                        </div>
                                        <div class="titleRow">

                                            <div class="form-group col-md-12 text-center">
                                                <div id="mediaArea" class="mb-2">
                                                    @if (isset($media) && isset($media_type))
                                                        @if ($media_type == '1')
                                                            <img src="{{ asset($media) }}" height="200">
                                                        @else
                                                            <video width="320" height="240" controls>
                                                                <source src="{{ asset($media) }}" type="video/mp4">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        @endif
                                                    @endif
                                                </div>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#imageModal">
                                                    <i class="fa fa-image"></i> Choose Media
                                                </button>
                                                <input type="hidden" id="selectedMedia" name="media"
                                                    value="{{ isset($media) ? $media : '' }}">
                                                <input type="hidden" id="selectedType" name="media_type"
                                                    value="{{ isset($media_type) ? $media_type : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 steps" id="step6">
                                        <div class="step-heading">
                                            <h2>{{ __('messages.ChooseDurationBudget') }}</h2>
                                        </div>
                                        <div class="titleRow row">
                                            <div class="col-md-12">
                                                <ul class="budgetTab">
                                                    <li>
                                                        <a class="btn budgetTypeActive" data-id="customBudget">Custom
                                                            Budget</a>
                                                    </li>
                                                    <li>
                                                        <a class="btn" data-id="recommendedBudget">Recommended
                                                            Budget</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-12">
                                                <div id="customBudget" class="budgetType">
                                                    <div class="form-group">
                                                        <label for="dates">
                                                            {{ __('messages.ScheduleDates') }}
                                                            @if (isset($ai_sugguested) && $ai_sugguested == 1)
                                                                <small class="ai-suggestion">(<i
                                                                        class="fa-solid fa-robot"></i>
                                                                    {{ __('messages.AISuggested') }})</small>
                                                            @endif
                                                        </label>
                                                        <input id="dates" name="dates" type="text"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="budget">
                                                            {{ __('messages.Budget') }}
                                                            @if (isset($ai_sugguested) && $ai_sugguested == 1)
                                                                <small class="ai-suggestion">(<i
                                                                        class="fa-solid fa-robot"></i>
                                                                    {{ __('messages.AISuggested') }})</small>
                                                            @endif
                                                        </label>
                                                        <input id="budget" name="budget"
                                                            @if (isset($budget)) value="{{ $budget }}" @endif
                                                            type="number" class="form-control">
                                                    </div>
                                                </div>
                                                <div id="recommendedBudget" class="budgetType">
                                                    <div class="form-group">
                                                        <label for="dates">
                                                            {{ __('messages.ScheduleDates') }}
                                                        </label>
                                                        <div class="button-group-pills recommended_dates text-center"
                                                            data-toggle="buttons">
                                                            <label class="btn btn-default active">
                                                                <input type="radio" name="recommended_dates"
                                                                    value="{{ date('Y-m-d h:m A') }} - {{ date('Y-m-d h:m A', strtotime('+7 days')) }}"
                                                                    checked="">
                                                                <div>1 Weeks</div>
                                                            </label>
                                                            <label class="btn btn-default">
                                                                <input type="radio" name="recommended_dates"
                                                                    value="{{ date('Y-m-d h:m A') }} - {{ date('Y-m-d h:m A', strtotime('+15 days')) }}">
                                                                <div>2 Weeks</div>
                                                            </label>
                                                            <label class="btn btn-default">
                                                                <input type="radio" name="recommended_dates"
                                                                    value="{{ date('Y-m-d h:m A') }} - {{ date('Y-m-d h:m A', strtotime('+21 days')) }}">
                                                                <div>3 Weeks</div>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="dates">
                                                            {{ __('messages.Budget') }}
                                                        </label>
                                                        <div class="button-group-pills recommended_budget text-center"
                                                            data-toggle="buttons">
                                                            <label class="btn btn-default active">
                                                                <input type="radio" name="recommended_budget"
                                                                    value="200" checked="">
                                                                <div>
                                                                    <h4>200 SAR</h4>
                                                                    <hr> {{ __('messages.MinBudget') }}
                                                                </div>
                                                            </label>
                                                            <label class="btn btn-default">
                                                                <input type="radio" name="recommended_budget"
                                                                    value="450">
                                                                <div>
                                                                    <h4>450 SAR</h4>
                                                                    <hr> {{ __('messages.MidBudget') }}
                                                                </div>
                                                            </label>
                                                            <label class="btn btn-default">
                                                                <input type="radio" name="recommended_budget"
                                                                    value="750">
                                                                <div>
                                                                    <h4>750 SAR</h4>
                                                                    <hr> {{ __('messages.MaxBudget') }}
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12 steps" id="step7">
                                        <div class="step-heading">
                                            <h2>{{ __('messages.ChooseDemographic&Location') }}</h2>
                                        </div>
                                        <div class="titleRow row">
                                            <div class="col-md-12">
                                                <div class="mb-2 col-md-12">
                                                    <label for="language">{{ __('messages.Language') }} </label><br>
                                                    <br>
                                                    <label for="english">
                                                        <input type="checkbox" name="language[]"
                                                            @if (isset($language) && in_array('english', $language)) checked @endif
                                                            value="english"> English
                                                    </label>
                                                    <br>
                                                    <label for="english">
                                                        <input type="checkbox" name="language[]"
                                                            @if (isset($language) && in_array('arabic', $language)) checked @endif
                                                            value="arabic"> عربي
                                                    </label>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="gender">{{ __('messages.Gender') }} @if (isset($ai_sugguested) && $ai_sugguested == 1) <small
                                                                class="ai-suggestion">(<i class="fa-solid fa-robot"></i>
                                                                {{ __('messages.AISuggested') }})</small> @endif
                                                    </label>
                                                    <select name="gender" id="gender" class="form-control">
                                                        <option @if (isset($gender) && strtolower($gender) == 'male') selected @else @endif
                                                            value="Male">{{ __('messages.Male') }}</option>
                                                        <option @if (isset($gender) && strtolower($gender) == 'female') selected @else @endif
                                                            value="Female">{{ __('messages.Female') }}</option>
                                                        <option @if (isset($gender) && strtolower($gender) == 'both') selected @else @endif
                                                            value="Both">{{ __('messages.Both') }}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="age_group">{{ __('messages.AgeGroup') }} @if (isset($ai_sugguested) && $ai_sugguested == 1) <small
                                                                class="ai-suggestion">(<i class="fa-solid fa-robot"></i>
                                                                {{ __('messages.AISuggested') }})</small> @endif
                                                    </label>
                                                    <select name="age_group" id="age_group" class="form-control">
                                                        <option @if (isset($age) && strtolower($age) == '18') selected @else @endif
                                                            value="18">{{ __('messages.MaxAge18') }}</option>
                                                        <option @if (isset($age) && strtolower($age) == '30') selected @else @endif
                                                            value="30">{{ __('messages.MaxAge30') }}</option>
                                                        <option @if (isset($age) && strtolower($age) == '0') selected @else @endif
                                                            value="0">{{ __('messages.AnyAge') }}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="location">{{ __('messages.Locations') }}</label>
                                                    <select name="location" id="locationSelect"
                                                        class="form-control select2">
                                                        <option value="">{{ __('messages.SelectCountry') }}</option>
                                                        <option value="SA" selected>{{ __('messages.SaudiArabia') }}
                                                        </option>
                                                        <option value="AE">{{ __('messages.UnitedArabEmirates') }}
                                                        </option>
                                                        <option value="QA">{{ __('messages.Qatar') }}</option>
                                                        <option value="BH">{{ __('messages.Bahrain') }}</option>
                                                        <option value="KW">{{ __('messages.Kuwait') }}</option>
                                                        <option value="OM">{{ __('messages.Oman') }}</option>
                                                        <option value="YE">{{ __('messages.Yemen') }}</option>
                                                        <option value="IQ">{{ __('messages.Iraq') }}</option>
                                                        <option value="SY">{{ __('messages.Syria') }}</option>
                                                        <option value="LB">{{ __('messages.Lebanon') }}</option>
                                                        <option value="JO">{{ __('messages.Jordan') }}</option>
                                                        <option value="PS">{{ __('messages.Palestine') }}</option>
                                                        <option value="EG">{{ __('messages.Egypt') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-4">
                                                <div id="map" style="height: 300px; margin-top: 20px;"></div>
                                            </div> --}}
                                        </div>
                                    </div>

                                    <div class="col-md-12 steps" id="step8">
                                        <div class="step-heading">
                                            <h2>{{ __('messages.SummaryAds') }}</h2>
                                        </div>
                                        <div class="titleRow row">
                                            <div class="col-md-8 right-side">
                                                <div class="card">
                                                    <h3>{{ __('messages.AdCreativity') }}</h3>
                                                    <div id="mediaValue"></div>
                                                </div>

                                                <div class="card">
                                                    <h3>{{ __('messages.CampaignDetails') }}</h3>
                                                    <p><strong>{{ __('messages.CampaignType') }}:</strong> <span
                                                            id="goalValue"></span></p>
                                                    <p><strong>{{ __('messages.CurrentBalance') }}:</strong>
                                                        {{ $campaignName }}</p>
                                                </div>

                                                <div class="card">
                                                    <h3>{{ __('messages.Audience') }}</h3>
                                                    <p><strong>{{ __('messages.Locations') }}:</strong> <span
                                                            id="locationValue"></span></p>
                                                    <p><strong>{{ __('messages.Language') }}:</strong> <span
                                                            id="languageValue"></span></p>
                                                    <p><strong>{{ __('messages.Gender') }}:</strong> <span
                                                            id="genderValue"></span></p>
                                                    <p><strong>{{ __('messages.AgeGroup') }}:</strong> <span
                                                            id="age_groupValue"></span></p>
                                                </div>
                                            </div>

                                            <div class="col-md-4 left-side">
                                                <div class="wallet">
                                                    <p>{{ __('messages.CurrentBalance') }}</p>
                                                    <h2>{{Auth::user()->getWallet()}} SAR</h2>
                                                </div>

                                                <div class="card">
                                                    <h3>{{ __('messages.CampaignSummary') }}</h3>
                                                    <p><strong>{{ __('messages.Duration') }}:</strong> <span
                                                            id="datesValue"></span></p>
                                                    <p><strong>{{ __('messages.DailyBudget') }}:</strong> <span
                                                            id="dailybudgetValue"></span></p>
                                                    <p><strong>{{ __('messages.TotalBudget') }}:</strong> <span
                                                            id="budgetValue"></span></p>
                                                    <p><strong>{{ __('messages.VAT') }} {{$setting->tax}}% :</strong> <span
                                                            id="VatValue"></span></p>
                                                    <hr>
                                                    <h4><strong>{{ __('messages.Total') }}:</strong> <span
                                                            id="totalValue"></span></h4>
                                                </div>

                                                <div class="card">
                                                    <h3>{{ __('messages.EstimatedCampaignPerformance') }}</h3>
                                                    <p><strong>{{ __('messages.Reach') }}:</strong> <span
                                                            id="reach"></span></p>
                                                    <p><strong>{{ __('messages.IMPRESSION') }}:</strong> <span
                                                            id="impression"></span></p>
                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <input type="hidden" name="step" value="1" id="stepNo">
                                <input type="hidden" name="walletDeduct" value="0" id="walletDeduct">
                                <div class="form-group col-md-12 text-center">
                                    <hr>
                                    <button type="button" class="btn btn-secondary prev"><i
                                            class="fa fa-arrow-left"></i>
                                        {{ __('messages.Back') }}</button>
                                    <button type="button" class="btn btn-info" id="saveDraft"><i
                                            class="fa fa-save"></i>
                                        {{ __('messages.SAVE_AND_CLOSE') }}</button>
                                    <button type="button" class="btn btn-dark next" id="nextButton"><i
                                            class="fa fa-arrow-right"></i>
                                        {{ __('messages.Next') }}</button>
                                    <button type="button" class="btn btn-primary createAd"><i
                                            class="fa fa-check"></i> {{ __('messages.CreateAd') }}</button>
                                    <button type="button" id="topUpButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#popupModal">
                                        <i class="fa fa-dollar"></i> {{ __('messages.Top_Up') }} <span id="remaingAmount"></span>
                                    </button>

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

    
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="imageForm">
                    <div class="modal-header">
                        <div class="row" style="width:100%">
                            <div class="col-md-6">
                                <h4 class="modal-title" id="imageModalLabel">{{ __('messages.ChooseYourMedia') }}
                                </h4>
                            </div>
                            <div class="col-md-6" style="text-align: right"><a href="{{ route('add.media') }}"
                                    class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i>
                                    {{ __('messages.UploadMedia') }}</a></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            @foreach ($medias as $val)
                                <?php
                                    $checked = '';
                                    if(isset($media) && isset($media_type)) {
                                        if($media == $val->media && $media_type == ($val->media_type == 'image' ? 1 : 0)){
                                            $checked = 'checked';
                                        }
                                    }
                                ?>

                                @if ($val->media_type == 'image')
                                    <div class="col-4">
                                        <label class="image-radio">
                                            <input type="radio" name="image" value="{{ $val->media }}"
                                                data-path="{{ asset($val->media) }}"
                                                data-type="{{ $val->media_type }}" {{$checked}}>
                                            <img src="{{ asset($val->media) }}" alt="{{ $val->name }}">
                                            {{ $val->getImageSize() }}
                                        </label>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <label class="image-radio">
                                            <input type="radio" name="image" value="{{ $val->media }}"
                                                data-path="{{ asset($val->media) }}"
                                                data-type="{{ $val->media_type }}" {{$checked}}>
                                            <video width="320" height="240" controls>
                                                <source src="{{ asset($val->media) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">{{ __('messages.Select') }}</button>
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.Cancel') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
     <script>
        $(document).ready(function() {
            $('.image-radio').on('click', function() {
                $('.image-radio input[type="radio"]').prop('checked', false);
                $('.image-radio').removeClass('checked');

                const input = $(this).find('input[type="radio"]');
                input.prop('checked', true);
                $(this).addClass('checked');
            });

            $('#imageForm').on('submit', function(e) {
                e.preventDefault();
                const selected = $('input[name="image"]:checked').val();
                const selectedType = $('input[name="image"]:checked').attr('data-type');
                const selectedpath = $('input[name="image"]:checked').attr('data-path');
                if (selected) {
                    $('#selectedMedia').val(selected);
                    $('#selectedType').val(selectedType == 'image' ? 1 : 0);
                    renderMedia(selectedType, selectedpath)
                    $('#imageModal').modal('hide');
                } else {
                    alert('Please select an image.');
                }
            });


            function renderMedia(mediaType, mediaSrc) {
                let html = '';

                if (mediaType === 'video') {
                    html = `
                        <video width="320" height="240" controls>
                            <source src="${mediaSrc}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    `;
                } else if (mediaType === 'image') {
                    html = `<img src="${mediaSrc}" alt="Media" height="200">`;
                }

                $('#mediaArea').html(html);
            }
        });
    </script>


    <script>
        function fillSpansFromSerialized(serializedStr) {
            getReachImpression();
            const countryNames = {
                "SA": "{{ __('messages.SaudiArabia') }}",
                "AE": "{{ __('messages.UnitedArabEmirates') }}",
                "QA": "{{ __('messages.Qatar') }}",
                "BH": "{{ __('messages.Bahrain') }}",
                "KW": "{{ __('messages.Kuwait') }}",
                "OM": "{{ __('messages.Oman') }}",
                "YE": "{{ __('messages.Yemen') }}",
                "IQ": "{{ __('messages.Iraq') }}",
                "SY": "{{ __('messages.Syria') }}",
                "LB": "{{ __('messages.Lebanon') }}",
                "JO": "{{ __('messages.Jordan') }}",
                "PS": "{{ __('messages.Palestine') }}",
                "EG": "{{ __('messages.Egypt') }}"
            };

            const ageGroup = {
                "18": "{{ __('messages.MaxAge18') }}",
                "30": "{{ __('messages.MaxAge30') }}",
                "0": "{{ __('messages.AnyAge') }}",

            };

            const params = new URLSearchParams(serializedStr);

            for (const [key, value] of params.entries()) {
                const cleanKey = key.replace(/\[\]$/, '');
                const span = $(`#${cleanKey}Value`);
                var spanValue = decodeURIComponent(value.replace(/\+/g, ' ')).toUpperCase();

                if (cleanKey == 'location') {
                    locationValue = countryNames[spanValue] || spanValue;
                    span.text(locationValue);
                } else if (cleanKey == 'age_group') {

                    age_group = ageGroup[spanValue] || spanValue;
                    span.text(age_group);

                } else if (cleanKey == 'media') {
                  
                        const selectedType = $('input[name="image"]:checked').attr('data-type');
                        const selectedpath = $('input[name="image"]:checked').attr('data-path');

                    mediahtml = fetchMediaContent(selectedType, selectedpath)
                    span.html(mediahtml)

                } else if (cleanKey == 'dates') {
                    var dates = formatDatesForPreview(decodeURIComponent(value.replace(/\+/g, ' ')))
                    span.text(dates);
                } else if (cleanKey == 'language') {
                    let selectedLanguages = [];

                    $('input[name="language[]"]:checked').each(function() {
                        selectedLanguages.push($(this).val());
                    });

                    span.text(selectedLanguages.join(', '));
                } else {
                    span.text(spanValue);
                }

            }

            calculateDailyBudget();
        }

        function fetchMediaContent(selectedType, selectedpath) {
            let mediahtml = '';

            if (selectedType === 'video') {
                mediahtml = `
                    <video width="320" height="240" controls>
                        <source src="${selectedpath}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                `;
            } else if (selectedType === 'image') {
                mediahtml = `<img src="${selectedpath}" alt="Media" height="200">`;
            }

            return mediahtml;
        }

        function formatDatesForPreview(date) {
            const [startRaw, endRaw] = date.split(' - ');

            const startDate = new Date(startRaw);
            const endDate = new Date(endRaw);

            const options = {
                day: 'numeric',
                month: 'short'
            };
            const formattedStart = startDate.toLocaleDateString('en-US', options);
            const formattedEnd = endDate.toLocaleDateString('en-US', options);
            const year = endDate.getFullYear();

            const formattedRange = `${formattedStart} - ${formattedEnd}, ${year}`;
            return formattedRange;
        }

        let maintotal = 0;
        const wallet = {{Auth::user()->wallet}};
        $("#topUpButton").hide();

        function calculateDailyBudget() {
            const dateRange = $('input[name="dates"]').val();
            const budget = parseFloat($('input[name="budget"]').val());
            const vat = {{$setting->tax}};

            const [startStr, endStr] = dateRange.split(' - ');

            const startDate = new Date(startStr);
            const endDate = new Date(endStr);

            const timeDiff = Math.abs(endDate - startDate);
            const days = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

            const dailyBudget = Number(days > 0 ? (budget / days).toFixed(2) : budget);

            const vatRate = parseInt(vat)/100;
            const vatAmount = budget * vatRate;
            maintotal = budget + (budget * vatRate);
            $('#dailybudgetValue').text(dailyBudget.toFixed(2) + ' SAR');
            $('#budgetValue').text(budget.toFixed(2) + ' SAR');
            $('#VatValue').text(vatAmount.toFixed(2) + ' SAR');
            $("#totalValue").text(maintotal.toFixed(2) + ' SAR');
            $("#walletDeduct").val(maintotal);
            if(maintotal > wallet){
                $(".createAd").hide();
                $("#topUpButton").show();
                $("#remaingAmount").text((parseInt(maintotal) - parseFloat(wallet)).toFixed(2) + ' SAR')
            } else{
                $(".createAd").show();
                $("#topUpButton").hide();
            }
        }

        $("#topUpButton").click(function(){
            var walletTopUP =(parseInt(maintotal) - parseFloat(wallet));
            if(walletTopUP > 0){
                $("#walletTopUpAmount").val(walletTopUP);
            }
        })

        $('input[name="dates"]').daterangepicker({
            autoApply: true,
            timePicker: true,
            startDate: moment().add(1, 'days'),
            endDate: moment().add({{ $days + 1 }}, 'days'),
            minDate: moment().add(1, 'days'),
            locale: {
                format: 'YYYY-MM-DD hh:mm A'
            },
        });
        $('.steps').hide();
        $('#step1').show();

        var stepCount = {{ isset($step_count) ? $step_count : 1 }};

        function showStep() {
            $(".step").removeClass('active');
            $(".steps").hide();
            $("#step" + stepCount).show();
            $(".step" + stepCount).addClass('active');
        }

        var finalCount = 8;
        $(".createAd").hide();

        if (stepCount === 1) {
            $(".prev").hide();
        }

        if (stepCount === finalCount) {
            $(".next").hide();
            $(".createAd").show();
        }

        $("#stepNo").val(stepCount);
        showStep();

        $(".next").click(function() {
            $(".alert").hide();
            $(".prev").show();
            ++stepCount;
            if (stepCount === finalCount) {
                $(this).hide();
                $(".createAd").show();
                var formData = $("#adForm").serialize();
                fillSpansFromSerialized(formData);
            }
            showStep();
            $("#stepNo").val(stepCount);
            updateStepProgress();
        });

        $(".prev").click(function() {
            $(".createAd").hide();
            $(".next").show();
            --stepCount;
            showStep();
            if (stepCount === 1) {
                $(this).hide();
            }
            $("#stepNo").val(stepCount);
            updateStepProgress();
        });

        var mediaType = 'image'

        $("#media_type").change(function() {
            if ($(this).val() == 1) {
                $("#media_image").show();
                $("#media_video").hide();
            } else {
                $("#media_image").hide();
                $("#media_video").show();
            }
        })
        $("input[name='social_media']").change();
        $("input[name='social_media']").change(function() {
            // $("#call_to_action option").hide();
            var currentSocialMedia = $("input[name='social_media']:checked").val()
            if (currentSocialMedia == 'snapchat') {
                $("#callTOActionArea").hide();
                $("#websiteUrlArea").removeClass("col-md-6");
                $("#websiteUrlArea").addClass("col-md-12");
            } else if (currentSocialMedia == 'tiktok') {
                $(".tiktok").show();
                $("#callTOActionArea").show();
                $("#websiteUrlArea").addClass("col-md-6");
                $("#websiteUrlArea").removeClass("col-md-12");
            }
        })

        $("#media_type").change();

        $("#step1 input").change(function() {
            var currentVal = $("#step1 input:checked").val();
            $("#step3 ul li").hide();
            if (currentVal == 'tiktok') {
                $(".tiktok_goal").show();
            } else if (currentVal == 'snapchat') {
                $(".snapchat_goal").show();
            }
        })

        $("#step1 input").change();

        $("#saveDraft").click(function() {
            saveDraft();
        })

        function saveDraft() {
            var formData = $("#adForm").serialize();
            $.ajax({
                url: '{{ route('save.draft') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    window.location.href = "{{ route('view.ads') }}"
                },
                error: function(xhr) {
                    // console.log('Error:', xhr.responseText);
                }
            });
        }

        function getReachImpression() {
            $("#reach").text('Calculating...');
            $("#impression").text('Calculating...');
            var formData = $("#adForm").serialize();
            $.ajax({
                url: '{{ route('getReachImpression.ads') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $("#reach").text(response[0]);
                    $("#impression").text(response[1]);
                },
                error: function(xhr) {
                    // console.log('Error:', xhr.responseText);
                }
            });
        }

        $(".alert").hide();
        $(".createAd").click(function() {
            $("#loader").addClass("is-active");
            $(".alert").hide();
            var formData = $("#adForm").serialize();
            $.ajax({
                url: '{{ route('save.ads') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $("#loader").removeClass("is-active");

                    response = JSON.parse(response);
                    if (response[0] == 200) {
                        $("#success").show();
                        $("#successMessage").text(response[1]);
                        setTimeout(() => {
                            window.location.href = "{{ route('view.ads') }}"
                        }, 2000);
                    } else {
                        let error = response[1].error.error.error;
                        $("#error").show();
                        $("#errorMessage").text(error)
                    }
                },
                error: function(xhr) {
                    $("#loader").removeClass("is-active");
                    $("#error").show();
                    $("#errorMessage").text(xhr.responseText)
                }
            });
        })

        @if (isset($title) && isset($ai_sugguested) && $ai_sugguested == 1)
            $(".ai-suggestion").hide();
            $("#suggestAi").click(function() {
                $(".ai-suggestion").show();

                // $("#title").val('{{ $name }}')
                // $("#description").val('{{ $description }}')

                type(0, $("#title"), "<?= $name ?>");
                type(0, $("#description"), "<?= $description ?>");
                $("#budget").val('{{ $budget }}')
                $("#age_group").val('{{ strtolower($age) }}')
                $("#gender").val('{{ strtolower($gender) }}')
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

        $(".budgetType").hide();
        $("#customBudget").show();
        $(".budgetTab a").click(function() {
            $(".budgetTab a").toggleClass('budgetTypeActive');
            $(this).addClass("budgetTypeActive")
            var id = $(this).attr('data-id');
            $(".budgetType").hide();
            $("#" + id).show();
        });

        $(".recommended_budget label").click(function() {
            $(".recommended_budget label").removeClass("active");
            $(this).addClass("active");
        });

        $(".recommended_dates label").click(function() {
            $(".recommended_dates label").removeClass("active");
            $(this).addClass("active");
        });

        $('#locationSelect').on('change', function() {
            let code = $(this).val();
            alert(code);
            $("#map").html(
                '<iframewidth="100%"height="400"style="border:0"loading="lazy"allowfullscreensrc="https://www.google.com/maps?q=' +
                code + '&output=embed"></iframe>')
        });

        $('input[name="recommended_dates"]').change();
        $('input[name="recommended_budget"]').change();
        $(document).on('change', 'input[name="recommended_dates"]', function() {
            const selectedValue = $(this).val();
            $('input[name="dates"]').val(selectedValue);
        });

        $(document).on('change', 'input[name="recommended_budget"]', function() {
            const selectedValue = $(this).val();
            $('input[name="budget"]').val(selectedValue);
        });


        var formData = $("#adForm").serialize();
        fillSpansFromSerialized(formData);

        function updateStepProgress() {
            $('.step').each(function(index, element) {
                // element == this
                $(element).not('.active').addClass('done');

                if ($(this).is('.active')) {
                    return false;
                }
            });
        }

        updateStepProgress();
    </script>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
@endsection
