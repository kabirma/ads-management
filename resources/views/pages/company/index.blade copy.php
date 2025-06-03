@extends('admin.layouts.master')

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
            width: 100% !important;
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
                            <form action="{{ route('save.company') }}" method="post" class="row"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ isset($record) ? $record->id : 0 }}">

                                <div class="col-md-12">
                                    <h4>{{ __('messages.BASIC') }}</h4>
                                    <hr>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="name">{{ __('messages.Name') }}</label>
                                    <input id="name" name="name" value="{{ isset($record) ? $record->name : '' }}"
                                        type="text" required class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="phone">{{ __('messages.Phone') }}</label>
                                    <input id="phone" name="phone" value="{{ isset($record) ? $record->phone : '' }}"
                                        type="text" class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="email">{{ __('messages.Email') }}</label>
                                    <input id="email" name="email" value="{{ isset($record) ? $record->email : '' }}"
                                        type="email" required class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="address">{{ __('messages.Address') }}</label>
                                    <input id="address" name="address"
                                        value="{{ isset($record) ? $record->address : '' }}" type="text" required
                                        class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="short_description">{{ __('messages.ShortDescription') }}</label>
                                    <input id="short_description" name="short_description"
                                        value="{{ isset($record) ? $record->short_description : '' }}" type="text"
                                        required class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <h4>{{ __('messages.SocialMediaInfo') }}</h4>
                                    <hr>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="facebook">{{ __('messages.Facebook') }}</label>
                                    <input id="facebook" name="facebook"
                                        value="{{ isset($record) ? $record->facebook : '' }}" type="text" required
                                        class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="twitter">{{ __('messages.Twitter') }}</label>
                                    <input id="twitter" name="twitter"
                                        value="{{ isset($record) ? $record->twitter : '' }}" type="text" required
                                        class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="instagram">{{ __('messages.Instagram') }}</label>
                                    <input id="instagram" name="instagram"
                                        value="{{ isset($record) ? $record->instagram : '' }}" type="text" required
                                        class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="snapchat">{{ __('messages.Snapchat') }}</label>
                                    <input id="snapchat" name="snapchat"
                                        value="{{ isset($record) ? $record->snapchat : '' }}" type="text" required
                                        class="form-control">
                                </div>


                                <div class="col-md-12">
                                    <h4>{{ __('messages.AboutSection') }}</h4>
                                    <hr>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="about_heading">{{ __('messages.AboutHeading') }}</label>
                                    <input id="about_heading" name="about_heading"
                                        value="{{ isset($record) ? $record->about_heading : '' }}" type="text" required
                                        class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="about_content">{{ __('messages.AboutDescription') }}</label>
                                    <textarea name="about_content" class="form-control ckeditor" cols="30" rows="10">{{ isset($record) ? $record->about_content : '' }}</textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="about_image">{{ __('messages.AboutImage') }}</label>
                                    <input id="about_image" name="about_image" type="file" class="form-control">
                                    @if (isset($record))
                                        <br>
                                        <img src="{{ asset($record->about_image) }}" style="height:100px">
                                    @endif
                                </div>


                                <div class="col-md-12">
                                    <h4>{{ __('messages.VisionSection') }}</h4>
                                    <hr>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="vision_heading">{{ __('messages.VisionHeading') }}</label>
                                    <input id="vision_heading" name="vision_heading"
                                        value="{{ isset($record) ? $record->vision_heading : '' }}" type="text"
                                        required class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="vision_content">{{ __('messages.VisionDescription') }}</label>
                                    <textarea name="vision_content" class="form-control ckeditor" cols="30" rows="10">{{ isset($record) ? $record->vision_content : '' }}</textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="vision_image">{{ __('messages.VisionImage') }}</label>
                                    <input id="vision_image" name="vision_image" type="file" class="form-control">
                                    @if (isset($record))
                                        <br>
                                        <img src="{{ asset($record->vision_image) }}" style="height:100px">
                                    @endif
                                </div>



                                <div class="col-md-12">
                                    <h4>{{ __('messages.MissionSection') }}</h4>
                                    <hr>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="mission_heading">{{ __('messages.MissionHeading') }}</label>
                                    <input id="mission_heading" name="mission_heading"
                                        value="{{ isset($record) ? $record->mission_heading : '' }}" type="text"
                                        required class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="mission_content">{{ __('messages.MissionDescription') }}</label>
                                    <textarea name="mission_content" class="form-control ckeditor" cols="30" rows="10">{{ isset($record) ? $record->mission_content : '' }}</textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="mission_image">{{ __('messages.MissionImage') }}</label>
                                    <input id="mission_image" name="mission_image" type="file" class="form-control">
                                    @if (isset($record))
                                        <br>
                                        <img src="{{ asset($record->mission_image) }}" style="height:100px">
                                    @endif
                                </div>




                                <div class="col-md-12">
                                    <h4>{{ __('messages.OurTeamSection') }}</h4>
                                    <hr>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="our_team_heading">{{ __('messages.OurTeamHeading') }}</label>
                                    <input id="our_team_heading" name="our_team_heading"
                                        value="{{ isset($record) ? $record->our_team_heading : '' }}" type="text"
                                        required class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="our_team_content">{{ __('messages.OurTeamDescription') }}</label>
                                    <textarea name="our_team_content" class="form-control ckeditor" cols="30" rows="10">{{ isset($record) ? $record->our_team_content : '' }}</textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="our_team_image">{{ __('messages.OurTeamImage') }}</label>
                                    <input id="our_team_image" name="our_team_image" type="file"
                                        class="form-control">
                                    @if (isset($record))
                                        <br>
                                        <img src="{{ asset($record->our_team_image) }}" style="height:100px">
                                    @endif
                                </div>

                                <div class="col-md-12">
                                    <h4>{{ __('messages.JoinUsSection') }}</h4>
                                    <hr>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="join_us_heading">{{ __('messages.JoinUsHeading') }}</label>
                                    <input id="join_us_heading" name="join_us_heading"
                                        value="{{ isset($record) ? $record->join_us_heading : '' }}" type="text"
                                        required class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="join_us_content">{{ __('messages.JoinUsDescription') }}</label>
                                    <textarea name="join_us_content" class="form-control ckeditor" cols="30" rows="10">{{ isset($record) ? $record->join_us_content : '' }}</textarea>
                                </div>



                                <div class="col-md-12">
                                    <h4>{{ __('messages.BrandingSection') }}</h4>
                                    <hr>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="cover">{{ __('messages.HomePageCover') }}</label>
                                    <input id="cover" name="cover" type="file" class="form-control">
                                    @if (isset($record))
                                        <br>
                                        <img src="{{ asset($record->cover) }}" style="height:100px">
                                    @endif
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="favicon">{{ __('messages.Favicon') }}</label>
                                    <input id="favicon" name="favicon" type="file" class="form-control">
                                    @if (isset($record))
                                        <br>
                                        <img src="{{ asset($record->favicon) }}" style="height:100px">
                                    @endif
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="logo">{{ __('messages.Logo') }}</label>
                                    <input id="logo" name="logo" type="file" class="form-control">
                                    @if (isset($record))
                                        <br>
                                        <img src="{{ asset($record->logo) }}" style="height:100px">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    <script>
        CKEDITOR.replace('ckeditor');
    </script>
@endsection
