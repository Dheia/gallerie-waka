<template>
    <form @submit.prevent="null">
        <div v-for="(field, key) in config.fields" :key="key" :class="field.class ? field.class : 'w-full'">
            <div :class="field.blocClass ? field.blocClass : 'm-1 p-1'">
                <slot :name="getSlotName('group', key)" :field="field" :key="key" :formData="formData">
                    <InputLabel :for="config.key" :value="field.label" />
                    <component :is="getComponentName(field.type)" :config="field" :form="formData" :formKey="key" />
                    <InputError class="mt-2" :message="$page.props.errors ? $page.props.errors[key] : ''" />
                </slot>
            </div>
        </div>

        <div class="w-full flex space-x-1 justify-end pt-8">
            <button class="btn btn-primary" v-if="$page.props.urlPrev" @click="goBack()" preserve-scroll>Abandonner</button>
            <button class="btn btn-primary" @click="submitForm" preserve-scroll>Sauvegarder</button>
        </div>
    </form>
</template>

<script>
import LabelForm from "@/Components/WakaForms/Winputs/LabelForm.vue";
import TextAreaForm from "@/Components/WakaForms/Winputs/TextAreaForm.vue";
import RicheEditorForm from "@/Components/WakaForms/Winputs/RicheEditorForm.vue";
import FileUploaderForm from "@/Components/WakaForms/Winputs/FileUploaderForm.vue";
import TagListForm from "@/Components/WakaForms/Winputs/TagListForm.vue";
import CheckBoxForm from "@/Components/WakaForms/Winputs/CheckBoxForm.vue";
import NestedForm from "@/Components/WakaForms/Winputs/NestedForm.vue"
import InputLabel from "@/Components/WakaForms/Wlabels/InputLabel.vue";
import InputError from "@/Components/WakaForms/Wlabels/InputError.vue";
export default {
    props: {
        config: {
            type: Object,
            required: true,
        },
        formData: {
            type: Object,
            default: () => ({}),
        },
    },
    components: {
        LabelForm,
        RicheEditorForm,
        FileUploaderForm,
        TagListForm,
        TextAreaForm,
        InputLabel,
        InputError,
        NestedForm,
        CheckBoxForm
    },
    methods: {
        getComponentName(type) {
            switch (type) {
                case "textArea":
                    return "TextAreaForm";
                case "checkBox":
                    return "CheckBoxForm";
                case "richeEditor":
                    return "RicheEditorForm";
                case "fileUploader":
                    return "FileUploaderForm";
                case "tagList":
                    return "TagListForm";
                case "nestedform":
                    return "NestedForm";
                default:
                    return "LabelForm";
            }
        },
        submitForm() {
            this.$emit("submitWakaForm", this.formData);
        },
        getSlotName(string, key) {
            const name = string + "-" + key;
            return name;
        },
        goBack() {
            this.$emit("wakaFormClose");
        },
    },
    mounted() {
        console.log("Je mount form");
        console.log(this.formData);
    },
};
</script>
