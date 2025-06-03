@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->



    <div class="form-group col-md-12">
        <label for="phone">{{ __('messages.Phone') }}</label>
        <input id="phone" name="phone" value="{{ isset($record) ? $record->phone : '' }}" type="text"
            class="form-control">
    </div>

    <!-- wallet header -->
    <div class="mb-4 mt-3 welcome">
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
                <h4 class="mb-2 mb-md-0" style="font-weight: 500; font-size: 23px;">
                    Setting
                </h4>

            </div>
            <div class="col-12 col-md-6 d-flex justify-content-md-end">
                <button class="btn setting-cancel-btn d-block me-2 w-md-auto" type="button">
                    Cancel
                </button>


                <button class="btn btn-primary primary-btn save-button d-block  w-md-auto">
                    Save
                </button>
            </div>
            <!-- <hr class="w-100 m-0 p-0 border-top border-white"
                                                                                                                                                                                                                            style="position: relative; left: 0; right: 0; width: 100vw;"> -->
        </div>
    </div>


    <!-- wallet Header -->
    <div class="mb-4 mt-3 setting-details-button">
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
                <div class="setting-button-categories">
                    <button id="accountBtn" class="btn primary-btn active">Account</button>
                    <button id="siteBtn" class="btn primary-btn">Site Configuration</button>
                    <button id="businessBtn" class="btn btn-primary">Business</button>
                </div>

            </div>
        </div>
    </div>
    <hr class="w-100 m-0 p-0 border-top border-white" style="position: relative; left: 0; right: 0; width: 100vw;">


    <!-- setting container -->
    <!-- <div class="setting-container mt-2"> -->

    <!-- Nav tabs -->
    <ul class="nav nav-tabs custom-tabs p-2" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button"
                role="tab" aria-controls="account" aria-selected="true">Account Info</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button"
                role="tab" aria-controls="security" aria-selected="false">Security</button>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content p-3 text-white" id="myTabContent">

        <!-- Account Info -->
        <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-section">
                        <form class="user-info-form">
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">FULL NAME</label>
                                    <input type="text" class="form-control" placeholder="Your Name...">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">USERNAME</label>
                                    <input type="text" class="form-control" placeholder="Your Username...">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">PHONE</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col">
                                    <label class="form-label">EMAIL</label>
                                    <input type="email" class="form-control" placeholder="Your email here...">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">FIELD</label>
                                    <select class="form-select">
                                        <option>Sales</option>
                                        <option>Marketing</option>
                                        <option>Development</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label">GENDER</label>
                                    <select class="form-select">
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">LANGUAGE</label>
                                    <select class="form-select">
                                        <option>English</option>
                                        <option>Urdu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">TIMEZONE</label>
                                    <select class="form-select">
                                        <option>Asia/Karachi</option>
                                        <option>Asia/Dubai</option>
                                        <option>America/New_York</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="photo-section mt-4">
                        <p class="photo-title">Your Photo</p>
                        <hr class="w-100 border-top border-white">
                        <img src="https://via.placeholder.com/80" class="mt-2" alt="Profile Photo">
                        <div class="mt-2">
                            <span class="text-white eidt-photo">Edit your photo</span><br>
                            <a href="#" class="text-danger text-decoration-none delete-photo">Delete</a>
                            <a href="#" class="text-info ms-2 text-decoration-none update-photo">Update</a>
                        </div>
                        <div class="upload-box mt-3">
                            <label for="fileUpload" class="d-block text-white m-0 w-100 h-100 cursor-pointer">
                                <p><strong>Click to upload</strong> or drag and drop</p>
                                <small>SVG, PNG, JPG or GIF (max. 400x400px)</small>
                            </label>
                            <input type="file" id="fileUpload" class="d-none" accept=".svg,.png,.jpg,.jpeg,.gif">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security -->
        <form action="{{ route('reset.pass') }}" id="passwordForm" method="POST">
            @csrf
            <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                <!-- Security password card -->
                <div class="password-card card-custom  ms-0" id="passwordCard">
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label password-title">Password</label>
                            <input type="password" class="form-control password-input"
                                placeholder="It is recommended to add a strong password to ensure your account’s security.">
                        </div>
                    </div>
                    <a href="#" class="forgot-link" id="forgotLink">Forget my password</a>
                </div>

                <!-- Password reset card (initially hidden) -->
                <div class="card-custom d-none ms-0" id="resetPasswordCard">
                    <!-- Current Password -->
                    <div class="mb-4">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control no-right-border" id="currentPassword"
                                placeholder="Enter your current password" name="old_password" />
                            <span class="input-group-text bg-transparent border-start-0 toggle-password">
                                <img src="{{ asset('assets/admin/img/icons/password-eye.png') }}" alt="">
                            </span>
                        </div>
                        <a href="#" class="forgot-link">Forget my password</a>
                    </div>

                    <!-- New Password -->
                    <div class="mb-4">
                        <label for="newPassword" class="form-label">New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control no-right-border" id="newPassword"
                                placeholder="Enter your new password" name="new_password" />
                            <span class="input-group-text bg-transparent border-start-0 toggle-password">
                                <img src="{{ asset('assets/admin/img/icons/password-eye.png') }}" alt="">
                            </span>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control no-right-border" id="confirmPassword"
                                placeholder="Enter confirm password " name="new_password_confirmation" />
                            <span class="input-group-text bg-transparent border-start-0 toggle-password">
                                <img src="{{ asset('assets/admin/img/icons/password-eye.png') }}" alt="">
                            </span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="change-btn btn-primary primary-btn"
                            onclick="submitFormById('passwordForm')">Change Password</button>
                    </div>
                </div>

            </div>
        </form>

    </div>

    <style>
        input[type="file"] {
            color: white;
            padding: 8px;
            border: 2px solid #1487b3;
            /* Add border */
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="file"]::-webkit-file-upload-button {
            background: linear-gradient(to right, #1487b3, #38afc3);
            border: none;
            padding: 8px 12px;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="file"]::file-selector-button {
            background: linear-gradient(to right, #1487b3, #38afc3);
            border: none;
            padding: 8px 12px;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Bottom bar */
        .cke_bottom {
            background: linear-gradient(to right, #2e3e4a, #0c2c3e) !important;
        }

        /* Buttons in the toolbar */
        .cke_button {
            background: transparent !important;
            color: white !important;
        }

        .card-custom {
            background: linear-gradient(to right, #2e3e4a, #0c2c3e) !important;
            color: white !important;
        }
    </style>



    <!-- business info first form -->
    <!-- Business Info Container (Initially hidden) -->

    <div class="row mt-5" id="mySiteData" style="display: none;">
        <div class="col-12">
            <div class="card form-section" style="height: auto;">
                <div class="card-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"> <span class="badge badge-light-primary">
                                {{ $title }}</span>
                        </li>
                    </ol>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard" style="padding-top: 0px;">
                        <form action="{{ route('save.company') }}" id="company" method="post" class="row"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ isset($record) ? $record->id : 0 }}">

                            <div class="col-md-12">
                                <h4>{{ __('messages.BASIC') }}</h4>
                                <hr>
                            </div>

                            <div class="form-group col-md-6 mb-1">
                                <label for="name">{{ __('messages.Name') }}</label>
                                <input id="name" name="name" value="{{ isset($record) ? $record->name : '' }}"
                                    type="text" required class="form-control">
                            </div>

                            <div class="form-group col-md-6 mb-1">
                                <label for="phone">{{ __('messages.Phone') }}</label>
                                <input id="phone" name="phone" value="{{ isset($record) ? $record->phone : '' }}"
                                    type="text" class="form-control">
                            </div>

                            <div class="form-group col-md-6 mb-1">
                                <label for="email">{{ __('messages.Email') }}</label>
                                <input id="email" name="email" value="{{ isset($record) ? $record->email : '' }}"
                                    type="email" required class="form-control">
                            </div>

                            <div class="form-group col-md-6 mb-1">
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

                            <div class="col-md-12 mt-2">
                                <h4>{{ __('messages.SocialMediaInfo') }}</h4>
                                <hr>
                            </div>

                            <div class="form-group col-md-6 mb-1">
                                <label for="facebook">{{ __('messages.Facebook') }}</label>
                                <input id="facebook" name="facebook"
                                    value="{{ isset($record) ? $record->facebook : '' }}" type="text" required
                                    class="form-control">
                            </div>

                            <div class="form-group col-md-6 mb-1">
                                <label for="twitter">{{ __('messages.Twitter') }}</label>
                                <input id="twitter" name="twitter"
                                    value="{{ isset($record) ? $record->twitter : '' }}" type="text" required
                                    class="form-control">
                            </div>

                            <div class="form-group col-md-6 mb-1">
                                <label for="instagram">{{ __('messages.Instagram') }}</label>
                                <input id="instagram" name="instagram"
                                    value="{{ isset($record) ? $record->instagram : '' }}" type="text" required
                                    class="form-control">
                            </div>

                            <div class="form-group col-md-6 mb-1">
                                <label for="snapchat">{{ __('messages.Snapchat') }}</label>
                                <input id="snapchat" name="snapchat"
                                    value="{{ isset($record) ? $record->snapchat : '' }}" type="text" required
                                    class="form-control">
                            </div>


                            <div class="col-md-12 mt-2">
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
                                <textarea name="about_content" id="" class="form-control ckeditor" cols="30" rows="10">{{ isset($record) ? $record->about_content : '' }}</textarea>
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
                                    value="{{ isset($record) ? $record->vision_heading : '' }}" type="text" required
                                    class="form-control">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="vision_content">{{ __('messages.VisionDescription') }}</label>
                                <textarea name="vision_content" id="" class="form-control ckeditor" cols="30" rows="10">{{ isset($record) ? $record->vision_content : '' }}</textarea>

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
                                    value="{{ isset($record) ? $record->mission_heading : '' }}" type="text" required
                                    class="form-control">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="mission_content">{{ __('messages.MissionDescription') }}</label>
                                <textarea name="mission_content" id="" class="form-control ckeditor" cols="30" rows="10">{{ isset($record) ? $record->mission_content : '' }}</textarea>
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
                                    value="{{ isset($record) ? $record->our_team_heading : '' }}" type="text" required
                                    class="form-control">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="our_team_content">{{ __('messages.OurTeamDescription') }}</label>
                                <textarea name="our_team_content" id="" class="form-control ckeditor" cols="30" rows="10">{{ isset($record) ? $record->our_team_content : '' }}</textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="our_team_image">{{ __('messages.OurTeamImage') }}</label>
                                <input id="our_team_image" name="our_team_image" type="file" class="form-control">
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
                                    value="{{ isset($record) ? $record->join_us_heading : '' }}" type="text" required
                                    class="form-control">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="join_us_content">{{ __('messages.JoinUsDescription') }}</label>
                                <textarea name="join_us_content" id="" class="form-control ckeditor" cols="30" rows="10">{{ isset($record) ? $record->join_us_content : '' }}</textarea>
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
                                <button class="btn btn-primary primary-btn" type="button"
                                    onclick="submitFormById('company')"><i class="fa fa-check"></i>
                                    {{ __('messages.SAVE') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="businessInfo" class="businessinfo-container py-1" style="display: none;">






        <!-- nav tabs for business contents -->
        <!-- Nav tabs -->
        <ul class="nav nav-tabs business-custom-tabs p-2" id="myTabtwo" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general"
                    type="button" role="tab" aria-controls="general" aria-selected="true">General</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="verification-tab" data-bs-toggle="tab" data-bs-target="#verification"
                    type="button" role="tab" aria-controls="verification"
                    aria-selected="false">Verification</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="team-tab" data-bs-toggle="tab" data-bs-target="#team" type="button"
                    role="tab" aria-controls="team" aria-selected="false">Team</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="billing-tab" data-bs-toggle="tab" data-bs-target="#billing" type="button"
                    role="tab" aria-controls="billing" aria-selected="false">Plan and
                    Billing</button>
            </li>
        </ul>
        <!-- General Business Info Section -->
        <div class="tab-content p-3">
            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                <section class="general-businessinfo">
                    <div class="form-section" id="business-form-section">
                        <div class="mb-3">
                            <label class="form-label" for="businessName">Business Name</label>
                            <input type="text" class="form-control" id="businessName" placeholder="Enter name"
                                value="Test">
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="businessDescription">Describe Your
                                Business</label>
                            <textarea class="form-control" id="businessDescription" rows="4" placeholder="Enter..."></textarea>
                        </div>
                        <div class="char-count " style="color: #1487B3; font-size: 14px;">0/250
                            characters left</div>
                    </div>

                    <!-- E-Commerce Section -->
                    <div class="form-section" id="E-commerce-form-section">
                        <div class="mb-3">
                            <label class="form-label">E-Commerce Platform</label><br>
                            <button type="button" class="btn btn-outline-info salla">Salla</button>
                            <button type="button" class="btn btn-outline-info zid">Zid</button>
                            <button type="button" class="btn btn-outline-info shopify">Shopify</button>
                            <button type="button" class="btn btn-outline-info other">Other</button>
                            <button type="button" class="btn btn-outline-info not-ecommerce">Not on
                                E-commerce</button>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="websiteUrl">Website URL</label>
                            <input for="websiteUrl" type="url" class="form-control" id="websiteUrl"
                                placeholder="Enter...">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="currency">Currency</label>
                            <input type="text" class="form-control" id="currency" value="SAR Saudi Riyal" disabled>
                        </div>
                    </div>

                    <!-- Deactivate Section -->
                    <div class="form-section" id="Deactivate-form-section">
                        <label class="form-label">Deactivate Business</label>
                        <p class="text-white deactivite-btn-para" style="font-size: 14px;">
                            When you cancel your subscription, you will not be able to use sahalih
                            service until you subscribe with a plan.
                        </p>
                        <div class="deactivite-btn-container d-flex justify-content-end">
                            <button type="button" class="btn btn-danger">Deactivate</button>
                        </div>

                    </div>
                </section>
            </div>

            <!-- verification tab -->
            <div class="tab-pane fade" id="verification" role="tabpanel" aria-labelledby="verification-tab">

                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-section" id="verification-form-details">
                            <form class="user-info-form">
                                <!-- name -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Name in English</label>
                                        <input type="text" class="form-control" placeholder="Your Name...">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Name in Arabic</label>
                                        <input type="text" class="form-control" placeholder="Your Name...">
                                    </div>
                                </div>

                                <!-- vat Number -->
                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label">VAT Number</label>
                                        <input type="text" class="form-control" placeholder="Your Username...">
                                    </div>
                                </div>

                                <!-- address -->
                                <div class="row mb-3">
                                    <div class="address-for-verification d-flex">
                                        <span class="address-title">Business Address</span>
                                        <span class="ms-3 include-location" style="color: #1487B3;">Add
                                            the location to be included in invoices and reports</span>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">ADDRESS 1</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">ADDRESS 2</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">CITY</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">POSTAL CODE</label>
                                        <input type="text" class="form-control">
                                    </div>

                                </div>
                                <!-- country -->
                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label">Country</label>
                                        <select class="form-select">
                                            <option>Pakistan</option>
                                            <option>China</option>
                                            <option>Dubai</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label">VAT CERTIFICATE <span
                                                class="text-white">(Optional)</span></label>
                                        <div class="verification-upload-box mt-3 shadow">
                                            <label for="fileUpload" style="font-size: 14px;"
                                                class="d-block text-white m-0 w-100 h-100 cursor-pointer">
                                                <p><strong style="color: #38AFC3;">Click to
                                                        upload</strong> or drag and drop</p>
                                                <small class="text-white">SVG, PNG, JPG or GIF (max.
                                                    400x400px)</small>
                                            </label>
                                            <input type="file" id="fileUpload" class="d-none"
                                                accept=".svg,.png,.jpg,.jpeg,.gif">
                                        </div>
                                    </div>
                                </div>



                            </form>
                        </div>
                    </div>


                </div>

            </div>

            <!-- team -->
            <div class="tab-pane fade" id="team" role="tabpanel" aria-labelledby="team-tab">
                <div class="row">
                    <form action="{{ route('invite.team') }}" id="InviteTeamForm" method="post">
                        @csrf
                        <div class="team-card ms-0" id="teamCard">
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label password-title">Invite Team Member</label>
                                    <input type="email" class="form-control team-input" placeholder="email address.">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" onclick="submitFormById('InviteTeamForm')"
                                    class="change-btn primary-btn">Invite
                                    Member</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- plan and billing -->
            <div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab">
                <div class="row plan-billing">
                    <!-- My Plan Card -->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-3 position-relative">
                        <div class="card myplan-card h-100">
                            <div class="card-header">
                                MY PLAN
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <textarea class="form-control my-plan-textarea" rows="3" placeholder="Plan details go here..."></textarea>
                                </div>
                                <div class="deactivite-btn-container d-flex justify-content-end">

                                    <button type="button" class="btn btn-primary primary-btn"
                                        id="myplan-deactivite">Deactivate</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method Card -->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-3">
                        <div class="card payment-card h-100">
                            <div class="card-header">
                                PAYMENT METHOD
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Choose a card">
                                </div>
                                <div class="card-btn-container d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary primary-btn add-card">
                                        <img src="../assets/img/icons/add-card-btnimage.png" alt=""
                                            width="14" height="14">
                                        Add Card</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function submitFormById(formId) {
            document.getElementById(formId).submit();
        }
    </script>
    {{-- <script src="{{ asset('assets/admin/js/dashboard.js') }}"></script> --}}

    <!-- to control button active and hide and show functionality -->
    {{-- <script>
        const accountBtn = document.getElementById('accountBtn');
        const siteBtn = document.getElementById('siteBtn');
        const businessBtn = document.getElementById('businessBtn');
        const businessInfo = document.getElementById('businessInfo');
        const myTabContent = document.getElementById('myTabContent');
        const myTab = document.getElementById('myTab');
        const mySiteData = document.getElementById('mySiteData');

        // Utility to reset all buttons
        function resetButtons() {
            accountBtn.classList.remove('active');
            siteBtn.classList.remove('active');
            businessBtn.classList.remove('active');
        }

        // Business tab logic
        businessBtn.addEventListener('click', () => {
            resetButtons();
            businessBtn.classList.add('active');

            businessInfo.style.display = 'block';
            if (myTabContent) myTabContent.style.display = 'none';
            if (myTab) myTab.style.display = 'none';
        });

        // Account tab logic
        accountBtn.addEventListener('click', () => {
            resetButtons();
            accountBtn.classList.add('active');

            businessInfo.style.display = 'none';
            if (myTabContent) myTabContent.style.display = 'block';
            if (myTab) myTab.style.display = 'flex';
        });

        // Site tab logic
        siteBtn.addEventListener('click', () => {
            resetButtons();
            siteBtn.classList.add('active');
            businessInfo.style.display = 'none';
            mySiteData.style.display = 'block';
            if (myTabContent) myTabContent.style.display = 'block';
            if (myTab) myTab.style.display = 'flex';
        });
    </script> --}}


    <script>
        (function() {
            // DOM Elements
            const accountBtn = document.getElementById('accountBtn');
            const siteBtn = document.getElementById('siteBtn');
            const businessBtn = document.getElementById('businessBtn');
            const businessInfo = document.getElementById('businessInfo');
            const myTabContent = document.getElementById('myTabContent');
            const myTab = document.getElementById('myTab');
            const mySiteData = document.getElementById('mySiteData');
            const businessDescription = document.getElementById('businessDescription');
            const charCount = document.getElementById('charCount');
            const fileUpload = document.getElementById('fileUpload');
            const fileUploadHelp = document.getElementById('fileUploadHelp');
            const teamForm = document.getElementById('teamForm');
            const deactivateBtn = document.getElementById('deactivateBtn');

            // Utility to reset button states
            function resetButtons() {
                if (accountBtn) accountBtn.classList.remove('active');
                if (siteBtn) siteBtn.classList.remove('active');
                if (businessBtn) businessBtn.classList.remove('active');
            }

            // Update character count for business description
            if (businessDescription && charCount) {
                const updateCharCount = () => {
                    const charsLeft = 250 - businessDescription.value.length;
                    charCount.textContent = `${businessDescription.value.length}/250 characters left`;
                };
                businessDescription.addEventListener('input', updateCharCount);
                updateCharCount(); // Initial count
            }

            // File upload feedback
            if (fileUpload && fileUploadHelp) {
                fileUpload.addEventListener('change', () => {
                    const file = fileUpload.files[0];
                    if (file) {
                        if (file.size > 2 * 1024 * 1024) { // 2MB limit
                            alert('File size exceeds 2MB limit.');
                            fileUpload.value = '';
                            fileUploadHelp.textContent = 'Selected file: None';
                        } else {
                            fileUploadHelp.textContent = `Selected file: ${file.name}`;
                        }
                    } else {
                        fileUploadHelp.textContent = 'Selected file: None';
                    }
                });
            }

            // Team form submission (example AJAX)
            if (teamForm) {
                teamForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const email = document.getElementById('teamEmail').value;
                    // Example AJAX call (replace with actual endpoint)
                    fetch('/api/invite-team-member', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                email
                            })
                        })
                        .then(response => response.json())
                        .then(data => alert(data.message || 'Invitation sent!'))
                        .catch(error => alert('Error sending invitation: ' + error.message));
                });
            }

            // Deactivate button (example logic)
            if (deactivateBtn) {
                deactivateBtn.addEventListener('click', () => {
                    if (confirm('Are you sure you want to deactivate your business?')) {
                        // Example AJAX call (replace with actual endpoint)
                        fetch('/api/deactivate-business', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .content
                                }
                            })
                            .then(response => response.json())
                            .then(data => alert(data.message || 'Business deactivated!'))
                            .catch(error => alert('Error deactivating business: ' + error.message));
                    }
                });
            }

            // Tab switching logic
            if (businessBtn) {
                businessBtn.addEventListener('click', () => {
                    resetButtons();
                    businessBtn.classList.add('active');
                    if (businessInfo) businessInfo.style.display = 'block';
                    if (myTabContent) myTabContent.style.display = 'none';
                    if (myTab) myTab.style.display = 'none';
                    if (mySiteData) mySiteData.style.display = 'none';
                });
            }

            if (accountBtn) {
                accountBtn.addEventListener('click', () => {
                    resetButtons();
                    accountBtn.classList.add('active');
                    if (businessInfo) businessInfo.style.display = 'none';
                    if (myTabContent) myTabContent.style.display = 'block'; // Show account content
                    if (myTab) myTab.style.display = 'flex'; // Show tab navigation
                    if (mySiteData) mySiteData.style.display = 'none';
                });
            }

            if (siteBtn) {
                siteBtn.addEventListener('click', () => {
                    resetButtons();
                    siteBtn.classList.add('active');
                    if (businessInfo) businessInfo.style.display = 'none';
                    if (myTabContent) myTabContent.style.display = 'none';
                    if (myTab) myTab.style.display = 'none';
                    if (mySiteData) mySiteData.style.display = 'block';
                });
            }
        })();
    </script>

    <!-- Toggle Password Visibility -->
    <script>
        document.querySelectorAll('.toggle-password').forEach(el => {
            el.addEventListener('click', function() {
                const input = this.previousElementSibling;
                if (input.type === 'password') {
                    input.type = 'text';
                    this.innerHTML = '<i class="bi bi-eye-slash"></i>';
                } else {
                    input.type = 'password';
                    this.innerHTML = '<i class="bi bi-eye"></i>';
                }
            });
        });
    </script>

    <!-- here control the forgot link -->
    <script>
        document.getElementById('forgotLink').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('passwordCard').classList.add('d-none');
            document.getElementById('resetPasswordCard').classList.remove('d-none');
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>


    <script>
        document.querySelectorAll('.ckeditor').forEach((textarea, index) => {
            CKEDITOR.replace(textarea, {
                contentsCss: 'data:text/css,' + encodeURIComponent(`
                    body {
                        background: linear-gradient(to right, #2e3e4a, #0c2c3e) !important;
                        color: white !important;
                    }
                `)
            });
        });
    </script>
@endpush
