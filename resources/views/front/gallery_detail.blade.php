@extends('front.layout.app')

@section('content')
<style>
    .page-banner-section {
        background-image: url({{asset("storage/images/homepage/PhotoM.jpg")}});
        background-position: top;
    }
</style>
<!-- Page Banner Start -->
<div class="section page-banner-section">
    <div class="container">
        <div class="page-banner-wrap">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Banner Content Start -->
                    <div class="page-banner text-center">
                        <h2 class="title">{{ $gallery->artist }}</h2>
                    </div>
                    <!-- Page Banner Content End -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Banner End -->

<!-- Blog Details Start -->
<div class="section blog-details-section section-padding">
    <div class="container">
        <!-- Blog Details Wrap Start -->
        <div class="blog-details-wrap">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Blog Details Post Start -->
                    <div class="blog-details-post">
                        <!-- Single Blog Start -->
                        <div class="single-blog-post">
                            <div class="blog-img">
                                @if($gallery->media_type=='image')
                                <img src="{{asset($gallery->media)}}" alt="">
                                @else
                                <video width="320" height="240" controls>
                                    <source src="{{asset($gallery->media)}}" type="video/mp4">
                                </video>
                                @endif
                            </div>
                            <div class="blog-content">
                                <span class="category color-4">{{ $gallery->event->title }}</span>
                                <div class="blog-meta">
                                    <span class="meta"><i class="far fa-user"></i> <a href="#">
                                            {{ $setting->name }}</a></span>
                                    <span class="meta"><i class="far fa-calendar-alt"></i>
                                        {{ date('F d, Y', strtotime($gallery->created_at)) }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- Single Blog End -->
                        <div class="blog-details-content">

                            <?= $gallery->summary ?>
                        </div>
                    </div>
                    <!-- Blog Details Post End -->
                </div>
                <div class="col-lg-4">
                    <!-- Blog Sidebar Start -->
                    <div class="blog-sidebar">
                        <!-- Sidebar Widget Start -->
                        <div class="sidebar-widget sidebar-widget-1">
                            <!-- Widget Search Form Start -->
                            <form class="search-form" method="GET" action="{{route('featured_stories_search')}}">
                                <input type="text" name="q" placeholder="Search...">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                            <!-- Widget Search Form End -->
                        </div>
                        <!-- Sidebar Widget End -->

                        <!-- Sidebar Widget Start -->
                        <div class="sidebar-widget">
                            <!-- Widget Title Start -->
                            <div class="widget-title">
                                <h3 class="title">Recent Posts</h3>
                            </div>
                            <!-- Widget Title End -->
                            <!-- Widget Recent Post Start -->
                            <div class="recent-posts">
                                <ul>
                                    @foreach ($blogs as $item)
                                        <li>
                                            <a class="post-link"
                                                href="{{route('featured_stories_detail', str_replace(" ", "_", $item->title))}}">
                                                <div class="post-thumb">
                                                    <img src="{{asset($item->image)}}" alt="">
                                                </div>
                                                <div class="post-text">
                                                    <h4 class="title">{{$item->title}}</h4>
                                                    <span class="post-meta"><i class="far fa-calendar-alt"></i>
                                                        {{date("F d, Y", strtotime($item->created_at))}}</span>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                            <!-- Widget Recent Post End -->
                        </div>
                        <hr>
                        <!-- Sidebar Widget End -->

                    </div>
                    <!-- Blog Sidebar End -->
                </div>
            </div>
        </div>
        <!-- Blog Details Wrap End -->
    </div>
</div>
<!-- Blog Details End -->
@endsection