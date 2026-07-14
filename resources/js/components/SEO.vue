<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

interface Props {
    title: string;
    description: string;
    canonical?: string;
    ogImage?: string;
    noindex?: boolean;
    keywords?: string;
}

const props = withDefaults(defineProps<Props>(), {
    canonical: '',
    ogImage: '/asset/logo.png',
    noindex: false,
    keywords: '',
});

const siteName = 'Web Discovery';

// Origine et URL canonique fournies par le serveur (HandleInertiaRequests),
// pour que les balises soient correctes dès le rendu SSR (pas de window.location).
const page = usePage();
const origin = computed(() => (page.props.seo as { origin?: string })?.origin ?? '');
const serverCanonical = computed(() => (page.props.seo as { canonical?: string })?.canonical ?? '');

const absoluteUrl = (path: string) => {
    if (!path) return '';
    return path.startsWith('http') ? path : `${origin.value}${path}`;
};

const canonicalUrl = computed(() => {
    if (props.canonical) {
        return absoluteUrl(props.canonical);
    }
    return serverCanonical.value;
});

const ogImageUrl = computed(() => absoluteUrl(props.ogImage));

const robotsContent = computed(() => {
    return props.noindex
        ? 'noindex, follow'
        : 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
});
</script>

<template>
    <!--
        Les données structurées (JSON-LD) sont rendues côté serveur dans
        resources/views/app.blade.php à partir de la prop `structuredData`
        de la page. Le composant <Head> d'Inertia n'accepte pas les balises
        <script>, d'où le rendu serveur.
        Chaque balise porte un `head-key` pour permettre à Inertia de
        dédupliquer proprement d'une page à l'autre.
    -->
    <Head>
        <!-- Title -->
        <title>{{ title }} - {{ siteName }}</title>

        <!-- Meta Description -->
        <meta head-key="description" name="description" :content="description" />

        <!-- Keywords (si fourni) -->
        <meta v-if="keywords" head-key="keywords" name="keywords" :content="keywords" />

        <!-- Robots -->
        <meta head-key="robots" name="robots" :content="robotsContent" />

        <!-- Canonical URL -->
        <link head-key="canonical" rel="canonical" :href="canonicalUrl" />

        <!-- Open Graph / Facebook -->
        <meta head-key="og:type" property="og:type" content="website" />
        <meta head-key="og:url" property="og:url" :content="canonicalUrl" />
        <meta head-key="og:title" property="og:title" :content="title" />
        <meta head-key="og:description" property="og:description" :content="description" />
        <meta head-key="og:site_name" property="og:site_name" :content="siteName" />
        <meta head-key="og:locale" property="og:locale" content="fr_FR" />
        <meta head-key="og:image" property="og:image" :content="ogImageUrl" />
        <meta head-key="og:image:alt" property="og:image:alt" :content="title" />

        <!-- Twitter -->
        <meta head-key="twitter:card" name="twitter:card" content="summary_large_image" />
        <meta head-key="twitter:title" name="twitter:title" :content="title" />
        <meta head-key="twitter:description" name="twitter:description" :content="description" />
        <meta head-key="twitter:image" name="twitter:image" :content="ogImageUrl" />
        <meta head-key="twitter:image:alt" name="twitter:image:alt" :content="title" />

        <!-- Divers -->
        <meta head-key="author" name="author" content="Web Discovery" />
        <meta head-key="language" name="language" content="French" />
    </Head>
</template>
