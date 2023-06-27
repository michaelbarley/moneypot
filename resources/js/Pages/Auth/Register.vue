<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />
    <nav class="bg-banner">
        <ul id="menu" class="absolute right-0 z-40">
            <li class="rounded-bl-[2em] inline p-2.5 bg-darkPurple text-white">Contact Us</li>
        </ul>
    </nav>

    <div class="bg-banner">
        <img class="" src="Images/moneypotlogo.png" style="left: calc(50% - 8rem); margin: auto;" />
        <div class="form_container w-5/6 ml-[8.3333335%]">
            <form @submit.prevent="submit" class="w-1/2 m-auto">
                <div>
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="block w-full mt-1"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="mt-4">
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="block w-full mt-1"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div class="mt-4">
                        <InputLabel for="postcode" value="Post Code" />
                        <TextInput
                            id="postcode"
                            v-model="form.postcode"
                            type="text"
                            class="block w-full mt-1"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.postcode" />
                    </div>          
                    <div class="mt-4">
                        <InputLabel for="phone" value="Phone Number" />
                        <TextInput
                            id="phone"
                            v-model="form.phone"
                            type="text"
                            class="block w-full mt-1"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.phone" />
                </div>       
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div class="mt-4">
                        <InputLabel for="password" value="Password" />
                        <TextInput
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="block w-full mt-1"
                            required
                            autocomplete="new-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>
                    <div class="mt-4">
                        <InputLabel for="password_confirmation" value="Confirm Password" />
                        <TextInput
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            class="block w-full mt-1"
                            required
                            autocomplete="new-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>

                    <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                        <InputLabel for="terms">
                            <div class="flex items-center">
                                <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                                <div class="ml-2">
                                    I agree to the <a target="_blank" :href="route('terms.show')" class="text-sm text-gray-600 underline hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="text-sm text-gray-600 underline hover:text-gray-900">Privacy Policy</a>
                                </div>
                            </div>
                            <InputError class="mt-2" :message="form.errors.terms" />
                        </InputLabel>
                    </div>
                </div>
                <div class="flex items-center justify-end mt-4">
                        <Link :href="route('login')" class="text-sm text-gray-600 underline hover:text-gray-900">
                            Already registered?
                        </Link>
                </div>
                <button
                        type="submit"
                        class="w-40 h-10 text-center text-white rounded-full cursor-pointer bg-darkPurple hover:bg-dpHover"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        >
                        Register
                </button>
            </form>
        </div>
    </div>
</template>
