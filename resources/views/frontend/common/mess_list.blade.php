@if(!empty($messList))
@foreach($messList as $current)
    <div class="strip_list wow fadeIn" data-wow-delay="0.1s">
        <div class="ribbon_1">
            Popular
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="desc">
                    <div class="thumb_strip">
                        <a href="{{ route('mess.detail',['mess_id'=>$current->id]) }}"><img src="{{ ($current->logo) ? $current->logo : assets('site/Frame-5.avif') }}" alt=""></a>
                    </div>
                    <div class="rating">
                        <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i> (<small><a href="#0">98 reviews</a></small>)
                    </div>
                    <h3>{{ $current->mess_name }}</h3>
                    <div class="type">
                        {{ $current->food_type }}
                    </div>
                    <div class="location">
                        {{ $current->address }},{{ $current->city->name }}, {{ $current->state->name }}, {{ $current->country->name }},{{ $current->pincode }}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="go_to">
                    <div>
                        <a href="{{ route('view.menu',['mess_id'=>$current->id]) }}" class="btn_1">View Menu</a>
                    </div>
                </div>
            </div>
        </div><!-- End row-->
    </div>
@endforeach
@endif
