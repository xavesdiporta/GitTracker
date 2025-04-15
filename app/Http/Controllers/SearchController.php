<?php

// app/Http/Controllers/SearchController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SearchController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function search(Request $request)
    {
        $request->validate([
            'github_username' => 'required|string|max:255',
        ]);

        $githubUsername = $request->input('github_username');

        // Adiciona a pesquisa à sessão
        $recentSearches = session()->get('recent_searches', []);
        if (!in_array($githubUsername, $recentSearches)) {
            array_unshift($recentSearches, $githubUsername);
            if (count($recentSearches) > 5) {
                array_pop($recentSearches); // Mantém no máximo 5 pesquisas recentes
            }
            session()->put('recent_searches', $recentSearches);
        }

        $client = new Client();
        $response = $client->get("https://api.github.com/users/{$githubUsername}/repos");
        $reposData = json_decode($response->getBody(), true);

        $colors = json_decode(file_get_contents(public_path('colors.json')), true);

        $repoDetails = [];
        foreach ($reposData as $repo) {
            $repoDetails[] = [
                'name' => $repo['name'],
                'description' => $repo['description'],
                'url' => $repo['html_url'],
                'language' => $repo['language'],
                'colorClass' => $colors[$repo['language']] ?? '#000000', // Cor da linguagem
                'created_at' => $repo['created_at'],
                'updated_at' => $repo['updated_at'],
                'stars' => $repo['stargazers_count'],
                'forks' => $repo['forks_count'],
                'visibility' => $repo['private'] ? 'Private' : 'Public',
                'downloadlink' => $repo['downloads_url'] ?? null,
            ];
        }

        return view('pages.results', compact('repoDetails', 'githubUsername'));
    }

}

