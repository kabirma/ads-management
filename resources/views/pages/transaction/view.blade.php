@extends('layouts.master')

@section('content')
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row">
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
                                    </span></li>
                        </ol>


                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            <div class="table-responsive">
                                <table id="dataTable" class="table zero-configuration ">
                                    <thead>
                                        <tr style="">
                                            <th>{{__("messages.ID")}}</th>
                                            @if(Auth::user()->role_id === 1)
                                                <th>{{__("messages.User")}}</th>
                                            @endif
                                            <th>{{__("messages.Amount")}}</th>
                                            <th>{{__("messages.Reference")}}</th>
                                            <th>{{__("messages.CREATED_AT")}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listing as $list)
                                            <tr>
                                                <td>{{ $list->id }}</td>
                                                @if(Auth::user()->role_id === 1)
                                                    <td>{{ $list->user->username }}</td>
                                                @endif
                                                <td><?= $list->getAmount() ?></td>
                                                <td><?= $list->getReference() ?></td>
                                                <td>{{ $list->created_at }}</td>
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
    <!-- Dashboard Analytics end -->
@endsection
