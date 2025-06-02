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
                <h5 class="modal-title" id="myModalLabel110">Add New User</h5>
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
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
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





<div class="modal fade upModel modal-success" id="" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-edit-user">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel110">Update User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">

                <form id="upForm" class="row gy-1">
                    <input type="hidden" name="cid" id="cid">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="full_name">Full name</label>
                        <input type="text" id="fname" name="full_name" class="form-control" value="" placeholder="Enter full name " />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" id="uname" name="username" class="form-control" placeholder="" value="" data-msg="Enter username" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="email">Email (keep blank if not email)</label>
                        <input type="text" id="uemail" name="email" class="form-control" placeholder="" value="" data-msg="Enter email address" />
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="phone">Phone:</label>
                        <input type="text" id="uphone" name="phone" class="form-control" value="" placeholder="Enter Phone Number" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="mobile">Mobile:</label>
                        <input type="text" id="umobile" name="mobile" class="form-control" value="" placeholder="Enter second number" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="ustatus">Status</label>
                        <select id="ustatus" name="status" class="form-select" aria-label="Default select example">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>



                    <div class="col-12 col-md-6">
                        <label class="form-label" for="role_id">Roles</label>
                        <select id="roleid" name="role_id" class="select2 form-select">
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="basic-default-password3">Password <button type="button" class="badge badge-light-success" id="changePass" style="border:0px">Change</button> <button type="button" class="badge badge-light-info " style="border:0px;display:none" id="generatePass" onclick="ugeneratePass(8)">Generate</button></label>
                        <input type="text" id="upassword" name="password" disabled autocomplete="off" class="form-control" value="" placeholder="enter password" />
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center mt-1">
                            <div class="form-check form-switch form-check-primary">
                                <input type="checkbox" class="form-check-input" id="usend_sms" name="send_sms" />
                                <label class="form-check-label" for="usend_sms">
                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                </label>
                            </div>
                            <label class="form-check-label fw-bolder" for="usend_sms">Send sms?</label>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-2 pt-50">
                         <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                        <button type="submit" class="btn btn-success me-1">Update <span class="upbtn" role="status" aria-hidden="true"></span></button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>






                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">
                         <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" >
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item active"> <span class="badge badge-light-info">All User List</span></li>
                    </ol>

                    <a  type="button" class="btn btn-sm btn-info waves-effect addnew">
                        <i data-feather='plus-circle'></i>   <span>New User</span>
                    </a >

                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard" style="padding-top: 0px;">
                        <div class="table-responsive">
                            <table id="dataTable" class="table zero-configuration ">
                                <thead>
                                    <tr style="">
                                        <th>ID</th>
                                        <th>Registration Date</th>
                                        <th>Username</th>
                                        <th>Contact</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
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
@endsection


@push('scripts')

    <script src="{{asset('assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/tables/datatable/responsive.bootstrap5.js')}}"></script>
    <script src="{{asset('assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
     <script src="{{ asset('assets/js/scripts/forms/form-select2.min.js') }}"></script>

    <!--<script src="{{asset('assets/js/scripts/pages/app-invoice-list.js')}}"></script>-->
    <script>
        function generatePass(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   $("#password").val('ITD'+result);
   return false;

}
function ugeneratePass(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   $("#upassword").val('ITD'+result);
   return false;

}

   var table = $('#dataTable').DataTable(
    {
        "responsive" : true,"autoWidth"  : false,
//        "ordering": false,"paging" : true,
        "processing" : true,"serverSide": true,
//        "columnDefs": [{ responsivePriority: 1, targets: 0 }],
        "ajax":
            {
                "url":"<?= route('list.user') ?>","dataType":"json","type":"POST",
                "data": function ( d )
                {
                    d._token= $('meta[name="csrf-token"]').attr('content');
                }
            },
        "columns":[
        {"data":"a"},{"data":"b"},{"data":"c"},{"data":"d"},{"data":"e"},{"data":"f"},{"data":"g","searchable":false,"orderable":false}
    ],
        "order": [[0, 'desc']]
});
$(".addnew").on('click',function()
{
    $('.addbtn').removeClass('spinner-border spinner-border-sm');
    document.getElementById("addForm").reset();
    $('.addModel').modal('show');
});
$("#changePass").on('click',function()
{
    $('#generatePass').css('display','inline-block'); $("#upassword").removeAttr('disabled');
});


$("#addForm").on('submit',function(event)
{
    $('.addbtn').removeClass('spinner-border spinner-border-sm');
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm');
    var formData = new FormData(this);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        type: 'POST',
        url: "{{route('save.user')}}",
        data:formData,
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            console.log(data);
            table.ajax.reload( null, false );
            $('.addModel').modal('hide');
            toastr.remove();toastr[data.type](data.message,'', {closeButton: true,tapToDismiss: false, progressBar: true});
            document.getElementById("addForm").reset();
            $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});
$(document).on('click', '.editmdl', function()
{
    $('.upbtn').removeClass('spinner-border spinner-border-sm');document.getElementById("upForm").reset();
    $('#cid').val($(this).data('cid'));$('#roleid').val($(this).data('role')).trigger('change');$('#fname').val($(this).data('fname'));$('#uname').val($(this).data('uname'));
    $('#uemail').val($(this).data('email'));$('#uphone').val($(this).data('phone'));$('#umobile').val($(this).data('mobile'));$('#ustatus').val($(this).data('status'));
    $('#generatePass').css('display','none'); $("#upassword").attr('disabled','disabled');$('.upModel').modal('show');
});
$("#upForm").on('submit',function(event)
{
    event.preventDefault();
    var formData = new FormData(this);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $('.upbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('update.user')}}",
        data:formData,
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.upModel').modal('hide');
           toastr.remove(); toastr[data.type](data.message,'', {closeButton: true,tapToDismiss: false, progressBar: true});
            document.getElementById("upForm").reset();
            $('.upbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});

$(document).on('click', '.delbs', function()
{
  toastr.remove();
  toastr['warning']('Are you sure you want to delete this User <b>'+$(this).data('ttl')+'</b>?<br /><br /><button type="button" data-did="'+$(this).data('did')+'" class="btn-sm btn-danger clear condel">Confirm</button>',
 'Warning', {
      closeButton: true,
      tapToDismiss: false,
      progressBar: true
    });
});
$(document).on('click', '.condel', function()
{
    $.ajax({type: 'POST',url: "{{route('delete.user')}}",
    data: {_token: $('meta[name="csrf-token"]').attr('content'),did : $(this).data('did')},
    success: function(data){
        toastr.remove();toastr[data.type](data.message);table.ajax.reload( null, false );}
    });
});


    </script>
@endpush
