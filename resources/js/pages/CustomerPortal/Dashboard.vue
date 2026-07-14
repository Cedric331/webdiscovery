<script setup lang="ts">
import CustomerPortalLayout from '@/layouts/CustomerPortalLayout.vue';
import { Head } from '@inertiajs/vue3';
import { FileText, FilePlus, Shield, Wrench } from 'lucide-vue-next';

const props = defineProps<{
    customer: {
        name: string;
        company?: string;
        email: string;
    };
    stats: {
        invoices: number;
        quotes: number;
        interventions: number;
        activeContract: boolean;
    };
    recentInvoices: Array<{
        id: number;
        title: string;
        number: string | null;
        date: string;
        amount: number | null;
        status: string;
    }>;
    recentInterventions: Array<{
        id: number;
        title: string;
        date: string;
        description: string | null;
    }>;
}>();

const statCards = [
    {
        label: 'Factures',
        value: props.stats.invoices,
        icon: FileText,
        href: '/espace-client/factures',
        color: 'text-blue-600 bg-blue-50 dark:bg-blue-900/20',
    },
    {
        label: 'Devis',
        value: props.stats.quotes,
        icon: FilePlus,
        href: '/espace-client/devis',
        color: 'text-amber-600 bg-amber-50 dark:bg-amber-900/20',
    },
    {
        label: 'Interventions',
        value: props.stats.interventions,
        icon: Wrench,
        href: '/espace-client/interventions',
        color: 'text-purple-600 bg-purple-50 dark:bg-purple-900/20',
    },
    {
        label: 'Contrat maintenance',
        value: props.stats.activeContract ? 'Actif' : 'Aucun',
        icon: Shield,
        href: '/espace-client/contrat-maintenance',
        color: props.stats.activeContract
            ? 'text-green-600 bg-green-50 dark:bg-green-900/20'
            : 'text-gray-400 bg-gray-50 dark:bg-gray-800',
    },
];

const invoiceStatusConfig: Record<string, { label: string; class: string }> = {
    en_attente: { label: 'En attente', class: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' },
    payee: { label: 'Payée', class: 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' },
    en_retard: { label: 'En retard', class: 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' },
};

function formatAmount(amount: number | null): string {
    if (amount === null) return '—';
    return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(amount);
}
</script>

<template>
    <Head title="Tableau de bord — Espace Client" />

    <CustomerPortalLayout :customer="customer">
        <div class="space-y-8">
            <!-- Header -->
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Bonjour{{ customer.name ? ', ' + customer.name : '' }} 👋
                </h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Bienvenue dans votre espace client
                    <span v-if="customer.company">— {{ customer.company }}</span>
                </p>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <a
                    v-for="card in statCards"
                    :key="card.label"
                    :href="card.href"
                    class="group flex items-center gap-4 rounded-xl border border-gray-200 bg-white p-5 transition hover:border-gray-300 hover:shadow-sm dark:border-gray-800 dark:bg-gray-900 dark:hover:border-gray-700"
                >
                    <div :class="['flex size-10 items-center justify-center rounded-lg', card.color]">
                        <component :is="card.icon" class="size-5" />
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ card.value }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ card.label }}</p>
                    </div>
                </a>
            </div>

            <!-- Recent invoices -->
            <div v-if="recentInvoices.length > 0">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Dernières factures</h2>
                    <a href="/espace-client/factures" class="text-sm text-blue-600 hover:underline dark:text-blue-400">
                        Voir tout →
                    </a>
                </div>
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-800/50">
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Facture</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Date</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Montant</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            <tr v-for="invoice in recentInvoices" :key="invoice.id">
                                <td class="px-4 py-3">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ invoice.title }}</p>
                                    <p v-if="invoice.number" class="text-xs text-gray-500 dark:text-gray-400">N° {{ invoice.number }}</p>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">{{ invoice.date }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900 dark:text-white">{{ formatAmount(invoice.amount) }}</td>
                                <td class="px-4 py-3">
                                    <span
                                        v-if="invoiceStatusConfig[invoice.status]"
                                        :class="['inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium', invoiceStatusConfig[invoice.status].class]"
                                    >
                                        {{ invoiceStatusConfig[invoice.status].label }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent interventions -->
            <div v-if="recentInterventions.length > 0">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Dernières interventions</h2>
                    <a href="/espace-client/interventions" class="text-sm text-blue-600 hover:underline dark:text-blue-400">
                        Voir tout →
                    </a>
                </div>
                <div class="space-y-3">
                    <div
                        v-for="intervention in recentInterventions"
                        :key="intervention.id"
                        class="rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900"
                    >
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">{{ intervention.title }}</p>
                                <p v-if="intervention.description" class="mt-1 text-sm text-gray-500 dark:text-gray-400 line-clamp-2">
                                    {{ intervention.description }}
                                </p>
                            </div>
                            <span class="shrink-0 text-sm text-gray-500 dark:text-gray-400">{{ intervention.date }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty state -->
            <div
                v-if="stats.invoices === 0 && stats.interventions === 0"
                class="flex flex-col items-center justify-center rounded-xl border border-dashed border-gray-300 bg-white py-16 dark:border-gray-700 dark:bg-gray-900"
            >
                <FileText class="size-12 text-gray-300 dark:text-gray-600" />
                <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">Aucun document disponible pour le moment.</p>
            </div>
        </div>
    </CustomerPortalLayout>
</template>
