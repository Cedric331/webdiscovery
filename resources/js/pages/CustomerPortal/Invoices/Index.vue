<script setup lang="ts">
import CustomerPortalLayout from '@/layouts/CustomerPortalLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { Download, FileText } from 'lucide-vue-next';

interface Invoice {
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
    invoices: Invoice[];
}>();

const page = usePage<{ customer: { name: string; company?: string; email: string } }>();

const statusClass: Record<string, string> = {
    en_attente: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
    payee: 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
    en_retard: 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
};

function formatAmount(amount: number | null): string {
    if (amount === null) return '—';
    return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(amount);
}
</script>

<template>
    <Head title="Factures — Espace Client" />

    <CustomerPortalLayout :customer="page.props.customer">
        <div class="space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Factures</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ invoices.length }} facture{{ invoices.length > 1 ? 's' : '' }}
                </p>
            </div>

            <!-- Empty state -->
            <div
                v-if="invoices.length === 0"
                class="flex flex-col items-center justify-center rounded-xl border border-dashed border-gray-300 bg-white py-16 dark:border-gray-700 dark:bg-gray-900"
            >
                <FileText class="size-12 text-gray-300 dark:text-gray-600" />
                <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">Aucune facture disponible.</p>
            </div>

            <!-- List -->
            <div v-else class="space-y-3">
                <div
                    v-for="invoice in invoices"
                    :key="invoice.id"
                    class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900"
                >
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div class="space-y-1">
                            <div class="flex items-center gap-3 flex-wrap">
                                <h3 class="font-medium text-gray-900 dark:text-white">{{ invoice.title }}</h3>
                                <span
                                    :class="['inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium', statusClass[invoice.status] ?? 'bg-gray-100 text-gray-600']"
                                >
                                    {{ invoice.status_label }}
                                </span>
                            </div>
                            <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-gray-500 dark:text-gray-400">
                                <span v-if="invoice.number">N° {{ invoice.number }}</span>
                                <span>{{ invoice.date }}</span>
                                <span class="font-medium text-gray-900 dark:text-white">{{ formatAmount(invoice.amount) }}</span>
                            </div>
                            <p v-if="invoice.description" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                {{ invoice.description }}
                            </p>
                        </div>
                        <a
                            v-if="invoice.pdf_url"
                            :href="invoice.pdf_url"
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
