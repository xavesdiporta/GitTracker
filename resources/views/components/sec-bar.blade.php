<div class="flex h-screen">

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-12 text-2xl w-72">
        <p class="text-black dark:text-white text-2xl mb-6">Welcome, {{ auth()->user()->name }}</p>

        <div class="flex flex-col space-y-4">
            <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Your profile') }}
            </x-nav-link>

            <x-nav-link href="#">
                {{ __('Check Others') }}
            </x-nav-link>
        </div>
    </div>
</div>
