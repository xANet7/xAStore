<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="dark" data-toggled="close">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    <link href="{{ asset('favicon.ico') }}" rel="icon" type="image/x-icon">
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <link href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" id="style" rel="stylesheet">
    <link href="{{ asset('assets/css/styles.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/node-waves/waves.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/toastr/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div class="page">

        <x-navigation-link />

        <div class="main-content app-content">
            <div class="container">
                {{ $slot }}
            </div>
        </div>

        @include('components.includes.footer')
    </div>
    <div class="scrollToTop">
        <span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
    </div>
    <div id="responsive-overlay"></div>

    <script src="{{ asset('assets/libs/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/defaultmenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/js/sticky.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.js') }}"></script>
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}" data-navigate-track></script>
    @stack('scripts')
    <script>
        $(document).ready(function() {
            const select2 = $('.select2');
            const select2_search = $('.select2-search');

            if (select2.length) {
                select2.each(function () {
                var $this = $(this);
                    $this.wrap('<div class="position-relative"></div>').select2({
                        placeholder: 'Select option',
                        dropdownParent: $this.parent(),
                        minimumResultsForSearch: Infinity
                    });
                });
            }

            if (select2_search.length) {
                select2_search.each(function () {
                var $this = $(this);
                    $this.wrap('<div class="position-relative"></div>').select2({
                        placeholder: 'Select option',
                        dropdownParent: $this.parent()
                    });
                });
            }

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

            Livewire.on('resetFilePond', () => {
                window.fileUpload.removeFiles();
            });

            Livewire.on('alert', ({ 0: { title, message, type } }) => {
                toastr[type](message, title);
            });

            Livewire.on('sweetalert', function (response) {
                const data = response[0];
                Swal.fire({
                    title: data.title,
                    text: data.text,
                    icon: data.type,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    confirmButtonText: "Ya, Lakukan!",
                    cancelButtonText: "Batal",
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch(data.dispatch)
                    }
                });
            });
        });
    </script>
</body>
</html>
