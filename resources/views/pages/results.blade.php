<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl mb-6 text-center">Repositories for {{ $githubUsername }}</h1>

        @if(count($repoDetails) > 0)
            <ul class="space-y-4 max-w-4xl mx-auto">
                @foreach ($repoDetails as $repo)
                    <li class="p-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 relative">
                        <div class="flex justify-between items-center mb-2">
                            <!-- Repositório Nome e Visibilidade -->
                            <div class="flex items-center">
                                <a href="{{ $repo['url'] }}" class="text-lg font-semibold text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 truncate w-full">{{ $repo['name'] }}</a>
                                <span class="text-xs text-gray-500 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 py-0.5 px-2 ml-2 rounded-md">{{ $repo['visibility'] }}</span>
                            </div>
                            <!-- Estrelas no canto superior direito -->
                            <div class="absolute top-2 right-2 bg-gray-100 dark:bg-gray-600 text-xs text-gray-700 dark:text-gray-300 py-1 px-2 rounded-full">
                                <strong>{{ $repo['stars'] }}</strong> ⭐
                            </div>
                            <div class="flex mt-6 bg-gray-100 dark:bg-gray-600 text-xs text-gray-700 dark:text-gray-300 py-1 px-2 rounded-full">
                                <a href={{ $repo['downloadlink'] }}>
                                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <!-- Linguagem, Forks e Última atualização -->
                        <div class="flex flex-wrap text-sm text-gray-500 dark:text-gray-300">
                            <span class="w-2.5 h-2.5 mr-1 mt-0.5 rounded-full" style="background-color: {{ $repo['colorClass'] }}"></span>
                            <p>{{ $repo['language'] ?? 'Not specified' }}</p>
                            <p class="text-xs ml-6 mt-0.5 text-gray-500 dark:text-gray-300"><strong>Last updated:</strong> {{ \Carbon\Carbon::parse($repo['updated_at'])->diffForHumans() }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600 dark:text-gray-400 text-center">No repositories available for this user.</p>
        @endif
    </div>
</x-app-layout>
