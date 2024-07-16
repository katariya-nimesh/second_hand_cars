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
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h1>LOGO</h1>
        </div>
        <nav>
            <ul>
                <li class="submenu {{ request()->routeIs(['car-brands.index', 'car-registration-years.index', 'car-varients.index', 'car-fuel-types.index', 'car-fuel-varients.index', 'car-kilometers.index', 'car-variant-types.index']) ? 'expanded' : '' }}">
                    <a href="#"><i class="fas fa-car"></i> Car <i class="fas fa-angle-down submenu-toggle"></i></a>
                    <ul class="submenu-items {{ request()->routeIs(['car-brands.index', 'car-registration-years.index', 'car-varients.index', 'car-fuel-types.index', 'car-fuel-varients.index', 'car-kilometers.index', 'car-variant-types.index']) ? 'expanded' : '' }}">
                        <li class="{{ request()->routeIs('car-brands.index') ? 'active' : '' }}">
                            <a href="{{ route('car-brands.index') }}">Car Brands</a>
                        </li>
                        <li class="{{ request()->routeIs('car-registration-years.index') ? 'active' : '' }}">
                            <a href="{{ route('car-registration-years.index') }}">Car Registration Years</a>
                        </li>
                        <li class="{{ request()->routeIs('car-varients.index') ? 'active' : '' }}">
                            <a href="{{ route('car-varients.index') }}">Car Varients</a>
                        </li>
                        <li class="{{ request()->routeIs('car-fuel-types.index') ? 'active' : '' }}">
                            <a href="{{ route('car-fuel-types.index') }}">Car Fuel Types</a>
                        </li>
                        <li class="{{ request()->routeIs('car-fuel-varients.index') ? 'active' : '' }}">
                            <a href="{{ route('car-fuel-varients.index') }}">Car Fuel Varients</a>
                        </li>
                        <li class="{{ request()->routeIs('car-kilometers.index') ? 'active' : '' }}">
                            <a href="{{ route('car-kilometers.index') }}">Car Kilometers</a>
                        </li>
                        <li class="{{ request()->routeIs('car-variant-types.index') ? 'active' : '' }}">
                            <a href="{{ route('car-variant-types.index') }}">Car Variant Types</a>
                        </li>
                        <li class="{{ request()->routeIs('car-owners.index') ? 'active' : '' }}">
                            <a href="{{ route('car-owners.index') }}">Car Owners</a>
                        </li>
                    </ul>
                </li>
                <li class="submenu {{ request()->routeIs(['car-owners.index', 'vendors.index']) ? 'expanded' : '' }}">
                    <a href="#"><i class="fas fa-users"></i> Users <i class="fas fa-angle-down submenu-toggle"></i></a>
                    <ul class="submenu-items {{ request()->routeIs(['car-owners.index', 'vendors.index']) ? 'expanded' : '' }}">
                        
                        <li class="#">
                            <a href="#">Vendors</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <div class="main-content">
        <header>
            <div class="search-container">
                <input type="text" placeholder="Search...">
                <i class="fas fa-search"></i>
            </div>
            <div class="user-icon">
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
                $(this).parent().next('.submenu-items').slideToggle();
                $(this).toggleClass('rotated');
            });

            // Expand submenu if any sub-item is active
            $('.submenu').each(function() {
                if ($(this).find('.submenu-items .active').length) {
                    $(this).addClass('expanded');
                    $(this).find('.submenu-items').show();
                    $(this).find('.submenu-toggle').addClass('rotated');
                }
            });
        });
    </script>
</body>
</html>
