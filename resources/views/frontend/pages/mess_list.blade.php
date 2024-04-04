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
    </div>
</div><!-- Position -->
<div class="collapse" id="collapseMap">
    <div id="map" class="map"></div>
</div><!-- End Map -->
<!-- Content ================================================== -->
<div class="container margin_60_35">
    <div class="row">
        <div class="col-lg-3">
            {{-- <p>
                <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on map</a>
            </p> --}}
            <div id="filters_col">
                <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filters <i class="icon-plus-1 float-right"></i></a>
                <div class="collapse show" id="collapseFilters">
                    <div class="filter_type">
                        {{-- <h6>Distance</h6>
                        <input type="text" id="range" value="" name="range" class="btn_search"> --}}
                        <h6>Type</h6>
                        <ul>
                            <li><label><input type="checkbox" class="icheck food_type_filter" onClick="filterFoodType('both',this)">Both <small>({{ @$totalBothMess}})</small></label></li>
                            <li><label><input type="checkbox" class="icheck food_type_filter" onClick="filterFoodType('veg',this)">Veg <small>({{ @$totalVegMess}})</small></label><i class="color_1"></i></li>
                            <li><label><input type="checkbox" class="icheck food_type_filter" onClick="filterFoodType('non_veg',this)">Non-Veg <small>({{ @$totalNonVegMess}})</small></label><i class="color_2"></i></li>
                            <li><label><input type="hidden" class="pincode" id="pincode"  value="{{ @$params}}"></li>
                        </ul>
                    </div>
                    {{-- <div class="filter_type">
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
                    </div> --}}
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
            <div class="mess-wrapper"></div>
            <div class="load-more-wrapper"></div>
        </div>
        <!-- End col-md-9-->
    </div>
    <!-- End row -->
</div>
<!-- End container -->
<!-- End Content =============================================== -->
@endsection
@section('page_script')
<script>
    // var ENDPOINT = "{{ url('/') }}";
    var page = 1;
    var food_type_selected = [];
    var formData = new FormData();
    infiniteLoadMore(page);
    function loadMore(){
        page++;
        infiniteLoadMore(page);
    }
    function filterFoodType(food_type,parentRef){
        var index = food_type_selected.indexOf(food_type);
        if (parentRef.checked) {
            if (index !== -1) {
                food_type_selected.splice(index, 1);
            }
        } else {
            if (index === -1) {
                food_type_selected.push(food_type);
            }
        }
        removeKeyFromFormData(formData, 'food_type');
        formData.append('food_type',food_type_selected);
        infiniteLoadMore(page,'filter')
    }



    function infiniteLoadMore(page,action_type = '') {
        removeKeyFromFormData(formData, 'page');
        var pincode = $("#pincode").val();
        var url = "{{ url('load-more-mess') }}";
        formData.append('page',page);
        formData.append('params',pincode);
        CommonLib.ajaxForm(formData,'POST',url).then(d=>{
            if(d.status === 200){
                if(action_type !== 'filter'){
                    $(".mess-wrapper").append(d.html);
                }else{
                    $(".mess-wrapper").html(d.html);
                }
                $(".load-more-wrapper").html(d.html2);
                $(".spinner-grow").hide();
            }else{
                CommonLib.notification.error(d.msg);
            }
        });
    }


    function removeKeyFromFormData(formData, keyToRemove) {
        for (const pair of formData.entries()) {
            const [key, value] = pair;
            if (key === keyToRemove) {
                formData.delete(key);
            }
        }
    }
</script>
@endsection
