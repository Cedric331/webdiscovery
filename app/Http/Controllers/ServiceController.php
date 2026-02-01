<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ServiceController extends Controller
{
    /**
     * Liste des métiers avec leurs données SEO
     */
    private function getServices(): array
    {
        return [
            'artisan' => [
                'title' => 'Création Site Web pour Artisan',
                'slug' => 'creation-site-web-artisan',
                'description' => 'Site web professionnel pour artisans. Présentez vos réalisations, augmentez votre visibilité locale et attirez de nouveaux clients. Design moderne et optimisé SEO.',
                'h1' => 'Création de Site Web pour Artisan',
                'keywords' => 'création site web artisan, site internet artisan, site web pour artisan, site vitrine artisan, site web professionnel artisan',
                'problems' => [
                    'Difficulté à être trouvé par les clients locaux',
                    'Manque de visibilité sur internet',
                    'Pas de présentation professionnelle de vos réalisations',
                    'Perte de clients au profit de concurrents mieux référencés',
                ],
                'solutions' => [
                    'Site web optimisé pour le référencement local',
                    'Galerie photos pour présenter vos réalisations',
                    'Formulaire de devis en ligne',
                    'Intégration Google Maps pour votre localisation',
                ],
                'faq' => [
                    [
                        'question' => 'Combien coûte un site web pour artisan ?',
                        'answer' => 'Un site web professionnel pour artisan démarre à partir de 399€. Le prix varie selon le nombre de pages, les fonctionnalités demandées (galerie photos, formulaire de devis, etc.) et les intégrations nécessaires.',
                    ],
                    [
                        'question' => 'Combien de temps pour créer mon site ?',
                        'answer' => 'La création d\'un site web pour artisan prend généralement une semaine, selon la complexité du projet et vos besoins spécifiques.',
                    ],
                    [
                        'question' => 'Mon site sera-t-il visible sur Google ?',
                        'answer' => 'Oui, nous optimisons chaque site pour le référencement local. Votre site sera visible dans les résultats de recherche Google pour les requêtes liées à votre métier et votre zone géographique.',
                    ],
                    [
                        'question' => 'Puis-je modifier le contenu moi-même ?',
                        'answer' => 'Oui, nous proposons une interface d\'administration simple qui vous permet de modifier vos textes, ajouter des photos et gérer vos réalisations sans connaissances techniques.',
                    ],
                ],
            ],
            'coiffeur' => [
                'title' => 'Création Site Web pour Coiffeur',
                'slug' => 'creation-site-web-coiffeur',
                'description' => 'Site web professionnel pour coiffeurs et salons de coiffure. Présentez vos services, vos tarifs et permettez la prise de rendez-vous en ligne. Optimisé pour le référencement local.',
                'h1' => 'Création de Site Web pour Coiffeur',
                'keywords' => 'création site web coiffeur, site internet coiffeur, site web salon coiffure, site vitrine coiffeur, site web professionnel coiffeur',
                'problems' => [
                    'Clients qui ne trouvent pas votre salon sur internet',
                    'Concurrence accrue des salons avec une présence en ligne',
                    'Difficulté à présenter vos prestations et tarifs',
                    'Pas de système de prise de rendez-vous en ligne',
                ],
                'solutions' => [
                    'Site web avec galerie de vos réalisations',
                    'Page tarifs claire et détaillée',
                    'Intégration système de réservation en ligne',
                    'Optimisation pour le référencement local',
                ],
                'faq' => [
                    [
                        'question' => 'Puis-je intégrer un système de réservation en ligne ?',
                        'answer' => 'Oui, nous pouvons intégrer un système de prise de rendez-vous en ligne qui permet à vos clients de réserver directement sur votre site web ou utiliser un service de réservation externe comme Planity',
                    ],
                    [
                        'question' => 'Combien coûte un site web pour coiffeur ?',
                        'answer' => 'Le prix d\'un site est variable suivant les besoins (nombre de pages, galerie photos, formulaire de réservation, etc.).',
                    ],
                    [
                        'question' => 'Mon site affichera-t-il mes tarifs ?',
                        'answer' => 'Oui, il est possible d\'intégrer une page dédiée à vos tarifs avec une présentation claire et professionnelle de tous vos services et prix.',
                    ],
                ],
            ],
            'plombier' => [
                'title' => 'Création Site Web pour Plombier',
                'slug' => 'creation-site-web-plombier',
                'description' => 'Site web professionnel pour plombiers. Présentez vos services d\'urgence et de dépannage, augmentez votre visibilité locale et recevez des demandes de devis en ligne.',
                'h1' => 'Création de Site Web pour Plombier',
                'keywords' => 'création site web plombier, site internet plombier, site web plombier, site vitrine plombier, site web professionnel plombier',
                'problems' => [
                    'Clients qui ne vous trouvent pas lors d\'urgences',
                    'Concurrence des plombiers mieux référencés',
                    'Manque de crédibilité sans présence en ligne',
                    'Perte de clients au profit de plateformes de mise en relation',
                ],
                'solutions' => [
                    'Site web optimisé pour les recherches d\'urgence',
                    'Présentation claire de vos services et zones d\'intervention',
                    'Formulaire de devis rapide et accessible',
                    'Témoignages clients pour renforcer la confiance',
                ],
                'faq' => [
                    [
                        'question' => 'Mon site sera-t-il visible pour les recherches d\'urgence ?',
                        'answer' => 'Oui, nous optimisons votre site pour les recherches locales et d\'urgence. Votre site apparaîtra dans les résultats Google pour les requêtes comme "plombier [votre ville]" ou "dépannage plomberie [votre ville]".',
                    ],
                    [
                        'question' => 'Puis-je afficher mes zones d\'intervention ?',
                        'answer' => 'Oui, nous pouvons intégrer une carte interactive avec vos zones d\'intervention et intégrons Google Maps pour faciliter la localisation de votre activité.',
                    ],
                    [
                        'question' => 'Combien coûte un site web pour plombier ?',
                        'answer' => 'Le prix d\'un site est variable suivant les besoins (nombre de pages, galerie photos, formulaire de réservation, etc.).',
                    ],
                ],
            ],
            'electricien' => [
                'title' => 'Création Site Web pour Électricien',
                'slug' => 'creation-site-web-electricien',
                'description' => 'Site web professionnel pour électriciens. Présentez vos services, augmentez votre visibilité locale et recevez des demandes de devis pour vos interventions électriques.',
                'h1' => 'Création de Site Web pour Électricien',
                'keywords' => 'création site web électricien, site internet électricien, site web électricien, site vitrine électricien, site web professionnel électricien',
                'problems' => [
                    'Difficulté à être trouvé par les clients locaux',
                    'Concurrence des électriciens mieux référencés',
                    'Manque de visibilité pour les dépannages d\'urgence',
                    'Pas de présentation professionnelle de vos services',
                ],
                'solutions' => [
                    'Site web optimisé pour le référencement local',
                    'Présentation détaillée de vos services',
                    'Formulaire de devis en ligne',
                    'Galerie de vos réalisations',
                ],
                'faq' => [
                    [
                        'question' => 'Mon site sera-t-il visible sur Google ?',
                        'answer' => 'Oui, nous optimisons chaque site pour le référencement local. Votre site sera visible dans les résultats de recherche Google pour les requêtes liées à votre métier et votre zone géographique.',
                    ],
                    [
                        'question' => 'Combien coûte un site web pour électricien ?',
                        'answer' => 'Le prix d\'un site est variable suivant les besoins (nombre de pages, galerie photos, formulaire de réservation, etc.).',
                    ],
                ],
            ],
            'menuisier' => [
                'title' => 'Création Site Web pour Menuisier',
                'slug' => 'creation-site-web-menuisier',
                'description' => 'Site web professionnel pour menuisiers. Présentez vos réalisations sur mesure, augmentez votre visibilité et attirez de nouveaux clients pour vos projets de menuiserie.',
                'h1' => 'Création de Site Web pour Menuisier',
                'keywords' => 'création site web menuisier, site internet menuisier, site web menuisier, site vitrine menuisier, site web professionnel menuisier',
                'problems' => [
                    'Difficulté à présenter vos réalisations sur mesure',
                    'Manque de visibilité pour attirer de nouveaux clients',
                    'Pas de galerie professionnelle de vos travaux',
                    'Perte de clients au profit de concurrents mieux référencés',
                ],
                'solutions' => [
                    'Galerie photos professionnelle pour vos réalisations',
                    'Présentation de vos services sur mesure',
                    'Formulaire de devis en ligne',
                    'Optimisation pour le référencement local',
                ],
                'faq' => [
                    [
                        'question' => 'Puis-je ajouter une galerie de mes réalisations ?',
                        'answer' => 'Oui, nous pouvons intégrer une galerie photos professionnelle où vous pourrez présenter toutes vos réalisations de menuiserie avec des descriptions détaillées.',
                    ],
                    [
                        'question' => 'Combien coûte un site web pour menuisier ?',
                        'answer' => 'Le prix d\'un site est variable suivant les besoins (nombre de pages, galerie photos, formulaire de réservation, etc.).',
                    ],
                ],
            ],
        ];
    }

    public function show(string $service)
    {
        $services = $this->getServices();
        
        if (!isset($services[$service])) {
            abort(404);
        }

        $serviceData = $services[$service];
        
        // Génération des données structurées Schema.org
        $structuredData = [
            [
                '@context' => 'https://schema.org',
                '@type' => 'LocalBusiness',
                'name' => 'Web Discovery',
                'description' => $serviceData['description'],
                'url' => url('/'),
                'priceRange' => 'Sur devis',
                'areaServed' => [
                    '@type' => 'Country',
                    'name' => 'France',
                ],
                'serviceType' => $serviceData['title'],
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
                }, $serviceData['faq']),
            ],
        ];

        return Inertia::render('Services/Show', [
            'service' => $serviceData,
            'structuredData' => $structuredData,
        ]);
    }
}

