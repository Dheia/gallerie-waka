<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Les Pages
            </h2>
        </template>
        <div class="py-12">
            <WkNotification :message="$page.props.flash.message" />
            <div class="p-1 max-w-7xl mx-auto">
                <div class="pt-12 grid grid-cols-4 gap-x-2">
                    <div class=" col-span-1 p-2">
                        <div v-for="page in pages" :key="page.id">
                                <ul
                                    class="border border-gray-400 inline-flex w-full items-center text-gray-500 bg-white whitespace-nowrap text-sm hover:bg-gray-100 focus-within:bg-gray-100"
                                >
                                    <li class="py-3 px-6 w-3/6">
                                        {{ page.name }}
                                    </li>
                                     <li class="py-3 px-6 w-2/6 flex justify-end">
                                        <PencilIcon class="w-6 h-6 cursor-pointer hover:stroke-black" @click="openForm(page)"/>
                                    </li>
                                </ul>
                        </div>
                    </div>
                    <div class="col-span-3 w-full  p-1  ">
                        <div class="border border-dashed ">
                            <Content :isOpen="isFormOpen" contentTitle="Modifier la page" panelClass="max-w-4xl">
                            <Form
                                :form="formObject"
                                :staticOptions="staticOptions"
                                :isWorking="isWorking"
                                @formsave="saveItem"
                                @formclose="closeModal"
                            ></Form>
                        </Content>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import axios from "axios";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";
import Form from "./Form.vue";
import Content from "@/Partials/Overs/Content.vue";
import WkNotification from "@/Components/Bo/WkNotification.vue";
import OutlineBtnDanger from "@/Partials/Btns/OutlineBtnDanger.vue";
import OutlineBtn from "@/Partials/Btns/OutlineBtn.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { PlusIcon, TrashIcon, PencilIcon,Bars2Icon } from "@heroicons/vue/24/outline";
import { router } from "@inertiajs/vue3";
import draggable from "vuedraggable";

const defaultFormObject = useForm({
    name: "",
    slug: "",
    title: "",
    contenu: "",
    image: null,
});
const defaultStaticOptions = useForm({
    redirect: "",
    image: false,
    contentMode: "",
});

export default {
    props: ["pages"],
    components: {
        AppLayout,
        Table,
        
        WkNotification,
        OutlineBtn,
        OutlineBtnDanger,
        PlusIcon,
        TrashIcon,
        PencilIcon,
        Bars2Icon,
        draggable,
        Content,
        Form,
    },

    data() {
        return {
            isFormOpen: false,
            isFormEdit: false,
            formObject: defaultFormObject,
            isWorking: false,
            staticOptions: {}
        };
    },
    methods: {
        saveItem(item) {
            this.isWorking = true;
            let formOptions = {
                onSuccess: () => {
                    this.formObject.reset("name", "slug", 'title', 'content', 'image'), this.closeModal();
                    this.isWorking = false;
                },
                onError: () => {
                    this.isWorking = false;
                },
            };
            if (item.id) {
                console.log(this.formObject)
                this.formObject.put(`pages/${item.id}`,formOptions)
            }
        },
        closeModal() {
            this.isFormOpen = false;
            this.isFormEdit = false;
        },
        openForm(item) {
            this.isFormOpen = true;
            this.formObject = item ? useForm(item) : defaultFormObject; 
            this.staticOptions = item ? useForm(item.staticOptions) : defaultStaticOptions
        },
        
        
    },
};
</script>
