        <!-- Vertical Nav -->
        <div class="kleon-vertical-nav">
            <!-- Logo  -->
            <div class="logo d-flex align-items-center justify-content-between">
                <a href="index.html" class="d-flex align-items-center gap-3 flex-shrink-0">
                    <img src="{{ asset('/') }}frontend/assets/img/logo-icon.svg" alt="logo">
                    <div class="position-relative flex-shrink-0">
                        <img src="{{ asset('/') }}frontend/assets/img/logo-text.svg" alt="" class="logo-text">
                        <img src="{{ asset('/') }}frontend/assets/img/logo-text-white.svg" alt="" class="logo-text-white">
                    </div>
                </a>
                <button type="button" class="kleon-vertical-nav-toggle"><i class="bi bi-list"></i></button>
            </div>

            <div class="kleon-navmenu">
                <h6 class="hidden-header text-gray text-uppercase ls-1 ms-4 mb-4">Main Menu</h6>
                <ul class="main-menu">

                    <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2"><span>Home</span></li>
                    <li class="menu-item"><a href="{{ route('admin.dashboard') }}"> <span class="nav-icon flex-shrink-0"><i class="bi bi-speedometer fs-18"></i></span> <span class="nav-text">Dashboard</span></a></li>
                    <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-people fs-18"></i></span> <span class="nav-text">Mess Owner</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="{{ route('admin.mess_owner.add') }}"> Add New</a></li>
                            <li class="menu-item"><a href="{{ route('admin.mess_owner.list') }}"> List</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2"><span>Sass</span></li>
                    <!-- HR Management -->
                    <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-people fs-18"></i></span> <span class="nav-text">HR Management</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="employees.html"> Employees <span class="menuIndicator bg-soft-secondary rounded-3 py-0 px-3">New</span></a></li>
                            <li class="menu-item"><a href="recruitment.html"> Recruitment</a></li>
                            <li class="menu-item"><a href="jobs.html"> Jobs <span class="menuIndicator bg-info rounded-circle text-white">17</span></a></li>
                            <li class="menu-item menu-item-has-children"><a href="#"> Candidates</a>
                                <ul class="sub-menu">
                                    <li class="menu-item"><a href="candidates.html"> Candidate List</a></li>
                                    <li class="menu-item"><a href="candidate.html"> Candidate</a></li>
                                </ul>
                                <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                            </li>
                            <li class="menu-item"><a href="attendances.html"> Attendances</a></li>
                            <li class="menu-item"><a href="leaves.html"> Leaves</a></li>
                            <li class="menu-item"><a href="documents.html"> Documents</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>

                    <!-- Job Hiring -->
                    <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-briefcase fs-18"></i></span> <span class="nav-text">Job Hiring</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="jobs-hiring.html"> Jobs <span class="menuIndicator bg-info rounded-circle text-white">17</span></a></li>
                            <li class="menu-item menu-item-has-children"><a href="#"> Candidates</a>
                                <ul class="sub-menu">
                                    <li class="menu-item"><a href="candidates-grid-hiring.html"> Candidate Grid</a></li>
                                    <li class="menu-item"><a href="candidates-list-hiring.html"> Candidate List</a></li>
                                    <li class="menu-item"><a href="candidates-qualified-hiring.html"> Qualified Candidates</a></li>
                                    <li class="menu-item"><a href="candidate-hiring.html"> Candidate Profile</a></li>
                                </ul>
                                <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                            </li>
                            <li class="menu-item"><a href="statistics-hiring.html"> Statistics</a></li>
                            <li class="menu-item"><a href="company-hiring.html"> Company Profile</a></li>
                            <li class="menu-item"><a href="documents-hiring.html"> Documents</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>

                    <!-- Project Management -->
                    <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-kanban fs-18"></i></span> <span class="nav-text">Project Management</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="contacts.html"> Contacts</a></li>
                            <li class="menu-item menu-item-has-children"><a href="#"> Projects</a>
                                <ul class="sub-menu">
                                    <li class="menu-item"><a href="projects.html"> All Projects</a></li>
                                    <li class="menu-item"><a href="project-details.html"> Project Detail</a></li>
                                </ul>
                                <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                            </li>
                            <li class="menu-item"><a href="files.html"> Files</a></li>
                            <li class="menu-item"><a href="profile.html"> Profile</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>

                    <!-- General Dashboard -->
                    <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-speedometer2 fs-18"></i></span> <span class="nav-text">General</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item menu-item-has-children"><a href="#"> Contacts</a>
                                <ul class="sub-menu">
                                    <li class="menu-item"><a href="contacts-2.html"> Contact List</a></li>
                                    <li class="menu-item"><a href="contact-new.html"> Add Contact</a></li>
                                </ul>
                                <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                            </li>

                            <li class="menu-item"><a href="profile-2.html"> Profile</a></li>
                            <li class="menu-item"><a href="preferences.html"> Preferences</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>

                    <!-- Apps -->
                    <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2"><span>Apps</span></li>
                    <li class="menu-item"><a href="calendar.html"><span class="nav-icon flex-shrink-0"><i class="bi bi-calendar-day fs-18"></i></span> <span class="nav-text">Calendar</span></a></li>

                    <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-envelope fs-18"></i></span> <span class="nav-text">Email</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="email.html">Inbox</a></li>
                            <li class="menu-item"><a href="email-compose.html">Email Compose</a></li>
                            <li class="menu-item"><a href="email-details.html">Email Preview</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-chat fs-18"></i></span> <span class="nav-text">Chat</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="inbox.html">Inbox</a></li>
                            <li class="menu-item"><a href="chat.html">Chat Preview</a></li>
                            <li class="menu-item"><a href="chat-2.html">Chat 2 Preview</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-receipt fs-18"></i></span> <span class="nav-text">Invoices</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="invoices.html">Invoice List</a></li>
                            <li class="menu-item"><a href="invoice.html">Invoice Details</a></li>
                            <li class="menu-item"><a href="invoice-new.html">Create Invoice</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-kanban fs-18"></i></span> <span class="nav-text">Task</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="task.html">Task List</a></li>
                            <li class="menu-item"><a href="task-2.html">Task 2</a></li>
                            <li class="menu-item"><a href="task-jkanban.html">Kanban</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>

                    <!-- Content -->
                    <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2"><span>Content</span></li>
                    <li class="menu-item"><a href="typography.html"><span class="nav-icon flex-shrink-0"><i class="bi bi-fonts fs-18"></i></span> <span class="nav-text">Typography</span></a></li>
                    <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-table fs-18"></i></span> <span class="nav-text">Tables</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-text">Bootstrap Table</span></a>
                                <ul class="sub-menu">
                                    <li class="menu-item"><a href="tables-bootstrap-basic.html">Basic Table</a></li>
                                    <li class="menu-item"><a href="tables-bootstrap.html">Customized Table</a></li>
                                </ul>
                                <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                            </li>
                            <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-text">Flex Table</span></a>
                                <ul class="sub-menu">
                                    <li class="menu-item"><a href="tables-flex-basic.html">Basic Flex Table</a></li>
                                    <li class="menu-item"><a href="tables-flex-customized.html">Customized Flex Table</a></li>
                                </ul>
                                <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                            </li>
                            <li class="menu-item"><a href="tables-datatables.html">Data Tables</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-gift fs-18"></i></span> <span class="nav-text">Widgets</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="widget-apps.html">Widget Apps</a></li>
                            <li class="menu-item"><a href="widget-charts.html">Widget Charts</a></li>
                            <li class="menu-item"><a href="widget-cards.html">Widget Cards</a></li>
                            <li class="menu-item"><a href="widget-listing.html">Widget Listing</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>


                    <!-- Forms -->
                    <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2"><span>Forms</span></li>
                    <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-textarea-t fs-18"></i></span> <span class="nav-text">Form Elements</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="form-basic.html">Basic Forms</a></li>
                            <li class="menu-item"><a href="form-inputs.html">Forms Inputs</a></li>
                            <li class="menu-item"><a href="form-input-groups.html">Forms Inputs Group</a></li>
                            <li class="menu-item"><a href="form-horizontal.html">Forms Horizontal</a></li>
                            <li class="menu-item"><a href="form-vertical.html">Forms Vertical</a></li>
                            <li class="menu-item"><a href="form-wizard.html">Forms Wizard</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-check-square fs-18"></i></span> <span class="nav-text">Form Validation</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="form-validation-bootstrap.html">Bootstrap Validation</a></li>
                            <li class="menu-item"><a href="form-validation-custom.html">Custom Validation</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>


                    <!-- UI Components -->
                    <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2"><span>UI Components</span></li>
                    <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-bricks fs-18"></i></span> <span class="nav-text">UI Elements</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="accordion.html">Accordion</a></li>
                            <li class="menu-item"><a href="alerts.html">Alerts</a></li>
                            <li class="menu-item"><a href="avatar.html">Avatar</a></li>
                            <li class="menu-item"><a href="badge.html">Badge</a></li>
                            <li class="menu-item"><a href="breadcrumb.html">Breadcrumb</a></li>
                            <li class="menu-item"><a href="collapse.html">Collapse</a></li>
                            <li class="menu-item"><a href="dropdowns.html">Dropdowns</a></li>
                            <li class="menu-item"><a href="list-group.html">List Group</a></li>
                            <li class="menu-item"><a href="modals.html">Modal</a></li>
                            <li class="menu-item"><a href="offcanvas.html">Offcanvas</a></li>
                            <li class="menu-item"><a href="tabs.html">Tabs</a></li>
                            <li class="menu-item"><a href="pagination.html">Pagination</a></li>
                            <li class="menu-item"><a href="placeholders.html">Placeholders</a></li>
                            <li class="menu-item"><a href="popovers.html">Popovers</a></li>
                            <li class="menu-item"><a href="progressbar.html">Progressbar</a></li>
                            <li class="menu-item"><a href="spinners.html">Spinners</a></li>
                            <li class="menu-item"><a href="toasts.html">Toasts</a></li>
                            <li class="menu-item"><a href="tooltips.html">Tooltips</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-card-image fs-18"></i></span> <span class="nav-text">Cards</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="cards-basic.html">Bootstrap Basic</a></li>
                            <li class="menu-item"><a href="cards.html">Customized Cards</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-send fs-18"></i></span> <span class="nav-text">Buttons</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="buttons.html">Default Buttons</a></li>
                            <li class="menu-item"><a href="video-buttons.html">Video Buttons</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-plugin fs-18"></i></span> <span class="nav-text">Plugins</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="form-dropzone.html">Dropzone</a></li>
                            <li class="menu-item"><a href="form-repeater.html">Repeater</a></li>
                            <li class="menu-item"><a href="form-select2.html">Select 2</a></li>
                            <li class="menu-item"><a href="sweetalert.html">Sweet Alert</a></li>
                            <li class="menu-item"><a href="toastr.html">Toastr</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>

                    <!-- Authentication -->
                    <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2"><span>Authentication</span></li>
                    <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-info-circle fs-18"></i></span> <span class="nav-text">Error</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="403.html">403 Error</a></li>
                            <li class="menu-item"><a href="404.html">404 Error</a></li>
                            <li class="menu-item"><a href="500.html">500 Error</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-box-arrow-in-right fs-18"></i></span> <span class="nav-text">Login</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="login.html">Boxed Login</a></li>
                            <li class="menu-item"><a href="login-2.html">Side Login</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-person-plus fs-18"></i></span> <span class="nav-text">Registration</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="register.html">Boxed Registration</a></li>
                            <li class="menu-item"><a href="register-2.html">Side Registration</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-key fs-18"></i></span> <span class="nav-text">Password</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item menu-item-has-children"><a href="#">Reset Passward</a>
                                <ul class="sub-menu">
                                    <li class="menu-item"><a href="reset-password.html">Boxed Reset Passward</a></li>
                                    <li class="menu-item"><a href="reset-password-2.html">Side Reset Passward</a></li>
                                </ul>
                                <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                            </li>
                            <li class="menu-item menu-item-has-children"><a href="#">Forgot Passward</a>
                                <ul class="sub-menu">
                                    <li class="menu-item"><a href="forgot-password.html">Boxed Forgot Passward</a></li>
                                    <li class="menu-item"><a href="forgot-password-2.html">Side Forgot Passward</a></li>
                                </ul>
                                <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                            </li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>
                    <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-qr-code-scan fs-18"></i></span> <span class="nav-text">Two Step Varification</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="two-step-varification.html">Boxed Varification</a></li>
                            <li class="menu-item"><a href="two-step-varification-2.html">Side Varification</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>

                    <!-- Charts -->
                    <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2"><span>Charts</span></li>
                    <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-pie-chart fs-18"></i></span> <span class="nav-text">Apex Chart</span></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="apexchart-line.html">Line Chart</a></li>
                            <li class="menu-item"><a href="apexchart-bar.html">Bar Chart</a></li>
                            <li class="menu-item"><a href="apexchart-column.html">Column Chart</a></li>
                            <li class="menu-item"><a href="apexchart-area.html">Area Chart</a></li>
                            <li class="menu-item"><a href="apexchart-pie.html">Pie Chart</a></li>
                            <li class="menu-item"><a href="apexchart-radial.html">Radial Chart</a></li>
                        </ul>
                        <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                    </li>


                </ul>
            </div>

            <div class="card border-0 text-white mr-top-70 boost-card">
                <div class="card-body">
                    <div class="icon fs-20 mb-2"><i class="bi bi-speedometer2"></i></div>
                    <h5 class="fs-18 text-white">Boost your work</h5>
                    <p class="fs-14 mb-4">Upgrade to premium here</p>
                    <a href="#" class="btn ff-heading fw-bold fs-16 bg-white text-primary rounded-3 border-0">Upgrade Now <i class="bi bi-caret-right-fill"></i></a>
                </div>
            </div>

            <div class="card border-0 rounded-0 mt-6">
                <div class="card-body p-0">
                    <h6 class="text-gray lh-20 mb-0">Kleon Admin Dashboard</h6>
                    <h6 class="text-gray fs-14 fw-medium">Made with <i class="bi bi-heart-fill text-red"></i> by <a href="#">WPThemeBooster</a></h6>
                </div>
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
