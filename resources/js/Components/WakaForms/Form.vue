<template>
    <form @submit.prevent="null">
        <div v-for="(field, key) in config.fields" :key="key" :class="field.class ? field.class : 'w-full'">
            <div :class="field.blocClass ? field.blocClass : 'm-1 p-1'">
                <slot :name="getSlotName('label', key)">
                    <InputLabel :for="config.key" :value="field.label" />
                </slot>
                <slot :name="getSlotName('component', key)">
                    <component :is="getComponentName(field.type)" :config="field" :form="formData" :formKey="key" />
                </slot>
                <slot :name="getSlotName('error', key)">
                    <InputError class="mt-2" :message="$page.props.errors ? $page.props.errors[key] : ''" />
                </slot>
            </div>
        </div>
        <div class="m-1 ml-auto">
            <button class="btn btn-primary" v-if="$page.props.urlPrev" @click="goBack()" preserve-scroll>Abandonner</button>
            <button class="btn btn-primary" @click="submitForm" preserve-scroll>Sauvegarder</button>
        </div>
    </form>
</template>

<script>
import LabelForm from "./Winputs/LabelForm.vue";
import TextAreaForm from "./Winputs/TextAreaForm.vue";
import RicheEditorForm from "./Winputs/RicheEditorForm.vue";
import FileuploaderForm from "./Winputs/FileuploaderForm.vue";
import TagListForm from "./Winputs/TagListForm.vue";
import NestedForm from "./Winputs/NestedForm.vue"
import InputLabel from "@/Components/WakaForms/Wlabels/InputLabel.vue";
import InputError from "@/Components/WakaForms/Wlabels/InputError.vue";
import {Head, useForm, Link} from "@inertiajs/vue3";
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
        FileuploaderForm,
        TagListForm,
        TextAreaForm,
        InputLabel,
        InputError,
        Link,
        NestedForm
    },
    methods: {
        getComponentName(type) {
            switch (type) {
                case "textArea":
                    return "TextAreaForm";
                case "richeEditor":
                    return "RicheEditorForm";
                case "fileUploader":
                    return "FileuploaderForm";
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
            window.history.back();
        },
    },
    mounted() {
        console.log("Je mount form");
        console.log(this.formData);
    },
};
</script>
