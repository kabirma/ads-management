@extends('layouts.master')

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/charts/chart-apex.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/app-invoice-list.css') }}">
@endpush

@section('content')
    <style>
        .width50{
            width:48%;
            margin-right:1%;
        }
        #dashboardHeading{
                    font-weight:800;
        }

    </style>

    @if(Auth::user()->role_id === 1)

    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics" style="margin-top:3%">
        <div class="row match-height">
            <div class="col-lg-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h2 class="fw-bolder mb-0">{{ $spotlight_events }}</h2>
                            <p class="card-text">Users</p>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">    
                                <i class="fa fa-users font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h2 class="fw-bolder mb-0">{{ $events }}</h2>
                            <p class="card-text">Ads</p>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="fa fa-camera-alt font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h2 class="fw-bolder mb-0">{{ $pages }}</h2>
                            <p class="card-text">Pages</p>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="fa fa-pencil font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>


    </section>
    <!-- Dashboard Analytics end -->

    @else

    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics" style="margin-top:3%">
        <div class="row match-height">
            <div class="col-lg-6 col-sm-6 col-12">
                <div class="card bg-light-primary ">
                    <div class="card-header">
                        <div>
                            <h5 class="card-text">Your Balance</h5>
                            <h1 class="fw-bolder mb-0">0.0 SAR</h1>
                            <br><br>
                        
                        </div>
                        <div class="avatar p-50 m-0">
                            <div class="avatar-content">
                                <i class="fa fa-dollar font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body flex">
                    <form action="{{ route('mastercard.create') }}" method="POST">
                        @csrf
                        <input type="number" name="amount" required placeholder="Top Up Amount">
                        <button type="submit">Topup Wallet</button>
                    </form>
                    </div>
                </div>
            </div>

            
        </div>


    </section>
    <!-- Dashboard Analytics end -->


    @endif
    
@endsection

