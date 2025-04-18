@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    <!-- Dashboard Analytics Start -->
    <style>
               a,
        a:hover,
        a:focus,
        a:active {
            text-decoration: none;
            outline: none;
        }
        
        a,
        a:active,
        a:focus {
            color: #333;
            text-decoration: none;
            transition-timing-function: ease-in-out;
            -ms-transition-timing-function: ease-in-out;
            -moz-transition-timing-function: ease-in-out;
            -webkit-transition-timing-function: ease-in-out;
            -o-transition-timing-function: ease-in-out;
            transition-duration: .2s;
            -ms-transition-duration: .2s;
            -moz-transition-duration: .2s;
            -webkit-transition-duration: .2s;
            -o-transition-duration: .2s;
        }
        
        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        img {
    max-width: 100%;
    height: auto;
}
/*--blog----*/

.sec-title{
  position:relative;
  margin-bottom:70px;
}

.sec-title .title{
  position: relative;
  display: block;
  font-size: 16px;
  line-height: 1em;
  color: #ff8a01;
  font-weight: 500;
  background: rgb(247,0,104);
  background: -moz-linear-gradient(to left, rgba(247,0,104,1) 0%, rgba(68,16,102,1) 25%, rgba(247,0,104,1) 75%, rgba(68,16,102,1) 100%);
  background: -webkit-linear-gradient(to left, rgba(247,0,104,1) 0%,rgba(68,16,102,1) 25%,rgba(247,0,104,1) 75%,rgba(68,16,102,1) 100%);
  background: linear-gradient(to left, rgba(247,0,104) 0%,rgba(68,16,102,1) 25%,rgba(247,0,104,1) 75%,rgba(68,16,102,1) 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#F70068', endColorstr='#441066',GradientType=1 );
  color: transparent;
  -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  text-transform: uppercase;
  letter-spacing: 5px;
  margin-bottom: 15px;
}

.sec-title h2{
  position:relative;
  display: inline-block;
  font-size:48px;
  line-height:1.2em;
  color:#1e1f36;
  font-weight:700;
}

.sec-title .text{
  position: relative;
  font-size: 16px;
  line-height: 28px;
  color: #888888;
  margin-top: 30px;
}

.sec-title.light h2,
.sec-title.light .title{
  color: #ffffff;
  -webkit-text-fill-color:inherit; 
}
.pricing-section {
    position: relative;
    padding: 40px 0 80px;
    overflow: hidden;
}
.pricing-section .outer-box{
  max-width: 1100px;
  margin: 0 auto;
}


.pricing-section .row{
  margin: 0 -30px;
}

.pricing-block{
  position: relative;
  padding: 0 30px;
  margin-bottom: 40px;
}

.pricing-block .inner-box{
  position: relative;
  background-color: #ffffff;
  box-shadow: 0 20px 40px rgba(0,0,0,0.08);
  padding: 0 0 30px;
  max-width: 370px;
  margin: 0 auto;
  border-bottom: 20px solid #40cbb4;
}

.pricing-block .icon-box{
  position: relative;
  padding: 50px 30px 0;
  background-color: #40cbb4;
  text-align: center;
}

.pricing-block .icon-box:before{
  position: absolute;
  left: 0;
  bottom: 0;
  height: 75px;
  width: 100%;
  border-radius: 50% 50% 0 0;
  background-color: #ffffff;
  content: "";
}


.pricing-block .icon-box .icon-outer{
  position: relative;
  height: 150px;
  width: 150px;
  background-color: #ffffff;
  border-radius: 50%;
  margin: 0 auto;
  padding: 10px;
}

.pricing-block .icon-box i{
  position: relative;
  display: block;
  height: 130px;
  width: 130px;
  line-height: 120px;
  border: 5px solid #40cbb4;
  border-radius: 50%;
  font-size: 50px;
  color: #40cbb4;
  -webkit-transition:all 600ms ease;
  -ms-transition:all 600ms ease;
  -o-transition:all 600ms ease;
  -moz-transition:all 600ms ease;
  transition:all 600ms ease;
}

.pricing-block .inner-box:hover .icon-box i{
  transform:rotate(360deg);
}

.pricing-block .price-box{
  position: relative;
  text-align: center;
  padding: 10px 20px;
}

.pricing-block .title{
  position: relative;
  display: block;
  font-size: 24px;
  line-height: 1.2em;
  color: #222222;
  font-weight: 600;
}

.pricing-block .price{
  display: block;
  font-size: 30px;
  color: #222222;
  font-weight: 700;
  color: #40cbb4;
}


.pricing-block .features{
  position: relative;
  max-width: 200px;
  margin: 0 auto 20px;
}


.pricing-block .socialMedia{
  padding: 10px 0;
  margin: 1px 15%;
  text-align: center;
  border-top:2px solid gray;
  border-bottom:2px solid gray;
}

.pricing-block .socialMedia h4{
    font-size:15px;
}


.pricing-block .socialMedia i{
    font-size:18px;
    margin-left:5px;
}

.pricing-block .features li{
  position: relative;
  display: block;
  font-size: 14px;
  line-height: 30px;
  color: #848484;
  font-weight: 500;
  padding: 5px 0;
  padding-left: 30px;
  border-bottom: 1px dashed #dddddd;
}
.pricing-block .features li:before {
    position: absolute;
    left: 0;
    top: 50%;
    font-size: 16px;
    color: #2bd40f;
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    line-height: 1;
    content: "\f058";
    font-family: "Font Awesome 5 Free";
    margin-top: -8px;
}
.pricing-block .features li.false:before{
  color: #e1137b;
  content: "\f057";
}

.pricing-block .features li a{
  color: #848484;
}

.pricing-block .features li:last-child{
  border-bottom: 0;
}

.pricing-block .btn-box{
  position: relative;
  text-align: center;
}

.pricing-block .btn-box button{
  position: relative;
  display: inline-block;
  font-size: 14px;
  line-height: 25px;
  color: #ffffff;
  font-weight: 500;
  padding: 8px 30px;
  background-color: #40cbb4;
  border:2px solid transparent;
  border-radius: 10px;
  border-top:2px solid transparent;
  border-bottom:2px solid transparent;
  -webkit-transition: all 400ms ease;
  -moz-transition: all 400ms ease;
  -ms-transition: all 400ms ease;
  -o-transition: all 400ms ease;
  transition: all 300ms ease;
}

.pricing-block .btn-box button:hover{
  color: #ffffff;
}

.pricing-block .inner-box:hover .btn-box button{
  color:#40cbb4;
  background:none;
  border-radius:0px;
  border-color:#40cbb4;
}

.pricing-block:nth-child(2) .icon-box i,
.pricing-block:nth-child(2) .inner-box{
  border-color: #1d95d2;
}

.pricing-block:nth-child(2) .btn-box button,
.pricing-block:nth-child(2) .icon-box{
  background-color: #1d95d2;
}

.pricing-block:nth-child(2) .inner-box:hover .btn-box button{
  color:#1d95d2;
  background:none;
  border-radius:0px;
  border-color:#1d95d2;
}

.pricing-block:nth-child(2) .icon-box i,
.pricing-block:nth-child(2) .price{
  color: #1d95d2;
}

.pricing-block:nth-child(3) .icon-box i,
.pricing-block:nth-child(3) .inner-box{
  border-color: #ffc20b;
}

.pricing-block:nth-child(3) .btn-box button,
.pricing-block:nth-child(3) .icon-box{
  background-color: #ffc20b;
}

.pricing-block:nth-child(3) .icon-box i,
.pricing-block:nth-child(3) .price{
  color: #ffc20b;
}

.pricing-block:nth-child(3) .inner-box:hover .btn-box button{
  color:#ffc20b;
  background:none;
  border-radius:0px;
  border-color:#ffc20b;
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
                                
                            <section class="pricing-section">
                                <div class="container">
                                    <div class="sec-title text-center">
                                        <span class="title">{{__('messages.GetPlan')}}</span>
                                        <h2>{{__('messages.ChooseAPlan')}}</h2>
                                    </div>
                                    @php
                                        $icons = ['fa-paper-plane','fa-gem','fa-rocket'];
                                        $packages = App\Models\Package::limit(3)->get();
                                    @endphp
                                    <div class="outer-box">
                                        <div class="row">
                                            @foreach($packages as $key=>$package)
                                            @php
                                                $socialMedia = explode("?=",$package->social_media);
                                                $features = explode("?=",$package->features);
                                            @endphp
                                            <!-- Pricing Block -->
                                            <div class="pricing-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                                                <div class="inner-box">
                                                    <div class="icon-box">
                                                        <div class="icon-outer"><i class="fas {{$icons[$key]}}"></i></div>
                                                    </div>
                                                    <div class="price-box">
                                                        @if($package->is_popular)
                                                        <span class="badge btn-success">{{__('messages.POPULAR')}}</span>
                                                        @endif
                                                        <div class="title">{{$package->name}}</div>
                                                        <h4 class="price">SAR {{number_format($package->price,2)}}</h4>
                                                    </div>
                                                    <div class="socialMedia">
                                                        <h4>{{__('messages.PublishAdsOn')}}</h4>
                                                        @foreach($socialMedia as $media)
                                                            <i class="fab fa-{{$media}}"></i>
                                                        @endforeach
                                                    </div>
                                                    <ul class="features">
                                                        @foreach($features as $feature)
                                                            <li class="true">{{$feature}}</li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="btn-box">
                                                        <form action="{{route('purchase_package')}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="package_id" value="{{$package->id}}">
                                                            <input type="hidden" name="price" value="{{$package->price}}">
                                                            <button class="theme-btn">{{__('messages.BuyPlan')}}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </section>
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
