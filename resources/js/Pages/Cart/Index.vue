<script setup>
import BreezeButton from '@/Components/Button.vue';
import { useForm } from '@inertiajs/inertia-vue3';

defineProps(['carts']);

const form = useForm();

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
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Keranjang</h2>
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
                <BreezeButton class="mt-4 w-full justify-center py-3 px-8 text-base font-medium text-white" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Checkout</BreezeButton>
            </div>
        </div>
        <div class="py-10 lg:col-span-2 lg:col-start-1 lg:pt-6 lg:pb-16 lg:pr-8">
            <div class="flex mt-10 mb-5">
                <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Detail Produk</h3>
                <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Jumlah</h3>
                <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Harga</h3>
                <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
            </div>
            <!-- Cart Item -->
            <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5" v-for="cart in carts.items" v-if="carts.items.length > 0">
                <div class="flex w-2/5">
                    <div class="w-20">
                        <img class="h-24" :src="'/storage/' + cart.product.thumbnail_location" :alt="cart.product.name">
                    </div>
                    <div class="flex flex-col justify-between ml-4 flex-grow">
                        <div>
                            <div class="font-bold text-sm">{{ cart.product.name }}</div>
                            <div class="text-red-500 text-xs">
                                <span v-for="(variant, key, index) in cart.variants" :key="index">
                                    {{ variant.variant }}<span v-if="(index + 1) != Object.keys(cart.variants).length">, </span>
                                </span>
                            </div>
                        </div>
                        <a href="#" class="font-semibold hover:text-red-500 text-gray-500 text-xs">Hapus</a>
                    </div>
                </div>
                <div class="flex justify-center w-1/5">
                    <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512"><path d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                    </svg>

                    <input class="mx-2 border text-center w-12" type="text" :value="cart.quantity">

                    <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512">
                    <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                    </svg>
                </div>
                <span class="text-center w-1/5 font-semibold text-sm">{{ amoutToRupiah(cart.price) }}</span>
                <span class="text-center w-1/5 font-semibold text-sm">{{ amoutToRupiah(cart.total) }}</span>
            </div>
            <div class="text-center px-6 py-5" v-else>
                Keranjang anda masih kosong, mari belanja..
            </div>
        </div>  
    </div>
</template>