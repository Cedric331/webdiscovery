<script setup lang="ts">
import DemosMenu from '@/components/DemosMenu.vue';
import GdprBanner from '@/components/GdprBanner.vue';
import SEO from '@/components/SEO.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { onMounted, onUnmounted, ref } from 'vue';

interface Demo {
    name: string;
    demoUrl: string;
    price: number;
    screenshots: {
        desktop: string | null;
        mobile: string | null;
    };
    faq: Array<{ question: string; answer: string }>;
}

const props = defineProps<{
    demo: Demo;
    structuredData: Array<Record<string, unknown>>;
}>();

const form = useForm({
    name: '',
    email: '',
    phone: '',
    project_type: 'site-vitrine',
    message: 'Bonjour, je suis coach sportif et je souhaite créer mon site internet.',
});

const submit = () => {
    form.post('/contact', {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
};

const mobileMenuOpen = ref(false);

const benefits = [
    {
        icon: '🏋️',
        title: 'Présentez toutes vos offres de coaching',
        desc: "Coaching individuel, petit groupe, suivi à distance, programmes personnalisés : chaque formule a sa place, sa description et son public.",
    },
    {
        icon: '💶',
        title: 'Affichez clairement vos prestations et vos tarifs',
        desc: "Vos prix sont visibles avant le premier contact. Vous ne perdez plus de temps avec des demandes hors budget.",
    },
    {
        icon: '⭐',
        title: 'Rassurez avec les témoignages de vos clients',
        desc: "Les résultats de vos élèves parlent pour vous. Un espace dédié met en avant leurs retours et lève les derniers doutes.",
    },
    {
        icon: '📩',
        title: 'Générez des demandes de contact',
        desc: "Un formulaire simple, accessible depuis toutes les sections du site, transforme un visiteur curieux en prise de contact.",
    },
    {
        icon: '✨',
        title: 'Renforcez votre image professionnelle',
        desc: "Un vrai site inspire davantage confiance qu'un simple profil sur les réseaux. Vous vous positionnez comme un professionnel établi.",
    },
    {
        icon: '🔍',
        title: 'Soyez visible sur Google',
        desc: "Structure technique optimisée et référencement local : vos futurs clients vous trouvent quand ils cherchent un coach près de chez eux.",
    },
    {
        icon: '📱',
        title: 'Un site parfait sur smartphone',
        desc: "La majorité de vos visiteurs arrivent depuis leur téléphone. Le site s'adapte au mobile, à la tablette et à l'ordinateur.",
    },
    {
        icon: '📸',
        title: 'Redirigez vers Instagram et vos réseaux',
        desc: "Vos liens sociaux sont intégrés au site : vos visiteurs vous suivent et restent en contact avec votre contenu au quotidien.",
    },
];

const included = [
    'Personnalisation du design',
    'Adaptation des couleurs à votre identité',
    'Intégration de votre logo',
    'Intégration de vos textes et photos',
    'Présentation de vos prestations',
    'Présentation de vos tarifs',
    'Témoignages clients',
    'Formulaire de contact',
    'Liens vers Instagram et vos réseaux sociaux',
    'Responsive mobile, tablette et desktop',
    'SEO technique',
    'Optimisation pour le référencement local',
    'Configuration et mise en ligne du site',
];

const steps = [
    {
        num: '01',
        icon: '📥',
        title: 'Vous m\'envoyez vos informations',
        desc: 'Logo, couleurs, photos, prestations, tarifs et textes.',
    },
    {
        num: '02',
        icon: '🎨',
        title: 'Je personnalise votre site',
        desc: "La démo est adaptée à votre identité et à votre activité.",
    },
    {
        num: '03',
        icon: '✅',
        title: 'Vous validez',
        desc: 'Nous effectuons les derniers ajustements ensemble.',
    },
    {
        num: '04',
        icon: '🚀',
        title: 'Votre site est en ligne',
        desc: "Le site est configuré sur votre nom de domaine et prêt à recevoir vos futurs clients.",
    },
];

const faqItems = ref(
    props.demo.faq.map((item) => ({ ...item, open: false })),
);

const toggleFaq = (index: number) => {
    faqItems.value[index].open = !faqItems.value[index].open;
};

const showScrollTop = ref(false);

let observer: IntersectionObserver | null = null;
let handleScroll: (() => void) | null = null;

const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
};

onMounted(() => {
    observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        },
        { threshold: 0.1, rootMargin: '0px 0px -50px 0px' },
    );

    document.querySelectorAll('.reveal').forEach((el) => {
        observer?.observe(el);
    });

    handleScroll = () => {
        showScrollTop.value = window.scrollY > 300;
    };

    window.addEventListener('scroll', handleScroll, { passive: true });
});

onUnmounted(() => {
    observer?.disconnect();

    if (handleScroll) {
        window.removeEventListener('scroll', handleScroll);
    }
});
</script>

<template>
    <SEO
        title="Création de site internet pour coach sportif | 590 €"
        description="Site internet professionnel pour coach sportif et personal trainer : présentez vos coachings, vos tarifs et vos témoignages, et transformez vos visiteurs en clients. Démo en ligne, à partir de 590 €."
        canonical="/site-coach-sportif"
        keywords="site internet coach sportif, création site coach sportif, site web coach sportif, site internet personal trainer, création site internet coach fitness"
    />

    <div class="min-h-screen bg-[#080c14] text-white">
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
                            <Link href="/#services" class="px-4 py-2 text-sm font-medium text-white/50 hover:text-white/80 transition-colors rounded-xl hover:bg-white/[0.05]">Services</Link>
                            <Link href="/#tarifs" class="px-4 py-2 text-sm font-medium text-white/50 hover:text-white/80 transition-colors rounded-xl hover:bg-white/[0.05]">Tarifs</Link>
                            <div class="mx-3 h-5 w-px bg-white/10"></div>
                            <DemosMenu active />
                            <Link href="/portfolio" class="px-4 py-2 text-sm font-medium text-white/50 hover:text-white/80 transition-colors rounded-xl hover:bg-white/[0.05]">Réalisations</Link>
                            <Link href="/blog" class="px-4 py-2 text-sm font-medium text-white/50 hover:text-white/80 transition-colors rounded-xl hover:bg-white/[0.05]">Blog</Link>
                            <Link href="/espace-client" class="px-4 py-2 text-sm font-medium text-white/50 hover:text-white/80 transition-colors rounded-xl border border-white/[0.10] hover:border-white/25">
                                Espace client
                            </Link>
                            <a href="#contact" class="ml-2 px-5 py-2 text-sm font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white transition-all duration-200 shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40">
                                Créer mon site
                            </a>
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
                            <Link href="/#services" class="block px-4 py-2.5 text-sm font-medium text-white/70 hover:text-white rounded-xl hover:bg-white/[0.06] transition-colors">Services</Link>
                            <Link href="/#tarifs" class="block px-4 py-2.5 text-sm font-medium text-white/70 hover:text-white rounded-xl hover:bg-white/[0.06] transition-colors">Tarifs</Link>
                            <DemosMenu variant="mobile" active @navigate="mobileMenuOpen = false" />
                            <Link href="/portfolio" class="block px-4 py-2.5 text-sm font-medium text-white/70 hover:text-white rounded-xl hover:bg-white/[0.06] transition-colors">Réalisations</Link>
                            <Link href="/blog" class="block px-4 py-2.5 text-sm font-medium text-white/70 hover:text-white rounded-xl hover:bg-white/[0.06] transition-colors">Blog</Link>
                            <Link href="/espace-client" class="block px-4 py-2.5 text-sm font-medium text-white/70 hover:text-white rounded-xl hover:bg-white/[0.06] transition-colors">Espace client</Link>
                            <a href="#contact" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-sm font-semibold text-indigo-400 rounded-xl hover:bg-white/[0.06] transition-colors">
                                Créer mon site
                            </a>
                        </div>
                    </transition>
                </div>
            </div>
        </header>

        <main role="main">
            <!-- HERO -->
            <section class="relative overflow-hidden px-6 pt-36 pb-20 sm:pt-40">
                <div class="absolute inset-0 pointer-events-none">
                    <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_60%_at_50%_-10%,rgba(99,102,241,0.15),transparent)]"></div>
                    <div class="hero-grid absolute inset-0 opacity-[0.03]"></div>
                </div>

                <div class="relative mx-auto max-w-4xl text-center space-y-6">
                    <span class="inline-block px-3 py-1 rounded-full border border-white/10 bg-white/[0.03] text-xs font-medium text-white/50 uppercase tracking-widest">
                        Site internet pour coach sportif
                    </span>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-tight text-white">
                        Un site professionnel pensé pour les
                        <span class="gradient-text">coachs sportifs</span>
                    </h1>

                    <p class="mx-auto max-w-2xl text-lg text-white/45 leading-relaxed">
                        Présentez vos coachings, développez votre visibilité et transformez vos visiteurs en nouveaux clients.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
                        <a
                            :href="demo.demoUrl"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex w-full sm:w-auto items-center justify-center gap-2 px-7 py-4 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm transition-all duration-200 shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40"
                        >
                            Voir la démo
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                        <a
                            href="#contact"
                            class="inline-flex w-full sm:w-auto items-center justify-center px-7 py-4 rounded-xl border border-white/10 bg-white/[0.04] text-white/80 font-semibold text-sm hover:bg-white/[0.08] hover:text-white transition-all duration-200"
                        >
                            Créer mon site
                        </a>
                    </div>

                    <div class="flex flex-col items-center gap-3 pt-6">
                        <div class="inline-flex items-baseline gap-2 px-5 py-3 rounded-2xl border border-indigo-500/20 bg-indigo-500/5">
                            <span class="text-sm text-white/40">À partir de</span>
                            <span class="text-3xl sm:text-4xl font-black text-white">{{ demo.price }} €</span>
                        </div>
                        <p class="max-w-xl text-sm text-white/35 leading-relaxed">
                            Il ne s'agit pas d'un template générique, votre site est personnalisé à votre image —
                            vos couleurs, votre logo, vos photos, vos prestations et vos tarifs.
                        </p>
                    </div>
                </div>
            </section>

            <!-- DÉMO -->
            <section id="demo" class="scroll-mt-28 px-6 py-24 border-t border-white/[0.04]">
                <div class="mx-auto max-w-6xl">
                    <div class="reveal mb-16 text-center space-y-4">
                        <span class="inline-block px-3 py-1 rounded-full border border-white/10 bg-white/[0.03] text-xs font-medium text-white/50 uppercase tracking-widest">Démonstration</span>
                        <h2 class="text-4xl sm:text-5xl font-black text-white">Découvrez le site <span class="gradient-text">en conditions réelles</span></h2>
                        <p class="mx-auto max-w-xl text-white/40">
                            Naviguez librement dans la démo en ligne : c'est exactement la base qui sera personnalisée avec votre identité.
                        </p>
                    </div>

                    <div class="reveal grid lg:grid-cols-[1.6fr_1fr] gap-8 items-end">
                        <!-- Aperçu desktop -->
                        <figure class="overflow-hidden rounded-2xl border border-white/[0.08] bg-white/[0.02] shadow-2xl shadow-black/40">
                            <div class="flex items-center gap-2 border-b border-white/[0.06] bg-white/[0.03] px-4 py-3">
                                <span class="h-2.5 w-2.5 rounded-full bg-white/15"></span>
                                <span class="h-2.5 w-2.5 rounded-full bg-white/15"></span>
                                <span class="h-2.5 w-2.5 rounded-full bg-white/15"></span>
                                <span class="ml-3 truncate rounded-md bg-white/[0.04] px-3 py-1 text-xs text-white/30">
                                    coach.web-discovery.fr
                                </span>
                            </div>
                            <img
                                v-if="demo.screenshots.desktop"
                                :src="demo.screenshots.desktop"
                                alt="Aperçu desktop du site de démonstration pour coach sportif"
                                class="w-full object-cover"
                                loading="lazy"
                            />
                            <div v-else class="flex aspect-[16/10] flex-col items-center justify-center gap-3 px-6 text-center">
                                <svg class="h-10 w-10 text-white/15" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <p class="text-sm font-medium text-white/40">Aperçu desktop à venir</p>
                                <p class="max-w-xs text-xs text-white/25">
                                    En attendant, la démo est entièrement consultable en ligne.
                                </p>
                            </div>
                            <figcaption class="sr-only">Aperçu du site de démonstration sur ordinateur</figcaption>
                        </figure>

                        <!-- Aperçu mobile -->
                        <figure class="mx-auto w-full max-w-[260px]">
                            <div class="overflow-hidden rounded-[2rem] border-[6px] border-white/[0.08] bg-white/[0.02] shadow-2xl shadow-black/40">
                                <div class="flex justify-center bg-white/[0.03] py-2">
                                    <span class="h-1.5 w-16 rounded-full bg-white/10"></span>
                                </div>
                                <img
                                    v-if="demo.screenshots.mobile"
                                    :src="demo.screenshots.mobile"
                                    alt="Aperçu mobile du site de démonstration pour coach sportif"
                                    class="w-full object-cover"
                                    loading="lazy"
                                />
                                <div v-else class="flex aspect-[9/16] flex-col items-center justify-center gap-3 px-5 text-center">
                                    <svg class="h-9 w-9 text-white/15" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-sm font-medium text-white/40">Aperçu mobile à venir</p>
                                </div>
                            </div>
                            <figcaption class="sr-only">Aperçu du site de démonstration sur smartphone</figcaption>
                        </figure>
                    </div>

                    <div class="reveal mt-12 text-center">
                        <a
                            :href="demo.demoUrl"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 px-7 py-4 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm transition-all duration-200 shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40"
                        >
                            Découvrir le site de démonstration
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                </div>
            </section>

            <!-- BÉNÉFICES -->
            <section id="benefices" class="scroll-mt-28 px-6 py-24 border-t border-white/[0.04]">
                <div class="mx-auto max-w-6xl">
                    <div class="reveal mb-16 text-center space-y-4">
                        <span class="inline-block px-3 py-1 rounded-full border border-white/10 bg-white/[0.03] text-xs font-medium text-white/50 uppercase tracking-widest">Bénéfices</span>
                        <h2 class="text-4xl sm:text-5xl font-black text-white">Ce que votre site change <span class="gradient-text">au quotidien</span></h2>
                        <p class="mx-auto max-w-xl text-white/40">
                            Pas une liste de fonctionnalités : ce que vous y gagnez concrètement dans votre activité de coach.
                        </p>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                        <article
                            v-for="benefit in benefits"
                            :key="benefit.title"
                            class="reveal rounded-2xl border border-white/[0.06] bg-white/[0.02] p-6 transition-all duration-300 hover:-translate-y-1 hover:border-indigo-500/30 hover:bg-white/[0.04]"
                        >
                            <span class="text-3xl" aria-hidden="true">{{ benefit.icon }}</span>
                            <h3 class="mt-4 mb-2 text-base font-bold leading-snug text-white">{{ benefit.title }}</h3>
                            <p class="text-sm leading-relaxed text-white/40">{{ benefit.desc }}</p>
                        </article>
                    </div>
                </div>
            </section>

            <!-- CE QUI EST INCLUS -->
            <section id="inclus" class="scroll-mt-28 px-6 py-24 border-t border-white/[0.04]">
                <div class="mx-auto max-w-5xl">
                    <div class="reveal mb-16 text-center space-y-4">
                        <span class="inline-block px-3 py-1 rounded-full border border-white/10 bg-white/[0.03] text-xs font-medium text-white/50 uppercase tracking-widest">Prestation</span>
                        <h2 class="text-4xl sm:text-5xl font-black text-white">Ce qui est <span class="gradient-text">inclus</span></h2>
                        <p class="mx-auto max-w-xl text-white/40">
                            Tout ce que comprennent les {{ demo.price }} €, sans supplément caché.
                        </p>
                    </div>

                    <ul class="reveal grid gap-3 sm:grid-cols-2">
                        <li
                            v-for="item in included"
                            :key="item"
                            class="flex items-center gap-3 rounded-2xl border border-white/[0.06] bg-white/[0.02] px-5 py-4 text-sm text-white/60"
                        >
                            <svg class="h-4 w-4 flex-shrink-0 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ item }}
                        </li>
                    </ul>
                </div>
            </section>

            <!-- FONCTIONNEMENT -->
            <section id="fonctionnement" class="scroll-mt-28 px-6 py-24 border-t border-white/[0.04]">
                <div class="mx-auto max-w-6xl">
                    <div class="reveal mb-16 text-center space-y-4">
                        <span class="inline-block px-3 py-1 rounded-full border border-white/10 bg-white/[0.03] text-xs font-medium text-white/50 uppercase tracking-widest">Déroulement</span>
                        <h2 class="text-4xl sm:text-5xl font-black text-white">Comment ça <span class="gradient-text">se passe</span></h2>
                        <p class="mx-auto max-w-xl text-white/40">Quatre étapes simples, de vos premiers éléments à la mise en ligne.</p>
                    </div>

                    <ol class="grid gap-5 md:grid-cols-2 lg:grid-cols-4">
                        <li
                            v-for="step in steps"
                            :key="step.num"
                            class="reveal relative rounded-2xl border border-white/[0.06] bg-white/[0.02] p-6 transition-all duration-300 hover:-translate-y-1 hover:border-indigo-500/30"
                        >
                            <span class="absolute right-5 top-5 text-3xl font-black text-white/[0.06]">{{ step.num }}</span>
                            <span class="text-3xl" aria-hidden="true">{{ step.icon }}</span>
                            <h3 class="mt-4 mb-2 text-base font-bold leading-snug text-white">{{ step.title }}</h3>
                            <p class="text-sm leading-relaxed text-white/40">{{ step.desc }}</p>
                        </li>
                    </ol>
                </div>
            </section>

            <!-- TARIF -->
            <section id="tarif" class="scroll-mt-28 px-6 py-24 border-t border-white/[0.04]">
                <div class="mx-auto max-w-3xl">
                    <div class="reveal mb-16 text-center space-y-4">
                        <span class="inline-block px-3 py-1 rounded-full border border-white/10 bg-white/[0.03] text-xs font-medium text-white/50 uppercase tracking-widest">Tarification</span>
                        <h2 class="text-4xl sm:text-5xl font-black text-white">Un tarif <span class="gradient-text">clair</span></h2>
                    </div>

                    <div class="reveal rounded-3xl border border-indigo-500/30 bg-gradient-to-br from-indigo-500/10 via-transparent to-transparent p-8 sm:p-10">
                        <div class="mb-8 text-center">
                            <div class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-400/70">Offre</div>
                            <h3 class="text-2xl font-bold text-white">{{ demo.name }}</h3>
                            <div class="mt-6 flex items-baseline justify-center gap-2">
                                <span class="text-6xl font-black text-white">{{ demo.price }} €</span>
                            </div>
                        </div>

                        <ul class="mb-8 grid gap-3 sm:grid-cols-2">
                            <li
                                v-for="item in included"
                                :key="item"
                                class="flex items-center gap-3 text-sm text-white/60"
                            >
                                <svg class="h-4 w-4 flex-shrink-0 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ item }}
                            </li>
                        </ul>

                        <a
                            href="#contact"
                            class="block w-full rounded-xl bg-indigo-600 px-6 py-4 text-center text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition-all duration-200 hover:bg-indigo-500 hover:shadow-indigo-500/40"
                        >
                            Je veux mon site
                        </a>

                        <p class="mt-6 text-center text-sm text-white/30">
                            Hébergement et maintenance disponibles en option.
                        </p>
                    </div>
                </div>
            </section>

            <!-- FAQ -->
            <section id="faq" class="scroll-mt-28 px-6 py-24 border-t border-white/[0.04]">
                <div class="mx-auto max-w-3xl">
                    <div class="reveal mb-16 text-center space-y-4">
                        <span class="inline-block px-3 py-1 rounded-full border border-white/10 bg-white/[0.03] text-xs font-medium text-white/50 uppercase tracking-widest">FAQ</span>
                        <h2 class="text-4xl sm:text-5xl font-black text-white">Questions <span class="gradient-text">fréquentes</span></h2>
                    </div>

                    <div class="space-y-3">
                        <div
                            v-for="(item, index) in faqItems"
                            :key="index"
                            class="reveal overflow-hidden rounded-2xl border border-white/[0.06] bg-white/[0.02]"
                        >
                            <h3>
                                <button
                                    type="button"
                                    :aria-expanded="item.open"
                                    :aria-controls="`faq-answer-${index}`"
                                    class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left transition-colors hover:bg-white/[0.02]"
                                    @click="toggleFaq(index)"
                                >
                                    <span class="text-sm font-semibold text-white sm:text-base">{{ item.question }}</span>
                                    <svg
                                        class="h-4 w-4 flex-shrink-0 text-white/40 transition-transform duration-200"
                                        :class="item.open ? 'rotate-180' : ''"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        aria-hidden="true"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </h3>
                            <transition
                                enter-active-class="transition duration-200 ease-out"
                                enter-from-class="opacity-0"
                                enter-to-class="opacity-100"
                            >
                                <div v-if="item.open" :id="`faq-answer-${index}`" class="px-6 pb-5">
                                    <p class="text-sm leading-relaxed text-white/45">{{ item.answer }}</p>
                                </div>
                            </transition>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA FINAL -->
            <section class="px-6 py-24 border-t border-white/[0.04]">
                <div class="mx-auto max-w-4xl">
                    <div class="reveal relative overflow-hidden rounded-3xl border border-indigo-500/20 bg-indigo-500/5 px-6 py-14 text-center sm:px-12">
                        <div class="absolute inset-0 pointer-events-none bg-[radial-gradient(ellipse_70%_60%_at_50%_0%,rgba(99,102,241,0.15),transparent)]"></div>
                        <div class="relative space-y-5">
                            <h2 class="text-3xl sm:text-4xl font-black leading-tight text-white">
                                Prêt à donner une image professionnelle à votre activité de coaching ?
                            </h2>
                            <p class="mx-auto max-w-xl text-white/45 leading-relaxed">
                                Votre site est personnalisé avec votre identité, vos photos et vos prestations.
                                Vous envoyez vos éléments, je m'occupe du reste.
                            </p>
                            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
                                <a
                                    href="#contact"
                                    class="inline-flex w-full sm:w-auto items-center justify-center px-7 py-4 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm transition-all duration-200 shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40"
                                >
                                    Créer mon site
                                </a>
                                <a
                                    :href="demo.demoUrl"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex w-full sm:w-auto items-center justify-center gap-2 px-7 py-4 rounded-xl border border-white/10 bg-white/[0.04] text-white/80 font-semibold text-sm hover:bg-white/[0.08] hover:text-white transition-all duration-200"
                                >
                                    Voir la démo
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CONTACT -->
            <section id="contact" class="scroll-mt-28 px-6 py-24 border-t border-white/[0.04]">
                <div class="mx-auto max-w-3xl">
                    <div class="reveal mb-12 text-center space-y-4">
                        <span class="inline-block px-3 py-1 rounded-full border border-white/10 bg-white/[0.03] text-xs font-medium text-white/50 uppercase tracking-widest">Contact</span>
                        <h2 class="text-4xl sm:text-5xl font-black text-white">Lancez votre <span class="gradient-text">site</span></h2>
                        <p class="mx-auto max-w-xl text-white/40">
                            Décrivez votre activité en quelques lignes : je reviens vers vous avec les prochaines étapes.
                        </p>
                    </div>

                    <div class="reveal rounded-3xl border border-white/[0.08] bg-white/[0.02] p-6 sm:p-8">
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

                            <div>
                                <label for="phone" class="block mb-1.5 text-xs font-semibold text-white/50 uppercase tracking-wide">Téléphone</label>
                                <input id="phone" v-model="form.phone" type="tel" placeholder="06 12 34 56 78"
                                    class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white placeholder-white/20 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all" />
                                <div v-if="form.errors.phone" class="mt-1.5 text-xs text-red-400">{{ form.errors.phone }}</div>
                            </div>

                            <div>
                                <label for="message" class="block mb-1.5 text-xs font-semibold text-white/50 uppercase tracking-wide">
                                    Message <span class="text-red-400 normal-case">*</span>
                                </label>
                                <textarea id="message" v-model="form.message" required rows="5" placeholder="Votre activité, vos formules de coaching, vos attentes..."
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
                                <span v-else>Créer mon site</span>
                            </button>
                        </form>
                    </div>
                </div>
            </section>
        </main>

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
                            Création de sites web vitrine et applications SaaS sur mesure à Pau et dans les Pyrénées-Atlantiques (64).
                        </p>
                    </div>

                    <div>
                        <h3 class="mb-4 text-xs font-semibold text-white/40 uppercase tracking-widest">Navigation</h3>
                        <ul class="space-y-2.5 text-sm">
                            <li><Link href="/" class="text-white/40 hover:text-white/80 transition-colors">Accueil</Link></li>
                            <li><Link href="/portfolio" class="text-white/40 hover:text-white/80 transition-colors">Réalisations</Link></li>
                            <li><Link href="/blog" class="text-white/40 hover:text-white/80 transition-colors">Blog</Link></li>
                            <li><Link href="/site-coach-sportif" class="text-white/40 hover:text-white/80 transition-colors">Site coach sportif</Link></li>
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

        <GdprBanner />

        <!-- Barre d'action fixe mobile -->
        <div class="h-20 md:hidden"></div>
        <div class="fixed inset-x-0 bottom-0 z-50 border-t border-white/[0.06] bg-slate-950/95 p-3 backdrop-blur-xl md:hidden">
            <a href="#contact" class="block w-full rounded-xl bg-indigo-600 px-6 py-3 text-center font-semibold text-white shadow-lg shadow-indigo-500/20">
                Créer mon site
            </a>
        </div>

        <transition
            enter-active-class="transition ease-out duration-300"
            enter-from-class="opacity-0 scale-75 translate-y-4"
            enter-to-class="opacity-100 scale-100 translate-y-0"
            leave-active-class="transition ease-in duration-200"
            leave-from-class="opacity-100 scale-100 translate-y-0"
            leave-to-class="opacity-0 scale-75 translate-y-4"
        >
            <button v-if="showScrollTop" @click="scrollToTop" type="button"
                class="fixed right-6 bottom-24 md:bottom-6 z-40 h-11 w-11 rounded-xl border border-white/10 bg-white/[0.06] backdrop-blur-xl text-white/70 hover:text-white hover:bg-white/[0.10] hover:border-white/20 transition-all duration-200 flex items-center justify-center shadow-xl"
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

.hero-grid {
    background-image:
        linear-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
    background-size: 60px 60px;
}

.reveal {
    opacity: 0;
    transform: translateY(24px);
    transition:
        opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1),
        transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
}

.reveal.is-visible {
    opacity: 1;
    transform: translateY(0);
}
</style>
