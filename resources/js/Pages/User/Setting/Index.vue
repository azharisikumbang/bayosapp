<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps(['user']);

</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Biodata Saya
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="w-full mx-auto flex flex-wrap">
                            <div class="w-2/6 pr-2">
                                <div>
                                    <template v-if="user.picture">
                                        <img alt="profil-picture" class="object-cover object-center w-full rounded-lg" :src="user.picture_image_url">
                                    </template>
                                    <template v-else>
                                        <img alt="profil-picture" class="object-cover object-center w-full rounded-lg" src="https://api.nilskoepke.com/profile-image/?name=John+Doe&backgroundColor=rgb(33,194,87)">
                                    </template>
                                </div>
                            </div>
                            <div class="w-4/6">
                                <div class="ml-4">
                                    <div class="mb-8">
                                        <h3 class="font-bold mb-2 text-xl">Biodata Diri</h3>
                                        <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                                            <div class="flex flex-col pb-3">
                                                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nama</dt>
                                                <dd class="text-lg font-semibold">{{ user.name }}</dd>
                                            </div>
                                            <div class="flex flex-col py-3">
                                                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Tanggal Lahir</dt>
                                                <dd class="text-lg font-semibold">{{ user.formatted_dob_string ?? '-' }}</dd>
                                            </div>
                                            <div class="flex flex-col py-3">
                                                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Jenis Kelamin</dt>
                                                <dd class="text-lg font-semibold">{{ user.gender_name ?? '-' }}</dd>
                                            </div>
                                            <div class="flex flex-col py-3">
                                                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Alamat</dt>
                                                <dd class="text-lg font-semibold">{{ user.address ?? '-' }}</dd>
                                            </div>
                                        </dl>
                                    </div>
                                    <div class="mb-8">
                                        <h3 class="font-bold mb-2 text-xl">Kontak</h3>
                                        <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                                            <div class="flex flex-col pb-3">
                                                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Email</dt>
                                                <dd class="text-lg font-semibold">{{ user.email }}</dd>
                                            </div>
                                            <div class="flex flex-col py-3">
                                                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">No. Handphone</dt>
                                                <dd class="text-lg font-semibold">{{ user.phone ?? '-' }}</dd>
                                            </div>
                                        </dl>
                                    </div>
                                    <div class="mb-8">
                                        <Link :href="route('user.setting.edit')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">Perbaharui</Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
