@extends('layouts.master')

@section('content')
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item active"> <span class="badge badge-light-primary">Edit
                                    {{ $title }}</span>
                            </li>
                        </ol>
                        <a href="{{ route('view.bts') }}" class="btn btn-sm btn-primary waves-effect addnew">
                            <i class="fa fa-list"></i> <span>View {{ $title }}</span>
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            <form action="{{ route('save.bts') }}" method="post" class="row" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ isset($record) ? $record->id : 0 }}">

                                <div class="form-group col-md-6">
                                    <label for="event_id">Event</label>
                                    <select name="event_id" class="form-control select2" required>
                                        <option value="" selected disabled>Select Event</option>
                                        @foreach ($parent as $item)
                                            <option value="{{$item->id}}" @if(isset($record)) @if($item->id==$record->event_id) selected @endif @endif>{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date">Date</label>
                                    <input id="date" name="date"
                                        value="{{ isset($record) ? $record->date : '' }}" type="date" required
                                        class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="summary">Summary</label>
                                    <textarea name="summary" id="ckeditor" class="form-control" cols="30" rows="10">{{ isset($record) ? $record->summary : '' }}</textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="category">Image</label>
                                    <input id="image" name="image" type="file" class="form-control">
                                    @if(isset($record))
                                    <br>
                                    <img src="{{asset($record->image)}}" style="height:100px">
                                    @endif
                                </div>
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

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( 'ckeditor' );
        $(".select2").select2();
    </script>
@endsection
