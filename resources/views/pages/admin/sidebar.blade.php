        <!-- Vertical Nav -->
        <div class="kleon-vertical-nav">
            <!-- Logo  -->
            <div class="logo d-flex align-items-center justify-content-between">
                <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-3 flex-shrink-0">
                    @if(!empty(setting()) && isset(setting()->getMedia("SITE_LOGO")[0]))
                        <img src="{{ asset('public/media/').'/'.setting()->getMedia("SITE_LOGO")[0]->id.'/'.setting()->getMedia("SITE_LOGO")[0]->file_name }}" width="100" height="100">
                    @endif
                </a>
                <button type="button" class="kleon-vertical-nav-toggle"><i class="bi bi-list"></i></button>
            </div>

            <div class="kleon-navmenu">
                <h6 class="hidden-header text-gray text-uppercase ls-1 ms-4 mb-4">Main Menu</h6>
                <ul class="main-menu">
                    <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2"><span>Home</span></li>

                    <li class="menu-item {{ (Request::segment(2) == 'dashboard') ? 'active' : ''}}"><a href="{{ route('admin.dashboard') }}"> <span class="nav-icon flex-shrink-0"><i class="bi bi-speedometer fs-18"></i></span> <span class="nav-text">Dashboard</span></a></li>

                    @can('role-update')
                    <li class="menu-item {{ (Request::segment(2) == 'request') ? 'active' : ''}}"><a href="{{ route('roles.index') }}"> <span class="nav-icon flex-shrink-0"><i class="bi bi-calendar2-check fs-18"></i></span> <span class="nav-text">Roles</span></a></li>
                    @endcan
                    <li class="menu-item menu-item-has-children {{ (Request::segment(2) == 'mess-owner') ? 'active' : ''}}"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-people fs-18"></i></span> <span class="nav-text">Mess Owner</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item {{ (Request::segment(2) == 'mess-owner' && Request::segment(3) == 'create') ? 'active' : ''}}"><a href="{{ route('admin.mess_owner.add') }}"> Add New</a></li>
                            <li class="menu-item {{ (Request::segment(2) == 'mess-owner' && Request::segment(3) == 'list') ? 'active' : ''}}"><a href="{{ route('admin.mess_owner.list') }}"> List</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-item menu-item-has-children {{ (Request::segment(2) == 'users') ? 'active' : ''}}"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-people fs-18"></i></span> <span class="nav-text">Users</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item {{ (Request::segment(2) == 'users' && Request::segment(3) == 'create') ? 'active' : ''}}"><a href="{{ route('admin.users.add') }}"> Add New</a></li>
                            <li class="menu-item {{ (Request::segment(2) == 'users' && Request::segment(3) == 'list') ? 'active' : ''}}"><a href="{{ route('admin.users.list') }}"> List</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-item {{ (Request::segment(2) == 'customer') ? 'active' : ''}}"><a href="{{ route('admin.customer.list') }}"> <span class="nav-icon flex-shrink-0"><i class="bi bi-currency-exchange"></i></span> <span class="nav-text">Customers</span></a></li>

                    <li class="menu-item menu-item-has-children {{ (Request::segment(2) == 'banner') ? 'active' : ''}}"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-align-center"></i></span> <span class="nav-text">Advertisement</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item {{ (Request::segment(2) == 'banner' && Request::segment(3) == 'create') ? 'active' : ''}}"><a href="{{ route('admin.banner.add') }}"> Add New</a></li>
                            <li class="menu-item {{ (Request::segment(2) == 'banner' && Request::segment(3) == 'list') ? 'active' : ''}}"><a href="{{ route('admin.banner.list') }}"> List</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-item menu-item-has-children {{ (Request::segment(2) == 'news') ? 'active' : ''}}"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-newspaper"></i></span> <span class="nav-text">News</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item {{ (Request::segment(2) == 'news' && Request::segment(3) == 'create') ? 'active' : ''}}"><a href="{{ route('admin.news.add') }}"> Add New</a></li>
                            <li class="menu-item {{ (Request::segment(2) == 'news' && Request::segment(3) == 'list') ? 'active' : ''}}"><a href="{{ route('admin.news.list') }}"> List</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-item menu-item-has-children {{ (Request::segment(2) == 'faq') ? 'active' : ''}}"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-patch-question"></i></span> <span class="nav-text">FAQs</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item {{ (Request::segment(2) == 'faq' && Request::segment(3) == 'create') ? 'active' : ''}}"><a href="{{ route('admin.faq.add') }}"> Add New</a></li>
                            <li class="menu-item {{ (Request::segment(2) == 'faq' && Request::segment(3) == 'list') ? 'active' : ''}}"><a href="{{ route('admin.faq.list') }}"> List</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-item menu-item-has-children {{ (Request::segment(2) == 'job') ? 'active' : ''}}"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-bookmarks"></i></span> <span class="nav-text">Jobs</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item {{ (Request::segment(2) == 'job' && Request::segment(3) == 'create') ? 'active' : ''}}"><a href="{{ route('admin.job.add') }}"> Add New</a></li>
                            <li class="menu-item {{ (Request::segment(2) == 'job' && Request::segment(3) == 'list') ? 'active' : ''}}"><a href="{{ route('admin.job.list') }}"> List</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-item menu-item-has-children {{ (Request::segment(2) == 'blog') ? 'active' : ''}}"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-bookmarks"></i></span> <span class="nav-text">Blogs</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item {{ (Request::segment(2) == 'blog' && Request::segment(3) == 'create') ? 'active' : ''}}"><a href="{{ route('admin.blog.add') }}"> Add New</a></li>
                            <li class="menu-item {{ (Request::segment(2) == 'blog' && Request::segment(3) == 'list') ? 'active' : ''}}"><a href="{{ route('admin.blog.list') }}"> List</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-item {{ (Request::segment(2) == 'transaction') ? 'active' : ''}}"><a href="{{ route('admin.transaction.list') }}"> <span class="nav-icon flex-shrink-0"><i class="bi bi-currency-exchange"></i></span> <span class="nav-text">Transaction</span></a></li>
                </ul>
            </div>
        </div>
        <!-- Header Modal Search -->
        <div class="modal fade header-search-modal" id="searchModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="search-form" action="https://wpthemebooster.com/demo/themeforest/html/kleon/search.php">
                            <input type="text" name="search" class="keyword form-control w-100" placeholder="Search">
                            <button type="submit" class="btn"><img src="{{ asset('/') }}frontend/assets/img/svg/search.svg" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
