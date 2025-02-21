@extends('layouts.master')

@section('content')
<script src="https://test-gateway.mastercard.com/checkout/version/61/checkout.js" 
            data-error="errorCallback"
            data-complete="completeCallback">
    </script>
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

                        <a href="{{ route('add.package') }}" class="btn btn-sm btn-primary waves-effect">
                            <i class="fa fa-plus"></i> <span>New {{ $title }}</span>
                        </a>

                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
  
                        <h1>Processing Payment...</h1>
                        <script type="text/javascript">
                            function completeCallback(response) {
                                alert("Success")
                                // window.location.href = "{{ route('mastercard.success') }}";
                            }

                            function errorCallback(error) {
                                window.location.href = "{{ route('mastercard.cancel') }}";
                            }

                            Checkout.configure({
                                session: {
                                    id: "{{ $sessionData['session']['id'] }}"
                                }
                            });

                            Checkout.showPaymentPage();
                        </script>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- Dashboard Analytics end -->
@endsection

