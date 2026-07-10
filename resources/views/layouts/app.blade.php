<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.svg') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
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
    @vite('resources/js/app.js')

    <style>
        .bg-danger {
            background: #000 !important;
        }

    </style>
</head>

<body class="font-sans antialiased">
    @php
        $authenticatedUser = Auth::user();
    @endphp

    <div>
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center">

            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ url('/') }}" class="logo" aria-label="Fares Junction Home">
                    <span class="logo-bold">Fares</span><span class="logo-light">Junction</span>
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
                            <span class="d-block ps-2">{{ $authenticatedUser->name }}</span>
                            @if ($authenticatedUser->status)
                                <span class="badge bg-success ms-2">Active</span>
                            @else
                                <span class="badge bg-secondary ms-2">Inactive</span>
                            @endif
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

                            <!-- Profile Header -->
                            <li class="dropdown-header text-start px-3">
                                <h6 class="mb-0">{{ $authenticatedUser->name }}</h6>
                                <small class="text-muted d-block">{{ $authenticatedUser->email }}</small>
                                @if ($authenticatedUser->status)
                                    <span class="badge bg-success mt-2">Active</span>
                                @else
                                    <span class="badge bg-secondary mt-2">Inactive</span>
                                @endif
                                <small class="text-muted d-block mt-2">
                                    Created: {{ \App\Models\User::formatLocalDateTime($authenticatedUser->created_at) }}
                                </small>
                                <small class="text-muted d-block">
                                    Last Login: {{ \App\Models\User::formatLocalDateTime($authenticatedUser->last_login_at, 'Never') }}
                                </small>
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

    <button id="backToTopBtn" class="back-to-top show" aria-label="Back to top">
        <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
            <path d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.58 5.59L20 12l-8-8-8 8z"></path>
        </svg>
    </button>

    <!-- Vendor JS Files -->
    <script src="{{ asset('dashboardAssets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboardAssets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('dashboardAssets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('dashboardAssets/js/main.js') }}"></script>
    <script
        src="{{ asset('assets/js/back-to-top.js') }}?v={{ file_exists(public_path('assets/js/back-to-top.js')) ? filemtime(public_path('assets/js/back-to-top.js')) : time() }}"
        defer></script>
    <script src="https://cdn.ckeditor.com/4.21.0/full-all/ckeditor.js"></script>
    <script>
        if (window.bootstrap) {
            document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach((dropdownToggle) => {
                bootstrap.Dropdown.getOrCreateInstance(dropdownToggle);
            });
        }

        const richTextEditorConfig = {
            extraAllowedContent: '*[id]; *{text-align}; img[!src,alt,width,height,style]; a[!href,id,name,target,rel]',
            toolbar: [{
                    name: 'document',
                    items: ['Source']
                },
                {
                    name: 'clipboard',
                    items: ['Undo', 'Redo']
                },
                {
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat']
                },
                {
                    name: 'paragraph',
                    items: [
                        'NumberedList',
                        'BulletedList',
                        'Outdent',
                        'Indent',
                        'Blockquote',
                        'JustifyLeft',
                        'JustifyCenter',
                        'JustifyRight',
                        'JustifyBlock',
                    ],
                },
                {
                    name: 'links',
                    items: ['Link', 'Unlink', 'Anchor']
                },
                {
                    name: 'insert',
                    items: ['Image', 'Table', 'HorizontalRule']
                },
                {
                    name: 'styles',
                    items: ['Format']
                },
            ],
        };

        if (window.CKEDITOR && document.getElementById('description')) {
            CKEDITOR.replace('description', richTextEditorConfig);
        }

        if (window.CKEDITOR && document.getElementById('sub_description')) {
            CKEDITOR.replace('sub_description', richTextEditorConfig);
        }

        if (window.CKEDITOR && document.getElementById('content')) {
            CKEDITOR.replace('content', {
                ...richTextEditorConfig,
                uploadUrl: @json(route('blog-posts.content-file-upload')),
                imageUploadUrl: @json(route('blog-posts.content-image-upload')),
                filebrowserUploadUrl: @json(route('blog-posts.content-file-upload', ['_token' => csrf_token()])),
                filebrowserImageUploadUrl: @json(route('blog-posts.content-image-upload', ['_token' => csrf_token()])),
                fileTools_requestHeaders: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });
        }
    </script>
</body>

</html>
