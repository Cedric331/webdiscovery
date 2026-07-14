<script setup lang="ts">
import CustomerPortalLayout from '@/layouts/CustomerPortalLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { Download, Shield } from 'lucide-vue-next';

interface MaintenanceContract {
    id: number;
    title: string;
    description: string | null;
    monthly_price: number | null;
    annual_price: number | null;
    start_date: string;
    end_date: string | null;
    status: string;
    status_label: string;
    pdf_url: string;
}

defineProps<{
    contracts: MaintenanceContract[];
}>();

const page = usePage<{ customer: { name: string; company?: string; email: string } }>();

const statusClass: Record<string, string> = {
    actif: 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
    expire: 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
    suspendu: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
};

function formatPrice(price: number | null): string {
    if (price === null) return '—';
    return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(price);
}
</script>

<template>
    <Head title="Contrat de maintenance — Espace Client" />

    <CustomerPortalLayout :customer="page.props.customer">
        <div class="space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Contrat de maintenance</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Vos prestations de maintenance et tarifs appliqués
                </p>
            </div>

            <div
                v-if="contracts.length === 0"
                class="flex flex-col items-center justify-center rounded-xl border border-dashed border-gray-300 bg-white py-16 dark:border-gray-700 dark:bg-gray-900"
            >
                <Shield class="size-12 text-gray-300 dark:text-gray-600" />
                <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">Aucun contrat de maintenance en cours.</p>
            </div>

            <div v-else class="space-y-4">
                <div
                    v-for="contract in contracts"
                    :key="contract.id"
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900"
                >
                    <!-- Header -->
                    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-gray-100 px-6 py-4 dark:border-gray-800">
                        <div class="flex items-center gap-3">
                            <div class="flex size-10 items-center justify-center rounded-lg bg-green-50 dark:bg-green-900/20">
                                <Shield class="size-5 text-green-600 dark:text-green-400" />
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-white">{{ contract.title }}</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Du {{ contract.start_date }}{{ contract.end_date ? ' au ' + contract.end_date : '' }}
                                </p>
                            </div>
                        </div>
                        <span
                            :class="['inline-flex rounded-full px-3 py-1 text-sm font-medium', statusClass[contract.status] ?? 'bg-gray-100 text-gray-600']"
                        >
                            {{ contract.status_label }}
                        </span>
                    </div>

                    <!-- Body -->
                    <div class="px-6 py-5 space-y-5">
                        <p v-if="contract.description" class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                            {{ contract.description }}
                        </p>

                        <!-- Pricing -->
                        <div v-if="contract.monthly_price !== null || contract.annual_price !== null" class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                            <div v-if="contract.monthly_price !== null" class="rounded-lg bg-gray-50 px-4 py-3 dark:bg-gray-800">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Tarif mensuel</p>
                                <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ formatPrice(contract.monthly_price) }}
                                    <span class="text-sm font-normal text-gray-500">/mois</span>
                                </p>
                            </div>
                            <div v-if="contract.annual_price !== null" class="rounded-lg bg-gray-50 px-4 py-3 dark:bg-gray-800">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Tarif annuel</p>
                                <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ formatPrice(contract.annual_price) }}
                                    <span class="text-sm font-normal text-gray-500">/an</span>
                                </p>
                            </div>
                        </div>

                        <!-- PDF -->
                        <div v-if="contract.pdf_url" class="flex justify-end">
                            <a
                                :href="contract.pdf_url"
                                class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                            >
                                <Download class="size-4" />
                                Télécharger le contrat PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </CustomerPortalLayout>
</template>
