<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FUAMI') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo-clear.png') }}">
    <meta name="theme-color" content="#120d4f">
    <script src="https://kit.fontawesome.com/5b408a851a.js" crossorigin="anonymous"></script>
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('assets_users/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_users/css/vendors/ion.rangeSlider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_users/css/vendors/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_users/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_users/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_users/css/vendors/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_users/css/vendors/slick/slick-theme.css') }}">
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('assets_users/css/demo4.css') }}">

    <link href="https://cdn.datatables.net/v/bs4/dt-2.0.5/datatables.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet">
    <style>
        .h-logo {
            max-width: 50px !important;
        }

        footer {
            background: #fff !important;
        }

        .f-logo {
            max-width: 126px !important;
        }

        @media only screen and (max-width: 600px) {
            .h-logo {
                width: 50px !important;
            }
        }

        .image-container {
            width: 100%;
            height: 0;
            padding-bottom: 100%;
            /* This creates a square aspect ratio */
            position: relative;
            overflow: hidden;
        }

        .image-container img {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensures the image covers the container without stretching */
        }

        @media (max-width: 768px) {
            .logo-full {
                display: none;
                /* Hide full text on small screens */
            }

            .barcode-card .barcode-image {
                max-width: 100%;
                height: auto;
                display: block;
                margin: 0 auto;
            }

            .barcode-card .card-body {
                padding: 10px;
            }

        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets_users/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_users/css/custom.css') }}">
    <!-- Place this in the <head> or just before closing </body> tag -->

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .poster-section {
            height: 600px;
            background-image: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.5)), url('{{ asset('images/hero.jpg') }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }
    </style>

    @livewireStyles
</head>

<body class="theme-color4 light ltr">
    <style>
        header .profile-dropdown ul li {
            display: block;
            padding: 5px 20px;
            border-bottom: 1px solid #ddd;
            line-height: 35px;
        }

        header .profile-dropdown ul li:last-child {
            border-color: #fff;
        }

        header .profile-dropdown ul {
            padding: 10px 0;
            min-width: 250px;
        }

        .name-usr {
            background: #ffc414;
            padding: 8px 12px;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 24px;
        }

        .name-usr span {
            margin-right: 10px;
        }

        .cart-media a {
            color: #fff !important;
        }

        @media (max-width:600px) {
            .h-logo {
                max-width: 150px !important;
            }

            i.sidebar-bar {
                font-size: 22px;
            }

            .mobile-menu ul li a svg {
                width: 20px;
                height: 20px;
            }

            .mobile-menu ul li a span {
                margin-top: 0px;
                font-size: 12px;
            }

            .name-usr {
                padding: 5px 12px;
            }


        }
    </style>
    <style>
        .nav-tabs .nav-linkx.active,
        .nav-tabs .nav-item.show .nav-linkx {
            background: #120D4F !important;
            color: #fff !important;
        }

        .nav-tabs .nav-linkx {
            background: #EFF2F7 !important;
            color: #000;
        }

        .nav-tabs .nav-linkx {
            margin-bottom: -1px;
            background: none;
            border: 1px solid transparent;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }

        .nav-linkx {
            display: block;
            padding: 0.5rem 1rem;

            text-decoration: none;
            -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
        }

        .nav-linkx:hover {

            color: #fff;

        }

       
        
    </style>
    @include('layouts.user.navbar')
    @include('shared.restrict')
    @yield('content')

    @include('layouts.user.footer')


    <div class="tap-to-top">
        <a href="#home">
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>
    <div class="bg-overlay"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>

    <script src="{{ asset('assets_users/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets_users/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets_users/js/feather/feather.min.js') }}"></script>
    <script src="{{ asset('assets_users/js/lazysizes.min.js') }}"></script>
    <script src="{{ asset('assets_users/js/slick/slick.js') }}"></script>
    <script src="{{ asset('assets_users/js/slick/slick-animation.min.js') }}"></script>
    <script src="{{ asset('assets_users/js/slick/custom_slick.js') }}"></script>
    <script src="{{ asset('assets_users/js/price-filter.js') }}"></script>
    <script src="{{ asset('assets_users/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets_users/js/filter.js') }}"></script>
    <script src="{{ asset('assets_users/js/newsletter.js') }}"></script>
    <script src="{{ asset('assets_users/js/cart_modal_resize.js') }}"></script>
    <script src="{{ asset('assets_users/js/bootstrap/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets_users/js/theme-setting.js') }}"></script>
    <script src="{{ asset('assets_users/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.datatables.net/v/bs4/dt-2.0.5/datatables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script src="{{ asset('global/_init.js') }}"></script>
    
    <script>
        var tableScriptUrl = '{{ asset('assets_users/js/datatable/table.js') }}';
        var custom_slickScriptUrl = '{{ asset('assets_users/js/slick/custom_slick.js') }}';

        function alertSwift(icon, position, title) {
            const Toast = Swal.mixin({
                toast: true,
                position: position,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: icon,
                title: title
            })
        }


        document.addEventListener('livewire:init', () => {

            Livewire.on('messageModal', (event) => {
                loadScript(custom_slickScriptUrl,
                    function() {
                        alertSwift(event.status, event.position, event.message);
                        $(event.modal).modal('hide');
                    });

            });

            Livewire.on('redirectWithDelay', (data) => {
                setTimeout(() => {
                    window.location.href = data.url;
                }, data.delay);
            });

            function loadScript(url, callback) {
                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.src = url;

                script.onload = function() {
                    if (callback) callback();
                };
                document.body.appendChild(script);
            }

            function loadCSS(url, callback) {
                var link = document.createElement('link');
                link.rel = 'stylesheet';
                link.type = 'text/css';
                link.href = url;

                link.onload = function() {
                    if (callback) callback();
                };

                document.head.appendChild(link);
            }

        });

        $(document).ready(function() {
            $("#datatable").DataTable({
                dom: "frtip",

                responsive: {
                    details: true,
                    breakpoints: [{
                            name: "desktop",
                            width: Infinity
                        },
                        {
                            name: "tablet",
                            width: 1024
                        },
                        {
                            name: "fablet",
                            width: 768
                        },
                        {
                            name: "phone",
                            width: 480
                        },
                    ],
                },
                language: {
                    paginate: {
                        first: "First",
                        previous: "Previous",
                        next: "Next",
                        last: "Last",
                    },
                },
                select: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100],
                columnDefs: [{
                    orderable: false,
                    targets: "_all"
                }],
            });
        });
    </script>

    <script>
        $(function() {
            $('[data-bs-toggle="tooltip"]').tooltip()
        });
    </script>
   
    @livewireScripts
</body>

</html>
