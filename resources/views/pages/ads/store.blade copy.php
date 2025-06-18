@extends('admin.layouts.master')

@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        #map {
            height: 500px;
        }

        #map2 {
            height: 500px;
        }

        .card {
            /* background: linear-gradient(linear-gradient(to right, #1487b3, #38afc3)) !important; */

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
            border-radius: 12px;
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
            border: 1px solid #1487b3;

        }

        #imageRadio :checked+label:before {
            content: "✓";
            background-color: #5BBE25;
            transform: scale(1);
        }

        #imageRadio :checked+label i {
            transform: scale(0.9);
            z-index: -1;
            /* color: #1487b3; */
            color: white
        }

        #imageRadio label i {
            color: #1487b3;
            /* Color for icons */
        }

        #imageRadio label:hover {
            border: 1px solid #1487b3;
            /* Change border color on hover */
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
            background: linear-gradient(to right, #1487b3, #38afc3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
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
            border: 2px solid #1487b3;
            color: white;
            border-radius: 10px;
        }

        .budgetTypeActive {
            /* background-color: #968DF3 !important; */
            background: linear-gradient(to right, #1487b3, #38afc3) !important;
            color: white !important;
            border-color: #1487b3 !important;

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
            border-color: #1487b3;
            color: white
                /* background-color: #FFF; */
                /* color: #968DF3; */
                /* background: linear-gradient(to right, #1487b3, #38afc3);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    -webkit-background-clip: text;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    -webkit-text-fill-color: transparent; */

        }

        .button-group-pills .btn.active {
            border-color: #1487b3;
            /* background-color: #968DF3; */
            background: linear-gradient(to right, #1487b3, #38afc3);
            color: #FFF;
            box-shadow: none;
        }

        .button-group-pills .btn:hover {
            border-color: #1487b3;

            /* background-color: rgb(139, 129, 253); */
            background: linear-gradient(to right, #1487b3, #38afc3);
            color: #FFF;
        }

        .recommended_budget label {
            height: 150px;
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
            color: white;
        }


        .card {
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
            /* background: linear-gradient(135deg, #968DF3, #968DF3); */
            background: linear-gradient(to right, #1487b3, #38afc3);

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
            /* background: whitesmoke; */
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
            border-color: transparent;
            border-radius: 50%;
            color: #1487b3;
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
            background-color: white;
            transform: translate(-95px, 21px);
            content: "";
        }

        .step:after {
            width: 150px;
            display: block;
            transform: translate(-55px, 3px);
            color: white;
            content: attr(data-desc);
            font-weight: 400;
            font-size: 13px;
        }

        .step:first-child:after {
            transform: translate(-55px, -1px);
        }

        .step.active {
            border-color: #1487b3;

            /* color: #968DF3; */
            color: #1487b3
        }


        .step.active:before {
            /* background: linear-gradient(to right, #58bb58 0%, #73b5e8 100%); */
            background: linear-gradient(to right, #1487b3 0%, #38afc3 100%);

        }

        .step.active:after {
            color: #1487b3;
        }

        .step.done {
            /* background-color: #968DF3; */
            background: linear-gradient(to right, #1487b3, #38afc3);

            border-color: #1487b3;

            color: white;
        }

        .card1 {
            /* background: linear-gradient(to right, #1487b3, #38afc3) !important; */
            background: linear-gradient(to right, #102840, #0d1a2f) !important;
            color: white !important;
        }

        .step.done:before {
            /* background-color: #968DF3; */
            background: linear-gradient(to right, #1487b3, #38afc3);


        }


        option {
            /* background-color: transparent; */
            /* or your page background */

            color: #000;
            /* change if needed */
        }

        label {
            color: white
        }
    </style>
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">

        {{-- @dd($data) --}}
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">
                                <span class="badge badge-light-primary">{{ __('messages.ADD') }}
                                    {{ $title ?? '' }}
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
                                <div class="step step3" data-desc="{{ __('messages.Objective') }}">3</div>
                                <div class="step step4" data-desc="{{ __('messages.Ad-design') }}">4</div>
                                {{-- <div class="step step5" data-desc="{{ __('messages.CampaignMedia') }}">5</div> --}}
                                <div class="step step5" data-desc="{{ __('messages.DemographicLocation') }}">5</div>
                                <div class="step step6" data-desc="{{ __('messages.DurationBudget') }}">6</div>
                                <div class="step step7" data-desc="{{ __('messages.Summary') }}">7</div>
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
                                            {{-- @dump($social_media) --}}
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
                                            <h2>{{ __('messages.objective') }}</h2>
                                        </div>

                                        <ul id="imageRadio">
                                            {{-- TikTok Goals --}}
                                            <style>
                                                #imageRadio li.tiktok_goal,
                                                #imageRadio li.tiktok_objective,
                                                #imageRadio li.snapchat_goal {
                                                    /* dark card background */
                                                    color: #fff;
                                                    border-radius: 12px;
                                                    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
                                                    transition: 0.3s ease;
                                                    cursor: pointer;
                                                    position: relative;
                                                }
                                            </style>
                                            <li class='tiktok_goal'>
                                                <input class="text-white" type="radio" name="objective"
                                                    value="Awareness & engagement" id="tk1"
                                                    @if (isset($objective) && $objective == 'Awareness & engagement') checked @endif />
                                                <label for="tk1">
                                                    <h4 class="text-white">🧠 <span>Awareness & Engagement</span></h4>
                                                    <p class="text-white">Boost brand visibility and user interaction</p>
                                                </label>
                                            </li>

                                            <li class='tiktok_goal'>
                                                <input class="text-white" type="radio" name="objective"
                                                    value="TRAFFIC" id="tk2"
                                                    @if (isset($objective) && $objective == 'TRAFFIC') checked @endif />
                                                <label for="tk2">
                                                    <h4 class="text-white">🚦 <span>Traffic</span></h4>
                                                    <p class="text-white">Increase website visits and link clicks</p>
                                                </label>
                                            </li>

                                            <li class='tiktok_goal'>
                                                <input class="text-white" type="radio" name="objective" value="Leads"
                                                    id="tk3" @if (isset($objective) && $objective == 'Leads') checked @endif />
                                                <label for="tk3">
                                                    <h4 class="text-white">📝 <span>Leads</span></h4>
                                                    <p class="text-white">Generate interest and collect customer info</p>
                                                </label>
                                            </li>

                                            <li class='tiktok_goal'>
                                                <input class="text-white" type="radio" name="objective"
                                                    value="App promotion" id="tk4"
                                                    @if (isset($objective) && $objective == 'App promotion') checked @endif />
                                                <label for="tk4">
                                                    <h4 class="text-white">📱 <span>App Promotion</span></h4>
                                                    <p class="text-white">Boost downloads and app usage</p>
                                                </label>
                                            </li>

                                            <li class='tiktok_goal'>
                                                <input class="text-white" type="radio" name="objective" value="Sales"
                                                    id="tk5" @if (isset($objective) && $objective == 'Sales') checked @endif />
                                                <label for="tk5">
                                                    <h4 class="text-white">💰 <span>Sales</span></h4>
                                                    <p class="text-white">Drive product purchases and conversions</p>
                                                </label>
                                            </li>

                                            {{-- Snapchat Goals --}}
                                            {{-- <li class='snapchat_goal'>
                                                <input class="text-white" type="radio" name="goal"
                                                    value="WEB_CONVERSION" id="sc1"
                                                    @if (isset($goal) && $goal == 'WEB_CONVERSION') checked @endif />
                                                <label for="sc1">
                                                    <img src="{{ asset('front/images/cost-per-click.png') }}"
                                                        alt="">
                                                    <h4 class="text-white">🖱️ {{ __('messages.WebsiteTraffic') }}</h4>
                                                    <p class="text-white">{{ __('messages.GetMoreWebsiteVisits') }}</p>
                                                </label>
                                            </li> --}}
                                            {{--  <li class='snapchat_goal'>
                                                <input class="text-white" type="radio" name="goal" value="Reach"
                                                    id="sc1" @if (isset($goal) && $goal == 'Reach') checked @endif />
                                                <label for="sc1">
                                                    <h4 class="text-white">💰 <span> Reach</span></h4>

                                                    <p class="text-white">Awareness</p>
                                                </label>
                                            </li>

                                            <li class='snapchat_goal'>
                                                <input class="text-white" type="radio" name="goal" value="Trafic"
                                                    id="sc2" @if (isset($goal) && $goal == 'Trafic') checked @endif />
                                                <label for="sc2">
                                                    <h4 class="text-white">💬Trafic </h4>
                                                    <p class="text-white">Consideration</p>
                                                </label>
                                            </li>

                                            <li class='snapchat_goal'>
                                                <input class="text-white" type="radio" name="goal"
                                                    value="Video Views" id="sc3"
                                                    @if (isset($goal) && $goal == 'Video Views') checked @endif />
                                                <label for="sc3">
                                                    <h4 class="text-white">📢Video Views </h4>
                                                    <p class="text-white">Consideration</p>
                                                </label>
                                            </li>

                                            <li class='snapchat_goal'><input class="text-white"
                                                    @if (isset($goal)) @if ($goal == 'Community Interaction') checked @endif
                                                @else @endif type="radio" name="goal"
                                                value="Community Interaction" id="sc4" />
                                                <label for="sc4">
                                                    <h4 class="text-white">Community Interaction</h4>
                                                    <p class="text-white">Consideration</p>
                                                </label>
                                            </li>
                                            <li class='snapchat_goal'><input class="text-white"
                                                    @if (isset($goal)) @if ($goal == 'App Promotion') checked @endif
                                                @else @endif type="radio" name="goal"
                                                value="App Promotion" id="sc2" />
                                                <label for="sc2">
                                                    <h4 class="text-white">App Promotion</h4>
                                                    <p class="text-white">conversion</p>
                                                </label>
                                            </li>

                                            <li class='snapchat_goal'><input class="text-white"
                                                    @if (isset($goal)) @if ($goal == 'Lead Generation') checked @endif
                                                @else @endif type="radio" name="goal"
                                                value="Lead Generation " id="sc3" />
                                                <label for="sc3">
                                                    <h4 class="text-white">Lead Generation</h4>
                                                    <p class="text-white">conversion</p>
                                                </label>
                                            </li>
                                            <li class='snapchat_goal'><input class="text-white"
                                                    @if (isset($goal)) @if ($goal == 'Sales') checked @endif
                                                @else @endif type="radio" name="goal"
                                                value="Sales " id="sc3" />

                                                <h4 class="text-white">Sales</h4>
                                                <p class="text-white">conversion</p>
                                                </label>
                                            </li> --}}


                                            <li class='snapchat_goal'>
                                                <input class="text-white" type="radio" name="goal" value="Reach"
                                                    id="sc1" @if (isset($goal) && $goal == 'Reach') checked @endif />
                                                <label for="sc1">
                                                    <h4 class="text-white">📣 <span>Reach</span></h4>
                                                    <p class="text-white">Awareness</p>
                                                </label>
                                            </li>

                                            <li class='snapchat_goal'>
                                                <input class="text-white" type="radio" name="goal" value="Trafic"
                                                    id="sc2" @if (isset($goal) && $goal == 'Trafic') checked @endif />
                                                <label for="sc2">
                                                    <h4 class="text-white">🚦 <span>Trafic</span></h4>
                                                    <p class="text-white">Consideration</p>
                                                </label>
                                            </li>

                                            <li class='snapchat_goal'>
                                                <input class="text-white" type="radio" name="goal"
                                                    value="Video Views" id="sc3"
                                                    @if (isset($goal) && $goal == 'Video Views') checked @endif />
                                                <label for="sc3">
                                                    <h4 class="text-white">🎬 <span>Video Views</span></h4>
                                                    <p class="text-white">Consideration</p>
                                                </label>
                                            </li>

                                            <li class='snapchat_goal'>
                                                <input class="text-white" type="radio" name="goal"
                                                    value="Community Interaction" id="sc4"
                                                    @if (isset($goal) && $goal == 'Community Interaction') checked @endif />
                                                <label for="sc4">
                                                    <h4 class="text-white">🤝 <span>Community Interaction</span></h4>
                                                    <p class="text-white">Consideration</p>
                                                </label>
                                            </li>

                                            <li class='snapchat_goal'>
                                                <input class="text-white" type="radio" name="goal"
                                                    value="App Promotion" id="sc2"
                                                    @if (isset($goal) && $goal == 'App Promotion') checked @endif />
                                                <label for="sc2">
                                                    <h4 class="text-white">📱 <span>App Promotion</span></h4>
                                                    <p class="text-white">Conversion</p>
                                                </label>
                                            </li>

                                            <li class='snapchat_goal'>
                                                <input class="text-white" type="radio" name="goal"
                                                    value="Lead Generation" id="sc3"
                                                    @if (isset($goal) && $goal == 'Lead Generation') checked @endif />
                                                <label for="sc3">
                                                    <h4 class="text-white">📝 <span>Lead Generation</span></h4>
                                                    <p class="text-white">Conversion</p>
                                                </label>
                                            </li>

                                            <li class='snapchat_goal'>
                                                <input class="text-white" type="radio" name="goal" value="Sales"
                                                    id="sc3" @if (isset($goal) && $goal == 'Sales') checked @endif />
                                                <label for="sc3">
                                                    <h4 class="text-white">💳 <span>Sales</span></h4>
                                                    <p class="text-white">Conversion</p>
                                                </label>
                                            </li>

                                        </ul>
                                    </div>

                                    {{-- <div class="col-md-12 steps" id="step3">
                                        <div class="step-heading">
                                            <h2>{{ __('messages.Goal') }}</h2>
                                        </div>

                                        <ul id="imageRadio">
                                            <li class='tiktok_goal'><input class="text-white"
                                                    @if (isset($goal)) @if ($goal == 'TRAFFIC') checked @endif
                                                @else @endif type="radio" name="goal"
                                                value="TRAFFIC" id="tk1" />
                                                <label for="tk1"> <img
                                                        src="{{ asset('front/images/cost-per-click.png') }}"
                                                        alt="">
                                                    <h4 class="text-white">{{ __('messages.WebsiteTraffic') }}</h4>
                                                    <p>{{ __('messages.GetMoreWebsiteVisits') }}</p>
                                                </label>
                                            </li>
                                            <li class='tiktok_goal'><input class="text-white"
                                                    @if (isset($goal)) @if ($goal == 'LEAD_GENERATION') checked @endif
                                                @else @endif type="radio" name="goal"
                                                value="LEAD_GENERATION" id="tk2" />
                                                <label for="tk2"> <img
                                                        src="{{ asset('front/images/video-chat.png') }}" alt="">
                                                    <h4 class="text-white">{{ __('messages.Reach') }}</h4>
                                                    <p>{{ __('messages.IncreaseTheOverallReach') }}</p>
                                                </label>
                                            </li>

                                            <li class='snapchat_goal'><input class="text-white"
                                                    @if (isset($goal)) @if ($goal == 'WEB_CONVERSION') checked @endif
                                                @else @endif type="radio" name="goal"
                                                value="WEB_CONVERSION" id="sc1" />
                                                <label for="sc1"> <img
                                                        src="{{ asset('front/images/cost-per-click.png') }}"
                                                        alt="">
                                                    <h4 class="text-white">{{ __('messages.WebsiteTraffic') }}</h4>
                                                    <p>{{ __('messages.GetMoreWebsiteVisits') }}</p>
                                                </label>
                                            </li>
                                            <li class='snapchat_goal'><input class="text-white"
                                                    @if (isset($goal)) @if ($goal == 'ENGAGEMENT') checked @endif
                                                @else @endif type="radio" name="goal"
                                                value="ENGAGEMENT" id="sc2" />
                                                <label for="sc2"> <img
                                                        src="{{ asset('front/images/video-chat.png') }}" alt="">
                                                    <h4 class="text-white">{{ __('messages.Reach') }}</h4>
                                                    <p>{{ __('messages.IncreaseTheOverallReach') }}</p>
                                                </label>
                                            </li>

                                            <li class='snapchat_goal'><input class="text-white"
                                                    @if (isset($goal)) @if ($goal == 'BRAND_AWARENESS') checked @endif
                                                @else @endif type="radio" name="goal"
                                                value="BRAND_AWARENESS " id="sc3" />
                                                <label for="sc3"> <img src="{{ asset('front/images/web.png') }}"
                                                        alt="">
                                                    <h4 class="text-white">{{ __('messages.BrandPromotion') }}</h4>
                                                    <p>{{ __('messages.IncreaseBrandAwareness') }}</p>
                                                </label>
                                            </li>

                                        </ul>
                                    </div> --}}

                                    <div class="col-md-12 steps" id="step4">
                                        <div class="step-heading">
                                            <h2>{{ __('messages.Startbuilding') }}
                                                <span
                                                    style="background: none; -webkit-background-clip: initial; -webkit-text-fill-color: black;">💪</span>
                                            </h2>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-section">

                                                    <!-- Tab Contents -->
                                                    <span class="text-white">Double check everything for
                                                        maximum
                                                        impact</span>
                                                    <label for="campaign-name " class="fw-bold text-white">What do you
                                                        want to
                                                        name this campaign?</label>
                                                    <input id="campaigName" name="campaigName"
                                                        value="{{ $campaignName }}" type="text" readonly
                                                        class="form-control">


                                                    <div class="snapchat-pixel d-flex justify-content-between my-2">
                                                        <span class="fw-bold text-white">Use snap chat Pixel</span>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox"
                                                                role="switch" id="flexSwitchCheckDefault">
                                                        </div>

                                                    </div>
                                                    <hr style="border-color: white;">

                                                    <label class="text-white">Choose your ad goal</label>
                                                    <!-- Toggle Tabs -->
                                                    <ul class="nav nav-pills justify-content-center mb-4 pricing-tab"
                                                        id="pricingTab" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link active primary-btn " id="monthly-tab"
                                                                data-bs-toggle="pill" data-bs-target="#monthly"
                                                                type="button" role="tab">Impression</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link btn-primary primary-btn"
                                                                id="annual-tab" data-bs-toggle="pill"
                                                                data-bs-target="#annual" type="button"
                                                                role="tab">CLicks</button>
                                                        </li>


                                                    </ul>
                                                    <hr style="border-color: white;">
                                                    <div class="d-flex justify-content-start align-items-center mb-3">
                                                        <h6 class="ad-title mb-0 text-white">Boost your ad</h6>
                                                        <span class="ms-2  text-white">USD Up to 2 add
                                                            setup</span>
                                                    </div>
                                                    <div class="input-wrapper border p-3 rounded">

                                                        <div class="btn-group d-flex gap-2" role="group"
                                                            aria-label="Button group">
                                                            <button type="button" class="btn border p-2 text-white">
                                                                <i class="fas fa-edit"></i> Add Set 1
                                                            </button>
                                                            <button type="button" class="btn border p-2 text-white">
                                                                <i class="fas fa-plus"></i> Add New
                                                            </button>
                                                        </div>



                                                        <div class="snapchat-pixel d-flex justify-content-between my-2">
                                                            <span class="fw-bold text-white">Use Snapchat Public
                                                                Profile</span>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    role="switch" id="flexSwitchCheckDefault">
                                                            </div>

                                                        </div>
                                                        <hr style="border-color: white;">

                                                        <!-- brand input -->
                                                        <div class="mb-3">

                                                            <label for="brand-name ">Brand Name</label>

                                                            <input id="title" name="title"
                                                                value="{{ !empty($name) ? $name : $title ?? '' }}"
                                                                type="text" class="form-control mb-3">

                                                            <div class="brand-alert d-flex justify-content-end">
                                                                <span style="margin-top: -10px;">0/30</span>
                                                            </div>
                                                        </div>


                                                        <!-- description input -->
                                                        <div class="mb-3">
                                                            <label for="ad-description">Ad - Short Description</label>
                                                            <input type="text" class="form-control mb-3"
                                                                id="ad-description" placeholder="Enter Description"
                                                                value="{{ $description ?? '' }}" />
                                                            <div
                                                                class="discription-alert-item d-flex justify-content-between m-0 p-0">
                                                                <span
                                                                    style="color:#00aaff ; margin-top: -10px;">Rephrase</span>
                                                                <span style=" margin-top: -10px;">0/30</span>
                                                            </div>
                                                        </div>



                                                        <!-- file upload -->
                                                        <div
                                                            class="attachment-preview mb-3 d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <p class="text-white mb-0">whbc0clgv-anfbfyu9n6na.png
                                                                </p>
                                                                <span class="text-white">(2.3 MB)</span>
                                                            </div>
                                                            <button type="button"
                                                                class="btn btn-sm btn-link text-white p-0 ms-3">
                                                                <i class="fas fa-times"></i> <!-- Font Awesome icon -->
                                                            </button>
                                                        </div>


                                                        <hr class="w-100">
                                                        <!-- attachment title -->
                                                        <div class="mb-3">
                                                            {{-- <label for="attachment-title"
                                                                class="form-label fw-bold">Attachment</label>
                                                            <span class="text-white" style="margin-top: -10px;">Add an
                                                                Attachment for a more enginering add</span>
                                                            <div class="attachment-details mb-3 d-flex justify-content-center align-items-center border border-white"
                                                                style="height: 40px;">
                                                                <span id="websiteTrigger" class="text-white"
                                                                    style="cursor: pointer;">Website</span>
                                                            </div> --}}

                                                            <h2 class="text-white">Select a Social Media Platform</h2>

                                                            <label for="social-platform">Choose a platform:</label>
                                                            <select id="social-platform" class="form-control"
                                                                name="social_platform_name">
                                                                <option value="">-- Select Platform --</option>
                                                                <option value="facebook">Facebook</option>
                                                                <option value="twitter">Twitter (X)</option>
                                                                <option value="instagram">Instagram</option>
                                                                <option value="linkedin">LinkedIn</option>
                                                                <option value="youtube">YouTube</option>
                                                                <option value="tiktok">TikTok</option>
                                                                <option value="snapchat">Snapchat</option>
                                                                <option value="pinterest">Pinterest</option>
                                                                <option value="threads">Threads</option>
                                                                <option value="reddit">Reddit</option>
                                                                <option value="whatsapp">WhatsApp</option>
                                                                <option value="telegram">Telegram</option>
                                                            </select>


                                                        </div>

                                                        <div class="field mb-3" id="url-field">
                                                            <label for="platform-url">Enter Profile/Page URL:</label>
                                                            <input type="url" id="platform-url" class="form-control"
                                                                placeholder="https://example.com/yourprofile" />
                                                            {{-- <button onclick="savePlatform()">Save</button> --}}
                                                        </div>


                                                        <!-- vanity url -->
                                                        <div class="mb-3">
                                                            <label for="website_url"
                                                                class="text-white">{{ __('messages.WebsiteUrl') }}</label>

                                                            <div class="input-group mb-3">

                                                                <span class="input-group-text primary-btn   "
                                                                    id="basic-addon3">https://</span>

                                                                <input id="website_url" name="website_url"
                                                                    @if (isset($website_url)) value="{{ $website_url }}" @endif
                                                                    type="text" required class="form-control"
                                                                    aria-describedby="basic-addon3">

                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12" id="callTOActionArea">
                                                            <label
                                                                for="call_to_action">{{ __('messages.CallToAction') }}</label>
                                                            <select name="call_to_action" id="call_to_action"
                                                                class="form-control text-white">
                                                                <option class="tiktok"
                                                                    @if (isset($call_to_action)) @if ($call_to_action == 'BOOK_NOW') selected @endif
                                                                @else selected @endif
                                                                    value="BOOK_NOW">{{ __('messages.BookNow') }}</option>
                                                                <option class="tiktok"
                                                                    @if (isset($call_to_action)) @if ($call_to_action == 'CONTACT_US') selected @endif
                                                                @else @endif
                                                                    value="CONTACT_US">{{ __('messages.ContactUs') }}
                                                                </option>
                                                                <option class="tiktok"
                                                                    @if (isset($call_to_action)) @if ($call_to_action == 'APPLY_NOW') selected @endif
                                                                @else @endif
                                                                    value="APPLY_NOW">{{ __('messages.ApplyNow') }}
                                                                </option>
                                                                <option class="tiktok"
                                                                    @if (isset($call_to_action)) @if ($call_to_action == 'CALL_NOW') selected @endif
                                                                @else @endif
                                                                    value="CALL_NOW">{{ __('messages.CallNow') }}</option>
                                                                <option class="tiktok"
                                                                    @if (isset($call_to_action)) @if ($call_to_action == 'LEARN_MORE') selected @endif
                                                                @else @endif
                                                                    value="LEARN_MORE">{{ __('messages.LearnMore') }}
                                                                </option>
                                                                <option class="tiktok"
                                                                    @if (isset($call_to_action)) @if ($call_to_action == 'READ_MORE') selected @endif
                                                                @else @endif
                                                                    value="READ_MORE">{{ __('messages.ReadMore') }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="preview-section">
                                                    <h3>Ad Preview</h3>
                                                    <img src="https://via.placeholder.com/200x400?text=Ad+Preview"
                                                        alt="Ad Preview" class="img-fluid rounded mb-3" />
                                                    <div class="button-more btn btn-outline-primary w-100">More</div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="attachment-title"
                                                        class="form-label fw-bold">Attachment</label>
                                                    <span class="text-white" style="margin-top: -10px;">Add an
                                                        Attachment for a more enginering add</span>
                                                    <div class="attachment-details mb-3 d-flex justify-content-center align-items-center border border-white"
                                                        style="height: 40px;">
                                                        <span id="websiteTrigger" class="text-white"
                                                            style="cursor: pointer;">Website</span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- <div class="col-md-12 steps" id="step5">
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

                                                <button id="openMediaModal" class="btn btn-primary primary-btn">
                                                    <i class="fa fa-image"></i> Open Media Modal
                                                </button>

                                                <input type="hidden" id="selectedMedia" name="media"
                                                    value="{{ isset($media) ? $media : '' }}">
                                                <input type="hidden" id="selectedType" name="media_type"
                                                    value="{{ isset($media_type) ? $media_type : '' }}">
                                            </div>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-md-12 steps" id="step5">
                                        <div class="step-heading">
                                            <h2>{{ __('messages.ChooseDemographic&Location') }}</h2>
                                        </div>
                                        <div class="titleRow row">
                                            <div class="col-md-12">
                                                <div class="mb-2 col-md-12">
                                                    <label for="language"
                                                        class="text-white">{{ __('messages.Language') }}
                                                    </label><br>
                                                    <br>
                                                    <label for="english" class="text-white">
                                                        <input type="checkbox" class="text-white" name="language[]"
                                                            @if (isset($language) && in_array('english', $language)) checked @endif
                                                            value="english">
                                                        English
                                                    </label>
                                                    <br>
                                                    <label for="english" class="text-white">
                                                        <input type="checkbox" class="text-white" name="language[]"
                                                            @if (isset($language) && in_array('arabic', $language)) checked @endif
                                                            value="arabic">
                                                        عربي
                                                    </label>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="gender" class="text-white">{{ __('messages.Gender') }}
                                                        @if (isset($ai_sugguested) && $ai_sugguested == 1)
                                                            <small class="ai-suggestion">(<i
                                                                    class="fa-solid fa-robot"></i>
                                                                {{ __('messages.AISuggested') }})</small>
                                                        @endif
                                                    </label>
                                                    <select name="gender" id="gender"
                                                        class="form-control form-select">
                                                        <option @if (isset($gender) && strtolower($gender) == 'male') selected @else @endif
                                                            value="Male">{{ __('messages.Male') }}</option>
                                                        <option @if (isset($gender) && strtolower($gender) == 'female') selected @else @endif
                                                            value="Female">{{ __('messages.Female') }}</option>
                                                        <option @if (isset($gender) && strtolower($gender) == 'both') selected @else @endif
                                                            value="Both">{{ __('messages.Both') }}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="age_group"
                                                        class="text-white">{{ __('messages.AgeGroup') }}
                                                        @if (isset($ai_sugguested) && $ai_sugguested == 1)
                                                            <small class="ai-suggestion">(<i
                                                                    class="fa-solid fa-robot"></i>
                                                                {{ __('messages.AISuggested') }})</small>
                                                        @endif
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
                                                        <option value="">{{ __('messages.SelectCountry') }}
                                                        </option>
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

                                        </div>
                                    </div> --}}
                                    <div class="col-md-12 steps" id="step5">
                                        <div class="step-heading">
                                            <h2>{{ __('messages.ChooseDemographic&Location') }}</h2>
                                        </div>

                                        <div class="titleRow row">
                                            <!-- Sidebar: col-md-8 -->
                                            <div class="col-md-8">
                                                <h4 class="mb-4 text-white">Audience Page</h4>

                                                <!-- Location -->
                                                <div class="mb-3 row">
                                                    <label>Country</label>
                                                    <div>
                                                        <select class="form-select" id="country-select">
                                                            <option value="">Select Country</option>
                                                            <option value="saudi">Saudi Arabia</option>
                                                            <option value="usa">United States</option>
                                                            <option value="india">India</option>
                                                            <option value="uk">United Kingdom</option>
                                                            <option value="uae">United Arab Emirates</option>
                                                            <option value="pakistan">Pakistan</option>
                                                            <option value="canada">Canada</option>
                                                            <option value="germany">Germany</option>
                                                            <option value="france">France</option>
                                                            <option value="australia">Australia</option>
                                                            <option value="japan">Japan</option>
                                                            <option value="south_korea">South Korea</option>
                                                            <option value="china">China</option>
                                                            <option value="turkey">Turkey</option>
                                                            <option value="egypt">Egypt</option>
                                                            <option value="south_africa">South Africa</option>
                                                            <option value="brazil">Brazil</option>
                                                            <option value="mexico">Mexico</option>
                                                            <option value="spain">Spain</option>
                                                            <option value="italy">Italy</option>
                                                            <option value="russia">Russia</option>
                                                            <option value="indonesia">Indonesia</option>
                                                            <option value="thailand">Thailand</option>
                                                            <option value="vietnam">Vietnam</option>
                                                            <option value="nigeria">Nigeria</option>
                                                            <option value="kenya">Kenya</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- State -->
                                                <div class="mb-3 row">
                                                    <label>State</label>
                                                    <div>
                                                        <select class="form-select form-control" id="state-select"
                                                            disabled>
                                                            <option value="">-- Select State/City --</option>
                                                        </select>
                                                    </div>

                                                </div>

                                                <!-- Age -->
                                                <div class="mb-3 row">
                                                    <label>Age</label>
                                                    @php
                                                        $ageRanges = [
                                                            'All',
                                                            '13-17',
                                                            '18-24',
                                                            '25-34',
                                                            '35-44',
                                                            '45-54',
                                                            '55+',
                                                        ];
                                                    @endphp
                                                    <div class="col-sm-9 d-flex flex-wrap" id="age-buttons">

                                                        @foreach ($ageRanges as $range)
                                                            <div class="select-button1 {{ isset($age) && $age === $range ? 'active' : '' }}"
                                                                data-value="{{ $range }}">
                                                                {{ $range }}
                                                            </div>
                                                        @endforeach

                                                        <input type="hidden" name="age" id="selected-age"
                                                            value="{{ $age ?? 'All' }}">
                                                    </div>
                                                    {{-- <div class="col-sm-9 d-flex flex-wrap" id="age-buttons">
                                                        <div class="select-button1 active" data-value="All">All</div>
                                                        <div class="select-button1" data-value="13-17">13-17</div>
                                                        <div class="select-button1" data-value="18-24">18-24</div>
                                                        <div class="select-button1" data-value="25-34">25-34</div>
                                                        <div class="select-button1" data-value="35-44">35-44</div>
                                                        <div class="select-button1" data-value="45-54">45-54</div>
                                                        <div class="select-button1" data-value="55+">55+</div>
                                                    </div> --}}
                                                </div>

                                                <!-- Gender -->
                                                <div class="mb-3 row">
                                                    <label>Gender</label>
                                                    <div class="col-sm-9 d-flex flex-wrap" id="gender-buttons">
                                                        <div class="select-button1 active" data-value="All">All</div>
                                                        <div class="select-button1" data-value="Male">Male</div>
                                                        <div class="select-button1" data-value="Female">Female</div>
                                                    </div>
                                                </div>


                                                <!-- Languages -->
                                                <div class="mb-3 row">
                                                    <label>Languages</label>
                                                    <div>
                                                        <select class="form-select" id="language-select">
                                                            <option value="">Select Language</option>
                                                            @foreach ($Languages as $lang)
                                                                <option value="{{ $lang }}"
                                                                    {{ isset($language) && $language == $lang ? 'selected' : '' }}>
                                                                    {{ ucfirst($lang) }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>

                                                <!-- Spending Power -->
                                                <div class="mb-3 row">
                                                    <label>Spending Power</label>
                                                    <div class="col-sm-9 d-flex flex-wrap" id="spending-buttons">
                                                        <div class="select-button1 active" data-value="All">All</div>
                                                        <div class="select-button1" data-value="High Spending">High
                                                            Spending</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Right Content: col-md-4 -->
                                            <div class="col-md-4">


                                                <div id="audience-panel" class="panel">
                                                    <h4>Available Audience</h4>
                                                    <p><strong id="audience-range" class="text-white">32,563,000 –
                                                            39,800,000</strong></p>
                                                    <p style="font-size: 14px; color: white;">
                                                        Due to data security requirements, your estimated available audience
                                                        doesn’t include anyone
                                                        under 18 years of
                                                        age.
                                                    </p>
                                                </div>

                                                <button class="btn btn-primary w-100"
                                                    onclick="submitAudience()">Continue</button>
                                            </div>
                                        </div>
                                        {{-- <div class="titleRow row">
                                            <div class="col-md-12">
                                                <div class="mb-2 col-md-12">
                                                    <label for="language"
                                                        class="text-white">{{ __('messages.Language') }}
                                                    </label><br>
                                                    <br>
                                                    <label for="english" class="text-white">
                                                        <input type="checkbox" class="text-white" name="language[]"
                                                            @if (isset($language) && in_array('english', $language)) checked @endif
                                                            value="english">
                                                        English
                                                    </label>
                                                    <br>
                                                    <label for="english" class="text-white">
                                                        <input type="checkbox" class="text-white" name="language[]"
                                                            @if (isset($language) && in_array('arabic', $language)) checked @endif
                                                            value="arabic">
                                                        عربي
                                                    </label>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="gender" class="text-white">{{ __('messages.Gender') }}
                                                        @if (isset($ai_sugguested) && $ai_sugguested == 1)
                                                            <small class="ai-suggestion">(<i
                                                                    class="fa-solid fa-robot"></i>
                                                                {{ __('messages.AISuggested') }})</small>
                                                        @endif
                                                    </label>
                                                    <select name="gender" id="gender"
                                                        class="form-control form-select">
                                                        <option @if (isset($gender) && strtolower($gender) == 'male') selected @else @endif
                                                            value="Male">{{ __('messages.Male') }}</option>
                                                        <option @if (isset($gender) && strtolower($gender) == 'female') selected @else @endif
                                                            value="Female">{{ __('messages.Female') }}</option>
                                                        <option @if (isset($gender) && strtolower($gender) == 'both') selected @else @endif
                                                            value="Both">{{ __('messages.Both') }}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="age_group"
                                                        class="text-white">{{ __('messages.AgeGroup') }}
                                                        @if (isset($ai_sugguested) && $ai_sugguested == 1)
                                                            <small class="ai-suggestion">(<i
                                                                    class="fa-solid fa-robot"></i>
                                                                {{ __('messages.AISuggested') }})</small>
                                                        @endif
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
                                                        <option value="">{{ __('messages.SelectCountry') }}
                                                        </option>
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

                                        </div> --}}
                                    </div>

                                    <div class="col-md-12 steps" id="step6">
                                        <div class="step-heading">
                                            <h2>{{ __('messages.ChooseDurationBudget') }}</h2>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="titleRow row">
                                                    <div class="col-md-12">
                                                        <ul class="budgetTab">
                                                            <li>
                                                                <a class="btn budgetTypeActive"
                                                                    data-id="recommendedBudget">Recommended
                                                                    Budget</a>
                                                            </li>
                                                            <li>
                                                                <a class="btn " data-id="customBudget">Custom
                                                                    Budget</a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div id="customBudget" class="budgetType">
                                                            <div class="form-group col-md-12">
                                                                <label for="budget" class="text-white">
                                                                    {{ __('messages.Budget') }}
                                                                    @if (isset($ai_sugguested) && $ai_sugguested == 1)
                                                                        <small class="ai-suggestion">(<i
                                                                                class="fa-solid fa-robot"></i>
                                                                            {{ __('messages.AISuggested') }})</small>
                                                                    @endif
                                                                </label>

                                                                <p class="text-white my-2"> you can set your budget
                                                                    <span class="text-success">{{ $budget }}
                                                                        SAR</span>
                                                                </p>

                                                                @php
                                                                    $min = null;
                                                                    $max = null;

                                                                    if (!empty($budget)) {
                                                                        if (strpos($budget, '-') !== false) {
                                                                            [$min, $max] = explode('-', $budget);
                                                                        } else {
                                                                            $min = $budget;
                                                                            $max = ''; // Leave max open (optional)
                                                                        }
                                                                    }
                                                                @endphp


                                                                <input id="budget" name="budget"
                                                                    @if (isset($budget)) value="{{ $min }}" @endif
                                                                    type="number" class="form-control"
                                                                    min="{{ $min }}"
                                                                    {{ $max !== '' ? "max=$max" : '' }}
                                                                    value="{{ old('min_budget', $min) }}">

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="dates">
                                                                    {{ __('messages.ScheduleDates') }}
                                                                    @if (isset($ai_sugguested) && $ai_sugguested == 1)
                                                                        <small class="ai-suggestion">(<i
                                                                                class="fa-solid fa-robot"></i>
                                                                            {{ __('messages.AISuggested') }})</small>
                                                                    @endif
                                                                </label>

                                                                {{-- @php
                                                                    $combinedDates = $start_date . ' to ' . $end_date;
                                                                @endphp
                                                                {{-- @dd($combinedDates) --}}

                                                                {{-- <input id="dates" name="dates" type="text"
                                                                    class="form-control" value="{{ $combinedDates }}"> --}}

                                                                <div class="form-group col-md-12">
                                                                    <label class="text-white" for="campaign_start"> Start
                                                                        Date</label>
                                                                    <input type="date" class="form-control"
                                                                        name="start_date" {{ $start_date }}
                                                                        id="campaign_start" required>
                                                                </div>

                                                                <div class="form-group col-md-12">
                                                                    <label class="text-white" for="campaign_end">
                                                                        End Date</label>
                                                                    <input type="date" class="form-control"
                                                                        name="end_date" value="{{ $end_date }}"
                                                                        id="campaign_end" required>
                                                                </div>

                                                                {{-- <input id="dates" name="dates" type="text"
                                                                    class="form-control"> --}}
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
                                                                    <div class="row g-2 justify-content-center">
                                                                        <div class="col-12 col-sm-4">
                                                                            <label
                                                                                class="btn btn-outline-primary w-100 {{ old('recommended_budget', '150') == '150' ? 'active' : '' }}">
                                                                                <input type="radio"
                                                                                    name="recommended_budget"
                                                                                    value="150" autocomplete="off"
                                                                                    {{ old('recommended_budget', '150') == '150' ? 'checked' : '' }}>
                                                                                <div>
                                                                                    <h4 class="mb-1">150 SAR</h4>
                                                                                    <hr class="my-1">
                                                                                    {{ __('messages.MinBudget') }}
                                                                                </div>
                                                                            </label>
                                                                        </div>

                                                                        <div class="col-12 col-sm-4">
                                                                            <label
                                                                                class="btn btn-outline-primary w-100 {{ old('recommended_budget') == '400' ? 'active' : '' }}">
                                                                                <input type="radio"
                                                                                    name="recommended_budget"
                                                                                    value="400" autocomplete="off"
                                                                                    {{ old('recommended_budget') == '400' ? 'checked' : '' }}>
                                                                                <div>
                                                                                    <h4 class="mb-1">400 SAR</h4>
                                                                                    <hr class="my-1">
                                                                                    {{ __('messages.MidBudget') }}
                                                                                </div>
                                                                            </label>
                                                                        </div>

                                                                        <div class="col-12 col-sm-4">
                                                                            <label
                                                                                class="btn btn-outline-primary w-100 {{ old('recommended_budget') == '700' ? 'active' : '' }}">
                                                                                <input type="radio"
                                                                                    name="recommended_budget"
                                                                                    value="700" autocomplete="off"
                                                                                    {{ old('recommended_budget') == '700' ? 'checked' : '' }}>
                                                                                <div>
                                                                                    <h4 class="mb-1">700 SAR</h4>
                                                                                    <hr class="my-1">
                                                                                    {{ __('messages.MaxBudget') }}
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe,
                                                        debitis minus repudiandae quam voluptatibus provident est velit
                                                        porro praesentium, hic ut beatae aliquam voluptate odit, sed
                                                        inventore cupiditate esse nulla.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-md-12 steps" id="step7">
                                        <div class="step-heading">
                                            <h2>{{ __('messages.SummaryAds') }}</h2>
                                        </div>
                                        <div class="titleRow row">
                                            <div class="col-md-8 right-side">
                                                <div class="card card1">
                                                    <h3>{{ __('messages.AdCreativity') }}</h3>
                                                    <div id="mediaValue"></div>
                                                </div>

                                                <div class="card card1">
                                                    <h3>{{ __('messages.CampaignDetails') }}</h3>
                                                    <p><strong>{{ __('messages.CampaignType') }}:</strong> <span
                                                            id="goalValue"></span></p>
                                                    <p><strong>{{ __('messages.CurrentBalance') }}:</strong>
                                                        {{ $campaignName }}</p>
                                                </div>

                                                <div class="card card1">
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
                                                    <h2>00 SAR</h2>
                                                </div>

                                                <div class="card card1">
                                                    <h3 class="text-white">{{ __('messages.CampaignSummary') }}</h3>
                                                    <p><strong>{{ __('messages.Duration') }}:</strong> <span
                                                            id="datesValue"></span></p>
                                                    <p><strong>{{ __('messages.DailyBudget') }}:</strong> <span
                                                            id="dailybudgetValue"></span> SAR</p>
                                                    <p><strong>{{ __('messages.TotalBudget') }}:</strong> <span
                                                            id="budgetValue"></span> SAR</p>
                                                </div>

                                                <div class="card card1">
                                                    <h3 class="text-white">
                                                        {{ __('messages.EstimatedCampaignPerformance') }}</h3>
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
                                <div class="form-group col-md-12 text-center">
                                    <hr>
                                    <button type="button" class="btn btn-secondary prev"><i
                                            class="fa fa-arrow-left"></i>
                                        {{ __('messages.Back') }}</button>
                                    <button type="button" class="btn btn-success primary-btn" id="saveDraft"><i
                                            class="fa fa-save"></i>
                                        {{ __('messages.SAVE_AND_CLOSE') }}</button>
                                    <button type="button" class="btn btn-dark next primary-btn" id="nextButton"><i
                                            class="fa fa-arrow-right"></i>
                                        {{ __('messages.Next') }}</button>
                                    <button type="button" class="btn btn-primary primary-btn  createAd"><i
                                            class="fa fa-checkbox"></i> {{ __('messages.CreateAd') }}</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" value="0" id="draftId">
    </section>
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content card1">
                <form id="imageForm">
                    <div class="modal-header">
                        <div class="row w-100">
                            <div class="col-md-6">
                                <h5 class="modal-title" id="imageModalLabel">Choose Your Media</h5>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('add.media') }}" class="btn btn-secondary primary-btn btn-sm">
                                    <i class="fa fa-plus"></i> Upload Media
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            @foreach ($media as $item)
                                <div class="col-4">
                                    <label class="image-radio w-100">
                                        <input type="radio" name="image" value="{{ $item->media }}"
                                            data-path="{{ asset($item->media) }}" data-type="{{ $item->media_type }}">

                                        @if ($item->type === 'video')
                                            <video class="img-fluid" controls>
                                                <source src="{{ asset($item->media) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @else
                                            <img src="{{ asset($item->path) }}" class="img-fluid"
                                                alt="{{ $item->name }}">
                                        @endif

                                        <div>
                                            {{ $item->name }}<br>
                                            Resolution: {{ $item->resolution ?? 'N/A' }}
                                        </div>
                                    </label>
                                </div>
                            @endforeach

                            {{-- <div class="col-4">
                                <label class="image-radio w-100">
                                    <input type="radio" name="image" value="storage/images/gallery/sample1.png"
                                        data-path="https://www.sahllah.net/storage/images/gallery/sample1.png"
                                        data-type="image">
                                    <img src="https://www.sahllah.net/storage/images/gallery/sample1.png"
                                        class="img-fluid" alt="Sample 1">
                                    <div>Resolution: 1024 x 1024</div>
                                </label>
                            </div> --}}

                            <!-- Add more as needed -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success primary-btn ">Select</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <style>
        .form-select:disabled {
            background-color: #1c2a45;
        }

        .select.form-select {
            background: none;
            background-image: none;
        }

        .select-button1 {
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            color: white;
            margin: 4px 0px 4px 0;
        }

        .select-button1.active {
            background-color: #e8f0fe;
            border-color: #1a73e8;
            color: #1a73e8;
            font-weight: bold;
        }

        .panel {
            /* background-color: #fff; */
            background-image: linear-gradient(135deg, #2e3e4a, #0c2c3e), linear-gradient(to right, #38afc3, #1487b3);
            padding: 24px;
            border-radius: 10px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            margin-bottom: 24px;
            color: white;

        }

        .highlight {
            background-color: #e6f4ea;
            color: #188038;
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: 600;
        }

        .form-label {
            font-weight: 500;
            color: #5f6368;
        }
    </style>

    <!-- Dashboard Analytics end -->

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    {{-- age section script --}}

    <script>
        let selectedAge = "All";
        let selectedGender = "All";
        let selectedSpending = "All";

        function handleSelection(containerId, variableName) {
            const container = document.getElementById(containerId);
            container.querySelectorAll('.select-button1').forEach(button => {
                button.addEventListener('click', () => {
                    container.querySelectorAll('.select-button1').forEach(btn => btn.classList.remove(
                        'active'));
                    button.classList.add('active');
                    window[variableName] = button.getAttribute('data-value');
                });
            });
        }

        handleSelection("age-buttons", "selectedAge");
        handleSelection("gender-buttons", "selectedGender");
        handleSelection("spending-buttons", "selectedSpending");

        function submitAudience() {
            console.log("Selected Age:", selectedAge);
            console.log("Selected Gender:", selectedGender);
            console.log("Selected Spending Power:", selectedSpending);

            alert(`Age: ${selectedAge}\nGender: ${selectedGender}\nSpending Power: ${selectedSpending}`);
        }
    </script>

    <script>
        // Define countries and their cities
        const countriesWithCities = {
            saudi: ["Riyadh", "Jeddah", "Dammam", "Mecca", "Medina", "Tabuk", "Abha", "Khobar", "Yanbu"],
            usa: ["California", "Texas", "New York", "Florida", "Illinois", "Pennsylvania", "Ohio", "Georgia",
                "Washington"
            ],
            india: ["Delhi", "Mumbai", "Bangalore", "Kolkata", "Chennai", "Hyderabad", "Pune", "Ahmedabad", "Jaipur"],
            uk: ["London", "Manchester", "Birmingham", "Liverpool", "Glasgow", "Edinburgh", "Bristol", "Leeds",
                "Newcastle"
            ],
            uae: ["Dubai", "Abu Dhabi", "Sharjah", "Ajman", "Fujairah", "Ras Al Khaimah", "Umm Al Quwain", "Al Ain"],
            pakistan: ["Lahore", "Karachi", "Islamabad", "Peshawar", "Quetta", "Faisalabad", "Multan", "Rawalpindi",
                "Gujranwala"
            ],
            canada: ["Toronto", "Vancouver", "Montreal", "Calgary", "Ottawa", "Edmonton", "Winnipeg", "Quebec City",
                "Halifax"
            ],
            germany: ["Berlin", "Munich", "Frankfurt", "Hamburg", "Cologne", "Stuttgart", "Düsseldorf", "Leipzig",
                "Dresden"
            ],
            france: ["Paris", "Lyon", "Marseille", "Toulouse", "Nice", "Lille", "Bordeaux", "Nantes", "Strasbourg"],
            australia: ["Sydney", "Melbourne", "Brisbane", "Perth", "Adelaide", "Gold Coast", "Canberra", "Newcastle",
                "Hobart"
            ],
            japan: ["Tokyo", "Osaka", "Kyoto", "Yokohama", "Nagoya", "Sapporo", "Kobe", "Fukuoka", "Hiroshima"],
            south_korea: ["Seoul", "Busan", "Incheon", "Daegu", "Daejeon", "Gwangju", "Suwon", "Ulsan"],
            china: ["Beijing", "Shanghai", "Guangzhou", "Shenzhen", "Chengdu", "Chongqing", "Tianjin", "Wuhan"],
            turkey: ["Istanbul", "Ankara", "Izmir", "Bursa", "Antalya", "Konya", "Adana", "Gaziantep"],
            egypt: ["Cairo", "Alexandria", "Giza", "Shubra El Kheima", "Port Said", "Suez", "Luxor", "Mansoura"],
            south_africa: ["Johannesburg", "Cape Town", "Durban", "Pretoria", "Port Elizabeth", "Bloemfontein",
                "East London"
            ],
            brazil: ["São Paulo", "Rio de Janeiro", "Brasília", "Salvador", "Fortaleza", "Belo Horizonte", "Manaus"],
            mexico: ["Mexico City", "Guadalajara", "Monterrey", "Puebla", "Tijuana", "León", "Querétaro", "Mérida"],
            spain: ["Madrid", "Barcelona", "Valencia", "Seville", "Zaragoza", "Malaga", "Murcia", "Palma"],
            italy: ["Rome", "Milan", "Naples", "Turin", "Palermo", "Genoa", "Bologna", "Florence"],
            russia: ["Moscow", "Saint Petersburg", "Novosibirsk", "Yekaterinburg", "Kazan", "Nizhny Novgorod",
                "Chelyabinsk"
            ],
            indonesia: ["Jakarta", "Surabaya", "Bandung", "Medan", "Semarang", "Makassar", "Palembang", "Denpasar"],
            thailand: ["Bangkok", "Chiang Mai", "Phuket", "Pattaya", "Khon Kaen", "Udon Thani", "Hat Yai",
                "Nakhon Ratchasima"
            ],
            vietnam: ["Hanoi", "Ho Chi Minh City", "Da Nang", "Haiphong", "Can Tho", "Bien Hoa", "Hue", "Nha Trang"],
            nigeria: ["Lagos", "Kano", "Ibadan", "Abuja", "Port Harcourt", "Benin City", "Maiduguri", "Zaria"],
            kenya: ["Nairobi", "Mombasa", "Kisumu", "Nakuru", "Eldoret", "Thika", "Malindi", "Kitale"]
        };

        // Define audience ranges for social media platforms
        const audienceRanges = {
            saudi: {
                Riyadh: {
                    snapchat: "4,800,000 – 6,000,000",
                    tiktok: "5,500,010 – 7,200,000"
                },
                Jeddah: {
                    snapchat: "3,200,000 – 4,000,000",
                    tiktok: "3,800,000 – 4,600,000"
                },
                Dammam: {
                    snapchat: "1,300,000 – 1,800,000",
                    tiktok: "1,500,000 – 2,100,000"
                },
                Mecca: {
                    snapchat: "2,100,000 – 2,900,000",
                    tiktok: "2,400,000 – 3,200,000"
                },
                Medina: {
                    snapchat: "1,000,000 – 1,400,000",
                    tiktok: "1,200,000 – 1,700,000"
                },
                Tabuk: {
                    snapchat: "600,000 – 900,000",
                    tiktok: "750,000 – 1,100,000"
                },
                Abha: {
                    snapchat: "500,000 – 800,000",
                    tiktok: "650,000 – 950,000"
                },
                Khobar: {
                    snapchat: "900,000 – 1,300,000",
                    tiktok: "1,100,000 – 1,600,000"
                },
                Yanbu: {
                    snapchat: "400,000 – 700,000",
                    tiktok: "550,000 – 850,000"
                }
            },
            usa: {
                California: {
                    snapchat: "15,000,000 – 18,000,000",
                    tiktok: "17,000,000 – 21,000,000"
                },
                Texas: {
                    snapchat: "12,500,000 – 15,000,000",
                    tiktok: "14,000,000 – 17,000,000"
                },
                "New York": {
                    snapchat: "12,000,000 – 14,500,000",
                    tiktok: "13,500,000 – 16,500,000"
                },
                Florida: {
                    snapchat: "10,800,000 – 13,000,000",
                    tiktok: "12,000,000 – 14,500,000"
                },
                Illinois: {
                    snapchat: "6,200,000 – 7,800,000",
                    tiktok: "7,000,000 – 8,500,000"
                },
                Pennsylvania: {
                    snapchat: "5,800,000 – 7,200,000",
                    tiktok: "6,500,000 – 8,000,000"
                },
                Ohio: {
                    snapchat: "5,200,000 – 6,600,000",
                    tiktok: "5,900,000 – 7,400,000"
                },
                Georgia: {
                    snapchat: "4,800,000 – 6,000,000",
                    tiktok: "5,400,000 – 6,800,000"
                },
                Washington: {
                    snapchat: "4,200,000 – 5,400,000",
                    tiktok: "4,800,000 – 6,200,000"
                }
            },
            india: {
                Delhi: {
                    snapchat: "16,500,000 – 20,000,000",
                    tiktok: "23,000,000 – 28,000,000"
                },
                Mumbai: {
                    snapchat: "18,000,000 – 22,000,000",
                    tiktok: "25,000,000 – 30,000,000"
                },
                Bangalore: {
                    snapchat: "12,000,000 – 15,000,000",
                    tiktok: "16,000,000 – 20,000,000"
                },
                Kolkata: {
                    snapchat: "10,500,000 – 13,000,000",
                    tiktok: "14,000,000 – 17,500,000"
                },
                Chennai: {
                    snapchat: "8,000,000 – 10,000,000",
                    tiktok: "11,000,000 – 14,000,000"
                },
                Hyderabad: {
                    snapchat: "9,500,000 – 12,000,000",
                    tiktok: "13,000,000 – 16,000,000"
                },
                Pune: {
                    snapchat: "7,500,000 – 9,500,000",
                    tiktok: "10,000,000 – 13,000,000"
                },
                Ahmedabad: {
                    snapchat: "6,800,000 – 8,700,000",
                    tiktok: "9,000,000 – 11,500,000"
                },
                Jaipur: {
                    snapchat: "5,200,000 – 6,800,000",
                    tiktok: "7,000,000 – 9,000,000"
                }
            },
            uk: {
                London: {
                    snapchat: "9,200,000 – 11,500,000",
                    tiktok: "10,500,000 – 13,000,000"
                },
                Manchester: {
                    snapchat: "2,800,000 – 3,600,000",
                    tiktok: "3,200,000 – 4,100,000"
                },
                Birmingham: {
                    snapchat: "2,500,000 – 3,200,000",
                    tiktok: "2,900,000 – 3,700,000"
                },
                Liverpool: {
                    snapchat: "1,600,000 – 2,100,000",
                    tiktok: "1,900,000 – 2,500,000"
                },
                Glasgow: {
                    snapchat: "1,800,000 – 2,400,000",
                    tiktok: "2,100,000 – 2,800,000"
                },
                Edinburgh: {
                    snapchat: "1,500,000 – 2,000,000",
                    tiktok: "1,800,000 – 2,400,000"
                },
                Bristol: {
                    snapchat: "1,300,000 – 1,800,000",
                    tiktok: "1,600,000 – 2,100,000"
                },
                Leeds: {
                    snapchat: "1,400,000 – 1,900,000",
                    tiktok: "1,700,000 – 2,300,000"
                },
                Newcastle: {
                    snapchat: "1,100,000 – 1,500,000",
                    tiktok: "1,300,000 – 1,800,000"
                }
            },
            uae: {
                Dubai: {
                    snapchat: "2,800,000 – 3,600,000",
                    tiktok: "3,200,000 – 4,000,000"
                },
                "Abu Dhabi": {
                    snapchat: "1,500,000 – 2,000,000",
                    tiktok: "1,700,000 – 2,200,000"
                },
                Sharjah: {
                    snapchat: "800,000 – 1,200,000",
                    tiktok: "950,000 – 1,400,000"
                },
                Ajman: {
                    snapchat: "400,000 – 700,000",
                    tiktok: "500,000 – 850,000"
                },
                Fujairah: {
                    snapchat: "300,000 – 500,000",
                    tiktok: "400,000 – 650,000"
                },
                "Ras Al Khaimah": {
                    snapchat: "350,000 – 600,000",
                    tiktok: "450,000 – 750,000"
                },
                "Umm Al Quwain": {
                    snapchat: "200,000 – 400,000",
                    tiktok: "300,000 – 500,000"
                },
                "Al Ain": {
                    snapchat: "600,000 – 900,000",
                    tiktok: "750,000 – 1,100,000"
                }
            },
            pakistan: {
                Lahore: {
                    snapchat: "1,800,000 – 2,500,000",
                    tiktok: "2,400,000 – 3,200,000"
                },
                Karachi: {
                    snapchat: "2,000,000 – 2,700,000",
                    tiktok: "2,800,000 – 3,600,000"
                },
                Islamabad: {
                    snapchat: "900,000 – 1,300,000",
                    tiktok: "1,100,000 – 1,500,000"
                },
                Peshawar: {
                    snapchat: "700,000 – 1,100,000",
                    tiktok: "900,000 – 1,400,000"
                },
                Quetta: {
                    snapchat: "500,000 – 800,000",
                    tiktok: "650,000 – 950,000"
                },
                Faisalabad: {
                    snapchat: "800,000 – 1,200,000",
                    tiktok: "1,000,000 – 1,500,000"
                },
                Multan: {
                    snapchat: "600,000 – 950,000",
                    tiktok: "800,000 – 1,200,000"
                },
                Rawalpindi: {
                    snapchat: "750,000 – 1,100,000",
                    tiktok: "950,000 – 1,400,000"
                },
                Gujranwala: {
                    snapchat: "550,000 – 850,000",
                    tiktok: "700,000 – 1,100,000"
                }
            },
            canada: {
                Toronto: {
                    snapchat: "6,500,000 – 8,200,000",
                    tiktok: "7,300,000 – 9,100,000"
                },
                Vancouver: {
                    snapchat: "3,200,000 – 4,100,000",
                    tiktok: "3,600,000 – 4,600,000"
                },
                Montreal: {
                    snapchat: "3,800,000 – 4,900,000",
                    tiktok: "4,300,000 – 5,500,000"
                },
                Calgary: {
                    snapchat: "2,100,000 – 2,800,000",
                    tiktok: "2,400,000 – 3,100,000"
                },
                Ottawa: {
                    snapchat: "1,800,000 – 2,400,000",
                    tiktok: "2,000,000 – 2,700,000"
                },
                Edmonton: {
                    snapchat: "1,600,000 – 2,200,000",
                    tiktok: "1,900,000 – 2,000,000"
                },
                Winnipeg: {
                    snapchat: "1,200,000 – 1,700,000",
                    tiktok: "1,400,000 – 2,000,000"
                },
                "Quebec City": {
                    snapchat: "1,300,000 – 1,800,000",
                    tiktok: "1,500,000 – 2,100,000"
                },
                Halifax: {
                    snapchat: "900,000 – 1,300,000",
                    tiktok: "1,100,000 – 1,500,000"
                }
            },
            germany: {
                Berlin: {
                    snapchat: "5,200,000 – 6,600,000",
                    tiktok: "5,900,000 – 7,400,000"
                },
                Munich: {
                    snapchat: "3,800,000 – 4,900,000",
                    tiktok: "4,300,000 – 5,500,000"
                },
                Frankfurt: {
                    snapchat: "2,900,000 – 3,800,000",
                    tiktok: "3,300,000 – 4,300,000"
                },
                Hamburg: {
                    snapchat: "3,500,000 – 4,500,000",
                    tiktok: "4,000,000 – 5,100,000"
                },
                Cologne: {
                    snapchat: "2,600,000 – 3,400,000",
                    tiktok: "3,000,000 – 3,900,000"
                },
                Stuttgart: {
                    snapchat: "2,300,000 – 3,000,000",
                    tiktok: "2,600,000 – 3,400,000"
                },
                Düsseldorf: {
                    snapchat: "2,100,000 – 2,800,000",
                    tiktok: "2,400,000 – 3,200,000"
                },
                Leipzig: {
                    snapchat: "1,800,000 – 2,400,000",
                    tiktok: "2,100,000 – 2,800,000"
                },
                Dresden: {
                    snapchat: "1,500,000 – 2,000,000",
                    tiktok: "1,800,000 – 2,400,000"
                }
            },
            france: {
                Paris: {
                    snapchat: "8,500,000 – 10,500,000",
                    tiktok: "9,700,000 – 12,000,000"
                },
                Lyon: {
                    snapchat: "2,500,000 – 3,200,000",
                    tiktok: "2,900,000 – 3,700,000"
                },
                Marseille: {
                    snapchat: "2,800,000 – 3,600,000",
                    tiktok: "3,200,000 – 4,100,000"
                },
                Toulouse: {
                    snapchat: "1,800,000 – 2,400,000",
                    tiktok: "2,100,000 – 2,800,000"
                },
                Nice: {
                    snapchat: "1,600,000 – 2,100,000",
                    tiktok: "1,900,000 – 2,500,000"
                },
                Lille: {
                    snapchat: "1,400,000 – 1,900,000",
                    tiktok: "1,700,000 – 2,300,000"
                },
                Bordeaux: {
                    snapchat: "1,700,000 – 2,300,000",
                    tiktok: "2,000,000 – 2,700,000"
                },
                Nantes: {
                    snapchat: "1,500,000 – 2,000,000",
                    tiktok: "1,800,000 – 2,400,000"
                },
                Strasbourg: {
                    snapchat: "1,300,000 – 1,800,000",
                    tiktok: "1,600,000 – 2,100,000"
                }
            },
            australia: {
                Sydney: {
                    snapchat: "6,800,000 – 8,500,000",
                    tiktok: "7,700,000 – 9,600,000"
                },
                Melbourne: {
                    snapchat: "6,200,000 – 7,800,000",
                    tiktok: "7,000,000 – 8,800,000"
                },
                Brisbane: {
                    snapchat: "3,500,000 – 4,500,000",
                    tiktok: "4,000,000 – 5,100,000"
                },
                Perth: {
                    snapchat: "2,900,000 – 3,800,000",
                    tiktok: "3,300,000 – 4,300,000"
                },
                Adelaide: {
                    snapchat: "2,100,000 – 2,800,000",
                    tiktok: "2,400,000 – 3,200,000"
                },
                "Gold Coast": {
                    snapchat: "1,800,000 – 2,400,000",
                    tiktok: "2,100,000 – 2,800,000"
                },
                Canberra: {
                    snapchat: "1,200,000 – 1,700,000",
                    tiktok: "1,400,000 – 2,000,000"
                },
                Newcastle: {
                    snapchat: "1,100,000 – 1,500,000",
                    tiktok: "1,300,000 – 1,800,000"
                },
                Hobart: {
                    snapchat: "800,000 – 1,200,000",
                    tiktok: "950,000 – 1,400,000"
                }
            },
            japan: {
                Tokyo: {
                    snapchat: "12,000,000 – 15,000,000",
                    tiktok: "14,000,000 – 17,500,000"
                },
                Osaka: {
                    snapchat: "8,500,000 – 10,500,000",
                    tiktok: "9,700,000 – 12,000,000"
                },
                Kyoto: {
                    snapchat: "2,800,000 – 3,600,000",
                    tiktok: "3,200,000 – 4,100,000"
                },
                Yokohama: {
                    snapchat: "6,200,000 – 7,800,000",
                    tiktok: "7,000,000 – 8,800,000"
                },
                Nagoya: {
                    snapchat: "5,800,000 – 7,200,000",
                    tiktok: "6,500,000 – 8,000,000"
                },
                Sapporo: {
                    snapchat: "3,500,000 – 4,500,000",
                    tiktok: "4,000,000 – 5,100,000"
                },
                Kobe: {
                    snapchat: "2,900,000 – 3,800,000",
                    tiktok: "3,300,000 – 4,300,000"
                },
                Fukuoka: {
                    snapchat: "4,200,000 – 5,400,000",
                    tiktok: "4,800,000 – 6,200,000"
                },
                Hiroshima: {
                    snapchat: "2,300,000 – 3,000,000",
                    tiktok: "2,600,000 – 3,400,000"
                }
            },
            south_korea: {
                Seoul: {
                    snapchat: "10,800,000 – 13,000,000",
                    tiktok: "12,000,000 – 14,500,000"
                },
                Busan: {
                    snapchat: "6,200,000 – 7,800,000",
                    tiktok: "7,000,000 – 8,500,000"
                },
                Incheon: {
                    snapchat: "4,800,000 – 6,000,000",
                    tiktok: "5,400,000 – 6,800,000"
                },
                Daegu: {
                    snapchat: "3,800,000 – 4,900,000",
                    tiktok: "4,300,000 – 5,500,000"
                },
                Daejeon: {
                    snapchat: "2,900,000 – 3,800,000",
                    tiktok: "3,300,000 – 4,300,000"
                },
                Gwangju: {
                    snapchat: "2,500,000 – 3,200,000",
                    tiktok: "2,900,000 – 3,700,000"
                },
                Suwon: {
                    snapchat: "3,200,000 – 4,100,000",
                    tiktok: "3,600,000 – 4,600,000"
                },
                Ulsan: {
                    snapchat: "2,100,000 – 2,800,000",
                    tiktok: "2,400,000 – 3,200,000"
                }
            },
            china: {
                Beijing: {
                    snapchat: "22,000,000 – 27,000,000",
                    tiktok: "35,000,000 – 42,000,000"
                },
                Shanghai: {
                    snapchat: "25,000,000 – 30,000,000",
                    tiktok: "38,000,000 – 45,000,000"
                },
                Guangzhou: {
                    snapchat: "18,000,000 – 22,000,000",
                    tiktok: "28,000,000 – 34,000,000"
                },
                Shenzhen: {
                    snapchat: "20,000,000 – 24,000,000",
                    tiktok: "32,000,000 – 38,000,000"
                },
                Chengdu: {
                    snapchat: "15,000,000 – 18,000,000",
                    tiktok: "23,000,000 – 28,000,000"
                },
                Chongqing: {
                    snapchat: "14,000,000 – 17,000,000",
                    tiktok: "21,000,000 – 26,000,000"
                },
                Tianjin: {
                    snapchat: "12,000,000 – 15,000,000",
                    tiktok: "18,000,000 – 22,000,000"
                },
                Wuhan: {
                    snapchat: "13,000,000 – 16,000,000",
                    tiktok: "20,000,000 – 25,000,000"
                }
            },
            turkey: {
                Istanbul: {
                    snapchat: "12,000,000 – 15,000,000",
                    tiktok: "15,000,000 – 18,000,000"
                },
                Ankara: {
                    snapchat: "6,200,000 – 7,800,000",
                    tiktok: "7,800,000 – 9,500,000"
                },
                Izmir: {
                    snapchat: "5,800,000 – 7,200,000",
                    tiktok: "7,200,000 – 8,800,000"
                },
                Bursa: {
                    snapchat: "4,200,000 – 5,400,000",
                    tiktok: "5,300,000 – 6,700,000"
                },
                Antalya: {
                    snapchat: "3,800,000 – 4,900,000",
                    tiktok: "4,800,000 – 6,100,000"
                },
                Konya: {
                    snapchat: "3,200,000 – 4,100,000",
                    tiktok: "4,100,000 – 5,300,000"
                },
                Adana: {
                    snapchat: "3,500,000 – 4,500,000",
                    tiktok: "4,400,000 – 5,600,000"
                },
                Gaziantep: {
                    snapchat: "2,900,000 – 3,800,000",
                    tiktok: "3,700,000 – 4,800,000"
                }
            },
            egypt: {
                Cairo: {
                    snapchat: "15,000,000 – 18,000,000",
                    tiktok: "18,000,000 – 22,000,000"
                },
                Alexandria: {
                    snapchat: "8,500,000 – 10,500,000",
                    tiktok: "10,000,000 – 12,500,000"
                },
                Giza: {
                    snapchat: "7,200,000 – 9,000,000",
                    tiktok: "8,700,000 – 10,800,000"
                },
                "Shubra El Kheima": {
                    snapchat: "4,800,000 – 6,000,000",
                    tiktok: "5,800,000 – 7,200,000"
                },
                "Port Said": {
                    snapchat: "3,200,000 – 4,100,000",
                    tiktok: "3,900,000 – 5,000,000"
                },
                Suez: {
                    snapchat: "2,800,000 – 3,600,000",
                    tiktok: "3,400,000 – 4,400,000"
                },
                Luxor: {
                    snapchat: "2,100,000 – 2,800,000",
                    tiktok: "2,600,000 – 3,400,000"
                },
                Mansoura: {
                    snapchat: "3,500,000 – 4,500,000",
                    tiktok: "4,300,000 – 5,500,000"
                }
            },
            south_africa: {
                Johannesburg: {
                    snapchat: "8,500,000 – 10,500,000",
                    tiktok: "10,000,000 – 12,500,000"
                },
                "Cape Town": {
                    snapchat: "7,200,000 – 9,000,000",
                    tiktok: "8,500,000 – 10,500,000"
                },
                Durban: {
                    snapchat: "6,200,000 – 7,800,000",
                    tiktok: "7,400,000 – 9,200,000"
                },
                Pretoria: {
                    snapchat: "5,800,000 – 7,200,000",
                    tiktok: "6,900,000 – 8,600,000"
                },
                "Port Elizabeth": {
                    snapchat: "3,800,000 – 4,900,000",
                    tiktok: "4,600,000 – 5,900,000"
                },
                Bloemfontein: {
                    snapchat: "2,900,000 – 3,800,000",
                    tiktok: "3,500,000 – 4,600,000"
                },
                "East London": {
                    snapchat: "2,500,000 – 3,200,000",
                    tiktok: "3,100,000 – 4,000,000"
                }
            },
            brazil: {
                "São Paulo": {
                    snapchat: "25,000,000 – 30,000,000",
                    tiktok: "30,000,000 – 36,000,000"
                },
                "Rio de Janeiro": {
                    snapchat: "18,000,000 – 22,000,000",
                    tiktok: "22,000,000 – 27,000,000"
                },
                Brasília: {
                    snapchat: "12,000,000 – 15,000,000",
                    tiktok: "14,500,000 – 18,000,000"
                },
                Salvador: {
                    snapchat: "10,500,000 – 13,000,000",
                    tiktok: "12,800,000 – 16,000,000"
                },
                Fortaleza: {
                    snapchat: "9,500,000 – 12,000,000",
                    tiktok: "11,500,000 – 14,500,000"
                },
                "Belo Horizonte": {
                    snapchat: "11,000,000 – 13,500,000",
                    tiktok: "13,500,000 – 16,500,000"
                },
                Manaus: {
                    snapchat: "8,000,000 – 10,000,000",
                    tiktok: "9,800,000 – 12,300,000"
                }
            },
            mexico: {
                "Mexico City": {
                    snapchat: "20,000,000 – 24,000,000",
                    tiktok: "24,000,000 – 29,000,000"
                },
                Guadalajara: {
                    snapchat: "12,000,000 – 15,000,000",
                    tiktok: "14,500,000 – 18,000,000"
                },
                Monterrey: {
                    snapchat: "11,000,000 – 13,500,000",
                    tiktok: "13,500,000 – 16,500,000"
                },
                Puebla: {
                    snapchat: "8,500,000 – 10,500,000",
                    tiktok: "10,300,000 – 12,800,000"
                },
                Tijuana: {
                    snapchat: "7,200,000 – 9,000,000",
                    tiktok: "8,800,000 – 11,000,000"
                },
                León: {
                    snapchat: "6,200,000 – 7,800,000",
                    tiktok: "7,600,000 – 9,500,000"
                },
                Querétaro: {
                    snapchat: "5,800,000 – 7,200,000",
                    tiktok: "7,100,000 – 8,900,000"
                },
                Mérida: {
                    snapchat: "4,800,000 – 6,000,000",
                    tiktok: "5,900,000 – 7,400,000"
                }
            },
            spain: {
                Madrid: {
                    snapchat: "12,000,000 – 15,000,000",
                    tiktok: "14,000,000 – 17,500,000"
                },
                Barcelona: {
                    snapchat: "10,500,000 – 13,000,000",
                    tiktok: "12,500,000 – 15,500,000"
                },
                Valencia: {
                    snapchat: "6,200,000 – 7,800,000",
                    tiktok: "7,400,000 – 9,300,000"
                },
                Seville: {
                    snapchat: "5,800,000 – 7,200,000",
                    tiktok: "6,900,000 – 8,600,000"
                },
                Zaragoza: {
                    snapchat: "4,200,000 – 5,400,000",
                    tiktok: "5,100,000 – 6,500,000"
                },
                Malaga: {
                    snapchat: "4,800,000 – 6,000,000",
                    tiktok: "5,800,000 – 7,300,000"
                },
                Murcia: {
                    snapchat: "3,800,000 – 4,900,000",
                    tiktok: "4,600,000 – 5,900,000"
                },
                Palma: {
                    snapchat: "3,200,000 – 4,100,000",
                    tiktok: "3,900,000 – 5,000,000"
                }
            },
            italy: {
                Rome: {
                    snapchat: "10,500,000 – 13,000,000",
                    tiktok: "12,500,000 – 15,500,000"
                },
                Milan: {
                    snapchat: "9,500,000 – 12,000,000",
                    tiktok: "11,500,000 – 14,500,000"
                },
                Naples: {
                    snapchat: "8,500,000 – 10,500,000",
                    tiktok: "10,300,000 – 12,800,000"
                },
                Turin: {
                    snapchat: "6,200,000 – 7,800,000",
                    tiktok: "7,400,000 – 9,300,000"
                },
                Palermo: {
                    snapchat: "5,800,000 – 7,200,000",
                    tiktok: "6,900,000 – 8,600,000"
                },
                Genoa: {
                    snapchat: "4,200,000 – 5,400,000",
                    tiktok: "5,100,000 – 6,500,000"
                },
                Bologna: {
                    snapchat: "4,800,000 – 6,000,000",
                    tiktok: "5,800,000 – 7,300,000"
                },
                Florence: {
                    snapchat: "4,500,000 – 5,700,000",
                    tiktok: "5,500,000 – 7,000,000"
                }
            },
            russia: {
                Moscow: {
                    snapchat: "18,000,000 – 22,000,000",
                    tiktok: "20,000,000 – 25,000,000"
                },
                "Saint Petersburg": {
                    snapchat: "12,000,000 – 15,000,000",
                    tiktok: "14,000,000 – 17,500,000"
                },
                Novosibirsk: {
                    snapchat: "6,200,000 – 7,800,000",
                    tiktok: "7,400,000 – 9,300,000"
                },
                Yekaterinburg: {
                    snapchat: "5,800,000 – 7,200,000",
                    tiktok: "6,900,000 – 8,600,000"
                },
                Kazan: {
                    snapchat: "4,800,000 – 6,000,000",
                    tiktok: "5,800,000 – 7,300,000"
                },
                "Nizhny Novgorod": {
                    snapchat: "4,500,000 – 5,700,000",
                    tiktok: "5,500,000 – 7,000,000"
                },
                Chelyabinsk: {
                    snapchat: "4,200,000 – 5,400,000",
                    tiktok: "5,100,000 – 6,500,000"
                }
            },
            indonesia: {
                Jakarta: {
                    snapchat: "22,000,000 – 27,000,000",
                    tiktok: "28,000,000 – 34,000,000"
                },
                Surabaya: {
                    snapchat: "15,000,000 – 18,000,000",
                    tiktok: "19,000,000 – 23,000,000"
                },
                Bandung: {
                    snapchat: "12,000,000 – 15,000,000",
                    tiktok: "15,000,000 – 18,500,000"
                },
                Medan: {
                    snapchat: "10,500,000 – 13,000,000",
                    tiktok: "13,500,000 – 16,500,000"
                },
                Semarang: {
                    snapchat: "8,500,000 – 10,500,000",
                    tiktok: "10,800,000 – 13,300,000"
                },
                Makassar: {
                    snapchat: "7,200,000 – 9,000,000",
                    tiktok: "9,200,000 – 11,500,000"
                },
                Palembang: {
                    snapchat: "6,800,000 – 8,500,000",
                    tiktok: "8,700,000 – 10,900,000"
                },
                Denpasar: {
                    snapchat: "5,800,000 – 7,200,000",
                    tiktok: "7,400,000 – 9,300,000"
                }
            },
            thailand: {
                Bangkok: {
                    snapchat: "15,000,000 – 18,000,000",
                    tiktok: "18,000,000 – 22,000,000"
                },
                "Chiang Mai": {
                    snapchat: "4,800,000 – 6,000,000",
                    tiktok: "5,800,000 – 7,300,000"
                },
                Phuket: {
                    snapchat: "3,800,000 – 4,900,000",
                    tiktok: "4,600,000 – 5,900,000"
                },
                Pattaya: {
                    snapchat: "3,200,000 – 4,100,000",
                    tiktok: "3,900,000 – 5,000,000"
                },
                "Khon Kaen": {
                    snapchat: "2,900,000 – 3,800,000",
                    tiktok: "3,500,000 – 4,600,000"
                },
                "Udon Thani": {
                    snapchat: "2,500,000 – 3,200,000",
                    tiktok: "3,100,000 – 4,000,000"
                },
                "Hat Yai": {
                    snapchat: "2,800,000 – 3,600,000",
                    tiktok: "3,400,000 – 4,400,000"
                },
                "Nakhon Ratchasima": {
                    snapchat: "2,300,000 – 3,000,000",
                    tiktok: "2,800,000 – 3,600,000"
                }
            },
            vietnam: {
                Hanoi: {
                    snapchat: "12,000,000 – 15,000,000",
                    tiktok: "15,000,000 – 18,500,000"
                },
                "Ho Chi Minh City": {
                    snapchat: "15,000,000 – 18,000,000",
                    tiktok: "18,000,000 – 22,000,000"
                },
                "Da Nang": {
                    snapchat: "6,200,000 – 7,800,000",
                    tiktok: "7,400,000 – 9,300,000"
                },
                Haiphong: {
                    snapchat: "5,800,000 – 7,200,000",
                    tiktok: "6,900,000 – 8,600,000"
                },
                "Can Tho": {
                    snapchat: "4,800,000 – 6,000,000",
                    tiktok: "5,800,000 – 7,300,000"
                },
                "Bien Hoa": {
                    snapchat: "4,200,000 – 5,400,000",
                    tiktok: "5,100,000 – 6,500,000"
                },
                Hue: {
                    snapchat: "3,800,000 – 4,900,000",
                    tiktok: "4,600,000 – 5,900,000"
                },
                "Nha Trang": {
                    snapchat: "3,200,000 – 4,100,000",
                    tiktok: "3,900,000 – 5,000,000"
                }
            },
            nigeria: {
                Lagos: {
                    snapchat: "18,000,000 – 22,000,000",
                    tiktok: "20,000,000 – 25,000,000"
                },
                Kano: {
                    snapchat: "12,000,000 – 15,000,000",
                    tiktok: "14,000,000 – 17,500,000"
                },
                Ibadan: {
                    snapchat: "10,500,000 – 13,000,000",
                    tiktok: "12,500,000 – 15,500,000"
                },
                Abuja: {
                    snapchat: "9,500,000 – 12,000,000",
                    tiktok: "11,500,000 – 14,500,000"
                },
                "Port Harcourt": {
                    snapchat: "8,500,000 – 10,500,000",
                    tiktok: "10,300,000 – 12,800,000"
                },
                "Benin City": {
                    snapchat: "6,200,000 – 7,800,000",
                    tiktok: "7,400,000 – 9,300,000"
                },
                Maiduguri: {
                    snapchat: "5,800,000 – 7,200,000",
                    tiktok: "6,900,000 – 8,600,000"
                },
                Zaria: {
                    snapchat: "4,800,000 – 6,000,000",
                    tiktok: "5,800,000 – 7,300,000"
                }
            },
            kenya: {
                Nairobi: {
                    snapchat: "12,000,000 – 15,000,000",
                    tiktok: "14,000,000 – 17,500,000"
                },
                Mombasa: {
                    snapchat: "6,200,000 – 7,800,000",
                    tiktok: "7,400,000 – 9,300,000"
                },
                Kisumu: {
                    snapchat: "4,800,000 – 6,000,000",
                    tiktok: "5,800,000 – 7,300,000"
                },
                Nakuru: {
                    snapchat: "4,200,000 – 5,400,000",
                    tiktok: "5,100,000 – 6,500,000"
                },
                Eldoret: {
                    snapchat: "3,800,000 – 4,900,000",
                    tiktok: "4,600,000 – 5,900,000"
                },
                Thika: {
                    snapchat: "3,200,000 – 4,100,000",
                    tiktok: "3,900,000 – 5,000,000"
                },
                Malindi: {
                    snapchat: "2,900,000 – 3,800,000",
                    tiktok: "3,500,000 – 4,600,000"
                },
                Kitale: {
                    snapchat: "2,500,000 – 3,200,000",
                    tiktok: "3,100,000 – 4,000,000"
                }
            }
        };

        // Get DOM elements
        const countrySelect = document.getElementById("country-select");
        const stateSelect = document.getElementById("state-select");
        const audiencePanel = document.getElementById("audience-panel");
        const audienceRange = document.getElementById("audience-range");

        // Check if DOM elements exist
        if (!countrySelect || !stateSelect || !audiencePanel || !audienceRange) {
            console.error(
                "One or more DOM elements are missing. Please ensure 'country-select', 'state-select', 'audience-panel', and 'audience-range' exist in the HTML."
            );
        }

        // Add event listener for country selection
        if (countrySelect) {
            countrySelect.addEventListener("change", function() {
                const selectedCountry = this.value;
                stateSelect.innerHTML = '<option value="">-- Select State/City --</option>';
                audiencePanel.style.display = "none";

                if (selectedCountry && countriesWithCities[selectedCountry]) {
                    stateSelect.removeAttribute("disabled");

                    countriesWithCities[selectedCountry].forEach(state => {
                        const option = document.createElement("option");
                        option.value = state;
                        option.text = state;
                        stateSelect.appendChild(option);
                    });
                } else {
                    stateSelect.setAttribute("disabled", true);
                }
            });
        }

        // Add event listener for state/city selection
        if (stateSelect) {
            stateSelect.addEventListener("change", function() {
                const country = countrySelect.value;
                const state = stateSelect.value;
                // const platform = "tiktok"; // Hardcoded as per original code
                const platform = @json($social_media); // Dynamically set from PHP


                if (country && state && audienceRanges[country] && audienceRanges[country][state] && audienceRanges[
                        country][state][platform]) {
                    audienceRange.textContent = audienceRanges[country][state][platform];
                    audiencePanel.style.display = "block";
                } else {
                    audienceRange.textContent = "Audience data not available for this selection.";
                    audiencePanel.style.display = "block";
                }
            });
        }
    </script>

    {{-- end  --}}

    <script>
        document.getElementById('openMediaModal').addEventListener('click', function() {
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            modal.show();
        });
    </script>
    <script>
        document.getElementById('websiteTrigger').addEventListener('click', function() {
            // document.getElementById('openMediaModal').click();
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            modal.show();

        });
    </script>


    <script>
        document.getElementById('imageForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const selected = document.querySelector('input[name="image"]:checked');

            if (selected) {
                const mediaPath = selected.getAttribute('data-path');
                const mediaType = selected.getAttribute('data-type');

                document.getElementById('selectedMedia').value = mediaPath;
                document.getElementById('selectedType').value = mediaType;

                // Close modal (Bootstrap 5)
                const modal = bootstrap.Modal.getInstance(document.getElementById('imageModal'));
                modal.hide();
            } else {
                alert("Please select a media item.");
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
                console.log(cleanKey, spanValue);
                if (cleanKey == 'location') {
                    locationValue = countryNames[spanValue] || spanValue;
                    span.text(locationValue);
                } else if (cleanKey == 'age_group') {

                    age_group = ageGroup[spanValue] || spanValue;
                    span.text(age_group);

                } else if (cleanKey == 'media') {
                    @if (isset($media))
                        const selectedType = '{{ $media_type ? 'image' : 'video' }}';
                        const selectedpath = '{{ asset($media) }}';
                    @else
                        const selectedType = $('input[name="image"]:checked').attr('data-type');
                        const selectedpath = $('input[name="image"]:checked').attr('data-path');
                    @endif

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

        function calculateDailyBudget() {
            const dateRange = $('input[name="dates"]').val();
            const budget = parseFloat($('input[name="budget"]').val());

            const [startStr, endStr] = dateRange.split(' - ');

            const startDate = new Date(startStr);
            const endDate = new Date(endStr);

            const timeDiff = Math.abs(endDate - startDate);
            const days = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

            const dailyBudget = days > 0 ? (budget / days).toFixed(2) : budget;

            $('#dailybudgetValue').text(dailyBudget);
        }

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
                    console.log(response);
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
        $("#recommendedBudget").show();
        // $("#customBudget").show();
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
