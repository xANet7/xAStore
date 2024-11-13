<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} — Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('favicon.ico') }}" rel="icon" type="image/x-icon">
    <link href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" id="style" rel="stylesheet" >
    <link href="{{ asset('assets/css/styles.min.css') }}" rel="stylesheet" >
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" >
    <link href="{{ asset('assets/libs/toastr/toastr.min.css') }}" rel="stylesheet">
    <style>
        .auth-login {
            width: 100%;
            background-image: url('assets/images/apps/login-bg.svg');
            background-position: center;
            background-color: #fff;
        }
    </style>
    @livewireStyles
</head>
<body>
    <div class="auth-login">
        <div class="container">
            <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
                    <div class="card custom-card" style="box-shadow: 0 7px 14px 0 rgb(60 66 87 / 12%), 0 3px 6px 0 rgb(0 0 0 / 12%);">
                        <div class="card-body p-4 m-2">
                            <a href="{{ route('index') }}" class="text-nowrap logo-img text-center d-block mb-3 w-100">
                                <h2 class="m-0 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="#845bdf" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-blackberry">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 6a1 1 0 0 0 -1 -1h-2l-.5 2h2.5a1 1 0 0 0 1 -1z" />
                                        <path d="M6 12a1 1 0 0 0 -1 -1h-2l-.5 2h2.5a1 1 0 0 0 1 -1z" />
                                        <path d="M13 12a1 1 0 0 0 -1 -1h-2l-.5 2h2.5a1 1 0 0 0 1 -1z" />
                                        <path d="M14 6a1 1 0 0 0 -1 -1h-2l-.5 2h2.5a1 1 0 0 0 1 -1z" />
                                        <path d="M12 18a1 1 0 0 0 -1 -1h-2l-.5 2h2.5a1 1 0 0 0 1 -1z" />
                                        <path d="M20 15a1 1 0 0 0 -1 -1h-2l-.5 2h2.5a1 1 0 0 0 1 -1z" />
                                        <path d="M21 9a1 1 0 0 0 -1 -1h-2l-.5 2h2.5a1 1 0 0 0 1 -1z" />
                                    </svg>
                                    <strong><span class="text-primary">xA</span>Store</strong>
                                </h2>
                            </a>
                            <p class="h5 fw-semibold mb-2">@yield('title')</p>
                            <p class="mb-4 text-muted op-7 fw-normal">@yield('text')</p>
                            @yield('form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/libs/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
    @livewireScripts
    <script>
        toastr.options = {
            closeButton: false,
            debug: false,
            newestOnTop: true,
            progressBar: true,
            positionClass: "toast-top-right",
            preventDuplicates: false,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            timeOut: "3000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            closeEasing: "linear",
            showMethod: "slideDown",
            hideMethod: "slideUp",
            closeMethod: "slideUp",
        };
        Livewire.on('alert', ({ 0: { title, message, type, reload } }) => {
            toastr[type](message, title);
            if (reload) setTimeout(() => { location.reload(); }, 3000);
        });
    </script>
</body>
</html>
