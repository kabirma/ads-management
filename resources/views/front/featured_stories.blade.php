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
                                <h2 class="title">Behind the Scenes</h2>
                                
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
                        
                        @forelse ($blogs as $blog)
                            
                        <div class="col-lg-4 col-md-6">
                            <!-- Single Blog Start -->
                            <div class="single-blog">
                                <div class="blog-image">
                                    <a href="{{route('featured_stories_detail', str_replace(" ", "_", $blog->title))}}"><img src="{{asset($blog->image)}}" alt=""></a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <span class="category">{{$blog->category}}</span>
                                        <span class="date">{{date("F d, Y", strtotime($blog->created_at))}}</span>
                                    </div>
                                    <h3 class="title"><a href="{{route('featured_stories_detail', str_replace(" ", "_", $blog->title))}}">{{$blog->title}} </a></h3>
                                </div>
                            </div>
                            <!-- Single Blog End -->
                        </div>

                        @empty
                        <div class="col-md-12 alert alert-danger" style="background-color:#fdfd96">No Featured Stories Found</div>
                        @endforelse
                        
                    </div>

                </div>
            </div>
        </div>
        <!-- Blog End -->

@endsection