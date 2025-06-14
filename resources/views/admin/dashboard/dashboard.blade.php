@extends('admin.layouts.master')

@push('stylesheets')
@endpush

@section('content')
    <div class="mb-4 mt-3 welcome">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
            <h4 class="mb-2 mb-md-0" style="font-weight: 500; font-size: 23px;">
                Welcome Hammad Business
            </h4>

            <div class="addition-btn-main">
                <a class="btn btn-primary primary-btn addition-button d-block w-100 w-md-auto"
                    href="{{ route('addAI.ads') }}">
                    <img src="{{ asset('assets/admin/img/icons/addition.png') }}" alt="" width="13" />
                    Create New Campaign
                </a>
            </div>
        </div>


        <div class="custom-para m-0">
            It's recommended to complete these steps before you start
            advertising.
        </div>
    </div>

    <!-- dashboard card -->

    <div class="row mb-4">
        <div class="col-sm-12 col-md-4 mb-3">
            <div class="card p-3 dashboard-card">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="dashboard-title">Top Up Wallet</h5>
                        <p>Add funds to your wallet and get ready to create ads.</p>
                        <button type="button" class="btn btn-outline-light btn-sm custom-btn">
                            Fuel your wallet
                        </button>
                    </div>
                    <div class="col-md-4 dashboard-card-img">
                        <img src="{{ asset('assets/admin/img/icons/wallet.png') }}" alt="image not found" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 mb-3">
            <div class="card p-3 dashboard-card">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="dashboard-title">Connect Support</h5>
                        <p>Add funds to your wallet and get ready to create ads.</p>
                        <button type="button" class="btn btn-outline-light btn-sm custom-btn">
                            Fuel your wallet
                        </button>
                    </div>
                    <div class="col-md-4 dashboard-card-img">
                        <img src="{{ asset('assets/admin/img/icons/support.png') }}" alt="image not found" width="89"
                            height="89" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-3 dashboard-card">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="dashboard-title">Create Campaign</h5>
                        <p>Add funds to your wallet and get ready to create ads.</p>
                        <button type="button" class="btn btn-outline-light btn-sm custom-btn">
                            Fuel your wallet
                        </button>
                    </div>
                    <div class="col-md-4 dashboard-card-img">
                        <img src=" {{ asset('assets/admin/img/icons/campaign.png') }}" alt="image not found" width="89"
                            height="89" />
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="overview-top-contents d-flex justify-content-between">
                <div class="over-headings m-0">
                    <h5 class="ms-2">My Campaigns</h5>
                    <div class="text-white ms-2">
                        3 persons and @yarimaldo have access.
                    </div>
                </div>

                <!-- add finance button -->
                <div class="dropdown overview-dropdown">
                    <button class="btn btn-secondary dropdown-toggle bg-dark border-0" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Finance
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Finance 1</a></li>
                        <li><a class="dropdown-item" href="#">Finance 2</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="overview-top-contents d-flex justify-content-between">
                <div class="over-headings m-0">
                    <h5 class="ms-2">My Campaigns</h5>
                    <div class="text-white ms-2">
                        3 persons and @yarimaldo have access.
                    </div>
                </div>

                <!-- add finance button -->
                <div class="dropdown overview-dropdown">
                    <button class="btn btn-secondary dropdown-toggle bg-dark border-0" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Us Dollar
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Dollar 1</a></li>
                        <li><a class="dropdown-item" href="#">Dollar 2</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>



    <!-- overview -->
    <div class="row">
        <div class="col-md-6 mb-4 mt-4">
            <div class="card overview-card  p-3">
                <div class="overview-head d-flex justify-content-between">
                    <h5>Overview</h5>
                    <img src="{{ asset('assets/admin/img/icons/overview-icon.png') }}" alt="" width="21"
                        height="21">
                </div>

                <div class="overview-record d-flex justify-content-between">
                    <div class="text-white" style="font-size: 14px;">max Records</div>
                    <div class="text-white" style="font-size: 14px;">2 times increase to the last month</div>
                </div>
                <div class="overview-rate d-flex justify-content-between">
                    <div class="text-white" style="font-size: 14px;">Comparative rates</div>
                    <span class="overview-value" style="font-size: 14px;">+12.83%</span>
                </div>
                <div class="chart">

                </div>
                <ul class="nav nav-tabs mb-3 mt-3 d-flex  border p-2 rounded chart-parent" id="myTab" role="tablist">
                    <li class="nav-item border-0" role="presentation ">
                        <button class="nav-link active" data-bs-toggle="tab" data-range="24h">24h</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-range="week">Week</button>
                    </li>
                    <li class="nav-item border-0" role="presentation">
                        <button class="nav-link " data-bs-toggle="tab" data-range="month">Month</button>
                    </li>
                </ul>

                <div class="chart-box">
                    <canvas id="lineChart" height="100"></canvas>
                    <hr class="text-white">
                </div>


                <!-- data update -->
                <div class="chart-update-data d-flex justify-content-between">
                    <div class="cahrt-value">
                        <div class="charta-data">
                            <img src=" {{ asset('assets/admin/img/icons/update-adtion.png') }}" alt=""> <span
                                class="text-white">19.34%</span>
                        </div>
                    </div>
                    <div class="last-update">
                        <span>Last Update</span>
                        <div class="date">
                            <span class="text-white">Today, 06:49 AM</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6 mb-4 mt-2">
            <div class="row">
                <!-- Total Income -->
                <div class="col-md-6">
                    <div class="balance-box mb-3">
                        <div class="row">
                            <!-- Text content -->
                            <div class="col-md-6">
                                <h6 style="font-size: 14px;">Total Income</h6>
                                <h4>$1285</h4>
                                <p class="text-success">+3.7%</p>
                            </div>
                            <!-- Graph and label -->
                            <div class="col-md-6 text-end">
                                <p class="mb-1 text-white small" style="font-size: 10px;">This Month</p>
                                <canvas id="incomeChart" height="60"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Expense -->
                <div class="col-md-6">
                    <div class="balance-box mb-3">
                        <div class="row">
                            <!-- Text content -->
                            <div class="col-md-6">
                                <h6 style="font-size: 14px;">Total Expense</h6>
                                <h4>$1567</h4>
                                <p class="text-danger">-4.5%</p>
                            </div>
                            <!-- Graph and label -->
                            <div class="col-md-6 text-end">
                                <p class="mb-1 text-white small" style="font-size: 10px;">This Month</p>
                                <canvas id="expenseChart" height="60"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row campaing-parent-container">
                    <div class="top-campaign d-flex justify-content-between">
                        <div>
                            <h5 class="campaign-title">My Top Campaign</h5>
                        </div>
                        <div class="campaign-pagination-controls">
                            <span>02 of 5</span>
                            <button><img src="{{ asset('assets/admin/img/icons/campaign-right.png') }}"
                                    alt=""></button>
                            <button><img src=" {{ asset('assets/admin/img/icons/campaign-left.png') }}"
                                    alt=""></button>

                        </div>
                    </div>
                    <!-- campaign container -->
                    <div class="row campaign-container">
                        <div class="col-sm-12 col-md-6">
                            <div class="card campaign-card position-relative">
                                <img src="{{ asset('assets/admin/img/icons/card-goal-icon.png') }}"
                                    class="top-card-cicle img-fluid" alt="">
                                <!-- <img src="../assets/img/icons/left-card-circle.png" class="left-card-circle img-fluid" alt=""> -->
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="snap-logo">
                                            <img src="../assets/img/icons/campaign-snap-logo.png" alt="Logo"
                                                style="width: 30px; height: 30px;">
                                            <span class=" d-block">Sweply-SW-19674</span>
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
                                    <p class="card-text">Add Running</p>
                                    <div class="followers-count"># 3,078 Followers</div>
                                    <div class="percentage-change">+ 9.34%</div>
                                </div>
                                <div class="card-footer">
                                    <div class="icons">
                                        <div class="icon active"><i class="fas fa-circle"></i></div>
                                        <div class="icon"><i class="fas fa-circle"></i></div>
                                        <div class="icon"><i class="fas fa-circle"></i></div>
                                        <div class="icon"><i class="fas fa-circle"></i></div>
                                        <div class="icon"><i class="fas fa-circle"></i></div>
                                        <div class="icon add"><i class="fas fa-plus"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="card  campaign-card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="logo">
                                            <img src="../assets/img/icons/campaign-snap-logo.png" alt="Logo"
                                                style="width: 30px; height: 30px;">
                                            <span class="d-block">Sweply-SW-19388</span>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-link text-white" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-dark">
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
                                    <p class="card-text">Add Running</p>
                                    <div class="followers-count"># 3,078 Followers</div>
                                    <div class="percentage-change">+ 9.34%</div>
                                </div>
                                <div class="card-footer">
                                    <div class="icons">
                                        <div class="icon active"><i class="fas fa-circle"></i></div>
                                        <div class="icon"><i class="fas fa-circle"></i></div>
                                        <div class="icon"><i class="fas fa-circle"></i></div>
                                        <div class="icon"><i class="fas fa-circle"></i></div>
                                        <div class="icon"><i class="fas fa-circle"></i></div>
                                        <div class="icon add"><i class="fas fa-plus"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Popular Campaign Table -->
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Popular Campaign</h5>
            <select class="filter-dropdown">
                <option>Filter By</option>
                <option>Public</option>
                <option>Private</option>
            </select>
        </div>

        <!-- Responsive Table Wrapper -->
        <div class="table-responsive">
            <table class="table campaign-table">
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Name</th>
                        <th>Admin</th>
                        <th>Date Added</th>
                        <th>Business</th>
                        <th>Followers</th>
                        <th>Status</th>
                        <th class="ms-3">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#1</td>
                        <td>IBO Adve...</td>
                        <td><img src="https://i.pravatar.cc/30?img=1" class="avatar me-2"> Samuel</td>
                        <td>05/14/2025</td>
                        <td>Advertising</td>
                        <td class="followers-icons">
                            <i class="fas fa-circle"></i>
                            <i class="fas fa-circle"></i>
                            <i class="fas fa-circle"></i>
                            <span class="badge-followers">99+</span>
                        </td>
                        <td>
                            <div class="status-public text-center">Public</div>
                        </td>
                        <td>
                            <button class="btn btn-join">Join</button>
                            <button class="btn btn-link text-white"><i class="fas fa-ellipsis-h"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#2</td>
                        <td>Rauf Ahm...</td>
                        <td><img src="https://i.pravatar.cc/30?img=2" class="avatar me-2"> Hammad</td>
                        <td>05/14/2025</td>
                        <td>Design Agency</td>
                        <td class="followers-icons">
                            <i class="fas fa-circle"></i>
                            <i class="fas fa-circle"></i>
                            <i class="fas fa-circle"></i>
                            <span class="badge-followers">99+</span>
                        </td>
                        <td>
                            <div class="status-public text-center">Public</div>
                        </td>
                        <td>
                            <button class="btn btn-join">Join</button>
                            <button class="btn btn-link text-white"><i class="fas fa-ellipsis-h"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#3</td>
                        <td>Abrahim</td>
                        <td><img src="https://i.pravatar.cc/30?img=3" class="avatar me-2"> Samuel</td>
                        <td>05/14/2025</td>
                        <td>Advertising</td>
                        <td class="followers-icons">
                            <i class="fas fa-circle"></i>
                            <i class="fas fa-circle"></i>
                            <i class="fas fa-circle"></i>
                            <span class="badge-followers">99+</span>
                        </td>
                        <td>
                            <div class="status-private text-center">Private</div>
                        </td>
                        <td>
                            <button class="btn btn-requested">Requested</button>
                            <button class="btn btn-link text-white"><i class="fas fa-ellipsis-h"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#4</td>
                        <td>David</td>
                        <td><img src="https://i.pravatar.cc/30?img=4" class="avatar me-2"> Samuel</td>
                        <td>05/14/2025</td>
                        <td>Programming</td>
                        <td class="followers-icons">
                            <i class="fas fa-circle"></i>
                            <i class="fas fa-circle"></i>
                            <i class="fas fa-circle"></i>
                            <span class="badge-followers">99+</span>
                        </td>
                        <td>
                            <div class="status-public text-center">Public</div>
                        </td>
                        <td>
                            <button class="btn btn-join">Join</button>
                            <button class="btn btn-link text-white text-end"><i class="fas fa-ellipsis-h"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Pagination + View Count -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <span>View
                    <select class="filter-view border bg-transparent text-white p-1">
                        <option>05</option>
                        <option>06</option>
                        <option>07</option>
                    </select>
                </span>
                <nav>
                    <ul class="pagination mb-0">
                        <i class="fas fa-chevron-left me-2 mt-2"></i> <!-- Left Chevron -->
                        <li class="page-item active"><a class="page-link" href="#">01</a></li>
                        <li class="page-item"><a class="page-link" href="#">02</a></li>
                        <li class="page-item"><a class="page-link" href="#">03</a></li>
                        <i class="fas fa-chevron-right mt-2 me-2"></i> <!-- Right Chevron -->
                    </ul>
                </nav>
            </div>
        </div>


    </div>



    <!-- Engagement analysis section -->

    <div class="engagement-container py-3">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card-custom mb-3">
                    <div class="d-flex align-items-center mb-2">
                        <img src=" {{ asset('assets/admin/img/icons/adsens-icon.png') }}" alt="Google Ads"
                            width="24" class="me-2">
                        <strong>Ad Name <span class="d-block">GOCA #30</span></strong>
                        <span class="ms-auto"><span class="status-dot"></span> Active</span>
                    </div>
                    <canvas id="chartGoca"></canvas>
                    <div class="pt-2">
                        <h5>245K</h5>
                        <div class="impression-content d-flex justify-content-between">
                            <small>Impressions</small><br>
                            <small>04-17-2025</small>
                        </div>

                    </div>
                </div>

                <div class="card-custom">
                    <div class="d-flex align-items-center mb-2">
                        <img src=" {{ asset('assets/admin/img/icons/youtube-icon.png') }}" alt="YouTube" width="24"
                            class="me-2">
                        <strong>Ad Name YOCA #28</strong>
                        <span class="ms-auto"><span class="status-dot"></span> Active</span>
                    </div>
                    <canvas id="chartYoca"></canvas>
                    <div class="pt-2">
                        <h5>365K</h5>
                        <div class="impression-content d-flex justify-content-between">
                            <small>Impressions</small><br>
                            <small>04-17-2025</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="analytic-graph-container">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Engagement Analytics</h4>
                        <div class="d-flex gap-4 align-items-center me-4 media-select">
                            <select class="dropdown-custom social-media-dropdown">
                                <option>Social media</option>
                            </select>
                            <select class="dropdown-custom">
                                <option>Monthly</option>
                            </select>
                            <div class="media-upload-file">
                                <img src=" {{ asset('assets/admin/img/icons/engagment-file-icon.png') }}" alt="">
                            </div>
                        </div>

                    </div>
                    <div class="popular-app d-block">
                        <button class="btn btn-custom">
                            <img src="{{ asset('assets/admin/img/icons/tiktok-stroke.png') }}" alt="">
                            TikTok</button>
                        <button class="btn btn-custom">
                            <img src="{{ asset('assets/admin/img/icons/snapchat-stroke.png') }}" alt="">
                            Snapchat</button>
                    </div>
                    <canvas id="engagementChart"></canvas>
                </div>
            </div>
        </div>
    </div>


    <!-- traffic effective and schedule section -->
    <div class="container py-4">
        <div class="row g-4">
            <!-- Traffic Effective Card -->
            <div class="col-md-6">
                <div class="card p-4 h-100 traffic-card">



                    <div class="d-flex justify-content-between ">
                        <div class="trafic-heading">
                            <h5 class="mb-4">Traffic Effective</h5>
                        </div>
                        <div class="dropdown trafic-custom-dropdown">
                            <button class="btn btn-link" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v text-white"></i>
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
                    <div class="d-flex justify-content-around text-center">
                        <div>
                            <p class="mb-2">Paid</p>
                            <div class="chart-container">
                                <canvas id="paidChart"></canvas>
                            </div>
                        </div>
                        <div>
                            <p class="mb-2">Direct</p>
                            <div class="chart-container">
                                <canvas id="directChart"></canvas>
                            </div>
                        </div>
                        <div>
                            <p class="mb-2">Organic</p>
                            <div class="chart-container">
                                <canvas id="organicChart"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Schedule Card -->
            <div class="col-md-6">
                <div class="card p-4 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Schedule</h5>
                        <div>
                            <button class="btn filter-btn-by me-2">Filter By</button>
                            <button class="btn filter-btn me-2">
                                <i class="bi bi-calendar"></i>
                            </button>
                            <button class="btn btn-primary primary-btn">+</button>
                        </div>
                    </div>
                    <div class="table-responsive schedule-table">
                        <table class="table table-borderless table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#1</td>
                                    <td>IBO Adve...</td>
                                    <td>Coming...</td>
                                    <td>05/14/2025</td>
                                    <td>...</td>
                                </tr>
                                <tr>
                                    <td>#1</td>
                                    <td>IBO Adve...</td>
                                    <td>Coming...</td>
                                    <td>05/14/2025</td>
                                    <td>...</td>
                                </tr>
                                <tr>
                                    <td>#1</td>
                                    <td>IBO Adve...</td>
                                    <td>Coming...</td>
                                    <td>05/14/2025</td>
                                    <td>...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="see-more">See more</div>
                </div>
            </div>
        </div>
    </div>
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
