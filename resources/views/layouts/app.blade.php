<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GitInspector') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased">
<x-banner />

<div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex flex-col">
    @include('components.navigation-menu')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <div class="flex flex-1">
        <!-- Sidebar -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-12 text-2xl w-72">
            <p class="text-black dark:text-white text-3xl font-bold mb-6">Welcome, <span class="text-violet-500">{{ auth()->user()->name }}</span></p>

            <div class="flex flex-col space-y-4">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Your profile') }}
                </x-nav-link>

                <x-nav-link href="{{ route('search.index') }}" :active="request()->routeIs('search.index')">
                    {{ __('Check Others') }}
                </x-nav-link>
            </div>
        </div>

        <!-- Page Content -->
        <div class="flex-1 p-6">
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
</div>

@stack('modals')

@livewireScripts
</body>
</html>
