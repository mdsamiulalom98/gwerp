<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $setting->name)</title>

    <link rel="icon" href="{{ asset($setting->favicon) }}" type="image/x-icon" />

    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/') }}/fonts/feather.css">
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/') }}/fonts/fontawesome.css">
    <!-- <link rel="stylesheet" href="fonts/tabler-icons.min.css"> -->
    <!-- Tabler Icons Webfont CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <!-- Tabler Icons -->
    @stack('css')
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/') }}/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/') }}/css/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/') }}/css/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/') }}/css/responsive.css">
    <link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
</head>

<body>

    <div class="announcement">
        <a href="">
            <p>Our website is under construction.</p>
        </a>
    </div>

    <nav class="wsit-sidebar">
        <div class="navbar-wrapper">
            <div class="main-logo">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset($setting->white_logo) }}" alt="">
                </a>
            </div>
            <div class="sidebar-search">

            </div>
            <div class="navbar-content">

                <ul class="wsit-navbar">
                    <li class="wsit-item">
                        <a href="{{ route('dashboard') }}" class="wsit-link">
                            <span class="wsit-icon"><i class="ti ti-home"></i> </span>
                            <span class="wsit-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="wsit-item">
                        <a href="" class="wsit-link">
                            <span class="wsit-icon"><i class="ti ti-user-square-rounded"></i> </span>
                            <span class="wsit-text">User Manage</span>
                            <span class="wsit-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="wsit-submenu">
                            <li class="wsit-item">
                                <a href="{{ route('users.index') }}" class="wsit-link">
                                    <span class="wsit-text"><i class="ti ti-circle-dot"></i>User</span>
                                </a>
                                <a href="{{ route('roles.index') }}" class="wsit-link">
                                    <span class="wsit-text"><i class="ti ti-circle-dot"></i>Role</span>
                                </a>
                                <a href="{{ route('permissions.index') }}" class="wsit-link">
                                    <span class="wsit-text"><i class="ti ti-circle-dot"></i>Permission</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="wsit-item">
                        <a href="" class="wsit-link">
                            <span class="wsit-icon"><i class="ti ti-calendar-user"></i> </span>
                            <span class="wsit-text">HRM</span>
                            <span class="wsit-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="wsit-submenu">
                            <li class="wsit-item">
                                <a href="{{ route('employees.index') }}" class="wsit-link">
                                    <span class="wsit-text"><i class="ti ti-circle-dot"></i>Employee</span>
                                </a>
                            </li>
                            <li class="wsit-item">
                                <a href="{{ route('leaves.index') }}" class="wsit-link">
                                    <span class="wsit-text"><i class="ti ti-circle-dot"></i>Manage Leave</span>
                                </a>
                            </li>
                            <li class="wsit-item">
                                <a href="{{route('awards.index')}}" class="wsit-link">
                                    <span class="wsit-text"><i class="ti ti-circle-dot"></i>HRM Admin</span>
                                    <span class="wsit-arrow">
                                        <i data-feather="chevron-right"></i>
                                    </span>
                                </a>
                                <ul class="wsit-submenu child">
                                    <li class="wsit-item">
                                        <a href="{{route('awards.index')}}" class="wsit-link">
                                            <span class="wsit-text"><i class="ti ti-circle-dot"></i> Award</span>
                                        </a>
                                    </li>
                                    <li class="wsit-item">
                                        <a href="{{route('transfers.index')}}" class="wsit-link">
                                            <span class="wsit-text"><i class="ti ti-circle-dot"></i> Transfer</span>
                                        </a>
                                    </li>
                                    <li class="wsit-item">
                                        <a href="{{route('resignations.index')}}" class="wsit-link">
                                            <span class="wsit-text"><i class="ti ti-circle-dot"></i> Resignation</span>
                                        </a>
                                    </li>
                                    <li class="wsit-item">
                                        <a href="{{route('trips.index')}}" class="wsit-link">
                                            <span class="wsit-text"><i class="ti ti-circle-dot"></i> Trip</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="wsit-item">
                                <a href="{{ route('events.index') }}" class="wsit-link">
                                    <span class="wsit-text"><i class="ti ti-circle-dot"></i>Event</span>
                                </a>
                            </li>
                            <li class="wsit-item">
                                <a href="{{ route('documents.index') }}" class="wsit-link">
                                    <span class="wsit-text"><i class="ti ti-circle-dot"></i>Document</span>
                                </a>
                            </li>
                            <li class="wsit-item">
                                <a href="{{ route('companypolicies.index') }}" class="wsit-link">
                                    <span class="wsit-text"><i class="ti ti-circle-dot"></i>Company Policy</span>
                                </a>
                            </li>
                            <li class="wsit-item">
                                <a href="{{ route('companies.index') }}" class="wsit-link">
                                    <span class="wsit-text"><i class="ti ti-circle-dot"></i>System Setup</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="wsit-item">
                        <a href="" class="wsit-link">
                            <span class="wsit-icon"><i class="ti ti-settings"></i> </span>
                            <span class="wsit-text">Setting</span>
                            <span class="wsit-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="wsit-submenu">
                            <li class="wsit-item">
                                <a href="{{ route('settings.edit') }}" class="wsit-link">
                                    <span class="wsit-text"><i class="ti ti-circle-dot"></i>General Setting</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <header class="wsit-header">
        <div class="header-wrapper">
            <div class="me-auto wsit-mob-drp">
                <ul class="list-unstyled">
                    <li class="wsit-h-item mob-hamburger">
                        <a href="#!" class="wsit-head-link" id="mobile-collapse">
                            <div class="hamburger hamburger--arrowturn">
                                <div class="hamburger-box">
                                    <div class="hamburger-inner"></div>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li class="dropdown wsit-h-item drp-company">
                        <a class="wsit-head-link dropdown-toggle arrow-none m-0" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="theme-avtar">
                                <img alt="#" src="{{ asset(auth()->user()->image) }}"
                                    class="rounded border-2 border border-primary"
                                    style="width: 100%; height: 100%;" />
                            </span>
                            <span class="hide-mob ms-2">{{ auth()->user()->name }}</span>
                            <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                        </a>
                        <div class="dropdown-menu wsit-h-dropdown" style="">
                            <a href="{{ route('admin.profile') }}" class="dropdown-item">
                                <i class="ti ti-user"></i>
                                <span>Profile</span>
                            </a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
                                class="dropdown-item">
                                <i class="ti ti-power"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>

                </ul>
            </div>

            <div class="ms-auto">
                <ul class="list-unstyled">
                    <li class="wsit-h-item">
                        <a class="wsit-head-link me-0" href="">
                            <i class="ti ti-apps"></i>
                            <span class="animate-charcter d-lg-block d-none">Dashboard</span>
                        </a>
                    </li>
                    <li class="wsit-h-item">
                        <a class="wsit-head-link me-0" href="">
                            <i class="ti ti-message-circle"></i>
                            <span class="bg-danger wsit-h-badge message-counter custom_messanger_counter">0<span
                                    class="sr-only"></span> </span>
                        </a>
                    </li>
                    <li class="wsit-h-item">
                        <a href="#!" class="wsit-head-link dropdown-toggle arrow-none me-0 cust-btn"
                            data-url="" data-ajax-popup="true" data-title="Create New Workspace">
                            <i class="ti ti-circle-plus"></i>
                            <span class="hide-mob">Create Workspace</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </header>
    @yield('content')

    <footer class="mt-5 wsit-footer">
        <div class="footer-wrapper">
            <div class="py-1">
                <span class="text-muted">
                    © Copyright 2025 All Right Reserved. Developed by <a href="https://websolutionit.com/"
                        target="_blank" class="develop_company">Websolution IT</a>
                </span>
            </div>
        </div>
    </footer>


    <script src="{{ asset('public/backEnd/assets/') }}/js/jquery.min.js"></script>
    <script src="{{ asset('public/backEnd/assets/') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('public/backEnd/assets/') }}/js/plugins/fontawesome.js"></script>
    <script src="{{ asset('public/backEnd/assets/') }}/js/plugins/feather.min.js"></script>
    <script src="{{ asset('public/backEnd/assets/') }}/js/jquery.scroll-spy.min.js"></script>
    <script src="{{ asset('public/backEnd/assets/') }}/js/select2.min.js"></script>
    <script src="{{ asset('public/backEnd/assets/') }}/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script src="{{ asset('public/backEnd/assets/js/parsley.min.js') }}"></script>
    <script src="{{ asset('public/backEnd/assets/js/particles-active.js') }}"></script>
    <script src="{{ asset('public/backEnd/assets/js/flatpickr.js') }}"></script>
    <script>
        $(document).on('click', '.delete_btn', function(event) {
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Delete Warning!',
                text: "Are you sure you want to delete this record?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
        $(document).on('click', '.thumb_up', function(event) {
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Active Warning!',
                text: "Are you sure you want to active this record?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, active it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
        $(document).on('click', '.thumb_down', function(event) {
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Inactive Warning!',
                text: "Are you sure you want to inactive this record?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, inactive it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $('form').parsley();
        });
    </script>
    @stack('script')
    <script src="{{ asset('public/backEnd/assets/') }}/js/script.js"></script>

    <script>
        feather.replace();
    </script>
    <script>
        $(document).ready(function() {
            $(".wsit-navbar").on("click", "a", function(e) {
                var $clickedItem = $(this).parent(".wsit-item");
                var $submenu = $clickedItem.children(".wsit-submenu");
                var $arrow = $(this).find(".wsit-arrow svg");

                if ($arrow.length > 0) {
                    e.preventDefault();

                    $clickedItem.siblings().children(".wsit-submenu").slideUp();
                    $clickedItem.siblings().find(".wsit-arrow svg").removeClass("rotated");

                    $clickedItem.find(".wsit-submenu").not($submenu).slideUp();
                    $clickedItem.find(".wsit-arrow svg").not($arrow).removeClass("rotated");


                    $submenu.slideToggle();
                    $arrow.toggleClass("rotated");
                } else {
                    window.location.href = $(this).attr("href");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // dropdown menu
            $('.dropdown').click(function() {
                $('.dropdown-menu').toggle();
            });

            //  mobile menu
            $('.mob-hamburger').click(function() {
                $('.wsit-sidebar').addClass('wsit-sidebar-active');


                if ($('.wsit-menu-overlay').length === 0) {
                    $('.wsit-sidebar').append('<div class="wsit-menu-overlay"></div>');
                }
            });
            $(document).on('click', '.wsit-menu-overlay', function() {
                $('.wsit-sidebar').removeClass('wsit-sidebar-active');
                $(this).remove();
            });

            // select2
            $('.select2').select2();

            // scrollspy
            $('.page-content').scrollSpy({
                target: $('.scroll_menu a')
            }).scroll();

            $(".flatpickr").flatpickr();

        });
    </script>
</body>

</html>
