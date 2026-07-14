<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import {
    FileText,
    FilePlus,
    LayoutDashboard,
    LogOut,
    Shield,
    Wrench,
} from 'lucide-vue-next';
import { ref } from 'vue';

const props = defineProps<{
    customer: {
        name: string;
        company?: string;
        email: string;
    };
}>();

const mobileMenuOpen = ref(false);

const navigation = [
    { name: 'Tableau de bord', href: '/espace-client/tableau-de-bord', icon: LayoutDashboard },
    { name: 'Factures', href: '/espace-client/factures', icon: FileText },
    { name: 'Devis', href: '/espace-client/devis', icon: FilePlus },
    { name: 'Interventions', href: '/espace-client/interventions', icon: Wrench },
    { name: 'Contrat de maintenance', href: '/espace-client/contrat-maintenance', icon: Shield },
];

function isActive(href: string): boolean {
    return window.location.pathname === href;
}

function logout() {
    router.post('/espace-client/deconnexion');
}
</script>

<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-950">
        <!-- Sidebar desktop -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col">
            <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6 pb-4 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex h-16 shrink-0 items-center">
                    <span class="text-lg font-semibold text-gray-900 dark:text-white">
                        Espace Client
                    </span>
                </div>

                <nav class="flex flex-1 flex-col">
                    <ul class="flex flex-1 flex-col gap-y-1">
                        <li v-for="item in navigation" :key="item.name">
                            <a
                                :href="item.href"
                                :class="[
                                    isActive(item.href)
                                        ? 'bg-gray-100 text-gray-900 dark:bg-gray-800 dark:text-white'
                                        : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white',
                                    'group flex gap-x-3 rounded-md p-2 text-sm font-medium',
                                ]"
                            >
                                <component
                                    :is="item.icon"
                                    :class="[
                                        isActive(item.href)
                                            ? 'text-gray-900 dark:text-white'
                                            : 'text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white',
                                        'size-5 shrink-0',
                                    ]"
                                />
                                {{ item.name }}
                            </a>
                        </li>
                    </ul>

                    <div class="mt-auto border-t border-gray-200 pt-4 dark:border-gray-800">
                        <div class="flex items-center gap-x-3 px-2 py-2">
                            <div class="flex size-8 shrink-0 items-center justify-center rounded-full bg-gray-200 dark:bg-gray-700">
                                <span class="text-xs font-medium text-gray-600 dark:text-gray-300">
                                    {{ customer.name.charAt(0).toUpperCase() }}
                                </span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-medium text-gray-900 dark:text-white">
                                    {{ customer.name }}
                                </p>
                                <p v-if="customer.company" class="truncate text-xs text-gray-500 dark:text-gray-400">
                                    {{ customer.company }}
                                </p>
                            </div>
                        </div>
                        <button
                            @click="logout"
                            class="group mt-1 flex w-full items-center gap-x-3 rounded-md p-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white"
                        >
                            <LogOut class="size-5 shrink-0 text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" />
                            Se déconnecter
                        </button>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Mobile header -->
        <div class="sticky top-0 z-40 flex items-center gap-x-6 border-b border-gray-200 bg-white px-4 py-4 shadow-sm dark:border-gray-800 dark:bg-gray-900 lg:hidden">
            <button
                type="button"
                class="-m-2.5 p-2.5 text-gray-700 dark:text-gray-200"
                @click="mobileMenuOpen = !mobileMenuOpen"
            >
                <span class="sr-only">Ouvrir le menu</span>
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path v-if="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    <path v-else stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <span class="flex-1 text-sm font-semibold text-gray-900 dark:text-white">Espace Client</span>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ customer.name }}</span>
        </div>

        <!-- Mobile menu -->
        <div v-if="mobileMenuOpen" class="fixed inset-0 z-50 lg:hidden">
            <div class="fixed inset-0 bg-gray-900/80" @click="mobileMenuOpen = false" />
            <div class="fixed inset-y-0 left-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 dark:bg-gray-900 sm:max-w-sm">
                <div class="flex items-center justify-between">
                    <span class="text-lg font-semibold text-gray-900 dark:text-white">Espace Client</span>
                    <button @click="mobileMenuOpen = false" class="-m-2.5 rounded-md p-2.5 text-gray-700 dark:text-gray-200">
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <nav class="mt-6">
                    <ul class="flex flex-col gap-y-1">
                        <li v-for="item in navigation" :key="item.name">
                            <a
                                :href="item.href"
                                :class="[
                                    isActive(item.href)
                                        ? 'bg-gray-100 text-gray-900 dark:bg-gray-800 dark:text-white'
                                        : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400',
                                    'group flex gap-x-3 rounded-md p-2 text-sm font-medium',
                                ]"
                                @click="mobileMenuOpen = false"
                            >
                                <component :is="item.icon" class="size-5 shrink-0 text-gray-400" />
                                {{ item.name }}
                            </a>
                        </li>
                    </ul>
                    <div class="mt-6 border-t border-gray-200 pt-4 dark:border-gray-800">
                        <button
                            @click="logout"
                            class="flex w-full items-center gap-x-3 rounded-md p-2 text-sm font-medium text-gray-600 hover:bg-gray-50"
                        >
                            <LogOut class="size-5 text-gray-400" />
                            Se déconnecter
                        </button>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Content -->
        <div class="lg:pl-64">
            <main class="py-8">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
