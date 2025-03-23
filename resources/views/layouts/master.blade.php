<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<!-- BEGIN: Head-->
@php
    $cssFolder = app()->getLocale() == 'ar' ? 'assets/css-rtl' : 'assets/css';
@endphp

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title>{{$title ?? "Dashboard"}} | {{$setting->name}}</title>
    <link rel="apple-touch-icon" href="{{ asset('assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset($cssFolder.'/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($cssFolder.'/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($cssFolder.'/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($cssFolder.'/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($cssFolder.'/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($cssFolder.'/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($cssFolder.'/themes/semi-dark-layout.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset($cssFolder.'/core/menu/menu-types/vertical-menu.css') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset($cssFolder.'/plugins/extensions/ext-component-toastr.css') }}">

    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/style.css') }}">

    <style>
        @media print {

            .no-print,
            .no-print * {
                display: none !important;
                height: none !important;
                visibility: hidden !important;
            }

            @page {
                size: auto;
                margin: 0;
            }

            .sales-report .col-print-2 {
                width: calc(6/12 * 100%);
            }

            .col-print-4 {
                width: calc(4/12 * 100%);
            }
        }
    </style>
    @stack('stylesheets')
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">
    <nav
        class="no-print header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow /*container-xxl*/">
        @include('layouts.navbar')
    </nav>
    @include('layouts.search')
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow no-print" data-scroll-to-active="true">
        @include('layouts.sidebar')
    </div>
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper /*container-xxl*/ p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @include('layouts.footer')
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->

    <script src="{{ asset('assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/extensions/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>

    <!-- END: Page Vendor JS-->


    <!-- BEGIN: Page JS-->
    <script src="{{ asset('assets/js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
    <!-- END: Page JS-->

    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>

    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- END: Page JS-->
    @stack('scripts')


    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });
        toastr.options = {
            "closeButton": true,
            "debug": true,
            "newestOnTop": false,
            "maxOpened": 1,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        $(".select2").select2();

        $(document).on('click', '.delete', function() {
            toastr.remove();
            toastr['warning']('Are you sure you want to delete this Record for <b>' + $(this).attr('data-title') +
                '</b>?<br /><br /><a type="button" href="' + $(this).attr('data-href') +
                '" class="btn-sm btn-danger clear">Confirm</a>',
                'Warning', {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: false
                });
        });

        var table = $('#dataTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            "order": [[ 0, 'desc' ]]
        });
    </script>
</body>
<!-- END: Body-->

</html>
