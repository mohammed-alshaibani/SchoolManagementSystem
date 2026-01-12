@php($locale = app()->getLocale())

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
    <a href="{{ route('home') }}" class="navbar-brand">
        <h1 class="m-0 text-primary">
            <img src="{{ asset('img/samaha_logo.jpg') }}" alt="Logo" style="height: 120px;"> Samaha
        </h1>
    </a>

    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto">
            <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">{{ __('messages.nav_home') }}</a>
            <a href="{{ route('about') }}" class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">{{ __('messages.nav_about') }}</a>
            <a href="{{ route('classes') }}" class="nav-item nav-link {{ request()->routeIs('classes') ? 'active' : '' }}">{{ __('messages.nav_classes') }}</a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs(['facility', 'team', 'call-to-action', 'appointment', 'testimonial', '404']) ? 'active' : '' }}" data-bs-toggle="dropdown">
                    {{ __('messages.nav_pages') }}
                </a>
                <div class="dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0">
                    <a href="{{ route('facility') }}" class="dropdown-item {{ request()->routeIs('facility') ? 'active' : '' }}">{{ __('messages.nav_school_facilities') }}</a>
                    <a href="{{ route('news') }}" class="dropdown-item {{ request()->routeIs('news') ? 'active' : '' }}">{{ __('messages.nav_news') }}</a>
                    <a href="{{ route('team') }}" class="dropdown-item {{ request()->routeIs('team') ? 'active' : '' }}">{{ __('messages.nav_popular_teachers') }}</a>
                    <a href="{{ route('call-to-action') }}" class="dropdown-item {{ request()->routeIs('call-to-action') ? 'active' : '' }}">{{ __('messages.nav_become_teacher') }}</a>
                    <a href="{{ route('appointment') }}" class="dropdown-item {{ request()->routeIs('appointment') ? 'active' : '' }}">{{ __('messages.nav_make_appointment') }}</a>
                    <a href="{{ route('testimonial') }}" class="dropdown-item {{ request()->routeIs('testimonial') ? 'active' : '' }}">{{ __('messages.nav_testimonial') }}</a>
                    <a href="{{ route('404') }}" class="dropdown-item {{ request()->routeIs('404') ? 'active' : '' }}">{{ __('messages.nav_404') }}</a>
                </div>
            </div>

            <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">{{ __('messages.nav_contact') }}</a>
        </div>

        {{-- Language Switcher --}}
        <div class="d-flex align-items-center">
            @php($locale = app()->getLocale())
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    {{ $locale === 'ar' ? 'العربية' : 'English' }}
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item {{ $locale === 'en' ? 'active' : '' }}" href="{{ route('locale.switch', 'en') }}">English</a>
                    <a class="dropdown-item {{ $locale === 'ar' ? 'active' : '' }}" href="{{ route('locale.switch', 'ar') }}">العربية</a>
                </div>
            </div>

            <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill px-3 d-none d-lg-block ms-3">
                {{ __('messages.nav_contact') }} <i class="fa fa-arrow-right ms-3"></i>
            </a>
        </div>
    </div>
</nav>
<!-- Navbar End -->
<div style="position:fixed;bottom:8px;right:8px;background:#fff;border:1px solid #ccc;padding:6px;font:12px/1.2 sans-serif;z-index:9999">
  locale={{ $locale }} |
  session.locale={{ session('locale') ?? 'null' }}
</div>