<!DOCTYPE html>
<html lang="fr" @class(['dark' => ($appearance ?? 'system') == 'dark']) itemscope itemtype="https://schema.org/WebSite">
    <head>
        {{-- Schema.org LocalBusiness JSON-LD pour SEO Local --}}
        @php
        $ldSchema = [
            '@context' => 'https://schema.org',
            '@type'    => 'ProfessionalService',
            '@id'      => url('/') . '#organization',
            'name'        => 'Web Discovery',
            'description' => 'Création de sites web vitrine et applications SaaS sur mesure pour artisans, commerçants et entreprises. Développement web avec Laravel et Vue.js.',
            'url'   => url('/'),
            'logo'  => [
                '@type'  => 'ImageObject',
                'url'    => url('asset/logo.png'),
                'width'  => 512,
                'height' => 512,
            ],
            'image' => url('asset/logo.png'),
            'email' => 'limacedric@hotmail.fr',
            'address' => [
                '@type'           => 'PostalAddress',
                'addressLocality' => 'Pau',
                'addressRegion'   => 'Nouvelle-Aquitaine',
                'postalCode'      => '64000',
                'addressCountry'  => 'FR',
            ],
            'geo' => [
                '@type'     => 'GeoCoordinates',
                'latitude'  => 43.2951,
                'longitude' => -0.3708,
            ],
            'areaServed' => [
                ['@type' => 'City', 'name' => 'Pau'],
                ['@type' => 'City', 'name' => 'Billère'],
                ['@type' => 'City', 'name' => 'Lescar'],
                ['@type' => 'City', 'name' => 'Lons'],
                ['@type' => 'City', 'name' => 'Jurançon'],
                ['@type' => 'City', 'name' => 'Bizanos'],
                ['@type' => 'AdministrativeArea', 'name' => 'Pyrénées-Atlantiques'],
                ['@type' => 'AdministrativeArea', 'name' => 'Nouvelle-Aquitaine'],
            ],
            'serviceType' => [
                'Création de site web',
                'Création de site vitrine',
                'Développement web',
                'Développement d\'application SaaS',
                'Référencement local (SEO)',
            ],
            'knowsAbout' => ['Laravel', 'Vue.js', 'SEO local', 'Site vitrine', 'Application web'],
            'priceRange' => 'Sur devis',
            'openingHoursSpecification' => [[
                '@type'      => 'OpeningHoursSpecification',
                'dayOfWeek'  => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                'opens'      => '09:00',
                'closes'     => '18:00',
            ]],
            'sameAs' => ['https://www.facebook.com/profile.php?id=61587226977928'],
        ];
        @endphp
        <script type="application/ld+json">{!! json_encode($ldSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>

        {{-- Données structurées spécifiques à la page (FAQ, BlogPosting, service…) --}}
        {{-- Rendues côté serveur pour être vues par Google dès le premier crawl. --}}
        @php
            $pageSchemas = data_get($page ?? [], 'props.structuredData');
        @endphp
        @if (!empty($pageSchemas))
            @foreach ((array_is_list($pageSchemas) ? $pageSchemas : [$pageSchemas]) as $schema)
                <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
            @endforeach
        @endif

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

        {{-- description / keywords / canonical / og / twitter sont gérés par page --}}
        {{-- via le composant SEO.vue (avec head-key) afin d'éviter les doublons. --}}

        {{-- Geo Meta Tags pour SEO Local (constants pour tout le site) --}}
        <meta name="geo.region" content="FR-64" />
        <meta name="geo.placename" content="Pau" />
        <meta name="geo.position" content="43.2951;-0.3708" />
        <meta name="ICBM" content="43.2951, -0.3708" />

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.bunny.net" crossorigin />
        <link rel="dns-prefetch" href="https://fonts.bunny.net" />
        <link rel="preload" href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'" />
        <noscript><link rel="stylesheet" href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" /></noscript>
        <meta name="facebook-domain-verification" content="05fsscl4fjxue4zzvwo0fp7timx9fd" />

        {{-- Open Graph / Twitter : gérés par page via SEO.vue --}}

        {{-- Humans.txt for SEO --}}
        <link rel="author" href="/humans.txt" />

        @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        @inertiaHead
    </head>

    <!-- Google Consent Mode v2 — defaults MUST be set before gtag.js loads -->
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}

  gtag('consent', 'default', {
    analytics_storage:   'denied',
    ad_storage:          'denied',
    ad_user_data:        'denied',
    ad_personalization:  'denied',
    wait_for_update:     500
  });
</script>

    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-D155MPD2S7"></script>
<script>
  gtag('js', new Date());
  gtag('config', 'G-D155MPD2S7');

  // Restore consent if the user has already accepted on a previous visit
  try {
    if (localStorage.getItem('gdpr-consent') === 'accepted') {
      gtag('consent', 'update', {
        analytics_storage:  'granted',
        ad_storage:         'granted',
        ad_user_data:       'granted',
        ad_personalization: 'granted'
      });
    }
  } catch (e) {}
</script>

    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
