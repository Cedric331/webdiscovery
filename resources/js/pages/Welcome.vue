<script setup lang="ts">
import GdprBanner from '@/components/GdprBanner.vue';
import SEO from '@/components/SEO.vue';
import { dashboard, login, register } from '@/routes';
import { Link, useForm } from '@inertiajs/vue3';
import { onMounted, onUnmounted, ref } from 'vue';

interface FeaturedPortfolio {
    id: number;
    title: string;
    description: string;
    url: string | null;
    tags: string[] | null;
    image_url: string | null;
}

withDefaults(
    defineProps<{
        canRegister: boolean;
        flash?: {
            success?: string;
            error?: string;
        };
        featuredPortfolios?: FeaturedPortfolio[];
    }>(),
    {
        canRegister: true,
        featuredPortfolios: () => [],
    },
);

const form = useForm({
    name: '',
    email: '',
    phone: '',
    project_type: '',
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

const serviceCards = [
    {
        icon: '🖥️',
        title: 'Site Vitrine',
        description:
            'La présence en ligne idéale pour les artisans, commerçants et indépendants. Un site professionnel qui inspire confiance et génère des contacts.',
        features: ['Design moderne & responsive', 'SEO natif inclus', 'Formulaire de contact', 'Mise en ligne incluse'],
        highlighted: false,
        cta: 'Demander un devis',
    },
    {
        icon: '🛒',
        title: 'Site E-commerce',
        description:
            "Vendez vos produits ou services en ligne 24h/24 avec une boutique sécurisée, simple à gérer et optimisée pour les conversions.",
        features: ['Catalogue produits', 'Paiement en ligne sécurisé', 'Gestion des commandes', "Interface d'administration"],
        highlighted: false,
        cta: 'Demander un devis',
    },
    {
        icon: '⚙️',
        title: 'Application SaaS',
        description:
            'Transformez votre idée en solution digitale complète. Idéal pour les startups, agences et entreprises qui souhaitent digitaliser leurs processus.',
        features: ['Authentification & rôles', 'API RESTful sécurisée', "Dashboard d'administration", 'Architecture évolutive'],
        highlighted: true,
        cta: 'Discutons de votre projet',
    },
    {
        icon: '🔄',
        title: 'Refonte de Site',
        description:
            "Votre site existant est daté ou peu performant ? On le modernise entièrement pour améliorer l'expérience utilisateur et le référencement.",
        features: ["Audit de l'existant", 'Nouveau design', 'Migration des données', 'Amélioration SEO'],
        highlighted: false,
        cta: "Demander un audit gratuit",
    },
];

const processSteps = [
    {
        num: '01',
        icon: '☕',
        title: 'Premier échange',
        desc: "On discute de votre projet, vos besoins et vos objectifs lors d'un appel ou d'un échange par email. Totalement gratuit, sans engagement.",
    },
    {
        num: '02',
        icon: '📋',
        title: 'Devis personnalisé',
        desc: 'Vous recevez une proposition détaillée : périmètre exact, délais et budget. Envoyée sous 48h, gratuite et sans engagement.',
    },
    {
        num: '03',
        icon: '🎨',
        title: 'Design & Maquettes',
        desc: "On conçoit le design de votre site et vous le soumettons pour validation. Aucune ligne de code n'est écrite avant votre accord.",
    },
    {
        num: '04',
        icon: '💻',
        title: 'Développement',
        desc: "Votre site est développé avec les meilleures technologies, avec des points d'étape réguliers pour intégrer vos retours.",
    },
    {
        num: '05',
        icon: '🚀',
        title: 'Livraison & Suivi',
        desc: 'Mise en production après votre validation finale, formation à la prise en main de votre site et support post-livraison inclus.',
    },
];

const faqItems = ref([
    {
        q: "Combien coûte la création d'un site web vitrine ?",
        a: "Le tarif dépend de la complexité du projet et des fonctionnalités souhaitées. Chaque devis est personnalisé et gratuit. Nous étudions votre besoin avant de vous proposer une solution adaptée à votre budget.",
        open: false,
    },
    {
        q: "Combien de temps prend la création d'un site web ?",
        a: "Un site vitrine est généralement livré en 2 à 4 semaines. Une application sur mesure peut prendre 1 à 3 mois selon la complexité. Nous établissons un planning précis dès le devis.",
        open: false,
    },
    {
        q: "Est-ce que je peux modifier le contenu de mon site moi-même ?",
        a: "Oui ! Selon votre projet, nous intégrons un CMS simple d'utilisation, ou nous vous formons à la modification des textes, images et pages. Vous restez autonome sur votre site.",
        open: false,
    },
    {
        q: "Mon site sera-t-il bien référencé sur Google ?",
        a: "Le SEO est intégré dès la conception : structure technique optimisée, balises HTML correctes, vitesse de chargement rapide, compatibilité mobile garantie. Votre site est prêt pour un bon référencement dès sa mise en ligne.",
        open: false,
    },
    {
        q: "Que se passe-t-il après la livraison du site ?",
        a: "Vous bénéficiez d'un support post-livraison. Pour les évolutions ou nouvelles fonctionnalités, nous établissons un nouveau devis. Nous restons disponibles pour toute question ou correction.",
        open: false,
    },
    {
        q: "Je n'ai pas d'idée précise, est-ce que vous pouvez m'aider ?",
        a: "Absolument ! C'est même la situation la plus fréquente. Nous vous guidons de A à Z : définition du besoin, conseils sur le design, choix des fonctionnalités, puis développement et mise en ligne. Vous avez juste à nous décrire votre activité.",
        open: false,
    },
]);

const toggleFaq = (index: number) => {
    faqItems.value[index].open = !faqItems.value[index].open;
};

const clientTypes = [
    '🔨 Artisans',
    '✂️ Coiffeurs',
    '🔧 Plombiers',
    '⚡ Électriciens',
    '🪑 Menuisiers',
    '🍕 Restaurateurs',
    '🏪 Commerçants',
    '💼 TPE & PME',
    '👨‍💼 Indépendants',
    '🌿 Paysagistes',
    '🏠 Immobilier',
    '🎨 Graphistes',
    '💆 Bien-être',
    '🧹 Services à la personne',
];

const showScrollTop = ref(false);
const activeSection = ref('');
const mobileMenuOpen = ref(false);

const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px',
};

let observer: IntersectionObserver | null = null;

const navLinks = [
    { id: 'services', label: 'Services' },
    { id: 'processus', label: 'Processus' },
    { id: 'tarifs', label: 'Tarifs' },
    { id: 'contact', label: 'Contact' },
];

const scrollToSection = (id: string) => {
    mobileMenuOpen.value = false;
    const element = document.getElementById(id);
    if (element) {
        const headerOffset = 80;
        const elementPosition = element.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
        window.scrollTo({ top: offsetPosition, behavior: 'smooth' });
    }
};

const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
};

onMounted(() => {
    observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.reveal').forEach((el) => {
        observer?.observe(el);
    });

    const sectionObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    activeSection.value = entry.target.id;
                }
            });
        },
        { threshold: 0.3, rootMargin: '-100px 0px -50% 0px' },
    );

    navLinks.forEach((link) => {
        const section = document.getElementById(link.id);
        if (section) sectionObserver.observe(section);
    });

    const handleScroll = () => {
        showScrollTop.value = window.scrollY > 300;
    };

    window.addEventListener('scroll', handleScroll, { passive: true });

    return () => {
        window.removeEventListener('scroll', handleScroll);
        sectionObserver.disconnect();
    };
});

onUnmounted(() => {
    observer?.disconnect();
});

const structuredData = [
    {
        '@context': 'https://schema.org',
        '@type': 'ProfessionalService',
        name: 'Web Discovery',
        description:
            'Création de sites web vitrine et applications SaaS sur mesure. Spécialiste en développement web avec Laravel et Vue.js. Tarifs sur devis.',
        url: typeof window !== 'undefined' ? window.location.origin : '',
        priceRange: 'Sur devis',
        areaServed: { '@type': 'Country', name: 'France' },
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
            description: 'Création de site web vitrine professionnel avec design moderne, responsive et optimisé SEO',
            price: 'sur devis',
            priceCurrency: 'EUR',
            availability: 'https://schema.org/InStock',
        },
        aggregateRating: { '@type': 'AggregateRating', ratingValue: '5', reviewCount: '1' },
        sameAs: [],
    },
    {
        '@context': 'https://schema.org',
        '@type': 'LocalBusiness',
        '@id': typeof window !== 'undefined' ? window.location.origin : '',
        name: 'Web Discovery',
        description: 'Création de sites web vitrine et applications SaaS sur mesure. Spécialiste en développement web avec Laravel et Vue.js.',
        url: typeof window !== 'undefined' ? window.location.origin : '',
        priceRange: 'Sur devis',
        address: { '@type': 'PostalAddress', addressCountry: 'FR', addressLocality: 'France' },
        areaServed: { '@type': 'Country', name: 'France' },
        hasOfferCatalog: {
            '@type': 'OfferCatalog',
            name: 'Services Web Discovery',
            itemListElement: [
                {
                    '@type': 'Offer',
                    itemOffered: {
                        '@type': 'Service',
                        name: 'Création site web vitrine',
                        description: 'Création de site web vitrine professionnel avec design moderne, responsive et optimisé SEO',
                        provider: { '@type': 'LocalBusiness', name: 'Web Discovery' },
                    },
                    price: 'sur devis',
                    priceCurrency: 'EUR',
                },
                {
                    '@type': 'Offer',
                    itemOffered: {
                        '@type': 'Service',
                        name: 'Application SaaS',
                        description: "Développement d'applications SaaS sur mesure avec Laravel et Vue.js",
                        provider: { '@type': 'LocalBusiness', name: 'Web Discovery' },
                    },
                },
            ],
        },
    },
];

onMounted(() => {
    structuredData.forEach((data, index) => {
        const dataType = index === 0 ? 'professional-service' : 'local-business';
        const existingScript = document.querySelector(`script[type="application/ld+json"][data-type="${dataType}"]`);
        if (!existingScript) {
            const script = document.createElement('script');
            script.setAttribute('type', 'application/ld+json');
            script.setAttribute('data-type', dataType);
            script.textContent = JSON.stringify(data);
            document.head.appendChild(script);
        }
    });
});

const getTags = (tags: string[] | null): string[] => {
    if (!tags) return [];
    if (Array.isArray(tags)) return tags.filter((t) => t && t.trim() !== '');
    try {
        const parsed = JSON.parse(tags as unknown as string);
        if (Array.isArray(parsed)) return parsed.filter((t: string) => t && t.trim() !== '');
    } catch {}
    return (tags as unknown as string).split(',').map((t: string) => t.trim()).filter((t) => t !== '');
};
</script>

<template>
    <SEO
        title="Création Site Web Vitrine Professionnel | Web Discovery - Développement Web & SaaS sur Mesure"
        description="Création de site web vitrine professionnel sur devis. Développement de sites web et applications SaaS sur mesure avec Laravel et Vue.js. Design moderne, responsive et optimisé SEO."
        canonical="/"
        keywords="création site web vitrine, création site internet, développement site web, site web sur mesure, création site web professionnel, site vitrine pas cher, développement web Laravel, développement web Vue.js, application SaaS, site web responsive"
        :structured-data="structuredData"
    />

    <div class="min-h-screen bg-[#080c14] text-white" itemscope itemtype="https://schema.org/WebSite">

        <!-- HEADER -->
        <header class="fixed top-0 inset-x-0 z-50" role="banner">
            <div class="mx-auto max-w-7xl px-6">
                <div class="mt-4 rounded-2xl border border-white/[0.06] bg-white/[0.03] backdrop-blur-2xl shadow-xl shadow-black/20">
                    <nav class="flex items-center justify-between px-6 py-3">
                        <Link href="/" class="flex items-center gap-3 group">
                            <img src="/asset/logo-2.png" alt="Logo Web Discovery" class="h-9 w-auto object-contain transition-opacity group-hover:opacity-90" loading="lazy" />
                            <span class="text-sm font-bold tracking-widest text-white/80 uppercase">Web Discovery</span>
                        </Link>

                        <div class="hidden md:flex items-center gap-1">
                            <button v-for="link in navLinks" :key="link.id" @click="scrollToSection(link.id)" type="button"
                                :class="['relative px-4 py-2 text-sm font-medium rounded-xl transition-all duration-200',
                                    activeSection === link.id
                                        ? 'text-white'
                                        : 'text-white/50 hover:text-white/80']"
                            >
                                <span v-if="activeSection === link.id" class="absolute inset-0 rounded-xl bg-white/[0.08]"></span>
                                <span class="relative">{{ link.label }}</span>
                            </button>
                            <div class="mx-3 h-5 w-px bg-white/10"></div>
                            <Link href="/portfolio" class="px-4 py-2 text-sm font-medium text-white/50 hover:text-white/80 transition-colors rounded-xl hover:bg-white/[0.05]">
                                Réalisations
                            </Link>
                            <Link href="/blog" class="px-4 py-2 text-sm font-medium text-white/50 hover:text-white/80 transition-colors rounded-xl hover:bg-white/[0.05]">
                                Blog
                            </Link>
                            <button @click="scrollToSection('contact')" type="button"
                                class="ml-2 px-5 py-2 text-sm font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white transition-all duration-200 shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40">
                                Devis gratuit →
                            </button>
                        </div>

                        <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="md:hidden p-2 rounded-lg text-white/60 hover:text-white hover:bg-white/[0.06] transition-colors" aria-label="Menu">
                            <svg v-if="!mobileMenuOpen" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg v-else class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </nav>

                    <transition enter-active-class="transition duration-150 ease-out" enter-from-class="opacity-0 -translate-y-2" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition duration-100 ease-in" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 -translate-y-2">
                        <div v-if="mobileMenuOpen" class="md:hidden border-t border-white/[0.06] px-4 py-4 space-y-1">
                            <button v-for="link in navLinks" :key="link.id" @click="scrollToSection(link.id)" type="button"
                                class="w-full text-left px-4 py-2.5 text-sm font-medium text-white/70 hover:text-white rounded-xl hover:bg-white/[0.06] transition-colors">
                                {{ link.label }}
                            </button>
                            <Link href="/portfolio" class="block px-4 py-2.5 text-sm font-medium text-white/70 hover:text-white rounded-xl hover:bg-white/[0.06] transition-colors">Réalisations</Link>
                            <Link href="/blog" class="block px-4 py-2.5 text-sm font-medium text-white/70 hover:text-white rounded-xl hover:bg-white/[0.06] transition-colors">Blog</Link>
                            <button @click="scrollToSection('contact')" type="button"
                                class="w-full text-left px-4 py-2.5 text-sm font-semibold text-indigo-400 rounded-xl hover:bg-white/[0.06] transition-colors">
                                Devis gratuit →
                            </button>
                        </div>
                    </transition>
                </div>
            </div>

            <div class="hidden">
                <Link v-if="$page.props.auth?.user" :href="dashboard()">Dashboard</Link>
                <template v-else>
                    <Link :href="login()">Log in</Link>
                    <Link v-if="canRegister" :href="register()">Register</Link>
                </template>
            </div>
        </header>

        <!-- HERO -->
        <main id="hero" class="relative min-h-screen flex flex-col items-center justify-center px-6 pt-40 pb-24 overflow-hidden" role="main">
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_60%_at_50%_-10%,rgba(99,102,241,0.15),transparent)]"></div>
                <div class="hero-grid absolute inset-0 opacity-[0.03]"></div>
                <div class="absolute top-1/3 left-1/4 w-72 h-72 bg-indigo-600/10 rounded-full blur-3xl animate-orb-1"></div>
                <div class="absolute top-1/2 right-1/4 w-96 h-96 bg-blue-600/8 rounded-full blur-3xl animate-orb-2"></div>
                <div class="absolute bottom-1/4 left-1/2 w-64 h-64 bg-violet-600/8 rounded-full blur-3xl animate-orb-3"></div>
            </div>

            <div class="relative z-10 max-w-5xl mx-auto text-center space-y-8">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-indigo-500/30 bg-indigo-500/10 text-sm text-indigo-300 font-medium reveal">
                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
                    🇫🇷 Développeur web indépendant · Devis gratuit sous 48h
                </div>

                <div class="reveal space-y-3">
                    <h1 class="text-5xl sm:text-7xl lg:text-8xl font-black leading-[1.0] tracking-tight">
                        <span class="block text-white">Votre site web</span>
                        <span class="block gradient-text">taillé pour vous.</span>
                    </h1>
                </div>

                <p class="reveal mx-auto max-w-2xl text-lg sm:text-xl text-white/50 leading-relaxed">
                    Artisan, commerçant, indépendant ou startup, nous créons des sites web
                    <strong class="text-white/80 font-semibold">modernes et performants</strong>
                    qui attirent vos clients et développent votre activité.
                </p>

                <div class="reveal flex flex-wrap gap-4 justify-center">
                    <button @click="scrollToSection('contact')" type="button"
                        class="group inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold transition-all duration-200 shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 hover:-translate-y-0.5">
                        Devis gratuit sans engagement
                        <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </button>
                    <button @click="scrollToSection('services')" type="button"
                        class="inline-flex items-center gap-2 px-8 py-4 rounded-xl border border-white/10 bg-white/[0.04] text-white/80 font-semibold hover:bg-white/[0.08] hover:text-white transition-all duration-200 hover:-translate-y-0.5">
                        Découvrir nos services
                    </button>
                </div>

                <div class="reveal pt-6 grid grid-cols-3 gap-6 max-w-lg mx-auto">
                    <div class="text-center">
                        <div class="text-2xl font-black text-white">100%</div>
                        <div class="text-xs text-white/40 mt-1">Sur mesure</div>
                    </div>
                    <div class="text-center border-x border-white/[0.06]">
                        <div class="text-2xl font-black text-white">SEO</div>
                        <div class="text-xs text-white/40 mt-1">Optimisé nativement</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-black text-white">48h</div>
                        <div class="text-xs text-white/40 mt-1">Délai de réponse</div>
                    </div>
                </div>
            </div>
        </main>

        <!-- BANDEAU TYPES DE CLIENTS -->
        <div class="border-b border-white/[0.04] overflow-hidden py-4 bg-white/[0.01]">
            <p class="text-center text-xs text-white/20 uppercase tracking-widest mb-3">Nous accompagnons</p>
            <div class="relative overflow-hidden">
                <div class="flex gap-10 animate-marquee whitespace-nowrap">
                    <span v-for="(type, i) in [...clientTypes, ...clientTypes]" :key="i" class="flex-shrink-0 text-sm text-white/35 font-medium">
                        {{ type }}
                    </span>
                </div>
            </div>
        </div>

        <!-- SERVICES -->
        <section id="services" class="px-6 py-24" itemscope itemtype="https://schema.org/Service">
            <div class="mx-auto max-w-7xl">
                <div class="reveal mb-16 text-center space-y-4">
                    <span class="inline-block px-3 py-1 rounded-full border border-white/10 bg-white/[0.03] text-xs font-medium text-white/50 uppercase tracking-widest">Nos services</span>
                    <h2 class="text-4xl sm:text-5xl font-black text-white">Ce que nous <span class="gradient-text">créons</span></h2>
                    <p class="mx-auto max-w-2xl text-white/50 leading-relaxed">
                        Des solutions web adaptées à chaque besoin, quel que soit votre secteur d'activité.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div v-for="(service, index) in serviceCards" :key="service.title"
                        :style="{ transitionDelay: `${index * 80}ms` }"
                        :class="[
                            'reveal group relative rounded-3xl border p-8 hover:-translate-y-1 transition-all duration-300',
                            service.highlighted
                                ? 'border-indigo-500/30 bg-gradient-to-br from-indigo-500/10 via-transparent to-transparent hover:border-indigo-400/50'
                                : 'border-white/[0.08] bg-white/[0.02] hover:border-white/20'
                        ]">
                        <div v-if="service.highlighted" class="absolute top-4 right-4 px-3 py-1 rounded-full bg-indigo-500/20 border border-indigo-500/30 text-xs font-semibold text-indigo-300">
                            Populaire
                        </div>

                        <div class="mb-5 h-14 w-14 rounded-2xl border border-white/[0.08] bg-white/[0.03] flex items-center justify-center text-3xl group-hover:scale-110 transition-transform duration-200">
                            {{ service.icon }}
                        </div>

                        <h3 class="text-xl font-bold text-white mb-2">{{ service.title }}</h3>
                        <p class="text-white/45 text-sm leading-relaxed mb-6">{{ service.description }}</p>

                        <ul class="space-y-2 mb-8">
                            <li v-for="feature in service.features" :key="feature" class="flex items-center gap-2.5 text-sm text-white/60">
                                <svg :class="['h-4 w-4 flex-shrink-0', service.highlighted ? 'text-indigo-400' : 'text-indigo-400']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ feature }}
                            </li>
                        </ul>

                        <button @click="scrollToSection('contact')" type="button"
                            :class="[
                                'w-full text-center px-6 py-3 rounded-xl font-semibold text-sm transition-all duration-200',
                                service.highlighted
                                    ? 'bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40'
                                    : 'border border-white/10 bg-white/[0.04] text-white/80 hover:bg-white/[0.08] hover:text-white'
                            ]">
                            {{ service.cta }}
                        </button>
                    </div>
                </div>

                <!-- Tech stack mention -->
                <div class="reveal mt-14 text-center">
                    <p class="text-xs text-white/25 uppercase tracking-widest mb-4">Développé avec les meilleures technologies open-source</p>
                    <div class="flex flex-wrap justify-center gap-3">
                        <span v-for="tech in ['Laravel', 'Vue.js', 'Tailwind CSS', 'PHP 8', 'MySQL', 'InertiaJS', 'Livewire']" :key="tech"
                            class="px-3 py-1.5 rounded-full border border-white/[0.08] bg-white/[0.02] text-xs text-white/40 font-medium">
                            {{ tech }}
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- PROCESSUS -->
        <section id="processus" class="px-6 py-24 border-t border-white/[0.04]">
            <div class="mx-auto max-w-5xl">
                <div class="reveal mb-16 text-center space-y-4">
                    <span class="inline-block px-3 py-1 rounded-full border border-white/10 bg-white/[0.03] text-xs font-medium text-white/50 uppercase tracking-widest">Notre méthode</span>
                    <h2 class="text-4xl sm:text-5xl font-black text-white">De l'idée à la <span class="gradient-text">mise en ligne</span></h2>
                    <p class="mx-auto max-w-xl text-white/50 leading-relaxed">Un processus clair, transparent et collaboratif en 5 étapes. Vous savez toujours où en est votre projet.</p>
                </div>

                <div class="space-y-4">
                    <div v-for="(step, index) in processSteps" :key="step.num"
                        :style="{ transitionDelay: `${index * 100}ms` }"
                        class="reveal flex gap-5 items-start p-6 rounded-2xl border border-white/[0.06] bg-white/[0.02] hover:border-indigo-500/20 hover:bg-white/[0.04] transition-all duration-300">
                        <div class="flex-shrink-0 relative">
                            <div class="h-14 w-14 rounded-2xl border border-indigo-500/20 bg-indigo-500/5 flex items-center justify-center text-2xl">
                                {{ step.icon }}
                            </div>
                            <div class="absolute -top-1.5 -right-1.5 h-6 w-6 rounded-full bg-indigo-600 flex items-center justify-center shadow-lg shadow-indigo-600/30">
                                <span class="text-[10px] font-bold text-white">{{ step.num }}</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-white text-base mb-1">{{ step.title }}</h3>
                            <p class="text-sm text-white/45 leading-relaxed">{{ step.desc }}</p>
                        </div>
                    </div>
                </div>

                <div class="reveal mt-12 text-center">
                    <button @click="scrollToSection('contact')" type="button"
                        class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold transition-all duration-200 shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 hover:-translate-y-0.5">
                        Démarrer maintenant c'est gratuit
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </button>
                </div>
            </div>
        </section>

        <!-- RÉALISATIONS (si disponibles) -->
        <section v-if="featuredPortfolios && featuredPortfolios.length > 0" id="realisations" class="px-6 py-24 border-t border-white/[0.04]">
            <div class="mx-auto max-w-7xl">
                <div class="reveal mb-12 text-center space-y-4">
                    <span class="inline-block px-3 py-1 rounded-full border border-white/10 bg-white/[0.03] text-xs font-medium text-white/50 uppercase tracking-widest">Portfolio</span>
                    <h2 class="text-4xl sm:text-5xl font-black text-white">Nos dernières <span class="gradient-text">créations</span></h2>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="(portfolio, index) in featuredPortfolios" :key="portfolio.id"
                        :style="{ transitionDelay: `${index * 80}ms` }"
                        class="reveal group relative rounded-2xl border border-white/[0.08] bg-white/[0.02] overflow-hidden hover:border-white/20 transition-all duration-300 hover:-translate-y-1">
                        <div v-if="portfolio.image_url" class="aspect-video overflow-hidden">
                            <img :src="portfolio.image_url" :alt="portfolio.title" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" />
                        </div>
                        <div v-else class="aspect-video bg-gradient-to-br from-indigo-500/10 to-transparent flex items-center justify-center">
                            <span class="text-4xl opacity-30">🖥️</span>
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-white mb-2">{{ portfolio.title }}</h3>
                            <p class="text-sm text-white/45 leading-relaxed line-clamp-2">{{ portfolio.description }}</p>
                            <div v-if="getTags(portfolio.tags).length" class="flex flex-wrap gap-2 mt-4">
                                <span v-for="tag in getTags(portfolio.tags).slice(0, 3)" :key="tag"
                                    class="px-2 py-0.5 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-xs text-indigo-300">
                                    {{ tag }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="reveal mt-10 text-center">
                    <Link href="/portfolio"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border border-white/10 bg-white/[0.04] text-white/80 font-semibold hover:bg-white/[0.08] hover:text-white transition-all duration-200">
                        Voir toutes les réalisations →
                    </Link>
                </div>
            </div>
        </section>

        <!-- À PROPOS -->
        <section id="entreprise" class="px-6 py-24 border-t border-white/[0.04]" itemscope itemtype="https://schema.org/Organization">
            <div class="mx-auto max-w-6xl">
                <div class="reveal mb-16 text-center space-y-4">
                    <span class="inline-block px-3 py-1 rounded-full border border-white/10 bg-white/[0.03] text-xs font-medium text-white/50 uppercase tracking-widest">À propos</span>
                    <h2 class="text-4xl sm:text-5xl font-black text-white">Web <span class="gradient-text">Discovery</span></h2>
                </div>

                <div class="grid lg:grid-cols-2 gap-8 items-start">
                    <div class="reveal space-y-5 text-white/55 leading-relaxed">
                        <p>
                            <strong class="text-white font-semibold">Web Discovery</strong> est spécialisé dans la
                            <strong class="text-indigo-300 font-semibold">création de sites web vitrine</strong> et le développement d'applications SaaS sur mesure.
                            Nous transformons vos idées en solutions web modernes, performantes et visibles sur les moteurs de recherche.
                        </p>
                        <p>
                            Notre approche combine design moderne, code de qualité et optimisation SEO pour garantir la visibilité de votre
                            <strong class="text-indigo-300 font-semibold">présence en ligne</strong>.
                            Chaque projet bénéficie d'une attention particulière à chaque étape : analyse, conception, développement et mise en production.
                        </p>
                        <p>
                            Nous croyons en la transparence et la communication régulière. Notre objectif est de livrer non seulement un produit qui fonctionne, mais une solution qui contribue réellement à la croissance de votre activité.
                        </p>
                    </div>

                    <div class="reveal grid gap-4">
                        <div v-for="(point, i) in [
                            { icon: '🎯', title: 'Approche sur mesure', desc: 'Chaque projet est unique. Nous adaptons notre méthodologie à vos besoins spécifiques.' },
                            { icon: '⚡', title: 'Livraison rapide', desc: 'Process agile et communication continue pour des livraisons dans les délais convenus.' },
                            { icon: '🔍', title: 'SEO natif', desc: 'Optimisation pour les moteurs de recherche intégrée dès la conception.' },
                            { icon: '🛡️', title: 'Code sécurisé', desc: 'Architecture robuste, bonnes pratiques de sécurité, données protégées.' },
                        ]" :key="i" class="flex items-start gap-4 p-5 rounded-2xl border border-white/[0.06] bg-white/[0.02] hover:bg-white/[0.04] transition-colors">
                            <span class="text-2xl">{{ point.icon }}</span>
                            <div>
                                <div class="font-semibold text-white text-sm">{{ point.title }}</div>
                                <div class="mt-1 text-sm text-white/40">{{ point.desc }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- TARIFS -->
        <section id="tarifs" class="px-6 py-24 border-t border-white/[0.04]" itemscope itemtype="https://schema.org/PriceSpecification">
            <div class="mx-auto max-w-6xl">
                <div class="reveal mb-16 text-center space-y-4">
                    <span class="inline-block px-3 py-1 rounded-full border border-white/10 bg-white/[0.03] text-xs font-medium text-white/50 uppercase tracking-widest">Tarification</span>
                    <h2 class="text-4xl sm:text-5xl font-black text-white">Des tarifs <span class="gradient-text">transparents</span></h2>
                    <p class="text-white/40">Chaque projet est étudié selon vos besoins. Devis gratuit sous 48h.</p>
                </div>

                <div class="grid md:grid-cols-2 gap-6 max-w-4xl mx-auto">
                    <div class="reveal group relative rounded-3xl border border-white/[0.08] bg-white/[0.02] p-8 hover:border-white/20 transition-all duration-300 hover:-translate-y-1">
                        <div class="mb-6">
                            <div class="text-xs font-semibold text-white/40 uppercase tracking-widest mb-2">Site Vitrine</div>
                            <h3 class="text-2xl font-bold text-white">Création Site Web Vitrine</h3>
                            <p class="mt-2 text-sm text-white/40">Idéal pour présenter votre activité professionnellement en ligne</p>
                        </div>

                        <div class="mb-8 flex items-baseline gap-2">
                            <span class="text-5xl font-black text-white">Sur devis</span>
                        </div>

                        <ul class="space-y-3 mb-8">
                            <li v-for="feature in ['Design moderne & responsive', 'Optimisation SEO intégrée', 'Formulaire de contact', 'Mise en ligne incluse', 'Optimisation des performances', 'Support post-livraison']" :key="feature"
                                class="flex items-center gap-3 text-sm text-white/60">
                                <svg class="h-4 w-4 flex-shrink-0 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ feature }}
                            </li>
                        </ul>

                        <button @click="scrollToSection('contact')" type="button"
                            class="block w-full text-center px-6 py-3 rounded-xl border border-white/10 bg-white/[0.04] text-white/80 font-semibold hover:bg-white/[0.08] hover:text-white transition-all duration-200">
                            Demander un devis gratuit
                        </button>
                    </div>

                    <div class="reveal group relative rounded-3xl border border-indigo-500/30 bg-gradient-to-br from-indigo-500/10 via-transparent to-transparent p-8 hover:border-indigo-400/50 transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute top-4 right-4 px-3 py-1 rounded-full bg-indigo-500/20 border border-indigo-500/30 text-xs font-semibold text-indigo-300">
                            Sur mesure
                        </div>

                        <div class="mb-6">
                            <div class="text-xs font-semibold text-indigo-400/70 uppercase tracking-widest mb-2">Application</div>
                            <h3 class="text-2xl font-bold text-white">SaaS & Applications</h3>
                            <p class="mt-2 text-sm text-white/40">Solutions complexes adaptées à vos processus métier</p>
                        </div>

                        <div class="mb-8 flex items-baseline gap-2">
                            <span class="text-5xl font-black text-white">Sur devis</span>
                        </div>

                        <ul class="space-y-3 mb-8">
                            <li v-for="feature in ['Application web complète', 'API RESTful sécurisée', 'Authentification & rôles', 'Dashboard d\'administration', 'Maintenance & support', 'Évolutivité garantie']" :key="feature"
                                class="flex items-center gap-3 text-sm text-white/60">
                                <svg class="h-4 w-4 flex-shrink-0 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ feature }}
                            </li>
                        </ul>

                        <button @click="scrollToSection('contact')" type="button"
                            class="block w-full text-center px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold transition-all duration-200 shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40">
                            Discutons de votre projet
                        </button>
                    </div>
                </div>

                <p class="reveal mt-10 text-center text-sm text-white/30">
                    Tous les projets sont personnalisés. Devis détaillé fourni gratuitement après analyse de vos besoins.
                </p>
            </div>
        </section>

        <!-- AIDES & SUBVENTIONS -->
        <section id="aides" class="px-6 py-24 border-t border-white/[0.04]">
            <div class="mx-auto max-w-6xl">
                <div class="reveal mb-16 text-center space-y-4">
                    <span class="inline-block px-3 py-1 rounded-full border border-emerald-500/30 bg-emerald-500/10 text-xs font-medium text-emerald-400 uppercase tracking-widest">Financement</span>
                    <h2 class="text-4xl sm:text-5xl font-black text-white">Aides <span class="gradient-text-green">&amp; Subventions</span></h2>
                    <p class="text-white/40 max-w-xl mx-auto">Financez une partie de votre projet web grâce aux dispositifs publics disponibles.</p>
                </div>

                <div class="grid md:grid-cols-2 gap-6 max-w-4xl mx-auto">
                    <div class="reveal group relative rounded-3xl border border-white/[0.08] bg-white/[0.02] p-8 hover:border-emerald-500/30 transition-all duration-300 hover:-translate-y-1">
                        <div class="mb-6">
                            <div class="text-xs font-semibold text-white/40 uppercase tracking-widest mb-2">Subvention État</div>
                            <h3 class="text-2xl font-bold text-white">Aide à la création de site web</h3>
                            <p class="mt-2 text-sm text-white/40">Via le dispositif France Num</p>
                        </div>

                        <div class="mb-8">
                            <div class="text-xs text-emerald-400 font-semibold mb-1">Jusqu'à</div>
                            <div class="flex items-baseline gap-2">
                                <span class="text-5xl font-black text-white">40%</span>
                                <span class="text-emerald-400 font-semibold">du projet</span>
                            </div>
                        </div>

                        <ul class="space-y-3 mb-8">
                            <li v-for="item in ['Subvention État (France Num)', 'Création ou refonte de site web', 'E-commerce, vitrine, réservation']" :key="item"
                                class="flex items-center gap-3 text-sm text-white/60">
                                <svg class="h-4 w-4 flex-shrink-0 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ item }}
                            </li>
                        </ul>

                        <button @click="scrollToSection('contact')" type="button"
                            class="block w-full text-center px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-semibold transition-all duration-200 shadow-lg shadow-emerald-500/20">
                            Vérifier mon éligibilité
                        </button>
                    </div>

                    <div class="reveal group relative rounded-3xl border border-emerald-500/20 bg-gradient-to-br from-emerald-500/8 via-transparent to-transparent p-8 hover:border-emerald-400/40 transition-all duration-300 hover:-translate-y-1">
                        <div class="mb-6">
                            <div class="text-xs font-semibold text-emerald-400/70 uppercase tracking-widest mb-2">Aide régionale</div>
                            <h3 class="text-2xl font-bold text-white">Chèques & aides régionales</h3>
                            <p class="mt-2 text-sm text-white/40">Commerçants, artisans, indépendants</p>
                        </div>

                        <div class="mb-8">
                            <div class="text-xs text-emerald-400 font-semibold mb-1">Jusqu'à</div>
                            <div class="text-5xl font-black text-white">1 500 €</div>
                        </div>

                        <ul class="space-y-3 mb-8">
                            <li v-for="item in ['Chèque numérique régional', 'Commerçants, artisans, indépendants', 'Site web, boutique, outils métier']" :key="item"
                                class="flex items-center gap-3 text-sm text-white/60">
                                <svg class="h-4 w-4 flex-shrink-0 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ item }}
                            </li>
                        </ul>

                        <button @click="scrollToSection('contact')" type="button"
                            class="block w-full text-center px-6 py-3 rounded-xl border border-emerald-400/30 text-emerald-400 font-semibold hover:bg-emerald-500 hover:text-white hover:border-emerald-500 transition-all duration-200">
                            Analyser mes aides possibles
                        </button>
                    </div>
                </div>

                <p class="reveal mt-10 text-center text-sm text-white/30">
                    Les aides dépendent de votre région, statut et projet. Une demande de subvention doit être déposée auprès de votre région.
                </p>
            </div>
        </section>

        <!-- FAQ -->
        <section id="faq" class="px-6 py-24 border-t border-white/[0.04]">
            <div class="mx-auto max-w-3xl">
                <div class="reveal mb-12 text-center space-y-4">
                    <span class="inline-block px-3 py-1 rounded-full border border-white/10 bg-white/[0.03] text-xs font-medium text-white/50 uppercase tracking-widest">FAQ</span>
                    <h2 class="text-4xl sm:text-5xl font-black text-white">Questions <span class="gradient-text">fréquentes</span></h2>
                    <p class="text-white/40">Tout ce que vous devez savoir avant de nous contacter.</p>
                </div>

                <div class="space-y-3">
                    <div v-for="(faq, index) in faqItems" :key="index"
                        :style="{ transitionDelay: `${index * 60}ms` }"
                        class="reveal rounded-2xl border border-white/[0.06] bg-white/[0.02] overflow-hidden hover:border-white/[0.12] transition-colors">
                        <button @click="toggleFaq(index)" type="button" class="w-full flex items-center justify-between px-6 py-5 text-left gap-4">
                            <span class="font-semibold text-white text-sm leading-relaxed">{{ faq.q }}</span>
                            <svg :class="['h-5 w-5 flex-shrink-0 text-indigo-400 transition-transform duration-200', faq.open && 'rotate-180']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <transition
                            enter-active-class="transition-all duration-200 ease-out"
                            enter-from-class="opacity-0 max-h-0"
                            enter-to-class="opacity-100 max-h-40"
                            leave-active-class="transition-all duration-150 ease-in"
                            leave-from-class="opacity-100 max-h-40"
                            leave-to-class="opacity-0 max-h-0">
                            <div v-if="faq.open" class="px-6 pb-5">
                                <p class="text-sm text-white/50 leading-relaxed">{{ faq.a }}</p>
                            </div>
                        </transition>
                    </div>
                </div>

                <div class="reveal mt-10 p-6 rounded-2xl border border-indigo-500/20 bg-indigo-500/5 text-center">
                    <p class="text-white/50 text-sm mb-4">Vous n'avez pas trouvé la réponse à votre question ?</p>
                    <button @click="scrollToSection('contact')" type="button"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm transition-all duration-200 shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40">
                        Posez-nous votre question →
                    </button>
                </div>
            </div>
        </section>

        <!-- CONTACT -->
        <section id="contact" class="px-6 py-24 border-t border-white/[0.04]">
            <div class="mx-auto max-w-6xl">
                <div class="reveal mb-16 text-center space-y-4">
                    <span class="inline-block px-3 py-1 rounded-full border border-white/10 bg-white/[0.03] text-xs font-medium text-white/50 uppercase tracking-widest">Contact</span>
                    <h2 class="text-4xl sm:text-5xl font-black text-white">Parlons de votre <span class="gradient-text">projet</span></h2>
                    <p class="text-white/40 max-w-xl mx-auto">Décrivez votre besoin et recevez un devis personnalisé sous 48h. Gratuit, sans engagement.</p>
                </div>

                <div class="grid lg:grid-cols-5 gap-8 max-w-5xl mx-auto">
                    <div class="reveal lg:col-span-2 space-y-6">
                        <div class="space-y-4">
                            <div v-for="(info, i) in [
                                { icon: '💬', title: 'Réponse rapide', desc: 'Retour sous 48h ouvrées' },
                                { icon: '🎁', title: 'Devis 100% gratuit', desc: 'Étude de votre projet sans engagement' },
                                { icon: '🔒', title: 'Confidentialité', desc: 'Vos données restent privées' },
                                { icon: '☕', title: 'Appel découverte', desc: 'On peut aussi en discuter directement' },
                            ]" :key="i" class="flex items-start gap-4 p-4 rounded-2xl border border-white/[0.06] bg-white/[0.02]">
                                <span class="text-2xl">{{ info.icon }}</span>
                                <div>
                                    <div class="font-semibold text-white text-sm">{{ info.title }}</div>
                                    <div class="text-sm text-white/40">{{ info.desc }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="p-5 rounded-2xl border border-indigo-500/20 bg-indigo-500/5">
                            <p class="text-sm text-white/50 leading-relaxed">
                                Que vous ayez un projet précis ou simplement une idée à explorer, nous sommes là pour vous guider vers la meilleure solution.
                            </p>
                        </div>
                    </div>

                    <div class="reveal lg:col-span-3">
                        <div class="rounded-3xl border border-white/[0.08] bg-white/[0.02] p-8">
                            <form @submit.prevent="submit" class="space-y-5">
                                <transition enter-active-class="transition ease-out duration-300" enter-from-class="opacity-0 -translate-y-1" enter-to-class="opacity-100 translate-y-0">
                                    <div v-if="$page.props.flash?.success" class="rounded-xl border border-emerald-500/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-300">
                                        {{ $page.props.flash.success }}
                                    </div>
                                </transition>
                                <transition enter-active-class="transition ease-out duration-300" enter-from-class="opacity-0 -translate-y-1" enter-to-class="opacity-100 translate-y-0">
                                    <div v-if="$page.props.flash?.error" class="rounded-xl border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-300">
                                        {{ $page.props.flash.error }}
                                    </div>
                                </transition>

                                <div class="grid sm:grid-cols-2 gap-5">
                                    <div>
                                        <label for="name" class="block mb-1.5 text-xs font-semibold text-white/50 uppercase tracking-wide">
                                            Nom <span class="text-red-400 normal-case">*</span>
                                        </label>
                                        <input id="name" v-model="form.name" type="text" required placeholder="Votre nom"
                                            class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white placeholder-white/20 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all" />
                                        <div v-if="form.errors.name" class="mt-1.5 text-xs text-red-400">{{ form.errors.name }}</div>
                                    </div>

                                    <div>
                                        <label for="email" class="block mb-1.5 text-xs font-semibold text-white/50 uppercase tracking-wide">
                                            Email <span class="text-red-400 normal-case">*</span>
                                        </label>
                                        <input id="email" v-model="form.email" type="email" required placeholder="votre@email.com"
                                            class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white placeholder-white/20 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all" />
                                        <div v-if="form.errors.email" class="mt-1.5 text-xs text-red-400">{{ form.errors.email }}</div>
                                    </div>
                                </div>

                                <div class="grid sm:grid-cols-2 gap-5">
                                    <div>
                                        <label for="phone" class="block mb-1.5 text-xs font-semibold text-white/50 uppercase tracking-wide">Téléphone</label>
                                        <input id="phone" v-model="form.phone" type="tel" placeholder="06 12 34 56 78"
                                            class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white placeholder-white/20 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all" />
                                        <div v-if="form.errors.phone" class="mt-1.5 text-xs text-red-400">{{ form.errors.phone }}</div>
                                    </div>

                                    <div>
                                        <label for="project_type" class="block mb-1.5 text-xs font-semibold text-white/50 uppercase tracking-wide">Type de projet</label>
                                        <select id="project_type" v-model="form.project_type"
                                            class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all appearance-none">
                                            <option value="" class="bg-slate-900">Type de projet</option>
                                            <option value="site-vitrine" class="bg-slate-900">Site web vitrine</option>
                                            <option value="ecommerce" class="bg-slate-900">Site e-commerce</option>
                                            <option value="saas" class="bg-slate-900">Application SaaS</option>
                                            <option value="refonte" class="bg-slate-900">Refonte de site</option>
                                            <option value="autre" class="bg-slate-900">Autre</option>
                                        </select>
                                        <div v-if="form.errors.project_type" class="mt-1.5 text-xs text-red-400">{{ form.errors.project_type }}</div>
                                    </div>
                                </div>

                                <div>
                                    <label for="message" class="block mb-1.5 text-xs font-semibold text-white/50 uppercase tracking-wide">
                                        Message <span class="text-red-400 normal-case">*</span>
                                    </label>
                                    <textarea id="message" v-model="form.message" required rows="5" placeholder="Décrivez votre projet, vos objectifs, votre secteur d'activité..."
                                        class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white placeholder-white/20 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all resize-none"></textarea>
                                    <div v-if="form.errors.message" class="mt-1.5 text-xs text-red-400">{{ form.errors.message }}</div>
                                </div>

                                <p class="text-xs text-white/25">
                                    En soumettant ce formulaire, vous acceptez que vos données soient utilisées pour vous contacter.
                                    <Link href="/politique-confidentialite" class="text-indigo-400/70 hover:text-indigo-400 underline">Politique de confidentialité</Link>
                                </p>

                                <button type="submit" :disabled="form.processing"
                                    class="w-full px-6 py-4 rounded-xl bg-indigo-600 hover:bg-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed text-white font-semibold text-sm transition-all duration-200 shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40 focus:outline-none focus:ring-2 focus:ring-indigo-500/50">
                                    <span v-if="form.processing" class="flex items-center justify-center gap-2">
                                        <span class="h-4 w-4 animate-spin rounded-full border-2 border-white border-t-transparent"></span>
                                        Envoi en cours...
                                    </span>
                                    <span v-else>Envoyer ma demande de devis →</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="border-t border-white/[0.06] bg-white/[0.01] px-6 py-16" role="contentinfo">
            <div class="mx-auto max-w-7xl">
                <div class="grid gap-10 md:grid-cols-3 mb-12">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <img src="/asset/logo-2.png" alt="Logo Web Discovery" class="h-9 w-auto object-contain opacity-80" loading="lazy" />
                            <span class="font-bold text-white/80 tracking-wider text-sm uppercase">Web Discovery</span>
                        </div>
                        <p class="text-sm text-white/35 leading-relaxed max-w-xs">
                            Création de sites web vitrine et applications SaaS sur mesure avec Laravel &amp; Vue.js.
                        </p>
                    </div>

                    <div>
                        <h3 class="mb-4 text-xs font-semibold text-white/40 uppercase tracking-widest">Navigation</h3>
                        <ul class="space-y-2.5 text-sm">
                            <li><button @click="scrollToSection('services')" type="button" class="text-white/40 hover:text-white/80 transition-colors">Services</button></li>
                            <li><button @click="scrollToSection('processus')" type="button" class="text-white/40 hover:text-white/80 transition-colors">Processus</button></li>
                            <li><button @click="scrollToSection('tarifs')" type="button" class="text-white/40 hover:text-white/80 transition-colors">Tarifs</button></li>
                            <li><button @click="scrollToSection('faq')" type="button" class="text-white/40 hover:text-white/80 transition-colors">FAQ</button></li>
                            <li><button @click="scrollToSection('contact')" type="button" class="text-white/40 hover:text-white/80 transition-colors">Contact</button></li>
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
                    <p class="text-xs text-white/25">
                        © {{ new Date().getFullYear() }} Web Discovery. Tous droits réservés.
                    </p>
                    <div class="flex items-center gap-1">
                        <span class="text-xs text-white/20">Fait avec</span>
                        <span class="text-xs text-indigo-400/60 mx-1">Laravel · Vue.js · InertiaJS</span>
                    </div>
                </div>
            </div>
        </footer>

        <GdprBanner />

        <transition
            enter-active-class="transition ease-out duration-300"
            enter-from-class="opacity-0 scale-75 translate-y-4"
            enter-to-class="opacity-100 scale-100 translate-y-0"
            leave-active-class="transition ease-in duration-200"
            leave-from-class="opacity-100 scale-100 translate-y-0"
            leave-to-class="opacity-0 scale-75 translate-y-4"
        >
            <button v-if="showScrollTop" @click="scrollToTop" type="button"
                class="fixed right-6 bottom-6 z-40 h-11 w-11 rounded-xl border border-white/10 bg-white/[0.06] backdrop-blur-xl text-white/70 hover:text-white hover:bg-white/[0.10] hover:border-white/20 transition-all duration-200 flex items-center justify-center shadow-xl"
                aria-label="Remonter en haut de la page">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                </svg>
            </button>
        </transition>
    </div>
</template>

<style scoped>
.gradient-text {
    background: linear-gradient(135deg, #818cf8 0%, #6366f1 40%, #3b82f6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.gradient-text-green {
    background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-grid {
    background-image:
        linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px);
    background-size: 60px 60px;
}

@keyframes orb1 {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33% { transform: translate(40px, -30px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.95); }
}
@keyframes orb2 {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33% { transform: translate(-50px, 20px) scale(1.05); }
    66% { transform: translate(30px, -40px) scale(0.9); }
}
@keyframes orb3 {
    0%, 100% { transform: translate(0, 0) scale(1); }
    50% { transform: translate(20px, -30px) scale(1.08); }
}

.animate-orb-1 { animation: orb1 12s ease-in-out infinite; }
.animate-orb-2 { animation: orb2 15s ease-in-out infinite; }
.animate-orb-3 { animation: orb3 10s ease-in-out infinite; }

@keyframes marquee {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

.animate-marquee {
    animation: marquee 30s linear infinite;
}

.reveal {
    opacity: 0;
    transform: translateY(24px);
    transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
}

.reveal.is-visible {
    opacity: 1;
    transform: translateY(0);
}
</style>
