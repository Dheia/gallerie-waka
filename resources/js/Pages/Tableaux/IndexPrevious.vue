<template>
    <AppLayout title="Gestion tableaux">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Les tableaux
            </h2>
        </template>
        <div class="py-12">
            <WkNotification :message="$page.props.flash.message" />
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <OutlineBtn @click="openForm()">
                    Nouveau tableau<PlusIcon class="ml-2 -mr-1 h-5 w-5" />
                </OutlineBtn>
            </div>
        </div>
        <div class="pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Table :meta="tableaux" :preserve-scroll="true">
                    <template #body>
                        <tr v-for="(tableau, key) in tableaux.data" :key="key" >
                            <td class="py-3 px-6">{{ tableau.order_column }}</td>
                            <td class="py-3 px-6">{{ tableau.name }}</td> 
                        </tr>
                    </template>
                </Table>
            </div>
        </div>
        <Modal :isOpen="isFormOpen" :dialogTitle="modalTitle">
            <ModelForm
                :isOpen="isFormOpen"
                :isEdit="isFormEdit"
                :form="formObject"
                :tagData="tagDatas"
                :isWorking="isWorking"
                @formsave="saveItem"
                @formclose="closeModal"
            ></ModelForm>
        </Modal>
    </AppLayout>
</template>

<script>
import axios from "axios";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";
import ModelForm from "./Form.vue";
import WkNotification from "@/Components/WkNotification.vue";
import OutlineBtnDanger from "@/Partials/Btns/OutlineBtnDanger.vue";
import OutlineBtn from "@/Partials/Btns/OutlineBtn.vue";
import Modal from "@/Partials/Overs/Modal.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { PlusIcon, TrashIcon, PencilIcon, ChevronUpIcon ,ChevronDoubleUpIcon,ChevronDownIcon,ChevronDoubleDownIcon    } from "@heroicons/vue/24/outline";


const defaultFormObject = useForm({
    name: "",
    description: "",
    tagIds: [],
    image: null,
});

export default {
    props: ["tableaux"],
    components: {
        AppLayout,
        Table,
        ModelForm,
        WkNotification,
        OutlineBtn,
        OutlineBtnDanger,
        PlusIcon,
        TrashIcon,
        PencilIcon,ChevronUpIcon ,ChevronDoubleUpIcon,ChevronDownIcon,ChevronDoubleDownIcon,
        Modal,
    },

    data() {
        return {
            isFormOpen: false,
            isFormEdit: false,
            tagDatas: {},
            formObject: defaultFormObject,
            isWorking: false,
            srcsImages: {},
            modalTitle: "Modification tableau",
        };
    },
    methods: {
        saveItem(item) {
            this.isWorking = true;
            console.log(this.formObject);
            let formOptions = {
                onSuccess: () => {
                    this.formObject.reset(
                        "name",
                        "description",
                        "image",
                        "tagIds"
                    ),
                    this.closeModal();
                    this.isWorking = false;
                    console.log(this.$page.props)
                },
                onError: () => {
                    this.isWorking = false;
                    console.log(this.formObject.errors)
                },
            };
            if (item.id) {
                // console.log("image "+item.image);
                // console.log("image form "+this.formObject.image)
                this.formObject.put(`tableaux/${item.id}`, formOptions)
            } else {
                this.formObject.post("/bo/tableaux", formOptions);
            }
        },
        closeModal() {
            this.isFormOpen = false;
            this.isFormEdit = false;
        },
        async openForm(item) {
            console.log(item)
            let getTableauData = await axios.get("/bo/tableauxTags/getall");
            this.tagDatas = getTableauData.data;
            if (!this.isFormEdit) this.modalTitle = "Création d'un tableau";
            this.formObject = item ? useForm(item) : defaultFormObject;
            console.log(this.formObject.tagIds);
            this.isFormOpen = true;
            this.isFormEdit = !!item;
        },
        
        deleteItem(item) {
            console.log(item);
            if (window.confirm("are you sure?")) {
                this.$inertia.delete(`tableaux/${item.id}`);
            }
        },
        move(modeOrientation, item) {
            let obj = {
                mode: modeOrientation
            }
            console.log(item);
            this.$inertia.put(`tableaux/${item.id}/moveorder`,obj)
        },
        explodetags(tags) {
            return tags.map(({ name }) => name).join(", ");
        },
    },
};
</script>
