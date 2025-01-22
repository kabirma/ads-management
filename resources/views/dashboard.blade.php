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
            <div class="col-lg-12 col-sm-12 col-12 mb-2">
                <h1 id="dashboardHeading">Welcome, {{Auth::user()->full_name}}</h1>
                <p>Let's start this day with a burst of creativity <i class="fa fa-rocket text-primary"></i></p>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h4 class="fw-bolder mb-0">Digital Ads</h4>
                            <p class="card-text">Enhance your visibility by amplifying your Ads</p>
                            <br><br>
                            <a href="#0" class="btn btn-dark">Start your Ads</a>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">    
                                <i class="fa fa-star font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                    <a href="#0" class="btn btn-light width50">Wallet</a>
                    <a href="#0" class="btn btn-dark width50"><i class="fa fa-wallet"></i> Top-up credits</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-12 mt-2">
                <h2>Scheduled or active campaigns</h2>
                <p>These Ads are on standby, anticipating their designated time to shine <i class="fa fa-clock text-primary"></i></p>
            </div>
            <div class="col-lg-12 col-sm-12 col-12">
                <div class="card">
                <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr style="">
                                            <th>Platform</th>
                                            <th>Schedule</th>
                                            <th>Ad type</th>
                                            <th>Budget (SAR)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>


    </section>
    <!-- Dashboard Analytics end -->


    @endif
    
@endsection


@push('scripts')
    <script>
        function cb(start, end) {
            $('.datePicker span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('.datePicker').daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                    'month')],
                'This Year': [moment().startOf('year'), moment().endOf('year')],

            },
            showDropdowns: true,
            showCustomRangeLabel: true,
            alwaysShowCalendars: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });


    </script>
@endpush
