<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="pizza, delivery food, fast food, sushi, take away, chinese, italian food">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Favicons-->
    <link rel="shortcut icon" href="{{ asset('public/media/').'/'.setting()->getMedia("SITE_LOGO")[0]->id.'/'.setting()->getMedia("SITE_LOGO")[0]->file_name }}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{ asset('/') }}site/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{ asset('/') }}site/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{ asset('/') }}site/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{ asset('/') }}site/img/apple-touch-icon-144x144-precomposed.png">
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&amp;family=Lato:wght@300;400;700;900&amp;display=swap" rel="stylesheet">
    <!-- BASE CSS -->
    <link href="{{ asset('/') }}site/css/animate.min.css" rel="stylesheet">
	<link href="{{ asset('/') }}site/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset('/') }}site/css/menu.css" rel="stylesheet">
	<link href="{{ asset('/') }}site/css/style.css" rel="stylesheet">
	<link href="{{ asset('/') }}site/css/responsive.css" rel="stylesheet">
	<link href="{{ asset('/') }}site/css/elegant_font/elegant_font.min.css" rel="stylesheet">
	<link href="{{ asset('/') }}site/css/fontello/css/fontello.min.css" rel="stylesheet">
	<link href="{{ asset('/') }}site/css/magnific-popup.css" rel="stylesheet">
	<link href="{{ asset('/') }}site/css/pop_up.css" rel="stylesheet">
    <link  href="{{ asset('/') }}frontend/assets/css/main.css" id="stylesheet">
    <!-- Radio and check inputs -->
    <link href="{{ asset('/') }}site/css/skins/square/grey.css" rel="stylesheet">

    <!-- Gallery -->
    <link href="{{ asset('/') }}site/css/slider-pro.min.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('/') }}site/css/custom.css" rel="stylesheet">
    <link href="{{ asset('/') }}site/css/admin.css" rel="stylesheet">
	<!-- YOUR CUSTOM CSS -->
    <!-- Modernizr -->
	<script src="{{ asset('/') }}site/js/modernizr.js"></script>
    <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/css/main_one.css" id="stylesheet">
    <link rel="stylesheet" href="{{ asset('/') }}style.css" />
    <link href="{{ asset('/') }}site/css/blog.css" rel="stylesheet">
    <link href="{{ asset('/') }}frontend/layerslider/css/layerslider.css" rel="stylesheet">
</head>
<body>
    {{-- <div id="preloader">
        <div class="sk-spinner sk-spinner-wave" id="status">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
    </div> --}}
    <!-- End Preload -->
    <!-- Login modal -->
    @include('frontend.layout.header')
    @yield('content')
    @include('frontend.layout.footer')
    <div class="modal fade" id="login_2" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-popup">
                <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                <form action="{{ route('check.login') }}" class="popup-form" id="loginForms"  method="POST">
                    @csrf
                    <div class="login_icon"><i class="icon_lock_alt"></i></div>
                    <input type="text" class="form-control" placeholder="Email" name="email">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    {{-- <div class="text-left">
                        <a href="#">Forgot Password?</a>
                    </div> --}}
                    <button type="submit" class="btn btn-submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End modal -->
    <!-- Register modal -->
    <div class="modal fade" id="register_2" tabindex="-1" role="dialog" aria-labelledby="myRegister" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-popup">
                <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                <form class="popup-form" id="registerForm" method="POST" action="{{ route('user.signup') }}">
                    @csrf
                    <input type="hidden" class="form-control" name="signup_type" value="customer" placeholder="Phone">
                    <div class="login_icon"><i class="icon_lock_alt"></i></div>
                    <input type="text" class="form-control form-white" placeholder="Name" name="name">
                    <input type="text" class="form-control form-white" name="phone" placeholder="Phone">
                    <input type="email" class="form-control form-white" placeholder="Email" name="email">
                    <input type="password" class="form-control form-white" placeholder="Password" id="password1" name="password">
                    <input type="password" class="form-control form-white" placeholder="Confirm password" id="password2" name="password_confirmation">
                    <select class="form-control" name="mess_id">
                        <option value="">Select Mess</option>
                        @php
                            $messList = mess_owner_list();
                        @endphp
                        @if(!empty($messList))
                        @foreach ($messList as $mess)
                        <option value="{{ $mess->id }}">{{ $mess->mess_name }}</option>
                        @endforeach
                        @endif
                    </select>
                    <div id="pass-info" class="clearfix"></div>
                    <div class="checkbox-holder text-left">
                        <div class="checkbox">
                            <input type="checkbox" id="check_2" value="1" name="terms_condition" />
                            <label for="check_2"><span>I Agree to the <strong>Terms &amp; Conditions</strong></span></label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-submit">Register</button>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="mess_register_2" tabindex="-1" role="dialog" aria-labelledby="myRegister" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-popup">
                <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                <form class="popup-form" id="messRegisterForm" method="POST" action="{{ route('user.signup') }}">
                    @csrf
                    <input type="hidden" class="form-control" name="signup_type" value="mess_owner" placeholder="Phone">
                    <div class="login_icon"><i class="icon_lock_alt"></i></div>
                    <input type="text" class="form-control form-white" placeholder="Name" name="name">
                    <input type="text" class="form-control form-white" name="phone" placeholder="Phone">
                    <input type="email" class="form-control form-white" placeholder="Email" name="email">
                    <input type="password" class="form-control form-white" placeholder="Password" id="password1" name="password">
                    <input type="password" class="form-control form-white" placeholder="Confirm password" id="password2" name="password_confirmation">
                    <select class="form-control get-state" name="country_id">
                        <option value="">Select Country</option>
                        @php
                            $countries = country_list();
                        @endphp
                        @if(!empty($countries))
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="form-group state-data"></div>
                    <div class="form-group city-data"></div>
                    <div id="pass-info" class="clearfix"></div>
                    <div class="checkbox">
                        <input type="checkbox" value="1" name="terms_condition" checked />
                        <label><span>I Agree to the <strong>Terms &amp; Conditions</strong></span></label>
                    </div>
                    <button type="submit" class="btn btn-submit">Register</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End Register modal -->
    <!-- COMMON SCRIPTS -->
    <script src="{{ asset('/') }}site/js/jquery-3.7.0.min.js"></script>
    <script src="{{ asset('/') }}site/js/common_scripts_min.js"></script>
    <script src="{{ asset('/') }}site/js/functions.js"></script>
    <script src="{{ asset('/') }}site/assets/validate.js"></script>
    <!-- SPECIFIC SCRIPTS -->
    <script src="{{ asset('/') }}site/js/video_header.js"></script>
    <script src="{{ asset('/') }}site/js/map_single.js"></script>
    <script src="{{ asset('/') }}site/js/jquery.sliderPro.min.js"></script>
    <script src="{{ asset('/') }}frontend/common/CommonLib.js"></script>
    <script src="{{ asset('/') }}cute-alert.js"></script>
    <script src="{{ asset('/') }}site/js/tabs.js"></script>
    <script src="{{ asset('/') }}frontend/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}frontend/plugins/datatables/js/datatables.init.js"></script>
    @yield('page_script')
    <script>
        $(document).ready(function() {
            'use strict';
            HeaderVideo.init({
                container: $('.header-video'),
                header: $('.header-video--media'),
                videoTrigger: $("#video-trigger"),
                autoPlayVideo: true
            });
        });
    </script>
    <script src="{{ asset('/') }}frontend/layerslider/js/greensock.js"></script>
    <script src="{{ asset('/') }}frontend/layerslider/js/layerslider.transitions.js"></script>
    <script src="{{ asset('/') }}frontend/layerslider/js/layerslider.kreaturamedia.jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            'use strict';
            $('#layerslider').layerSlider({
                autoStart: true,
                responsive: true,
                responsiveUnder: 1280,
                layersContainer: 1170,
                navButtons:false,
                showCircleTimer:false,
                navStartStop:false,
                skinsPath: "{{ asset('/') }}frontend/layerslider/skins/"
                // Please make sure that you didn't forget to add a comma to the line endings
                // except the last line!
            });
        });
    </script>
    <script type="text/javascript">
        $( document ).ready(function( $ ) {
            $( '#Img_carousel' ).sliderPro({
                width: 960,
                height: 500,
                fade: true,
                arrows: true,
                buttons: false,
                fullScreen: false,
                smallSize: 500,
                startSlide: 0,
                mediumSize: 1000,
                largeSize: 3000,
                thumbnailArrows: true,
                autoplay: false
            });
        });
    </script>
    <script>
        $(function(){
            $("body").on("change",".get-state",function(e){
                e.preventDefault();
                const url = "{{ route('get.state.list') }}";
                const id = $(this).val();
                formData = new FormData();
                formData.append('country_id',id);
                CommonLib.ajaxForm(formData,'POST',url).then(d=>{
                    if(d.status === 200){
                        $(".state-data").html(d.html);
                    }else{
                        CommonLib.notification.error(d.msg);
                    }
                }).catch(e=>{
                    CommonLib.notification.error(e.responseJSON.errors);
                });
            });
            $("body").on("change",".get-city",function(e){
                e.preventDefault();
                const url = "{{ route('get.city.list') }}";
                const id = $(this).val();
                formData = new FormData();
                formData.append('state_id',id);
                CommonLib.ajaxForm(formData,'POST',url).then(d=>{
                    if(d.status === 200){
                        $(".city-data").html(d.html);
                    }else{
                        CommonLib.notification.error(d.msg);
                    }
                }).catch(e=>{
                    CommonLib.notification.error(e.responseJSON.errors);
                });
            });
            $("body").on('submit','#loginForms',function(e){
                e.preventDefault();
                const url = $(this).attr('action');
                const method = $(this).attr('method');
                var formData = $('#loginForms')[0];
                formData = new FormData(formData);
                CommonLib.ajaxForm(formData,method,url).then(d=>{
                    if(d.status === 200){
                        CommonLib.notification.success(d.msg);
                        setTimeout(function(){
                            window.location = d.url;
                        },1000);
                    }else{
                        CommonLib.notification.error(d.msg);
                    }
                }).catch(e=>{
                    const error = JSON.parse(e.responseText);
                    CommonLib.notification.error(error.errors);
                });
            });
            $("body").on('submit','#registerForm',function(e){
                e.preventDefault();
                const url = $(this).attr('action');
                const method = $(this).attr('method');
                var formData = $('#registerForm')[0];
                formData = new FormData(formData);
                CommonLib.ajaxForm(formData,method,url).then(d=>{
                    if(d.status === 200){
                        CommonLib.notification.success(d.msg);
                        location.reload();
                    }else{
                        CommonLib.notification.error(d.msg);
                    }
                }).catch(e=>{
                    const error = JSON.parse(e.responseText);
                    CommonLib.notification.error(error.errors);
                });
            });
            $("body").on('submit','#messRegisterForm',function(e){
                e.preventDefault();
                const url = $(this).attr('action');
                const method = $(this).attr('method');
                var formData = $('#messRegisterForm')[0];
                formData = new FormData(formData);
                CommonLib.ajaxForm(formData,method,url).then(d=>{
                    if(d.status === 200){
                        CommonLib.notification.success(d.msg);
                        setTimeout(function(){
                            window.location = d.url;
                        },1000);
                    }else{
                        CommonLib.notification.error(d.msg);
                    }
                }).catch(e=>{
                    const error = JSON.parse(e.responseText);
                    CommonLib.notification.error(error.errors);
                });
            });
        });
    </script>
</body>
</html>
