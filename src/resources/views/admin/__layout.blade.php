<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <script src="{{ asset('js/tabler.min.js') }}" defer></script>
    <link href="{{ asset('css/tabler.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tabler-icons.min.css') }}" rel="stylesheet">
</head>
<body class="theme-light">
<div class="page">
    <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbar-menu"
                    aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark">
                <a href="#">
                    <img src="{{ asset('/img/logo-white.svg') }}"
                         width="110"
                         height="32"
                         alt="Tabler"
                         class="navbar-brand-image">
                </a>
            </h1>
            <div class="navbar-nav flex-row d-lg-none"></div>
            <div class="navbar-collapse collapse" id="navbar-menu">
                <ul class="navbar-nav pt-lg-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.company.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon icon-tabler icon-tabler-building-skyscraper"
                                 width="24"
                                 height="24"
                                 viewBox="0 0 24 24"
                                 stroke-width="1"
                                 stroke="currentColor"
                                 fill="none"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">
                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                               <line x1="3" y1="21" x2="21" y2="21"></line>
                               <path d="M5 21v-14l8 -4v18"></path>
                               <path d="M19 21v-10l-6 -4"></path>
                               <line x1="9" y1="9" x2="9" y2="9.01"></line>
                               <line x1="9" y1="12" x2="9" y2="12.01"></line>
                               <line x1="9" y1="15" x2="9" y2="15.01"></line>
                               <line x1="9" y1="18" x2="9" y2="18.01"></line>
                            </svg>
                            </span>
                            <span class="nav-link-title">{{ __('company.label.company') }}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.employee.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon icon-tabler icon-tabler-users"
                                 width="24"
                                 height="24"
                                 viewBox="0 0 24 24"
                                 stroke-width="1"
                                 stroke="currentColor"
                                 fill="none"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">
                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                               <circle cx="9" cy="7" r="4"></circle>
                               <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                               <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                               <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                            </svg>
                            </span>
                            <span class="nav-link-title">{{ __('employee.label.employee') }}</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown-divider"></li>

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" class="d-none" id="logout-form" method="POST">
                            @csrf
                        </form>
                        <a class="nav-link"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           href="#">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon icon-tabler icon-tabler-logout"
                                 width="24"
                                 height="24"
                                 viewBox="0 0 24 24"
                                 stroke-width="1"
                                 stroke="currentColor"
                                 fill="none"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">
                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                               <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                               <path d="M7 12h14l-3 -3m0 6l3 -3"></path>
                            </svg>
                            </span>
                            <span class="nav-link-title">{{ __('auth.label.logout') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
    <div class="page-wrapper">
        @yield('content')
    </div>
</div>
</body>
</html>
