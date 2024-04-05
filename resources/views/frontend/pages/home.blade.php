@extends('frontend.layout.master')
@section('title','Mess App | Home Page')
@section('content')
 <!-- SubHeader =============================================== -->
 <section class="header-video">
    <div id="hero_video">
        <div id="sub_content">
            <h1>Order Takeaway or Delivery Food</h1>
            <p>
                Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.
            </p>
            <div id="custom-search-input">
                <div class="input-group">
                    <input type="text" class="search-query" placeholder="Your Address or postal code" id="pincode">
                    <span class="input-group-btn">
                    <input type="button" class="btn_search" value="">
                    </span>
                </div>
            </div>
        </div><!-- End sub_content -->
    </div>
    <img src="{{ asset('/') }}site/img/video_fix.png" alt="" class="header-video--media" data-video-src="" data-teaser-source="video/intro" data-provider="" data-video-width="1920" data-video-height="960">
    <div id="count" class="d-none d-md-block">
        <ul>
            <li><span class="number">{{ $total_mess_owner }}</span> Mess</li>
            <li><span class="number">{{ $total_people_served }}</span> People Served</li>
            <li><span class="number">{{ $total_customer }}</span> Registered Users</li>
        </ul>
    </div>
</section>
<!-- End Header video -->
<!-- End SubHeader ============================================ -->

<!-- Content ================================================== -->
<div class="container margin_60">
    <div class="main_title">
        <h2 class="nomargin_top">How it works</h2>
        <p>
            Cum doctus civibus efficiantur in imperdiet deterruisset.
        </p>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="box_home" id="one">
                <span>1</span>
                <h3>Search by address</h3>
                <p>
                    Find all mess's available in your zone.
                </p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="box_home" id="two">
                <span>2</span>
                <h3>Choose a mess</h3>
                <p>
                    We have more than 1000s of menus online.
                </p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="box_home" id="three">
                <span>3</span>
                <h3>Pay by card or cash</h3>
                <p>
                    It's quick, easy and totally secure.
                </p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="box_home" id="four">
                <span>4</span>
                <h3>Delivery - Takeaway</h3>
                <p>
                    You are lazy? Are you backing home?
                </p>
            </div>
        </div>
    </div>
</div>
<!-- End container -->
<div class="white_bg">
    <div class="container margin_60">
        <div class="main_title">
            <h2 class="nomargin_top">Choose from Most Popular</h2>
            <p>
                Cum doctus civibus efficiantur in imperdiet deterruisset.
            </p>
        </div>
        <div class="row">
            @if($messList)
                @foreach($messList as $mess)
                <div class="col-lg-6">
                    <a href="{{ route('mess.detail',['mess_id'=>$mess->id]) }}" class="strip_list">
                        <div class="ribbon_1">Popular</div>
                        <div class="desc">
                            <div class="thumb_strip">
                                <img src="{{ ($mess->logo) ? $mess->logo : asset('site/Frame-5.avif') }}" alt="">
                            </div>
                            <div class="rating">
                                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                            </div>
                            <h3>{{ $mess->mess_name }}</h3>
                            <div class="type">
                                {{ strtoupper(str_replace('_', '  ', $mess->food_type)) }}
                            </div>
                            <div class="location">
                                {{ $mess->address }},{{ $mess->city->name }}, {{ $mess->state->name }}, {{ $mess->country->name }},{{ $mess->pincode }}
                            </div>
                        </div><!-- End desc-->
                    </a>
                </div>
                @endforeach
            @endif
        </div><!-- End row -->
    </div><!-- End container -->
</div>
<!-- End white_bg -->
<div class="high_light">
    <div class="container">
        <h3>Choose from over 2,000 Mess's</h3>
        <p>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</p>
        <a href="{{ route('mess.list') }}">View all Mess</a>
    </div><!-- End container -->
</div>
<!-- End hight_light -->
<section class="parallax-window" data-parallax="scroll" data-image-src="{{ asset('/') }}site/img/bg_office.jpg" data-natural-width="1200" data-natural-height="600">
    <div class="parallax-content">
        <div class="sub_content">
            <i class="icon_mug"></i>
            <h3>We also deliver to your office</h3>
            <p>
                Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.
            </p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section>
<!-- End section -->
<!-- End Content =============================================== -->

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
















<div class="container margin_60">
    <div class="main_title margin_mobile">
        <h2 class="nomargin_top">Work with Us</h2>
        <p>
            Cum doctus civibus efficiantur in imperdiet deterruisset.
        </p>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <a class="box_work" href="#">
                <img src="{{ asset('/') }}site/img/submit_restaurant.jpg" width="848" height="480" alt="" class="img-fluid">
                <h3>Submit your Mess<span>Start to earn customers</span></h3>
                <p>Lorem ipsum dolor sit amet, ut virtute fabellas vix, no pri falli eloquentiam adversarium. Ea legere labore eam. Et eum sumo ocurreret, eos ei saepe oratio omittantur, legere eligendi partiendo pro te.</p>
                <a href="#0" data-toggle="modal" data-target="#mess_register_2"><div class="btn_1">Become a Mess Owner</div></a>
            </a>
        </div>
        <div class="col-md-4">
            <a class="box_work" href="#">
                <img src="{{ asset('/') }}site/img/delivery.jpg" width="848" height="480" alt="" class="img-fluid">
                <h3>Refer and Earn <span>Start to earn money</span></h3>
                <p>Lorem ipsum dolor sit amet, ut virtute fabellas vix, no pri falli eloquentiam adversarium. Ea legere labore eam. Et eum sumo ocurreret, eos ei saepe oratio omittantur, legere eligendi partiendo pro te.</p>
                @if(Auth::user() && Auth::user()->hasRole('CUSTOMER'))
                    <a href="{{ route('customer.refer.earn') }}"><div class="btn_1">Refer & Earn</div></a>
                @else
                    <a href="#0" data-toggle="modal" data-target="#login_2"><div class="btn_1">Book a Mess</div></a>
                @endif
            </a>
        </div>
        <div class="col-md-4">
            <a class="box_work" href="#">
                <img src="{{ asset('/') }}site/img/delivery.jpg" width="848" height="480" alt="" class="img-fluid">
                <h3>We are looking for a Driver<span>Start to earn money</span></h3>
                <p>Lorem ipsum dolor sit amet, ut virtute fabellas vix, no pri falli eloquentiam adversarium. Ea legere labore eam. Et eum sumo ocurreret, eos ei saepe oratio omittantur, legere eligendi partiendo pro te.</p>
                @if(Auth::user() && Auth::user()->hasRole('CUSTOMER'))
                    <a href="{{ route('view.profile') }}"><div class="btn_1">Profile</div></a>
                @else
                    <a href="#0" data-toggle="modal" data-target="#login_2"><div class="btn_1">Book a Mess</div></a>
                @endif
            </a>
        </div>
    </div><!-- End row -->
</div>
<!-- End container -->
@endsection
@section('page_script')
<script type="text/javascript" src="{{ asset('/') }}site/js/pop_up.min.js"></script>
<script type="text/javascript" src="{{ asset('/') }}site/js/pop_up_func.js"></script>
<script>
    $("body").on('keypress','#pincode',function(event) {
        if (event.which === 13) {
            filterMess();
        }
    });
    $("body").on("click",'.btn_search',function(e){
        e.preventDefault();
        filterMess();
    });
    function filterMess(){
        var pincode = $("#pincode").val();
        if(pincode){
            window.location = "{{ url('mess-list') }}"+'?params='+pincode;
        }else{
            return false;
        }
    }
</script>
@endsection
