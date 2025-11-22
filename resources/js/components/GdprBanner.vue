<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const showBanner = ref(false);
const accepted = ref(false);

onMounted(() => {
    // Vérifier si le consentement a déjà été donné
    const consent = localStorage.getItem('gdpr-consent');
    if (!consent) {
        showBanner.value = true;
    } else {
        accepted.value = consent === 'accepted';
    }
});

const acceptCookies = () => {
    localStorage.setItem('gdpr-consent', 'accepted');
    localStorage.setItem('gdpr-consent-date', new Date().toISOString());
    showBanner.value = false;
    accepted.value = true;
};

const rejectCookies = () => {
    localStorage.setItem('gdpr-consent', 'rejected');
    localStorage.setItem('gdpr-consent-date', new Date().toISOString());
    showBanner.value = false;
    accepted.value = false;
};
</script>

<template>
    <transition
        enter-active-class="transition ease-out duration-300"
        enter-from-class="opacity-0 transform translate-y-full"
        enter-to-class="opacity-100 transform translate-y-0"
        leave-active-class="transition ease-in duration-300"
        leave-from-class="opacity-100 transform translate-y-0"
        leave-to-class="opacity-0 transform translate-y-full"
    >
        <div
            v-if="showBanner"
            class="fixed right-0 bottom-0 left-0 z-50 border-t border-slate-700/50 bg-slate-900/95 shadow-2xl backdrop-blur-xl"
        >
            <div class="container mx-auto px-6 py-6">
                <div
                    class="flex flex-col items-center justify-between gap-4 md:flex-row"
                >
                    <div class="flex-1">
                        <p class="text-sm text-slate-300 md:text-base">
                            Ce site utilise des cookies pour améliorer votre
                            expérience. En continuant à naviguer, vous acceptez
                            notre
                            <Link
                                href="/politique-confidentialite"
                                class="text-blue-400 underline hover:text-blue-300"
                            >
                                politique de confidentialité
                            </Link>
                            et notre utilisation des cookies.
                        </p>
                    </div>
                    <div class="flex gap-3">
                        <button
                            @click="rejectCookies"
                            class="rounded-lg border border-slate-700 px-4 py-2 text-slate-300 transition-all duration-300 hover:border-slate-600 hover:text-white"
                        >
                            Refuser
                        </button>
                        <button
                            @click="acceptCookies"
                            class="rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-2 font-semibold text-white shadow-lg shadow-blue-500/30 transition-all duration-300 hover:from-blue-600 hover:to-blue-700 hover:shadow-blue-500/50"
                        >
                            Accepter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
