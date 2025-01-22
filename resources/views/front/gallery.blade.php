@extends('front.layout.app')


@section('content')
    
        <style>
            .page-banner-section {
                background-image: url({{asset("front/assets/images/PhotoB.jpg")}});
                background-position: center;
            }
        </style>
        <!-- Page Banner Start -->
        <div class="section page-banner-section">
            <div class="shape-2"></div>
            <div class="container">
                <div class="page-banner-wrap">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Page Banner Content Start -->
                            <div class="page-banner text-center">
                                <h2 class="title">Photo Gallery</h2>
                                
                            </div>
                            <!-- Page Banner Content End -->
                        </div>
                    </div>  
                </div>
            </div>
        </div>
        <!-- Page Banner End -->

        <!-- Blog Start -->
        <div class="meeta-blog section-padding">
            <div class="container">
                <div class="meeta-blog-grid-wrap">
                    <div class="row">
                        
                        @forelse ($galleries as $gallery)
                            
                        <div class="col-lg-4 col-md-6">
                            <!-- Single Blog Start -->
                            <div class="single-blog">
                                <div class="blog-image">
                                    <a href="{{route('photo_gallery_detail', $gallery->id)}}"><img src="{{asset($gallery->event->image)}}" alt=""></a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <span class="category">{{$gallery->event->title}}</span>
                                        <span class="date">{{date("F d, Y", strtotime($gallery->created_at))}}</span>
                                    </div>
                                    <h3 class="title"><a href="{{route('photo_gallery_detail', $gallery->id)}}">{{$gallery->artist}} </a></h3>
                                </div>
                            </div>
                            <!-- Single Blog End -->
                        </div>

                        @empty
                        <div class="col-md-12 alert alert-danger" style="background-color:#fdfd96">No Pohot Gallery Found</div>
                        @endforelse
                        
                    </div>

                </div>
            </div>
        </div>
        <!-- Blog End -->

@endsection