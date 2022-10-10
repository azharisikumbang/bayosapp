<script setup>
import AdminLayout from "@/Layouts/Admin.vue";
import { Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import BreezeButton from "@/Components/Button.vue";
import BreezeInput from "@/Components/Input.vue";
import { onMounted } from "vue";

defineProps([
    'product',
    'showModal',
    'available_variants'
]);

const form = useForm({
    product: null,
    variants: []
});

const checkVariant = (e) => {
    let selectedVariantId = e.target.dataset.id;
    let found = form.variants.filter((el) => el.variantId == selectedVariantId)[0];
    let foundedIndex = form.variants.indexOf(found);
    if (foundedIndex > -1) { // variant exists
        form.variants.splice(foundedIndex);
        return;
    }

    let variantName = e.target.value;
    let variantGroupId = e.target.dataset.parentId;
    let variantGroupName = e.target.dataset.parentName;
    let variantObj = {
        'variantId': selectedVariantId,
        'variantName': variantName,
        'variantGroupId': variantGroupId,
        'variantGroupName': variantGroupName,
        'amount': 0,
        'quantity': 0
    }

    form.variants.push(variantObj);
    form.variants.sort((a,b) => (a.variantGroupId > b.variantGroupId) ? 1 : ((b.variantGroupId > a.variantGroupId) ? -1 : 0));
}

const amoutToRupiah = (amount) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
    }).format(amount)
}

const page = usePage();

onMounted(() => {
    form.product = page.props.value.product.id;
});

const submit = () => {
    form.post(route('admin-sku.store'));
}

</script>

<template>
    <AdminLayout>
        <div class="flex justify-between mt-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Produk</h2>
            <Link :href="route('admin-product.create')" class="underline ml-4">
                Kembali
            </Link>
        </div>

        <div class="overflow-x-auto">
            <div class="min-w-screen min-h-screen bg-gray-100 flex bg-gray-100 font-sans overflow-hidden">
                <div class="w-full">
                    <form @submit.prevent="submit" enctype='multipart/form-data'>
                        <div class="bg-white shadow-md rounded my-6 py-6 px-6">
                            <div class="w-full mx-auto flex flex-wrap">
                                <div class="w-1/2 pr-2">
                                    <img alt="ecommerce" class="object-cover object-center" :src="'/storage/' + product.thumbnail_location">
                                    <ul class="flex flex-1 flex-wrap -m-1 my-4"  v-if="product.images.length > 0">
                                        <li class="block p-1 w-1/2 sm:w-1/3 md:w-2/4 lg:w-1/4 xl:w-2/8 h-24"  v-for="image in product.images">
                                            <img :src="'/storage/' + image.image_location" class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed" />
                                        </li>
                                    </ul>
                                </div>
                                <div class="w-1/2 lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                                    <div class="ml-4">
                                        <h2 class="text-sm title-font text-gray-500 tracking-widest">{{ product.category.display_name }}</h2>
                                        <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ product.name }}</h1>
                                        <p class="leading-relaxed">{{ product.description }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="border-t-2 border-grey-800 py-4 mt-8">
                                <div>
                                    <BreezeButton type="button" @click="showModal = true" class="text-lg text-gray-600 font-medium">
                                        Tambah Varian Produk
                                    </BreezeButton>
                                    <BreezeButton class="bg-orange-500 hover:bg-orange-800 ml-4 text-lg text-gray-600 font-medium">
                                        Perbaharui Data Varian Produk
                                    </BreezeButton>
                                </div>
                                <table class="min-w-max w-full table-auto mt-4">
                                    <thead>
                                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                            <th class="py-3 px-6 text-left">Grup Varian</th>
                                            <th class="py-3 px-6 text-left">Varian</th>
                                            <th class="py-3 px-6 text-left">Harga</th>
                                            <th class="py-3 px-6 text-left">Unit</th>
                                            <th class="py-3 px-6 text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-600 text-sm font-light">
                                        <tr class="border-b border-gray-200 hover:bg-gray-100" v-for="selectedVariant in form.variants" v-if="form.variants.length > 0">
                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                {{ selectedVariant.variantGroupName }}
                                            </td>
                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                {{ selectedVariant.variantName }}
                                            </td>
                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                Rp. <BreezeInput type="number" @change="" :value="selectedVariant.amount"></BreezeInput>
                                                <!-- {{ amoutToRupiah(selectedVariant.amount) }} -->
                                            </td>
                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                <BreezeInput type="number" @change="" :value="selectedVariant.quantity"></BreezeInput>
                                            </td>                                 
                                            <td class="py-3 px-6 text-center">
                                                <div class="flex item-center justify-end">
                                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200 hover:bg-gray-100" v-else>
                                            <td colspan="5" class="py-3 px-6 text-left whitespace-nowrap text-center">Tidak ada data.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Modal -->
                <div v-show="showModal">
                    <div class="fixed inset-0 z-50 overflow-auto bg-gray-800/40 flex">
                        <div class="relative p-4 bg-white w-full max-w-4xl m-auto flex-col flex rounded-lg">
                            <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Daftar Varian Tersedia
                                </h3>
                                <button @click="showModal = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 space-y-6">
                                <table class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                    <tr v-if="available_variants.length > 0" v-for="variant in available_variants">
                                        <td class="font-bold">{{ variant.name }}</td>
                                        <td class="flex">: 
                                            <div v-for="v in variant.variants" class="ml-3">
                                                <input :data-parent-name="variant.name" :data-parent-id="variant.id" :data-id="v.id" class="cursor-pointer" type="checkbox" @change="checkVariant" :value="v.variant"> {{ v.variant }}
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center justify-end p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                                <BreezeButton type="button" @click="showModal = false">Simpan</BreezeButton>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>