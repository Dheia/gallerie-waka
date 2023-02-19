<script setup>
import { onMounted, ref } from 'vue';
import InputError from "@/Components/Forms/InputError.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";

defineProps({
    modelValue: String,
    label: String,
    messageError: String,
    inputId: String,
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <div>
        <InputLabel :for="inputId" :value="label" />
        <input
            :id="inputId"
            ref="input"
            type="text"
            class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)">
        <InputError class="mt-2" :message="messageError" />
    </div>
    
</template>
