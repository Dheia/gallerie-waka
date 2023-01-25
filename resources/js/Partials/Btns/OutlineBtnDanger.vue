<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center rounded-md border border-red-500 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-offset-2">
        <slot/>
    </button>
</template>
