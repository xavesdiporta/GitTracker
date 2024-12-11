<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('logo.ico') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <style>
            /* Rain animation */
            /* Rain animation */
            @keyframes rainFall {
                0% {
                    transform: translateY(-100vh) rotate(45deg);
                }
                100% {
                    transform: translateY(100vh) rotate(45deg);
                }
            }

            /* Rain Icon Styling */
            .rain-icon {
                position: absolute;
                font-size: 1.5rem;
                animation: rainFall linear infinite;
                opacity: 0.8;
                z-index: 100; /* Mantém o z-index do ícone da chuva */
            }

            /* Customizing animation speeds and durations for different icons */
            .rain-icon:nth-child(odd) {
                animation-duration: 3s;
            }

            .rain-icon:nth-child(even) {
                animation-duration: 5s;
            }

            /* Container for rain, set behind the authentication card */
            #rain {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
                pointer-events: none;
                overflow: hidden;
                z-index: 10; /* Rain container stays behind the authentication card */
            }

            /* Styling for the authentication card */
            .authentication-card {
                position: relative; /* Ensures the card stays in its natural flow */
                z-index: 50; /* Card stays above the rain */
            }

            @media screen and (max-width: 640px) {
                .rain-icon {
                    font-size: 1rem;
                }
            }

        </style>
    </head>
    <body>
        <div class="font-sans text-gray-900 dark:text-gray-100 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts
        <script>
            // Função para criar e animar os ícones
            document.addEventListener('DOMContentLoaded', function () {
                const rainContainer = document.getElementById('rain');
                const icons = ['🔍', '🐙']; // Ícones para a chuva (lupa e símbolo do GitHub)
                const numIcons = 40; // Número de ícones na chuva

                for (let i = 0; i < numIcons; i++) {
                    const icon = document.createElement('div');
                    const randomIcon = icons[Math.floor(Math.random() * icons.length)];
                    const randomPositionX = Math.random() * 100; // Posição horizontal aleatória
                    const randomDelay = Math.random() * 3; // Atraso na animação
                    const randomSize = Math.random() * (3 - 1) + 1; // Tamanho do ícone aleatório

                    icon.classList.add('rain-icon');
                    icon.style.left = `${randomPositionX}vw`;
                    icon.style.animationDelay = `${randomDelay}s`;
                    icon.style.fontSize = `${randomSize}rem`;
                    icon.innerText = randomIcon;

                    rainContainer.appendChild(icon);
                }
            });
        </script>
    </body>
</html>
