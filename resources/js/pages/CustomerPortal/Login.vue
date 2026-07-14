<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

function submit() {
    form.post('/espace-client/connexion', {
        onFinish: () => form.reset('password'),
    });
}
</script>

<template>
    <Head title="Espace Client — Connexion" />

    <div class="flex min-h-svh flex-col items-center justify-center gap-6 bg-gray-50 p-6 dark:bg-gray-950 md:p-10">
        <div class="w-full max-w-sm">
            <div class="flex flex-col gap-8">
                <div class="flex flex-col items-center gap-4">
                    <div class="space-y-2 text-center">
                        <h1 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Espace Client
                        </h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Connectez-vous pour accéder à vos documents
                        </p>
                    </div>
                </div>

                <form @submit.prevent="submit" class="flex flex-col gap-6">
                    <div class="grid gap-6">
                        <div class="grid gap-2">
                            <Label for="email">Adresse email</Label>
                            <Input
                                id="email"
                                v-model="form.email"
                                type="email"
                                required
                                autofocus
                                autocomplete="email"
                                placeholder="votre@email.com"
                            />
                            <InputError :message="form.errors.email" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="password">Mot de passe</Label>
                            <Input
                                id="password"
                                v-model="form.password"
                                type="password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                            />
                            <InputError :message="form.errors.password" />
                        </div>

                        <div class="flex items-center gap-3">
                            <Checkbox
                                id="remember"
                                v-model:checked="form.remember"
                            />
                            <Label for="remember" class="cursor-pointer font-normal">
                                Se souvenir de moi
                            </Label>
                        </div>

                        <Button
                            type="submit"
                            class="mt-2 w-full"
                            :disabled="form.processing"
                        >
                            <Spinner v-if="form.processing" />
                            Se connecter
                        </Button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
