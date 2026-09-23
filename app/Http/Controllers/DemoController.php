<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DemoController extends Controller
{
    /**
     * Registre des démos commerciales (landing pages « secteur »).
     *
     * Pour ajouter une démo (restaurant, artisan, immobilier, thérapeute…) :
     *  1. ajouter une entrée dans ce tableau ;
     *  2. créer la page Inertia correspondante (clé `component`) ;
     *  3. déclarer la route dans routes/web.php + le sitemap ;
     *  4. ajouter le lien dans resources/js/data/demos.ts (menu « Démos »).
     */
    private function getDemos(): array
    {
        return [
            'coach-sportif' => [
                'slug' => 'site-coach-sportif',
                'component' => 'Demos/CoachSportif',
                'name' => 'Site Coach Sportif',
                'demoUrl' => 'https://coach.web-discovery.fr',
                'price' => 590,
                'description' => 'Site internet professionnel pour coach sportif et personal trainer : présentation des coachings, tarifs, témoignages et formulaire de contact. À partir de 590 € HT.',
                // Captures d'écran de la démo. Déposer les fichiers dans
                // public/images/demos/ pour qu'elles s'affichent : tant qu'ils
                // sont absents, la page affiche un cadre d'attente (pas de
                // fausse capture).
                'screenshots' => [
                    'desktop' => 'images/demos/coach-sportif-desktop.png',
                    'mobile' => 'images/demos/coach-sportif-mobile.png',
                ],
                'faq' => [
                    [
                        'question' => 'Le site sera-t-il personnalisé à mon image ?',
                        'answer' => "Oui. La démo sert de base de travail, pas de modèle figé : vos couleurs, votre logo, vos photos, vos textes et vos prestations sont intégrés pour obtenir un site à votre image, et non un template générique.",
                    ],
                    [
                        'question' => 'Puis-je utiliser mon propre nom de domaine ?',
                        'answer' => "Oui. Votre site est mis en ligne sur votre propre nom de domaine. Si vous n'en avez pas encore, je vous accompagne pour le choisir et le configurer.",
                        // TODO (métier) : préciser si l'achat et le renouvellement
                        // du nom de domaine sont à la charge du client ou inclus.
                    ],
                    [
                        'question' => 'Le site fonctionne-t-il sur mobile ?',
                        'answer' => "Oui. Le site est responsive : il s'adapte automatiquement au smartphone, à la tablette et à l'ordinateur. C'est essentiel, la majorité de vos futurs clients vous découvriront depuis leur téléphone.",
                    ],
                    [
                        'question' => 'Puis-je présenter plusieurs formules de coaching ?',
                        'answer' => "Oui. Coaching individuel, coaching en petit groupe, suivi à distance, programmes personnalisés : vous pouvez présenter plusieurs offres, chacune avec sa description et son tarif.",
                    ],
                    [
                        'question' => 'Le site est-il optimisé pour Google ?',
                        'answer' => "Oui. Le SEO technique est inclus : structure HTML propre, balises title et meta description, temps de chargement optimisé et compatibilité mobile. Le site est également préparé pour le référencement local, afin d'être trouvé par les sportifs de votre secteur.",
                    ],
                    [
                        'question' => 'Puis-je ajouter mon Instagram ?',
                        'answer' => "Oui. Les liens vers Instagram et vos autres réseaux sociaux sont intégrés au site, pour que vos visiteurs puissent vous suivre et découvrir votre contenu au quotidien.",
                    ],
                    [
                        'question' => 'Combien de temps faut-il pour mettre le site en ligne ?',
                        'answer' => "La personnalisation démarre dès réception de vos éléments (logo, couleurs, photos, prestations, tarifs et textes). Le délai précis vous est confirmé avant le lancement du projet, en fonction de vos besoins.",
                        // TODO (métier) : indiquer un délai moyen réel (ex. « environ
                        // une semaine ») une fois le process rodé sur cette offre.
                    ],
                    [
                        'question' => "L'hébergement et la maintenance sont-ils inclus ?",
                        'answer' => "Les 590 € HT couvrent la création, la personnalisation et la mise en ligne du site. L'hébergement et la maintenance sont proposés séparément, en option : parlons-en ensemble pour adapter la formule à vos besoins.",
                        // TODO (métier) : ajouter les tarifs d'hébergement et de
                        // maintenance dès qu'ils sont arrêtés.
                    ],
                ],
            ],
        ];
    }

    public function show(string $demo)
    {
        $demos = $this->getDemos();

        if (! isset($demos[$demo])) {
            abort(404);
        }

        $demoData = $demos[$demo];

        // On ne référence que les captures réellement présentes dans public/,
        // pour ne jamais afficher d'image cassée ni de fausse capture.
        $demoData['screenshots'] = array_map(
            fn (?string $path) => $path && file_exists(public_path($path)) ? '/'.$path : null,
            $demoData['screenshots'],
        );

        $url = url('/'.$demoData['slug']);

        $structuredData = [
            [
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => $demoData['name'],
                'serviceType' => 'Création de site internet pour coach sportif',
                'description' => $demoData['description'],
                'url' => $url,
                'provider' => [
                    '@type' => 'ProfessionalService',
                    '@id' => url('/').'#organization',
                ],
                'areaServed' => [
                    '@type' => 'Country',
                    'name' => 'France',
                ],
                'audience' => [
                    '@type' => 'Audience',
                    'audienceType' => 'Coachs sportifs, personal trainers, coachs fitness',
                ],
                'offers' => [
                    '@type' => 'Offer',
                    'url' => $url,
                    'price' => (string) $demoData['price'],
                    'priceCurrency' => 'EUR',
                    'availability' => 'https://schema.org/InStock',
                    'priceSpecification' => [
                        '@type' => 'PriceSpecification',
                        'price' => (string) $demoData['price'],
                        'priceCurrency' => 'EUR',
                        'valueAddedTaxIncluded' => false,
                    ],
                ],
            ],
            [
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => array_map(fn (array $faq) => [
                    '@type' => 'Question',
                    'name' => $faq['question'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $faq['answer'],
                    ],
                ], $demoData['faq']),
            ],
        ];

        return Inertia::render($demoData['component'], [
            'demo' => $demoData,
            'structuredData' => $structuredData,
        ]);
    }
}
