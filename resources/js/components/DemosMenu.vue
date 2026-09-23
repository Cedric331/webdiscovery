<script setup lang="ts">
import { demoLinks } from '@/data/demos';
import { Link } from '@inertiajs/vue3';
import { onClickOutside } from '@vueuse/core';
import { ref } from 'vue';

/**
 * Entrée « Démos » du menu principal, avec sous-menu.
 *
 * `variant="desktop"` : bouton + dropdown flottant.
 * `variant="mobile"`  : bouton + liste dépliable dans le menu responsive.
 *
 * Les démos proviennent de resources/js/data/demos.ts : aucune modification
 * de ce composant n'est nécessaire pour en ajouter une.
 */
withDefaults(
    defineProps<{
        variant?: 'desktop' | 'mobile';
        /** Met l'entrée en surbrillance quand on est sur une page démo */
        active?: boolean;
    }>(),
    {
        variant: 'desktop',
        active: false,
    },
);

const emit = defineEmits<{ navigate: [] }>();

const open = ref(false);
const root = ref<HTMLElement | null>(null);

onClickOutside(root, () => {
    open.value = false;
});

const onNavigate = () => {
    open.value = false;
    emit('navigate');
};
</script>

<template>
    <!-- Desktop : dropdown -->
    <div
        v-if="variant === 'desktop'"
        ref="root"
        class="relative"
        @keydown.escape="open = false"
    >
        <button
            type="button"
            aria-haspopup="true"
            :aria-expanded="open"
            aria-controls="demos-submenu"
            :class="[
                'relative flex items-center gap-1.5 rounded-xl px-4 py-2 text-sm font-medium transition-colors',
                active || open
                    ? 'text-white'
                    : 'text-white/50 hover:bg-white/[0.05] hover:text-white/80',
            ]"
            @click="open = !open"
        >
            <span v-if="active" class="absolute inset-0 rounded-xl bg-white/[0.08]"></span>
            <span class="relative">Démos</span>
            <svg
                class="relative h-3.5 w-3.5 transition-transform duration-200"
                :class="open ? 'rotate-180' : ''"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                aria-hidden="true"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <transition
            enter-active-class="transition duration-150 ease-out"
            enter-from-class="opacity-0 -translate-y-1"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition duration-100 ease-in"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 -translate-y-1"
        >
            <div
                v-if="open"
                id="demos-submenu"
                class="absolute right-0 top-full z-50 mt-3 w-72 rounded-2xl border border-white/[0.08] bg-[#0b111c]/95 p-2 shadow-xl shadow-black/40 backdrop-blur-2xl"
            >
                <Link
                    v-for="demo in demoLinks"
                    :key="demo.href"
                    :href="demo.href"
                    class="group flex items-start gap-3 rounded-xl px-3 py-2.5 transition-colors hover:bg-white/[0.06]"
                    @click="onNavigate"
                >
                    <span class="text-lg leading-none" aria-hidden="true">{{ demo.icon }}</span>
                    <span class="min-w-0">
                        <span class="block text-sm font-medium text-white/80 transition-colors group-hover:text-white">
                            {{ demo.label }}
                        </span>
                        <span class="block text-xs leading-relaxed text-white/35">
                            {{ demo.description }}
                        </span>
                    </span>
                </Link>
            </div>
        </transition>
    </div>

    <!-- Mobile : liste dépliable -->
    <div v-else>
        <button
            type="button"
            aria-haspopup="true"
            :aria-expanded="open"
            aria-controls="demos-submenu-mobile"
            class="flex w-full items-center justify-between rounded-xl px-4 py-2.5 text-left text-sm font-medium transition-colors hover:bg-white/[0.06] hover:text-white"
            :class="active ? 'text-white' : 'text-white/70'"
            @click="open = !open"
        >
            Démos
            <svg
                class="h-4 w-4 transition-transform duration-200"
                :class="open ? 'rotate-180' : ''"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                aria-hidden="true"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <transition
            enter-active-class="transition duration-150 ease-out"
            enter-from-class="opacity-0 -translate-y-1"
            enter-to-class="opacity-100 translate-y-0"
        >
            <div v-if="open" id="demos-submenu-mobile" class="mt-1 space-y-1 pl-3">
                <Link
                    v-for="demo in demoLinks"
                    :key="demo.href"
                    :href="demo.href"
                    class="flex items-center gap-2.5 rounded-xl px-4 py-2.5 text-sm font-medium text-white/60 transition-colors hover:bg-white/[0.06] hover:text-white"
                    @click="onNavigate"
                >
                    <span class="text-base leading-none" aria-hidden="true">{{ demo.icon }}</span>
                    {{ demo.label }}
                </Link>
            </div>
        </transition>
    </div>
</template>
