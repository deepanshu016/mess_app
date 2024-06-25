@extends('frontend.layout.master')
@section('title','Mess App | Home Page')
@section('content')
 <!-- SubHeader =============================================== -->
 <section class="parallax-window" id="short" data-parallax="scroll" data-image-src="{{ asset('/') }}site/img/sub_header_home.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            <h1>Blogs</h1>
            <p></p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>Blogs</li>
        </ul>
    </div>
</div><!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
    <div class="row">
        <div class="col-lg-9">
            @if(!empty($blogList))
            @foreach($blogList as $blog)
            <div class="post">
                <a href="#">
                    @if(!empty($blog) && isset($blog->getMedia("BLOG_IMAGE")[0]))
                        <img src="{{ asset('public/media/').'/'.$blog->getMedia("BLOG_IMAGE")[0]->id.'/'.$blog->getMedia("BLOG_IMAGE")[0]->file_name }}" class="img-fluid">
                    @else
                        <img src="{{ asset('/') }}site/img/blog-1.jpg" alt="" class="img-fluid"></a>
                    @endif
                <div class="post_info clearfix">
                    <div class="post-left">
                        <ul>
                            <li><i class="icon-calendar-empty"></i>{{ date('d/m/Y',strtotime($blog->created_at))}}</li>
                        </ul>
                    </div>
                </div>
                <h2>{{ $blog->title }}</h2>
                <p>
                    {!! $blog->description !!}
                </p>
                <a href="#" class="btn_1">Read more</a>
            </div>
            @endforeach
            @endif
        </div><!-- End col-->
        <aside class="col-lg-3" id="sidebar">
            <div class="widget">
                <div id="custom-search-input-blog">
                    <div class="input-group col-md-12">
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn-lg" type="button">
                                <i class="icon-search-1"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <hr>
            <div class="widget">
                <h4>Recent post</h4>
                <ul class="recent_post">
                    @if(!empty($recentBlogs))
                    @foreach($recentBlogs as $recent)
                    <li>
                        <i class="icon-calendar-empty"></i> {{ date('jS F, Y',strtotime($recent->created_at)) }}
                        <div><a href="#">{{ $recent->title }}</a></div>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
            <!-- SubHeader =============================================== -->
            @if(!empty($bannerList))
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach($bannerList as $key=>$banner)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->iteration }}" class="{{ ($loop->first) ? 'active' : ''}}"></li>
                    @endforeach
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    @foreach($bannerList as $banner)
                    <div class="carousel-item {{ ($loop->first) ? 'active' : ''}}">
                        @if(!empty($banner) && isset($banner->getMedia("BANNER_IMAGE")[0]))
                        <a href="{{ $banner->link}}">
                            <img class="d-block w-100" src="{{ asset('public/media/').'/'.$banner->getMedia("BANNER_IMAGE")[0]->id.'/'.$banner->getMedia("BANNER_IMAGE")[0]->file_name }}" width="100" height="100">
                        </a>
                        @endif
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
                </a>
            </div>
            @endif
        </aside><!-- End aside -->
    </div>
</div><!-- End container -->
<!-- End Content =============================================== -->
@endsection
@section('page_script')

@endsection
