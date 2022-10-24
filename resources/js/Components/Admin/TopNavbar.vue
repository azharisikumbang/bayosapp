<script setup>
import { usePage, useRemember } from '@inertiajs/inertia-vue3';
import { onBeforeUnmount, onMounted, onUnmounted } from 'vue';

defineProps({
  timeInterval: null,
  currentTime: null
});

const page = usePage();

onMounted(() => {
  // page.props.value.timeInterval = setInterval(() => {
    page.props.value.currentTime = Intl.DateTimeFormat(navigator.language, { dateStyle: 'full', timeStyle: 'long' }).format()
  // }, 1000);
});

onUnmounted(() => {
  // clearInterval(page.props.value.timeInterval);
})

</script>

<template>
    <div class="md:fixed md:w-full md:top-0 md:z-20 flex flex-row flex-wrap items-center bg-white p-6 border-b border-gray-300">
    
      <!-- logo -->
      <div class="flex-none w-2/5 flex flex-row items-center">
        <!-- <img src="img/logo.png" class="w-10 flex-none"> -->
        <strong class="capitalize ml-1 flex-1">Bayos | Administator</strong>

        <button id="sliderBtn" class="flex-none text-right text-gray-900 hidden md:block">
          <i class="fad fa-list-ul"></i>
        </button>
      </div>   

      <div class="flex justify-end w-3/5">
        <p>{{ $page.props.currentTime }}</p>
      </div>

    </div>
</template>