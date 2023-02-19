<template>
    <div v-if="isOpen" class="w-full bg-white">
        <div class="text-xl font-bold p-2">{{ contentTitle }}</div>
        <slot  />
    </div>
    <div v-else class="w-full flex items-center min-h-[150px]">
        <div class="text-xl font-bold p-2 w-full text-center">Choisissez une page à éditer</div>
    </div>

</template>
<script>
import {
} from "@headlessui/vue";

export default {
    props: {
        isOpen: Boolean,
        contentTitle: String,
        panelClass: {
            type: String,
            default: 'max-w-2xl'
        } 
    },
    components: {
    },
};
</script>
