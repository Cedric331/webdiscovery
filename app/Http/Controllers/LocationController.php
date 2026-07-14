<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class LocationController extends Controller
{
    /**
     * Pages de destination géographiques (SEO local).
     *
     * Chaque ville dispose d'un contenu RÉELLEMENT unique (contexte local,
     * quartiers/zones, FAQ) pour éviter le schéma des « pages satellites »
     * (doorway pages) que Google pénalise.
     */
    private function getLocations(): array
    {
        return [
            'pau' => [
                'slug' => 'creation-site-web-pau',
                'city' => 'Pau',
                'postalCode' => '64000',
                'latitude' => 43.2951,
                'longitude' => -0.3708,
                'title' => 'Création de Site Web à Pau (64) | Agence Web Pau',
                'description' => "Création de site web à Pau : sites vitrine et applications sur mesure pour artisans, commerçants et entreprises paloises. Design moderne, référencement local optimisé. Devis gratuit.",
                'h1' => 'Création de Site Web à Pau',
                'keywords' => 'création site web Pau, agence web Pau, création site internet Pau, site vitrine Pau, développeur web Pau, référencement local Pau',
                'intro' => "Vous êtes artisan, commerçant ou dirigeant d'entreprise à Pau et vos clients potentiels ne vous trouvent pas sur internet ? Nous créons des sites web modernes, rapides et pensés pour le référencement local afin de vous rendre visible auprès des Palois qui recherchent vos services.",
                'localContext' => "Pau, préfecture des Pyrénées-Atlantiques, concentre un tissu dense de commerces, d'artisans et de professions libérales, du centre-ville (Hédas, rue Serviez, boulevard des Pyrénées) aux zones d'activité comme Induspal ou le quartier de la gare. Dans ce marché concurrentiel, un site bien référencé fait souvent la différence entre un client qui vous appelle et un client qui appelle votre concurrent. Nous connaissons le marché palois et concevons chaque site pour capter les recherches locales du type « votre métier + Pau ».",
                'zones' => ['Pau centre', 'Billère', 'Lescar', 'Lons', 'Jurançon', 'Bizanos', 'Gan', 'Idron'],
                'relatedLinks' => [
                    ['label' => 'Site web pour restaurant à Pau', 'url' => '/creation-site-web-restaurant-pau'],
                    ['label' => 'Site web pour plombier à Pau', 'url' => '/creation-site-web-plombier-pau'],
                    ['label' => 'Site web pour électricien à Pau', 'url' => '/creation-site-web-electricien-pau'],
                    ['label' => 'Site web pour coiffeur à Pau', 'url' => '/creation-site-web-coiffeur-pau'],
                    ['label' => 'Site web pour photographe à Pau', 'url' => '/creation-site-web-photographe-pau'],
                ],
                'faq' => [
                    [
                        'question' => 'Travaillez-vous avec des entreprises basées à Pau ?',
                        'answer' => "Oui, nous sommes basés à Pau et accompagnons en priorité les professionnels de la ville et de son agglomération. La proximité nous permet d'échanger facilement et de bien comprendre votre marché local.",
                    ],
                    [
                        'question' => 'Mon site apparaîtra-t-il dans les recherches « à Pau » ?',
                        'answer' => "C'est précisément notre objectif. Nous optimisons la structure, les contenus et les données locales (Schema.org, cohérence avec votre fiche Google) pour vous positionner sur les requêtes locales liées à votre activité à Pau et alentour.",
                    ],
                    [
                        'question' => "Combien coûte la création d'un site web à Pau ?",
                        'answer' => "Un site vitrine professionnel démarre à partir de 500€. Le tarif dépend du nombre de pages et des fonctionnalités (galerie, formulaire de devis, réservation…). Un devis gratuit et personnalisé est établi après analyse de vos besoins.",
                    ],
                ],
            ],
            'bayonne' => [
                'slug' => 'creation-site-web-bayonne',
                'city' => 'Bayonne',
                'postalCode' => '64100',
                'latitude' => 43.4929,
                'longitude' => -1.4748,
                'title' => 'Création de Site Web à Bayonne (64) | Agence Web Pays Basque',
                'description' => "Création de site web à Bayonne et sur la côte basque : sites vitrine et sur mesure pour commerçants, artisans et entreprises. Design moderne et référencement local. Devis gratuit.",
                'h1' => 'Création de Site Web à Bayonne',
                'keywords' => 'création site web Bayonne, agence web Bayonne, site internet Bayonne, site vitrine Pays Basque, développeur web Bayonne',
                'intro' => "À Bayonne, la concurrence entre commerces et artisans est forte, notamment dans le tourisme et la restauration. Un site web professionnel et bien référencé vous permet de sortir du lot et d'attirer une clientèle locale comme de passage.",
                'localContext' => "Cœur du Pays Basque intérieur et de l'agglomération BAB (Bayonne-Anglet-Biarritz), Bayonne mêle Grand et Petit Bayonne, quartiers commerçants animés et forte affluence touristique, en particulier durant les Fêtes. Les commerces, restaurants, hôtels et artisans y ont tout à gagner d'une présence en ligne soignée, capable de capter aussi bien la clientèle basque que les visiteurs qui recherchent un service « à Bayonne ».",
                'zones' => ['Bayonne', 'Anglet', 'Biarritz', 'Boucau', 'Saint-Pierre-d\'Irube', 'Mouguerre', 'Bidart'],
                'faq' => [
                    [
                        'question' => 'Intervenez-vous sur toute la côte basque ?',
                        'answer' => "Oui. Bien que basés à Pau, nous accompagnons les professionnels de Bayonne, Anglet, Biarritz et de l'ensemble du Pays Basque. Les échanges se font à distance ou sur place selon vos préférences.",
                    ],
                    [
                        'question' => 'Mon site peut-il être bilingue (français / basque) ?',
                        'answer' => "Oui, nous pouvons concevoir un site multilingue, y compris en basque, ce qui est un vrai atout pour ancrer votre image locale et toucher toute la clientèle bayonnaise.",
                    ],
                    [
                        'question' => "Combien coûte un site web à Bayonne ?",
                        'answer' => "Un site vitrine démarre à partir de 500€, selon le nombre de pages et les fonctionnalités souhaitées. Nous établissons un devis gratuit et détaillé après un premier échange sur votre projet.",
                    ],
                ],
            ],
            'anglet' => [
                'slug' => 'creation-site-web-anglet',
                'city' => 'Anglet',
                'postalCode' => '64600',
                'latitude' => 43.4832,
                'longitude' => -1.5145,
                'title' => 'Création de Site Web à Anglet (64) | Agence Web Côte Basque',
                'description' => "Création de site web à Anglet : sites vitrine et sur mesure pour commerçants, artisans et entreprises de la côte basque. Design moderne, SEO local. Devis gratuit.",
                'h1' => 'Création de Site Web à Anglet',
                'keywords' => 'création site web Anglet, agence web Anglet, site internet Anglet, site vitrine côte basque, développeur web Anglet',
                'intro' => "Entre Bayonne et Biarritz, Anglet est une ville dynamique où commerces, activités de plein air et services de proximité se disputent l'attention des clients. Un site web performant vous aide à capter cette clientèle locale et saisonnière.",
                'localContext' => "Anglet, avec ses plages de la Chambre d'Amour, la Forêt de Pignada et des pôles commerciaux comme BAB2, attire une clientèle mêlant résidents, sportifs et touristes. Les commerçants, loueurs, écoles de surf, restaurants et artisans locaux bénéficient énormément d'un site optimisé pour les recherches géolocalisées, souvent effectuées depuis un mobile par des clients à proximité immédiate.",
                'zones' => ['Anglet', 'Bayonne', 'Biarritz', 'Bidart', 'Boucau'],
                'faq' => [
                    [
                        'question' => 'Mon site sera-t-il bien affiché sur mobile ?',
                        'answer' => "Absolument. Tous nos sites sont responsive et optimisés pour le mobile, ce qui est essentiel à Anglet où de nombreuses recherches locales se font sur smartphone, souvent à proximité de votre établissement.",
                    ],
                    [
                        'question' => "Puis-je intégrer une réservation ou une prise de contact rapide ?",
                        'answer' => "Oui, nous intégrons formulaires de contact, demandes de devis ou systèmes de réservation adaptés à votre activité (cours, locations, prestations…).",
                    ],
                    [
                        'question' => "Combien coûte un site web à Anglet ?",
                        'answer' => "À partir de 500€ pour un site vitrine. Le tarif final dépend de vos besoins précis ; le devis est gratuit et sans engagement.",
                    ],
                ],
            ],
            'biarritz' => [
                'slug' => 'creation-site-web-biarritz',
                'city' => 'Biarritz',
                'postalCode' => '64200',
                'latitude' => 43.4832,
                'longitude' => -1.5586,
                'title' => 'Création de Site Web à Biarritz (64) | Agence Web Côte Basque',
                'description' => "Création de site web à Biarritz : sites vitrine élégants et sur mesure pour hôtels, restaurants, commerces et professionnels. Design premium et référencement local. Devis gratuit.",
                'h1' => 'Création de Site Web à Biarritz',
                'keywords' => 'création site web Biarritz, agence web Biarritz, site internet Biarritz, site vitrine Biarritz, développeur web Biarritz',
                'intro' => "Biarritz est une ville à l'image haut de gamme où l'exigence esthétique compte. Votre site web doit refléter ce niveau de qualité tout en étant parfaitement référencé pour capter une clientèle locale et internationale.",
                'localContext' => "Station balnéaire réputée, Biarritz vit du tourisme, de l'hôtellerie, de la gastronomie et d'un commerce de qualité, du quartier des Halles à la Grande Plage. La clientèle y est souvent exigeante et internationale : un site web au design soigné, rapide, multilingue et bien positionné sur Google est un investissement décisif pour les hôtels, restaurants, boutiques et prestataires de la ville.",
                'zones' => ['Biarritz', 'Anglet', 'Bidart', 'Bayonne', 'Guéthary'],
                'faq' => [
                    [
                        'question' => 'Proposez-vous des sites au design premium ?',
                        'answer' => "Oui. Nous accordons un soin particulier au design et à l'expérience utilisateur, ce qui correspond parfaitement au positionnement haut de gamme attendu par de nombreux établissements biarrots.",
                    ],
                    [
                        'question' => 'Un site multilingue est-il possible pour la clientèle internationale ?',
                        'answer' => "Oui, nous concevons des sites multilingues (français, anglais, espagnol…), un atout majeur à Biarritz pour toucher la clientèle touristique internationale.",
                    ],
                    [
                        'question' => "Combien coûte un site web à Biarritz ?",
                        'answer' => "À partir de 500€ pour un site vitrine. Pour les projets premium ou multilingues, un devis personnalisé et gratuit est établi selon vos besoins.",
                    ],
                ],
            ],
            'oloron-sainte-marie' => [
                'slug' => 'creation-site-web-oloron-sainte-marie',
                'city' => 'Oloron-Sainte-Marie',
                'postalCode' => '64400',
                'latitude' => 43.1936,
                'longitude' => -0.6103,
                'title' => 'Création de Site Web à Oloron-Sainte-Marie (64) | Agence Web Béarn',
                'description' => "Création de site web à Oloron-Sainte-Marie : sites vitrine et sur mesure pour artisans, commerçants et entreprises du Haut-Béarn. Référencement local optimisé. Devis gratuit.",
                'h1' => 'Création de Site Web à Oloron-Sainte-Marie',
                'keywords' => 'création site web Oloron, agence web Oloron-Sainte-Marie, site internet Oloron, site vitrine Béarn, développeur web Oloron',
                'intro' => "À Oloron-Sainte-Marie, beaucoup d'artisans et de commerçants n'ont pas encore de site web performant : c'est une réelle opportunité de vous démarquer face à une concurrence en ligne encore limitée.",
                'localContext' => "Deuxième ville du Béarn, Oloron-Sainte-Marie est un pôle économique du Haut-Béarn, entre patrimoine (quartier Sainte-Croix, Sainte-Marie) et savoir-faire local. La concurrence numérique y est plus faible qu'à Pau ou sur la côte : un site bien conçu et bien référencé peut donc rapidement vous placer en tête des recherches locales pour votre métier, un avantage stratégique pour capter les clients d'Oloron et des vallées d'Aspe, d'Ossau et de Barétous.",
                'zones' => ['Oloron-Sainte-Marie', 'Gurmençon', 'Bidos', 'Ledeuix', 'Vallée d\'Aspe', 'Vallée d\'Ossau'],
                'faq' => [
                    [
                        'question' => 'Est-ce vraiment utile d\'avoir un site dans une ville comme Oloron ?',
                        'answer' => "Oui, et c'est même souvent plus rentable qu'en grande ville : la concurrence en ligne y étant plus faible, il est plus facile et rapide d'apparaître en tête des recherches locales pour votre activité.",
                    ],
                    [
                        'question' => 'Couvrez-vous les vallées autour d\'Oloron ?',
                        'answer' => "Oui, nous accompagnons les professionnels d'Oloron-Sainte-Marie et des vallées environnantes (Aspe, Ossau, Barétous), avec des sites pensés pour capter les recherches sur toute cette zone.",
                    ],
                    [
                        'question' => "Combien coûte un site web à Oloron-Sainte-Marie ?",
                        'answer' => "À partir de 500€ pour un site vitrine, avec un devis gratuit adapté à la taille de votre activité et à vos besoins.",
                    ],
                ],
            ],
            'orthez' => [
                'slug' => 'creation-site-web-orthez',
                'city' => 'Orthez',
                'postalCode' => '64300',
                'latitude' => 43.4906,
                'longitude' => -0.7699,
                'title' => 'Création de Site Web à Orthez (64) | Agence Web Béarn',
                'description' => "Création de site web à Orthez : sites vitrine et sur mesure pour artisans, commerçants et entreprises du Béarn des gaves. Référencement local optimisé. Devis gratuit.",
                'h1' => 'Création de Site Web à Orthez',
                'keywords' => 'création site web Orthez, agence web Orthez, site internet Orthez, site vitrine Béarn, développeur web Orthez',
                'intro' => "À Orthez, un site web professionnel et bien référencé vous permet de toucher une clientèle locale fidèle tout en captant les nouveaux habitants et les clients de passage sur l'axe Pau–Bayonne.",
                'localContext' => "Ville d'art et d'histoire du Béarn des gaves, Orthez bénéficie d'une position stratégique sur l'axe entre Pau et la côte basque. Son tissu de commerces, d'artisans et de PME profite d'une présence en ligne solide pour se rendre visible au-delà du centre historique (Pont Vieux, tour Moncade). Comme dans le reste du Béarn, la concurrence numérique modérée permet d'obtenir de bons positionnements locaux avec un site de qualité.",
                'zones' => ['Orthez', 'Sallespisse', 'Baigts-de-Béarn', 'Sault-de-Navailles', 'Puyoô', 'Salies-de-Béarn'],
                'faq' => [
                    [
                        'question' => 'Pouvez-vous m\'aider à être visible au-delà d\'Orthez ?',
                        'answer' => "Oui, nous optimisons votre site pour Orthez et les communes voisines du Béarn des gaves, afin d'élargir votre zone de visibilité selon votre zone d'intervention réelle.",
                    ],
                    [
                        'question' => 'Existe-t-il des aides pour financer mon site ?',
                        'answer' => "Selon votre situation, des dispositifs comme France Num peuvent aider à la digitalisation. Nous vous orientons sur les possibilités adaptées à votre entreprise.",
                    ],
                    [
                        'question' => "Combien coûte un site web à Orthez ?",
                        'answer' => "À partir de 500€ pour un site vitrine. Le devis est gratuit et établi en fonction de vos besoins précis.",
                    ],
                ],
            ],
        ];
    }

    public function show(string $location)
    {
        $locations = $this->getLocations();

        if (! isset($locations[$location])) {
            abort(404);
        }

        $data = $locations[$location];

        $structuredData = [
            [
                '@context' => 'https://schema.org',
                '@type' => 'LocalBusiness',
                'name' => 'Web Discovery',
                'description' => $data['description'],
                'url' => url('/'.$data['slug']),
                'image' => url('asset/logo.png'),
                'email' => 'limacedric@hotmail.fr',
                'priceRange' => 'À partir de 500€',
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => 'Pau',
                    'addressRegion' => 'Nouvelle-Aquitaine',
                    'postalCode' => '64000',
                    'addressCountry' => 'FR',
                ],
                'areaServed' => [
                    '@type' => 'City',
                    'name' => $data['city'],
                ],
                'serviceType' => 'Création de site web à '.$data['city'],
            ],
            [
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => array_map(function ($faq) {
                    return [
                        '@type' => 'Question',
                        'name' => $faq['question'],
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => $faq['answer'],
                        ],
                    ];
                }, $data['faq']),
            ],
            [
                '@context' => 'https://schema.org',
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    [
                        '@type' => 'ListItem',
                        'position' => 1,
                        'name' => 'Accueil',
                        'item' => url('/'),
                    ],
                    [
                        '@type' => 'ListItem',
                        'position' => 2,
                        'name' => $data['h1'],
                        'item' => url('/'.$data['slug']),
                    ],
                ],
            ],
        ];

        return Inertia::render('Locations/Show', [
            'location' => $data,
            'structuredData' => $structuredData,
        ]);
    }
}
