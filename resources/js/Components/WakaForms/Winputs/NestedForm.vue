<template>
    <div :class="config.nestedClass ? config.nestedClass : 'w-full'">
        <div v-for="(field, key) in config['attributs']" :key="key" :class="field.class ? field.class : 'w-full'" >
            <div :class="field.blocClass ? field.blocClass : 'm-1 p-1'">
                <InputLabel :for="config.key" :value="field.label" />
                <component :is="getComponentName(field.type)" :config="field" :form="form[formKey]" :formKey="key" />
                <!-- <InputError class="mt-2" :message="$page.props.errors ? $page.props.errors[formKey][key] : ''" />  -->
            </div>
        </div>
    </div>
</template>

<script>
import LabelForm from "@/Components/WakaForms/Winputs/LabelForm.vue";
import TextAreaForm from "@/Components/WakaForms/Winputs/TextAreaForm.vue";
import RicheEditorForm from "@/Components/WakaForms/Winputs/RicheEditorForm.vue";
import FileUploaderForm from "@/Components/WakaForms/Winputs/FileUploaderForm.vue";
import TagListForm from "@/Components/WakaForms/Winputs/TagListForm.vue";
import CheckBoxForm from "@/Components/WakaForms/Winputs/CheckBoxForm.vue";
import InputLabel from "@/Components/WakaForms/Wlabels/InputLabel.vue";
import InputError from "@/Components/WakaForms/Wlabels/InputError.vue";
export default {
    components: {
        LabelForm,
        RicheEditorForm,
        FileUploaderForm,
        TagListForm,
        TextAreaForm,
        InputLabel,
        InputError,
        CheckBoxForm
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
        console.log("mounted label nested----------------");
        console.log(this.form[this.formKey]);
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
        getSlotName(string, key) {
            const name = string + "-" + key;
            return name;
        },
    },
};
</script>
