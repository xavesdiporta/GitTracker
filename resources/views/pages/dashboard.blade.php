<x-app-layout>
    <div class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <main class="max-w-7xl mx-auto">
                <!-- Profile Header -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
                    <div class="flex items-center grid grid-cols-2 space-x-4">
                        <div>
                            <img class="w-24 h-24 rounded-full" src="{{ auth()->user()->profile->avatar_url }}" alt="{{ auth()->user()->profile->github_username }}">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ auth()->user()->name }}</h1>
                                <p class="text-gray-600 dark:text-gray-400">{{ auth()->user()->profile->github_username }}</p>

                            </div>
                        </div>
                        <div>
                            <div class="mt-4">
                                {!! auth()->user()->profile->bio !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow mb-6">
                    <nav class="flex space-x-4 p-4 border-b border-gray-200 dark:border-gray-700">
                        <a href="#" class="text-gray-900 dark:text-white px-3 py-2 rounded-md text-sm font-medium">Overview</a>
                        <a href="#" class="text-gray-600 dark:text-gray-400 px-3 py-2 rounded-md text-sm font-medium">Repositories</a>
                        <a href="#" class="text-gray-600 dark:text-gray-400 px-3 py-2 rounded-md text-sm font-medium">Projects</a>
                        <a href="#" class="text-gray-600 dark:text-gray-400 px-3 py-2 rounded-md text-sm font-medium">Stars</a>
                        <a href="#" class="text-gray-600 dark:text-gray-400 px-3 py-2 rounded-md text-sm font-medium">Followers</a>
                        <a href="#" class="text-gray-600 dark:text-gray-400 px-3 py-2 rounded-md text-sm font-medium">Following</a>
                    </nav>
                </div>

                <!-- Content Sections -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <!-- Repositories Section -->
                    <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Repositories</h2>
                    @php
                        $publicRepos = json_decode(auth()->user()->profile->public_repos, true);
                    @endphp
                    @if(is_array($publicRepos))
                        <ul>
                            @foreach ($publicRepos as $repo)
                                <li class="mb-4">
                                    <a href="{{ $repo['url'] }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $repo['name'] }}</a>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $repo['description'] ?? 'No description available' }}</p>
                                    <p class="text-gray-600 dark:text-gray-400">Stars: {{ $repo['stars'] }}</p>
                                    <p class="text-gray-600 dark:text-gray-400">Forks: {{ $repo['forks'] }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-600 dark:text-gray-400">No repositories available.</p>
                    @endif
                </div>

                <!-- Stars, Followers, Following Section -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mt-6">
                    <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Statistics</h2>
                    <ul>
                        <li class="mb-4">
                            <p class="text-gray-600 dark:text-gray-400">Stars: {{ auth()->user()->profile->stars ?? 'N/A' }}</p>
                        </li>
                        <li class="mb-4">
                            <p class="text-gray-600 dark:text-gray-400">Followers: {{ auth()->user()->profile->followers ?? 'N/A' }}</p>
                        </li>
                        <li class="mb-4">
                            <p class="text-gray-600 dark:text-gray-400">Following: {{ auth()->user()->profile->following ?? 'N/A' }}</p>
                        </li>
                    </ul>
                </div>

                <!-- Achievements Section -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mt-6">
                    <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Achievements</h2>
                    <p class="text-gray-600 dark:text-gray-400">Achievements data is currently not available.</p>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
