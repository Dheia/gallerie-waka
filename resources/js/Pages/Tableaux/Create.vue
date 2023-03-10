<template>
<AppLayout title="Gestion tableaux">
        <template #header>
                <h2 class="py-2 font-semibold text-xl whitespace-nowrap text-gray-800 leading-tight">Nouveau Tableau</h2>
        </template>
    <div class="max-w-4xl p-8">
        <wakaForm :class="config.form.formClass" :config="config" :formData="form" @submitWakaForm="submitForm" @wakaFormClose="goBack()">
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
            formObject.post(`/bo/tableaux`,formOptions)
        },
        goBack() {
            window.history.back();
        }
    },
};
</script>
