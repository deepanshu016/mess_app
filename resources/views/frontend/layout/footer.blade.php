 <!-- Footer ================================================== -->
 <footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h3>Secure payments with</h3>
                <p>
                    <img src="{{ asset('/') }}site/img/cards.png" alt="" class="img-fluid">
                </p>
            </div>
            <div class="col-md-3">
                <h3>About</h3>
                <ul>
                    <li><a href="{{ route('about.us') }}">About us</a></li>
                    <li><a href="{{ route('faqs') }}">Faq</a></li>
                    <li><a href="{{ route('contact.us') }}">Contacts</a></li>
                    <li><a href="{{ route('job.list') }}">Career</a></li>
                </ul>
            </div>
            <div class="col-md-3" id="newsletter">
                <h3>Newsletter</h3>
                <p>
                    Join our newsletter to keep be informed about offers and news.
                </p>
                <div id="message-newsletter_2">
                </div>
                <form method="post" action="http://www.ansonika.com/quickfood/assets/newsletter.php" name="newsletter_2" id="newsletter_2">
                    <div class="form-group">
                        <input name="email_newsletter_2" id="email_newsletter_2" type="email" value="" placeholder="Your mail" class="form-control">
                    </div>
                    <input type="submit" value="Subscribe" class="btn_1" id="submit-newsletter_2">
                </form>
            </div>
            <div class="col-md-2">
                <h3>Important Links</h3>
                <ul>
                    <li><a href="#0" data-toggle="modal" data-target="#login_2">Login</a></li>
                    <li><a href="{{ route('login') }}">Admin Panel </a></li>
                    <li><a href="{{ route('login') }}">Mess Panel </a></li>
                    <li><a href="#0" data-toggle="modal" data-target="#mess_register_2">Mess Signup </a></li>
                </ul>
            </div>
        </div><!-- End row -->
        <div class="row">
            <div class="col-md-12">
                <div id="social_footer">
                    <ul>
                        @if(setting() && isset(setting()->facebook_link))
                            <li><a href="{{ setting()->facebook_link }}"><i class="icon-facebook"></i></a></li>
                        @endif
                        @if(setting() && isset(setting()->twitter_link))
                            <li><a href="{{ setting()->twitter_link}}"><i class="icon-twitter"></i></a></li>
                        @endif
                        @if(setting() && isset(setting()->google_link))
                            <li><a href="{{ setting()->google_link}}"><i class="icon-google"></i></a></li>
                        @endif
                        @if(setting() && isset(setting()->instagram_link))
                            <li><a href="{{ setting()->instagram_link}}"><i class="icon-instagram"></i></a></li>
                        @endif
                    </ul>
                    <p>
                        © FAMILY DHABA {{ date('Y')}}
                    </p>
                </div>
            </div>
        </div><!-- End row -->
    </div><!-- End container -->
</footer>
<!-- End Footer =============================================== -->
