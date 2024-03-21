@extends('frontend.layout.master')
@section('title','Mess App | Mess Lists')
@section('content')
<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="{{ asset('/') }}site/img/sub_header_short.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            <h1>{{ count($messList) }} results in your pincode</h1>
            {{-- <div><i class="icon_pin"></i> 135 Newtownards Road, Belfast, BT4 1AB</div> --}}
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('mess.list') }}">Mess</a></li>
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

        <div class="col-lg-3">
            <p>
                <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on map</a>
            </p>
            <div id="filters_col">
                <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filters <i class="icon-plus-1 float-right"></i></a>
                <div class="collapse show" id="collapseFilters">
                    <div class="filter_type">
                        <h6>Distance</h6>
                        <input type="text" id="range" value="" name="range">
                        <h6>Type</h6>
                        <ul>
                            <li><label><input type="checkbox" checked class="icheck">Both <small>(49)</small></label></li>
                            <li><label><input type="checkbox" class="icheck">Veg <small>(12)</small></label><i class="color_1"></i></li>
                            <li><label><input type="checkbox" class="icheck">Non-Veg <small>(5)</small></label><i class="color_2"></i></li>
                        </ul>
                    </div>
                    <div class="filter_type">
                        <h6>Rating</h6>
                        <ul>
                            <li><label><input type="checkbox" class="icheck"><span class="rating">
                            <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i>
                            </span></label></li>
                            <li><label><input type="checkbox" class="icheck"><span class="rating">
                            <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                            </span></label></li>
                            <li><label><input type="checkbox" class="icheck"><span class="rating">
                            <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i>
                            </span></label></li>
                            <li><label><input type="checkbox" class="icheck"><span class="rating">
                            <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
                            </span></label></li>
                            <li><label><input type="checkbox" class="icheck"><span class="rating">
                            <i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
                            </span></label></li>
                        </ul>
                    </div>
                    {{-- <div class="filter_type">
                        <h6>Options</h6>
                        <ul class="nomargin">
                            <li><label><input type="checkbox" class="icheck">Delivery</label></li>
                            <li><label><input type="checkbox" class="icheck">Take Away</label></li>
                            <li><label><input type="checkbox" class="icheck">Distance 10Km</label></li>
                            <li><label><input type="checkbox" class="icheck">Distance 5Km</label></li>
                        </ul>
                    </div> --}}
                </div><!--End collapse -->
            </div><!--End filters col-->
        </div><!--End col-md -->

        <div class="col-lg-9">

            <div id="tools">
                <div class="row">
                    <div class="col-md-3 col-sm-4 col-5">
                        <div class="styled-select">
                            <select name="sort_rating" id="sort_rating">
                                <option value="" selected>Sort by ranking</option>
                                <option value="lower">Lowest ranking</option>
                                <option value="higher">Highest ranking</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-8 col-7">
                        <a href="grid_list.html" class="bt_filters"><i class="icon-th"></i></a>
                    </div>
                </div>
            </div>
            <!--End tools -->
            <div class="mess-wrapper">
                @include('frontend.common.mess_list')
            </div>
            <!-- End strip_list-->
            <a href="javascript:void(0);" id="load-more" onclick="loadMore()" class="load_more_bt wow fadeIn">Load more...</a>
        </div><!-- End col-md-9-->

    </div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->
@endsection
@section('page_script')
<script>
    // var ENDPOINT = "{{ url('/') }}";
    var page = 1;
    infinteLoadMore(page);
    function loadMore(){
        page++;
        infinteLoadMore(page);
    };
    function infinteLoadMore(page) {
        alert(page);
        var url = "{{ url('load-more-mess') }}" + '?page='+ page;
        const id = $(this).val();
        formData = new FormData();
        formData.append('page',page);
        CommonLib.ajaxForm(formData,'GET',url).then(d=>{
            if(d.status === 200){
                CommonLib.notification.success(d.msg);
                $(".mess-wrapper").append(d.html);
                page = (parseInt(page) + 1);
            }else{
                CommonLib.notification.error(d.msg);
            }
        });
    }
</script>
@endsection
