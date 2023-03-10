<template>
    <wakaForm :class="config.form.formClass" :config="config" :formData="form" @submitWakaForm="submitForm" @wakaFormClose="wakaFormClose">
        <template #group-image="{field, key, formData}">
            <div v-if="form.metas.hasImage">
                <InputLabel :for="config.key" :value="field.label" />
                <FileUploaderForm :config="field" :form="formData" :formKey="key" />
                <InputError class="mt-2" :message="$page.props.errors ? $page.props.errors[key] : ''" />
            </div>
            <dv v-else></dv>
        </template>
    </wakaForm>
</template>

<script>
import wakaForm from "@/Components/WakaForms/Form.vue";
import SvgLoading from "@/Partials/Svgs/SvgLoading.vue";
import FileUploaderForm from "@/Components/WakaForms/Winputs/FileUploaderForm.vue";
import InputLabel from "@/Components/WakaForms/Wlabels/InputLabel.vue";
import InputError from "@/Components/WakaForms/Wlabels/InputError.vue";
import {Head, useForm, Link} from "@inertiajs/vue3";
export default {
    components: {
        wakaForm,
        SvgLoading,
        FileUploaderForm,
        InputLabel,
        InputError,
    },
    props: {
        formData: Object,
        isEdit: Boolean,
    },
    data() {
        return {
            form: this.formData.formData,
            config: this.formData.config,
        };
    },
    mounted() {
        console.log("edit mounted");
        //console.log(this.$page.props);
        this.animate = "slideInv-fade";
        //console.log(this.animate)
    },
    methods: {
        wakaFormClose() {
            (this.form = {}), this.$emit("wakaFormClose");
            this.$page.props.errors = {};
        },
        submitForm(form) {
            let formOptions = {
                preserveState: true,
                onSuccess: () => {
                    console.log("succes");
                    (this.form = {}), this.$emit("wakaFormClose");
                },
                onError: () => {
                    console.log("error");
                    console.log(this.formaData);
                },
            };
            if (this.isEdit) {
                let formObject = useForm(form);
                console.log(formObject)
                formObject.put(`/bo/pages/${form.id}`, formOptions);
            } else {
                let formObject = useForm(form);
                formObject.post(`/bo/pages`, formOptions);
            }
        },
    },
};
</script>
