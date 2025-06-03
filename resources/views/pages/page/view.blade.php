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
    <section id="dashboard-analytics">
        <div class="row mt-5">
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

                            <li class="breadcrumb-item active"> <span class="badge badge-light-primary">{{ $title }}
                                    List</span></li>
                        </ol>

                        <a href="{{ route('add.page') }}" class="btn btn-sm btn-primary primary-btn waves-effect">
                            <i class="fa fa-plus"></i> <span>New {{ $title }}</span>
                        </a>

                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            <table id="dataTable" class="table zero-configuration ">
                                <thead>
                                    <tr style="">
                                        <th>{{ __('messages.ID') }}</th>
                                        <th>{{ __('messages.Name') }}</th>
                                        <th>{{ __('messages.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listing as $list)
                                        <tr>
                                            <td>{{ $list->id }}</td>
                                            <td>{{ $list->title }}</td>
                                            <td>
                                                <a href="{{ route('status.page', $list->id) }}"
                                                    class="btn btn-sm btn-{{ $list->status == 1 ? 'success' : 'danger' }}"><?= $list->status == 1 ? "<i class='fa fa-times'></i> Deactive" : "<i class='fa fa-check'></i> Active" ?></a>
                                                <a href="{{ route('edit.page', $list->id) }}"
                                                    class="btn btn-sm btn-primary primary-btn"><i
                                                        class="fa fa-edit"></i></a>
                                                <a href="#0" class="btn btn-sm btn-danger delete"
                                                    data-title="{{ $list->title }}"
                                                    data-href="{{ route('delete.page', $list->id) }}"><i
                                                        class="fa fa-trash"></i></a>
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
