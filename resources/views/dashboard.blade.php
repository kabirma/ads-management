@extends('layouts.master')

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/charts/chart-apex.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/app-invoice-list.css') }}">
@endpush

@section('content')
    <style>
        .width50 {
            width: 48%;
            margin-right: 1%;
        }

        #dashboardHeading {
            font-weight: 800;
        }
    </style>

    @if (Auth::user()->role_id === 1)
        <!-- Dashboard Analytics Start -->
        <section id="dashboard-analytics" style="margin-top:3%">
            <div class="row match-height">
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="fw-bolder mb-0">{{ $users }}</h2>
                                <p class="card-text">{{ __('messages.USERS') }}</p>
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
                                <h2 class="fw-bolder mb-0">{{ $adsCount }}</h2>
                                <p class="card-text">{{ __('messages.ADS') }}</p>
                            </div>
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                    <i class="fa fa-camera-alt font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="fw-bolder mb-0">{{ $pages }}</h2>
                                <p class="card-text">{{ __('messages.PAGES') }}</p>
                            </div>
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                    <i class="fa fa-pencil font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="fw-bolder mb-0">{{ $media }}</h2>
                                <p class="card-text">{{ __('messages.MEDIA') }}</p>
                            </div>
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                    <i class="fa fa-camera font-medium-5"></i>
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
                    <h1 id="dashboardHeading">{{ __('messages.WELCOME') }}, {{ Auth::user()->full_name }}</h1>
                    <p>{{ __('messages.LETS_START_THIS_DAY_WITH_A_BURST_OF_CREATIVITY') }} <i
                            class="fa fa-rocket text-primary"></i></p>
                </div>

                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h4 class="fw-bolder mb-0">{{ __('messages.DIGITAL_ADS') }}</h4>
                                <p class="card-text">{{ __('messages.ENHANCE_YOUR_VISIBILITY_BY_AMPLIFYING_YOUR_ADS') }}
                                </p>
                                <br><br>
                                <a href="{{ route('addAI.ads') }}"
                                    class="btn btn-dark">{{ __('messages.START_YOUR_ADS') }} {{ __('messages.WITH_AI') }}
                                </a>
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
                                <h5 class="card-text">{{ __('messages.WALLET') }}</h5>
                                <h1 class="fw-bolder mb-0">{{ Auth::user()->getWallet() }} {{ __('messages.SAR') }}</h1>
                                <br><br>

                            </div>
                            <div class="avatar p-50 m-0">
                                <div class="avatar-content">
                                    <i class="fa fa-dollar font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body flex">
                            <a href="#0" class="btn btn-light width50">{{ __('messages.WALLET') }}</a>
                            <a href="#0" class="btn btn-dark width50" data-bs-toggle="modal"
                                data-bs-target="#popupModal"><i class="fa fa-wallet"></i>
                                {{ __('messages.TOP_UP_CREDITS') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12 col-12 mt-2">
                    <h2>{{ __('messages.SCHEDULED_OR_ACTIVE_CAMPAIGNS') }}</h2>
                    <p>{{ __('messages.THESE_ADS_ARE_ON_STANDBY_ANTICIPATING_THEIR_DESIGNATED_TIME_TO_SHINE') }} <i
                            class="fa fa-clock text-primary"></i></p>
                </div>
                <div class="col-lg-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr style="">
                                                <th>{{ __('messages.PLATFORM') }}</th>
                                                <th>{{ __('messages.SCHEDULE') }}</th>
                                                <th>{{ __('messages.AD_TYPE') }}</th>
                                                <th>{{ __('messages.BUDGET') }} ({{ __('messages.SAR') }})</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ads as $ad)
                                                <tr>
                                                    <td>{{ $ad->platform }}</td>
                                                    <td>{{ date('M d, Y', strtotime($ad->from)) }} -
                                                        {{ date('M d, Y', strtotime($ad->to)) }}</td>
                                                    <td>{{ $ad->campaign->objective_type }}</td>
                                                    <td>{{ $ad->campaign->budget }} SAR</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


        </section>
        
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
