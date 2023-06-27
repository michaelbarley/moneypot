<script setup>
    import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
    import AuthenticationCard from '@/Components/AuthenticationCard.vue';
    import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
    import Checkbox from '@/Components/Checkbox.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    defineProps({
        canResetPassword: Boolean,
        status: String,
    });
    const form = useForm({
        email: '',
        password: '',
        remember: false,
    });
    const submit = () => {
        form.transform(data => ({
            ...data,
            remember: form.remember ? 'on' : '',
        })).post(route('login'), {
            onFinish: () => form.reset('password'),
        });
    };
    </script>
    
    <template>
        <Head title="Log in" />
        <nav class="bg-banner">
            <!-- Nav Menu -->
            <ul id="menu" class="absolute right-0 z-40">
                <li class="rounded-bl-[2em] inline p-2.5 bg-darkPurple text-white">Contact Us</li>
            </ul>
            <!-- Banner Images-->   
            <div class="px-8 pt-10 h-80">
                <img class="w-80 pig-logo" src="/Images/moneypotlogo.png" />
            </div>
        </nav>

        <div class="grid grid-cols-1 sm:grid-cols-2" style="text-align: -webkit-center;width: 80%;margin: auto;" >
            <div class="px-8">
                <form @submit.prevent="submit" >
                    <div>
                    <InputLabel for="email" value="Email" />
                        <TextInput
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="block w-full mt-1"
                            required
                            autofocus
                        />
                    <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password" value="Password" />
                        <TextInput
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="block w-full mt-1"
                            required
                            autocomplete="current-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center">
                            <Checkbox v-model:checked="form.remember" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <Link v-if="canResetPassword" :href="route('password.request')" class="text-sm text-gray-600 underline hover:text-gray-900">
                            Forgot your password?
                        </Link>

                        <Link :href="route('register')" class="mx-5 text-sm text-gray-600 underline hover:text-gray-900">
                           Don't have an account?
                        </Link>

                        <button
                        type="submit"
                        class="w-40 h-10 text-center text-white rounded-full cursor-pointer bg-darkPurple hover:bg-dpHover"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        >
                            Log In
                        </button>
                    </div>
                </form>
            </div>
            <div>
                <img class="w-1/2" src="/Images/pig_on_its_own.png" />
            </div>
        </div>        
    </template>
