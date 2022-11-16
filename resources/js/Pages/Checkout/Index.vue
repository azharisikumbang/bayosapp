<script setup>
import { Link } from '@inertiajs/inertia-vue3';


defineProps(['carts']);

const amoutToRupiah = (price) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
    }).format(price)
}

</script>
<template>
    <div class="mx-auto max-w-2xl px-4 pt-10 pb-16 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pt-16 lg:pb-24">
        <div class="lg:col-span-2 lg:pr-8">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Checkout</h2>
        </div>
        <div class="mt-4 lg:row-span-3 lg:mt-0">
            <div class="bg-gray-100 py-8 px-4">
                <h3 class="font-bold tracking-tight text-gray-900 mb-2">Ringkasan Belanja</h3>
                <ul class="border-b-2 pb-4 mb-4">
                    <li>
                        <div class="flex">
                            <div class="flex-1 min-w-0">
                                Total Harga
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                {{ amoutToRupiah(carts.total) }}
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex">
                            <div class="flex-1 min-w-0">
                                Total Diskon
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                Rp. 0
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="flex">
                    <div class="flex-1 min-w-0 font-bold tracking-tight text-gray-900">
                        Total Harga
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900">
                        {{ amoutToRupiah(carts.total) }}
                    </div>
                </div>
                <Link :href="route('checkout.index')" class="mt-4 w-full justify-center py-3 px-8 text-base font-medium text-white inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">Checkout</Link>
            </div>
        </div>
        <div class="py-10 lg:col-span-2 lg:col-start-1 lg:pt-6 lg:pb-16 lg:pr-8">
            <div>
                <h3 class="font-bold tracking-tight text-gray-700 border-b pb-2">Alamat Pengiriman</h3>
                <div>
                    
                </div>
            </div>
            <div>
                <h3 class="font-bold tracking-tight text-gray-700 border-b pb-2">Alamat Pengiriman</h3>
                <div>

                </div>
            </div>
        </div>
    </div>
</template>