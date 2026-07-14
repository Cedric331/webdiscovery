<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class TradeLocationController extends Controller
{
    /**
     * Pages « métier × ville » (SEO local longue traîne).
     *
     * Cible les requêtes à forte intention du type « création site web
     * {métier} {ville} ». Chaque page dispose d'un contenu RÉELLEMENT
     * unique (contexte métier + local, problèmes, solutions, FAQ) pour
     * éviter le schéma des « pages satellites » pénalisé par Google.
     */
    private function getPages(): array
    {
        $zones = ['Pau', 'Billère', 'Lescar', 'Lons', 'Jurançon', 'Bizanos', 'Gan', 'Idron'];
        $cityUrl = '/creation-site-web-pau';

        return [
            'restaurant-pau' => [
                'slug' => 'creation-site-web-restaurant-pau',
                'trade' => 'Restaurant',
                'city' => 'Pau',
                'zones' => $zones,
                'cityUrl' => $cityUrl,
                'title' => 'Création Site Web Restaurant à Pau (64) | Web Discovery',
                'description' => "Création de site web pour restaurant à Pau : menu en ligne, réservation, avis clients et référencement local. Attirez plus de clients dans votre établissement palois. Devis gratuit.",
                'h1' => 'Création de Site Web pour Restaurant à Pau',
                'keywords' => 'création site web restaurant Pau, site internet restaurant Pau, site web restaurateur Pau, menu en ligne Pau',
                'intro' => "À Pau, les clients choisissent souvent leur restaurant depuis leur téléphone, en quelques secondes. Un site web clair avec votre carte, vos horaires et un lien de réservation est aujourd'hui indispensable pour ne pas laisser filer ces clients vers un concurrent mieux visible.",
                'localContext' => "La restauration paloise est très concurrentielle, du centre-ville (Hédas, place Reine Marguerite, quartier du Château) aux Halles et aux boulevards. La plupart des recherches « restaurant Pau » ou « où manger à Pau » se font sur mobile, souvent à quelques minutes de la table. Un site rapide, appétissant et bien référencé — associé à une fiche Google à jour — vous fait apparaître au bon moment, quand le client a faim et cherche à réserver.",
                'problems' => [
                    "Clients qui ne trouvent pas votre carte ou vos horaires en ligne",
                    "Dépendance totale aux plateformes qui prennent une commission",
                    "Impossibilité de mettre en avant vos plats et votre ambiance",
                    "Réservations perdues faute de contact facile depuis le mobile",
                ],
                'solutions' => [
                    "Carte / menu en ligne facile à mettre à jour",
                    "Bouton de réservation ou de contact direct bien visible",
                    "Galerie photos de vos plats et de votre salle",
                    "Optimisation pour les recherches « restaurant Pau » sur mobile",
                ],
                'faq' => [
                    [
                        'question' => 'Puis-je afficher et modifier ma carte facilement ?',
                        'answer' => "Oui, nous mettons en place une page menu simple à actualiser (plats, prix, formules du jour) afin que votre carte soit toujours à jour, sans dépendre d'un prestataire à chaque changement.",
                    ],
                    [
                        'question' => 'Le site peut-il intégrer la réservation en ligne ?',
                        'answer' => "Oui, nous pouvons intégrer un bouton de réservation (via votre outil ou un service comme TheFork/Zenchef) ou un simple formulaire de contact rapide, selon votre fonctionnement.",
                    ],
                    [
                        'question' => "Combien coûte un site pour un restaurant à Pau ?",
                        'answer' => "À partir de 500€ pour un site vitrine avec menu et réservation. Le devis, gratuit, s'ajuste selon vos besoins (nombre de pages, photos, multilingue…).",
                    ],
                ],
            ],
            'plombier-pau' => [
                'slug' => 'creation-site-web-plombier-pau',
                'trade' => 'Plombier',
                'city' => 'Pau',
                'zones' => $zones,
                'cityUrl' => $cityUrl,
                'title' => 'Création Site Web Plombier à Pau (64) | Web Discovery',
                'description' => "Création de site web pour plombier à Pau : visibilité sur les recherches d'urgence, formulaire de devis et référencement local. Recevez plus d'appels de clients palois. Devis gratuit.",
                'h1' => 'Création de Site Web pour Plombier à Pau',
                'keywords' => 'création site web plombier Pau, site internet plombier Pau, plombier Pau site web, dépannage plomberie Pau',
                'intro' => "Quand une fuite survient à Pau, le client tape « plombier Pau » et appelle l'un des premiers résultats. Si vous n'y apparaissez pas, vous perdez l'intervention. Un site bien référencé vous place sur ces recherches d'urgence à forte valeur.",
                'localContext' => "La demande en plomberie à Pau et dans l'agglomération (Billère, Lescar, Lons, Jurançon…) est constante : dépannages d'urgence, rénovations de salle de bain, installations. Ces recherches sont souvent immédiates et locales (« plombier Pau », « dépannage fuite Pau »). Être visible sur Google et sur la carte locale, avec un numéro cliquable et un formulaire de devis rapide, transforme directement ces recherches en appels.",
                'problems' => [
                    "Invisible lors des recherches d'urgence « plombier Pau »",
                    "Clients captés par les plateformes de mise en relation payantes",
                    "Manque de crédibilité sans présence en ligne sérieuse",
                    "Devis perdus faute de contact rapide depuis le mobile",
                ],
                'solutions' => [
                    "Site optimisé pour les recherches locales et d'urgence",
                    "Numéro de téléphone cliquable et formulaire de devis rapide",
                    "Présentation claire de vos services et zones d'intervention",
                    "Avis clients pour renforcer la confiance immédiate",
                ],
                'faq' => [
                    [
                        'question' => 'Mon site apparaîtra-t-il sur « plombier Pau » ?',
                        'answer' => "C'est l'objectif : nous structurons et optimisons le site pour les recherches locales et d'urgence liées à la plomberie à Pau et dans les communes voisines, en complément de votre fiche Google.",
                    ],
                    [
                        'question' => 'Puis-je afficher mes zones d\'intervention ?',
                        'answer' => "Oui, nous mettons en avant vos zones d'intervention (Pau, Billère, Lescar, Jurançon…) avec une carte, pour rassurer le client sur votre capacité à intervenir rapidement chez lui.",
                    ],
                    [
                        'question' => "Combien coûte un site pour un plombier à Pau ?",
                        'answer' => "À partir de 500€ pour un site vitrine orienté génération de contacts. Devis gratuit et personnalisé selon vos besoins.",
                    ],
                ],
            ],
            'electricien-pau' => [
                'slug' => 'creation-site-web-electricien-pau',
                'trade' => 'Électricien',
                'city' => 'Pau',
                'zones' => $zones,
                'cityUrl' => $cityUrl,
                'title' => 'Création Site Web Électricien à Pau (64) | Web Discovery',
                'description' => "Création de site web pour électricien à Pau : visibilité locale, dépannages d'urgence, mise aux normes et formulaire de devis. Développez votre activité paloise. Devis gratuit.",
                'h1' => 'Création de Site Web pour Électricien à Pau',
                'keywords' => 'création site web électricien Pau, site internet électricien Pau, électricien Pau site web, dépannage électrique Pau',
                'intro' => "Dépannage, mise aux normes, installation, borne de recharge… la demande en électricité à Pau est forte et variée. Un site web professionnel vous positionne sur ces recherches locales et rassure des clients qui veulent un artisan fiable.",
                'localContext' => "À Pau et dans son agglomération, les électriciens répondent à des besoins allant du dépannage urgent à la rénovation complète, en passant par la mise aux normes et l'installation de bornes de recharge — un marché en pleine croissance. Les clients recherchent « électricien Pau » puis comparent rapidement crédibilité, avis et facilité de contact. Un site clair et bien référencé fait pencher la balance en votre faveur.",
                'problems' => [
                    "Difficulté à être trouvé sur « électricien Pau »",
                    "Concurrence d'artisans mieux référencés localement",
                    "Manque de visibilité pour les dépannages d'urgence",
                    "Aucune vitrine pour vos prestations (mise aux normes, bornes…)",
                ],
                'solutions' => [
                    "Référencement local ciblé sur Pau et alentour",
                    "Présentation détaillée de vos services (dépannage, rénovation, bornes)",
                    "Numéro cliquable et formulaire de devis rapide",
                    "Mise en avant de vos certifications et avis clients",
                ],
                'faq' => [
                    [
                        'question' => 'Mon site sera-t-il visible pour les dépannages à Pau ?',
                        'answer' => "Oui, nous optimisons le site pour les recherches locales et d'urgence liées à l'électricité à Pau, afin de capter les clients qui ont besoin d'une intervention rapide.",
                    ],
                    [
                        'question' => 'Puis-je mettre en avant la pose de bornes de recharge ?',
                        'answer' => "Bien sûr. Nous pouvons créer des pages ou sections dédiées à vos prestations spécifiques (bornes IRVE, domotique, mise aux normes), ce qui aide aussi au référencement sur ces requêtes.",
                    ],
                    [
                        'question' => "Combien coûte un site pour un électricien à Pau ?",
                        'answer' => "À partir de 500€ pour un site vitrine professionnel. Le devis est gratuit et adapté à vos besoins.",
                    ],
                ],
            ],
            'coiffeur-pau' => [
                'slug' => 'creation-site-web-coiffeur-pau',
                'trade' => 'Coiffeur',
                'city' => 'Pau',
                'zones' => $zones,
                'cityUrl' => $cityUrl,
                'title' => 'Création Site Web Coiffeur à Pau (64) | Web Discovery',
                'description' => "Création de site web pour salon de coiffure à Pau : prise de rendez-vous en ligne, galerie, tarifs et référencement local. Remplissez votre agenda avec des clients palois. Devis gratuit.",
                'h1' => 'Création de Site Web pour Coiffeur à Pau',
                'keywords' => 'création site web coiffeur Pau, site internet salon coiffure Pau, coiffeur Pau réservation en ligne',
                'intro' => "À Pau, un salon de coiffure se choisit sur la réputation, les photos et la facilité de prise de rendez-vous. Un site web moderne avec réservation en ligne vous aide à remplir votre agenda et à fidéliser votre clientèle paloise.",
                'localContext' => "Les salons de coiffure sont nombreux à Pau, du centre-ville aux quartiers résidentiels et aux communes de l'agglomération. La clientèle recherche « coiffeur Pau » puis regarde les photos, les avis et surtout la possibilité de réserver en ligne à toute heure. Un site vitrine soigné, connecté à un outil de réservation, réduit les appels manqués et met en valeur votre style et votre équipe.",
                'problems' => [
                    "Rendez-vous limités aux horaires d'ouverture par téléphone",
                    "Difficulté à présenter vos réalisations et votre univers",
                    "Concurrence des salons déjà visibles en ligne",
                    "Pas de vitrine pour vos prestations et tarifs",
                ],
                'solutions' => [
                    "Prise de rendez-vous en ligne 24h/24 (Planity, Treatwell…)",
                    "Galerie photos de vos coupes et de votre salon",
                    "Page tarifs et prestations claire",
                    "Référencement local sur « coiffeur Pau »",
                ],
                'faq' => [
                    [
                        'question' => 'Puis-je intégrer la réservation en ligne ?',
                        'answer' => "Oui, nous intégrons votre solution de réservation (Planity, Treatwell…) ou un formulaire adapté, pour que vos clients réservent directement depuis le site, à toute heure.",
                    ],
                    [
                        'question' => 'Le site mettra-t-il en valeur mes réalisations ?',
                        'answer' => "Oui, nous soignons la galerie photos et le design pour refléter l'univers de votre salon, un point clé pour convaincre une nouvelle cliente à Pau.",
                    ],
                    [
                        'question' => "Combien coûte un site pour un salon de coiffure à Pau ?",
                        'answer' => "À partir de 500€ pour un site vitrine avec galerie et réservation. Devis gratuit selon vos besoins.",
                    ],
                ],
            ],
            'photographe-pau' => [
                'slug' => 'creation-site-web-photographe-pau',
                'trade' => 'Photographe',
                'city' => 'Pau',
                'zones' => $zones,
                'cityUrl' => $cityUrl,
                'title' => 'Création Site Web Photographe à Pau (64) | Web Discovery',
                'description' => "Création de site web pour photographe à Pau : portfolio élégant, galeries, réservation de séance et référencement local. Attirez plus de clients palois. Devis gratuit.",
                'h1' => 'Création de Site Web pour Photographe à Pau',
                'keywords' => 'création site web photographe Pau, portfolio photographe Pau, site internet photographe Pau',
                'intro' => "Pour un photographe, le site est la vitrine principale : c'est là que le client juge votre style avant de vous contacter. À Pau, un portfolio en ligne élégant et bien référencé est le meilleur moyen de décrocher mariages, séances famille ou shootings pro.",
                'localContext' => "Mariage, grossesse, famille, entreprise, immobilier… la demande photo à Pau et dans le Béarn est variée et saisonnière. Les clients recherchent « photographe mariage Pau » ou « photographe Pau » puis évaluent avant tout la qualité des images et la facilité de prise de contact. Un site rapide qui met vos photos en pleine largeur, avec des galeries par prestation et un formulaire de réservation, transforme les visiteurs en clients.",
                'problems' => [
                    "Portfolio dispersé uniquement sur les réseaux sociaux",
                    "Images mal mises en valeur ou site trop lent",
                    "Difficulté à être trouvé sur « photographe Pau »",
                    "Pas de moyen simple de réserver une séance",
                ],
                'solutions' => [
                    "Portfolio élégant avec galeries par type de prestation",
                    "Affichage rapide et haute qualité de vos photos",
                    "Formulaire de réservation / devis de séance",
                    "Référencement local sur vos spécialités à Pau",
                ],
                'faq' => [
                    [
                        'question' => 'Mes photos seront-elles affichées en haute qualité ?',
                        'answer' => "Oui, nous optimisons l'affichage pour un rendu haute qualité tout en gardant un site rapide, essentiel pour mettre vos images en valeur sans faire fuir le visiteur.",
                    ],
                    [
                        'question' => 'Puis-je avoir des galeries séparées par prestation ?',
                        'answer' => "Oui, nous organisons des galeries distinctes (mariage, famille, entreprise…), ce qui améliore l'expérience client et le référencement sur chaque spécialité.",
                    ],
                    [
                        'question' => "Combien coûte un site pour un photographe à Pau ?",
                        'answer' => "À partir de 500€ pour un site portfolio professionnel. Le devis, gratuit, dépend du nombre de galeries et des fonctionnalités souhaitées.",
                    ],
                ],
            ],
        ];
    }

    public function show(string $page)
    {
        $pages = $this->getPages();

        if (! isset($pages[$page])) {
            abort(404);
        }

        $data = $pages[$page];

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
                'serviceType' => 'Création de site web pour '.$data['trade'].' à '.$data['city'],
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

        return Inertia::render('TradeLocations/Show', [
            'page' => $data,
            'structuredData' => $structuredData,
        ]);
    }
}
