<template>
    <wakaForm :class="config.form.formClass" :config="config" :formData="form" @submitWakaForm="submitForm" @wakaFormClose="wakaFormClose" >
        </wakaForm>
</template>

<script>
import wakaForm from "@/Components/WakaForms/Form.vue";
import SvgLoading from "@/Partials/Svgs/SvgLoading.vue";
import {Head, useForm, Link} from "@inertiajs/vue3";
export default {
    components: {
        wakaForm,
        SvgLoading,
    },
    props: {
        formData: Object,
        isEdit: Boolean,
    },
    data() {
        return {
            form: this.formData.formData,
            config: this.formData.config
            }
        },
    mounted() {
        console.log("edit mounted");
        //console.log(this.$page.props);
        this.animate = "slideInv-fade"
        //console.log(this.animate)
    },
    methods: {
        wakaFormClose() {
            this.form = {},
            this.$emit("wakaFormClose");
            this.$page.props.errors = {}
        },
        submitForm(form) {
            let formOptions = {
                preserveState: true,
                onSuccess: () => {
                    console.log('succes')
                    this.form = {},
                    this.$emit("wakaFormClose");
                },
                onError: () => {
                    console.log('error')
                    console.log(this.formaData)
                },
            };
            if(this.isEdit) {
                let formObject = useForm(form)
                formObject.put(`/bo/tableautags/${form.id}`,formOptions)
            } else {
                let formObject = useForm(form)
                formObject.post(`/bo/tableautags`,formOptions)
            }
            
        },
    },
};
</script>
