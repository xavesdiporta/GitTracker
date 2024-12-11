<?php

// app/Services/GitHubService.php

namespace App\Services;

use App\Models\User;
use GuzzleHttp\Client;

class GitHubService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.github.com/',
            'verify' => 'C:\Projetos\NOOP\Github-manager\cacert.pem', // Certifique-se de que o caminho aqui esteja correto
        ]);
    }

    public function getUserData($githubUsername)
    {
        $response = $this->client->get("users/{$githubUsername}");
        return json_decode($response->getBody(), true);
    }

    // Função para obter dados detalhados dos repositórios públicos
    public function getPublicReposData($githubUsername)
    {
        // Carregar as cores das linguagens do arquivo colors.json
        $colors = json_decode(file_get_contents(public_path('colors.json')), true);

        // Repositórios públicos
        $response = $this->client->get("users/{$githubUsername}/repos");
        $reposData = json_decode($response->getBody(), true);

        $repoDetails = [];
        foreach ($reposData as $repo) {
            $language = $repo['language'] ?? 'Not specified';
            $colorClass = $colors[$language] ?? 'bg-gray-500'; // Cor da linguagem

            $repoDetails[] = [
                'name' => $repo['name'],
                'description' => $repo['description'],
                'url' => $repo['html_url'],
                'created_at' => $repo['created_at'],
                'updated_at' => $repo['updated_at'],
                'stars' => $repo['stargazers_count'],
                'forks' => $repo['forks_count'],
                'visibility' => $repo['visibility'] ?? 'public',
                'colorClass' => $colorClass,  // Passando a classe de cor
                'downloadlink' => $repo['downloads_url'] ?? null,
            ];
        }

        return $repoDetails;
    }

    // Função para obter dados dos repositórios privados (precisa de um token de acesso)
    public function getPrivateReposData($githubUsername)
    {

        $repoDetails = "0";

        return $repoDetails;
    }

    // Função para obter seguidores, seguidos e estrelas
    public function getFollowersAndStars($githubUsername)
    {
        $response = $this->client->get("users/{$githubUsername}");
        $userData = json_decode($response->getBody(), true);

        return [
            'stars' => $userData['public_repos'] ?? 0, // Atribuir o número de estrelas de acordo com o perfil
            'followers' => $userData['followers'] ?? 0,
            'following' => $userData['following'] ?? 0,
        ];
    }

    // Função para obter achievements (se disponíveis)
    public function getAchievements($githubUsername)
    {
        // A API do GitHub não fornece dados específicos de achievements. Aqui você pode adicionar uma lógica para pegar
        // informações adicionais, se o GitHub fornecer isso no futuro.
        return [];
    }

    public function getRepoReadme($githubUsername)
    {
        try {
            $response = $this->client->get("repos/{$githubUsername}/{$githubUsername}/contents/README.md", [
                'headers' => ['Accept' => 'application/vnd.github.v3.raw'],
            ]);
            return (string)$response->getBody();
        } catch (\Exception $e) {
            return null;
        }
    }

    // Função para atualizar o perfil do usuário
    public function updateProfile(User $user)
    {
        $githubData = $this->getUserData($user->profile->github_username);
        $publicReposData = $this->getPublicReposData($user->profile->github_username);
        $privateReposData = $this->getPrivateReposData($user->profile->github_username);
        $followersAndStars = $this->getFollowersAndStars($user->profile->github_username);
        $achievements = $this->getAchievements($user->profile->github_username);

        // Tentar encontrar um README em um dos repositórios públicos
        $personalizedBio = null;
        foreach ($publicReposData as $repo) {
            if (strtolower($repo['name']) === strtolower($user->profile->github_username)) {
                $personalizedBio = $this->getRepoReadme($user->profile->github_username);
                break;
            }
        }

        // Criar o campo bioprofile com as informações adicionais
        $bioProfile = [
            'pronouns' => $githubData['pronouns'] ?? null, // Aqui você pode adicionar lógica para pegar pronomes
            'country' => $githubData['location'] ?? null,
            'company' => $githubData['company'] ?? null,
            'social_accounts' => $githubData['blog'] ?? null, // Blog ou outras contas sociais
        ];

        // Atualizando o perfil com todos os dados
        $user->profile->update(array_merge(
            [
                'name' => $githubData['name'] ?? null,
                'company' => $githubData['company'] ?? null,
                'location' => $githubData['location'] ?? null,
                'bio' => $personalizedBio ?? null,
                'avatar_url' => $githubData['avatar_url'] ?? null, // Adicionando a URL do avatar
                'bioprofile' => json_encode($bioProfile), // Salvando o campo bioprofile como JSON
                'bioo' => $githubData['bio'] ?? null,
            ],
            [
                'public_repos' => $publicReposData,
                'private_repos' => $privateReposData,
            ],
            $followersAndStars,
            ['achievements' => $achievements]
        ));
    }
}
