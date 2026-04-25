<script setup lang="ts">
import SEO from '@/components/SEO.vue';
import { Link } from '@inertiajs/vue3';

interface Article {
    id: number;
    title: string;
    slug: string;
    content: string;
    published_at: string | null;
    created_at: string;
    updated_at: string;
    image_url?: string | null;
    media?: Array<{
        id: number;
        file_name: string;
        mime_type: string;
        size: number;
        url: string;
    }>;
}

interface Props {
    articles: {
        data: Article[];
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

const getImageUrl = (article: Article) => {
    if (article.image_url) return article.image_url;
    return '/images/placeholder.png';
};

const excerpt = (content: string, length: number = 150) => {
    const text = content.replace(/<[^>]*>/g, '');
    return text.length > length ? text.substring(0, length) + '...' : text;
};
</script>

<template>
    <SEO
        title="Blog - Web Discovery"
        description="Découvrez nos articles sur le développement web, la création de sites web vitrine et les applications SaaS."
        canonical="/blog"
        keywords="blog développement web, articles création site web, blog SaaS, actualités web"
    />

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
                            <Link href="/portfolio" class="px-4 py-2 text-sm font-medium text-white/50 hover:text-white/80 transition-colors rounded-xl hover:bg-white/[0.05]">Réalisations</Link>
                            <Link href="/blog" class="relative px-4 py-2 text-sm font-medium text-white rounded-xl">
                                <span class="absolute inset-0 rounded-xl bg-white/[0.08]"></span>
                                <span class="relative">Blog</span>
                            </Link>
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
                    Articles & Actualités
                </span>
                <h1 class="text-5xl sm:text-6xl font-black text-white">
                    Notre <span class="gradient-text">Blog</span>
                </h1>
                <p class="mx-auto max-w-xl text-white/45 text-lg">
                    Développement web, création de sites vitrine et applications SaaS — nos insights et retours d'expérience.
                </p>
            </div>
        </div>

        <!-- Content -->
        <main class="px-6 pb-24">
            <div class="mx-auto max-w-7xl">

                <!-- Empty state -->
                <div v-if="articles.data.length === 0" class="mx-auto max-w-md text-center rounded-3xl border border-white/[0.06] bg-white/[0.02] p-16">
                    <svg class="mx-auto mb-4 h-12 w-12 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="font-medium text-white/50">Aucun article disponible pour le moment.</p>
                    <p class="mt-1 text-sm text-white/25">Revenez bientôt !</p>
                </div>

                <!-- Grid -->
                <div v-else class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <article
                        v-for="article in articles.data"
                        :key="article.id"
                        class="group relative flex flex-col overflow-hidden rounded-2xl border border-white/[0.06] bg-white/[0.02] hover:border-indigo-500/30 hover:bg-white/[0.04] transition-all duration-300 hover:-translate-y-1"
                    >
                        <Link :href="`/blog/${article.slug}`" class="flex flex-col h-full">
                            <!-- Image -->
                            <div class="relative h-52 overflow-hidden flex-shrink-0">
                                <img
                                    :src="getImageUrl(article)"
                                    :alt="article.title"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    loading="lazy"
                                />
                                <div class="absolute inset-0 bg-gradient-to-t from-[#080c14] via-[#080c14]/30 to-transparent"></div>
                                <div class="absolute top-3 right-3 px-2.5 py-1 rounded-full bg-indigo-500/20 border border-indigo-500/30 text-xs font-semibold text-indigo-300 backdrop-blur-sm">
                                    Article
                                </div>
                            </div>

                            <!-- Body -->
                            <div class="flex flex-col flex-grow p-6">
                                <time v-if="article.published_at" class="mb-2 block text-xs font-medium text-white/30 uppercase tracking-wide">
                                    {{ formatDate(article.published_at) }}
                                </time>
                                <h2 class="mb-3 text-lg font-bold text-white group-hover:text-indigo-300 transition-colors leading-snug">
                                    {{ article.title }}
                                </h2>
                                <div class="article-excerpt mb-4 text-sm text-white/45 leading-relaxed line-clamp-3 flex-grow"
                                    v-html="excerpt(article.content, 120)">
                                </div>
                                <div class="mt-auto flex items-center gap-1.5 text-sm font-semibold text-indigo-400 group-hover:text-indigo-300 transition-colors">
                                    Lire la suite
                                    <svg class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </Link>
                    </article>
                </div>

                <!-- Pagination -->
                <div v-if="articles.last_page > 1" class="mt-16 flex flex-wrap items-center justify-center gap-3">
                    <Link
                        v-if="articles.current_page > 1"
                        :href="`/blog?page=${articles.current_page - 1}`"
                        class="flex items-center gap-2 px-5 py-2.5 rounded-xl border border-white/[0.08] bg-white/[0.02] text-sm text-white/60 hover:text-white hover:bg-white/[0.06] transition-all"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Précédent
                    </Link>

                    <div class="flex items-center gap-1">
                        <template v-for="page in articles.last_page" :key="page">
                            <Link v-if="page !== articles.current_page" :href="`/blog?page=${page}`"
                                class="h-9 w-9 rounded-lg text-sm font-medium text-white/40 hover:text-white hover:bg-white/[0.06] transition-all flex items-center justify-center">
                                {{ page }}
                            </Link>
                            <span v-else class="h-9 w-9 rounded-lg text-sm font-medium text-white bg-indigo-600 flex items-center justify-center">
                                {{ page }}
                            </span>
                        </template>
                    </div>

                    <Link
                        v-if="articles.current_page < articles.last_page"
                        :href="`/blog?page=${articles.current_page + 1}`"
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

.article-excerpt :deep(p) {
    margin: 0;
    line-height: 1.6;
}

.article-excerpt :deep(strong) {
    font-weight: 600;
    color: rgba(255, 255, 255, 0.8);
}

.article-excerpt :deep(em) {
    font-style: italic;
}

.article-excerpt :deep(a) {
    color: #818cf8;
    text-decoration: underline;
}
</style>
