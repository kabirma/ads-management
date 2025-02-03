@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    <!-- Dashboard Analytics Start -->
    <style>
        .bootstrap-tagsinput .tag {
            border-radius: 6px;
            padding: 5px;
            background: #5BBE25;
            margin-right: 2px;
            color: white;
        }
		.bootstrap-tagsinput {
			width:100%!important;
		}
    </style>
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"> <span class="badge badge-light-primary">
                                    {{ $title }}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
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
                                <input type="hidden" name="id" value="{{ isset($record) ? $record->id : 0 }}">

                                <div class="col-md-12">
                                    <h4>Connect Social Media Account</h4>
                                    <hr>
                                </div>
                                
                                <div class="form-group col-md-12">
                                    @if(Auth::user()->tiktok_token === null)
                                        <a href="{{route('redirect_to_tiktok')}}" class="btn btn-secondary"> <i class="fab fa-tiktok"></i> Conect TikTok</a>
                                    @else
                                        <a href="#0" class="btn btn-success"> <i class="fab fa-tiktok"></i> TikTok Connected</a>
                                    @endif
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    <script>
        CKEDITOR.replace( 'ckeditor' );
    </script>
@endsection
