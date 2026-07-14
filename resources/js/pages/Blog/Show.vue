<script setup lang="ts">
import SEO from '@/components/SEO.vue';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

interface Media {
    id: number;
    file_name: string;
    mime_type: string;
    size: number;
    url: string;
}

interface Article {
    id: number;
    title: string;
    slug: string;
    content: string;
    published_at: string | null;
    created_at: string;
    updated_at: string;
    media?: Media[];
    image_url?: string | null;
}

interface Props {
    article: Article;
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

const getImageUrl = () => {
    if (props.article.image_url) {
        return props.article.image_url;
    }
    return '/images/placeholder.png';
};

const currentUrl = computed(() => {
    if (typeof window !== 'undefined') {
        return window.location.href;
    }
    return '';
});

const excerpt = computed(() => props.article.content.replace(/<[^>]*>/g, '').substring(0, 160));

// Le schéma BlogPosting (JSON-LD) est fourni par BlogController et rendu
// côté serveur dans app.blade.php via la prop `structuredData`.
</script>

<template>
    <SEO
        :title="article.title"
        :description="excerpt"
        :canonical="`/blog/${article.slug}`"
        :og-image="getImageUrl()"
    />

    <div class="min-h-screen bg-[#080c14] text-white">
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
                            <Link href="/espace-client" class="px-4 py-2 text-sm font-medium text-white/50 hover:text-white/80 transition-colors rounded-xl border border-white/[0.10] hover:border-white/25">
                                Espace client
                            </Link>
                            <Link href="/#contact" class="ml-2 px-5 py-2 text-sm font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white transition-all duration-200 shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40">
                                Démarrer →
                            </Link>
                        </div>
                    </nav>
                </div>
            </div>
        </header>

        <main class="px-6 pt-36 pb-20">
            <div class="container mx-auto max-w-7xl">
                <Link
                    href="/blog"
                    class="group mb-8 inline-flex items-center gap-2 rounded-lg border border-slate-700/50 bg-slate-800/50 px-4 py-2 text-sm font-medium text-blue-400 transition-all hover:border-blue-500/50 hover:bg-slate-800 hover:text-blue-300"
                >
                    <svg
                        class="h-4 w-4 transition-transform group-hover:-translate-x-1"
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
                    Retour au blog
                </Link>

                <article
                    class="overflow-hidden rounded-3xl border border-slate-700/50 bg-gradient-to-br from-slate-800/90 to-slate-900/90 backdrop-blur-sm shadow-2xl"
                >
                    <div class="relative h-[500px] overflow-hidden">
                        <img
                            :src="getImageUrl()"
                            :alt="article.title"
                            class="h-full w-full object-cover"
                            loading="eager"
                        />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/60 to-transparent"
                        ></div>
                        <div
                            class="absolute bottom-0 left-0 right-0 p-8 md:p-12"
                        >
                            <time
                                v-if="article.published_at"
                                class="mb-3 block text-sm font-medium uppercase tracking-wide text-slate-300"
                            >
                                {{ formatDate(article.published_at) }}
                            </time>
                            <h1
                                class="bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 bg-clip-text text-4xl font-black leading-tight text-transparent drop-shadow-lg md:text-5xl lg:text-6xl"
                            >
                                {{ article.title }}
                            </h1>
                        </div>
                    </div>

                    <div class="p-8 md:p-12 lg:p-16">
                        <div
                            class="article-content prose prose-invert prose-lg prose-headings:text-white prose-headings:font-bold prose-p:text-slate-300 prose-p:leading-relaxed prose-a:text-blue-400 prose-a:no-underline hover:prose-a:text-blue-300 prose-strong:text-white prose-strong:font-semibold prose-code:text-blue-300 prose-code:bg-slate-800 prose-code:px-2 prose-code:py-1 prose-code:rounded prose-code:text-sm prose-blockquote:border-blue-500 prose-blockquote:bg-slate-800/50 prose-blockquote:py-4 prose-blockquote:px-6 prose-blockquote:rounded-r-lg prose-img:rounded-lg prose-img:shadow-xl max-w-none"
                            v-html="article.content"
                        ></div>
                    </div>
                </article>

                <div class="mt-16 border-t border-slate-700/50 pt-12">
                    <div class="flex flex-col items-center gap-6 md:flex-row md:justify-between">
                        <div class="text-center md:text-left">
                            <p class="text-sm font-medium text-slate-400">
                                Partager cet article
                            </p>
                            <div class="mt-2 flex items-center gap-3">
                                <a
                                    :href="`https://x.com/intent/tweet?text=${encodeURIComponent(article.title)}&url=${encodeURIComponent(currentUrl)}`"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="rounded-lg bg-slate-800/50 p-2 text-slate-400 transition-colors hover:bg-blue-500/20 hover:text-blue-400"
                                    aria-label="Partager sur X (Twitter)"
                                >
                                    <svg
                                        class="h-5 w-5"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"
                                        />
                                    </svg>
                                </a>
                                <a
                                    :href="`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentUrl)}`"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="rounded-lg bg-slate-800/50 p-2 text-slate-400 transition-colors hover:bg-blue-500/20 hover:text-blue-400"
                                    aria-label="Partager sur Facebook"
                                >
                                    <svg
                                        class="h-5 w-5"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"
                                        />
                                    </svg>
                                </a>
                                <a
                                    :href="`https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(currentUrl)}`"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="rounded-lg bg-slate-800/50 p-2 text-slate-400 transition-colors hover:bg-blue-500/20 hover:text-blue-400"
                                    aria-label="Partager sur LinkedIn"
                                >
                                    <svg
                                        class="h-5 w-5"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"
                                        />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <Link
                            href="/blog"
                            class="group inline-flex items-center gap-2 rounded-lg border border-slate-700 bg-slate-800/50 px-6 py-3 font-medium text-slate-300 transition-all hover:border-blue-500/50 hover:bg-slate-800 hover:text-white"
                        >
                            <svg
                                class="h-5 w-5 transition-transform group-hover:-translate-x-1"
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
                            Retour au blog
                        </Link>
                    </div>
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
/* Styles pour le contenu de l'éditeur riche */
.article-content :deep(h1) {
    font-size: 2.5em;
    font-weight: 800;
    margin-top: 1.5em;
    margin-bottom: 0.75em;
    line-height: 1.2;
    color: rgb(255 255 255);
}

.article-content :deep(h2) {
    font-size: 2em;
    font-weight: 700;
    margin-top: 2em;
    margin-bottom: 1em;
    line-height: 1.3;
    color: rgb(255 255 255);
    border-bottom: 2px solid rgb(59 130 246 / 0.3);
    padding-bottom: 0.5em;
}

.article-content :deep(h3) {
    font-size: 1.5em;
    font-weight: 600;
    margin-top: 1.5em;
    margin-bottom: 0.75em;
    line-height: 1.4;
    color: rgb(255 255 255);
}

.article-content :deep(h4) {
    font-size: 1.25em;
    font-weight: 600;
    margin-top: 1.25em;
    margin-bottom: 0.5em;
    color: rgb(255 255 255);
}

.article-content :deep(p) {
    margin-top: 1.25em;
    margin-bottom: 1.25em;
    line-height: 1.8;
    color: rgb(203 213 225);
    font-size: 1.125em;
}

.article-content :deep(p:first-of-type) {
    margin-top: 0;
    font-size: 1.25em;
    color: rgb(226 232 240);
}

.article-content :deep(a) {
    color: rgb(96 165 250);
    text-decoration: none;
    border-bottom: 1px solid rgb(96 165 250 / 0.3);
    transition: all 0.2s;
}

.article-content :deep(a:hover) {
    color: rgb(147 197 253);
    border-bottom-color: rgb(147 197 253);
}

.article-content :deep(ul),
.article-content :deep(ol) {
    margin-top: 1.5em;
    margin-bottom: 1.5em;
    padding-left: 2em;
    color: rgb(203 213 225);
}

.article-content :deep(ul) {
    list-style-type: disc;
}

.article-content :deep(ol) {
    list-style-type: decimal;
}

.article-content :deep(li) {
    margin-top: 0.75em;
    margin-bottom: 0.75em;
    line-height: 1.7;
    padding-left: 0.5em;
}

.article-content :deep(li::marker) {
    color: rgb(96 165 250);
}

.article-content :deep(strong) {
    color: rgb(255 255 255);
    font-weight: 700;
}

.article-content :deep(em) {
    font-style: italic;
    color: rgb(226 232 240);
}

.article-content :deep(code) {
    color: rgb(147 197 253);
    background-color: rgb(30 41 59);
    padding: 0.25rem 0.5rem;
    border-radius: 0.375rem;
    font-size: 0.9em;
    font-family: 'Courier New', monospace;
    border: 1px solid rgb(51 65 85);
}

.article-content :deep(pre) {
    background-color: rgb(15 23 42);
    border: 1px solid rgb(51 65 85);
    border-radius: 0.5rem;
    padding: 1.5em;
    margin: 1.5em 0;
    overflow-x: auto;
}

.article-content :deep(pre code) {
    background-color: transparent;
    padding: 0;
    border: none;
    color: rgb(203 213 225);
}

.article-content :deep(blockquote) {
    border-left: 4px solid rgb(59 130 246);
    background-color: rgb(30 41 59 / 0.5);
    padding: 1.5em 2em;
    margin: 2em 0;
    border-radius: 0 0.5rem 0.5rem 0;
    font-style: italic;
    color: rgb(203 213 225);
    position: relative;
}

.article-content :deep(blockquote::before) {
    content: '"';
    font-size: 4em;
    color: rgb(59 130 246 / 0.3);
    position: absolute;
    left: 0.5em;
    top: -0.2em;
    line-height: 1;
}

.article-content :deep(img) {
    border-radius: 0.75rem;
    margin: 2em auto;
    max-width: 100%;
    height: auto;
    box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.3),
        0 10px 10px -5px rgb(0 0 0 / 0.2);
}

.article-content :deep(hr) {
    border: none;
    border-top: 2px solid rgb(51 65 85);
    margin: 3em 0;
}

.article-content :deep(table) {
    width: 100%;
    border-collapse: collapse;
    margin: 2em 0;
    background-color: rgb(30 41 59 / 0.5);
    border-radius: 0.5rem;
    overflow: hidden;
}

.article-content :deep(th),
.article-content :deep(td) {
    padding: 0.75em 1em;
    text-align: left;
    border-bottom: 1px solid rgb(51 65 85);
}

.article-content :deep(th) {
    background-color: rgb(51 65 85);
    font-weight: 600;
    color: rgb(255 255 255);
}

.article-content :deep(tr:hover) {
    background-color: rgb(51 65 85 / 0.3);
}
</style>

