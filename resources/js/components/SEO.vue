<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { computed, onMounted } from 'vue';

interface Props {
    title: string;
    description: string;
    canonical?: string;
    ogImage?: string;
    noindex?: boolean;
    keywords?: string;
    structuredData?: Record<string, unknown> | Array<Record<string, unknown>>;
}

const props = withDefaults(defineProps<Props>(), {
    canonical: '',
    ogImage: '/og-image.jpg',
    noindex: false,
    keywords: '',
    structuredData: undefined,
});

const siteName = 'Web Discovery';
const baseUrl = computed(() => {
    if (typeof window !== 'undefined') {
        return window.location.origin;
    }
    return '';
});

const canonicalUrl = computed(() => {
    if (props.canonical) {
        return props.canonical.startsWith('http') 
            ? props.canonical 
            : `${baseUrl.value}${props.canonical}`;
    }
    return typeof window !== 'undefined' ? window.location.href : '';
});

const ogImageUrl = computed(() => {
    if (props.ogImage) {
        return props.ogImage.startsWith('http') 
            ? props.ogImage 
            : `${baseUrl.value}${props.ogImage}`;
    }
    return `${baseUrl.value}/og-image.jpg`;
});

const robotsContent = computed(() => {
    return props.noindex ? 'noindex, follow' : 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
});

// Injection des données structurées
onMounted(() => {
    if (props.structuredData) {
        const dataArray = Array.isArray(props.structuredData) 
            ? props.structuredData 
            : [props.structuredData];
        
        dataArray.forEach((data, index) => {
            // Vérifier par type de schéma pour éviter les doublons
            const schemaType = (data as Record<string, unknown>)?.['@type'] || 'unknown';
            const existingScript = document.querySelector(
                `script[type="application/ld+json"][data-schema-type="${schemaType}"]`,
            );

            if (!existingScript) {
                const script = document.createElement('script');
                script.setAttribute('type', 'application/ld+json');
                script.setAttribute('data-schema-type', schemaType as string);
                script.setAttribute('data-seo-index', index.toString());
                script.textContent = JSON.stringify(data);
                document.head.appendChild(script);
            }
        });
    }
});
</script>

<template>
    <Head>
        <!-- Title -->
        <title>{{ title }} - {{ siteName }}</title>

        <!-- Meta Description -->
        <meta name="description" :content="description" />

        <!-- Keywords (si fourni) -->
        <meta v-if="keywords" name="keywords" :content="keywords" />

        <!-- Robots -->
        <meta name="robots" :content="robotsContent" />

        <!-- Canonical URL -->
        <link rel="canonical" :href="canonicalUrl" />

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:url" :content="canonicalUrl" />
        <meta property="og:title" :content="title" />
        <meta property="og:description" :content="description" />
        <meta property="og:site_name" :content="siteName" />
        <meta property="og:locale" content="fr_FR" />
        <meta property="og:image" :content="ogImageUrl" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />
        <meta property="og:image:alt" :content="title" />

        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" :content="title" />
        <meta name="twitter:description" :content="description" />
        <meta name="twitter:image" :content="ogImageUrl" />
        <meta name="twitter:image:alt" :content="title" />

        <!-- Additional SEO meta tags -->
        <meta name="author" content="Web Discovery" />
        <meta name="language" content="French" />
        <meta http-equiv="content-language" content="fr-FR" />
        <meta name="geo.region" content="FR" />
        <meta name="geo.placename" content="France" />
        <meta name="theme-color" content="#3b82f6" />
    </Head>
</template>

