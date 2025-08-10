<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('backend/plugins/notifications/css/lobibox.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- loader-->
    <link href="{{ asset('backend/css/pace.min.css') }}" rel="stylesheet" />

    <!--Theme Styles-->
    <link href="{{ asset('backend/css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/light-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/semi-dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/header-colors.css') }}" rel="stylesheet" />

    <script src="{{ asset('backend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('backend/js/jquery.min.js')}}"></script>

    <title>Assistant4U {{ isset($title) ? "- $title" : "" }}</title>
    <style>
        main.page-content {
            min-height: calc(100vh - 60px);
        }

        .select2-container .select2-selection--single {
            background: transparent;
            height: 38px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px;
        }
        .togglePasswordBtn {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            outline: none;
            padding: 0;
            z-index: 2;
        }
        .togglePasswordBtn:focus, .togglePasswordBtn:active {
            outline: none;
            box-shadow: none;
        }
        .togglePassword {
            font-size: 1.2rem;
            color: #6c757d;
            cursor: pointer;
        }
        .togglePassword:hover {
            color: #6c757d;
        }
        .togglePassword:focus {
            color: #6c757d;
        }
    </style>
    @yield('styles')
</head>

<body>
    <div class="wrapper">
        <header class="top-header">
            <nav class="navbar navbar-expand gap-3">
                <div class="mobile-toggle-icon fs-3 d-flex d-lg-none">
                    <i class="bi bi-list"></i>
                </div>
                <div class="top-navbar-right ms-auto">
                    <ul class="navbar-nav align-items-center gap-1">
                        <li class="nav-item dark-mode d-none d-sm-flex">
                            <a class="nav-link dark-mode-icon" href="javascript:;">
                                <div class="">
                                    <i class="bi bi-moon-fill"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="dropdown dropdown-user-setting">
                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                        <div class="user-setting d-flex align-items-center gap-3">
                            <img src="{{ asset('backend/images/avatars/avatar-1.png') }}" class="user-img" alt="">
                            <div class="d-none d-sm-block">
                                <p class="user-name mb-0">{{ auth()->user()->name }}</p>
                                <small class="mb-0 dropdown-user-designation">{{ show_role_name() }}</small>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('account') }}">
                                <div class="d-flex align-items-center">
                                    <div class=""><i class="bi bi-person-fill"></i></div>
                                    <div class="ms-3"><span>Account</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('signout') }}">
                                <div class="d-flex align-items-center">
                                    <div class=""><i class="bi bi-box-arrow-left"></i></div>
                                    <div class="ms-3"><span>Logout</span></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        @if(auth()->user()->role === 'admin')
            @include('layouts.sidebar_admin')
        @elseif(auth()->user()->role === 'staff')
            @include('layouts.sidebar_staff')
        @elseif(auth()->user()->role === 'user')
            @include('layouts.sidebar_user')
        @endif

        <main class="page-content">
            @yield('content')
        </main>
        <div class="overlay nav-toggle-icon"></div>

        <!--start footer-->
        <footer class="footer">
            <div class="footer-text">
                Copyright © {{ date('Y') }}. All right reserved.
            </div>
        </footer>
        <!--end footer-->


        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

    </div>
    <!--end wrapper-->


    <!-- Bootstrap bundle JS -->
    <!--plugins-->
    <script>
        const savedTheme = localStorage.getItem("theme");
        if (savedTheme === "dark") {
            $("html").attr("class", "dark-theme");
            $(".dark-mode-icon i").attr("class", "bi bi-brightness-high-fill");
        } else {
            $("html").attr("class", "");
            $(".dark-mode-icon i").attr("class", "bi bi-moon-fill");
        }
    </script>
    <script src="{{ asset('backend/plugins/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{ asset('backend/plugins/metismenu/js/metisMenu.min.js')}}"></script>
    <script src="{{ asset('backend/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    <script src="{{ asset('backend/js/pace.min.js')}}"></script>
    <script src="{{ asset('backend/plugins/form/js/jquery.form.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('backend/js/form-select2.js') }}"></script>
    <script src="{{ asset('backend/plugins/sweetalert2/js/sweetalert2@11.js') }}"></script>

    <!--notification js -->
    <script src="{{ asset('backend/plugins/notifications/js/lobibox.min.js')}}"></script>
    <script src="{{ asset('backend/plugins/notifications/js/notifications.min.js')}}"></script>
    <script src="{{ asset('backend/plugins/notifications/js/notification-custom-script.js')}}"></script>

    <!--app-->
    <script src="{{ asset('backend/js/app.js')}}"></script>
    
    <script>
        $('.togglePassword').on('click', function () {
            var $btn = $(this);
            var $input = $btn.closest('.form-group').find('input[type="password"], input[type="text"]');
            var type = $input.attr('type') === 'password' ? 'text' : 'password';
            $input.attr('type', type);
            $btn.toggleClass('bi-eye-fill bi-eye-slash-fill');
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.field-phone').on('input', function (e) {
                e.preventDefault;
                this.value = this.value.replace(/\D/g, '');
                if (this.value.length > this.maxLength) {
                    this.value = this.value.slice(0, this.maxLength);
                }
            });
            $('.number-only').on('input', function (e) {
                e.preventDefault;
                this.value = this.value.replace(/\D/g, '');
            });
        });
    </script>

    @yield('scripts')

    @if (session('success'))
        <script>
            $(document).ready(function () {
                Lobibox.notify('success', {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    rounded: true,
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    icon: 'bx bx-check-circle',
                    msg: "{{ session('success') }}"
                });
            });
        </script>
    @endif
    @if (session('failure'))
        <script>
            $(document).ready(function () {
                Lobibox.notify('error', {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    rounded: true,
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    icon: 'bx bx-x-circle',
                    msg: "{{ session('failure') }}"
                });
            });
        </script>
    @endif

</body>

</html>