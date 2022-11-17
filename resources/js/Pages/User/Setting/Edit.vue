<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import { onMounted } from 'vue';

defineProps(['user', 'errors']);

const page = usePage();

const form = useForm({
    name: '',
    email: '',
    dob: '',
    address: '',
    gender: '',
    picture: Object,
    phone: '',
    _method: 'put'
});

const submit = () => {
    console.log(form);
    form.post(route('user.setting.update'));
}

onMounted(() => {
    const user = page.props.value.user;
    form.name = user.name;
    form.email = user.email;
    form.address = user.address;
    form.gender = user.gender;
    form.phone = user.phone;
    // form.picture = user.picture;
    form.dob = user.dob;
});

const displayPreviewImages = (e) => {
    let image = e.target.files[0];
    let reader  = new FileReader();
    reader.onload = (e) => {
        page.props.value.user.picture = e.target.result;
        page.props.value.user.picture_image_url = e.target.result;
    }

    reader.readAsDataURL(image);
}

</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Biodata Saya
            </h2>
        </template>

        <div class="py-12">
            <form @submit.prevent="submit" enctype="multipart/form-data">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="mb-4" v-if="errors">
                        <div class="flex p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800" role="alert" v-for="error in errors">
                            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">Perhatian!</span> {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="w-full mx-auto flex flex-wrap">
                                <div class="w-2/6 pr-2">
                                    <div class="mb-3">
                                        <template v-if="user.picture">
                                            <img alt="profil-picture" class="object-cover object-center w-full rounded-lg" :src="user.picture_image_url">
                                        </template>
                                        <template v-else>
                                            <img alt="profil-picture" class="object-cover object-center w-full rounded-lg" src="https://api.nilskoepke.com/profile-image/?name=John+Doe&backgroundColor=rgb(33,194,87)">
                                        </template>
                                    </div>
                                    <div>
                                        <input type="file" @change="displayPreviewImages" ref="productPreviewInput" style="display:none" @input="form.picture = $event.target.files[0]">
                                        <button type="button" @click="$refs.productPreviewInput.click()" class="border border-gray-300 bg-gray-200 text-center rounded w-full py-2 hover:bg-gray-300 text-gray-500">Unggah Foto</button>
                                    </div>
                                </div>
                                <div class="w-4/6">
                                    <div class="ml-4">
                                        <div class="mb-8">
                                            <h3 class="font-bold mb-2 text-xl">Biodata Diri</h3>
                                            <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                                                <div class="flex flex-col pb-3">
                                                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nama</dt>
                                                    <dd class="text-lg font-semibold">
                                                        <input type="text" v-model="form.name" class="mt-1 block w-full online-none focus:ontline-none border-transparent focus:border-transparent focus:ring-0 p-0" required autofocus>
                                                    </dd>
                                                </div>
                                                <div class="flex flex-col py-3">
                                                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Tanggal Lahir</dt>
                                                    <dd class="text-lg font-semibold">
                                                        <input type="date" v-model="form.dob" class="mt-1 block w-full online-none focus:ontline-none border-transparent focus:border-transparent focus:ring-0 p-0" required>
                                                    </dd>
                                                </div>
                                                <div class="flex flex-col py-3">
                                                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Jenis Kelamin</dt>
                                                    <dd class="text-lg font-semibold">
                                                        <div class="flex">
                                                            <div class="flex items-center mr-4">
                                                                <input id="inline-radio" type="radio" value="1" v-model="form.gender" name="inline-radio-group" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                <label for="inline-radio" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pria</label>
                                                            </div>
                                                            <div class="flex items-center mr-4">
                                                                <input id="inline-2-radio" type="radio" value="2" v-model="form.gender" name="inline-radio-group" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                <label for="inline-2-radio" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Wanita</label>
                                                            </div>
                                                        </div>
                                                    </dd>
                                                </div>
                                                <div class="flex flex-col py-3">
                                                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Alamat</dt>
                                                    <dd class="text-lg font-semibold">
                                                        <textarea class="mt-1 block w-full online-none focus:ontline-none border-transparent focus:border-transparent focus:ring-0 p-0" row="5" v-model="form.address" placeholder="Mohon isi dengan alamat yang sebenar-benarnya">{{ form.address }}</textarea>
                                                    </dd>
                                                </div>
                                            </dl>
                                        </div>
                                        <div class="mb-8">
                                            <h3 class="font-bold mb-2 text-xl">Kontak</h3>
                                            <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                                                <div class="flex flex-col pb-3">
                                                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Email</dt>
                                                    <dd class="text-lg font-semibold">
                                                        <input type="email" v-model="form.email" class="mt-1 block w-full online-none focus:ontline-none border-transparent focus:border-transparent focus:ring-0 p-0" required>
                                                    </dd>
                                                </div>
                                                <div class="flex flex-col py-3">
                                                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">No. Handphone</dt>
                                                    <dd class="text-lg font-semibold">
                                                        <input type="text" v-model="form.phone" class="mt-1 block w-full online-none focus:ontline-none border-transparent focus:border-transparent focus:ring-0 p-0" placeholder="cth. 081234567890" required>
                                                    </dd>
                                                </div>
                                            </dl>
                                        </div>
                                        <div class="mb-8">
                                            <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Simpan</BreezeButton>
                                            <Link :href="route('user.setting.index')" class="ml-2 hover:underline">Kembali</Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </BreezeAuthenticatedLayout>
</template>
