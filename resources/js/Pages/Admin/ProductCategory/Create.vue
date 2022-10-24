<script setup>
import AdminLayout from "@/Layouts/Admin.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeButton from "@/Components/Button.vue";
import { Link, useForm } from '@inertiajs/inertia-vue3';

defineProps([
    'product_categories'
]);

const form = useForm({
    name: '',
    display_name: '',
    parent: null
});

const submit = () => {
    form.post(route('admin-product-category.store'));
}

</script>

<template>
    <AdminLayout>
        <div class="flex justify-between mt-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kategori Produk Baru</h2>
            <Link :href="route('admin-product-category.index')" class="underline ml-4">
                Lihat Daftar Kategori Produk
            </Link>
        </div>

        <div class="overflow-x-auto">
            <div class="min-w-screen min-h-screen bg-gray-100 flex bg-gray-100 font-sans overflow-hidden">
                <div class="w-full">
                    <div class="bg-white shadow-md rounded my-6 py-6 px-6">
                        <form @submit.prevent="submit">
                            <div>
                                <BreezeLabel for="name" value="Nama Kategori" />
                                <BreezeInput placeholder="cth: angkola-collection" id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                            </div>

                            <div class="mt-4">
                                <BreezeLabel for="display_name" value="Tampilkan Sebagai" />
                                <BreezeInput placeholder="cth: Angkola Collection" id="display_name" type="text" class="mt-1 block w-full" v-model="form.display_name" />
                            </div>

                            <div class="mt-4">
                                <BreezeLabel for="parent" value="Sub dari Kategori" />
                                <select class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.parent" required>
                                    <option value=null>-- Tidak Ada --</option>
                                    <template v-for="pc in product_categories">
                                        <option :value=pc.id>{{ pc.display_name }}</option>
                                    </template>
                                </select>
                            </div>

                            <div class="flex items-center justify-end mt-6">
                                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Simpan
                                </BreezeButton>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>