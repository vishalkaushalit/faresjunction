<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    @php
        $blogMenuOpen = request()->routeIs('blog-posts.*', 'blog-categories.*', 'blog-tags.*');
        $leadMenuOpen = request()->routeIs('contact.*', 'subscribe.*');
    @endphp

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link {{ $blogMenuOpen ? '' : 'collapsed' }}" data-bs-target="#blog-nav" data-bs-toggle="collapse" href="#" aria-expanded="{{ $blogMenuOpen ? 'true' : 'false' }}">
                <i class="bi bi-journal-text"></i>
                <span>Blogs</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="blog-nav" class="nav-content collapse {{ $blogMenuOpen ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('blog-posts.index') }}" class="{{ request()->routeIs('blog-posts.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>All Blogs</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('blog-tags.index') }}" class="{{ request()->routeIs('blog-tags.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Tags</span>
                    </a>
                </li>
                @if (Auth::user()->isAdmin())
                    <li>
                        <a href="{{ route('blog-categories.index') }}" class="{{ request()->routeIs('blog-categories.index') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Categories</span>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
        <!-- End Blogs Nav -->

        @if (Auth::user()->isAdmin())
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('airline-pages.*') ? '' : 'collapsed' }}" href="{{ route('airline-pages.index') }}">
                    <i class="bi bi-airplane"></i>
                    <span>Airline Pages</span>
                </a>
            </li>
            <!-- End Airline Pages Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('users.index') }}">
                    <i class="bi bi-people"></i>
                    <span>Users</span>
                </a>
            </li>
            <!-- End Users Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('seo-meta.index') }}">
                    <i class="bi bi-search"></i>
                    <span>SEO Meta Tags</span>
                </a>
            </li>
            <!-- End SEO Meta Tags Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('global-scripts.edit') }}">
                    <i class="bi bi-code-slash"></i>
                    <span>Global Scripts</span>
                </a>
            </li>
            <!-- End Global Scripts Nav -->

            <li class="nav-item">
                <a class="nav-link {{ $leadMenuOpen ? '' : 'collapsed' }}" data-bs-target="#lead-nav" data-bs-toggle="collapse" href="#" aria-expanded="{{ $leadMenuOpen ? 'true' : 'false' }}">
                    <i class="bi bi-envelope-paper"></i>
                    <span>Leads</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="lead-nav" class="nav-content collapse {{ $leadMenuOpen ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.index') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Contact Form</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('subscribe.index') }}" class="{{ request()->routeIs('subscribe.index') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Subscribe Form</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- End Leads Nav -->
        @endif

    </ul>

</aside><!-- End Sidebar-->
