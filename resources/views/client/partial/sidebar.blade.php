<div class="leftside-menu">

    <a href="{{ route('client.home') }}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('images/logo.png') }}" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('images/logo_sm.png') }}" alt="" height="16">
        </span>
    </a>
    <!-- LOGO -->
    <a href="{{ route('client.home') }}" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('images/logo-dark.png') }}" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('images/logo_sm_dark.png') }}" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar>
        @php($authenticated = auth()->user())
        <!--- Sidemenu -->
        <ul class="side-nav">


            <li class="side-nav-item {{ request()->routeIs('client.home') ? 'menuitem-active' : '' }}">

                <a href="{{ route('client.home') }}"
                    class="side-nav-link {{ request()->routeIs('client.home') ? 'active' : '' }}">
                    <i class="uil-home"></i>
                    <span> {{ __('Home') }} </span>
                </a>
            </li>

            <li class="side-nav-item {{ request()->routeIs('client.parcels.*') ? 'menuitem-active' : '' }}">

                <a href="{{ route('client.parcels.index') }}"
                    class="side-nav-link {{ request()->routeIs('client.parcels.*') ? 'active' : '' }}">
                    <i class="uil-file-plus-alt"></i>
                    <span> {{ __('Parcels') }} </span>
                </a>
            </li>
        </ul>

    </div>
    <!-- Sidebar -left -->

</div>
