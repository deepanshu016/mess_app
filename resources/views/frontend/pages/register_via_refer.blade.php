@extends('frontend.layout.master')
@section('title','Mess App | Refer & Earn')
@section('content')
<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="img/sub_header_cart.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            <h1>Registeration </h1>
            <p>Registeration</p>
            <p></p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>Registeration</li>
        </ul>
    </div>
</div><!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60">
    <div id="tabs" class="tabs">
        <div class="content content_wrapper">
            <section id="section-2" class="content-current">
                <div class="indent_title_in">
                    <i class="icon_currency_alt"></i>
                    <h3>Registeration</h3>
                    <p>Start your journey with us</p>
                </div>

                <div class="wrapper_indent  modal-popup">
                    <form class="popup-form" id="registerForm" method="POST" action="{{ route('user.signup') }}">
                        @csrf
                        <input type="hidden" class="form-control" name="signup_type" value="customer" placeholder="Phone">
                        <div class="login_icon"><i class="icon_lock_alt"></i></div>
                        <input type="text" class="form-control form-white" placeholder="Name" name="name">
                        <input type="hidden" class="form-control form-white" placeholder="Referral Code" name="referral_code" value="{{ @$referral_code}}">
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
            </section>
        </div><!-- End content -->
    </div>
</div><!-- End container  -->
<!-- End Content =============================================== -->
@endsection
