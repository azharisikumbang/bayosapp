<script setup>
import AdminLayout from "@/Layouts/Admin.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeInput from "@/Components/Input.vue";
import TextareaInput from "@/Components/Textarea.vue";
import BreezeButton from "@/Components/Button.vue";
import { Link, useForm } from '@inertiajs/inertia-vue3';

defineProps([
    'product_categories'
]);

const form = useForm({
    name: '',
    description: '',
    thumbnail: null,
    product_category: -1,
    images: [],
    previews: []
});

const submit = () => {
    form.post(route('admin-product.store'), {
        onFinish: () => {
            // @TODO implement saved notification
        }
    });
}

const displayPreviewImages = (e) => {
    let images = e.target.files;
    for (const image of images) {
        let reader  = new FileReader();
        reader.onload = (e) => {
            form.previews.push(e.target.result);
        }
        reader.readAsDataURL(image);
    }
}

</script>

<template>
    <AdminLayout>
        <div class="flex justify-between mt-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Produk Baru</h2>
            <Link :href="route('admin-product.index')" class="underline ml-4">
                Lihat Produk Tersedia
            </Link>
        </div>

        <div class="overflow-x-auto">
            <div class="min-w-screen min-h-screen bg-gray-100 flex bg-gray-100 font-sans overflow-hidden">
                <div class="w-full">
                    <div class="bg-white shadow-md rounded my-6 py-6 px-6">
                        <form @submit.prevent="submit" enctype='multipart/form-data'>
                            <div class="mb-3">
                                <BreezeLabel for="name" value="Nama Produk" />
                                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                            </div>
                            <div class="mb-3">
                                <BreezeLabel for="description" value="Deskripsi Produk" />
                                <TextareaInput id="description" type="text" class="mt-1 block w-full" v-model="form.description" />
                            </div>
                            <div class="mb-3">
                                <BreezeLabel for="thumbnail" value="Thumnail Produk" />
                                <input type="file" class="mt-1 block w-full" @input="form.thumbnail = $event.target.files[0]"/>
                            </div>
                            <div class="mb-3">
                                <BreezeLabel for="kategori" value="Kategori Produk" />
                                <select class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.product_category" required>
                                    <option value="-1">Tidak Ada.</option>
                                    <template v-for="pc in product_categories">
                                        <option :value=pc.id>{{ pc.display_name }}</option>
                                    </template>
                                </select>
                            </div>
                            <div class="mb-3 mt-4">
                                <BreezeLabel class="mb-3" for="Preview" value="Gambar Preview Produk" />
                                <ul class="flex flex-1 flex-wrap -m-1 mb-4 "  v-if="form.previews.length > 0">
                                    <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24"  v-for="image in form.previews">
                                        <img :src="image" class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed" />
                                    </li>
                                </ul>
                                <input type="file" @change="displayPreviewImages" ref="productPreviewInput" style="display:none" @input="form.images.push(...$event.target.files)" multiple>
                                <div class="border border-dashed border-2 border-gray-400 py-8">
                                    <div class="flex justify-center">
                                        <svg class="svg-icon h-12 text-gray-400 hover:text-gray-600 cursor-pointer" viewBox="0 0 20 20" @click="$refs.productPreviewInput.click()">
                                            <path fill="grey" d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                                        </svg>
                                    </div>
                                    <div class="text-center mt-2 text-gray-400">
                                        <p>
                                            Tambahkan preview gambar produk dengan menekan tombol <button type="button" class="underline text-gray-500 hover:text-gray-800 cursor-pointer" @click="$refs.productPreviewInput.click()">tambah</button>
                                        </p>
                                    </div>
                                </div>
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