@extends('frontend.layout.master')
@section('title','Mess App | Refer & Earn')
@section('content')
<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="img/sub_header_cart.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            <h1>Refer & Earn</h1>
            <p>Refer & Earn</p>
            <p></p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>Refer & Earn</li>
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
                    <h3>Refer & Earn</h3>
                    <p>You can share the link and and earn on first purchase</p>
                </div>

                <div class="wrapper_indent">
                    @if(setting() && isset(setting()->referral_fees))
                        <input type="text" class="form-control" value="{{ route('register.via.referral').'?referral_code='.$user->referral_code }}" disabled>
                        <button type="button" class="btn btn-success" id="copyButton">Copy</button>
                    @else
                        <span class="text-danger">Referral Fees is not enabled ,Please contact to admin </span>
                    @endif
                </div>
            </section>
        </div><!-- End content -->
    </div>
</div><!-- End container  -->
<!-- End Content =============================================== -->
@endsection
@section('page_script')
<script>
    $(document).ready(function(){
        var referral_fees = "{{ (setting()) ? setting()->referral_fees : '0'}}";
        $('#copyButton').click(function(){
            var textToCopy = $('input').val();
            if(referral_fees){
                copyToClipboard(textToCopy);
                CommonLib.notification.success('Link copied successfully !!!!!');
            }else{
                CommonLib.notification.error('Please contact to admin to add set referral fees');
            }
        });
        function copyToClipboard(text) {
            var $tempInput = $("<input>");
            $("body").append($tempInput);
            $tempInput.val(text).select();
            document.execCommand("copy");
            $tempInput.remove();
        }
    });
    </script>
@endsection
