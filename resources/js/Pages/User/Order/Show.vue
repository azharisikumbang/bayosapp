<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps(['order', 'user']);

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
                <h2 class="font-semibold mb-4 text-2xl">Detail Pesanan # {{ order.order_number }}</h2>
                <!-- Order Title -->
                <div class="grid grid-cols-2 grid-rows-3 gap-4">
                <!-- Order detail -->
                    <div class="col-span-2 rounded shadow bg-white p-4">
                        <h3 class="font-semibold text-lg mb-3">Detail Pesanan</h3>
                        <table class="w-full text-left text-gray-500">
                            <tr class="border-b">
                                <td class="py-2 w-56">No. Pesanan</td>
                                <td>: {{ order.order_number }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2">Tanggal Pemesanan</td>
                                <td>: {{ order.order_date }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2">Nama Pemesan</td>
                                <td>: {{ order.customer.name }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2">Kontak Pemesan</td>
                                <td>: {{ order.contact }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2">Status</td>
                                <td>: {{ order.status }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2">Nominal Total</td>
                                <td>: {{ amoutToRupiah(order.amout) }}</td>
                            </tr>
                        </table>
                    </div>
                    <!-- payment detail -->
                    <div class="rounded shadow bg-white p-4">
                        <h3 class="font-semibold text-lg mb-3">Detail Pembayaran</h3>
                        <table class="w-full text-left text-gray-500">
                            <tr class="border-b">
                                <td class="py-2 w-56">Status Pembayaran</td>
                                <td>: UNPAID</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2">Tanggal Terbit Invoice</td>
                                <td>: {{ order.order_date }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2">Total Tagihan</td>
                                <td>: {{ amoutToRupiah(order.amout) }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2">Tanggal Pembayaran</td>
                                <td>: {{ order.customer.name }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2">Nominal Dibayarkan</td>
                                <td>: {{ order.contact }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2">Diverifikasi Oleh</td>
                                <td>: Administator</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2">Bukti Pembayaran</td>
                                <td>: <Link class="text-blue-400 hover:text-blue-600 hover:underline">Download</Link></td>
                            </tr>
                        </table>
                    </div>
                    <!-- Shipping detail -->
                    <div class="rounded shadow bg-white p-4">
                        <h3 class="font-semibold text-lg mb-3">Detail Pengiriman</h3>
                        <table class="w-full text-left text-gray-500">
                            <tr class="border-b">
                                <td class="py-2 w-56">Agen Pengiriman</td>
                                <td>: {{ order.shipping_agent }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 w-56">Nomor Resi Pengiriman</td>
                                <td>: {{ order.shipping_tracking_number }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2">Tanggal Pengiriman</td>
                                <td>: {{ order.order_date }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2">Status Pengiriman</td>
                                <td>: {{ order.status }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2">Tujuan</td>
                                <td>: {{ order.shipping_address }}</td>
                            </tr>
                        </table>
                    </div>
                    <!-- order items -->
                    <div class="col-span-2 rounded shadow bg-white">
                        <h3 class="font-semibold text-lg p-4">Daftar Pesanan (Total : 5 Item)</h3>
                        <div class="overflow-x-auto relative">
                            <table class="w-full text-center text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="w-2 py-3 px-6">
                                            No
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Nama Produk
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Varian
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Harga
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Jumlah
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <td class="py-4 px-6">
                                            1
                                        </td><th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Apple MacBook Pro 17"
                                        </th>
                                        <td class="py-4 px-6">
                                            Sliver
                                        </td>
                                        <td class="py-4 px-6">
                                            Rp. 250.000
                                        </td>
                                        <td class="py-4 px-6">
                                            2
                                        </td>
                                        <td class="py-4 px-6">
                                            Rp. 500.000    
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
