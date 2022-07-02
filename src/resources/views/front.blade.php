<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/tabler.min.css') }}" rel="stylesheet">
</head>
<body class="border-top-wide border-primary d-flex flex-column theme-dark">
<div class="page page-center">
    <div class="container-tight py-4">
        <div class="empty">
            <p class="empty-title">Laravel - {{ __('common.project.name') }}</p>
            <p class="empty-subtitle">
                @foreach (Config::get('languages') as $id => $val)
                    @if ($id != App::getLocale())
                        <a class="btn btn-secondary"
                           href="{{ route('front.index', ['lang' => $id]) }}">{{ $val }}</a>
                    @endif
                @endforeach
            </p>
            <div class="empty-action">
                @auth
                    <a href="{{ route('admin.company.index') }}"
                       class="btn btn-outline-light">{{ __('auth.label.admin') }}</a>
                @else
                    <a href="{{ route('login') }}"
                       class="btn btn-outline-light">{{ __('auth.label.login') }}</a>
                @endauth
            </div>
        </div>
    </div>
</div>
</body>
</html>
