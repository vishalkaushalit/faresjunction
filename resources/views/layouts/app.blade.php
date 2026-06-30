<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.webp') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('dashboardAssets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboardAssets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboardAssets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboardAssets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboardAssets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboardAssets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboardAssets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('dashboardAssets/css/style.css') }}?123" rel="stylesheet">

    <!-- Google Search Console -->
    <meta name="google-site-verification" content="moulPyqrWIh1sdiu7yjx0Gn9MtbOU1lXOQBstoj2FEM">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg-danger {
            background: #000 !important;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div>
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center">

            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ url('/') }}" class="logo" aria-label="Fond Travels Home">
                    <span class="logo-bold">Fond</span><span class="logo-light">Travels</span>
                    <svg class="logo-plane" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                        <path
                            d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L14 19v-5.5l7 2.5z" />
                    </svg>
                </a>

                <i class="bi bi-list toggle-sidebar-btn"></i>
            </div><!-- End Logo -->

            {{-- <div class="search-bar">
                <form class="search-form d-flex align-items-center" method="POST" action="#">
                    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div><!-- End Search Bar --> --}}

            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">

                    <li class="nav-item dropdown pe-3">
                        <a class="nav-link nav-profile dropdown-toggle d-flex align-items-center pe-0" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{-- Profile image can be added here --}}
                            <span class="d-block ps-2">{{ Auth::user()->name }}</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

                            <!-- Profile Header -->
                            <li class="dropdown-header text-start px-3">
                                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                <small class="text-muted">{{ Auth::user()->email }}</small>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- My Profile Link -->
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2"></i>
                                    <span>My Profile</span>
                                </a>
                            </li>

                            <!-- Optional Label (e.g., "Actions") -->
                            {{-- <li class="dropdown-header text-muted px-3 small text-uppercase">Actions</li> --}}

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- Logout -->
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item d-flex align-items-center">
                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        <span>Sign Out</span>
                                    </button>
                                </form>
                            </li>

                        </ul>
                    </li>


                </ul>
            </nav><!-- End Icons Navigation -->

        </header><!-- End Header -->
        @include('layouts.sidebar')

        <!-- Page Content -->
        <main class="main" id="main">
            {{ $slot }}
        </main>
    </div>
    <!-- Vendor JS Files -->
    <script src="{{ asset('dashboardAssets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboardAssets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('dashboardAssets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('dashboardAssets/js/main.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        if (window.bootstrap) {
            document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach((dropdownToggle) => {
                bootstrap.Dropdown.getOrCreateInstance(dropdownToggle);
            });
        }

        if (window.CKEDITOR && document.getElementById('description')) {
            CKEDITOR.replace('description');
        }

        if (window.CKEDITOR && document.getElementById('sub_description')) {
            CKEDITOR.replace('sub_description');
        }

        if (window.CKEDITOR && document.getElementById('content')) {
            CKEDITOR.replace('content');
        }
    </script>
</body>

</html>
