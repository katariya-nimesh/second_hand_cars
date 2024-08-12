<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <!-- Link to the admin.css file -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <!-- Add FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Add jQuery for submenu toggle functionality -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('style')
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <h1>LOGO</h1>
        </div>
        <div class="dashboard">
            <p><i class="fas fa-home"></i> Dashboard</p>
        </div>
        <nav>
            <ul>
                <li class="submenu {{ request()->routeIs(['manage-users']) ? 'expanded' : '' }}">
                    <a href="{{ route('manage-users') }}" class="submenu-toggle"><i class="fas fa-users "></i> Users Manage</a>
                    {{-- <ul class="submenu-items {{ request()->routeIs(['manage-owners', 'vendors.index']) ? 'expanded' : '' }}">

                        <li class="#">
                            <a href="#">Vendors</a>
                        </li>
                    </ul> --}}
                </li>
                <li class="submenu {{ request()->routeIs(['manage-vendors']) ? 'expanded' : '' }}">
                    <a href="{{ route('manage-vendors') }}" class="submenu-toggle"><i class="fas fa-user-tag"></i> Vendor Manage </a>
                    {{-- <ul class="submenu-items {{ request()->routeIs(['manage-owners', 'vendors.index']) ? 'expanded' : '' }}">

                        <li class="#">
                            <a href="#">Vendor Manage</a>
                        </li>
                    </ul> --}}
                </li>

                <li class="submenu {{ request()->routeIs(['manage-plans']) ? 'expanded' : '' }}">
                    <a href="{{ route('manage-plans') }}" class="submenu-toggle"><i class="fas fa-columns"></i> Plan Manage </a>
                    {{-- <ul class="submenu-items {{ request()->routeIs(['manage-owners', 'vendors.index']) ? 'expanded' : '' }}">

                        <li class="#">
                            <a href="#">Vendor Manage</a>
                        </li>
                    </ul> --}}
                </li>

                <li
                    class="submenu {{ request()->routeIs(['dashboard', 'manage-registration-years', 'manage-varients', 'manage-fuel-types', 'manage-fuel-varients', 'manage-kilometers', 'manage-variant-types']) ? 'expanded' : '' }}">
                    <a href="#" class="submenu-toggle"><i class="fas fa-car"></i> Car Details</a>
                    <ul
                        class="submenu-items {{ request()->routeIs(['dashboard', 'manage-registration-years', 'manage-varients', 'manage-fuel-types', 'manage-fuel-varients', 'manage-kilometers', 'manage-variant-types']) ? 'expanded' : '' }}">
                        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">Car Brands</a>
                        </li>
                        <li class="{{ request()->routeIs('manage-registration-years') ? 'active' : '' }}">
                            <a href="{{ route('manage-registration-years') }}">Car Registration Years</a>
                        </li>
                        <li class="{{ request()->routeIs('manage-varients') ? 'active' : '' }}">
                            <a href="{{ route('manage-varients') }}">Car Varients</a>
                        </li>
                        <li class="{{ request()->routeIs('manage-fuel-types') ? 'active' : '' }}">
                            <a href="{{ route('manage-fuel-types') }}">Car Fuel Types</a>
                        </li>
                        <li class="{{ request()->routeIs('manage-fuel-varients') ? 'active' : '' }}">
                            <a href="{{ route('manage-fuel-varients') }}">Car Fuel Varients</a>
                        </li>
                        <li class="{{ request()->routeIs('manage-variant-types') ? 'active' : '' }}">
                            <a href="{{ route('manage-variant-types') }}">Car Variant Types</a>
                        </li>
                        <li class="{{ request()->routeIs('manage-kilometers') ? 'active' : '' }}">
                            <a href="{{ route('manage-kilometers') }}">Car Kilometer Ranges</a>
                        </li>
                        <li class="{{ request()->routeIs('manage-owners') ? 'active' : '' }}">
                            <a href="{{ route('manage-owners') }}">Car Owners</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
    <div class="main-content">
        <header>
            <div class="search-container">
                <i class="fas fa-search fa-lg"></i>
                <input type="text" placeholder="Search">
            </div>
            <div class="user-icon">
                <i class="fa-bell fas notification"></i>
                {{-- <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form> --}}
                <i class="fas fa-user"></i> Jonny
            </div>
        </header>
        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Add script to handle submenu toggle -->
    <script>
        $(document).ready(function() {
            $('.submenu-toggle').click(function() {
                $(this).next('.submenu-items').slideToggle();
                //      $(this).toggleClass('rotated');
            });

            // Expand submenu if any sub-item is active
            $('.submenu').each(function() {
                if ($(this).find('.submenu-items .active').length) {
                    $(this).addClass('expanded');
                    $(this).find('.submenu-items').show();
                    //        $(this).find('.submenu-toggle').addClass('rotated');
                }
            });
        });
    </script>
</body>

</html>
