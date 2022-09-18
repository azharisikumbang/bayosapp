<script setup>
defineProps(['headers', 'contents']);

</script>
<template>
    <table class="min-w-max w-full table-auto">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal" v-for="header in headers">
                <th class="py-3 px-6 text-left">{{ header }}</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            <slot />
        </tbody>
    </table>
</template>