<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BackendLayout from '@/Layouts/Backend.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
    users: Array
});

const form = useForm({
    query: '',
    search: false
});

const formUserDelete = useForm({
    userId: null
});

const confirmDeleteUser = (user) => {
    const isConfirmed = confirm(`Anda yakin ingin menghapus data ${user.name} ?`);

    if(isConfirmed) {
        formUserDelete.delete(route('backend-users.destroy', { 
            'user': user.id,
            onSuccess: () => {
                alert('success');
            }
        }));
    }
}
</script>

<template>
    <Head title="Dashboard" />
    <BackendLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Penguna
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between mb-4 w-full">
                            <div class="flex justify-between">
                                <BreezeInput id="query" type="text" class="mt-1 block w-full" v-model="form.query" required autofocus autocomplete="query" />
                                <BreezeButton class="ml-4" type="button">Cari</BreezeButton>
                            </div>
                            <div>
                                <Link :href="route('backend-users.create')" class="inline-flex items-center px-4 py-2 bg-purple-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:shadow-outline-purple transition ease-in-out duration-150">
                                    + Tambah Data
                                </Link>
                            </div>
                        </div>
                        <table class="w-full">
                            <thead>
                                <tr class="text-center border border-gray-200 ">
                                    <th class="py-4">No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>As</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user, index in users.data" class="border border-gray-200 text-center ">
                                    <td class="py-2">{{ index + 1 }}</td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>Adminitrator</td> <!-- @TODO : set to label with color -->
                                    <td>ACTIVE</td> <!-- @TODO : set to label with color -->
                                    <td>
                                        <Link :href="route('backend-users.edit', {'user': user.id })" class="inline-flex items-center px-4 py-2 bg-yellow-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:shadow-outline-yellow transition ease-in-out duration-150">
                                            Edit
                                        </Link>
                                        <BreezeButton class="ml-4" type="button" @click="confirmDeleteUser(user)">
                                            Delete
                                        </BreezeButton>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div>
                            <div class="flex mt-4">
                                <Link :href="users.prev_page_url" class="underline">
                                    Sebelumnya     
                                </Link>
                                <Link :href="users.next_page_url" class="underline ml-4">
                                    Selanjutnya    
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BackendLayout>
</template>