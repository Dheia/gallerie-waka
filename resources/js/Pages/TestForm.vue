<template>
    <div>
        <wakaForm :class="config.form.formClass" :config="config" :formData="formData" @submit="submitForm">
          <template  #label-name></template >
        </wakaForm>
    </div>
</template>

<script>
import wakaForm from "@/Components/WakaForms/Form.vue";

export default {
    components: {
        wakaForm,
    },
    data() {
        return {
            config: {
                form: {
                    url: "/bo/mycontroller{id}",
                    formClass: "flex flex-wrap",
                },
                fields: {
                    name: {
                        type: "label",
                        label: "Nom",
                        required: true,
                        class: "w-full md:w-1/2",
                        // blocClass: "m-2 p-2"
                    },
                    slug: {
                        type: "label",
                        label: "slug",
                        required: true,
                        class: "w-full md:w-1/2",
                    },
                    text: {
                        type: "richeditor",
                        label: "contenu",
                    },
                    image: {
                        type: "fileuploader",
                        label: "Charger une image",
                    },
                },
            },
            formData: {
                name: "Hello World",
                slug: "hello-world",
                text: "<p>Bonjour à tous</p>",
            },
        };
    },
    methods: {
        submitForm(data) {
            //console.log("Form submitted:", data);
        },
    },
};
</script>
