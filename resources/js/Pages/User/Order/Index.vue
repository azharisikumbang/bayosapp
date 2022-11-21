<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps(['orders', 'user']);

const amoutToRupiah = (price) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
    }).format(price)
}

</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pesanan Saya
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg pt-4">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
                                <tr>
                                    <th scope="col" class="py-3 px-6 w-2">
                                        No
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Nomor Pesanan
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Status Pesanan
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Nomor Resi Pengiriman
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Total
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-center" v-if="orders.data" v-for="(order, index) in orders.data" :index="index">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ index + 1 }}
                                    </th>
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <Link :href="route('user.order.show', { order_number: order.order_number })" class="text-blue-500 hover:underline">{{ order.order_number }}</Link>
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ order.status }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ order.shipping_tracking_number }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ amoutToRupiah(order.amout) }}
                                    </td>
                                    <td class="py-4 px-6 flex justify-center">
                                        <Link :href="route('user.order.show', { order_number: order.order_number })" class="text-blue-500 hover:underline">Selengkapnya</Link>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-center" v-else>
                                    <td colspan="6" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">Tidak ada pesanan dibuat.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex mt-4 justify-between">
                    <div>
                        <Link :href="orders.prev_page_url" class="text-gray-500 hover:text-gray-800"  v-if="orders.prev_page_url">
                            &larr; Sebelumnya 
                        </Link>
                    </div>
                    <div>
                        Halaman {{ orders.current_page }} dari {{ orders.last_page }}
                    </div>
                    <div>
                        <Link :href="orders.next_page_url" class="text-gray-500 hover:text-gray-800" v-if="orders.next_page_url">
                            Selanjutnya &rarr;
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
