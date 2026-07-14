<script setup lang="ts">
import CustomerPortalLayout from '@/layouts/CustomerPortalLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { Download, Wrench } from 'lucide-vue-next';

interface Intervention {
    id: number;
    title: string;
    date: string;
    description: string | null;
    technician: string | null;
    pdf_url: string;
}

defineProps<{
    interventions: Intervention[];
}>();

const page = usePage<{ customer: { name: string; company?: string; email: string } }>();
</script>

<template>
    <Head title="Interventions — Espace Client" />

    <CustomerPortalLayout :customer="page.props.customer">
        <div class="space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Interventions</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ interventions.length }} intervention{{ interventions.length > 1 ? 's' : '' }}
                </p>
            </div>

            <div
                v-if="interventions.length === 0"
                class="flex flex-col items-center justify-center rounded-xl border border-dashed border-gray-300 bg-white py-16 dark:border-gray-700 dark:bg-gray-900"
            >
                <Wrench class="size-12 text-gray-300 dark:text-gray-600" />
                <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">Aucune intervention enregistrée.</p>
            </div>

            <div v-else class="space-y-3">
                <div
                    v-for="intervention in interventions"
                    :key="intervention.id"
                    class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900"
                >
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div class="space-y-2 flex-1">
                            <div class="flex items-center gap-3 flex-wrap">
                                <h3 class="font-medium text-gray-900 dark:text-white">{{ intervention.title }}</h3>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ intervention.date }}</span>
                            </div>
                            <p v-if="intervention.description" class="text-sm text-gray-600 dark:text-gray-400">
                                {{ intervention.description }}
                            </p>
                            <p v-if="intervention.technician" class="text-xs text-gray-400 dark:text-gray-500">
                                Technicien : {{ intervention.technician }}
                            </p>
                        </div>
                        <a
                            v-if="intervention.pdf_url"
                            :href="intervention.pdf_url"
                            class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                        >
                            <Download class="size-4" />
                            Rapport PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </CustomerPortalLayout>
</template>
