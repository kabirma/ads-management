@extends('layouts.master')

@section('content')
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"> <span class="badge badge-light-primary">{{__('messages.EDIT')}}
                                    {{ $title }}</span>
                            </li>
                        </ol>
                        <a href="{{ route('view.media') }}" class="btn btn-sm btn-primary waves-effect addnew">
                            <i class="fa fa-list"></i> <span>{{__('messages.VIEW')}} {{ $title }}</span>
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            <form action="{{ route('save.media') }}" method="post" class="row"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ isset($record) ? $record->id : 0 }}">

                                <div class="col-md-12">
                                    <label for="media_type">{{__('messages.MEDIA_TYPE')}}</label>
                                    <select name="media_type" class="form-control">
                                        <option value="" selected disabled>Select Media Type</option>
                                        <option {{ isset($record) && $record->media_type == 'image' ? 'selected' : '' }}
                                            value="image">{{__('messages.Image')}}</option>
                                        <option {{ isset($record) && $record->media_type == 'video' ? 'selected' : '' }}
                                            value="video">{{__('messages.Video')}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="media">{{__('messages.Media')}}</label>
                                    <input id="media" name="media" type="file" class="form-control">
                                    @if (isset($record))
                                        <br>
                                        @if ($record->media_type == 'image')
                                            <img src="{{ asset($record->media) }}" style="height:100px">
                                        @else
                                            <video width="320" height="240" controls>
                                                <source src="{{ asset($record->media) }}" type="video/mp4">
                                                <source src="{{ asset($record->media) }}" type="video/ogg">
                                                Your browser does not support the video tag.
                                            </video>
                                        @endif
                                    @endif
                                </div>
                                <div class="form-group col-md-12">
                                    <hr>
                                    <button class="btn btn-primary"><i class="fa fa-check"></i> {{__('messages.SAVE')}}</button>
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
        CKEDITOR.replace('ckeditor');
        $(".select2").select2();
    </script>
@endsection
