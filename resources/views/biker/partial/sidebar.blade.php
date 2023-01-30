<div class="leftside-menu">

    <a href="{{ route('biker.home') }}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('images/logo.png') }}" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('images/logo_sm.png') }}" alt="" height="16">
        </span>
    </a>
    <!-- LOGO -->
    <a href="{{ route('biker.home') }}" class="logo text-center logo-dark">
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


            <li class="side-nav-item {{ request()->routeIs('biker.home') ? 'menuitem-active' : '' }}">

                <a href="{{ route('biker.home') }}"
                    class="side-nav-link {{ request()->routeIs('biker.home') ? 'active' : '' }}">
                    <i class="uil-home"></i>
                    <span> {{ __('Home') }} </span>
                </a>
            </li>

            <li class="side-nav-item {{ request()->routeIs('biker.toDoList.*') ? 'menuitem-active' : '' }}">

                <a href="{{ route('biker.toDoList.index') }}"
                    class="side-nav-link {{ request()->routeIs('biker.toDoList.*') ? 'active' : '' }}">
                    <i class="uil-file-plus-alt"></i>
                    <span> {{ __('To Do List') }} </span>
                </a>
            </li>
        </ul>

    </div>
    <!-- Sidebar -left -->

</div>
