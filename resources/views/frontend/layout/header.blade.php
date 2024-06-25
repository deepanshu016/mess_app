<!-- Header ================================================== -->
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-4">
                <a href="{{ route('home') }}" id="logo">
                    @if(!empty(setting()) && isset(setting()->getMedia("SITE_LOGO")[0]))
                        <img width="190" height="23" src="{{ asset('public/media/').'/'.setting()->getMedia("SITE_LOGO")[0]->id.'/'.setting()->getMedia("SITE_LOGO")[0]->file_name }}" width="100" height="100">
                    @else
                        <h4>FAMILY DHABA</h4>
                    @endif
                </a>
            </div>
            <nav class="col-md-8 col-sm-8 col-8">
            <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
            <div class="main-menu">
                <div id="header_menu">
                    @if(!empty(setting()) && isset(setting()->getMedia("SITE_LOGO")[0]))
                        <img width="190" height="23" src="{{ asset('public/media/').'/'.setting()->getMedia("SITE_LOGO")[0]->id.'/'.setting()->getMedia("SITE_LOGO")[0]->file_name }}" width="100" height="100">
                    @else
                        <h4>FAMILY DHABA</h4>
                    @endif
                </div>
                <a href="#" class="open_close" id="close_in"><i class="icon_close"></i></a>
                <ul>
                    <li>
                        <a href="{{ route('home') }}" class="show-submenu">Home</a>
                    </li>
                    <li><a href="{{ route('about.us') }}">About us</a></li>
                    <li><a href="{{ route('contact.us') }}">Contact us</a></li>
                    <li>
                        <a href="{{ route('mess.list') }}" class="show-submenu">Mess</a>
                    </li>
                    <li>
                        <a href="{{ route('blog.list') }}" class="show-submenu">Blogs</a>
                    </li>
                    @if(Auth::user())
                        <li class="submenu">
                            <a href="javascript:void(0);" class="show-submenu">{{ @Auth::user()->name }} <i class="icon-down-open-mini"></i></a>
                            <ul>
                                <li><a href="{{ route('view.profile') }}">Profile</a></li>
                                <li><a href="{{ route('logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @else
                        <li><a href="#0" data-toggle="modal" data-target="#login_2">Login</a></li>
                        <li><a href="#0" data-toggle="modal" data-target="#register_2">Register</a></li>
                    @endif
                </ul>
            </div><!-- End main-menu -->
            </nav>
        </div><!-- End row -->
    </div><!-- End container -->
</header>
<!-- End Header =============================================== -->
