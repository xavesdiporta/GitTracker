<x-guest-layout>
    <div class="flex h-screen">
        <!-- Coluna da esquerda com o formulário -->
        <div id="rain" class="absolute top-0 left-0 w-full h-full pointer-events-none z-50"></div>

        <div class="w-2/3 bg-gradient-to-r from-violet-500 via-violet-600 to-gray-00"></div>

        <!-- Coluna da direita com o fundo roxo -->
        <div class="w-1/3 flex items-center justify-center">
            <x-authentication-card>
                <x-slot name="logo">
                    <x-authentication-card-logo />
                </x-slot>

                <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-button class="ms-4">
                        {{ __('Log in') }}
                    </x-button>
                </div>
                <div class="flex flex-col items-center justify-end mt-4">
                    <p class="text-base">{{ __('Do not have an account?') }}</p>
                    <a href="{{ route('register') }}" class="ms-4 flex btn btn-ghost text-info">
                        {{ __('Register') }}
                    </a>
                </div>
            </form>
        </x-authentication-card>
    </div>
    </div>
</x-guest-layout>
