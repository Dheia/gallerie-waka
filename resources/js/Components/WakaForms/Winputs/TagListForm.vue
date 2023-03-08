<template>
    <Multiselect 
        class="w-full"
        v-model="form[formKey]"
        :valueProp="config.valueProp"
        :label="config.label"
        :mode="config.mode"
        :close-on-select="config.closeOnSelect"
        :options="config.optionsData" 
        />
</template>

<script>
import Multiselect from "@vueform/multiselect";

export default {
    components: {
        Multiselect,
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
    mounted() {
        console.log(this.form[this.formKey])
        console.log(this.config.options)
    }
};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>