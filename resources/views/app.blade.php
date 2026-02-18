<!DOCTYPE html>
<html lang="fr" @class(['dark' => ($appearance ?? 'system') == 'dark']) itemscope itemtype="https://schema.org/WebSite">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Inline script to detect system dark mode preference and apply it immediately --}}
        <script>
            (function() {
                const appearance = '{{ $appearance ?? "system" }}';

                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                    if (prefersDark) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        {{-- Inline style to set the HTML background color based on our theme in app.css --}}
        <style>
            html {
                background-color: oklch(1 0 0);
            }

            html.dark {
                background-color: oklch(0.145 0 0);
            }
        </style>

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.bunny.net" crossorigin />
        <link rel="dns-prefetch" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet" />
        <meta name="facebook-domain-verification" content="05fsscl4fjxue4zzvwo0fp7timx9fd" />
        
        {{-- Open Graph Meta Tags pour Facebook --}}
        <meta property="og:title" content="{{ config('app.name', 'WebDiscovery') }}" />
        <meta property="og:description" content="WebDiscovery - Agence digitale spécialisée dans la création de sites web et le développement d'applications sur mesure." />
        <meta property="og:image" content="{{ asset('asset/logo.png') }}" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="{{ config('app.name', 'WebDiscovery') }}" />
        <meta property="og:locale" content="fr_FR" />
        
        {{-- Twitter Card Meta Tags --}}
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="{{ config('app.name', 'WebDiscovery') }}" />
        <meta name="twitter:description" content="WebDiscovery - Agence digitale spécialisée dans la création de sites web et le développement d'applications sur mesure." />
        <meta name="twitter:image" content="{{ asset('asset/logo.png') }}" />
        
        {{-- Humans.txt for SEO --}}
        <link rel="author" href="/humans.txt" />

        @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
