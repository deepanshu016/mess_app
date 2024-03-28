@extends('frontend.layout.master')
@section('title','Mess App | FAQs')
@section('content')
   <!-- SubHeader =============================================== -->
    <section class="parallax-window" id="short" data-parallax="scroll" data-image-src="{{ asset('/') }}site/img/sub_header_home.jpg" data-natural-width="1400" data-natural-height="350">
        <div id="subheader">
            <div id="sub_content">
                <h1>Frequently asked questions</h1>
                <p>Qui debitis meliore ex, tollit debitis conclusionemque te eos.</p>
            </div><!-- End sub_content -->
        </div><!-- End subheader -->
    </section><!-- End section -->
    <!-- End SubHeader ============================================ -->

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>FAQs</li>
            </ul>
        </div>
    </div><!-- Position -->

    <!-- Content ================================================== -->
    <div class="container margin_60_35">
        <div class="row">
            <div class="col-lg-2"></div><!-- End col-md-3 -->
            <div class="col-lg-10">
                <h3 class="nomargin_top">FAQs</h3>
                <div class="panel-group" id="payment">
                    @if(!empty($faqList))
                    @foreach($faqList as $faq)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#payment" href="#collapseOne">{{ $faq->question }}<i class="indicator icon_plus_alt2 float-right"></i></a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div><!-- End col-md-9 -->
            <div class="col-lg-2"></div><!-- End col-md-3 -->
        </div><!-- End row -->
    </div><!-- End container -->
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
    <!-- End Content =============================================== -->
    <!-- End Content =============================================== -->
@endsection
@section('page_script')

@endsection
