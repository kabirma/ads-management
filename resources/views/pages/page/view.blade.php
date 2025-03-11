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
                                    List</span></li>
                        </ol>

                        <a href="{{ route('add.page') }}" class="btn btn-sm btn-primary waves-effect">
                            <i class="fa fa-plus"></i> <span>New {{ $title }}</span>
                        </a>

                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            <div class="table-responsive">
                                <table id="dataTable" class="table zero-configuration ">
                                    <thead>
                                        <tr style="">
                                            <th>{{__("messages.ID")}}</th>
                                            <th>{{__("messages.Name")}}</th>
                                            <th>{{__("messages.Action")}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listing as $list)
                                            <tr>
                                                <td>{{ $list->id }}</td>
                                                <td>{{ $list->title }}</td>
                                                <td>
                                                    <a href="{{ route('status.page', $list->id) }}"
                                                        class="btn btn-sm btn-{{$list->status==1 ? "success" : "danger"}}"><?= $list->status==1 ? "<i class='fa fa-times'></i> Deactive" : "<i class='fa fa-check'></i> Active" ?></a>
                                                    <a href="{{ route('edit.page', $list->id) }}"
                                                        class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
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
        </div>


    </section>
    <!-- Dashboard Analytics end -->
@endsection
