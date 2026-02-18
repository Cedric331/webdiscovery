<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head>
        <title>Jeu concours - Règlement - Web Discovery</title>
        <meta
            name="description"
            content="Règlement du jeu concours Web Discovery - Gagnez un site vitrine one-page."
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
                        class="mb-3 bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-4xl font-black text-transparent md:text-5xl"
                    >
                        Règlement du jeu concours
                    </h1>

                    <p class="mb-10 text-slate-300">
                        “Gagnez votre site vitrine one-page” — Web Discovery
                    </p>

                    <div class="space-y-8 leading-relaxed text-slate-300">
                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                Article 1 – Organisateur
                            </h2>
                            <p>
                                Le présent jeu concours est organisé par
                                <strong class="text-white">Web Discovery</strong>.
                            </p>
                            <p class="mt-2">
                                Contact :
                                <a
                                    href="mailto:limacedric@hotmail.fr"
                                    class="text-blue-400 underline hover:text-blue-300"
                                    >limacedric@hotmail.fr</a
                                >
                            </p>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                Article 2 – Durée
                            </h2>
                            <p>
                                Le jeu concours se déroule du
                                <strong class="text-white">18/02/2026</strong>
                                au
                                <strong class="text-white">23/02/2026</strong>
                                à 23h59.
                            </p>
                            <p class="mt-2">
                                Toute participation en dehors de cette période ne sera pas prise en compte.
                            </p>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                Article 3 – Conditions de participation
                            </h2>
                            <p>
                                Le jeu est ouvert aux professionnels (commerçants, artisans, indépendants)
                                situés en France ne disposant pas d’un site internet actif.
                            </p>

                            <div class="mt-4 rounded-2xl border border-slate-700/40 bg-slate-900/30 p-5">
                                <p class="font-semibold text-white">Pour participer :</p>
                                <ul class="mt-3 list-disc space-y-2 pl-5">
                                    <li>Suivre la page Web Discovery.</li>
                                    <li>
                                        S’inscrire via le formulaire sur le site avec une adresse email valide.
                                    </li>
                                </ul>
                                <p class="mt-4 text-sm text-slate-400">
                                    Une seule participation par entreprise est autorisée.
                                </p>
                            </div>

                            <p class="mt-4">
                                Ce jeu concours n’est ni géré ni sponsorisé par Facebook / Instagram.
                            </p>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                Article 4 – Désignation du gagnant
                            </h2>
                            <p>
                                Le gagnant sera désigné par tirage au sort parmi l’ensemble des participations
                                conformes.
                            </p>
                            <p class="mt-2">
                                Le tirage au sort aura lieu dans un délai maximum de
                                <strong class="text-white">7 jours</strong>
                                après la fin du concours.
                            </p>
                            <p class="mt-2">
                                Le gagnant sera contacté par email. Sans réponse sous
                                <strong class="text-white">7 jours</strong>,
                                un nouveau tirage pourra être effectué.
                            </p>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                Article 5 – Description du lot
                            </h2>
                            <p>
                                Le lot comprend la création d’un site vitrine
                                <strong class="text-white">one-page</strong> comprenant :
                            </p>
                            <ul class="mt-3 list-disc space-y-2 pl-5">
                                <li>Présentation de l’entreprise</li>
                                <li>Présentation des services</li>
                                <li>Coordonnées</li>
                                <li>Formulaire de contact</li>
                                <li>
                                    Intégration des textes et images
                                    <strong class="text-white">fournis par le gagnant</strong>
                                </li>
                                <li>Design basé sur un template professionnel</li>
                            </ul>

                            <p class="mt-4">
                                Valeur estimée du lot :
                                <strong class="text-white">500 €</strong>.
                            </p>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                Article 6 – Exclusions, limites et livraison
                            </h2>

                            <div class="rounded-2xl border border-slate-700/40 bg-slate-900/30 p-5">
                                <p class="font-semibold text-white">Ne sont pas inclus :</p>
                                <ul class="mt-3 list-disc space-y-2 pl-5">
                                    <li>Hébergement</li>
                                    <li>Nom de domaine</li>
                                    <li>Rédaction de contenu</li>
                                    <li>Logo / identité visuelle</li>
                                    <li>Maintenance / évolutions</li>
                                    <li>Fonctionnalités spécifiques ou développement sur mesure</li>
                                    <li>Référencement SEO avancé</li>
                                </ul>
                            </div>

                            <p class="mt-4">
                                Le gagnant devra fournir l’ensemble des éléments nécessaires (textes, images,
                                coordonnées, informations légales) pour la réalisation du site.
                            </p>
                            <p class="mt-2">
                                La mise en ligne interviendra sous
                                <strong class="text-white">30 jours</strong>
                                après réception complète des éléments.
                            </p>
                            <p class="mt-2">
                                Le lot ne peut donner lieu à aucun échange, remboursement ou contrepartie financière.
                            </p>
                            <p class="mt-2">
                                L’organisateur se réserve le droit de refuser la réalisation du site si le projet
                                ne correspond pas au périmètre défini ci-dessus.
                            </p>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                Article 7 – Données personnelles
                            </h2>
                            <p>
                                Les informations collectées sont utilisées dans le cadre du jeu concours.
                                Conformément au RGPD, vous disposez d’un droit d’accès, de rectification,
                                de suppression et d’opposition aux données vous concernant.
                            </p>
                            <p class="mt-2">
                                Pour exercer ces droits, contactez :
                                <a
                                    href="mailto:limacedric@hotmail.fr"
                                    class="text-blue-400 underline hover:text-blue-300"
                                    >limacedric@hotmail.fr</a
                                >.
                            </p>
                            <p class="mt-4">
                                Pour plus d'informations, consultez notre
                                <Link
                                    href="/politique-confidentialite"
                                    class="text-blue-400 underline hover:text-blue-300"
                                    >Politique de confidentialité</Link
                                >.
                            </p>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                Article 8 – Acceptation
                            </h2>
                            <p>
                                La participation au jeu implique l’acceptation pleine et entière du présent règlement.
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
