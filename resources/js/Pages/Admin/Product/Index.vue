<script setup>
import AdminLayout from "@/Layouts/Admin.vue";
import { Link, usePage } from '@inertiajs/inertia-vue3';
import { onMounted } from "vue";

defineProps([
    'products'
]);

onMounted(() => {
    console.log(usePage().props.value.products);
});

const amoutToRupiah = (price) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
    }).format(price)
}

</script>

<template>
    <AdminLayout>
        <div class="flex justify-between mt-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Produk Tersedia</h2>
            <Link :href="route('admin-product.create')" class="underline ml-4">
                Tambah Produk Baru
            </Link>
        </div>

        <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex bg-gray-100 font-sans overflow-hidden">
            <div class="w-full">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead class="text-center">
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="border border-gray-400 py-3 px-6 text-center" rowspan="2">Produk</th>
                                <th class="border border-gray-400 py-3 px-6 text-center" rowspan="2">Kategori</th>
                                <th class="border border-gray-400 py-3 px-6 text-center" colspan="3">Varian</th>
                                <th class="border border-gray-400 py-3 px-6 text-center" rowspan="2"></th>
                            </tr>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="border border-gray-400 py-3 px-6 text-center">SKU</th>
                                <th class="border border-gray-400 py-3 px-6 text-center">Harga</th>
                                <th class="border border-gray-400 py-3 px-6 text-center">Stok</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            <template v-for="product in products.data" v-if="products.data.length > 0">
                                <tr class="border-b border-gray-200 hover:bg-gray-100" v-for="(detail, index) in product.detail">
                                    <td class="py-3 px-6 text-left whitespace-nowrap border border-gray-400" :rowspan="product.detail.length" v-if="index < 1">
                                        <Link :href="route('admin-product.show', { id: product.id })" class="underline text-sm font-medium text-gray-900">
                                            {{ product.name }}
                                        </Link>
                                        <span class="block italic text-sm text-gray-500">base price: {{ amoutToRupiah(product.price) }}</span>
                                    </td>                                
                                    <td class="py-3 px-6 text-center text-sm whitespace-nowrap border border-gray-400" :rowspan="product.detail.length" v-if="index < 1">
                                        {{ product.category.display_name }}
                                    </td>  
                                    <td class="py-3 px-6 text-center text-sm whitespace-nowrap border border-gray-400">
                                        {{ detail.value.toUpperCase() }}
                                    </td>  
                                    <td class="py-3 px-6 text-center whitespace-nowrap border border-gray-400">
                                        {{ amoutToRupiah(product.price + detail.additional_price) }}
                                    </td>                                  
                                    <td class="py-3 px-6 text-center whitespace-nowrap border border-gray-400">
                                        {{ detail.quantity }} unit
                                    </td>                               
                                    <td class="py-3 px-6 text-center border border-gray-400">
                                        <div class="flex item-center justify-end">
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </div>
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </div>
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                            <template v-else>
                                <tr class="border-b border-gray-200 hover:bg-gray-100 border border-gray-400">
                                    <td colspan="6" class="py-3 px-6 text-left whitespace-nowrap text-center">Tidak ada data.</td>
                                </tr>
                            </template>
                            
                        </tbody>
                    </table>
                </div>
                
                <div>
                    <div class="flex mt-4">
                        <Link :href="products.prev_page_url" class="underline" v-if="products.prev_page_url">
                            Sebelumnya     
                        </Link>
                        <Link :href="products.next_page_url" class="underline ml-4" v-if="products.next_page_url">
                            Selanjutnya    
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </AdminLayout>
</template>