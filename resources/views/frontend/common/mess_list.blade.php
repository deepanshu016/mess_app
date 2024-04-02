@if(!empty($messList))
@foreach($messList as $current)
    @php
        $advertisement = random_ads();
    @endphp
    <div class="strip_list wow fadeIn" data-wow-delay="0.1s">
        <div class="ribbon_1">
            Popular
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="desc">
                    <div class="thumb_strip">
                        <a href="{{ route('mess.detail',['mess_id'=>$current->id]) }}"><img src="{{ ($current->logo) ? $current->logo : asset('site/Frame-5.avif') }}" alt=""></a>
                    </div>
                    <div class="rating">
                        <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i> (<small><a href="#0">98 reviews</a></small>)
                    </div>
                    <h3>{{ $current->mess_name }}</h3>
                    <div class="type">
                        {{ strtoupper(str_replace('_', '  ', $current->food_type)) }}
                    </div>
                    <div class="location">
                        {{ $current->address }},{{ $current->city->name }}, {{ $current->state->name }}, {{ $current->country->name }},{{ $current->pincode }}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="go_to">
                    <div>
                        <a href="{{ route('view.menu',['mess_id'=>$current->id]).'?menu='.(($current->food_type == 'both') ? 'veg' : $current->food_type) }}" class="btn_1">View Menu</a>
                    </div>
                </div>
            </div>
        </div><!-- End row-->
    </div>
    @if(!empty($advertisement))
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    @if(!empty($advertisement) && isset($advertisement->getMedia("BANNER_IMAGE")[0]))
                    <a href="{{ $advertisement->link}}">
                        <img class="d-block w-100" src="{{ asset('public/media/').'/'.$advertisement->getMedia("BANNER_IMAGE")[0]->id.'/'.$advertisement->getMedia("BANNER_IMAGE")[0]->file_name }}" width="100" height="100">
                    </a>
                    @endif
                </div>
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
@endforeach
@endif

