<template>
  <div class="w-full" :id="formKey">
    <TipTap v-model="form[formKey]" />
  </div>
</template>

<script>
import TipTap from "@/Components/WakaForms/Advanced/TipTap.vue";
export default {
    components: {
        TipTap,
    },
    props: {
        config: {
            type: Object,
            required: true,
        },
        form: {
            type: Object,
            required: true,
        },
        formKey: {
            type: String,
            required: true,
        },
    },
};
</script>
