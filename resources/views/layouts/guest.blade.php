<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LMS System') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #e0f2fe, #eff6ff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-box {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            width: 100%;
            max-width: 420px;
        }

        .logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 10px;
            display: block;
        }

        .app-title {
            text-align: center;
            font-weight: 600;
            color: #1e3a8a;
        }
    </style>
</head>
<body>
    <div class="">
        <!-- <a href="/">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
        </a>
        <h2 class="app-title mb-4">{{ config('app.name', 'LMS System') }}</h2> -->

        {{ $slot }}
    </div>
</body>
</html>
