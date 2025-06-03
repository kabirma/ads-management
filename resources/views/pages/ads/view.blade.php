@extends('admin.layouts.master')
@section('title', $title . ' ' . __('messages.List'))
@section('page_title', $title . ' ' . __('messages.List'))
@section('page_subtitle', __('messages.List') . ' ' . $title)
@section('page_breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.Dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ $title }} {{ __('messages.List') }}</li>
@endsection
@section('content')
    <!-- Dashboard Analytics Start -->




    <!-- end top nav -->

    <div class="mb-4 mt-3 welcome position-relative">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
            <h4 class="mb-2 mb-md-0" style="font-weight: 500; font-size: 23px;">
                Manage Ad
            </h4>
            <!-- manage ad section -->
            <div class="addition-btn-manage d-flex flex-wrap gap-3">
                <div class="col-auto">
                    <div class="dropdown filter-dropdowns">
                        <button class="btn customs-btn dropdown-toggle" type="button" id="filterDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Filter by
                            <img src="{{ asset('assets/admin/img/icons/manage-downarrow.png') }}"
                                class="filter-downarrow ms-1" alt="">
                        </button>
                        <ul class="dropdown-menu " aria-labelledby="filterDropdown">
                            <li><a class="dropdown-item" href="#">Option 1</a></li>
                            <li><a class="dropdown-item" href="#">Option 2</a></li>
                            <li><a class="dropdown-item" href="#">Option 3</a></li>
                        </ul>
                    </div>

                </div>
                <div>
                    <div id="period-control">
                        <button id="changePeriodBtn" class="btn chnage-periodbtn d-block w-100 w-md-auto">
                            <img src="{{ asset('assets/admin/img/icons/calender.png') }}" alt=""
                                class="calender-img"> change
                            period
                            <img src="{{ asset('assets/admin/img/icons/manage-downarrow.png') }}" class="down-arrow-img"
                                alt="" width="13" />
                        </button>
                    </div>

                </div>
            </div>

        </div>


        <div class="custom-para m-0">
            It's recommended to complete these steps before you start
            advertising.
        </div>
    </div>

    <!-- media section -->
    <div
        class="media-container d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">

        <!-- Left side: Button + Icons -->
        <div class="media-manage-contents d-flex align-items-center gap-2">
            <button type="button" class="btn btn all me-3">All</button>
            <a href="#"><img src="{{ asset('assets/admin/img/icons/manage-tiktok-icon.png') }}"
                    alt="img not found"></a>
            <a href="#"><img src="{{ asset('assets/admin/img/icons/manage-snapchat-icon.png') }}"
                    alt="img not found"></a>
            <a href="#"><img src="{{ asset('assets/admin/img/icons/manage-addsense-icon.png') }}"
                    alt="img not found"></a>
            <a href="#"><img src="{{ asset('assets/admin/img/icons/manage-fb-icon.png') }}" alt="img not found"></a>
            <a href="#"><img src="{{ asset('assets/admin/img/icons/manage-youtube-icon.png') }}"
                    alt="img not found"></a>
            <a href="#"><img src="{{ asset('assets/admin/img/icons/manage-insta-icon.png') }}"
                    alt="img not found"></a>
        </div>

        <!-- Right side: Button group aligned to the end -->

        <div class="toggle-manage-btn">
            <div class="custom-btn-group d-flex gap-2">
                <button type="button" class="btn custom-btn" id="show-card">
                    <img src="{{ asset('assets/admin/img/icons/goal-humber-btn.png') }}" alt="img not found">
                </button>
                <button type="button" class="btn custom-btn" id="show-table">
                    <img src="{{ asset('assets/admin/img/icons/dash-humber-btn.png') }}" alt="img not found">
                </button>
            </div>
        </div>
    </div>


    <!-- manage card section -->
    <div class="card-container">
        <div class="row mt-3">
            <!-- first card -->
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card manage-card position-relative">
                    <img src="{{ asset('assets/admin/img/icons/card-goal-icon.png') }}" class="card-cicle-img"
                        alt="">
                    <img src="{{ asset('assets/admin/img/icons/left-card-circle.png') }}" class="left-card-cicle-img"
                        alt="">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="snap-logo">
                                <img src="{{ asset('assets/admin/img/icons/campaign-snap-logo.png') }}" alt="Logo"
                                    style="width: 30px; height: 30px;">
                                <span class="">Sweply-SW-19674</span>
                            </div>
                            <div class="dropdown campaign-custom-dropdown">
                                <button class="btn btn-link" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Resume editing whenever <br>
                            you’re ready to launch!</p>
                        <div class="manage-card-btn text-center">
                            <a href="" class="btn btn manage-trafic-btn">Traffic</a>
                            <a href="" class="btn btn manage-find-btn">Find Your Compaign</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- second card -->
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card manage-card position-relative">
                    <img src="{{ asset('assets/admin/img/icons/card-goal-icon.png') }}" class="card-cicle-img"
                        alt="">
                    <img src="{{ asset('assets/admin/img/icons/left-card-circle.png') }}" class="left-card-cicle-img"
                        alt="">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="snap-logo">
                                <img src="{{ asset('assets/admin/img/icons/campaign-snap-logo.png') }}" alt="Logo"
                                    style="width: 30px; height: 30px;">
                                <span class="">Sweply-SW-19674</span>
                            </div>
                            <div class="dropdown campaign-custom-dropdown">
                                <button class="btn btn-link" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Resume editing whenever <br>
                            you’re ready to launch!</p>
                        <div class="manage-card-btn text-center">
                            <a href="" class="btn btn manage-trafic-btn">Traffic</a>
                            <a href="" class="btn btn manage-find-btn">Find Your Compaign</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- third card -->
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card manage-card position-relative">
                    <img src="{{ asset('assets/admin/img/icons/card-goal-icon.png') }}" class="card-cicle-img"
                        alt="">
                    <img src="{{ asset('assets/admin/img/icons/left-card-circle.png') }}" class="left-card-cicle-img"
                        alt="">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="snap-logo">
                                <img src="{{ asset('assets/admin/img/icons/campaign-snap-logo.png') }}" alt="Logo"
                                    style="width: 30px; height: 30px;">
                                <span class="">Sweply-SW-19674</span>
                            </div>
                            <div class="dropdown campaign-custom-dropdown">
                                <button class="btn btn-link" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Resume editing whenever <br>
                            you’re ready to launch!</p>
                        <div class="manage-card-btn text-center">
                            <a href="" class="btn btn manage-trafic-btn">Traffic</a>
                            <a href="" class="btn btn manage-find-btn">Find Your Compaign</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- fourth card -->
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card manage-card position-relative">
                    <img src="{{ asset('assets/admin/img/icons/card-goal-icon.png') }}" class="card-cicle-img"
                        alt="">
                    <img src="{{ asset('assets/admin/img/icons/left-card-circle.png') }}" class="left-card-cicle-img"
                        alt="">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="snap-logo">
                                <img src="{{ asset('assets/admin/img/icons/campaign-snap-logo.png') }}" alt="Logo"
                                    style="width: 30px; height: 30px;">
                                <span class="">Sweply-SW-19674</span>
                            </div>
                            <div class="dropdown campaign-custom-dropdown">
                                <button class="btn btn-link" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Resume editing whenever <br>
                            you’re ready to launch!</p>
                        <div class="manage-card-btn text-center">
                            <a href="" class="btn btn manage-trafic-btn">Traffic</a>
                            <a href="" class="btn btn manage-find-btn">Find Your Compaign</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- fifth card -->
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card manage-card position-relative">
                    <img src="{{ asset('assets/admin/img/icons/card-goal-icon.png') }}" class="card-cicle-img"
                        alt="">
                    <img src="{{ asset('assets/admin/img/icons/left-card-circle.png') }}" class="left-card-cicle-img"
                        alt="">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="snap-logo">
                                <img src="{{ asset('assets/admin/img/icons/campaign-snap-logo.png') }}" alt="Logo"
                                    style="width: 30px; height: 30px;">
                                <span class="">Sweply-SW-19674</span>
                            </div>
                            <div class="dropdown campaign-custom-dropdown">
                                <button class="btn btn-link" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Resume editing whenever <br>
                            you’re ready to launch!</p>
                        <div class="manage-card-btn text-center">
                            <a href="" class="btn btn manage-trafic-btn">Traffic</a>
                            <a href="" class="btn btn manage-find-btn">Find Your Compaign</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sixth card -->
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card manage-card position-relative">
                    <img src="{{ asset('assets/admin/img/icons/card-goal-icon.png') }}" class="card-cicle-img"
                        alt="">
                    <img src="{{ asset('assets/admin/img/icons/left-card-circle.png') }}" class="left-card-cicle-img"
                        alt="">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="snap-logo">
                                <img src="{{ asset('assets/admin/img/icons/campaign-snap-logo.png') }}" alt="Logo"
                                    style="width: 30px; height: 30px;">
                                <span class="">Sweply-SW-19674</span>
                            </div>
                            <div class="dropdown campaign-custom-dropdown">
                                <button class="btn btn-link" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Resume editing whenever <br>
                            you’re ready to launch!</p>
                        <div class="manage-card-btn text-center">
                            <a href="" class="btn btn manage-trafic-btn">Traffic</a>
                            <a href="" class="btn btn manage-find-btn">Find Your Compaign</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- seventh card -->
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card manage-card position-relative">
                    <img src="{{ asset('assets/admin/img/icons/card-goal-icon.png') }}" class="card-cicle-img"
                        alt="">
                    <img src="{{ asset('assets/admin/img/icons/left-card-circle.png') }}" class="left-card-cicle-img"
                        alt="">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="snap-logo">
                                <img src="{{ asset('assets/admin/img/icons/campaign-snap-logo.png') }}" alt="Logo"
                                    style="width: 30px; height: 30px;">
                                <span class="">Sweply-SW-19674</span>
                            </div>
                            <div class="dropdown campaign-custom-dropdown">
                                <button class="btn btn-link" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Resume editing whenever <br>
                            you’re ready to launch!</p>
                        <div class="manage-card-btn text-center">
                            <a href="" class="btn btn manage-trafic-btn">Traffic</a>
                            <a href="" class="btn btn manage-find-btn">Find Your Compaign</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- eight card -->
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card manage-card position-relative">
                    <img src="{{ asset('assets/admin/img/icons/card-goal-icon.png') }}" class="card-cicle-img"
                        alt="">
                    <img src="{{ asset('assets/admin/img/icons/left-card-circle.png') }}" class="left-card-cicle-img"
                        alt="">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="snap-logo">
                                <img src="{{ asset('assets/admin/img/icons/campaign-snap-logo.png') }}" alt="Logo"
                                    style="width: 30px; height: 30px;">
                                <span class="">Sweply-SW-19674</span>
                            </div>
                            <div class="dropdown campaign-custom-dropdown">
                                <button class="btn btn-link" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Resume editing whenever <br>
                            you’re ready to launch!</p>
                        <div class="manage-card-btn text-center">
                            <a href="" class="btn btn manage-trafic-btn">Traffic</a>
                            <a href="" class="btn btn manage-find-btn">Find Your Compaign</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- nine card -->
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card manage-card position-relative">
                    <img src="{{ asset('assets/admin/img/icons/card-goal-icon.png') }}" class="card-cicle-img"
                        alt="">
                    <img src="{{ asset('assets/admin/img/icons/left-card-circle.png') }}" class="left-card-cicle-img"
                        alt="">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="snap-logo">
                                <img src="{{ asset('assets/admin/img/icons/campaign-snap-logo.png') }}" alt="Logo"
                                    style="width: 30px; height: 30px;">
                                <span class="">Sweply-SW-19674</span>
                            </div>
                            <div class="dropdown campaign-custom-dropdown">
                                <button class="btn btn-link" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Resume editing whenever <br>
                            you’re ready to launch!</p>
                        <div class="manage-card-btn text-center">
                            <a href="" class="btn btn manage-trafic-btn">Traffic</a>
                            <a href="" class="btn btn manage-find-btn">Find Your Compaign</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- add table -->
    <div class="table-container d-none mt-3" id="campaignTable">

        <div class="table-responsive">
            <table class="table table-bordered  align-middle text-center">

                <thead>

                    <tr>
                        <th class="text-start ms-1">Name</th>
                        <th>Impression</th>
                        <th>Clicks</th>
                        <th>Spend</th>
                        <th>Total Budget</th>
                        <th>Status</th>
                        <th>...</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Row -->
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ asset('assets/admin/img/icons/manage-snapchat-icon.png') }}" width="24"
                                    height="24" />
                                <div>
                                    <div>Sweply-SW-19674</div>
                                    <span class="white small text-start">Traffic</span>
                                </div>
                            </div>
                        </td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>3222456 SAR</td>
                        <td><button class="btn btn-status btn-finish">Finish</button></td>
                        <td><span class="icon">⋮</span></td>
                    </tr>
                    <!-- Duplicate this <tr> for more rows -->
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ asset('assets/admin/img/icons/manage-snapchat-icon.png') }}" width="24"
                                    height="24" />
                                <div>
                                    <div>Sweply-SW-19674</div>
                                    <span class="white small text-start">Traffic</span>
                                </div>
                            </div>
                        </td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>3222456 SAR</td>
                        <td><button class="btn btn-status btn-pending">Pending</button></td>
                        <td><span class="icon">⋮</span></td>
                    </tr>

                    <!-- Add more rows as needed -->
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ asset('assets/admin/img/icons/manage-snapchat-icon.png') }}" width="24"
                                    height="24" />
                                <div>
                                    <div>Sweply-SW-19674</div>
                                    <span class="white small text-start">Traffic</span>
                                </div>
                            </div>
                        </td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>3222456 SAR</td>
                        <td><button class="btn btn-status btn-pending">Pending</button></td>
                        <td><span class="icon">⋮</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ asset('assets/admin/img/icons/manage-snapchat-icon.png') }}" width="24"
                                    height="24" />
                                <div>
                                    <div>Sweply-SW-19674</div>
                                    <span class="white small text-start">Traffic</span>
                                </div>
                            </div>
                        </td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>3222456 SAR</td>
                        <td><button class="btn btn-status btn-pending">Pending</button></td>
                        <td><span class="icon">⋮</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

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
                            <li class="breadcrumb-item active"> <span
                                    class="badge badge-light-primary  ">{{ $title }}</span></li>
                        </ol>
                        @if (!isset($addHide) || $addHide == 0)
                            <a href="{{ route('add.ads', 0) }}" class="btn btn-sm btn-primary primary-btn waves-effect">
                                <i class="fa fa-plus"></i> <span>{{ __('messages.New') }} {{ $title }}</span>
                            </a>
                        @endif
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            <table id="dataTable" class="table zero-configuration ">
                                <thead>
                                    <tr style="">
                                        <th>{{ __('messages.ID') }}</th>
                                        <th>{{ __('messages.Name') }}</th>
                                        <th>{{ __('messages.Platform') }}</th>
                                        <th>{{ __('messages.Dates') }}</th>
                                        <th>{{ __('messages.CTAText') }}</th>
                                        <th>{{ __('messages.CTAUrl') }}</th>
                                        <th>{{ __('messages.Media') }}</th>
                                        <th style="width: 90px">{{ __('messages.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listing as $list)
                                        <tr>
                                            <td>{{ $list->id }}</td>
                                            <td>{{ $list->name }}</td>
                                            <td>{{ $list->platform }}</td>
                                            <td>{{ date('M d, Y', strtotime($list->from)) }} -
                                                {{ date('M d, Y', strtotime($list->to)) }}</td>
                                            <td>{{ $list->call_to_action }}</td>
                                            <td>{{ $list->landing_page_url }}</td>
                                            @if ($list->media_type == 1)
                                                <td><img src="{{ $list->image_url }}" style="height:100px"></td>
                                            @else
                                                <td>Video</td>
                                            @endif
                                            <td>
                                                <a href="{{ route('detail.ads', ['id' => $list->id, 'platform' => $list->platform]) }}"
                                                    class="btn btn-sm btn-primary primary-btn"><i class="fa fa-eye"></i>
                                                    {{ __('messages.Details') }}</a>
                                                <!--
                                                                                                                    <a href="{{ route('status.ads', $list->id) }}"
                                                                                                                        class="btn btn-sm btn-{{ $list->status == 1 ? 'success' : 'danger' }}"><?= $list->status == 1 ? "<i class='fa fa-times'></i> Deactive" : "<i class='fa fa-check'></i> Active" ?></a>
                                                                                                                    <a href="{{ route('edit.ads', $list->id) }}"
                                                                                                                        class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                                                                                    <a href="#0" class="btn btn-sm btn-danger delete"
                                                                                                                        data-title="{{ $list->title }}"
                                                                                                                        data-href="{{ route('delete.ads', $list->id) }}"><i
                                                                                                                            class="fa fa-trash"></i></a> -->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- Dashboard Analytics end -->
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script>
        // alert("{{ __('messages.PleaseWait') }}");
        $(document).ready(function() {
            $('#dataTable').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        className: 'btn btn-sm btn-outline-secondary primary-btn',
                        text: '<i class="fa fa-copy"></i> Copy'
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-sm btn-outline-success primary-btn',
                        text: '<i class="fa fa-file-excel"></i> Excel'
                    },
                    {
                        extend: 'csvHtml5',
                        className: 'btn btn-sm btn-outline-primary primary-btn',
                        text: '<i class="fa fa-file-csv"></i> CSV'
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-sm btn-outline-danger primary-btn',
                        text: '<i class="fa fa-file-pdf"></i> PDF',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ],
                order: [
                    [0, 'desc']
                ],
                pageLength: 10, // default: show 10 per page
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ], // user can choose
                columnDefs: [{
                    targets: 0,
                    visible: false,
                    searchable: false
                }],

                language: {
                    paginate: {
                        previous: '<i class="fa fa-angle-left"></i>', // Use Font Awesome left angle icon
                        next: '<i class="fa fa-angle-right"></i>' // Use Font Awesome right angle icon
                    }
                }
            });
        });
        $('.delete').on('click', function() {
            var title = $(this).data('title');
            var href = $(this).data('href');
            if (confirm("Are you sure you want to delete " + title + "?")) {
                window.location.href = href;
            }
        });
    </script>
@endpush
