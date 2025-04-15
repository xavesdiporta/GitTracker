<div class="max-w-7xl m-auto navbar bg-base-100">
    <div class="navbar-start">
        <div class="dropdown">
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li><a href="#">{{ __('About Us') }}</a></li>
                <li><a href="#">{{ __('Pricing') }}</a></li>
                <li><a href="#">{{ __('How It Works') }}</a></li>
                <li><a href="{{ route('blog.index') }}">{{ __('Blog') }}</a></li>
            </ul>
        </div>
        <a href="/" class="flex flex-row items-center justify-center font-bold text-md">
            <span class="ml-2 flex flex-col items-start">
                    <span class="leading-4 text-secondary">{{ __('Your Startup Name') }}</span>
                </span>
        </a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a href="#">{{ __('About Us') }}</a></li>
            <li><a href="#">{{ __('Pricing') }}</a></li>
            <li><a href="#">{{ __('How It Works') }}</a></li>
            <li><a href="{{ route('blog.index') }}">{{ __('Blog') }}</a></li>
            <li><a href="{{ route('coming-soon') }}">{{ __('Coming Soon') }}</a></li>
        </ul>
    </div>
    <div class="navbar-end">
        <a href="{{ route('login') }}" class="btn btn-secondary">{{ __('Get Started') }}</a>
    </div>
</div>
