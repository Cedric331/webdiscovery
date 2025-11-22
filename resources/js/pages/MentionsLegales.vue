<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head>
        <title>Mentions Légales - Web Discovery</title>
        <meta
            name="description"
            content="Mentions légales de Web Discovery - Informations légales et coordonnées"
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
                        Mentions Légales
                    </h1>

                    <div class="space-y-8 leading-relaxed text-slate-300">
                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                1. Éditeur du site
                            </h2>
                            <p>
                                Le site
                                <strong class="text-white"
                                    >web-discovery.fr</strong
                                >
                                est édité par :
                            </p>
                            <p class="mt-2">
                                <strong class="text-white">Web Discovery</strong
                                ><br />
                                Développement Web & SaaS<br />
                                <!-- Remplacez par vos coordonnées réelles -->
                                Email : limacedric@hotmail.fr
                            </p>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                2. Hébergement
                            </h2>
                            <p>
                                Le site est hébergé par :<br />
                                <!-- Remplacez par les informations de votre hébergeur -->
                                OVH SAS<br />
                                2, rue Kellermann, 59100 Roubaix<br />
                            </p>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                3. Propriété intellectuelle
                            </h2>
                            <p>
                                L'ensemble du contenu de ce site (textes,
                                images, vidéos, logos, etc.) est la propriété
                                exclusive de Web Discovery, sauf mention
                                contraire. Toute reproduction, même partielle,
                                est interdite sans autorisation préalable.
                            </p>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                4. Protection des données
                            </h2>
                            <p>
                                Conformément au Règlement Général sur la
                                Protection des Données (RGPD), vous disposez
                                d'un droit d'accès, de rectification, de
                                suppression et d'opposition aux données vous
                                concernant. Pour exercer ces droits,
                                contactez-nous à l'adresse :
                                limacedric@hotmail.fr
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
                                5. Cookies
                            </h2>
                            <p>
                                Ce site utilise des cookies pour améliorer
                                l'expérience utilisateur. En continuant à
                                naviguer sur ce site, vous acceptez
                                l'utilisation de cookies conformément à notre
                                politique de confidentialité.
                            </p>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                6. Responsabilité
                            </h2>
                            <p>
                                Web Discovery ne pourra être tenu responsable
                                des dommages directs ou indirects causés au
                                matériel de l'utilisateur lors de l'accès au
                                site, et résultant soit de l'utilisation d'un
                                matériel ne répondant pas aux spécifications,
                                soit de l'apparition d'un bug ou d'une
                                incompatibilité.
                            </p>
                        </section>

                        <section>
                            <h2 class="mb-4 text-2xl font-bold text-white">
                                7. Droit applicable
                            </h2>
                            <p>
                                Les présentes mentions légales sont régies par
                                le droit français. En cas de litige, les
                                tribunaux français seront seuls compétents.
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
