@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top:15%">
        <div class="col-md-12" style="">
            <div class="card" style=" margin: auto; background: white; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); padding: 30px;">
                <div class=" text-center" style="margin-bottom:6%">
                    <h1>{{__("messages.EmailVerification")}}</h1>
                   
                </div>

                <div class="card-body">
                    @if (isset($success))
                        <div class="alert alert-success text-center">
                            <h4><i class="fa fa-check"></i> {{__("messages.EmailVerifiedSuccess")}}</h4>
                        </div>
                    @endif

                    @if (isset($error))
                        <div class="alert alert-danger text-center">
                           <h4> <i class="fa fa-times"></i> {{__("messages.EmailVerifiedError")}}</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
