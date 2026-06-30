<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

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
            <a class="nav-link collapsed" href="{{ route('blog-posts.index') }}">
                <i class="bi bi-pencil-square"></i>
                <span>Blog Posts</span>
            </a>
        </li>
        <!-- End Blog Posts Nav -->

        @if (Auth::user()->isAdmin())
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
                <a class="nav-link collapsed" href="{{ route('blog-categories.index') }}">
                    <i class="bi bi-tags"></i>
                    <span>Blog Categories</span>
                </a>
            </li>
            <!-- End Blog Categories Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('contact.index') }}">
                    <i class="bi bi-envelope"></i>
                    <span>Enquiry Form</span>
                </a>
            </li>
            <!-- End Enquiry Form Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('subscribe.index') }}">
                    <i class="bi bi-envelope"></i>
                    <span>Subscribe Form</span>
                </a>
            </li>
            <!-- End Subscribe Form Nav -->
        @endif

    </ul>

</aside><!-- End Sidebar-->
