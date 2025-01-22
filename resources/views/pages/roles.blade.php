@extends('layouts.master')

@push('stylesheets')

@endpush

@section('content')




<div class="modal fade text-start modal-success addModel" id="success" tabindex="-1" aria-labelledby="myModalLabel110" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-scrollable">
         <form method="post" id="addForm"  enctype="multipart/form-data">  
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel110">Add New Role & Permisssion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-md-6 col-xl-6">
                        <div class="form-group">
                            <label for="first-name-icon">Role Name</label>
                            <input type="text"  class="form-control" name="name" required="" placeholder="Enter Role Name" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sname">label</label>
                                    <div class="form-label-group position-relative has-icon-left">
                                        <input type="color" name="label" id="label" value="" class="form-control">
                                        <div class="form-control-position"><i class="feather icon-image"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="  margin-top: 30px;">
                                <div class="form-group">
                                    <fieldset>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input select_access" type="checkbox"  value="false" />
                                            <label class="form-check-label" for="">Select All</label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                
                <!--//====================-->
                <div class="row mb2">
                    <div class="col-md-6 col-xl-6">
                        <span class="badge badge-light-primary rpdiv">User Management</span>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="" name="permissions[]" value="adduser"  />
                                        <label class="form-check-label" for="">Add User</label>
                                    </div>
                                </fieldset>
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="upuser"  />
                                        <label class="form-check-label" for="">update User</label>
                                    </div>
                                </fieldset>
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="vwuser">
                                        <label class="form-check-label" for="">View User</label>
                                    </div>
                                </fieldset>              
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <fieldset class="rpdiv">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="deluser">
                                            <label class="form-check-label" for="">Delete User</label>
                                        </div>
                                    </fieldset>
                                    <fieldset class="rpdiv">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="stsuser">
                                            <label class="form-check-label" for="">Change Status</label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                          <hr>
                    </div>
                    
                    <div class="col-md-6 col-xl-6">
                        
                    </div>
                </div>
              
                
                
                
                <div class="row mb2">
                    <div class="col-md-6 col-xl-6">
                        <span class="badge badge-light-primary rpdiv">Service Category</span>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="" name="permissions[]" value="addscat"  />
                                        <label class="form-check-label" for="">Add Category</label>
                                    </div>
                                </fieldset>
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="upscat"  />
                                        <label class="form-check-label" for="">update Category</label>
                                    </div>
                                </fieldset>            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <fieldset class="rpdiv">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="delscat">
                                            <label class="form-check-label" for="">Delete Category</label>
                                        </div>
                                    </fieldset>
                                    <fieldset class="rpdiv">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="viewscat">
                                            <label class="form-check-label" for="">View Category</label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-md-6 col-xl-6">
                        <span class="badge badge-light-primary rpdiv">Services</span>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="" name="permissions[]" value="addservice"  />
                                        <label class="form-check-label" for="">Add Service</label>
                                    </div>
                                </fieldset>
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="upservice"  />
                                        <label class="form-check-label" for="">update Service</label>
                                    </div>
                                </fieldset>            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <fieldset class="rpdiv">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="delservice">
                                            <label class="form-check-label" for="">Delete Service</label>
                                        </div>
                                    </fieldset>
                                    <fieldset class="rpdiv">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="viewservice">
                                            <label class="form-check-label" for="">View Service</label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                
                
                
                <div class="row mb2">
                    <div class="col-md-6 col-xl-6">
                        <span class="badge badge-light-primary rpdiv">Expense Category</span>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="" name="permissions[]" value="addecat"  />
                                        <label class="form-check-label" for="">Add Category</label>
                                    </div>
                                </fieldset>
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="upecat"  />
                                        <label class="form-check-label" for="">update Category</label>
                                    </div>
                                </fieldset>            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <fieldset class="rpdiv">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="delecat">
                                            <label class="form-check-label" for="">Delete Category</label>
                                        </div>
                                    </fieldset>
                                    <fieldset class="rpdiv">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="viewecat">
                                            <label class="form-check-label" for="">View Category</label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-md-6 col-xl-6">
                        <span class="badge badge-light-primary rpdiv">Expenses</span>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="" name="permissions[]" value="addexpense"  />
                                        <label class="form-check-label" for="">Add Expense</label>
                                    </div>
                                </fieldset>
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="upexpense"  />
                                        <label class="form-check-label" for="">Update Expense</label>
                                    </div>
                                </fieldset>            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <fieldset class="rpdiv">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="delexpense">
                                            <label class="form-check-label" for="">Delete Expense</label>
                                        </div>
                                    </fieldset>
                                    <fieldset class="rpdiv">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="viewexpense">
                                            <label class="form-check-label" for="">View Expense</label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                
                
                <!--=========-->

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-success" >
                    Save <span class="addbtn" role="status" aria-hidden="true"></span>
                </button>

            </div>
            
        </div>
        </form>
    </div>
</div>


<div class="modal fade text-start modal-primary upModel"  tabindex="-1" aria-labelledby="myModalLabel110" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel110">Update Role & Permisssion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="upForm"  enctype="multipart/form-data">   
            <div class="modal-body">
                  <input type="hidden" name="rid" id="rid">
                        <div class="row">
                    <div class="col-md-6 col-xl-6">
                        <div class="form-group">
                            <label for="first-name-icon">Role Name</label>
                            <input type="text"  class="form-control" name="name" id="uname" required="" placeholder="Enter Role Name" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sname">label</label>
                                    <div class="form-label-group position-relative has-icon-left">
                                        <input type="color" name="label" id="ulabel" value="" class="form-control">
                                        <div class="form-control-position"><i class="feather icon-image"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="  margin-top: 30px;">
                                <div class="form-group">
                                    <fieldset>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input uselect_access" type="checkbox"  value="false" />
                                            <label class="form-check-label" for="">Select All</label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                
                <!--//====================-->
                <div class="row mb2">
                    <div class="col-md-6 col-xl-6">
                        <span class="badge badge-light-primary rpdiv">User Management</span>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="" name="upermissions[]" value="adduser"  />
                                        <label class="form-check-label" for="">Add User</label>
                                    </div>
                                </fieldset>
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="upermissions[]" value="upuser"  />
                                        <label class="form-check-label" for="">update User</label>
                                    </div>
                                </fieldset>
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="upermissions[]" value="vwuser">
                                        <label class="form-check-label" for="">View User</label>
                                    </div>
                                </fieldset>              
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <fieldset class="rpdiv">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="upermissions[]" value="deluser">
                                            <label class="form-check-label" for="">Delete User</label>
                                        </div>
                                    </fieldset>
                                    <fieldset class="rpdiv">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="upermissions[]" value="stsuser">
                                            <label class="form-check-label" for="">Change Status</label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                          <hr>
                    </div>
                    
                    <div class="col-md-6 col-xl-6">
                        
                    </div>
                </div>
              
                
                
                
                <div class="row mb2">
                    <div class="col-md-6 col-xl-6">
                        <span class="badge badge-light-primary rpdiv">Service Category</span>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="" name="upermissions[]" value="addscat"  />
                                        <label class="form-check-label" for="">Add Category</label>
                                    </div>
                                </fieldset>
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="upermissions[]" value="upscat"  />
                                        <label class="form-check-label" for="">update Category</label>
                                    </div>
                                </fieldset>            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <fieldset class="rpdiv">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="upermissions[]" value="delscat">
                                            <label class="form-check-label" for="">Delete Category</label>
                                        </div>
                                    </fieldset>
                                    <fieldset class="rpdiv">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="upermissions[]" value="viewscat">
                                            <label class="form-check-label" for="">View Category</label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-md-6 col-xl-6">
                        <span class="badge badge-light-primary rpdiv">Services</span>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="" name="upermissions[]" value="addservice"  />
                                        <label class="form-check-label" for="">Add Service</label>
                                    </div>
                                </fieldset>
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="upermissions[]" value="upservice"  />
                                        <label class="form-check-label" for="">update Service</label>
                                    </div>
                                </fieldset>            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <fieldset class="rpdiv">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="upermissions[]" value="delservice">
                                            <label class="form-check-label" for="">Delete Service</label>
                                        </div>
                                    </fieldset>
                                    <fieldset class="rpdiv">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="upermissions[]" value="viewservice">
                                            <label class="form-check-label" for="">View Service</label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                
                
                
                <div class="row mb2">
                    <div class="col-md-6 col-xl-6">
                        <span class="badge badge-light-primary rpdiv">Expense Category</span>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="" name="upermissions[]" value="addecat"  />
                                        <label class="form-check-label" for="">Add Category</label>
                                    </div>
                                </fieldset>
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="upermissions[]" value="upecat"  />
                                        <label class="form-check-label" for="">update Category</label>
                                    </div>
                                </fieldset>            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <fieldset class="rpdiv">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="upermissions[]" value="delecat">
                                            <label class="form-check-label" for="">Delete Category</label>
                                        </div>
                                    </fieldset>
                                    <fieldset class="rpdiv">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="upermissions[]" value="viewecat">
                                            <label class="form-check-label" for="">View Category</label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-md-6 col-xl-6">
                        <span class="badge badge-light-primary rpdiv">Expenses</span>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="" name="upermissions[]" value="addexpense"  />
                                        <label class="form-check-label" for="">Add Expense</label>
                                    </div>
                                </fieldset>
                                <fieldset class="rpdiv">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="upermissions[]" value="upexpense"  />
                                        <label class="form-check-label" for="">Update Expense</label>
                                    </div>
                                </fieldset>            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <fieldset class="rpdiv">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="upermissions[]" value="delexpense">
                                            <label class="form-check-label" for="">Delete Expense</label>
                                        </div>
                                    </fieldset>
                                    <fieldset class="rpdiv">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="upermissions[]" value="viewexpense">
                                            <label class="form-check-label" for="">View Expense</label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-primary" >
                      Update <span class="upbtn" role="status" aria-hidden="true"></span>
                </button>

            </div>
             </form>
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
         
                        <li class="breadcrumb-item active"> <span class="badge badge-light-info">Role & Permissions List</span></li>
                    </ol>
               
                    <a  type="button" class="btn btn-sm btn-info waves-effect addnew">
                        <i data-feather='plus-circle'></i>   <span>New Role</span>
                    </a >
                  
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard" style="padding-top: 0px;">
                        <div class="table-responsive">
                            <table id="dataTable" class="table zero-configuration ">
                                <thead>
                                    <tr style="">
                                        <th>ID</th>
                                        <th>Role Name</th>
                                        <th>Label</th>
                                        <th>Created</th>
                                 
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

    <script src="{{asset('assets/js/scripts/pages/app-invoice-list.js')}}"></script> 
    <script>
         $(document).ready(function()
    {
   
        $(document).on('click', '.select_access', function (event) 
        {
            var checked = $(this).prop('checked');
            $(document).find('input[name="permissions[]"]').prop('checked', checked);
        });
        $(document).on('click', '.uselect_access', function (event) 
        {
            var checked = $(this).prop('checked');
            $(document).find('input[name="upermissions[]"]').prop('checked', checked);
        });
        
    });
 var table = $('#dataTable').DataTable(
    {
        "responsive" : true,
        "autoWidth"  : false,
//        "ordering": false,
//        "paging" : true,
        "processing" : true,"serverSide": true,
//        "columnDefs": [{ responsivePriority: 1, targets: 0 }],
        "ajax":
            {
                "url":"<?= route('list.roles') ?>",
                "dataType":"json",
                "type":"POST",
                "data": function ( d )
                {
                    d._token= $('meta[name="csrf-token"]').attr('content');
                }
            },
        "columns":[
        {"data":"a"},{"data":"b"},{"data":"lbl"},{"data":"c"},{"data":"e","searchable":false,"orderable":false}
    ],
        "order": [[0, 'asc']]   
});
$(".addnew").on('click',function()
{
    $('.addbtn').removeClass('spinner-border spinner-border-sm');
    document.getElementById("addForm").reset();
    $('.addModel').modal('show');
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
        url: "{{route('save.role')}}",
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
    $('.upbtn').removeClass('spinner-border spinner-border-sm');
    document.getElementById("upForm").reset();
    $('#uname').val($(this).data('nm'));$('#rid').val($(this).data('cid')); $('#ulabel').val($(this).data('lbl'));
    $.ajax({type: 'POST',url: "{{route('role.info')}}",
    data:{_token: $('meta[name="csrf-token"]').attr('content'),id: $(this).data('cid')},
        success: function(data) 
        {
            $('input[name="upermissions[]"]').each(function (index, element)
            {
                if(data.includes($(element).val()))
                {$(element).prop('checked', true);}
            });
            $('.upModel').modal('show');
        }
    });
});
$("#upForm").on('submit',function(event)
{ 
    event.preventDefault();
    var formData = new FormData(this);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $('.upbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('update.role')}}",
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
  toastr['warning']('Are you sure you want to delete this Role <b>'+$(this).data('ttl')+'</b>?<br /><br /><button type="button" data-did="'+$(this).data('did')+'" class="btn-sm btn-danger clear condel">Confirm</button>',
 'Warning', {
      closeButton: true,
      tapToDismiss: false,
      progressBar: true
    });
    
});
$(document).on('click', '.condel', function()
{
    $.ajax({type: 'POST',url: "{{route('delete.role')}}",
    data: {_token: $('meta[name="csrf-token"]').attr('content'),did : $(this).data('did')},
    success: function(data){
        toastr.remove();
    toastr[data.type](data.message);table.ajax.reload( null, false );}
    });
}); 


    </script>
@endpush