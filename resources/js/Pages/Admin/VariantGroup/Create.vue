<script setup>
import AdminLayout from "@/Layouts/Admin.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeButton from "@/Components/Button.vue";
import { Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: ''
});

const submit = () => {
    form.post(route('admin-product-variant-group.store'), {
        onFinish: () => {
            alert("finish");
        }
    });
}

</script>

<template>
    <AdminLayout>
        <div class="flex justify-between mt-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Grup Varian Baru</h2>
            <Link :href="route('admin-product-variant-group.index')" class="underline ml-4">
                Lihat Daftar Grup Varian Produk
            </Link>
        </div>

        <div class="overflow-x-auto">
            <div class="min-w-screen min-h-screen bg-gray-100 flex bg-gray-100 font-sans overflow-hidden">
                <div class="w-full">
                    <div class="bg-white shadow-md rounded my-6 py-6 px-6">
                        <form @submit.prevent="submit">
                            <div>
                                <BreezeLabel for="name" value="Nama Grup Varian" />
                                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
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