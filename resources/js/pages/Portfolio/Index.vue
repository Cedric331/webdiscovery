<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

interface Portfolio {
    id: number;
    title: string;
    description: string;
    url: string | null;
    tags: string[] | null;
    is_published: boolean;
    created_at: string;
    updated_at: string;
    image_url?: string | null;
}

interface Props {
    portfolios: {
        data: Portfolio[];
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
    };
}

const props = defineProps<Props>();

const formatDate = (date: string | null) => {
    if (!date) return '';
    return new Date(date).toLocaleDateString('fr-FR', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
};

const getImageUrl = (portfolio: Portfolio) => {
    if (portfolio.image_url) return portfolio.image_url;
    return '/images/placeholder.png';
};

const handleClick = (portfolio: Portfolio) => {
    if (portfolio.url) {
        window.open(portfolio.url, '_blank', 'noopener,noreferrer');
    }
};

const getTags = (portfolio: Portfolio): string[] => {
    if (!portfolio.tags) return [];
    if (Array.isArray(portfolio.tags)) {
        return portfolio.tags.filter((tag: string) => tag && tag.trim() !== '');
    }
    if (typeof portfolio.tags === 'string') {
        const tagsStr: string = portfolio.tags;
        try {
            const parsed = JSON.parse(tagsStr);
            if (Array.isArray(parsed)) {
                return parsed.filter((tag: string) => tag && tag.trim() !== '');
            }
        } catch {
            return tagsStr.split(',').map((tag: string) => tag.trim()).filter((tag: string) => tag !== '');
        }
    }
    return [];
};
</script>

<template>
    <Head>
        <title>Portfolio - Web Discovery</title>
        <meta name="description" content="Découvrez nos créations : sites web vitrine, applications SaaS et projets de développement web." />
    </Head>

    <div class="min-h-screen bg-[#080c14] text-white">

        <!-- Header -->
        <header class="fixed top-0 inset-x-0 z-50" role="banner">
            <div class="mx-auto max-w-7xl px-6">
                <div class="mt-4 rounded-2xl border border-white/[0.06] bg-white/[0.03] backdrop-blur-2xl shadow-xl shadow-black/20">
                    <nav class="flex items-center justify-between px-6 py-3">
                        <Link href="/" class="flex items-center gap-3 group">
                            <img src="/asset/logo.png" alt="Logo Web Discovery" class="h-9 w-auto object-contain transition-opacity group-hover:opacity-90" loading="lazy" />
                            <span class="text-sm font-bold tracking-widest text-white/80 uppercase">Web Discovery</span>
                        </Link>

                        <div class="hidden md:flex items-center gap-1">
                            <Link href="/#technologies" class="px-4 py-2 text-sm font-medium text-white/50 hover:text-white/80 transition-colors rounded-xl hover:bg-white/[0.05]">Technologies</Link>
                            <Link href="/#entreprise" class="px-4 py-2 text-sm font-medium text-white/50 hover:text-white/80 transition-colors rounded-xl hover:bg-white/[0.05]">À propos</Link>
                            <Link href="/#tarifs" class="px-4 py-2 text-sm font-medium text-white/50 hover:text-white/80 transition-colors rounded-xl hover:bg-white/[0.05]">Tarifs</Link>
                            <Link href="/#contact" class="px-4 py-2 text-sm font-medium text-white/50 hover:text-white/80 transition-colors rounded-xl hover:bg-white/[0.05]">Contact</Link>
                            <div class="mx-3 h-5 w-px bg-white/10"></div>
                            <Link href="/portfolio" class="relative px-4 py-2 text-sm font-medium text-white rounded-xl">
                                <span class="absolute inset-0 rounded-xl bg-white/[0.08]"></span>
                                <span class="relative">Réalisations</span>
                            </Link>
                            <Link href="/blog" class="px-4 py-2 text-sm font-medium text-white/50 hover:text-white/80 transition-colors rounded-xl hover:bg-white/[0.05]">Blog</Link>
                            <Link href="/#contact" class="ml-2 px-5 py-2 text-sm font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white transition-all duration-200 shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40">
                                Démarrer →
                            </Link>
                        </div>
                    </nav>
                </div>
            </div>
        </header>

        <!-- Hero -->
        <div class="relative pt-40 pb-16 px-6 text-center overflow-hidden">
            <div class="absolute inset-0 pointer-events-none bg-[radial-gradient(ellipse_60%_40%_at_50%_0%,rgba(99,102,241,0.12),transparent)]"></div>
            <div class="relative z-10 space-y-4">
                <span class="inline-block px-3 py-1 rounded-full border border-white/10 bg-white/[0.03] text-xs font-medium text-white/50 uppercase tracking-widest">
                    Nos créations
                </span>
                <h1 class="text-5xl sm:text-6xl font-black text-white">
                    Port<span class="gradient-text">folio</span>
                </h1>
                <p class="mx-auto max-w-xl text-white/45 text-lg">
                    Sites web vitrine, applications SaaS et projets de développement web sur mesure.
                </p>
            </div>
        </div>

        <!-- Content -->
        <main class="px-6 pb-24">
            <div class="mx-auto max-w-7xl">

                <!-- Empty state -->
                <div v-if="portfolios.data.length === 0" class="mx-auto max-w-md text-center rounded-3xl border border-white/[0.06] bg-white/[0.02] p-16">
                    <svg class="mx-auto mb-4 h-12 w-12 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <p class="font-medium text-white/50">Aucune création disponible pour le moment.</p>
                    <p class="mt-1 text-sm text-white/25">Revenez bientôt !</p>
                </div>

                <!-- Grid -->
                <div v-else class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <article
                        v-for="portfolio in portfolios.data"
                        :key="portfolio.id"
                        class="group relative flex flex-col overflow-hidden rounded-2xl border border-white/[0.06] bg-white/[0.02] hover:border-indigo-500/30 hover:bg-white/[0.04] transition-all duration-300 cursor-pointer"
                        :class="{ 'hover:-translate-y-1': !!portfolio.url }"
                        @click="handleClick(portfolio)"
                    >
                        <!-- Image -->
                        <div class="relative h-52 overflow-hidden flex-shrink-0">
                            <img
                                :src="getImageUrl(portfolio)"
                                :alt="portfolio.title"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            />
                            <div class="absolute inset-0 bg-gradient-to-t from-[#080c14] via-[#080c14]/30 to-transparent"></div>
                        </div>

                        <!-- Body -->
                        <div class="flex flex-col flex-grow p-6">
                            <h2 class="mb-2 text-lg font-bold text-white group-hover:text-indigo-300 transition-colors leading-snug">
                                {{ portfolio.title }}
                            </h2>
                            <p class="mb-4 text-sm text-white/45 leading-relaxed line-clamp-3 flex-grow">
                                {{ portfolio.description }}
                            </p>

                            <!-- Tags -->
                            <div v-if="getTags(portfolio).length > 0" class="mb-4 flex flex-wrap gap-1.5">
                                <span v-for="tag in getTags(portfolio)" :key="tag"
                                    class="px-2.5 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-xs font-medium text-indigo-300">
                                    {{ tag }}
                                </span>
                            </div>

                            <div v-if="portfolio.url" class="mt-auto flex items-center gap-1.5 text-sm font-semibold text-indigo-400 group-hover:text-indigo-300 transition-colors">
                                Voir le projet
                                <svg class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Pagination -->
                <div v-if="portfolios.last_page > 1" class="mt-16 flex flex-wrap items-center justify-center gap-3">
                    <Link
                        v-if="portfolios.current_page > 1"
                        :href="`/portfolio?page=${portfolios.current_page - 1}`"
                        class="flex items-center gap-2 px-5 py-2.5 rounded-xl border border-white/[0.08] bg-white/[0.02] text-sm text-white/60 hover:text-white hover:bg-white/[0.06] transition-all"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Précédent
                    </Link>

                    <div class="flex items-center gap-1">
                        <template v-for="page in portfolios.last_page" :key="page">
                            <Link v-if="page !== portfolios.current_page" :href="`/portfolio?page=${page}`"
                                class="h-9 w-9 rounded-lg text-sm font-medium text-white/40 hover:text-white hover:bg-white/[0.06] transition-all flex items-center justify-center">
                                {{ page }}
                            </Link>
                            <span v-else class="h-9 w-9 rounded-lg text-sm font-medium text-white bg-indigo-600 flex items-center justify-center">
                                {{ page }}
                            </span>
                        </template>
                    </div>

                    <Link
                        v-if="portfolios.current_page < portfolios.last_page"
                        :href="`/portfolio?page=${portfolios.current_page + 1}`"
                        class="flex items-center gap-2 px-5 py-2.5 rounded-xl border border-white/[0.08] bg-white/[0.02] text-sm text-white/60 hover:text-white hover:bg-white/[0.06] transition-all"
                    >
                        Suivant
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </Link>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="border-t border-white/[0.06] bg-white/[0.01] px-6 py-16" role="contentinfo">
            <div class="mx-auto max-w-7xl">
                <div class="grid gap-10 md:grid-cols-3 mb-12">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <img src="/asset/logo.png" alt="Logo Web Discovery" class="h-9 w-auto object-contain opacity-80" loading="lazy" />
                            <span class="font-bold text-white/80 tracking-wider text-sm uppercase">Web Discovery</span>
                        </div>
                        <p class="text-sm text-white/35 leading-relaxed max-w-xs">
                            Création de sites web vitrine et applications SaaS sur mesure avec Laravel &amp; Vue.js.
                        </p>
                    </div>

                    <div>
                        <h3 class="mb-4 text-xs font-semibold text-white/40 uppercase tracking-widest">Navigation</h3>
                        <ul class="space-y-2.5 text-sm">
                            <li><Link href="/#technologies" class="text-white/40 hover:text-white/80 transition-colors">Technologies</Link></li>
                            <li><Link href="/#entreprise" class="text-white/40 hover:text-white/80 transition-colors">À propos</Link></li>
                            <li><Link href="/#tarifs" class="text-white/40 hover:text-white/80 transition-colors">Tarifs</Link></li>
                            <li><Link href="/#contact" class="text-white/40 hover:text-white/80 transition-colors">Contact</Link></li>
                            <li><Link href="/portfolio" class="text-white/40 hover:text-white/80 transition-colors">Réalisations</Link></li>
                            <li><Link href="/blog" class="text-white/40 hover:text-white/80 transition-colors">Blog</Link></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="mb-4 text-xs font-semibold text-white/40 uppercase tracking-widest">Légal</h3>
                        <ul class="space-y-2.5 text-sm">
                            <li><Link href="/mentions-legales" class="text-white/40 hover:text-white/80 transition-colors">Mentions légales</Link></li>
                            <li><Link href="/politique-confidentialite" class="text-white/40 hover:text-white/80 transition-colors">Politique de confidentialité</Link></li>
                        </ul>
                    </div>
                </div>

                <div class="pt-8 border-t border-white/[0.06] flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-white/25">© {{ new Date().getFullYear() }} Web Discovery. Tous droits réservés.</p>
                    <span class="text-xs text-indigo-400/50">Laravel · Vue.js · InertiaJS</span>
                </div>
            </div>
        </footer>
    </div>
</template>

<style scoped>
.gradient-text {
    background: linear-gradient(135deg, #818cf8 0%, #6366f1 40%, #3b82f6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
