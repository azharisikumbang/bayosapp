<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BackendLayout from '@/Layouts/Backend.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import { Link } from '@inertiajs/inertia-vue3';
    
const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: '1',
    terms: false,
});

const submit = () => {
    form.post(route('backend-users.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Dashboard" />
    <BackendLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pengguna
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <form @submit.prevent="submit">
                            <div>
                                <BreezeLabel for="name" value="Name" />
                                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                            </div>

                            <div class="mt-4">
                                <BreezeLabel for="email" value="Email" />
                                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
                            </div>

                            <div class="mt-4">
                                <BreezeLabel for="password" value="Password" />
                                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
                            </div>

                            <div class="mt-4">
                                <BreezeLabel for="password_confirmation" value="Confirm Password" />
                                <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
                            </div>

                            <div class="mt-4">
                                <BreezeLabel for="role" value="Daftarkan Sebagai" />
                                <select class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.role" required>
                                    <option value="1">-- Customer --</option>
                                    <option value="2">-- Adminitrator --</option>
                                    <option value="3">-- Super Adminitrator --</option>
                                </select>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Simpan
                                </BreezeButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BackendLayout>
</template>