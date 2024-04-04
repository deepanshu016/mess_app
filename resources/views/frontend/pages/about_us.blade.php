@extends('frontend.layout.master')
@section('title','Mess App | Home Page')
@section('content')

    <!-- SubHeader =============================================== -->
    <section class="parallax-window" id="short" data-parallax="scroll" data-image-src="{{ asset('/') }}site/img/sub_header_home.jpg" data-natural-width="1400" data-natural-height="350">
        <div id="subheader">
            <div id="sub_content">
                <h1>About us</h1>
                <p>Qui debitis meliore ex, tollit debitis conclusionemque te eos.</p>
                <p></p>
            </div><!-- End sub_content -->
        </div><!-- End subheader -->
    </section><!-- End section -->
    <!-- End SubHeader ============================================ -->

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="#0">Home</a></li>
                <li><a href="#0">Category</a></li>
                <li>Page active</li>
            </ul>
            <a href="#0" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a>
        </div>
    </div><!-- Position -->

    <!-- Content ================================================== -->
    <div class="container margin_60_35">
        <div class="row justify-content-between">
            <div class="col-xl-12 col-lg-12">
                <h3 class="nomargin_top">Some words about us</h3>
                <p>
                    {!! (setting()) ?  setting()->about_us : '' !!}
                </p>
            </div>
        </div><!-- End row -->
        <!-- SubHeader =============================================== -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                @if(!empty($bannerList))
                @foreach($bannerList as $banner)
                <div class="carousel-item {{ ($loop->first) ? 'active' : ''}}">
                    @if(!empty($banner) && isset($banner->getMedia("BANNER_IMAGE")[0]))
                    <a href="{{ $banner->link}}">
                        <img class="d-block w-100" src="{{ asset('public/media/').'/'.$banner->getMedia("BANNER_IMAGE")[0]->id.'/'.$banner->getMedia("BANNER_IMAGE")[0]->file_name }}" width="100" height="100">
                    </a>
                    @endif
                </div>
                @endforeach
                @endif
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
        <hr class="more_margin">
        <div class="main_title">
            <h2 class="nomargin_top">Quick food quality feautures</h2>
            <p>
                Cum doctus civibus efficiantur in imperdiet deterruisset.
            </p>
        </div>
        <div class="row">
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="feature">
                    <i class="icon_building"></i>
                    <h3><span>+ 1000</span> Restaurants</h3>
                    <p>
                        Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                    </p>
                </div>
            </div>
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.2s">
                <div class="feature">
                    <i class="icon_documents_alt"></i>
                    <h3><span>+1000</span> Food Menu</h3>
                    <p>
                        Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                    </p>
                </div>
            </div>
        </div><!-- End row -->
        <div class="row">
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.3s">
                <div class="feature">
                    <i class="icon_bag_alt"></i>
                    <h3><span>Delivery</span> or Takeaway</h3>
                    <p>
                        Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                    </p>
                </div>
            </div>
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.4s">
                <div class="feature">
                    <i class="icon_mobile"></i>
                    <h3><span>Mobile</span> support</h3>
                    <p>
                        Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                    </p>
                </div>
            </div>
        </div><!-- End row -->
        <div class="row">
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="feature">
                    <i class="icon_wallet"></i>
                    <h3><span>Cash</span> payment</h3>
                    <p>
                        Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                    </p>
                </div>
            </div>
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.6s">
                <div class="feature">
                    <i class="icon_creditcard"></i>
                    <h3><span>Secure card</span> payment</h3>
                    <p>
                        Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                    </p>
                </div>
            </div>
        </div><!-- End row -->
    </div><!-- End container -->
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 nopadding features-intro-img">
                <div class="features-bg">
                    <div class="features-img">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 nopadding">
                <div class="features-content">
                    <h3>"Ex vero mediocrem"</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a lorem quis neque interdum consequat ut sed sem. Duis quis tempor nunc. Interdum et malesuada fames ac ante ipsum primis in faucibus.
                    </p>
                    <p>
                        Per ea erant aeque corpora, an agam tibique nec. At recusabo expetendis vim. Tractatos principes mel te, dolor solet viderer usu ad.
                    </p>
                </div>
            </div>
        </div>
    </div><!-- End container-fluid  -->
    <!-- End Content =============================================== -->
@endsection
@section('page_script')

@endsection
