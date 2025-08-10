<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('backend/plugins/notifications/css/lobibox.min.css')}}" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="{{ asset('backend/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

    <!-- loader-->
    <link href="{{ asset('backend/css/pace.min.css') }}" rel="stylesheet" />
    <title>Assistant4U {{ isset($title) ? "- $title" : ""  }}</title>
    <style>
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

    @yield('content')

    <script src="{{ asset('backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/js/pace.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('backend/js/form-select2.js') }}"></script>
    
    <!--notification js -->
    <script src="{{ asset('backend/plugins/notifications/js/lobibox.min.js')}}"></script>
    <script src="{{ asset('backend/plugins/notifications/js/notifications.min.js')}}"></script>
    <script src="{{ asset('backend/plugins/notifications/js/notification-custom-script.js')}}"></script>
    
    <script>
        const savedTheme = localStorage.getItem("theme");
        if (savedTheme === "dark") {
            $("html").attr("class", "dark-theme");
            $(".dark-mode-icon i").attr("class", "bi bi-brightness-high-fill");
        } else {
            $("html").attr("class", "");
            $(".dark-mode-icon i").attr("class", "bi bi-moon-fill");
        }

        $(document).ready(function () {
            $('.field-phone').on('input', function(e) {
                e.preventDefault;
                this.value = this.value.replace(/\D/g, '');
                if (this.value.length > this.maxLength) {
                    this.value = this.value.slice(0, this.maxLength);
                }
            });
            $('.number-only').on('input', function(e) {
                e.preventDefault;
                this.value = this.value.replace(/\D/g, '');
            });
        });
    </script>
    
    <script>
        $('.togglePassword').on('click', function () {
            var $btn = $(this);
            var $input = $btn.closest('.form-group').find('input[type="password"], input[type="text"]');
            var type = $input.attr('type') === 'password' ? 'text' : 'password';
            $input.attr('type', type);
            $btn.toggleClass('bi-eye-fill bi-eye-slash-fill');
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
                    msg: "{{ session('success') }}",
                    delay: false // disables auto close
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