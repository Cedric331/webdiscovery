<script setup lang="ts">
import CustomerPortalLayout from '@/layouts/CustomerPortalLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { Download, FilePlus } from 'lucide-vue-next';

interface Quote {
    id: number;
    title: string;
    number: string | null;
    date: string;
    amount: number | null;
    status: string;
    status_label: string;
    description: string | null;
    pdf_url: string;
}

defineProps<{
    quotes: Quote[];
}>();

const page = usePage<{ customer: { name: string; company?: string; email: string } }>();

const statusClass: Record<string, string> = {
    en_attente: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
    accepte: 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
    refuse: 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
    expire: 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400',
};

function formatAmount(amount: number | null): string {
    if (amount === null) return '—';
    return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(amount);
}
</script>

<template>
    <Head title="Devis — Espace Client" />

    <CustomerPortalLayout :customer="page.props.customer">
        <div class="space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Devis</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ quotes.length }} devis
                </p>
            </div>

            <div
                v-if="quotes.length === 0"
                class="flex flex-col items-center justify-center rounded-xl border border-dashed border-gray-300 bg-white py-16 dark:border-gray-700 dark:bg-gray-900"
            >
                <FilePlus class="size-12 text-gray-300 dark:text-gray-600" />
                <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">Aucun devis disponible.</p>
            </div>

            <div v-else class="space-y-3">
                <div
                    v-for="quote in quotes"
                    :key="quote.id"
                    class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900"
                >
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div class="space-y-1">
                            <div class="flex items-center gap-3 flex-wrap">
                                <h3 class="font-medium text-gray-900 dark:text-white">{{ quote.title }}</h3>
                                <span
                                    :class="['inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium', statusClass[quote.status] ?? 'bg-gray-100 text-gray-600']"
                                >
                                    {{ quote.status_label }}
                                </span>
                            </div>
                            <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-gray-500 dark:text-gray-400">
                                <span v-if="quote.number">N° {{ quote.number }}</span>
                                <span>{{ quote.date }}</span>
                                <span class="font-medium text-gray-900 dark:text-white">{{ formatAmount(quote.amount) }}</span>
                            </div>
                            <p v-if="quote.description" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                {{ quote.description }}
                            </p>
                        </div>
                        <a
                            v-if="quote.pdf_url"
                            :href="quote.pdf_url"
                            class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                        >
                            <Download class="size-4" />
                            Télécharger
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </CustomerPortalLayout>
</template>
