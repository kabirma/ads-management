@extends('admin.layouts.master')

@section('content')
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">

        <style>
            /* Toolbar (top) */
            /* .cke_top {
                            background: linear-gradient(to right, #1487b3, #38afc3) !important;

                        } */


            /* Bottom bar */
            .cke_bottom {
                background: linear-gradient(to right, #2e3e4a, #0c2c3e) !important;
            }

            /* Buttons in the toolbar */
            .cke_button {
                background: transparent !important;
                color: white !important;
            }
        </style>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item active"> <span class="badge badge-light-primary">Edit
                                    {{ $title }}</span>
                            </li>
                        </ol>
                        <a href="{{ route('view.page') }}" class="btn btn-sm btn-primary waves-effect addnew">
                            <i class="fa fa-list"></i> <span>View {{ $title }}</span>
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            <form action="{{ route('save.page') }}" method="post" class="row"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ isset($record) ? $record->id : 0 }}">

                                <div class="form-group col-md-12">
                                    <label for="title">{{ __('messages.Title') }}</label>
                                    <input id="title" name="title" value="{{ isset($record) ? $record->title : '' }}"
                                        type="text" required class="form-control">
                                </div>
                                <div class="form-group col-md-6" style="display:none">
                                    <label for="category">{{ __('messages.Category') }}</label>
                                    <input id="category" name="category"
                                        value="{{ isset($record) ? $record->category : '' }}" type="text"
                                        class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="category">{{ __('messages.Description') }}</label>
                                    <textarea name="description" id="ckeditor" class="form-control " cols="30" rows="10">{{ isset($record) ? $record->description : '' }}</textarea>
                                </div>
                                <div class="form-group col-md-12" style="display:none">
                                    <label for="category">{{ __('messages.Image') }}</label>
                                    <input id="image" name="image" type="file" class="form-control">
                                    @if (isset($record))
                                        <br>
                                        <img src="{{ asset($record->image) }}" style="height:100px">
                                    @endif
                                </div>
                                <div class="form-group col-md-12">
                                    <hr>
                                    <button class="btn btn-primary"><i class="fa fa-check"></i>
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



    <script>
        CKEDITOR.replace('ckeditor', {
            contentsCss: 'data:text/css,' + encodeURIComponent(`
            body {
                background: linear-gradient(to right, #2e3e4a, #0c2c3e) !important;
                color: white !important;
            }
        `)
        });
    </script>
@endsection
