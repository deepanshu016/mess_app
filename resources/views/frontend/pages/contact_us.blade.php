@extends('frontend.layout.master')
@section('title','Mess App | Home Page')
@section('content')
   <!-- SubHeader =============================================== -->
    <section class="parallax-window" id="short" data-parallax="scroll" data-image-src="{{ asset('/') }}site/img/sub_header_home.jpg" data-natural-width="1400" data-natural-height="350">
        <div id="subheader">
            <div id="sub_content">
             <h1>Contact Us</h1>
             <p>Qui debitis meliore ex, tollit debitis conclusionemque te eos.</p>
            </div><!-- End sub_content -->
        </div><!-- End subheader -->
    </section><!-- End section -->
    <!-- End SubHeader ============================================ -->

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Contact Us</li>
            </ul>
            <a href="#0" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a>
        </div>
    </div><!-- Position -->

    <!-- Content ================================================== -->
    <div class="container margin_60_35">
    	<div class="row" id="contacts">
        	<div class="col-md-6">
            	<div class="box_style_2">
                	<h2 class="inner">Customer service</h2>
                    <p class="add_bottom_30">Adipisci conclusionemque ea duo, quo id fuisset prodesset, vis ea agam quas. <strong>Lorem iisque periculis</strong> id vis, no eum utinam interesset. Quis voluptaria id per, an nibh atqui vix. Mei falli simul nusquam te.</p>
                    <p><a href="tel://004542344599" class="phone"><i class="icon-phone-circled"></i> {!! ' +91'.setting()->mobile_no !!}</a></p>
                    <p class="nopadding"><a href="mailto:customercare@quickfood.com"><i class="icon-mail-3"></i> {!! setting()->email !!}</a></p>
                </div>
        	</div>
            <div class="col-md-6">
            	<div class="box_style_2">
                	<h2 class="inner">Restaurant Support</h2>
                    <p class="add_bottom_30">Quo ex rebum petentium, cum alia illud molestiae in, pro ea paulo gubergren. Ne case constituto pro, ex vis delenit complectitur, per ad <strong>everti timeam</strong> conclusionemque. Quis voluptaria id per, an nibh atqui vix.</p>
                    <p><a href="tel://004542344599" class="phone"><i class="icon-phone-circled"></i> {!! ' +91'.setting()->mobile_no !!}</a></p>
                    <p class="nopadding"><a href="mailto:customercare@quickfood.com"><i class="icon-mail-3"></i> {!! setting()->email !!}</a></p>
                </div>
        	</div>
        </div><!-- End row -->
    </div><!-- End container -->
    <!-- End Content =============================================== -->
@endsection
@section('page_script')

@endsection
