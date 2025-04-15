<x-app-layout>
    <div class="flex flex-col min-h-screen">
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <main class="max-w-7xl mx-auto">
                <!-- Profile Header -->
                <div class="rounded-lg mb-6">
                    <div class="flex items-start p-6 rounded-b-lg">
                        <div class="flex-none w-2/6 flex flex-col items-center">
                            <img class="w-40 h-40 rounded-full" src="{{ auth()->user()->profile->avatar_url }}" alt="{{ auth()->user()->profile->github_username }}">
                            <div class="mt-4 text-center">
                                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ auth()->user()->name }}</h1>
                                <p class="text-gray-600 dark:text-gray-400">{{ auth()->user()->profile->github_username }}</p>
                                <div class="mt-4 text-left space-x-2 flex">
                                    <p class="text-md text-gray-400 dark:text-gray-200">{{ auth()->user()->profile->bioo ?? 'N/A' }}</p>
                                </div>
                                <div class="mt-4 text-left space-x-2 flex">
                                    <p class="text-sm text-gray-600 dark:text-gray-400"><strong>Followers:</strong> {{ auth()->user()->profile->followers ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400"><strong>Following:</strong> {{ auth()->user()->profile->following ?? 'N/A' }}</p>
                                </div>
                                <div class="flex space-x-2 mt-2">

                                    <p class="text-sm text-gray-600 dark:text-gray-400"> {{ auth()->user()->profile->company ?? 'N/A' }}</p>
                                </div>
                                <div class="flex space-x-2 mt-2">

                                    <p class="text-sm text-gray-600 dark:text-gray-400"> {{ auth()->user()->profile->location ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow w-4/6 rounded-lg border-2 border-dashed border-gray-100 dark:border-gray-400">
                            <div class="my-4 flex items-center justify-center">
                                {!! auth()->user()->profile->bio !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Spacer -->
                <div class="w-full h-6 bg-gray-900 "></div>

                <!-- Content Sections -->
                <div class="rounded-lg shadow p-6">
                    <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Repositories</h2>
                    @php
                        $publicRepos = json_decode(auth()->user()->profile->public_repos, true);
                    @endphp
                    @if(is_array($publicRepos) && count($publicRepos) > 0)
                        <ul>
                            @foreach ($publicRepos as $repo)
                                <li class="mb-4 p-4 bg-white dark:bg-gray-800 rounded-lg relative">
                                    <div class="flex justify-between items-center mb-2">
                                        <!-- Repositório Nome e Visibilidade -->
                                        <div class="flex items-center">
                                            <a href="{{ $repo['url'] }}" class="text-xl font-semibold text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 truncate w-full">{{ $repo['name'] }}</a>
                                            <span class="text-xs text-gray-500 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 py-0.5 px-2 ml-2 rounded-md">{{ $repo['visibility'] }}</span>
                                        </div>
                                        <!-- Estrelas no canto superior direito -->
                                        <div class="absolute top-2 right-3 bg-gray-100 dark:bg-gray-600 text-xs text-gray-700 dark:text-gray-300 py-1 px-2 rounded-full">
                                            <strong>{{ $repo['stars'] }}</strong> ⭐
                                        </div>
                                        <div class="flex mt-6 bg-gray-100 dark:bg-gray-600 text-xs text-gray-700 dark:text-gray-300 py-1 px-2 rounded-full">
                                            <!-- <a href="">
                                                <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01"/>
                                                </svg>
                                            </a> -->
                                        </div>
                                    </div>

                                    <!-- Linguagem, Forks e Última atualização -->
                                    <div class="flex flex-wrap text-sm text-gray-500 dark:text-gray-300">
                                        <p>{{ $repo['language'] ?? 'Not specified' }}</p>
                                        <p class="text-xs ml-6 mt-0.5 text-gray-500 dark:text-gray-300"><strong>Last updated:</strong> {{ \Carbon\Carbon::parse($repo['updated_at'])->diffForHumans() }}</p>
                                    </div>
                                </li>
                                @if(!$loop->last)
                                    <hr class="border-t border-gray-200 dark:border-gray-700">
                                @endif
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-600 dark:text-gray-400">No repositories available.</p>
                    @endif
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
