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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    @yield('style')
</head>

<body>
    <div class="sidebar">
        <div class="logo" style="padding: 0px;margin: 0px 0px -6px 0px;;">
            <img style="width: -webkit-fill-available" src="{{ asset('logo/logo.jpg') }}" alt="" height="83" width="240">
        </div>
        <div class="dashboard">
            <p><i class="fas fa-home" style="padding-right: 10px;"></i>  Dashboard</p>
        </div>
        <nav>
            <ul>
                <li class="submenu {{ request('type') == 'user' ? 'expanded' : '' }}">
                    <a href="{{ route('manage-users', ['type' => 'user']) }}" class="submenu-toggle"><i
                            class="fas fa-users "></i> Users Manage</a>
                </li>
                <li class="submenu {{ request('type') == 'vendor' ? 'expanded' : '' }}">
                    <a href="{{ route('manage-users', ['type' => 'vendor']) }}" class="submenu-toggle"><i
                            class="fas fa-user-tag"></i>
                        Vendor Manage </a>
                </li>

                <li class="submenu {{ request()->is('*plans*') ? 'expanded' : '' }}">
                    <a href="{{ route('manage-plans') }}" class="submenu-toggle"><i class="fas fa-columns"></i> Plan
                        Manage </a>
                </li>

                <li
                    class="submenu {{ Str::contains(request()->path(), ['dashboard','brands','registration-years','varients','fuel-types','fuel-varients','variant-types','kilometers','owners']) ? 'expanded' : '' }}">
                    <a href="#" class="submenu-toggle"><i class="fas fa-car"></i> Car Details</a>
                    <ul
                        class="submenu-items {{ Str::contains(request()->path(), ['dashboard','brands','registration-years','varients','fuel-types','fuel-varients','variant-types','kilometers','owners']) ? 'expanded' : '' }}">
                        <li class="{{ Str::contains(request()->path(), ['dashboard','brands']) ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">Car Brands</a>
                        </li>
                        <li class="{{ request()->is('*registration-years*') ? 'active' : '' }}">
                            <a href="{{ route('manage-registration-years') }}">Car Registration Years</a>
                        </li>
                        <li class="{{ request()->is('*varients*') ? 'active' : '' }}">
                            <a href="{{ route('manage-varients') }}">Car Varients</a>
                        </li>
                        <li class="{{ request()->is('*fuel-types*') ? 'active' : '' }}">
                            <a href="{{ route('manage-fuel-types') }}">Car Fuel Types</a>
                        </li>
                        <li class="{{ request()->is('*fuel-varients*') ? 'active' : '' }}">
                            <a href="{{ route('manage-fuel-varients') }}">Car Fuel Varients</a>
                        </li>
                        <li class="{{ request()->is('*variant-types*') ? 'active' : '' }}">
                            <a href="{{ route('manage-variant-types') }}">Car Variant Types</a>
                        </li>
                        <li class="{{ request()->is('*kilometers*') ? 'active' : '' }}">
                            <a href="{{ route('manage-kilometers') }}">Car Kilometer Ranges</a>
                        </li>
                        <li class="{{ request()->is('*owners*') ? 'active' : '' }}">
                            <a href="{{ route('manage-owners') }}">Car Owners</a>
                        </li>
                    </ul>
                </li>

                <li class="submenu {{ request()->is('*coupon-code*') ? 'expanded' : '' }}">
                    <a href="{{ route('manage-coupon-code') }}" class="submenu-toggle"><i class="fas fa-gift"></i> Coupon
                        Manage </a>
                </li>

                <li class="submenu {{ request()->is('*notification*') ? 'expanded' : '' }}">
                    <a href="{{ route('manage-notification') }}" class="submenu-toggle"><i class="fas fa-bell"></i> Notifications </a>
                </li>

            </ul>
        </nav>
    </div>
    <div class="main-content">
        <header>
            <div class="search-container">
                {{-- <i class="fas fa-search fa-lg"></i>
                <input type="text" placeholder="Search"> --}}
            </div>
            <div class="user-icon">
                <i class="fa-bell fas notification"></i>
                <div class="dropdown">
                    <i class="fas fa-user"></i> Jonny
                    <div class="dropdown-content">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="logout-button">Logout</button>
                        </form>
                    </div>
                </div>
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
            });

            // Expand submenu if any sub-item is active
            $('.submenu').each(function() {
                if ($(this).find('.submenu-items .active').length) {
                    $(this).addClass('expanded');
                    $(this).find('.submenu-items').show();
                }
            });

            $('.dropdown').on('click', function() {
                var $dropdownContent = $(this).find('.dropdown-content');
                $dropdownContent.toggle();
            });

        });
    </script>
</body>

</html>
