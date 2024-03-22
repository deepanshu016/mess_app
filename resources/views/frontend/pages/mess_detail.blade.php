@extends('frontend.layout.master')
@section('title','Mess Detail | Home Page')
@section('content')
    <!-- SubHeader =============================================== -->
    <section class="parallax-window" data-parallax="scroll" data-image-src="{{ asset('/') }}site/img/sub_header_2.jpg" data-natural-width="1400" data-natural-height="470">
        <div id="subheader">
            <div id="sub_content">
                <div id="thumb"><img src="{{ ($singleMess->logo) ? $singleMess->logo : assets('site/Frame-5.avif') }}" alt=""></div>
                <div class="rating"><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i> ( <small><a href="#0">98 reviews</a></small> )</div>
                <h1>{{ $singleMess->mess_name }}</h1>
                <div><em>{{ $singleMess->food_type }}</em></div>
                <div><i class="icon_pin"></i> {{ $singleMess->address }},{{ $singleMess->city->name }}, {{ $singleMess->state->name }}, {{ $singleMess->country->name }},{{ $singleMess->pincode }}
            </div><!-- End sub_content -->
        </div><!-- End subheader -->
    </section><!-- End section -->
    <!-- End SubHeader ============================================ -->

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('mess.list') }}">Mess</a></li>
                <li>{{ $singleMess->mess_name }}</li>
            </ul>
            <a href="#0" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a>
        </div>
    </div><!-- Position -->

    <div class="collapse" id="collapseMap">
            <div id="map" class="map"></div>
    </div><!-- End Map -->

    <!-- Content ================================================== -->
    <div class="container margin_60_35">
        <div class="row">
            <div class="col-lg-4">
                <p>
                    <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on map</a>
                </p>
                <div class="box_style_2">
                    <h4 class="nomargin_top">Menu Details <i class="icon_clock_alt float-right"></i></h4>
                    <ul class="opening_list">
                        <li>Monday<span>({{ ($menuList['monday']) ? $menuList['monday']['count'] : 0 }} Meals)</span></li>
                        <li>Tuesday<span>({{ ($menuList['tuesday']) ? $menuList['tuesday']['count'] : 0 }} Meals)</span></li>
                        <li>Wednesday <span>({{ ($menuList['wednesday']) ? $menuList['wednesday']['count'] : 0 }} Meals)</span></li>
                        <li>Thursday<span>({{ ($menuList['thursday']) ? $menuList['thursday']['count'] : 0 }} Meals)</span></li>
                        <li>Friday<span>({{ ($menuList['friday']) ? $menuList['friday']['count'] : 0 }} Meals)</span></li>
                        <li>Saturday<span>({{ ($menuList['saturday']) ? $menuList['saturday']['count'] : 0 }} Meals)</span></li>
                        <li>Sunday <span>({{ ($menuList['sunday']) ? $menuList['sunday']['count'] : 0 }} Meals)</span></li>
                    </ul>
                </div>
                <div class="box_style_2 d-none d-sm-block" id="help">
                    <i class="icon_lifesaver"></i>
                    <a href="{{ route('view.menu',['mess_id'=>$singleMess->id]) }}" class="phone">View Menu</a>
                    <a href="{{ route('mess.booking',['mess_id'=>$singleMess->id]) }}" class="phone book_mess_data" data-id="{{ (auth()->user()) ? auth()->user()->id : ''}}">Book Now</a>
                    {{-- <small>Monday to Friday 9.00am - 7.30pm</small> --}}
                </div>
            </div>
            <div class="col-lg-8">
                <div class="box_style_2">
                    <h2 class="inner">Description</h2>
                    <div id="Img_carousel" class="slider-pro">
                        <div class="sp-slides">
                            <div class="sp-slide">
                                <img alt="" class="sp-image" src="#" data-src="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-small="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-medium="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-large="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-retina="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}">
                            </div>
                            <div class="sp-slide">
                                <img alt="" class="sp-image" src="#" data-src="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-small="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-medium="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-large="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-retina="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}">
                            </div>
                            <div class="sp-slide">
                                <img alt="" class="sp-image" src="#" data-src="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-small="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-medium="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-large="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-retina="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}">
                            </div>
                            <div class="sp-slide">
                                <img alt="" class="sp-image" src="#" data-src="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-small="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-medium="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-large="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-retina="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}">
                            </div>
                            <div class="sp-slide">
                                <img alt="" class="sp-image" src="#" data-src="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-small="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-medium="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-large="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-retina="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}">
                            </div>
                            <div class="sp-slide">
                                <img alt="" class="sp-image" src="#" data-src="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-small="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-medium="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-large="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-retina="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}">
                            </div>
                            <div class="sp-slide">
                                <img alt="" class="sp-image" src="#" data-src="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-small="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-medium="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-large="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-retina="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}">
                            </div>
                            <div class="sp-slide">
                                <img alt="" class="sp-image" src="#" data-src="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-small="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-medium="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-large="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-retina="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}">
                            </div>
                            <div class="sp-slide">
                                <img alt="" class="sp-image" src="#" data-src="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-small="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-medium="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}" data-large="{{ ($singleMess->logo) ? $singleMess->logo : asset('site/Frame-5.avif') }}" data-retina="{{ ($singleMess->logo) ? $singleMess->logo : asset('site/Frame-5.avif') }}">
                            </div>
                        </div>
                        <div class="sp-thumbnails">
                            <img alt="" class="sp-thumbnail" src="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}">
                            <img alt="" class="sp-thumbnail" src="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}">
                            <img alt="" class="sp-thumbnail" src="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}">
                            <img alt="" class="sp-thumbnail" src="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}">
                            <img alt="" class="sp-thumbnail" src="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}">
                            <img alt="" class="sp-thumbnail" src="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}">
                            <img alt="" class="sp-thumbnail" src="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}">
                            <img alt="" class="sp-thumbnail" src="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}">
                            <img alt="" class="sp-thumbnail" src="{{ ($singleMess->banner) ? $singleMess->banner : asset('site/Frame-5.avif') }}">
                        </div>
                    </div>
                    <h3>About us</h3>
                    <p>{!! $singleMess->mess_description !!} </p>
                    {{-- <div id="summary_review">
                        <div id="general_rating">
                            11 Reviews
                            <div class="rating">
                                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                            </div>
                        </div>
                        <div class="row" id="rating_summary">
                            <div class="col-md-6">
                                <ul>
                                    <li>Food Quality
                                        <div class="rating">
                                            <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i>
                                        </div>
                                    </li>
                                    <li>Price
                                        <div class="rating">
                                            <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <li>Punctuality
                                        <div class="rating">
                                            <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
                                        </div>
                                    </li>
                                    <li>Courtesy
                                        <div class="rating">
                                            <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- End row -->
                        <hr class="styled">
                        <a href="#" class="btn_1 add_bottom_15" data-toggle="modal" data-target="#myReview">Leave a review</a>
                    </div> --}}
                    <!-- End summary_review -->
                    {{-- <div class="review_strip_single">
                        <img src="{{ asset('/') }}site/img/avatar1.jpg" alt="" class="rounded-circle">
                        <small> - 10 March 2015 -</small>
                        <h4>Jhon Doe</h4>
                        <p>
                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a lorem quis neque interdum consequat ut sed sem. Duis quis tempor nunc. Interdum et malesuada fames ac ante ipsum primis in faucibus."
                        </p>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="rating">
                                    <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i>
                                </div>
                                Food Quality
                            </div>
                            <div class="col-md-3">
                                <div class="rating">
                                    <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
                                </div>
                                Price
                            </div>
                            <div class="col-md-3">
                                <div class="rating">
                                    <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                                </div>
                                Punctuality
                            </div>
                            <div class="col-md-3">
                                <div class="rating">
                                    <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                                </div>
                                Courtesy
                            </div>
                        </div><!-- End row -->
                    </div> --}}
                    <!-- End review strip -->
                    {{-- <div class="review_strip_single">
                        <img src="{{ asset('/') }}site/img/avatar3.jpg" alt="" class="rounded-circle">
                        <small> - 25 March 2015 -</small>
                        <h4>Markus Schulz</h4>
                        <p>
                            "At sed dico invenire facilisis, sed option sapientem iudicabit ad, sea idque doming vituperatoribus at. Duo ut inani tantas scaevola. Commodo oblique at cum. Duo id vide delectus. Vel et doctus laoreet minimum, ei feugait pertinacia usu.
                        </p>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="rating">
                                    <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i>
                                </div>
                                Food Quality
                            </div>
                            <div class="col-md-3">
                                <div class="rating">
                                    <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i>
                                </div>
                                Price
                            </div>
                            <div class="col-md-3">
                                <div class="rating">
                                    <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
                                </div>
                                Punctuality
                            </div>
                            <div class="col-md-3">
                                <div class="rating">
                                    <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                                </div>
                                Courtesy
                            </div>
                        </div><!-- End row -->
                    </div> --}}
                    <!-- End review strip -->
                    {{-- <div class="review_strip_single last">
                        <img src="{{ asset('/') }}site/img/avatar2.jpg" alt="" class="rounded-circle">
                        <small> - 10 April 2015 -</small>
                        <h4>Frank Cooper</h4>
                        <p>
                            "Ne mea congue facilis eligendi, possit utamur sensibus id qui, mel tollit euismod alienum eu. Ad tollit lucilius praesent per, ex probo utroque placerat eos. Tale verear efficiendi et cum, meis timeam vix et, et duis debet nostro mel. Aeterno labitur per no, id nec tantas nemore. An minim molestie per, mei sumo vulputate cu."
                        </p>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="rating">
                                    <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i>
                                </div>
                                Food Quality
                            </div>
                            <div class="col-md-3">
                                <div class="rating">
                                    <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
                                </div>
                                Price
                            </div>
                            <div class="col-md-3">
                                <div class="rating">
                                    <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i>
                                </div>
                                Punctuality
                            </div>
                            <div class="col-md-3">
                                <div class="rating">
                                    <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i>
                                </div>
                                Courtesy
                            </div>
                        </div><!-- End row -->
                    </div> --}}
                    <!-- End review strip -->
                </div><!-- End box_style_1 -->
            </div>
        </div><!-- End row -->
    </div><!-- End container -->
    <!-- End Content =============================================== -->
@endsection
@section('page_script')
<script>
    $(function(){
        $("body").on("click",'.book_mess_data',function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            var user_id = $(this).data('id');
            if(user_id){
                window.location = url;
            }else{
                $("#login_2").modal('show');
            }
        });
    });
</script>
@endsection
