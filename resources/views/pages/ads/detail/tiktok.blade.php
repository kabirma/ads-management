@extends('layouts.master')

@section('content')
    <style>
        h4 small{
            display:block;
        }
        h4{
            margin-bottom:4%;
        }

        .codepen-box {
        position: relative;
        border-radius: 6px;
        width: 400px;
        padding: 15px;
        overflow: hidden;
        margin: 0 auto;
        }
        .codepen-box::before {
        content: "";
        position: absolute;
        left: 40px;
        border-radius: 10px;
        right: 0;
        bottom: 50px;
        top: 50px;
        background-color: rgba(128, 128, 128, 0.37);
        transform-origin: right 40%;
        z-index: -2;
        transition: 0.5s ease-in-out all;
        }
        .codepen-box:hover::before {
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        transition: 0.5s ease-in-out all;
        }
        .codepen-box .top {
        width: 100%;
        overflow: hidden;
        margin: 0 auto;
        }
        .codepen-box .top .top-image {
        height: auto;
        object-fit: cover;
        }
        .codepen-box .top .top-image img {
        width: 100%;
        border-radius: 6px;
        height: 100%;
        object-fit: cover;
        }
        .codepen-box .top .profile {
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        justify-content: left;
        padding: 15px 0;
        }
        .codepen-box .top .profile .profile-pic {
        display: block;
        margin-right: 10px;
        }
        .codepen-box .top .profile .profile-pic img {
        border-radius: 10px;
        height: 40px;
        object-fit: cover;
        width: 40px;
        }
        .codepen-box .top .profile .profile-info {
        display: block;
        width: fit-content;
        }
        .codepen-box .top .profile .profile-info h3 {
        font-size: 15px;
        margin: 0;
        }
        .codepen-box .top .profile .profile-info p {
        font-size: 12px;
        margin: 0;
        }
        .codepen-box .bottom {
        height: 40px;
        padding: 5px 0;
        width: 100%;
        margin: 0 auto;
        display: flex;
        flex-direction: row;
        }
        .codepen-box .bottom .bottom-item:nth-child(1) {
        transition-delay: 0.1s;
        }
        .codepen-box .bottom .bottom-item:nth-child(2) {
        transition-delay: 0.15s;
        }
        .codepen-box .bottom .bottom-item:nth-child(3) {
        transition-delay: 0.2s;
        }
        .codepen-box .bottom .bottom-item {
        transition: 0.3s ease-in-out all;
        height: 25px;
        padding: 5px;
        color: white;
        margin: 0 5px 0 0;
        background-color: black;
        display: flex;
        justify-content: center;
        font-size: 12px;
        align-items: center;
        border-radius: 5px;
        opacity: 0;
        transform: translateY(-20px);
        }
        .codepen-box .bottom .bottom-item span:first-child {
        margin-right: 5px;
        }

        .codepen-box:hover .bottom-item {
        transition: 0.3s ease-in-out all;
        opacity: 1;
        transform: translateY(0px);
        }
    </style>
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-12">
                @if (Session::has('success'))
                    <div class="alert alert-success text-center">
                        <i class="fa fa-check"></i> {{ Session::get('success') }}
                    </div>
                @endif

                @if (Session::has('error'))
                    <div class="alert alert-danger text-center">
                        <i class="fa fa-times"></i> {{ Session::get('error') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"> <span class="badge badge-light-primary">{{ $title }}
                            {{__('messages.Details')}}</span></li>
                        </ol>

                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                                <h2>{{$ad->name}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 steps" id="step4" style="background: white; text-algn:center; padding:1rem; border-radius:8px; margin-bottom:2rem;">
            
            <div class="titleRow row">

                <div class="col-md-12">
                </div>
                <div class="col-md-4">
                    <h4>
                        <small>{{__('messages.CampaignName')}}</small>
                        {{$ad->campaign->name}}
                    </h4>
                </div>

                <div class="col-md-4">
                    <h4>
                        <small>{{__('messages.CampaignObjective')}}</small>
                        {{$ad->campaign->objective_type}}
                    </h4>
                </div>

                <div class="col-md-4">
                    <h4>
                        <small>{{__('messages.CampaignBudget')}}</small>
                        {{$ad->campaign->budget}}
                    </h4>
                </div>

                <div class="col-md-4">
                    <h4>
                        <small>{{__('messages.CampaignStart')}}</small>
                        {{date("F d, Y",strtotime($ad->adGroup->from))}}
                    </h4>
                </div>
                <div class="col-md-4">
                    <h4>
                        <small>{{__('messages.CampaignEnd')}}</small>
                        {{date("F d, Y",strtotime($ad->adGroup->to))}}
                    </h4>
                </div>
                <div class="col-md-12">
                    <hr>
                </div>
                <div class="col-md-12">
                    <section class="codepen-box">
                        <div class="top">
                            <div class="top-image">
                                <img src="{{$ad->image_url}}" alt="image 1">
                            </div>
                            <div class="profile">
                                <div class="profile-pic">
                                    <img src="{{asset($setting->logo)}}" alt="">
                                </div>
                                <div class="profile-info">
                                    <h3 class="name">{{$ad->name}}</h3>
                                    <p class="desc">{{$ad->description}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bottom">
                            <a class="bottom-item" target="_blank" href="{{$ad->landing_page_url}}">
                                <span class="bottom-icon"><i class="fa fa-star"></i></span>
                                <span class="bottom-number">{{str_replace("_"," ",$ad->call_to_action)}}</span>
                            </a>
                          
                        </div>
                    </section>
                </div>

            </div>

        </div>


    </section>
    <!-- Dashboard Analytics end -->
@endsection
