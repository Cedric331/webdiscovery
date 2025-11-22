<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head>
        <title>Politique de Confidentialité - Web Discovery</title>
        <meta
            name="description"
            content="Politique de confidentialité et protection des données personnelles de Web Discovery"
        />
        <meta name="robots" content="noindex, follow" />
    </Head>

    <div
        class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white"
    >
        <header
            class="fixed top-0 right-0 left-0 z-50 border-b border-slate-700/30 bg-slate-900/60 backdrop-blur-xl"
        >
            <nav class="container mx-auto px-6 py-4">
                <Link
                    href="/"
                    class="group flex cursor-pointer items-center gap-3"
                >
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 shadow-lg shadow-blue-500/30"
                    >
                        <span class="text-xl font-bold text-white">W</span>
                    </div>
                    <span
                        class="bg-gradient-to-r from-white to-slate-300 bg-clip-text text-xl font-bold tracking-tight text-transparent"
                        >WEB DISCOVERY</span
                    >
                </Link>
            </nav>
        </header>

        <main class="px-6 pt-32 pb-20">
            <div class="container mx-auto max-w-4xl">
                <div
                    class="rounded-3xl border border-slate-700/30 bg-slate-800/40 p-8 shadow-2xl backdrop-blur-xl md:p-12"
                >
                    <h1
                        class="mb-8 bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-4xl font-black text-transparent md:text-5xl"
                    >
                        Politique de Confidentialité
                    </h1>

                    <p class="mb-8 text-slate-400">
                        Dernière mise à jour :
                        {{
                            new Date().toLocaleDateString('fr-FR', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric',
                            })
                        }}
                    </p>

                    <div class="space-y-8 leading-relaxed text-slate-300">
                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                1. Introduction
                            </h2>
                            <p>
                                Web Discovery s'engage à protéger la
                                confidentialité et la sécurité des données
                                personnelles de ses utilisateurs. Cette
                                politique de confidentialité explique comment
                                nous collectons, utilisons et protégeons vos
                                informations personnelles conformément au
                                Règlement Général sur la Protection des Données
                                (RGPD).
                            </p>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                2. Données collectées
                            </h2>
                            <p class="mb-4">
                                Nous collectons les données suivantes :
                            </p>
                            <ul class="ml-4 list-inside list-disc space-y-2">
                                <li>
                                    <strong class="text-white"
                                        >Données d'identification :</strong
                                    >
                                    nom, prénom, adresse email
                                </li>
                                <li>
                                    <strong class="text-white"
                                        >Données de communication :</strong
                                    >
                                    messages envoyés via le formulaire de
                                    contact
                                </li>
                                <li>
                                    <strong class="text-white"
                                        >Données techniques :</strong
                                    >
                                    adresse IP, type de navigateur, pages
                                    visitées (via cookies)
                                </li>
                            </ul>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                3. Finalité du traitement
                            </h2>
                            <p class="mb-4">
                                Vos données sont utilisées pour :
                            </p>
                            <ul class="ml-4 list-inside list-disc space-y-2">
                                <li>Répondre à vos demandes de contact</li>
                                <li>
                                    Améliorer notre site web et nos services
                                </li>
                                <li>Respecter nos obligations légales</li>
                                <li>
                                    Analyser l'utilisation du site (avec votre
                                    consentement pour les cookies analytiques)
                                </li>
                            </ul>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                4. Base légale
                            </h2>
                            <p>
                                Le traitement de vos données personnelles est
                                basé sur :
                            </p>
                            <ul
                                class="mt-2 ml-4 list-inside list-disc space-y-2"
                            >
                                <li>
                                    Votre consentement (pour les cookies non
                                    essentiels)
                                </li>
                                <li>
                                    L'exécution d'un contrat ou de mesures
                                    précontractuelles (réponse à vos demandes)
                                </li>
                                <li>
                                    Notre intérêt légitime (amélioration de nos
                                    services)
                                </li>
                            </ul>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                5. Conservation des données
                            </h2>
                            <p>
                                Vos données personnelles sont conservées
                                uniquement le temps nécessaire aux finalités
                                pour lesquelles elles ont été collectées :
                            </p>
                            <ul
                                class="mt-2 ml-4 list-inside list-disc space-y-2"
                            >
                                <li>
                                    Données de contact : 3 ans à compter du
                                    dernier contact
                                </li>
                                <li>Cookies : 13 mois maximum</li>
                                <li>Données techniques : 12 mois</li>
                            </ul>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                6. Vos droits
                            </h2>
                            <p class="mb-4">
                                Conformément au RGPD, vous disposez des droits
                                suivants :
                            </p>
                            <ul class="ml-4 list-inside list-disc space-y-2">
                                <li>
                                    <strong class="text-white"
                                        >Droit d'accès :</strong
                                    >
                                    obtenir une copie de vos données
                                    personnelles
                                </li>
                                <li>
                                    <strong class="text-white"
                                        >Droit de rectification :</strong
                                    >
                                    corriger vos données inexactes
                                </li>
                                <li>
                                    <strong class="text-white"
                                        >Droit à l'effacement :</strong
                                    >
                                    supprimer vos données
                                </li>
                                <li>
                                    <strong class="text-white"
                                        >Droit à la limitation :</strong
                                    >
                                    limiter le traitement de vos données
                                </li>
                                <li>
                                    <strong class="text-white"
                                        >Droit à la portabilité :</strong
                                    >
                                    récupérer vos données dans un format
                                    structuré
                                </li>
                                <li>
                                    <strong class="text-white"
                                        >Droit d'opposition :</strong
                                    >
                                    vous opposer au traitement de vos données
                                </li>
                                <li>
                                    <strong class="text-white"
                                        >Droit de retirer votre consentement
                                        :</strong
                                    >
                                    à tout moment pour les cookies
                                </li>
                            </ul>
                            <p class="mt-4">
                                Pour exercer ces droits, contactez-nous à :
                                <a
                                    href="mailto:limacedric@hotmail.fr"
                                    class="text-blue-400 underline hover:text-blue-300"
                                    >limacedric@hotmail.fr</a
                                >
                            </p>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                7. Cookies
                            </h2>
                            <p class="mb-4">
                                Notre site utilise des cookies pour :
                            </p>
                            <ul class="ml-4 list-inside list-disc space-y-2">
                                <li>
                                    Mémoriser vos préférences (cookies
                                    essentiels)
                                </li>
                                <li>Améliorer l'expérience utilisateur</li>
                                <li>
                                    Analyser le trafic (avec votre consentement)
                                </li>
                            </ul>
                            <p class="mt-4">
                                Vous pouvez gérer vos préférences de cookies via
                                la bannière de consentement ou les paramètres de
                                votre navigateur.
                            </p>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                8. Sécurité
                            </h2>
                            <p>
                                Nous mettons en œuvre des mesures techniques et
                                organisationnelles appropriées pour protéger vos
                                données personnelles contre tout accès non
                                autorisé, perte, destruction ou altération.
                            </p>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                9. Partage des données
                            </h2>
                            <p>
                                Nous ne vendons, ne louons ni ne partageons vos
                                données personnelles avec des tiers, sauf :
                            </p>
                            <ul
                                class="mt-2 ml-4 list-inside list-disc space-y-2"
                            >
                                <li>Si la loi l'exige</li>
                                <li>Avec votre consentement explicite</li>
                                <li>
                                    Avec nos prestataires de services
                                    (hébergement, email) sous contrat strict de
                                    confidentialité
                                </li>
                            </ul>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                10. Contact
                            </h2>
                            <p>
                                Pour toute question concernant cette politique
                                de confidentialité ou pour exercer vos droits,
                                contactez-nous :
                            </p>
                            <p class="mt-4">
                                <strong class="text-white">Web Discovery</strong
                                ><br />
                                Email :
                                <a
                                    href="mailto:contact@web-discovery.com"
                                    class="text-blue-400 underline hover:text-blue-300"
                                    >limacedric@hotmail.fr</a
                                >
                            </p>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                11. Modifications
                            </h2>
                            <p>
                                Cette politique de confidentialité peut être
                                modifiée à tout moment. La date de dernière mise
                                à jour est indiquée en haut de cette page. Nous
                                vous encourageons à consulter régulièrement
                                cette page.
                            </p>
                        </section>
                    </div>

                    <div class="mt-12 border-t border-slate-700/50 pt-8">
                        <Link
                            href="/"
                            class="inline-flex items-center gap-2 text-blue-400 transition-colors hover:text-blue-300"
                        >
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"
                                />
                            </svg>
                            Retour à l'accueil
                        </Link>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
