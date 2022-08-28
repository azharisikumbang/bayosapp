<script setup>
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'icon']);
</script>

<template>
    <Link :href="href" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i :class="icon"></i>  
        <slot />
    </Link>
</template>
