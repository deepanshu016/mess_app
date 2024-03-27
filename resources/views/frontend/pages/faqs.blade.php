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
    <!-- End Content =============================================== -->
    <!-- End Content =============================================== -->
@endsection
@section('page_script')

@endsection
