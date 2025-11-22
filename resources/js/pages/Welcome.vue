<script setup lang="ts">
import GdprBanner from '@/components/GdprBanner.vue';
import { dashboard, login, register } from '@/routes';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { onMounted, onUnmounted, ref } from 'vue';

withDefaults(
    defineProps<{
        canRegister: boolean;
        flash?: {
            success?: string;
            error?: string;
        };
    }>(),
    {
        canRegister: true,
    },
);

const form = useForm({
    name: '',
    email: '',
    message: '',
});

const submit = () => {
    form.post('/contact', {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
};

const technologies = [
    {
        name: 'Laravel',
        description: 'Framework PHP robuste pour applications web complexes',
        icon: '🚀',
    },
    {
        name: 'Vue.js',
        description: 'Interface utilisateur réactive et performante',
        icon: '⚡',
    },
    {
        name: 'Tailwind CSS',
        description: 'Design moderne et responsive en un temps record',
        icon: '🎨',
    },
    {
        name: 'API RESTful',
        description: 'Intégrations et communication entre systèmes',
        icon: '🔌',
    },
    {
        name: 'Intelligence Artificielle',
        description: 'Solutions intelligentes et automatisées',
        icon: '🤖',
    },
    {
        name: 'GIT',
        description: 'Versioning et collaboration efficace',
        icon: '📦',
    },
    { name: 'PHP', description: 'Backend puissant et sécurisé', icon: '💻' },
    {
        name: 'Livewire',
        description: 'Interactivité sans JavaScript complexe',
        icon: '⚙️',
    },
    {
        name: 'InertiaJS',
        description: 'Applications SPA sans complexité API',
        icon: '🔄',
    },
];

const showTooltip = ref(false);
const showScrollTop = ref(false);
const activeSection = ref('');

// Animation au scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px',
};

let observer: IntersectionObserver | null = null;

// Navigation links
const navLinks = [
    { id: 'technologies', label: 'Technologies' },
    { id: 'entreprise', label: 'À propos' },
    { id: 'tarifs', label: 'Tarifs' },
    { id: 'contact', label: 'Contact' },
];

// Scroll to section
const scrollToSection = (id: string) => {
    const element = document.getElementById(id);
    if (element) {
        const headerOffset = 80;
        const elementPosition = element.getBoundingClientRect().top;
        const offsetPosition =
            elementPosition + window.pageYOffset - headerOffset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth',
        });
    }
};

// Scroll to top
const scrollToTop = () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth',
    });
};

onMounted(() => {
    // Observer pour les animations au scroll
    observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.scroll-animate').forEach((el) => {
        observer?.observe(el);
    });

    // Observer pour détecter la section active
    const sectionObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    activeSection.value = entry.target.id;
                }
            });
        },
        {
            threshold: 0.3,
            rootMargin: '-100px 0px -50% 0px',
        },
    );

    // Observer toutes les sections
    navLinks.forEach((link) => {
        const section = document.getElementById(link.id);
        if (section) {
            sectionObserver.observe(section);
        }
    });

    // Gérer l'affichage du bouton scroll to top
    const handleScroll = () => {
        showScrollTop.value = window.scrollY > 300;
    };

    window.addEventListener('scroll', handleScroll, { passive: true });

    // Cleanup
    return () => {
        window.removeEventListener('scroll', handleScroll);
        sectionObserver.disconnect();
    };
});

onUnmounted(() => {
    observer?.disconnect();
});

// Structured Data pour le SEO - Optimisé pour "création site web vitrine"
const structuredData = {
    '@context': 'https://schema.org',
    '@type': 'ProfessionalService',
    name: 'Web Discovery',
    description:
        'Création de sites web vitrine et applications SaaS sur mesure. Spécialiste en développement web avec Laravel et Vue.js. Tarifs à partir de 400€.',
    url: typeof window !== 'undefined' ? window.location.origin : '',
    priceRange: 'À partir de 400€',
    areaServed: {
        '@type': 'Country',
        name: 'France',
    },
    serviceType: [
        'Création site web vitrine',
        'Développement site web',
        'Création site internet',
        'Site web sur mesure',
        'Application SaaS',
        'Développement web Laravel',
        'Développement web Vue.js',
    ],
    offers: {
        '@type': 'Offer',
        name: 'Création site web vitrine',
        description:
            'Création de site web vitrine professionnel avec design moderne, responsive et optimisé SEO',
        price: '400',
        priceCurrency: 'EUR',
        availability: 'https://schema.org/InStock',
        priceSpecification: {
            '@type': 'UnitPriceSpecification',
            price: '400',
            priceCurrency: 'EUR',
            valueAddedTaxIncluded: true,
        },
    },
    aggregateRating: {
        '@type': 'AggregateRating',
        ratingValue: '5',
        reviewCount: '1',
    },
    sameAs: [],
};

// Injection du structured data dans le head
onMounted(() => {
    const existingScript = document.querySelector(
        'script[type="application/ld+json"]',
    );

    if (!existingScript) {
        const script = document.createElement('script');
        script.setAttribute('type', 'application/ld+json');
        script.textContent = JSON.stringify(structuredData);
        document.head.appendChild(script);
    }
});
</script>

<template>
    <Head>
        <title>
            Création Site Web Vitrine | Développement Web & SaaS | Web Discovery
        </title>
        <meta
            name="description"
            content="Création de site web vitrine professionnel à partir de 400€. Développement de sites web et applications SaaS sur mesure avec Laravel et Vue.js. Design moderne, responsive et optimisé SEO."
        />
        <meta
            name="keywords"
            content="création site web vitrine, création site internet, développement site web, site web sur mesure, création site web professionnel, site vitrine pas cher, développement web Laravel, développement web Vue.js, application SaaS, site web responsive"
        />
        <meta name="author" content="Web Discovery" />
        <meta
            name="robots"
            content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1"
        />
        <meta name="language" content="French" />
        <meta name="revisit-after" content="7 days" />
        <meta name="rating" content="general" />
        <meta name="distribution" content="global" />
        <meta name="geo.region" content="FR" />
        <meta name="geo.placename" content="France" />

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta
            property="og:url"
            :content="typeof window !== 'undefined' ? window.location.href : ''"
        />
        <meta
            property="og:title"
            content="Création Site Web Vitrine | Web Discovery - Développement Web & SaaS"
        />
        <meta
            property="og:description"
            content="Création de site web vitrine professionnel à partir de 400€. Développement de sites web et applications SaaS sur mesure avec Laravel et Vue.js."
        />
        <meta property="og:site_name" content="Web Discovery" />
        <meta property="og:locale" content="fr_FR" />
        <meta
            property="og:image"
            :content="
                typeof window !== 'undefined'
                    ? window.location.origin + '/og-image.jpg'
                    : ''
            "
        />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />
        <meta
            property="og:image:alt"
            content="Web Discovery - Création de sites web vitrine et applications SaaS"
        />

        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta
            name="twitter:title"
            content="Création Site Web Vitrine | Web Discovery"
        />
        <meta
            name="twitter:description"
            content="Création de site web vitrine professionnel à partir de 400€. Développement web sur mesure avec Laravel et Vue.js."
        />
        <meta
            name="twitter:image"
            :content="
                typeof window !== 'undefined'
                    ? window.location.origin + '/og-image.jpg'
                    : ''
            "
        />
        <meta
            name="twitter:image:alt"
            content="Web Discovery - Création de sites web vitrine et applications SaaS"
        />

        <!-- Canonical URL -->
        <link
            rel="canonical"
            :href="typeof window !== 'undefined' ? window.location.href : ''"
        />

        <!-- Sitemap -->
        <link
            rel="sitemap"
            type="application/xml"
            :href="
                typeof window !== 'undefined'
                    ? window.location.origin + '/sitemap.xml'
                    : ''
            "
        />

        <!-- Preconnect pour performance -->
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="dns-prefetch" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <div
        class="min-h-screen bg-slate-950 text-white"
        itemscope
        itemtype="https://schema.org/WebSite"
    >
        <!-- Header -->
        <header
            class="fixed top-0 right-0 left-0 z-50 border-b border-slate-800 bg-slate-950/80 backdrop-blur-xl"
            role="banner"
        >
            <nav
                class="container mx-auto flex items-center justify-between px-6 py-4"
            >
                <Link href="/" class="group flex items-center gap-3">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 shadow-lg shadow-blue-500/20 transition-all group-hover:shadow-blue-500/40"
                    >
                        <span class="text-xl font-bold text-white">W</span>
                    </div>
                    <span class="text-xl font-bold">WEB DISCOVERY</span>
                </Link>

                <!-- Navigation links -->
                <div class="hidden items-center gap-6 md:flex">
                    <button
                        @click="scrollToSection('technologies')"
                        :class="[
                            'rounded-lg px-3 py-2 text-sm font-medium transition-colors',
                            activeSection === 'technologies'
                                ? 'bg-blue-500/10 text-blue-400'
                                : 'text-slate-300 hover:bg-slate-800 hover:text-white',
                        ]"
                    >
                        Technologies
                    </button>
                    <button
                        @click="scrollToSection('entreprise')"
                        :class="[
                            'rounded-lg px-3 py-2 text-sm font-medium transition-colors',
                            activeSection === 'entreprise'
                                ? 'bg-blue-500/10 text-blue-400'
                                : 'text-slate-300 hover:bg-slate-800 hover:text-white',
                        ]"
                    >
                        À propos
                    </button>
                    <button
                        @click="scrollToSection('tarifs')"
                        :class="[
                            'rounded-lg px-3 py-2 text-sm font-medium transition-colors',
                            activeSection === 'tarifs'
                                ? 'bg-blue-500/10 text-blue-400'
                                : 'text-slate-300 hover:bg-slate-800 hover:text-white',
                        ]"
                    >
                        Tarifs
                    </button>
                    <button
                        @click="scrollToSection('contact')"
                        :class="[
                            'rounded-lg px-3 py-2 text-sm font-medium transition-colors',
                            activeSection === 'contact'
                                ? 'bg-blue-500/10 text-blue-400'
                                : 'text-slate-300 hover:bg-slate-800 hover:text-white',
                        ]"
                    >
                        Contact
                    </button>
                </div>

                <!-- Navigation cachée mais présente dans le code -->
                <div class="hidden">
                    <Link v-if="$page.props.auth?.user" :href="dashboard()"
                        >Dashboard</Link
                    >
                    <template v-else>
                        <Link :href="login()">Log in</Link>
                        <Link v-if="canRegister" :href="register()"
                            >Register</Link
                        >
                    </template>
                </div>
            </nav>
        </header>

        <!-- Hero Section -->
        <section
            id="hero"
            class="relative flex min-h-screen items-center overflow-hidden px-6 pt-32 pb-24"
            role="main"
        >
            <!-- Background effects -->
            <div class="absolute inset-0">
                <div
                    class="absolute top-1/4 -left-1/4 h-96 w-96 rounded-full bg-blue-500/10 blur-3xl"
                ></div>
                <div
                    class="absolute -right-1/4 bottom-1/4 h-96 w-96 rounded-full bg-blue-600/10 blur-3xl"
                ></div>
            </div>

            <div class="relative z-10 container mx-auto max-w-7xl">
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <!-- Left: Content -->
                    <div class="scroll-animate space-y-8">
                        <div class="space-y-4">
                            <h1
                                class="text-5xl leading-tight font-black md:text-7xl"
                            >
                                <span class="block text-white"
                                    >Création Site Web</span
                                >
                                <span
                                    class="block bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent"
                                    >Vitrine & SaaS</span
                                >
                            </h1>
                            <p class="text-xl leading-relaxed text-slate-400">
                                <strong class="text-white"
                                    >Création de site web vitrine</strong
                                >
                                professionnel et développement d'applications
                                SaaS sur mesure avec
                                <strong class="text-blue-400">Laravel</strong>
                                et
                                <strong class="text-blue-400">Vue.js</strong>.
                                Design moderne, responsive et optimisé pour le
                                référencement.
                            </p>
                        </div>
                        <div class="flex flex-wrap gap-4">
                            <a
                                href="#contact"
                                class="transform rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 px-8 py-4 font-semibold text-white shadow-lg shadow-blue-500/20 transition-all hover:scale-105 hover:from-blue-600 hover:to-blue-700 hover:shadow-blue-500/40"
                            >
                                Démarrer un projet
                            </a>
                            <a
                                href="#tarifs"
                                class="transform rounded-xl border border-slate-700 bg-slate-800 px-8 py-4 font-semibold text-white transition-all hover:scale-105 hover:border-blue-500/50 hover:bg-slate-700"
                            >
                                Voir les tarifs
                            </a>
                        </div>
                    </div>

                    <!-- Right: Visual -->
                    <div
                        class="relative"
                        aria-label="Logo Web Discovery - Cube 3D représentant l'exploration web"
                    >
                        <div
                            class="relative mx-auto aspect-square w-full max-w-lg"
                        >
                            <!-- Cube 3D -->
                            <div
                                class="absolute inset-0 flex items-center justify-center"
                            >
                                <div
                                    class="animate-float relative h-64 w-64 rotate-12 transform"
                                    role="img"
                                    aria-label="Logo Web Discovery"
                                >
                                    <div
                                        class="absolute inset-0 skew-y-12 transform rounded-2xl border border-slate-700 bg-gradient-to-br from-slate-800 to-slate-900 shadow-2xl"
                                    ></div>
                                    <div
                                        class="absolute inset-0 -skew-y-12 transform rounded-2xl bg-gradient-to-br from-blue-500/20 to-blue-600/20"
                                    ></div>
                                    <div
                                        class="absolute inset-0 flex items-center justify-center"
                                    >
                                        <div
                                            class="relative h-32 w-32 overflow-hidden rounded-xl border border-blue-500/30 bg-blue-500/10 backdrop-blur-sm"
                                        >
                                            <div
                                                class="absolute top-4 left-4 h-16 w-3 animate-pulse rounded-full bg-gradient-to-b from-blue-400 to-blue-600 shadow-lg shadow-blue-400/50"
                                            ></div>
                                            <div
                                                class="absolute top-8 right-6 h-8 w-12 rotate-45 transform animate-pulse rounded bg-blue-500/60 shadow-lg shadow-blue-500/50"
                                                style="animation-delay: 0.5s"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Technologies -->
        <section
            id="technologies"
            class="bg-slate-900/50 px-6 py-24"
            itemscope
            itemtype="https://schema.org/Service"
        >
            <div class="container mx-auto max-w-7xl">
                <div class="scroll-animate mb-16 text-center">
                    <h2 class="mb-4 text-4xl font-black md:text-5xl">
                        <span class="text-white">Technologies</span>
                        <span
                            class="block bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent"
                            >Maîtrisées</span
                        >
                    </h2>
                    <p class="mx-auto max-w-3xl text-xl text-slate-400">
                        Un stack technologique moderne et performant pour la
                        <strong class="text-blue-400"
                            >création de site web vitrine</strong
                        >
                        et le développement d'applications SaaS
                    </p>
                </div>

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <div
                        v-for="(tech, index) in technologies"
                        :key="tech.name"
                        :style="{ animationDelay: `${index * 0.1}s` }"
                        class="scroll-animate group transform rounded-2xl border border-slate-700 bg-slate-800/50 p-6 transition-all hover:scale-105 hover:border-blue-500/50 hover:bg-slate-800 hover:shadow-lg hover:shadow-blue-500/10"
                    >
                        <div class="flex items-start gap-4">
                            <div
                                class="text-4xl transition-transform group-hover:scale-110"
                            >
                                {{ tech.icon }}
                            </div>
                            <div class="flex-1">
                                <h3
                                    class="mb-2 text-xl font-bold text-white transition-colors group-hover:text-blue-400"
                                >
                                    {{ tech.name }}
                                </h3>
                                <p
                                    class="text-sm leading-relaxed text-slate-400"
                                >
                                    {{ tech.description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="scroll-animate mt-16 rounded-2xl border border-blue-500/20 bg-gradient-to-r from-blue-500/10 to-blue-600/10 p-8 md:p-12"
                >
                    <h3 class="mb-4 text-2xl font-bold text-white">
                        Pourquoi ces technologies ?
                    </h3>
                    <div class="grid gap-6 text-slate-300 md:grid-cols-2">
                        <div>
                            <h4 class="mb-2 font-semibold text-white">
                                ✓ Polyvalence
                            </h4>
                            <p class="text-sm">
                                Ces technologies s'adaptent à tous types de
                                projets : sites vitrines, e-commerce,
                                applications SaaS complexes, APIs, intégrations.
                            </p>
                        </div>
                        <div>
                            <h4 class="mb-2 font-semibold text-white">
                                ✓ Performance
                            </h4>
                            <p class="text-sm">
                                Laravel et Vue.js offrent des performances
                                optimales, garantissant une expérience
                                utilisateur fluide et rapide.
                            </p>
                        </div>
                        <div>
                            <h4 class="mb-2 font-semibold text-white">
                                ✓ Évolutivité
                            </h4>
                            <p class="text-sm">
                                Votre projet peut grandir sans limite.
                                L'architecture modulaire permet d'ajouter des
                                fonctionnalités facilement.
                            </p>
                        </div>
                        <div>
                            <h4 class="mb-2 font-semibold text-white">
                                ✓ Maintenabilité
                            </h4>
                            <p class="text-sm">
                                Code propre, bien structuré et documenté.
                                Facilite les mises à jour et l'ajout de
                                nouvelles fonctionnalités.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section À propos -->
        <section
            id="entreprise"
            class="px-6 py-24"
            itemscope
            itemtype="https://schema.org/Organization"
        >
            <div class="container mx-auto max-w-4xl">
                <div class="scroll-animate mb-12 text-center">
                    <h2 class="mb-4 text-4xl font-black md:text-5xl">
                        <span class="text-white">À propos de</span>
                        <span
                            class="block bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent"
                            >Web Discovery</span
                        >
                    </h2>
                </div>
                <div
                    class="scroll-animate rounded-2xl border border-slate-700 bg-slate-800/50 p-8 md:p-12"
                >
                    <p class="mb-6 text-lg leading-relaxed text-slate-300">
                        <strong class="text-white">Web Discovery</strong> est
                        spécialisé dans la
                        <strong class="text-blue-400"
                            >création de site web vitrine</strong
                        >
                        et le développement d'applications SaaS sur mesure. Nous
                        transformons vos idées en solutions web modernes,
                        performantes et optimisées pour le référencement.
                    </p>
                    <p class="mb-6 text-lg leading-relaxed text-slate-300">
                        Que vous ayez besoin d'un
                        <strong class="text-blue-400">site web vitrine</strong>
                        professionnel pour présenter votre activité, d'une
                        application SaaS complexe, ou d'une solution sur mesure,
                        nous mettons notre expertise technique au service de
                        votre projet avec des technologies éprouvées et
                        performantes.
                    </p>
                    <p class="text-lg leading-relaxed text-slate-300">
                        Notre approche combine design moderne, développement de
                        qualité et optimisation SEO pour garantir la visibilité
                        de votre
                        <strong class="text-blue-400">site internet</strong>
                        dans les moteurs de recherche.
                    </p>
                </div>
            </div>
        </section>

        <!-- Section Tarifs -->
        <section
            id="tarifs"
            class="bg-slate-900/50 px-6 py-24"
            itemscope
            itemtype="https://schema.org/PriceSpecification"
        >
            <div class="container mx-auto max-w-6xl">
                <div class="scroll-animate mb-16 text-center">
                    <h2 class="mb-4 text-4xl font-black md:text-5xl">
                        <span class="text-white">Nos</span>
                        <span
                            class="block bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent"
                            >Tarifs</span
                        >
                    </h2>
                </div>

                <div class="mx-auto grid max-w-5xl gap-8 md:grid-cols-2">
                    <!-- Site Vitrine -->
                    <div
                        class="scroll-animate group relative transform overflow-hidden rounded-2xl border border-slate-700 bg-slate-800/50 p-8 transition-all hover:scale-[1.02] hover:border-blue-500/50 hover:bg-slate-800"
                    >
                        <div
                            class="absolute top-0 right-0 left-0 h-px bg-gradient-to-r from-transparent via-blue-500 to-transparent opacity-0 transition-opacity group-hover:opacity-100"
                        ></div>
                        <div class="relative z-10">
                            <h3 class="mb-2 text-2xl font-bold text-white">
                                Création Site Web Vitrine
                            </h3>
                            <p class="mb-6 text-slate-400">
                                Parfait pour présenter votre activité en ligne
                            </p>

                            <div class="mb-6">
                                <div
                                    class="mb-2 text-sm font-semibold text-blue-400"
                                >
                                    À partir de
                                </div>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-5xl font-black text-white"
                                        >400€</span
                                    >
                                    <span
                                        class="text-xl font-semibold text-blue-400"
                                        >*</span
                                    >
                                </div>
                            </div>

                            <ul class="mb-6 space-y-3 text-slate-300">
                                <li
                                    class="group/item flex items-center gap-3 transition-colors hover:text-white"
                                >
                                    <span
                                        class="h-2 w-2 rounded-full bg-blue-400 transition-all group-hover/item:scale-150 group-hover/item:shadow-lg group-hover/item:shadow-blue-400/50"
                                    ></span>
                                    <span>Design moderne et responsive</span>
                                </li>
                                <li
                                    class="group/item flex items-center gap-3 transition-colors hover:text-white"
                                >
                                    <span
                                        class="h-2 w-2 rounded-full bg-blue-400 transition-all group-hover/item:scale-150 group-hover/item:shadow-lg group-hover/item:shadow-blue-400/50"
                                    ></span>
                                    <span>Optimisation SEO intégrée</span>
                                </li>
                                <li
                                    class="group/item flex items-center gap-3 transition-colors hover:text-white"
                                >
                                    <span
                                        class="h-2 w-2 rounded-full bg-blue-400 transition-all group-hover/item:scale-150 group-hover/item:shadow-lg group-hover/item:shadow-blue-400/50"
                                    ></span>
                                    <span>Formulaire de contact</span>
                                </li>
                                <li
                                    class="group/item flex items-center gap-3 transition-colors hover:text-white"
                                >
                                    <span
                                        class="h-2 w-2 rounded-full bg-blue-400 transition-all group-hover/item:scale-150 group-hover/item:shadow-lg group-hover/item:shadow-blue-400/50"
                                    ></span>
                                    <span>Mise en ligne incluse</span>
                                </li>
                            </ul>

                            <div class="border-t border-slate-700 pt-4">
                                <p
                                    class="text-xs leading-relaxed text-slate-400"
                                >
                                    <span class="font-semibold text-blue-400"
                                        >*</span
                                    >
                                    Ce tarif peut évoluer selon les
                                    spécifications de votre site web vitrine
                                    (nombre de pages, fonctionnalités,
                                    intégrations, etc.). Un devis personnalisé
                                    sera établi après analyse de vos besoins.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Sur Devis -->
                    <div
                        class="scroll-animate group relative transform overflow-hidden rounded-2xl border border-blue-500/30 bg-gradient-to-br from-blue-900/20 to-slate-800/50 p-8 transition-all hover:scale-[1.02] hover:border-blue-400/50 hover:from-blue-900/30"
                    >
                        <div
                            class="absolute top-0 right-0 left-0 h-px bg-gradient-to-r from-transparent via-blue-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"
                        ></div>
                        <div class="relative z-10">
                            <h3 class="mb-2 text-2xl font-bold text-white">
                                SaaS & Applications
                            </h3>
                            <p class="mb-6 text-slate-400">
                                Solutions sur mesure complexes
                            </p>

                            <div class="mb-6">
                                <div
                                    class="mb-2 text-sm font-semibold text-blue-400"
                                >
                                    Sur
                                </div>
                                <div class="text-5xl font-black text-white">
                                    Devis
                                </div>
                            </div>

                            <ul class="space-y-3 text-slate-300">
                                <li
                                    class="group/item flex items-center gap-3 transition-colors hover:text-white"
                                >
                                    <span
                                        class="h-2 w-2 rounded-full bg-blue-400 transition-all group-hover/item:scale-150 group-hover/item:shadow-lg group-hover/item:shadow-blue-400/50"
                                    ></span>
                                    <span>Application web complète</span>
                                </li>
                                <li
                                    class="group/item flex items-center gap-3 transition-colors hover:text-white"
                                >
                                    <span
                                        class="h-2 w-2 rounded-full bg-blue-400 transition-all group-hover/item:scale-150 group-hover/item:shadow-lg group-hover/item:shadow-blue-400/50"
                                    ></span>
                                    <span>API RESTful</span>
                                </li>
                                <li
                                    class="group/item flex items-center gap-3 transition-colors hover:text-white"
                                >
                                    <span
                                        class="h-2 w-2 rounded-full bg-blue-400 transition-all group-hover/item:scale-150 group-hover/item:shadow-lg group-hover/item:shadow-blue-400/50"
                                    ></span>
                                    <span>Authentification & sécurité</span>
                                </li>
                                <li
                                    class="group/item flex items-center gap-3 transition-colors hover:text-white"
                                >
                                    <span
                                        class="h-2 w-2 rounded-full bg-blue-400 transition-all group-hover/item:scale-150 group-hover/item:shadow-lg group-hover/item:shadow-blue-400/50"
                                    ></span>
                                    <span>Maintenance & support</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <p class="scroll-animate mt-12 text-center text-slate-400">
                    Tous les projets sont personnalisés selon vos besoins
                    spécifiques
                </p>
            </div>
        </section>

        <!-- Section Contact -->
        <section id="contact" class="px-6 py-24">
            <div class="container mx-auto max-w-3xl">
                <div class="scroll-animate mb-12 text-center">
                    <h2 class="mb-4 text-4xl font-black md:text-5xl">
                        <span class="text-white">Contactez</span>
                        <span
                            class="block bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent"
                            >Nous</span
                        >
                    </h2>
                </div>

                <div
                    class="scroll-animate rounded-2xl border border-slate-700 bg-slate-800/50 p-8 md:p-12"
                >
                    <form @submit.prevent="submit" class="space-y-6">
                        <transition
                            enter-active-class="transition ease-out duration-300"
                            enter-from-class="opacity-0 transform translate-y-2"
                            enter-to-class="opacity-100 transform translate-y-0"
                        >
                            <div
                                v-if="$page.props.flash?.success"
                                class="rounded-lg border border-green-500/50 bg-green-500/20 px-4 py-3 text-green-300"
                            >
                                {{ $page.props.flash.success }}
                            </div>
                        </transition>
                        <transition
                            enter-active-class="transition ease-out duration-300"
                            enter-from-class="opacity-0 transform translate-y-2"
                            enter-to-class="opacity-100 transform translate-y-0"
                        >
                            <div
                                v-if="$page.props.flash?.error"
                                class="rounded-lg border border-red-500/50 bg-red-500/20 px-4 py-3 text-red-300"
                            >
                                {{ $page.props.flash.error }}
                            </div>
                        </transition>

                        <div>
                            <label
                                for="name"
                                class="mb-2 block text-sm font-medium text-slate-300"
                            >
                                Nom <span class="text-red-400">*</span>
                            </label>
                            <input
                                id="name"
                                v-model="form.name"
                                type="text"
                                required
                                class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-3 text-white placeholder-slate-500 transition-all focus:border-transparent focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Votre nom"
                            />
                            <div
                                v-if="form.errors.name"
                                class="mt-1 text-sm text-red-400"
                            >
                                {{ form.errors.name }}
                            </div>
                        </div>

                        <div>
                            <label
                                for="email"
                                class="mb-2 block text-sm font-medium text-slate-300"
                            >
                                Email <span class="text-red-400">*</span>
                            </label>
                            <input
                                id="email"
                                v-model="form.email"
                                type="email"
                                required
                                class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-3 text-white placeholder-slate-500 transition-all focus:border-transparent focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="votre@email.com"
                            />
                            <div
                                v-if="form.errors.email"
                                class="mt-1 text-sm text-red-400"
                            >
                                {{ form.errors.email }}
                            </div>
                        </div>

                        <div>
                            <label
                                for="message"
                                class="mb-2 block text-sm font-medium text-slate-300"
                            >
                                Message <span class="text-red-400">*</span>
                            </label>
                            <textarea
                                id="message"
                                v-model="form.message"
                                required
                                rows="6"
                                class="w-full resize-none rounded-lg border border-slate-700 bg-slate-900 px-4 py-3 text-white placeholder-slate-500 transition-all focus:border-transparent focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Décrivez votre projet..."
                            ></textarea>
                            <div
                                v-if="form.errors.message"
                                class="mt-1 text-sm text-red-400"
                            >
                                {{ form.errors.message }}
                            </div>
                        </div>

                        <p class="text-xs text-slate-400">
                            En soumettant ce formulaire, vous acceptez que vos
                            données soient utilisées pour vous contacter.
                            <Link
                                href="/politique-confidentialite"
                                class="text-blue-400 underline hover:text-blue-300"
                                >Politique de confidentialité</Link
                            >
                        </p>

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4 font-semibold text-white shadow-lg shadow-blue-500/20 transition-all hover:from-blue-600 hover:to-blue-700 hover:shadow-blue-500/40 focus:ring-2 focus:ring-blue-500 focus:outline-none disabled:cursor-not-allowed disabled:opacity-50"
                        >
                            <span
                                v-if="form.processing"
                                class="flex items-center justify-center gap-2"
                            >
                                <span
                                    class="h-4 w-4 animate-spin rounded-full border-2 border-white border-t-transparent"
                                ></span>
                                Envoi en cours...
                            </span>
                            <span v-else>Envoyer le message</span>
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer
            class="border-t border-slate-800 bg-slate-950 px-6 py-12"
            role="contentinfo"
        >
            <div class="container mx-auto max-w-7xl">
                <div
                    class="mb-6 flex flex-col items-center justify-between gap-4 md:flex-row"
                >
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-blue-500 to-blue-600"
                        >
                            <span class="font-bold text-white">W</span>
                        </div>
                        <span class="text-lg font-bold">WEB DISCOVERY</span>
                    </div>
                    <div class="flex gap-6 text-sm text-slate-400">
                        <Link
                            href="/mentions-legales"
                            class="transition-colors hover:text-blue-400"
                            >Mentions légales</Link
                        >
                        <Link
                            href="/politique-confidentialite"
                            class="transition-colors hover:text-blue-400"
                            >Politique de confidentialité</Link
                        >
                    </div>
                </div>
                <p class="text-center text-sm text-slate-500">
                    © {{ new Date().getFullYear() }} Web Discovery. Tous droits
                    réservés.
                </p>
            </div>
        </footer>

        <!-- Bannière RGPD -->
        <GdprBanner />

        <!-- Bouton Scroll to Top -->
        <transition
            enter-active-class="transition ease-out duration-300"
            enter-from-class="opacity-0 transform scale-90 translate-y-4"
            enter-to-class="opacity-100 transform scale-100 translate-y-0"
            leave-active-class="transition ease-in duration-200"
            leave-from-class="opacity-100 transform scale-100 translate-y-0"
            leave-to-class="opacity-0 transform scale-90 translate-y-4"
        >
            <button
                v-if="showScrollTop"
                @click="scrollToTop"
                class="group fixed right-8 bottom-8 z-40 flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30 transition-all hover:scale-110 hover:shadow-blue-500/50"
                aria-label="Remonter en haut de la page"
            >
                <svg
                    class="h-6 w-6 transform transition-transform group-hover:-translate-y-1"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 10l7-7m0 0l7 7m-7-7v18"
                    />
                </svg>
            </button>
        </transition>
    </div>
</template>

<style scoped>
@keyframes float {
    0%,
    100% {
        transform: translateY(0px) rotate(12deg);
    }
    50% {
        transform: translateY(-20px) rotate(12deg);
    }
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes shimmer {
    0% {
        background-position: -1000px 0;
    }
    100% {
        background-position: 1000px 0;
    }
}

@keyframes pulse-glow {
    0%,
    100% {
        opacity: 0.5;
        transform: scale(1);
    }
    50% {
        opacity: 1;
        transform: scale(1.05);
    }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

.animate-shimmer {
    animation: shimmer 3s linear infinite;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(59, 130, 246, 0.1),
        transparent
    );
    background-size: 1000px 100%;
}

.animate-pulse-glow {
    animation: pulse-glow 2s ease-in-out infinite;
}

.scroll-animate {
    opacity: 0;
    transform: translateY(30px);
    transition:
        opacity 0.6s ease-out,
        transform 0.6s ease-out;
}

.scroll-animate.animate-fade-in-up {
    opacity: 1;
    transform: translateY(0);
}
</style>
