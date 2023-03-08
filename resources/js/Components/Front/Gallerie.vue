

<template>

    <transition-group
      appear
      enter-active-class="transform-gpu"
      enter-class="opacity-0 scale-0 "
      enter-to-class="opacity-100 scale-100 "
      leave-active-class="transform-gpu"
      leave-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-0"
      tag="a"
      class="relative flex flex-wrap justify-center  w-full bg-white dark:bg-mydark sm:items-center sm:pt-0"
    >
       <Link  v-for="(tableau) in tableaux.data" :key="tableau.slug" :href="`/tableau/${tableau.slug}`" class=" cursor-pointer w-96 h-64 bg-gray-100 dark:bg-[#141414] m-1 p-6 flex  overflow-hidden transition-all duration-300">
            <img :src="tableau.image_big_thumb" class="object-contain hover:scale-125 transition-all mx-auto drop-shadow-lg dark:drop-shadow-lg-white overflow-hidden  duration-150 ease-in-out " />
       </Link>

    </transition-group>
</template>
<script setup>
import { Link } from '@inertiajs/vue3'
import { onMounted, ref } from 'vue';
const show = ref(false);
defineProps({
    tableaux: Object,
});
onMounted(() => {
    show.value = true
});


</script>