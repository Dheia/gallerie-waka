<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Les tableaux
            </h2>
        </template>
        <div class="py-12">
            <WkNotification :message="$page.props.flash.message" />
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <OutlineBtn @click="openForm()">
                    Nouveau<PlusIcon class="ml-2 -mr-1 h-5 w-5"/>
                </OutlineBtn>
            </div>
        </div>
        <div class="pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Table :resource="tableaux">
                    <template #cell(actions)="{ item: tableau }">
                        <div class="inline-flex">
                            <OutlineBtn class="m-1" @click="openForm(tableau)">
                                <PencilIcon class="w-4 h-4"/>
                            </OutlineBtn>
                            <OutlineBtnDanger class="m-1" @click="deleteItem(tableau)">
                                <TrashIcon class="w-4 h-4"/>
                            </OutlineBtnDanger>
                        </div>
                    </template>
                    <template #cell(images)="{ item: tableau }">
                        <div class="inline-flex">
                            <img class="w-10 h-10" width="100" height="100" v-if="tableau.images" :src="tableau.images"/>
                        </div>
                    </template>
                </Table>
            </div>
        </div>
        <TableauForm :isOpen="isFormOpen" :isEdit="isFormEdit" :form="formObject" :isWorking="isWorking" @formsave="saveItem" @formclose="closeModal"></TableauForm>
    </AppLayout>
</template>

<script>
import axios from "axios";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";
import TableauForm from "@/Components/Tableau/Form.vue";
import WkNotification from "@/Components/WkNotification.vue";
import OutlineBtnDanger from "@/Partials/Btns/OutlineBtnDanger.vue";
import OutlineBtn from "@/Partials/Btns/OutlineBtn.vue";
import { Head, Link, useForm } from '@inertiajs/vue3';
import { PlusIcon, TrashIcon, PencilIcon     } from '@heroicons/vue/24/outline'
import { router } from '@inertiajs/vue3'

const defaultFormObject =  useForm({
    name: '',
    description: '',
    image:null,
});

export default {
    props: ["tableaux"],
    components: {
        AppLayout,
        Table,
        TableauForm,
        WkNotification,
        OutlineBtn, OutlineBtnDanger,
        PlusIcon, TrashIcon, PencilIcon
    },
    
    data()
        {
            return {
                isFormOpen: false,
                isFormEdit: false,
                formObject: defaultFormObject,
                isWorking: false,
                srcsImages: {}
            }
        },
        methods: {
            saveItem(item)
            {
                this.isWorking =  true
                console.log(this.formObject)
                let formOptions = {
                    onSuccess: () => {
                        this.formObject.reset('name', 'description', 'image'),
                        this.closeModal(); 
                        this.isWorking =  false       
                    },
                    onError: () => {
                        this.isWorking =  false   
                    }
                }
                console.log('item  : : : : ',item)
                console.log(this.formObject.image)
                if(item.id){
                    console.log(item.id);
                    this.$inertia.put(`/tableaux/${item.id}`, this.formObject, formOptions);
                } else {
                    this.formObject.post('/tableaux', formOptions);
                }
                
            },
            closeModal()
            {
                this.isFormOpen = false;
                this.isFormEdit = false
            },
            openForm(item)
            {
                this.isFormOpen = true;
                this.isFormEdit = !!item;
                this.formObject = item ? useForm(item) : defaultFormObject;
                console.log(this.formObject)
            },
            deleteItem(item)
            {
                console.log(item.id)
                if(window.confirm('are you sure?')){
                    this.$inertia.delete(`/tableaux/${item.id}`)
                }
            }
        }

};
</script>
