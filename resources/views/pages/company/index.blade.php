@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    <!-- Dashboard Analytics Start -->
    <style>
        .bootstrap-tagsinput .tag {
            border-radius: 6px;
            padding: 5px;
            background: #5BBE25;
            margin-right: 2px;
            color: white;
        }
		.bootstrap-tagsinput {
			width:100%!important;
		}
    </style>
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
                            <form action="{{ route('save.company') }}" method="post" class="row" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ isset($record) ? $record->id : 0 }}">

                                <div class="col-md-12">
                                    <h4>Basic Info</h4>
                                    <hr>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="name">Name</label>
                                    <input id="name" name="name" value="{{ isset($record) ? $record->name : '' }}"
                                        type="text" required class="form-control">
                                </div>

{{--                                <div class="form-group col-md-12" style="display: none">--}}
{{--                                    <label for="phone">Phone</label>--}}
{{--                                    <input id="phone" name="phone" value="{{ isset($record) ? $record->phone : '' }}"--}}
{{--                                        type="text"  class="form-control">--}}
{{--                                </div>--}}

                                <div class="form-group col-md-12">
                                    <label for="email">Email</label>
                                    <input id="email" name="email" value="{{ isset($record) ? $record->email : '' }}"
                                        type="email" required class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="address">Address</label>
                                    <input id="address" name="address" value="{{ isset($record) ? $record->address : '' }}"
                                        type="text" required class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="address">Series</label>
                                    <input class="input-tags" type="text" data-role="tagsinput"  name="series" value="{{ isset($record) ? $record->series : '' }}"
                                    >
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="address">Category</label>
                                    <input class="input-tags" type="text" data-role="tagsinput"  name="tags" value="{{ isset($record) ? $record->tags : '' }}"
                                           >
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="short_description">Short Description</label>
                                    <input id="short_description" name="short_description" value="{{ isset($record) ? $record->short_description : '' }}"
                                        type="text" required class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <h4>Social Media Info</h4>
                                    <hr>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="facebook">Facebook</label>
                                    <input id="facebook" name="facebook" value="{{ isset($record) ? $record->facebook : '' }}"
                                        type="text" required class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="twitter">Twitter</label>
                                    <input id="twitter" name="twitter" value="{{ isset($record) ? $record->twitter : '' }}"
                                        type="text" required class="form-control">
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label for="instagram">Instagram</label>
                                    <input id="instagram" name="instagram" value="{{ isset($record) ? $record->instagram : '' }}"
                                        type="text" required class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="snapchat">Snapchat</label>
                                    <input id="snapchat" name="snapchat" value="{{ isset($record) ? $record->snapchat : '' }}"
                                        type="text" required class="form-control">
                                </div>


                                <div class="col-md-12">
                                    <h4>About Section</h4>
                                    <hr>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="about_heading">About Heading</label>
                                    <input id="about_heading" name="about_heading" value="{{ isset($record) ? $record->about_heading : '' }}"
                                        type="text" required class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="about_content">About Description</label>
                                    <textarea name="about_content" class="form-control ckeditor" cols="30" rows="10">{{ isset($record) ? $record->about_content : '' }}</textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="about_image">About Image</label>
                                    <input id="about_image" name="about_image" type="file" class="form-control">
                                    @if(isset($record))
                                    <br>
                                    <img src="{{asset($record->about_image)}}" style="height:100px">
                                    @endif
                                </div>

                                <div class="col-md-12">
                                    <h4>Mission Section</h4>
                                    <hr>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="mission_heading">Mission Heading</label>
                                    <input id="mission_heading" name="mission_heading" value="{{ isset($record) ? $record->mission_heading	 : '' }}"
                                        type="text" required class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="mission_content">Mission Description</label>
                                    <textarea name="mission_content" class="form-control ckeditor" cols="30" rows="10">{{ isset($record) ? $record->mission_content : '' }}</textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="mission_image">Mission Image</label>
                                    <input id="mission_image" name="mission_image" type="file" class="form-control">
                                    @if(isset($record))
                                    <br>
                                    <img src="{{asset($record->mission_image)}}" style="height:100px">
                                    @endif
                                </div>

                                <div class="col-md-12">
                                    <h4>Branding Section</h4>
                                    <hr>
                                </div>
                               
                                <div class="form-group col-md-12">
                                    <label for="cover">Home Page Cover</label>
                                    <input id="cover" name="cover" type="file" class="form-control">
                                    @if(isset($record))
                                    <br>
                                    <img src="{{asset($record->cover)}}" style="height:100px">
                                    @endif
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="favicon">Favicon</label>
                                    <input id="favicon" name="favicon" type="file" class="form-control">
                                    @if(isset($record))
                                    <br>
                                    <img src="{{asset($record->favicon)}}" style="height:100px">
                                    @endif
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="logo">Logo</label>
                                    <input id="logo" name="logo" type="file" class="form-control">
                                    @if(isset($record))
                                    <br>
                                    <img src="{{asset($record->logo)}}" style="height:100px">
                                    @endif
                                </div>

                                <div class="form-group col-md-12">
                                    <hr>
                                    <button class="btn btn-primary"><i class="fa fa-check"></i> SAVE</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    <script>
        CKEDITOR.replace( 'ckeditor' );
    </script>
@endsection
