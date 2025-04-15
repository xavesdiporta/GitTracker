<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl mb-6 text-center">Search GitHub Repositories</h1>
        <form action="{{ route('search.perform') }}" method="GET" class="mb-4 flex justify-center">
            @csrf
            <div class="relative w-full sm:w-2/3 md:w-1/2 lg:w-1/3 flex">
                <input type="text" name="github_username" class="border-t-2 border-l-2 border-b-2 border-r-0 border-gray-600 p-2 pl-10 pr-10 rounded-l w-full text-gray-900 dark:text-white bg-gray-800 focus:outline-none" placeholder="Type the username to search" value="{{ request('github_username') }}">
                <button type="submit" class="bg-gray-800 text-gray-900 dark:text-gray-500 py-2 px-4 border-t-2 border-r-2 border-b-2 border-gray-600 rounded-r">Search</button>
            </div>
        </form>

        @if(session('recent_searches'))
            <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md mt-6 w-full sm:w-2/3 md:w-1/2 lg:w-2/5 mx-auto">
                <h2 class="text-lg text-gray-400 mb-3 text-center">Recent Searches</h2>
                <ul class="space-y-1 text-sm">
                    @foreach(session('recent_searches') as $recent)
                        <li>
                            <a href="{{ route('search.perform', ['github_username' => $recent]) }}" class="flex items-center text-gray-900 dark:text-white hover:text-blue-500 dark:hover:text-blue-400">
                                <svg class="w-5 h-5 text-gray-500 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                                </svg>
                                {{ $recent }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</x-app-layout>
