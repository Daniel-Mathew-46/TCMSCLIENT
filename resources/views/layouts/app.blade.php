<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'tcmsclient') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="css.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Token and Customer Management System
                    {{-- {{isset(Auth::user()->utility_provider()->provider_name) ? strtoupper(Auth::user()->utility_provider->provider_name) : ""}} --}}
                    <span class="fw-bold fs-6">
                        {{-- {{"Dawasco"}} --}}
                        {{-- {{isset(Auth::user()->utility_provider_id) ? strtoupper(Auth::user()->utility_provider_id) : ""}} --}}
                    </span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            @if (!empty(Auth::user()->getAllPermissions()))
                                @if (str_contains(implode(', ', collect(Auth::user()->getAllPermissions())->pluck('name')->toArray()), 'user'))
                                    <li><a class="nav-link" href="{{ route('users.index') }}">UP Users</a></li>
                                @endif
                                @if (str_contains(implode(', ', collect(Auth::user()->getAllPermissions())->pluck('name')->toArray()), 'role'))
                                    <li><a class="nav-link" href="{{ route('roles.index') }}">Roles and Permissions</a></li>
                                @endif
                                @if (str_contains(implode(', ', collect(Auth::user()->getAllPermissions())->pluck('name')->toArray()), 'provider'))
                                    <li><a class="nav-link" href="{{ route('utility_providers.index') }}">Utility Providers</a></li>
                                @endif
                                @if (str_contains(implode(', ', collect(Auth::user()->getAllPermissions())->pluck('name')->toArray()), 'provcateg'))
                                    <li><a class="nav-link" href="{{ route('provider_categories.index') }}">Provider Categories</a></li>
                                @endif
                                @if (str_contains(implode(', ', collect(Auth::user()->getAllPermissions())->pluck('name')->toArray()), 'customer'))
                                    <li><a class="nav-link" href="{{ route('customers.index') }}">Customers</a></li>
                                @endif
                                @if (str_contains(implode(', ', collect(Auth::user()->getAllPermissions())->pluck('name')->toArray()), 'tariff'))
                                    <li><a class="nav-link" href="{{ route('tariffs.index')}}">Tariffs</a></li>
                                @endif
                            @else
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->full_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>
</body>
</html>



