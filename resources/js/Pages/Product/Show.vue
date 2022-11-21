<script setup>
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { onMounted } from 'vue';

import BreezeButton from "@/Components/Button.vue";

defineProps(['product' , 'errors']);

const amoutToRupiah = (price) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
    }).format(price)
}

const form = useForm({
  product: {},
  variants: {},
  quantity: 1
});

const page = usePage();

onMounted(() => {
  form.product = page.props.value.product.id;
});

const changeVariantStatus = (parent, choice) => {
  form.variants[parent] = choice
  let status = page.props.value.product.variants[parent][choice.id].is_selected;
  if (status == true) delete form.variants[parent];

  page.props.value.product.variants[parent][choice.id].is_selected = !status;

  for (const variant in page.props.value.product.variants[parent]) {
    if(variant == choice.id) continue;

    page.props.value.product.variants[parent][variant].is_selected = false;
  }
}

const submit = () => {
  if(Object.keys(form.variants).length != Object.keys(page.props.value.product.variants).length) {
    page.props.value.errors.variant = {
      'message': 'Mohon lengkapi spesifikasi varian produk.'
    };

    return;
  }

  if(form.quantity < 1) {
    page.props.value.errors.quantity = {
      'message': 'Jumlah produk dipesan minimal 1 buah.'
    };

    return;
  }

  form.post(route('cart.store'));
}

</script>
<template>
<div class="bg-white">
  <div class="pt-6">
    <nav aria-label="Breadcrumb">
      <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <li>
          <div class="flex items-center">
            <a href="#" class="mr-2 text-sm font-medium text-gray-900">Men</a>
            <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-5 w-4 text-gray-300">
              <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
            </svg>
          </div>
        </li>

        <li>
          <div class="flex items-center">
            <a href="#" class="mr-2 text-sm font-medium text-gray-900">Clothing</a>
            <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-5 w-4 text-gray-300">
              <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
            </svg>
          </div>
        </li>

        <li class="text-sm">
          <a href="#" aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">Basic Tee 6-Pack</a>
        </li>
      </ol>
    </nav>

    <!-- Image gallery -->
    <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:gap-x-8 lg:px-8">
      <div class="aspect-w-3 aspect-h-4 hidden overflow-hidden rounded-lg lg:block">
        <img src="https://tailwindui.com/img/ecommerce-images/product-page-02-secondary-product-shot.jpg" alt="Two each of gray, white, and black shirts laying flat." class="h-full w-full object-cover object-center">
      </div>
      <div class="hidden lg:grid lg:grid-cols-1 lg:gap-y-8">
        <div class="aspect-w-3 aspect-h-2 overflow-hidden rounded-lg">
          <img src="https://tailwindui.com/img/ecommerce-images/product-page-02-tertiary-product-shot-01.jpg" alt="Model wearing plain black basic tee." class="h-full w-full object-cover object-center">
        </div>
        <div class="aspect-w-3 aspect-h-2 overflow-hidden rounded-lg">
          <img src="https://tailwindui.com/img/ecommerce-images/product-page-02-tertiary-product-shot-02.jpg" alt="Model wearing plain gray basic tee." class="h-full w-full object-cover object-center">
        </div>
      </div>
      <div class="aspect-w-4 aspect-h-5 sm:overflow-hidden sm:rounded-lg lg:aspect-w-3 lg:aspect-h-4">
        <img src="https://tailwindui.com/img/ecommerce-images/product-page-02-featured-product-shot.jpg" alt="Model wearing plain white basic tee." class="h-full w-full object-cover object-center">
      </div>
    </div>

    <!-- Product info -->
    <div class="mx-auto max-w-2xl px-4 pt-10 pb-16 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pt-16 lg:pb-24">
      <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
        <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Basic Tee 6-Pack</h1>
      </div>

      <!-- Options -->
      <div class="mt-4 lg:row-span-3 lg:mt-0">
        <h2 class="sr-only">Product information</h2>
        <p class="text-3xl tracking-tight text-gray-900">{{ amoutToRupiah(product.price) }}</p>


        <form class="mt-10" @submit.prevent="submit">
        <!-- variant -->
          <template v-if="errors">
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert" v-for="error in errors" >
              <span class="font-medium">Perhatian!</span> {{ error.message }}
            </div>
          </template>

          <!-- Sizes -->
          <div class="mt-10" v-for="(item, name) in product.variants" :index="name">
            <div class="flex items-center justify-between">
              <h3 class="text-sm font-medium text-gray-900">{{ name }}</h3>
            </div>

            <fieldset class="mt-4">
              <legend class="sr-only">Pilih {{ name }}</legend>
              <div class="grid grid-cols-2 gap-2 sm:grid-cols-8 lg:grid-cols-3">
                <!-- Active: "ring-2 ring-indigo-500" -->
                <label class="group relative border text-center rounded-md flex items-center justify-center text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 py-2 bg-white shadow-sm text-gray-900 cursor-pointer" :class="{ 'text-indigo-500 ring-2 ring-indigo-500': variant.is_selected }" v-for="variant in item" @click="changeVariantStatus(name, variant)">
                  <span id="size-choice-7-label">{{ variant.name }}</span>

                  <!--
                    Active: "border", Not Active: "border-2"
                    Checked: "border-indigo-500", Not Checked: "border-transparent"
                  -->
                  <span class="pointer-events-none absolute -inset-px rounded-md" aria-hidden="true"></span>
                </label>
              </div>
            </fieldset>
          </div>

          <!-- Quantity -->
          <div class="mt-10">
            <div class="flex items-center justify-between">
              <h3 class="font-medium text-gray-900">Jumlah</h3>
            </div>
            <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-4">
              <div class="text-center h-full w-20 rounded-l cursor-pointer outline-none border" @click="form.quantity--">
                <span class="m-auto text-2xl font-thin">−</span>
              </div>
              <input type="number" class="border outline-0 focus:outline-none hover:outline-none text-center w-full font-semibold text-md md:text-base cursor-default flex items-center outline-none border-gray-200" :value="form.quantity">
              <div class="text-center h-full w-20 rounded-r border cursor-pointer" @click="form.quantity++">
                <span class="m-auto text-2xl font-thin">+</span>
              </div>
            </div>
          </div>

          <BreezeButton class="mt-10 w-full justify-center py-3 px-8 text-base font-medium text-white" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Tambahkan ke Keranjang</BreezeButton>
        </form>
      </div>

      <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pt-6 lg:pb-16 lg:pr-8">
        <!-- Description and details -->
        <div>
          <h3 class="sr-only">Description</h3>

          <div class="space-y-6">
            <p class="text-base text-gray-900">The Basic Tee 6-Pack allows you to fully express your vibrant personality with three grayscale options. Feeling adventurous? Put on a heather gray tee. Want to be a trendsetter? Try our exclusive colorway: &quot;Black&quot;. Need to add an extra pop of color to your outfit? Our white tee has you covered.</p>
          </div>
        </div>

        <div class="mt-10">
          <h3 class="text-sm font-medium text-gray-900">Highlights</h3>

          <div class="mt-4">
            <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
              <li class="text-gray-400"><span class="text-gray-600">Hand cut and sewn locally</span></li>

              <li class="text-gray-400"><span class="text-gray-600">Dyed with our proprietary colors</span></li>

              <li class="text-gray-400"><span class="text-gray-600">Pre-washed &amp; pre-shrunk</span></li>

              <li class="text-gray-400"><span class="text-gray-600">Ultra-soft 100% cotton</span></li>
            </ul>
          </div>
        </div>

        <div class="mt-10">
          <h2 class="text-sm font-medium text-gray-900">Details</h2>

          <div class="mt-4 space-y-6">
            <p class="text-sm text-gray-600">The 6-Pack includes two black, two white, and two heather gray Basic Tees. Sign up for our subscription service and be the first to get new, exciting colors, like our upcoming &quot;Charcoal Gray&quot; limited release.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</template>