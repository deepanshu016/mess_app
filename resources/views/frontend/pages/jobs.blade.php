@extends('frontend.layout.master')
@section('title','Mess App | Home Page')
@section('content')


<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="{{ asset('/') }}site/img/sub_header_home.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            <h1>Career</h1>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>Career</li>
        </ul>
    </div>
</div><!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-10">

        <div class="row">
            @if(!empty($jobList))
            @foreach($jobList as $job)
            <div class="col-md-6 wow zoomIn" data-wow-delay="0.1s">
                <a class="strip_list grid" href="{{ route('job.view',['job_id'=>$job->id]) }}">
                    <div class="desc">
                        <h3>{{ $job->title}}</h3>
                        <div class="type">
                            Total Vacancy : {{ $job->vacant_seat}}
                        </div>
                        <div class="location">
                            {!!  $job->description !!}
                        </div>
                    </div>
                </a><!-- End strip_list-->
            </div>
            @endforeach
            @endif
        </div>
    </div><!-- End col-md-9-->
    <div class="col-lg-2"></div>
</div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->



@endsection
@section('page_script')

@endsection
