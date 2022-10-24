<script setup>
import { usePage } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';


defineProps(['menus', 'products']);


const showChildMenu = (index) => {
    let open = usePage().props.value.menus[index].show_child;
    usePage().props.value.menus[index].show_child = !open;
}

const amoutToRupiah = (price) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
    }).format(price)
}

</script>
<template>
    <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="border-b border-gray-200">
            <div class="flex h-16 items-center">
                <button type="button" class="rounded-md bg-white p-2 text-gray-400 lg:hidden">
                    <span class="sr-only">Open menu</span>
                    <svg class="h-6 w-6" x-description="Heroicon name: outline/bars-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                    </svg>
                </button>
                <div class="ml-4 flex lg:ml-0">
                    <a href="#">
                        <span class="sr-only">Your Company</span>
                        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&amp;shade=600" alt="">
                    </a>
                </div>
                <div class="relative hidden lg:ml-8 lg:block lg:self-stretch">
                    <div class="flex h-full space-x-8">
                        <template v-for="(menu, index) in menus" :key="index">
                            <template v-if="menu.children.length < 1">
                                <a href="#" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">{{ menu.display_name }}</a>
                            </template>
                            <template v-else>
                                <div class="flex">
                                    <div class="relative flex">
                                        <button @click="showChildMenu(index)" class="relative z-10 -mb-px flex items-center border-b-2 pt-px text-sm font-medium transition-colors duration-200 ease-out border-indigo-600 text-indigo-600">
                                            {{ menu.display_name }}
                                        </button>
                                    </div>
                                    <div class="absolute inset-x-0 top-full text-sm text-gray-500" v-show="menu.show_child">
                                        <div class="relative bg-white shadow-lg p-4 mt-4 border-indigo-600 border-b-2">
                                            <ul class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                <li class="hover:text-indigo-600 transition-colors duration-200 ease-out" v-for="submenu in menu.children">
                                                    <a href="#">{{ submenu.display_name }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </template>
                        
                        <!--  -->
                    </div>
                </div>
                <div class="ml-auto flex items-center">
                    <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                        <Link :href="route('login')" class="text-sm font-medium text-gray-700 hover:text-gray-800">Masuk</Link>
                        <span class="h-6 w-px bg-gray-200" aria-hidden="true"></span>
                        <Link :href="route('register')" class="text-sm font-medium text-gray-700 hover:text-gray-800">Daftarkan Akun</Link>
                    </div>

                    <!-- Search -->
                    <div class="flex lg:ml-6">
                        <a href="#" class="p-2 text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Search</span>
                        <svg class="h-6 w-6" x-description="Heroicon name: outline/magnifying-glass" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
        </svg>
                        </a>
                    </div>

                    <!-- Cart -->
                    <div class="ml-4 flow-root lg:ml-6">
                        <a href="#" class="group -m-2 flex items-center p-2">
                        <svg class="h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500" x-description="Heroicon name: outline/shopping-bag" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"></path>
        </svg>
                        <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">0</span>
                        <span class="sr-only">items in cart, view bag</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- cta -->
    <section>
        <!-- component -->
        <div class="flex justify-center items-center py-12 px-4 sm:px-6 2xl:px-0 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->
            <div class="flex flex-col lg:flex-row justify-center items-center space-y-6 lg:space-y-0">
                <div class="w-80 sm:w-auto flex flex-col justify-start items-start">
                    <div>
                        <p class="text-3xl xl:text-4xl font-semibold leading-9 text-gray-800 dark:text-white">Renovate your home</p>
                    </div>
                    <div class="mt-4 lg:w-4/5 xl:w-3/5">
                        <p class="text-base leading-6 text-gray-600 dark:text-white">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                    </div>
                    <div class="mt-16 w-full">
                        <button class="px-4 bg-gray-900 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200  flex justify-between items-center w-full lg:w-72 h-14 text-white hover:bg-gray-700 focus:ring-2 outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 dark:hover:bg-gray-100">
                            <p class="text-xl font-medium leading-5 ">See More</p>
                            <svg class="dark:text-gray-900" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.66663 16H25.3333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M20 21.3333L25.3333 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M20 10.6667L25.3333 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>
      
                <div class="flex flex-col sm:flex-row jusitfy-center items-center sm:space-x-5 xl:space-x-8 space-y-4 sm:space-y-0">
                    <div class="w-80">
                        <img class="hidden lg:block" src="/storage/product-images/1K2mH8pXxEpxJUkbLVaF91IckyzJiFXJ29u9YHB9.jpg" alt="sofa" />
                        <img class="w-80 sm:w-auto lg:hidden" src="/storage/product-images/1K2mH8pXxEpxJUkbLVaF91IckyzJiFXJ29u9YHB9.jpg" alt="sofa" />
                    </div>
                    <div class="flex flex-col justify-center items-center space-y-4 sm:space-y-0 sm:space-y-5 lg:space-y-5 xl:space-y-8">
                        <div class="w-80">
                            <img class="hidden lg:block" src="/storage/product-images/GvP1AaADj1z5pPnJZo4d5R5JOwZ38O3abQ2PW8tt.jpeg" alt="chairs" />
                            <img class="w-80 sm:w-auto lg:hidden" src="/storage/product-images/GvP1AaADj1z5pPnJZo4d5R5JOwZ38O3abQ2PW8tt.jpeg" alt="chairs" />
                        </div>
                        <div class="w-80">
                            <img class="hidden lg:block" src="/storage/product-images/3Zud1kY7mRm0dIK35yqY0F2oNQPrPX2cjBRTtcct.jpeg" alt="chairs" />
                            <img class="w-80 sm:w-auto lg:hidden" src="/storage/product-images/3Zud1kY7mRm0dIK35yqY0F2oNQPrPX2cjBRTtcct.jpeg" alt="chairs" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cta -->

    <main>
        <div class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="text-2xl text-center font-bold tracking-tight text-gray-900">Produk Kami</h2>

            <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                <div class="group relative" v-for="product in products" v-if="products.length > 0">
                    <div class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-80">
                        <img :src="'/storage/' + product.thumbnail_location" :alt="product.name" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                    </div>
                    <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-sm text-gray-700 font-bold">
                                <a href="#">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ product.name.toUpperCase() }}
                                </a>
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">{{ product.category.display_name }}</p>
                        </div>
                        <p class="text-sm font-medium text-gray-900">{{ amoutToRupiah(product.price) }}</p>
                    </div>
                </div>

            <!-- More products... -->
            </div>
        </div>
    </main>

    <section class="text-gray-600 body-font relative bg-gray-100 ">
        <div class="">
            <h2 class="text-2xl text-center font-bold tracking-tight text-gray-900 pt-24">Temukan Kami</h2>
        </div>
        <div class="container px-5 py-24 mx-auto flex sm:flex-nowrap flex-wrap mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="lg:w-2/3 md:w-1/2 bg-gray-300 rounded-lg overflow-hidden sm:mr-10 p-10 flex items-end justify-start relative">
            <iframe width="100%" height="100%" class="absolute inset-0" frameborder="0" title="map" marginheight="0" marginwidth="0" scrolling="no" src="https://maps.google.com/maps?width=100%&height=600&hl=en&q=%C4%B0zmir+(My%20Business%20Name)&ie=UTF8&t=&z=14&iwloc=B&output=embed" style="filter: grayscale(1) contrast(1.2) opacity(0.4);"></iframe>
            <div class="bg-white relative flex flex-wrap py-6 rounded shadow-md">
                <div class="lg:w-1/2 px-6">
                <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">ADDRESS</h2>
                <p class="mt-1">Photo booth tattooed prism, portland taiyaki hoodie neutra typewriter</p>
                </div>
                <div class="lg:w-1/2 px-6 mt-4 lg:mt-0">
                <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">EMAIL</h2>
                <a class="text-indigo-500 leading-relaxed">example@email.com</a>
                <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs mt-4">PHONE</h2>
                <p class="leading-relaxed">123-456-7890</p>
                </div>
            </div>
            </div>
            <div class="lg:w-1/3 md:w-1/2 bg-white px-8 shadow flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
            <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Feedback</h2>
            <p class="leading-relaxed mb-5 text-gray-600">Post-ironic portland shabby chic echo park, banjo fashion axe</p>
            <div class="relative mb-4">
                <label for="name" class="leading-7 text-sm text-gray-600">Name</label>
                <input type="text" id="name" name="name" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <div class="relative mb-4">
                <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                <input type="email" id="email" name="email" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <div class="relative mb-4">
                <label for="message" class="leading-7 text-sm text-gray-600">Message</label>
                <textarea id="message" name="message" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
            </div>
            <button class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Button</button>
            <p class="text-xs text-gray-500 mt-3">Chicharrones blog helvetica normcore iceland tousled brook viral artisan.</p>
            </div>
        </div>
    </section>

    <footer class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto flex md:items-center lg:items-start md:flex-row md:flex-nowrap flex-wrap flex-col">
            <div class="w-64 flex-shrink-0 md:mx-0 mx-auto text-center md:text-left md:mt-0 mt-10">
            <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-xl">Tailblocks</span>
            </a>
            <p class="mt-2 text-sm text-gray-500">Air plant banjo lyft occupy retro adaptogen indego</p>
            </div>
            <div class="flex-grow flex flex-wrap md:pr-20 -mb-10 md:text-left text-center order-first">
            <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">CATEGORIES</h2>
                <nav class="list-none mb-10">
                <li>
                    <a class="text-gray-600 hover:text-gray-800">First Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Second Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Third Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Fourth Link</a>
                </li>
                </nav>
            </div>
            <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">CATEGORIES</h2>
                <nav class="list-none mb-10">
                <li>
                    <a class="text-gray-600 hover:text-gray-800">First Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Second Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Third Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Fourth Link</a>
                </li>
                </nav>
            </div>
            <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">CATEGORIES</h2>
                <nav class="list-none mb-10">
                <li>
                    <a class="text-gray-600 hover:text-gray-800">First Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Second Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Third Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Fourth Link</a>
                </li>
                </nav>
            </div>
            <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">CATEGORIES</h2>
                <nav class="list-none mb-10">
                <li>
                    <a class="text-gray-600 hover:text-gray-800">First Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Second Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Third Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Fourth Link</a>
                </li>
                </nav>
            </div>
            </div>
        </div>
        <div class="bg-gray-100">
            <div class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row">
            <p class="text-gray-500 text-sm text-center sm:text-left">© 2020 Tailblocks —
                <a href="https://twitter.com/knyttneve" rel="noopener noreferrer" class="text-gray-600 ml-1" target="_blank">@knyttneve</a>
            </p>
            <span class="inline-flex sm:ml-auto sm:mt-0 mt-2 justify-center sm:justify-start">
                <a class="text-gray-500">
                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                </svg>
                </a>
                <a class="ml-3 text-gray-500">
                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                    <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                </svg>
                </a>
                <a class="ml-3 text-gray-500">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                </svg>
                </a>
                <a class="ml-3 text-gray-500">
                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                    <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                    <circle cx="4" cy="4" r="2" stroke="none"></circle>
                </svg>
                </a>
            </span>
            </div>
        </div>
    </footer>
</template>