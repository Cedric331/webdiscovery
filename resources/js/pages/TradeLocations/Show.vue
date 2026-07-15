<script setup lang="ts">
import SEO from '@/components/SEO.vue';
import { Link, useForm } from '@inertiajs/vue3';

interface PageData {
    slug: string;
    trade: string;
    city: string;
    zones: string[];
    cityUrl: string;
    title: string;
    description: string;
    h1: string;
    keywords: string;
    intro: string;
    localContext: string;
    problems: string[];
    solutions: string[];
    faq: Array<{ question: string; answer: string }>;
}

interface Props {
    page: PageData;
    structuredData: Array<Record<string, unknown>>;
}

const props = defineProps<Props>();

const form = useForm({
    name: '',
    email: '',
    phone: '',
    project_type: 'site-vitrine',
    message: `Bonjour, je suis ${props.page.trade.toLowerCase()} à ${props.page.city} et je souhaite créer un site web.`,
});

const submit = () => {
    form.post('/contact', {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <SEO
        :title="page.title"
        :description="page.description"
        :canonical="`/${page.slug}`"
        :keywords="page.keywords"
    />

    <div class="min-h-screen bg-slate-950 text-white">
        <!-- Header -->
        <header
            class="fixed top-0 right-0 left-0 z-50 border-b border-slate-800 bg-slate-950/80 backdrop-blur-xl"
            role="banner"
        >
            <nav class="container mx-auto flex items-center justify-between px-6 py-4">
                <Link href="/" class="group flex items-center gap-3">
                    <img src="/asset/logo.png" alt="Logo Web Discovery" class="h-10 w-auto object-contain" loading="lazy" />
                    <span class="text-xl font-bold">WEB DISCOVERY</span>
                </Link>
                <div class="hidden items-center gap-6 md:flex">
                    <Link href="/" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-300 transition-colors hover:bg-slate-800 hover:text-white">Accueil</Link>
                    <Link href="/portfolio" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-300 transition-colors hover:bg-slate-800 hover:text-white">Réalisations</Link>
                    <Link href="/blog" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-300 transition-colors hover:bg-slate-800 hover:text-white">Blog</Link>
                </div>
            </nav>
        </header>

        <main class="px-6 pt-32 pb-24" role="main">
            <div class="container mx-auto max-w-5xl">
                <!-- Fil d'Ariane -->
                <nav class="mb-6 text-sm text-slate-400" aria-label="Fil d'Ariane">
                    <Link href="/" class="transition-colors hover:text-blue-400">Accueil</Link>
                    <span class="mx-2">/</span>
                    <span class="text-slate-300">{{ page.h1 }}</span>
                </nav>

                <h1 class="mb-6 text-4xl font-black leading-tight md:text-6xl">
                    <span class="block text-white">{{ page.h1 }}</span>
                    <span class="block bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent">
                        Professionnel et Optimisé SEO
                    </span>
                </h1>

                <p class="mb-8 text-xl leading-relaxed text-slate-300">{{ page.intro }}</p>

                <div class="mb-16">
                    <a href="#contact"
                        class="inline-block transform rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 px-8 py-4 font-semibold text-white shadow-lg shadow-blue-500/20 transition-all hover:scale-105 hover:from-blue-600 hover:to-blue-700 hover:shadow-blue-500/40"
                        aria-label="Demander un devis">
                        Demander un devis gratuit
                    </a>
                </div>

                <!-- Contexte local -->
                <section class="mb-16 rounded-2xl border border-slate-700 bg-slate-800/50 p-8 md:p-12">
                    <h2 class="mb-6 text-3xl font-bold text-white">
                        {{ page.trade }} à {{ page.city }} : pourquoi un site web change tout
                    </h2>
                    <p class="text-lg leading-relaxed text-slate-300">{{ page.localContext }}</p>
                </section>

                <!-- Problèmes -->
                <section class="mb-16">
                    <h2 class="mb-6 text-3xl font-bold text-white">Les défis que vous rencontrez</h2>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div v-for="(problem, index) in page.problems" :key="index"
                            class="rounded-lg border border-slate-700 bg-slate-800/50 p-6">
                            <div class="mb-2 flex items-center gap-3">
                                <span class="text-2xl">❌</span>
                                <h3 class="text-lg font-semibold text-white">Problème</h3>
                            </div>
                            <p class="text-slate-300">{{ problem }}</p>
                        </div>
                    </div>
                </section>

                <!-- Solutions -->
                <section class="mb-16">
                    <h2 class="mb-6 text-3xl font-bold text-white">Notre solution pour vous</h2>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div v-for="(solution, index) in page.solutions" :key="index"
                            class="rounded-lg border border-blue-500/30 bg-gradient-to-br from-blue-900/20 to-slate-800/50 p-6">
                            <div class="mb-2 flex items-center gap-3">
                                <span class="text-2xl">✅</span>
                                <h3 class="text-lg font-semibold text-white">Solution</h3>
                            </div>
                            <p class="text-slate-300">{{ solution }}</p>
                        </div>
                    </div>
                </section>

                <!-- Zones -->
                <section class="mb-16">
                    <h2 class="mb-6 text-3xl font-bold text-white">Zones d'intervention autour de {{ page.city }}</h2>
                    <div class="flex flex-wrap gap-3">
                        <span v-for="zone in page.zones" :key="zone"
                            class="rounded-full border border-slate-700 bg-slate-800/50 px-4 py-2 text-sm text-slate-300">
                            {{ zone }}
                        </span>
                    </div>
                    <p class="mt-6 text-slate-400">
                        Voir aussi :
                        <Link :href="page.cityUrl" class="text-blue-400 underline transition-colors hover:text-blue-300">
                            création de site web à {{ page.city }}
                        </Link>
                    </p>
                </section>

                <!-- Offre / tarif -->
                <section class="mb-16 rounded-2xl border border-slate-700 bg-slate-800/50 p-8 md:p-12">
                    <h2 class="mb-6 text-3xl font-bold text-white">Ce que vous obtenez</h2>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <h3 class="mb-4 text-xl font-semibold text-white">Site web professionnel</h3>
                            <ul class="space-y-3 text-slate-300">
                                <li v-for="item in ['Design moderne et responsive', 'Optimisation SEO local intégrée', 'Formulaire de contact / devis', 'Intégration Google Maps', 'Mise en ligne incluse', 'Support après livraison']" :key="item" class="flex items-center gap-3">
                                    <span class="h-2 w-2 rounded-full bg-blue-400"></span>
                                    <span>{{ item }}</span>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="mb-4 text-xl font-semibold text-white">Tarifs</h3>
                            <div class="mb-4">
                                <div class="mb-2 text-sm font-semibold text-blue-400">À partir de</div>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-5xl font-black text-white">500€</span>
                                </div>
                            </div>
                            <p class="text-sm text-slate-300">
                                Le prix varie selon le nombre de pages, les fonctionnalités
                                et les intégrations. Un devis personnalisé et gratuit est établi
                                après analyse de vos besoins.
                            </p>
                        </div>
                    </div>
                </section>

                <!-- FAQ -->
                <section class="mb-16">
                    <h2 class="mb-6 text-3xl font-bold text-white">Questions fréquentes</h2>
                    <div class="space-y-4">
                        <details v-for="(faq, index) in page.faq" :key="index"
                            class="group rounded-lg border border-slate-700 bg-slate-800/50 p-6">
                            <summary class="cursor-pointer text-lg font-semibold text-white transition-colors hover:text-blue-400">
                                {{ faq.question }}
                            </summary>
                            <p class="mt-4 text-slate-300">{{ faq.answer }}</p>
                        </details>
                    </div>
                </section>

                <!-- Contact -->
                <section id="contact" class="rounded-2xl border border-slate-700 bg-slate-800/50 p-8 md:p-12">
                    <h2 class="mb-6 text-3xl font-bold text-white">Demandez votre devis gratuit</h2>
                    <p class="mb-8 text-slate-300">
                        Vous êtes {{ page.trade.toLowerCase() }} à {{ page.city }} et vous voulez un site
                        qui vous apporte des clients ? Remplissez le formulaire, nous vous répondons rapidement.
                    </p>

                    <form @submit.prevent="submit" class="space-y-6">
                        <transition
                            enter-active-class="transition ease-out duration-300"
                            enter-from-class="opacity-0 transform translate-y-2"
                            enter-to-class="opacity-100 transform translate-y-0"
                        >
                            <div v-if="$page.props.flash?.success" class="rounded-lg border border-green-500/50 bg-green-500/20 px-4 py-3 text-green-300">
                                {{ $page.props.flash.success }}
                            </div>
                        </transition>
                        <transition
                            enter-active-class="transition ease-out duration-300"
                            enter-from-class="opacity-0 transform translate-y-2"
                            enter-to-class="opacity-100 transform translate-y-0"
                        >
                            <div v-if="$page.props.flash?.error" class="rounded-lg border border-red-500/50 bg-red-500/20 px-4 py-3 text-red-300">
                                {{ $page.props.flash.error }}
                            </div>
                        </transition>

                        <div>
                            <label for="name" class="mb-2 block text-sm font-medium text-slate-300">
                                Nom <span class="text-red-400">*</span>
                            </label>
                            <input id="name" v-model="form.name" type="text" required
                                class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-3 text-white placeholder-slate-500 transition-all focus:border-transparent focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Votre nom" />
                            <div v-if="form.errors.name" class="mt-1 text-sm text-red-400">{{ form.errors.name }}</div>
                        </div>

                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-slate-300">
                                Email <span class="text-red-400">*</span>
                            </label>
                            <input id="email" v-model="form.email" type="email" required
                                class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-3 text-white placeholder-slate-500 transition-all focus:border-transparent focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="votre@email.com" />
                            <div v-if="form.errors.email" class="mt-1 text-sm text-red-400">{{ form.errors.email }}</div>
                        </div>

                        <div>
                            <label for="phone" class="mb-2 block text-sm font-medium text-slate-300">Téléphone</label>
                            <input id="phone" v-model="form.phone" type="tel"
                                class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-3 text-white placeholder-slate-500 transition-all focus:border-transparent focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="06 12 34 56 78 (optionnel)" />
                            <div v-if="form.errors.phone" class="mt-1 text-sm text-red-400">{{ form.errors.phone }}</div>
                        </div>

                        <div>
                            <label for="message" class="mb-2 block text-sm font-medium text-slate-300">
                                Message <span class="text-red-400">*</span>
                            </label>
                            <textarea id="message" v-model="form.message" required rows="6"
                                class="w-full resize-none rounded-lg border border-slate-700 bg-slate-900 px-4 py-3 text-white placeholder-slate-500 transition-all focus:border-transparent focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Décrivez votre projet..."></textarea>
                            <div v-if="form.errors.message" class="mt-1 text-sm text-red-400">{{ form.errors.message }}</div>
                        </div>

                        <button type="submit" :disabled="form.processing"
                            class="w-full rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4 font-semibold text-white shadow-lg shadow-blue-500/20 transition-all hover:from-blue-600 hover:to-blue-700 hover:shadow-blue-500/40 focus:ring-2 focus:ring-blue-500 focus:outline-none disabled:cursor-not-allowed disabled:opacity-50">
                            <span v-if="form.processing" class="flex items-center justify-center gap-2">
                                <span class="h-4 w-4 animate-spin rounded-full border-2 border-white border-t-transparent"></span>
                                Envoi en cours...
                            </span>
                            <span v-else>Envoyer la demande</span>
                        </button>
                    </form>
                </section>
            </div>
        </main>

        <!-- Barre d'action fixe mobile -->
        <div class="h-20 md:hidden"></div>
        <div class="fixed inset-x-0 bottom-0 z-50 border-t border-slate-800 bg-slate-950/95 p-3 backdrop-blur-xl md:hidden">
            <a href="#contact" class="block w-full rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-3 text-center font-semibold text-white shadow-lg shadow-blue-500/20">
                Demander un devis gratuit →
            </a>
        </div>

        <!-- Footer -->
        <footer class="border-t border-slate-800 bg-slate-950 px-6 py-12" role="contentinfo">
            <div class="container mx-auto max-w-7xl">
                <div class="mb-8 grid gap-8 md:grid-cols-3">
                    <div>
                        <div class="mb-4 flex items-center gap-3">
                            <img src="/asset/logo.png" alt="Logo Web Discovery" class="h-10 w-auto object-contain" />
                            <span class="text-lg font-bold">WEB DISCOVERY</span>
                        </div>
                        <p class="text-sm text-slate-300">
                            Création de sites web vitrine et applications SaaS sur mesure à Pau et dans le 64.
                        </p>
                    </div>
                    <div>
                        <h3 class="mb-4 text-sm font-semibold text-white">Liens rapides</h3>
                        <ul class="space-y-2 text-sm text-slate-300">
                            <li><Link href="/" class="transition-colors hover:text-blue-400">Accueil</Link></li>
                            <li><Link href="/portfolio" class="transition-colors hover:text-blue-400">Réalisations</Link></li>
                            <li><Link href="/blog" class="transition-colors hover:text-blue-400">Blog</Link></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="mb-4 text-sm font-semibold text-white">Informations légales</h3>
                        <ul class="space-y-2 text-sm text-slate-300">
                            <li><Link href="/mentions-legales" class="transition-colors hover:text-blue-400">Mentions légales</Link></li>
                            <li><Link href="/politique-confidentialite" class="transition-colors hover:text-blue-400">Politique de confidentialité</Link></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-slate-800 pt-6">
                    <p class="text-center text-sm text-slate-300">
                        © {{ new Date().getFullYear() }} Web Discovery. Tous droits réservés.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>
