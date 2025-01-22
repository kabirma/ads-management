@extends('layouts.master')

@section('content')
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item active"> <span class="badge badge-light-primary">@if(Auth::user()->role_id === 1) Edit
                                    {{ $title }} @else Profile @endif</span>
                            </li>
                        </ol>
                        @if(Auth::user()->role_id === 1)
                        <a href="{{ route('view.customer') }}" class="btn btn-sm btn-primary waves-effect addnew">
                            <i class="fa fa-list"></i> <span>View {{ $title }}</span>
                        </a>
                        @endif
                        
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            <form action="{{ route('save.customer') }}" method="post" class="row">
                                @if (Session::has('success'))
                                    <div class="alert alert-success text-center">
                                        <i class="fa fa-check"></i> {{ Session::get('success') }}
                                    </div>
                                @endif
                                
                                @csrf
                                <input type="hidden" name="id" value="{{ isset($record) ? $record->id : 0 }}">
                                <div class="form-group col-md-6">
                                    <label for="full_name">Name</label>
                                    <input id="full_name" name="full_name" value="{{ isset($record) ? $record->full_name : '' }}"
                                        type="text" required class="form-control">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input id="email" name="email" value="{{ isset($record) ? $record->email : '' }}"
                                        type="email" required class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone</label>
                                    <input id="phone" name="phone" value="{{ isset($record) ? $record->phone : '' }}"
                                        type="tel" required class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mobile">Mobile</label>
                                    <input id="mobile" name="mobile" value="{{ isset($record) ? $record->mobile : '' }}"
                                        type="tel" required class="form-control">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="name">Username</label>
                                    <input id="name" name="name"
                                        value="{{ isset($record) ? $record->name : '' }}" type="text" required
                                        class="form-control">
                                </div>
                                @if (!isset($record->password))
                                    <div class="form-group col-md-6">
                                        <label for="password">Password</label>
                                        <input id="password" name="password"
                                            value="{{ isset($record) ? $record->password : '' }}" type="text" required
                                            class="form-control">
                                    </div>
                                @endif
                                <div class="form-group col-md-12">
                                    <hr>
                                    <button class="btn btn-primary"><i class="fa fa-check"></i> SAVE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- Dashboard Analytics end -->
@endsection
@push('script')
    <script>
        $(".amount_calculated").change(function() {
            $("#balance").val($("#customer_total").val() - $("#amount_paid").val());
        })
    </script>
@endpush
