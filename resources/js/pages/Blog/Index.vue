<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

interface Article {
    id: number;
    title: string;
    slug: string;
    content: string;
    published_at: string | null;
    created_at: string;
    updated_at: string;
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
    if (article.media && article.media.length > 0) {
        return article.media[0].url;
    }
    return '/images/placeholder.png';
};

const excerpt = (content: string, length: number = 150) => {
    const text = content.replace(/<[^>]*>/g, '');
    return text.length > length ? text.substring(0, length) + '...' : text;
};
</script>

<template>
    <Head>
        <title>Blog - Web Discovery</title>
        <meta
            name="description"
            content="Découvrez nos articles sur le développement web, la création de sites web vitrine et les applications SaaS."
        />
    </Head>

    <div
        class="min-h-screen bg-slate-950 text-white"
    >
        <header
            class="fixed top-0 right-0 left-0 z-50 border-b border-slate-800 bg-slate-950/80 backdrop-blur-xl"
            role="banner"
        >
            <nav
                class="container mx-auto flex items-center justify-between px-6 py-4"
            >
                <Link href="/" class="group flex items-center gap-3">
                    <img
                        src="/asset/logo.png"
                        alt="Logo Web Discovery"
                        class="h-10 w-auto object-contain"
                    />
                    <span class="text-xl font-bold">WEB DISCOVERY</span>
                </Link>

                <!-- Navigation links -->
                <div class="hidden items-center gap-6 md:flex">
                    <Link
                        href="/#technologies"
                        class="rounded-lg px-3 py-2 text-sm font-medium text-slate-300 transition-colors hover:bg-slate-800 hover:text-white"
                    >
                        Technologies
                    </Link>
                    <Link
                        href="/#entreprise"
                        class="rounded-lg px-3 py-2 text-sm font-medium text-slate-300 transition-colors hover:bg-slate-800 hover:text-white"
                    >
                        À propos
                    </Link>
                    <Link
                        href="/#tarifs"
                        class="rounded-lg px-3 py-2 text-sm font-medium text-slate-300 transition-colors hover:bg-slate-800 hover:text-white"
                    >
                        Tarifs
                    </Link>
                    <Link
                        href="/#contact"
                        class="rounded-lg px-3 py-2 text-sm font-medium text-slate-300 transition-colors hover:bg-slate-800 hover:text-white"
                    >
                        Contact
                    </Link>
                    <Link
                        href="/blog"
                        class="rounded-lg px-3 py-2 text-sm font-medium bg-blue-500/10 text-blue-400 transition-colors hover:bg-blue-500/20"
                    >
                        Blog
                    </Link>
                </div>
            </nav>
        </header>

        <main class="px-6 pt-32 pb-20">
            <div class="container mx-auto max-w-7xl">
                <div class="mb-16 text-center">
                    <div class="mb-6 inline-block rounded-full bg-blue-500/10 px-4 py-2 text-sm font-semibold text-blue-400">
                        Articles & Actualités
                    </div>
                    <h1
                        class="mb-6 bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 bg-clip-text text-5xl font-black leading-tight text-transparent drop-shadow-lg md:text-6xl lg:text-7xl"
                    >
                        Blog
                    </h1>
                    <p class="mx-auto max-w-2xl text-xl leading-relaxed text-slate-300">
                        Découvrez nos articles sur le développement web, la
                        création de sites web et les applications SaaS
                    </p>
                </div>

                <div
                    v-if="articles.data.length === 0"
                    class="rounded-2xl border border-slate-700/50 bg-slate-800/30 p-12 text-center"
                >
                    <svg
                        class="mx-auto mb-4 h-16 w-16 text-slate-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                        />
                    </svg>
                    <p class="text-xl font-medium text-slate-400">
                        Aucun article disponible pour le moment.
                    </p>
                    <p class="mt-2 text-sm text-slate-500">
                        Revenez bientôt pour découvrir nos nouveaux articles !
                    </p>
                </div>

                <div
                    v-else
                    class="grid gap-8 md:grid-cols-2 lg:grid-cols-3"
                >
                    <article
                        v-for="article in articles.data"
                        :key="article.id"
                        class="group relative flex flex-col transform overflow-hidden rounded-2xl border border-slate-700/50 bg-gradient-to-br from-slate-800/80 to-slate-900/80 backdrop-blur-sm transition-all duration-300 hover:scale-[1.02] hover:border-blue-500/50 hover:shadow-2xl hover:shadow-blue-500/10"
                    >
                        <Link :href="`/blog/${article.slug}`" class="flex flex-col h-full">
                            <div class="relative h-56 overflow-hidden flex-shrink-0">
                                <img
                                    :src="getImageUrl(article)"
                                    :alt="article.title"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                                />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent"
                                ></div>
                                <div
                                    class="absolute top-4 right-4 rounded-full bg-blue-500/20 px-3 py-1 text-xs font-semibold text-blue-300 backdrop-blur-sm"
                                >
                                    Article
                                </div>
                            </div>
                            <div class="flex flex-col flex-grow p-6">
                                <time
                                    v-if="article.published_at"
                                    class="mb-3 block text-xs font-medium uppercase tracking-wide text-slate-400"
                                >
                                    {{ formatDate(article.published_at) }}
                                </time>
                                <h2
                                    class="mb-4 text-2xl font-bold leading-tight text-white transition-colors duration-300 group-hover:text-blue-400"
                                >
                                    {{ article.title }}
                                </h2>
                                <div
                                    class="article-excerpt mb-4 text-sm leading-relaxed text-slate-300 line-clamp-3 flex-grow"
                                    v-html="excerpt(article.content, 120)"
                                ></div>
                                <div
                                    class="mt-auto inline-flex items-center gap-2 font-semibold text-blue-400 transition-all duration-300 group-hover:gap-3 group-hover:text-blue-300"
                                >
                                    Lire la suite
                                    <svg
                                        class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5l7 7-7 7"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </Link>
                    </article>
                </div>

                <!-- Pagination -->
                <div
                    v-if="articles.last_page > 1"
                    class="mt-16 flex flex-wrap items-center justify-center gap-4"
                >
                    <Link
                        v-if="articles.current_page > 1"
                        :href="`/blog?page=${articles.current_page - 1}`"
                        class="group flex items-center gap-2 rounded-lg border border-slate-700 bg-slate-800/50 px-6 py-3 text-slate-300 transition-all hover:border-blue-500/50 hover:bg-slate-800 hover:text-white"
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
                                d="M15 19l-7-7 7-7"
                            />
                        </svg>
                        Précédent
                    </Link>

                    <div class="flex items-center gap-2">
                        <span
                            v-for="page in articles.last_page"
                            :key="page"
                            class="rounded-lg px-4 py-2 text-sm font-medium transition-colors"
                            :class="
                                page === articles.current_page
                                    ? 'bg-blue-500 text-white'
                                    : 'text-slate-400 hover:bg-slate-800 hover:text-white'
                            "
                        >
                            <Link
                                v-if="page !== articles.current_page"
                                :href="`/blog?page=${page}`"
                                class="block"
                            >
                                {{ page }}
                            </Link>
                            <span v-else>{{ page }}</span>
                        </span>
                    </div>

                    <Link
                        v-if="articles.current_page < articles.last_page"
                        :href="`/blog?page=${articles.current_page + 1}`"
                        class="group flex items-center gap-2 rounded-lg border border-slate-700 bg-slate-800/50 px-6 py-3 text-slate-300 transition-all hover:border-blue-500/50 hover:bg-slate-800 hover:text-white"
                    >
                        Suivant
                        <svg
                            class="h-4 w-4 transition-transform group-hover:translate-x-1"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"
                            />
                        </svg>
                    </Link>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer
            class="border-t border-slate-800 bg-slate-950 px-6 py-12"
            role="contentinfo"
        >
            <div class="container mx-auto max-w-7xl">
                <div class="mb-8 grid gap-8 md:grid-cols-3">
                    <!-- Informations entreprise -->
                    <div>
                        <div class="mb-4 flex items-center gap-3">
                            <img
                                src="/asset/logo.png"
                                alt="Logo Web Discovery"
                                class="h-10 w-auto object-contain"
                            />
                            <span class="text-lg font-bold">WEB DISCOVERY</span>
                        </div>
                        <p class="mb-4 text-sm text-slate-400">
                            Création de sites web vitrine et applications SaaS sur mesure
                        </p>
                    </div>

                    <!-- Liens rapides -->
                    <div>
                        <h3 class="mb-4 text-sm font-semibold text-white">Liens rapides</h3>
                        <ul class="space-y-2 text-sm text-slate-400">
                            <li>
                                <Link href="/#technologies" class="transition-colors hover:text-blue-400">Technologies</Link>
                            </li>
                            <li>
                                <Link href="/#entreprise" class="transition-colors hover:text-blue-400">À propos</Link>
                            </li>
                            <li>
                                <Link href="/#tarifs" class="transition-colors hover:text-blue-400">Tarifs</Link>
                            </li>
                            <li>
                                <Link href="/#contact" class="transition-colors hover:text-blue-400">Contact</Link>
                            </li>
                            <li>
                                <Link href="/blog" class="transition-colors hover:text-blue-400">Blog</Link>
                            </li>
                        </ul>
                    </div>

                    <!-- Légales -->
                    <div>
                        <h3 class="mb-4 text-sm font-semibold text-white">Informations légales</h3>
                        <ul class="space-y-2 text-sm text-slate-400">
                            <li>
                                <Link
                                    href="/mentions-legales"
                                    class="transition-colors hover:text-blue-400"
                                    >Mentions légales</Link
                                >
                            </li>
                            <li>
                                <Link
                                    href="/politique-confidentialite"
                                    class="transition-colors hover:text-blue-400"
                                    >Politique de confidentialité</Link
                                >
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-slate-800 pt-6">
                    <p class="text-center text-sm text-slate-500">
                        © {{ new Date().getFullYear() }} Web Discovery. Tous droits
                        réservés.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>

<style scoped>
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
    color: rgb(255 255 255);
}

.article-excerpt :deep(em) {
    font-style: italic;
}

.article-excerpt :deep(a) {
    color: rgb(96 165 250);
    text-decoration: underline;
}
</style>

