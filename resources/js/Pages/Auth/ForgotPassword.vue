<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Forgot Password" />
    <div class="bg-no-repeat bg-cover bg-banner ">
        <img class="absolute top-12 h-[16rem] object-center" src="Images/moneypotlogo.png" style="left: calc(50% - 10rem);" />

        <div class="text-center pt-80">
            <h1 class="text-5xl font-bold text-moneyPot">Oops!</h1>
            <p class="mt-4">Forgot your password? No problem.</p>
            <p class="mt-4">Just let us know your email address and we will email you a password reset link.</p><br>
        </div>

            <form @submit.prevent="submit" class="text-center">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="block w-full mt-1"
                    required
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.email" /><br>
                <button
                    type="submit"
                    class="h-10 text-center text-white rounded-full cursor-pointer w-80"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    :style="{backgroundColor: '#715191'}">
                    Email Password Reset Link
                </button>
            </form>
    </div>
</template>

<style>
    form {
        width: 50%;
        margin: auto;
    }
</style>
