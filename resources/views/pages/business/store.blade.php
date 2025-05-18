@extends('layouts.master')

@section('content')
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
                        <a href="{{ route('view.business') }}" class="btn btn-sm btn-primary waves-effect addnew">
                            <i class="fa fa-list"></i> <span>View {{ $title }}</span>
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            <form action="{{ route('save.business') }}" method="post" class="row" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ isset($record) ? $record->id : 0 }}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                <div class="form-group col-md-6">
                                    <label for="name">{{__("messages.Title")}}</label>
                                    <input id="name" name="name" value="{{ isset($record) ? $record->name : '' }}"
                                        type="text" required class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="platform">{{__("messages.BusinessPlatform")}}</label>
                                     <select name="platform" id="platform" class="form-control">
                                        <option value="" selected disabled>{{__('messages.Select')}} {{__('messages.BusinessPlatform')}}</option>
                                        <option {{ isset($record) && $record->platform == 'SALLA' ? 'selected' : '' }}
                                            value="SALLA">SALLA</option>
                                        <option {{ isset($record) && $record->platform == 'Zid' ? 'selected' : '' }}
                                            value="Zid">Zid</option>
                                        <option {{ isset($record) && $record->platform == 'Shopify' ? 'selected' : '' }}
                                            value="Shopify">Shopify</option>
                                        <option {{ isset($record) && $record->platform == 'Other' ? 'selected' : '' }}
                                            value="Other">Other</option>
                                        <option {{ isset($record) && $record->platform == 'Not-Ecommerce' ? 'selected' : '' }}
                                            value="Not-Ecommerce">Not-Ecommerce</option>
                                    </select>
                                    <div id="otherPlatformArea" class="form-group mt-2"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="url">{{__("messages.WebsiteUrl")}}</label>
                                    <input id="url" name="url" value="{{ isset($record) ? $record->url : '' }}"
                                        type="text" required class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="currency">{{__('messages.Currency')}}</label>
                                    <select name="currency" class="form-control">
                                        <option value="" selected disabled>{{__('messages.Select')}} {{__('messages.Currency')}}</option>
                                        <option {{ isset($record) && $record->currency == 'USD' ? 'selected' : '' }}
                                            value="USD">USD</option>
                                        <option {{ isset($record) && $record->currency == 'SAR' ? 'selected' : '' }}
                                            value="SAR">SAR</option>
                                        <option {{ isset($record) && $record->currency == 'AED' ? 'selected' : '' }}
                                            value="AED">AED</option>
                                        <option {{ isset($record) && $record->currency == 'SAR' ? 'selected' : '' }}
                                            value="EUR">EUR</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="category">{{__("messages.Description")}}</label>
                                    <textarea name="description" class="form-control" cols="30" rows="10">{{ isset($record) ? $record->description : '' }}</textarea>
                                </div>
                               
                                <div class="form-group col-md-12">
                                    <label for="category">{{__("messages.Image")}}</label>
                                    <input id="image" name="image" type="file" class="form-control">
                                    @if(isset($record))
                                    <br>
                                    <img src="{{asset($record->image)}}" style="height:100px">
                                    @endif
                                </div>
                                <div class="form-group col-md-12">
                                    <hr>
                                    <button class="btn btn-primary"><i class="fa fa-check"></i> {{__("messages.SAVE")}}</button>
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
        $("#platform").change(function(){
            $("#otherPlatformArea").html('');
            if($(this).val() === 'Other'){
                $("#otherPlatformArea").html('<label for="url">{{__("messages.OtherPlatform")}}</label><input type="text" class="form-control name="platform" placeholder="{{__("messages.OtherPlatform")}}">');
            }
        })
    </script>
@endsection
