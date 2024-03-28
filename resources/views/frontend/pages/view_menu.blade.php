@extends('frontend.layout.master')
@section('title','Mess App | View Menu')
@section('content')
<!-- SubHeader =============================================== -->
<section class="parallax-window" data-parallax="scroll" data-image-src="{{ asset('/') }}site/img/sub_header_2.jpg" data-natural-width="1400" data-natural-height="470">
    <div id="subheader">
        <div id="sub_content">
            <div id="thumb"><img src="{{ ($singleMess->logo) ? $singleMess->logo : assets('site/Frame-5.avif') }}" alt=""></div>
            <div class="rating"><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i> (<small><a href="detail_page_2.html">Read 98 reviews</a></small>)</div>
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
            <li>{{ $singleMess->mess_name }} Menus</li>
        </ul>
    </div>
</div><!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
    <div class="row">
        <div class="col-lg-3">
            <p><a href="{{ route('mess.list') }}" class="btn_side">Back to search</a></p>
            <div class="box_style_1">
                <ul id="cat_nav">
                    <li><a href="#monday" class="active">Monday <span>({{ ($menuList['monday']) ? $menuList['monday']['count'] : 0 }} Meals)</span></a></li>
                    <li><a href="#tuesday">Tuesday <span>({{ ($menuList['tuesday']) ? $menuList['tuesday']['count'] : 0}} Meals)</span></a></li>
                    <li><a href="#wednesday">Wednesday <span>({{ ($menuList['wednesday']) ? $menuList['wednesday']['count'] : 0}}} Meals)</span></a></li>
                    <li><a href="#thursday">Thursday <span>({{ ($menuList['thursday']) ? $menuList['thursday']['count'] : 0}} Meals)</span></a></li>
                    <li><a href="#friday">Friday <span>({{ ($menuList['friday']) ? $menuList['friday']['count'] : 0}} Meals)</span></a></li>
                    <li><a href="#saturday">Saturday <span>({{ ($menuList['saturday']) ? $menuList['saturday']['count'] : 0}} Meals)</span></a></li>
                    <li><a href="#sunday">Sunday <span>({{ ($menuList['sunday']) ? $menuList['sunday']['count'] : 0}} Meals)</span></a></li>
                </ul>
            </div><!-- End box_style_1 -->
            {{-- <div class="box_style_2 d-none d-sm-block" id="help">
                <i class="icon_lifesaver"></i>
                <h4>Need <span>Help?</span></h4>
                <a href="tel://004542344599" class="phone">+45 423 445 99</a>
                <small>Monday to Friday 9.00am - 7.30pm</small>
            </div> --}}

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
        </div><!-- End col -->

        <div class="col-lg-9">
            <div class="card-header bg-transparent">
                <label class="form-label">Food type</label>
                @if($singleMess->food_type == 'both')
                    <select class="form-control select-food-type" name="status">
                        <option value="">Select Food type</option>
                        <option value="veg" {{ (Request::get('menu') == 'veg') ? 'selected' : '' }}>Veg</option>
                        <option value="non_veg" {{ (Request::get('menu') == 'non_veg') ? 'selected' : '' }}>Non Veg</option>
                    </select>
                @elseif($singleMess->food_type == 'veg')
                    <select class="form-control select-food-type" name="status">
                        <option value="">Select Food type</option>
                        <option value="veg" {{ (Request::get('menu') == 'veg') ? 'selected' : '' }}>Veg</option>
                    </select>
                @else
                    <select class="form-control select-food-type" name="status">
                        <option value="">Select Food type</option>
                        <option value="non_veg" {{ (Request::get('menu') == 'non_veg') ? 'selected' : '' }}>Non Veg</option>
                    </select>
                @endif
            </div>
            <div class="box_style_2" id="main_menu">
                <h2 class="inner">Menu</h2>
                <h3 class="nomargin_top" id="monday">Monday</h3>
                <p>Meals Available for Monday</p>
                <table class="table table-striped cart-list">
                    <thead>
                        <tr>
                            <th> Meal Type</th>
                            <th>Meal Detail</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Breakfast</td>
                            <td>
                                {!! ($menuList['monday'] && $menuList['monday']['mess_detail_breakfast']) ? $menuList['monday']['mess_detail_breakfast'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_breakfast_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_breakfast_price}})
                                @else
                                    (INR {{ $singleMess->non_veg_breakfast_price}})
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Lunch</td>
                            <td>
                                {!! ($menuList['monday'] && $menuList['monday']['mess_detail_lunch']) ? $menuList['monday']['mess_detail_lunch'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_lunch_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_lunch_price}})
                                @else
                                    (INR {{ $singleMess->non_veg_lunch_price}})
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Dinner</td>
                            <td>
                                {!! ($menuList['monday'] && $menuList['monday']['mess_detail_dinner']) ? $menuList['monday']['mess_detail_dinner'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_dinner_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_dinner_price}})
                                @else
                                    (INR {{ $singleMess->non_veg_dinner_price}})
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <h3 id="tuesday">Tuesday</h3>
                <p>Meals Available for Tuesday</p>
                <table class="table table-striped cart-list">
                    <thead>
                        <tr>
                            <th> Meal Type</th>
                            <th>Meal Detail</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Breakfast</td>
                            <td>
                                {!! ($menuList['tuesday'] && $menuList['tuesday']['mess_detail_breakfast']) ? $menuList['tuesday']['mess_detail_breakfast'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_breakfast_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_breakfast_price}})
                                @else
                                    (INR {{ $singleMess->non_veg_breakfast_price}})
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Lunch</td>
                            <td>
                                {!! ($menuList['tuesday'] && $menuList['tuesday']['mess_detail_lunch']) ? $menuList['tuesday']['mess_detail_lunch'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_lunch_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_lunch_price}})
                                @else
                                    (INR {{ $singleMess->non_veg_lunch_price}})
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Dinner</td>
                            <td>
                                {!! ($menuList['tuesday'] && $menuList['tuesday']['mess_detail_dinner']) ? $menuList['tuesday']['mess_detail_dinner'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_dinner_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_dinner_price}})
                                @else
                                    (INR {{ $singleMess->non_veg_dinner_price}})
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <h3 id="wednesday">Wednesday</h3>
                <p>Meals Available for Wednesday</p>
                <table class="table table-striped cart-list">
                    <thead>
                        <tr>
                            <th> Meal Type</th>
                            <th>Meal Detail</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Breakfast</td>
                            <td>
                                {!! ($menuList['wednesday'] && $menuList['wednesday']['mess_detail_breakfast']) ? $menuList['wednesday']['mess_detail_breakfast'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_breakfast_price}}),(INR {{ $singleMess->non_veg_breakfast_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_breakfast_price}})
                                @else
                                    (INR {{ $singleMess->non_veg_breakfast_price}})
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Lunch</td>
                            <td>
                                {!! ($menuList['wednesday'] && $menuList['wednesday']['mess_detail_lunch']) ? $menuList['wednesday']['mess_detail_lunch'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_lunch_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_lunch_price}})
                                @else
                                    (INR {{ $singleMess->non_veg_lunch_price}})
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Dinner</td>
                            <td>
                                {!! ($menuList['wednesday'] && $menuList['wednesday']['mess_detail_dinner']) ? $menuList['wednesday']['mess_detail_dinner'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_dinner_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_dinner_price}})
                                @else
                                    (INR {{ $singleMess->non_veg_dinner_price}})
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <h3 id="thursday">Thursday</h3>
                <p>Meals Available for Thursday</p>
                <table class="table table-striped cart-list">
                    <thead>
                        <tr>
                            <th> Meal Type</th>
                            <th>Meal Detail</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Breakfast</td>
                            <td>
                                {!! ($menuList['thursday'] && $menuList['thursday']['mess_detail_breakfast']) ? $menuList['thursday']['mess_detail_breakfast'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_breakfast_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_breakfast_price}})
                                @else
                                    (INR {{ $singleMess->non_veg_breakfast_price}})
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Lunch</td>
                            <td>
                                {!! ($menuList['thursday'] && $menuList['thursday']['mess_detail_lunch']) ? $menuList['thursday']['mess_detail_lunch'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_lunch_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_lunch_price}})
                                @else
                                    (INR {{ $singleMess->non_veg_lunch_price}})
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Dinner</td>
                            <td>
                                {!! ($menuList['thursday'] && $menuList['thursday']['mess_detail_dinner']) ? $menuList['thursday']['mess_detail_dinner'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_dinner_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_dinner_price}})
                                @else
                                   (INR {{ $singleMess->non_veg_dinner_price}})
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h3 id="friday">Friday</h3>
                <p>Meals Available for Friday</p>
                <table class="table table-striped cart-list">
                    <thead>
                        <tr>
                            <th> Meal Type</th>
                            <th>Meal Detail</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Breakfast</td>
                            <td>
                                {!! ($menuList['friday'] && $menuList['friday']['mess_detail_breakfast']) ? $menuList['friday']['mess_detail_breakfast'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_breakfast_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_breakfast_price}})
                                @else
                                   (INR {{ $singleMess->non_veg_breakfast_price}})
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Lunch</td>
                            <td>
                                {!! ($menuList['friday'] && $menuList['friday']['mess_detail_lunch']) ? $menuList['friday']['mess_detail_lunch'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_lunch_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_lunch_price}})
                                @else
                                   (INR {{ $singleMess->non_veg_lunch_price}})
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Dinner</td>
                            <td>
                                {!! ($menuList['friday'] && $menuList['friday']['mess_detail_dinner']) ? $menuList['friday']['mess_detail_dinner'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_dinner_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_dinner_price}})
                                @else
                                   (INR {{ $singleMess->non_veg_dinner_price}})
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h3 id="saturday">Saturday</h3>
                <p>Meals Available for Saturday</p>
                <table class="table table-striped cart-list">
                    <thead>
                        <tr>
                            <th> Meal Type</th>
                            <th>Meal Detail</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Breakfast</td>
                            <td>
                                {!! ($menuList['saturday'] && $menuList['saturday']['mess_detail_breakfast']) ? $menuList['saturday']['mess_detail_breakfast'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_breakfast_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_breakfast_price}})
                                @else
                                   (INR {{ $singleMess->non_veg_breakfast_price}})
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Lunch</td>
                            <td>
                                {!! ($menuList['saturday'] && $menuList['saturday']['mess_detail_lunch']) ? $menuList['saturday']['mess_detail_lunch'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_lunch_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_lunch_price}})
                                @else
                                   (INR {{ $singleMess->non_veg_lunch_price}})
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Dinner</td>
                            <td>
                                {!! ($menuList['saturday'] && $menuList['saturday']['mess_detail_dinner']) ? $menuList['saturday']['mess_detail_dinner'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_dinner_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_dinner_price}})
                                @else
                                   (INR {{ $singleMess->non_veg_dinner_price}})
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h3 id="sunday">Sunday</h3>
                <p>Meals Available for Saturday</p>
                <table class="table table-striped cart-list">
                    <thead>
                        <tr>
                            <th> Meal Type</th>
                            <th>Meal Detail</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Breakfast</td>
                            <td>
                                {!! ($menuList['sunday'] && $menuList['sunday']['mess_detail_breakfast']) ? $menuList['sunday']['mess_detail_breakfast'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_breakfast_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_breakfast_price}})
                                @else
                                    (INR {{ $singleMess->non_veg_breakfast_price}})
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Lunch</td>
                            <td>
                                {!! ($menuList['sunday'] && $menuList['sunday']['mess_detail_lunch']) ? $menuList['sunday']['mess_detail_lunch'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_lunch_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_lunch_price}})
                                @else
                                    (INR {{ $singleMess->non_veg_lunch_price}})
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Dinner</td>
                            <td>
                                {!! ($menuList['sunday'] && $menuList['sunday']['mess_detail_dinner']) ? $menuList['sunday']['mess_detail_dinner'] : 'Not Added' !!}
                            </td>
                            <td>
                                @if($singleMess->food_type == 'both')
                                    (INR {{ $singleMess->veg_dinner_price}})
                                @elseif($singleMess->food_type == 'veg')
                                    (INR {{ $singleMess->veg_dinner_price}})
                                @else
                                    INR {{ $singleMess->non_veg_dinner_price}})
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- End box_style_1 -->
        </div><!-- End col -->
        <a class="btn_full book_a_mess" href="{{ route('book.a.mess',['mess_id'=>$singleMess->id]) }}" data-id="{{ $singleMess->id }}">Book now</a>
        {{-- <div class="col-lg-3" id="sidebar">
            <div class="theiaStickySidebar">
                <div id="cart_box">
                    <h3>Your order <i class="icon_cart_alt float-right"></i></h3>
                    <table class="table table_summary">
                        <tbody>
                            <tr>
                                <td>
                                    <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>1x</strong> Enchiladas
                                </td>
                                <td>
                                    <strong class="float-right">$11</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>2x</strong> Burrito
                                </td>
                                <td>
                                    <strong class="float-right">$14</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>1x</strong> Chicken
                                </td>
                                <td>
                                    <strong class="float-right">$20</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>2x</strong> Corona Beer
                                </td>
                                <td>
                                    <strong class="float-right">$9</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>2x</strong> Cheese Cake
                                </td>
                                <td>
                                    <strong class="float-right">$12</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <div class="row" id="options_2">
                        <div class="col-xl-6 col-md-12 col-sm-12 col-6">
                            <label><input type="radio" value="" checked name="option_2" class="icheck">Delivery</label>
                        </div>
                        <div class="col-xl-6 col-md-12 col-sm-12 col-6">
                            <label><input type="radio" value="" name="option_2" class="icheck">Take Away</label>
                        </div>
                    </div><!-- Edn options 2 -->
                    <hr>
                    <table class="table table_summary">
                        <tbody>
                            <tr>
                                <td>
                                    Subtotal <span class="float-right">$56</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Delivery fee <span class="float-right">$10</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="total">
                                    TOTAL <span class="float-right">$66</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <a class="btn_full" href="cart.html">Order now</a>
                </div><!-- End cart_box -->
            </div><!-- End theiaStickySidebar -->
        </div><!-- End col --> --}}
    </div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->
@endsection
@section('page_script')
<script>
    $('body').on("click",".book_a_mess",function(e){
        e.preventDefault();
        var messId=$(this).data('id');
        var url = $(this).attr('href');
        var formData = new FormData();
        formData.append('mess_id',messId);
        CommonLib.sweetalert.confirm(formData,'POST',url);
    });
    $('body').on("change",".select-food-type",function(e){
        var menu=$(this).val();
        alert(menu)
        window.location = "{{ route('view.menu',['mess_id'=>$singleMess->id]) }}"+'?menu='+menu
    });
</script>
@endsection
