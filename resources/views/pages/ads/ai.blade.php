@extends('layouts.master')

@section('content')
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item active"> <span class="badge badge-light-primary">
                                    {{ $title }}</span>
                            </li>
                        </ol>
                    
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            <form action="{{ route('generateAd.ads') }}" method="post" class="row" enctype="multipart/form-data">
                                @csrf
                                @if (Session::has('error'))
                                    <div class="alert alert-danger text-center">
                                        <i class="fa fa-times"></i> {{ Session::get('error') }}
                                    </div>
                                @endif
                                <input type="hidden" name="id" value="{{ isset($record) ? $record->id : 0 }}">

                                <div class="form-group col-md-12">
                                    <label for="social_media">{{__('messages.SocialMediaOption')}}</label>
                                    <select name="social_media" class="form-control" required>
                                        <option value="" selected disabled>{{__('messages.Select')}} {{__('messages.SocialMedia')}}</option>

                                        <option value="snapchat">{{__('messages.Snapchat')}}</option>
                                        <option value="tiktok">{{__('messages.TikTok')}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="reason">{{__('messages.AdsReason')}}</label>
                                    <input type="text" class="form-control" name="reason" placeholder="{{__('messages.AdsReason')}}" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="summary">{{__('messages.AdsTarget')}}</label>
                                    <input type="text" class="form-control" name="location" placeholder="{{__('messages.AdsTarget')}}" required>
                                </div>
                           
                                <div class="form-group col-md-12">
                                    <hr>
                                    <button class="btn btn-primary"><i class="fa fa-pencil"></i> {{__('messages.SuggestContent')}}</button>
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

    <script>
        CKEDITOR.replace( 'ckeditor' );
        $(".select2").select2();
    </script>
@endsection
