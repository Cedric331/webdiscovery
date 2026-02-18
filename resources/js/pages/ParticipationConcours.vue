<script setup lang="ts">
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();

const form = useForm({
    email: '',
    company_name: '',
    accept_reglement: false,
});

const flash = computed(() => page.props.flash as { success?: string; error?: string } | undefined);

const submit = () => {
    form.post('/participation-concours', {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <Head>
        <title>Participer au jeu concours - Web Discovery</title>
        <meta
            name="description"
            content="Participez au jeu concours Web Discovery et gagnez un site vitrine one-page."
        />
        <meta name="robots" content="noindex, follow" />
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
                        loading="lazy"
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
                        href="/portfolio"
                        class="rounded-lg px-3 py-2 text-sm font-medium text-slate-300 transition-colors hover:bg-slate-800 hover:text-white"
                    >
                        Réalisations
                    </Link>
                    <Link
                        href="/blog"
                        class="rounded-lg px-3 py-2 text-sm font-medium text-slate-300 transition-colors hover:bg-slate-800 hover:text-white"
                    >
                        Blog
                    </Link>
                </div>
            </nav>
        </header>

        <main class="px-6 pt-32 pb-20" role="main">
            <div class="container mx-auto max-w-3xl">
                <div
                    class="rounded-3xl border border-slate-800 bg-slate-900/50 p-8 shadow-2xl backdrop-blur-xl md:p-12"
                >
                    <div class="mb-8 text-center">
                        <h1
                            class="mb-3 bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-4xl font-black text-transparent md:text-5xl"
                        >
                            Participez au jeu concours
                        </h1>
                        <p class="text-lg text-slate-300">
                            Gagnez votre site vitrine one-page d'une valeur de 500 €
                        </p>
                    </div>

                    <div
                        class="mb-8 rounded-2xl border border-blue-500/30 bg-blue-500/10 p-6"
                    >
                        <h2 class="mb-4 text-xl font-bold text-white">
                            🎁 Le lot à gagner
                        </h2>
                        <ul class="space-y-2 text-slate-300">
                            <li class="flex items-start gap-2">
                                <span class="text-blue-400">✓</span>
                                <span>Site vitrine one-page professionnel</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-blue-400">✓</span>
                                <span>Présentation de l'entreprise et des services</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-blue-400">✓</span>
                                <span>Formulaire de contact</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-blue-400">✓</span>
                                <span>Design moderne et responsive</span>
                            </li>
                        </ul>
                        <p class="mt-4 text-sm text-slate-400">
                            Valeur estimée : <strong class="text-white">500 €</strong>
                        </p>
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label
                                for="email"
                                class="mb-2 block text-sm font-semibold text-white"
                            >
                                Email <span class="text-red-400">*</span>
                            </label>
                            <input
                                id="email"
                                v-model="form.email"
                                type="email"
                                required
                                class="w-full rounded-lg border border-slate-800 bg-slate-900/50 px-4 py-3 text-white placeholder-slate-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                placeholder="votre@email.com"
                            />
                            <p
                                v-if="form.errors.email"
                                class="mt-1 text-sm text-red-400"
                            >
                                {{ form.errors.email }}
                            </p>
                        </div>

                        <div>
                            <label
                                for="company_name"
                                class="mb-2 block text-sm font-semibold text-white"
                            >
                                Nom de la société (optionnel)
                            </label>
                            <input
                                id="company_name"
                                v-model="form.company_name"
                                type="text"
                                class="w-full rounded-lg border border-slate-800 bg-slate-900/50 px-4 py-3 text-white placeholder-slate-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                placeholder="Ma Société"
                            />
                            <p
                                v-if="form.errors.company_name"
                                class="mt-1 text-sm text-red-400"
                            >
                                {{ form.errors.company_name }}
                            </p>
                        </div>

                        <div class="rounded-lg border border-slate-800 bg-slate-900/30 p-4">
                            <label class="flex items-start gap-3 cursor-pointer">
                                <input
                                    v-model="form.accept_reglement"
                                    type="checkbox"
                                    required
                                    class="mt-1 h-5 w-5 rounded border-slate-600 bg-slate-700 text-blue-500 focus:ring-2 focus:ring-blue-500/20"
                                />
                                <span class="text-sm text-slate-300">
                                    J'accepte le
                                    <Link
                                        href="/concours"
                                        target="_blank"
                                        class="text-blue-400 underline hover:text-blue-300"
                                    >
                                        règlement du jeu concours
                                    </Link>
                                    <span class="text-red-400"> *</span>
                                </span>
                            </label>
                            <p
                                v-if="form.errors.accept_reglement"
                                class="mt-2 text-sm text-red-400"
                            >
                                {{ form.errors.accept_reglement }}
                            </p>
                        </div>

                        <div
                            v-if="flash?.success"
                            class="rounded-lg border border-green-500/30 bg-green-500/10 p-4 text-green-400"
                        >
                            {{ flash.success }}
                        </div>

                        <div
                            v-if="flash?.error"
                            class="rounded-lg border border-red-500/30 bg-red-500/10 p-4 text-red-400"
                        >
                            {{ flash.error }}
                        </div>

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4 font-semibold text-white shadow-lg shadow-blue-500/30 transition-all hover:from-blue-600 hover:to-blue-700 hover:shadow-xl hover:shadow-blue-500/40 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <span v-if="form.processing">Envoi en cours...</span>
                            <span v-else>Participer au concours</span>
                        </button>
                    </form>

                    <div class="mt-8 border-t border-slate-700/50 pt-6 text-center">
                        <Link
                            href="/concours"
                            class="text-sm text-blue-400 underline hover:text-blue-300"
                        >
                            Consulter le règlement complet
                        </Link>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

