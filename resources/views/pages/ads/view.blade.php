@extends('admin.layouts.master')
@section('title', $title . ' ' . __('messages.List'))
@section('page_title', $title . ' ' . __('messages.List'))
@section('page_subtitle', __('messages.List') . ' ' . $title)
@section('page_breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.Dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ $title }} {{ __('messages.List') }}</li>
@endsection
@push('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush
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
            <a href="{{ route('view.ads', ['platform' => 'all']) }}"
                class="btn btn all {{ request('platform') == 'all' ? 'btn-dark' : '' }}">All</a>
            <a href="{{ route('view.ads', ['platform' => 'tiktok']) }}">
                <img src="{{ asset('assets/admin/img/icons/manage-tiktok-icon.png') }}"></a>
            <a href="{{ route('view.ads', ['platform' => 'snapchat']) }}">
                <img src="{{ asset('assets/admin/img/icons/manage-snapchat-icon.png') }}"></a>
            <a href="{{ route('view.ads', ['platform' => 'google']) }}">
                <img src="{{ asset('assets/admin/img/icons/manage-addsense-icon.png') }}"></a>
            <a href="{{ route('view.ads', ['platform' => 'facebook']) }}">
                <img src="{{ asset('assets/admin/img/icons/manage-fb-icon.png') }}"></a>
            <a href="{{ route('view.ads', ['platform' => 'youtube']) }}">
                <img src="{{ asset('assets/admin/img/icons/manage-youtube-icon.png') }}"></a>
            <a href="{{ route('view.ads', ['platform' => 'instagram']) }}">
                <img src="{{ asset('assets/admin/img/icons/manage-insta-icon.png') }}"></a>
        </div>


        <form method="GET" action="{{ route('view.ads') }}" id="searchForm">
            <input type="hidden" name="platform" id="platformInput" value="{{ request('platform') }}">
            <!-- optional search bar -->
        </form>

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



    <div class="row mt-3 mb-3">
        <div class="col-md-10">
            <form method="GET" action="{{ route('view.ads') }}">
                <div class="row">
                    <div class="col-md-11">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search campaigns..." class="form-control " style="color: white" />

                        <input type="hidden" name="platform" id="platformInput" value="{{ request('platform') }}">


                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary primary-btn">Search</button>

                    </div>
                </div>
            </form>

        </div>
        <div class="col-auto d-flex justify-content-end">
            @if (!isset($addHide) || $addHide == 0)
                <a href="{{ route('add.ads', 0) }}" class="btn  btn-primary primary-btn waves-effect">
                    <i class="fa fa-plus"></i> <span>{{ __('messages.New') }} {{ $title }}</span>
                </a>
            @endif
        </div>

    </div>



    <!-- manage card section -->
    <div class="card-container">


        <div class="row mt-4">


            @foreach ($listing as $list)
                @php
                    $platformIcon = match ($list->platform) {
                        'tiktok' => 'manage-tiktok-icon.png',
                        'snapchat' => 'manage-snapchat-icon.png',
                        'google' => 'manage-addsense-icon.png',
                        'facebook' => 'manage-fb-icon.png',
                        'youtube' => 'manage-youtube-icon.png',
                        'instagram' => 'manage-insta-icon.png',
                        default => 'manage-snapchat-icon.png', // fallback
                    };
                @endphp

                <div class="col-sm-12 col-md-4 mb-4">
                    <div class="card manage-card position-relative">
                        <!-- Decorative Images -->
                        <img src="{{ asset('assets/admin/img/icons/card-goal-icon.png') }}" class="card-cicle-img"
                            alt="">
                        <img src="{{ asset('assets/admin/img/icons/left-card-circle.png') }}" class="left-card-cicle-img"
                            alt="">

                        <!-- Card Header -->
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="snap-logo">
                                    {{-- <img src="{{ asset('assets/admin/img/icons/campaign-snap-logo.png') }}"
                                        alt="Logo" style="width: 30px; height: 30px;"> --}}
                                    <img src="{{ asset('assets/admin/img/icons/' . $platformIcon) }}"
                                        alt="{{ $list->platform }} logo" style="width: 40px; height: 40px;">

                                    <span>{{ $list->name ?? 'No Name' }}</span>
                                </div>
                                {{-- <div class="dropdown campaign-custom-dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button"
                                        id="dropdownMenuButton{{ $list->id }}" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $list->id }}">
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('detail.ads', ['id' => $list->id, 'platform' => $list->platform]) }}">
                                                <i class="fa fa-eye"></i> Details
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('edit.ads', $list->id) }}">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-danger delete" href="#0"
                                                data-title="{{ $list->name }}"
                                                data-href="{{ route('delete.ads', $list->id) }}">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div> --}}

                                <div class="dropdown campaign-custom-dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="/details"><i class="fa fa-eye"></i>
                                                Details</a></li>
                                        <li><a class="dropdown-item" href="/edit"><i class="fa fa-edit"></i> Edit</a>
                                        </li>
                                        <li><a class="dropdown-item text-danger delete" href="#0" data-title="Test"
                                                data-href="/delete"><i class="fa fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <p>
                                {{ $list->call_to_action ?? 'Resume editing whenever you’re ready to launch!' }}
                            </p>

                            <div class="manage-card-btn text-center">
                                <a href="#" class="btn btn manage-trafic-btn">Traffic</a>
                                <a href="#" class="btn btn manage-find-btn">Find Your Campaign</a>

                                <!-- Optional: Details button in body -->
                                <a href="{{ route('detail.ads', ['id' => $list->id, 'platform' => $list->platform]) }}"
                                    class="btn btn-sm btn-primary mt-2">
                                    <i class="fa fa-eye"></i> Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $listing->appends(request()->query())->links() }}
        </div>

        <div class="row mt-3">


            <!-- first card -->
            {{-- <div class="col-sm-12 col-md-4 mb-4">
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
            </div> --}}

            {{--
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
            </div> --}}

        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="{{ asset('assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> --}}
    <!-- Bootstrap JS (with Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <style>
        .dropdown-menu {
            z-index: 1000;
        }
    </style>
    <script>
        var dropdowns = document.querySelectorAll('.dropdown-toggle');
        dropdowns.forEach(function(element) {
            new bootstrap.Dropdown(element);
        });
        document.querySelectorAll('.media-manage-contents a').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                const url = new URL(this.href);
                const platform = url.searchParams.get('platform');
                document.getElementById('platformInput').value = platform ?? '';

                document.getElementById('searchForm').submit();
            });
        });
    </script>
    <script>
        // alert("{{ __('messages.PleaseWait') }}");


        // $(document).ready(function() {
        //     $('#dataTable').DataTable({
        //         responsive: true,
        //         dom: 'Bfrtip',
        //         buttons: [{
        //                 extend: 'copyHtml5',
        //                 className: 'btn btn-sm btn-outline-secondary primary-btn',
        //                 text: '<i class="fa fa-copy"></i> Copy'
        //             },
        //             {
        //                 extend: 'excelHtml5',
        //                 className: 'btn btn-sm btn-outline-success primary-btn',
        //                 text: '<i class="fa fa-file-excel"></i> Excel'
        //             },
        //             {
        //                 extend: 'csvHtml5',
        //                 className: 'btn btn-sm btn-outline-primary primary-btn',
        //                 text: '<i class="fa fa-file-csv"></i> CSV'
        //             },
        //             {
        //                 extend: 'pdfHtml5',
        //                 className: 'btn btn-sm btn-outline-danger primary-btn',
        //                 text: '<i class="fa fa-file-pdf"></i> PDF',
        //                 orientation: 'landscape',
        //                 pageSize: 'A4',
        //                 exportOptions: {
        //                     columns: ':visible'
        //                 }
        //             }
        //         ],
        //         order: [
        //             [0, 'desc']
        //         ],
        //         pageLength: 10, // default: show 10 per page
        //         lengthMenu: [
        //             [10, 25, 50, 100],
        //             [10, 25, 50, 100]
        //         ], // user can choose
        //         columnDefs: [{
        //             targets: 0,
        //             visible: false,
        //             searchable: false
        //         }],

        //         language: {
        //             paginate: {
        //                 previous: '<i class="fa fa-angle-left"></i>', // Use Font Awesome left angle icon
        //                 next: '<i class="fa fa-angle-right"></i>' // Use Font Awesome right angle icon
        //             }
        //         }
        //     });
        // });
        $('.delete').on('click', function() {
            var title = $(this).data('title');
            var href = $(this).data('href');
            if (confirm("Are you sure you want to delete " + title + "?")) {
                window.location.href = href;
            }
        });
    </script>
@endpush
