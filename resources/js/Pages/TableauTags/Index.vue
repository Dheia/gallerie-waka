<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Les Tags de tableaux
            </h2>
        </template>
        <div class="py-12">
            <WkNotification :message="$page.props.flash.message" />
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <OutlineBtn @click="openForm()">
                    Nouveau Tag de tableau<PlusIcon class="ml-2 -mr-1 h-5 w-5" />
                </OutlineBtn>
                <div class="pt-12 flex ">
                    <div class="w-1/3">
                        <draggable
                            :list="tableauTags.data"
                            item-key="order_column"
                            handle=".handle"
                            @change="onEndReorder"
                        >
                            <template #item="{ element }">
                                <ul
                                    class="border border-gray-400 flex w-full items-center text-gray-500 bg-white text-sm hover:bg-gray-100 focus-within:bg-gray-100"
                                >
                                    <Bars2Icon class="w-6 h-6 handle cursor-pointer"/>
                                    
                                    
                                    <li class="py-3 px-6 flex-1 whitespace-nowrap">
                                        Nom : {{ element.name }}<br>slug: <i class="text-xs">{{ element.slug }}</i>
                                    </li>
                                    
                                     <li class="py-3 px-6 w-32 flex justify-end">
                                        <PencilIcon class="w-6 h-6 cursor-pointer hover:stroke-black" @click="openForm(element)"/>
                                        <div class=" bg-green-500 w-6 h-6 text-xs mx-2 rounded-full flex items-center"><div class="mx-auto text-white">{{ element.tableaux_count }}</div></div>
                                        <TrashIcon class="w-6 h-6 cursor-pointer hover:stroke-red-600" @click="deleteItem(element)"/>
                                    </li>
                                </ul>
                            </template>
                        </draggable>
                    </div>
                </div>
            </div>
        </div>
        <Modal :isOpen="isFormOpen" :dialogTitle="modalTitle" panelClass="max-w-4xl">
            <ModelForm
                :isOpen="isFormOpen"
                :isEdit="isFormEdit"
                :form="formObject"
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
import Modal from "@/Partials/Overs/Modal.vue";
import WkNotification from "@/Components/Bo/WkNotification.vue";
import OutlineBtnDanger from "@/Partials/Btns/OutlineBtnDanger.vue";
import OutlineBtn from "@/Partials/Btns/OutlineBtn.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { PlusIcon, TrashIcon, PencilIcon,Bars2Icon } from "@heroicons/vue/24/outline";
import { router } from "@inertiajs/vue3";
import draggable from "vuedraggable";

const defaultFormObject = useForm({
    name: "",
    description: "",
    image: null,
});

export default {
    props: ["tableauTags"],
    components: {
        AppLayout,
        Table,
        ModelForm,
        WkNotification,
        OutlineBtn,
        OutlineBtnDanger,
        PlusIcon,
        TrashIcon,
        PencilIcon,
        Bars2Icon,
        draggable,
        Modal,
    },

    data() {
        return {
            isFormOpen: false,
            isFormEdit: false,
            formObject: defaultFormObject,
            isWorking: false,
            drag: false,
            modalTitle: "Modification tag",
        };
    },
    methods: {
        saveItem(item) {
            this.isWorking = true;
            let formOptions = {
                onSuccess: () => {
                    this.formObject.reset("name", "slug"), this.closeModal();
                    this.isWorking = false;
                },
                onError: () => {
                    this.isWorking = false;
                },
            };
            if (item.id) {
                this.$inertia.put(
                    `/tableauTags/${item.id}`,
                    this.formObject,
                    formOptions
                );
            } else {
                this.formObject.post("/bo/tableauTags", formOptions);
            }
        },
        closeModal() {
            this.isFormOpen = false;
            this.isFormEdit = false;
        },
        openForm(item) {
            this.isFormOpen = true;
            this.isFormEdit = !!item;
            this.formObject = item ? useForm(item) : defaultFormObject;
            if (!this.isFormEdit) this.modalTitle = "Modification d'un tag";
            
            
        },
        deleteItem(item) {
            if (window.confirm("are you sure?")) {
                this.$inertia.delete(`/tableauTags/${item.id}`);
            }
        },
        onEndReorder(e) {
             let obj = {
                order: this.tableauTags.data.map(({ id }) => id)
            }
            //console.log(obj)
            axios.post('/bo/tableauxTags',obj)
        }
    },
};
</script>
