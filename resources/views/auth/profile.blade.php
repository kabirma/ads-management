@extends('layouts.master')

@push('stylesheets')
    <!--<link rel="stylesheet" type="text/css" href="{{asset('assets/css/plugins/charts/chart-apex.css')}}">-->
    <!--<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/app-invoice-list.css')}}">-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/css/forms/select/select2.min.css')}}">
@endpush

@section('content')

<div class="modal fade addModel" id="editUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-edit-user">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel110">Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">

                <form id="addForm" class="row gy-1">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="full_name">Full name</label>
                        <input type="text" id="full_name" name="full_name" class="form-control" value="" placeholder="Enter full name " />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="" value="" data-msg="Enter username" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="email">Email (keep blank if not email)</label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="" value="" data-msg="Enter email address" />
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="phone">Phone:</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="" placeholder="Enter Phone Number" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="mobile">Mobile:</label>
                        <input type="text" id="mobile" name="mobile" class="form-control" value="" placeholder="Enter second number" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="status">Status</label>
                        <select id="modalEditUserStatus" name="status" class="form-select" aria-label="Default select example">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>



                    <div class="col-12 col-md-6">
                        <label class="form-label" for="role_id">Roles</label>
                        <select id="role_id" name="role_id" class="select2 form-select">
                            @foreach($roles as $role)
                            <option value="{{$role->id}}" selected>{{$role->name}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="basic-default-password3">Password <button type="button" class="badge badge-light-info " style="border:0px" onclick="generatePass(8)">Generate</button></label>
                        <input type="text" id="password" name="password" autocomplete="off" class="form-control" value="" placeholder="enter password" />
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center mt-1">
                            <div class="form-check form-switch form-check-primary">
                                <input type="checkbox" class="form-check-input" id="send_sms" />
                                <label class="form-check-label" for="send_sms">
                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                </label>
                            </div>
                            <label class="form-check-label fw-bolder" for="send_sms">Send sms?</label>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                        <button type="submit" class="btn btn-primary me-1">Save <span class="upbtn" role="status" aria-hidden="true"></span></button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection


@push('scripts')

    <script src="{{asset('assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/tables/datatable/responsive.bootstrap5.js')}}"></script>
    <script src="{{asset('assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
     <script src="{{ asset('assets/js/scripts/forms/form-select2.min.js') }}"></script>

@endpush