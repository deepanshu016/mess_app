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
                    <li class="menu-item menu-item-has-children {{ (Request::segment(2) == 'mess-owner') ? 'active' : ''}}"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-people fs-18"></i></span> <span class="nav-text">Mess Owner</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item {{ (Request::segment(2) == 'mess-owner' && Request::segment(3) == 'create') ? 'active' : ''}}"><a href="{{ route('admin.mess_owner.add') }}"> Add New</a></li>
                            <li class="menu-item {{ (Request::segment(2) == 'mess-owner' && Request::segment(3) == 'list') ? 'active' : ''}}"><a href="{{ route('admin.mess_owner.list') }}"> List</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-item {{ (Request::segment(2) == 'transaction') ? 'active' : ''}}"><a href="{{ route('admin.transaction.list') }}"> <span class="nav-icon flex-shrink-0"><i class="bi bi-currency-exchange"></i></span> <span class="nav-text">Transaction</span></a></li>
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
        <!-- Theme Customizer Panel -->
        <button class="aside_open btn btn-primary position-fixed z-index-9 rounded-circle p-0 m-0 d-flex align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#themeSwitcher"><i class="bi bi-gear-fill fs-20"></i></button>
        <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="themeSwitcher">
            <div class="offcanvas-header bg-light-200">
                <h5 class="offcanvas-title">Theme Customizer</h5>
                <button type="button" class="aside_close btn btn-danger z-index-9 rounded-circle p-0 m-0 d-flex align-items-center justify-content-center" data-bs-dismiss="offcanvas" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="offcanvas-body bg-white p-0">
                <div class="bg-light-500 p-4 flex-grow-1">
                    <h6 class="mb-3 lh-16">Theme Color Mode</h6>
                    <div>
                        <div class="form-switch p-0">
                            <label class="form-label mb-0" for="colorSwitch4">Light</label>
                            <input type="checkbox" class="form-check-input border-0 m-0 mx-3" id="colorSwitch4">
                            <label class="form-label mb-0" for="colorSwitch4">Dark</label>
                        </div>
                    </div>
                </div>


                <div class="bg-light-200 p-4 flex-grow-1">
                    <h6 class="mb-3 lh-16">Navigation Layout</h6>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-check form-check-inline with-layout-image m-0">
                                <input type="radio" class="form-check-input" id="verticalNav" name="checkLayout" value="vertical" checked>
                                <label class="form-label mb-0" for="verticalNav">
                                    <span class="d-inline-block mb-2">
                                        <img class="light-version img-fluid rounded-1" src="{{ asset('/') }}frontend/assets/img/customizer/vertical-light.png" alt="img">
                                        <img class="dark-version img-fluid rounded-1" src="{{ asset('/') }}frontend/assets/img/customizer/vertical-dark.png" alt="img">
                                    </span>
                                    <span class="label-text">Vertical</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check form-check-inline with-layout-image m-0">
                                <input type="radio" class="form-check-input" id="horizontalNav" name="checkLayout" value="horizontal">
                                <label class="form-label mb-0" for="horizontalNav">
                                    <span class="d-inline-block mb-2">
                                        <img class="light-version img-fluid rounded-1" src="{{ asset('/') }}frontend/assets/img/customizer/horizontal-light.png" alt="img">
                                        <img class="dark-version img-fluid rounded-1" src="{{ asset('/') }}frontend/assets/img/customizer/horizontal-dark.png" alt="img">
                                    </span>
                                    <span class="label-text">Horizontal</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check form-check-inline with-layout-image m-0">
                                <input type="radio" class="form-check-input" id="comboNav" name="checkLayout" value="combo">
                                <label class="form-label mb-0" for="comboNav">
                                    <span class="d-inline-block mb-2">
                                        <img class="light-version img-fluid rounded-1" src="{{ asset('/') }}frontend/assets/img/customizer/combo-light.png" alt="img">
                                        <img class="dark-version img-fluid rounded-1" src="{{ asset('/') }}frontend/assets/img/customizer/combo-dark.png" alt="img">
                                    </span>
                                    <span class="label-text">Combo</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="bg-light-500 p-4 flex-grow-1">
                    <h6 class="mb-3 lh-16">Vertical Navigation Styles</h6>
                    <div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="fullwidthNav" name="checkVerticalNav" value="fullwidth" checked>
                            <label class="form-label mb-0" for="fullwidthNav">Fullwidth</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="collapseNav" name="checkVerticalNav" value="collapse">
                            <label class="form-label mb-0" for="collapseNav">Collapse</label>
                        </div>
                    </div>
                </div>


                <div class="bg-light-200 p-4 flex-grow-1">
                    <h6 class="mb-3 lh-16">Header Position</h6>
                    <div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="scrollableHeader" name="headerPosition" value="scrollable" checked>
                            <label class="form-label mb-0" for="scrollableHeader">Scrollable</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="fixedHeader" name="headerPosition" value="fixed">
                            <label class="form-label mb-0" for="fixedHeader">Fixed</label>
                        </div>
                    </div>
                </div>

                <div class="bg-light-500 p-4 flex-grow-1">
                    <h6 class="mb-3 lh-16">Topbar Style</h6>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-check form-check-inline with-layout-image m-0">
                                <label class="form-label mb-0">
                                <a href="index.html" target="_blank" rel="noopener noreferrer" class="fs-14 fw-semibold text-dark">
                                        <span class="d-inline-block mb-2">
                                            <img class="light-version img-fluid rounded-1" src="{{ asset('/') }}frontend/assets/img/customizer/vertical-light.png" alt="img">
                                            <img class="dark-version img-fluid rounded-1" src="{{ asset('/') }}frontend/assets/img/customizer/vertical-dark.png" alt="img">
                                        </span>
                                        <span class="label-text">Style One</span>
                                    </a>
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check form-check-inline with-layout-image m-0">
                                <label class="form-label mb-0">
                                <a href="index-horizontal.html" target="_blank" rel="noopener noreferrer" class="fs-14 fw-semibold text-dark">
                                        <span class="d-inline-block mb-2">
                                            <img class="light-version img-fluid rounded-1" src="{{ asset('/') }}frontend/assets/img/customizer/horizontal-light.png" alt="img">
                                            <img class="dark-version img-fluid rounded-1" src="{{ asset('/') }}frontend/assets/img/customizer/horizontal-dark.png" alt="img">
                                        </span>
                                        <span class="label-text">Style Two</span>
                                    </a>
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check form-check-inline with-layout-image m-0">
                                <label class="form-label mb-0">
                                <a href="index-combo.html" target="_blank" rel="noopener noreferrer" class="fs-14 fw-semibold text-dark">
                                        <span class="d-inline-block mb-2">
                                            <img class="light-version img-fluid rounded-1" src="{{ asset('/') }}frontend/assets/img/customizer/combo-light.png" alt="img">
                                            <img class="dark-version img-fluid rounded-1" src="{{ asset('/') }}frontend/assets/img/customizer/combo-dark.png" alt="img">
                                        </span>
                                        <span class="label-text">Style Three</span>
                                    </a>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
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
