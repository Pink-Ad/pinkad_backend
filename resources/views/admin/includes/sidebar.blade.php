<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-toggle d-none d-md-flex" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <li>
                        <a class="nav-link" href="home">
                            <i class="bx bx-home-alt" aria-hidden="true"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="nav-group-label">User</li>
                    <li>
                        <a class="nav-link" href="/user_roles">
                            <i class="bx bx-user-check" aria-hidden="true"></i>
                            <span>User Roles</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link" href="/users">
                            <i class="bx bx-user" aria-hidden="true"></i>
                            <span>Users</span>
                        </a>
                    </li>

                    <li class="nav-group-label">Salesman</li>
                    <li>
                        <a class="nav-link" href="{{ route('salesman-management.index') }}">
                            <i class="bx bx-user-voice" aria-hidden="true"></i>
                            <span>Salesman</span>
                        </a>
                    </li>

                    <li class="nav-group-label">Visitors</li>
                    <li>
                        <a class="nav-link" href="{{ route('visitor-management.index') }}">
                            <i class="bx bx-user-pin" aria-hidden="true"></i>
                            <span>Visitors</span>
                        </a>
                    </li>

                    <li class="nav-group-label">Sellers</li>
                    <li>
                        <a class="nav-link" href="{{ route('seller-management.index') }}">
                            <i class="bx bx-male-sign" aria-hidden="true"></i>
                            <span>Sellers</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('shop-management.index') }}">
                            <i class="bx bx-store" aria-hidden="true"></i>
                            <span>Seller Shops</span>
                        </a>
                    </li>

                    <li class="nav-group-label">Locations</li>
                    <li>
                        <a class="nav-link" href="{{ route('province-management.index') }}">
                            <i class="bx bx-map" aria-hidden="true"></i>
                            <span>Provinces</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('city-management.index') }}">
                            <i class="bx bx-map-alt" aria-hidden="true"></i>
                            <span>Cities</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link" href="{{ route('area-management.index') }}">
                            <i class="bx bx-map-pin" aria-hidden="true"></i>
                            <span>Area</span>
                        </a>
                    </li>

                    <li class="nav-group-label">Offers</li>
                    <li>
                        <a class="nav-link" href="{{ route('offer-categories.index') }}">
                            <i class="bx bx-fullscreen" aria-hidden="true"></i>
                            <span>Categories</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link" href="{{ route('offer-sub-categories.index') }}">
                            <i class="bx bx-customize" aria-hidden="true"></i>
                            <span>Sub Categories</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link" href="{{ route('offer-management.index') }}">
                            <i class="bx bx-receipt" aria-hidden="true"></i>
                            <span>Offers</span>
                        </a>
                    </li>

                    <li class="nav-group-label">Feedback</li>
                    <li>
                        <a class="nav-link" href="{{ route('feedback-management.index') }}">
                            <i class="bx bx-notepad" aria-hidden="true"></i>
                            <span>Feedback</span>
                        </a>
                    </li>

                    <li class="nav-group-label">Premium</li>
                    <li>
                        <a class="nav-link" href="/packages">
                            <i class="bx bx-grid" aria-hidden="true"></i>
                            <span>Packages</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link" href="{{ route('banner-management.index') }}">
                            <i class="bx bx-carousel" aria-hidden="true"></i>
                            <span>Banners</span>
                        </a>
                    </li>

                    <li class="nav-group-label">Payments</li>
                    <li>
                        <a class="nav-link" href="/payments">
                            <i class="bx bx-money" aria-hidden="true"></i>
                            <span>Payments</span>
                        </a>
                    </li>

                    <li class="nav-group-label">Tutorials</li>
                    <li>
                        <a class="nav-link" href="{{ route('video-management.index') }}">
                            <i class="bx bxs-videos" aria-hidden="true"></i>
                            <span>Seller Guide</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>

        <script>
            // Maintain Scroll Position
            if (typeof localStorage !== 'undefined') {
                if (localStorage.getItem('sidebar-left-position') !== null) {
                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                    sidebarLeft.scrollTop = initialPosition;
                }
            }
        </script>

    </div>

</aside>
