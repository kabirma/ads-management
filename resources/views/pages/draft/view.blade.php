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
                            {{__('messages.List')}}</span></li>
                        </ol>

                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            <div class="table-responsive">
                                <table id="dataTable" class="table zero-configuration ">
                                    <thead>
                                        <tr style="">
                                            <th>{{__('messages.ID')}}</th>
                                            <th>{{__('messages.CampaignName')}}</th>
                                            <th>{{__('messages.SocialMedia')}}</th>
                                            <th>{{__('messages.DRAFTED_AT')}}</th>
                                            <th>{{__('messages.DATA')}}</th>
                                            <th>{{__('messages.MEDIA')}}</th>
                                            <th>{{__('messages.Action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listing as $list)
                                            <tr>
                                                <td>{{ $list->id }}</td>
                                                <td>{{ $list->getCampaignName() }}</td>
                                                <td>{{ $list->name }}</td>
                                                <td>{{ date("M d, Y h:i A",strtotime($list->created_at)) }}</td>
                                                <td><?=  $list->getDraftPretty() ?></td>
                                                <td><img src="{{asset($list->getMedia())}}" height="150"></td>
                                                <td>
                                                 
                                                    <a href="{{ route('continue.draft', $list->id) }}"
                                                        class="btn btn-sm btn-primary">{{__('messages.CONTINUE_CREATION')}} <i class="fa fa-arrow-right"></i></a>
                                                    <a href="#0" class="btn btn-sm btn-danger delete"
                                                        data-title="{{ $list->name }} Draft"
                                                        data-href="{{ route('delete.draft', $list->id) }}"><i
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
