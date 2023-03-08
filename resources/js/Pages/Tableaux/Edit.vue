<template>
<AppLayout title="Gestion tableaux">
        <Head title="editer un tableau" />
        <h1 class="mb-8 text-3xl font-bold">Editer un tableaux</h1>
    <div class="max-w-4xl">
        <wakaForm :class="config.form.formClass" :config="config" :formData="form" @submitWakaForm="submitForm">
            <template #label-name></template>
        </wakaForm>
    </div>
</AppLayout>
</template>

<script>
import wakaForm from "@/Components/WakaForms/Form.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head,useForm } from '@inertiajs/vue3';

export default {
    inject: ['animate'],
    components: {
        wakaForm,
        AppLayout,
        Head,
    },
    props: {
        config: Object,
        formData: Object,
    },
    data() {
        return {
            form: this.formData,
            testconfig: {
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
                    description: {
                        type: "richeEditor",
                        label: "contenu",
                    },
                    image: {
                        type: "fileUploader",
                        label: "Charger une image",
                    },
                },
            },
            testformData: {
                name: "Hello World",
                slug: "hello-world",
                description: "<p>Bonjour à tous</p>",
            },
        };
    },
    mounted() {
        console.log("edit mounted");
        //console.log(this.$page.props);
        this.animate = "slideInv-fade"
        //console.log(this.animate)
    },
    methods: {
        submitForm(form) {
            let formOptions = {
                preserveState: true,
                onSuccess: () => {
                    console.log('succes')
                    console.log(this.$page)
                },
                onError: () => {
                    console.log('error')

                    
                    console.log(this.formaData)
                },
            };
            let formObject = useForm(form)
            formObject.put(`/bo/tableaux/${form.id}`,formOptions)
        },
    },
};
</script>
