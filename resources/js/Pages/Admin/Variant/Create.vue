<script setup>
import AdminLayout from "@/Layouts/Admin.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeButton from "@/Components/Button.vue";
import { Link, useForm } from '@inertiajs/inertia-vue3';

defineProps([
    'variant_groups'
]);

const form = useForm({
    variant: '',
    sku: '',
    group: 1,
});

const submit = () => {
    form.post(route('admin-product-variant.store'), {
        onFinish: () => {}
    });
}

</script>

<template>
    <AdminLayout>
        <div class="flex justify-between mt-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Varian Baru</h2>
            <Link :href="route('admin-product-variant.index')" class="underline ml-4">
                Lihat Varian Produk
            </Link>
        </div>

        <div class="overflow-x-auto">
            <div class="min-w-screen min-h-screen bg-gray-100 flex bg-gray-100 font-sans overflow-hidden">
                <div class="w-full">
                    <div class="bg-white shadow-md rounded my-6 py-6 px-6">
                        <form @submit.prevent="submit">
                            <div class="mb-3 grid grid-cols-3 gap-4">
                                <div class="col-span-2">
                                    <BreezeLabel for="variant" value="Nama Varian" />
                                    <BreezeInput id="variant" type="text" class="mt-1 block w-full" v-model="form.variant" required autofocus autocomplete="variant" />
                                </div>
                                <div>
                                    <label for="sku" class="block font-medium text-sm text-gray-700">
                                        SKU Label (<Link class="italic text-red-500 underline" :href="route('admin-product.index')">*baca petunjuk penulisan</Link>)
                                    </label>
                                    <BreezeInput id="sku" type="text" class="mt-1 block w-full" v-model="form.sku" onkeyup="this.value = this.value.toUpperCase()" required />
                                </div>
                            </div>
                            <div class="mt-4">
                                <BreezeLabel for="group" value="Pilih Grup Varian" />
                                <select class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.group" required>
                                    <template v-for="vg in variant_groups">
                                        <option :value=vg.id>{{ vg.name }}</option>
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