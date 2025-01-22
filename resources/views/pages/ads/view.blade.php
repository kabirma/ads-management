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
                        <a href="{{ route('add.ads') }}" class="btn btn-sm btn-primary waves-effect">
                            <i class="fa fa-plus"></i> <span>New {{ $title }}</span>
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            <div class="table-responsive">
                                <table id="dataTable" class="table zero-configuration ">
                                    <thead>
                                        <tr style="">
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Genre</th>
                                            <th>Date</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listing as $list)
                                            <tr>
                                                <td>{{ $list->id }}</td>
                                                <td>{{ $list->title }}</td>
                                                <td>{{ $list->genre }}</td>
                                                <td>{{ date("M d, Y",strtotime($list->date)) }}</td>
                                                <td><img src="{{ asset($list->image) }}" style="height:100px"></td>
                                                <td>
                                                    <a href="{{ route('status.ads', $list->id) }}"
                                                        class="btn btn-sm btn-{{$list->status==1 ? "success" : "danger"}}"><?= $list->status==1 ? "<i class='fa fa-times'></i> Deactive" : "<i class='fa fa-check'></i> Active" ?></a>
                                                    <a href="{{ route('edit.ads', $list->id) }}"
                                                        class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                    <a href="#0" class="btn btn-sm btn-danger delete"
                                                        data-title="{{ $list->title }}"
                                                        data-href="{{ route('delete.ads', $list->id) }}"><i
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
