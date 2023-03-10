<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Les Tags de tableaux</h2>
                <div>
                    <button class="btn btn-primary btn-inline" @click="createForm()"><span>Nouveau Tag de tableau</span><PlusIcon class="ml-2 -mr-1 h-8 w-8" /></button>
                </div>
            </div>
        </template>
        <div class="p-4">
            <WkNotification :message="$page.props.flash.message" />
            <div class=" mx-auto sm:px-6">
                <div class="pt-2 lg:pt-12 flex flex-wrap">
                    <div class="w-full lg:w-1/3 max-h-[200px] lg:max-h-[600px] overflow-y-auto">
                        <draggable :list="tableauTags.data" item-key="order_column" handle=".handle" @change="onEndReorder">
                            <template #item="{element}">
                                <ul class="border border-gray-400 flex w-full items-center text-gray-500 bg-white text-sm hover:bg-gray-100 focus-within:bg-gray-100">
                                    <Bars2Icon class="w-6 h-6 handle cursor-pointer" />

                                    <li class="py-3 px-6 flex-1 whitespace-nowrap">
                                        Nom : {{ element.name }}<br />slug: <i class="text-xs">{{ element.slug }}</i>
                                    </li>

                                    <li class="py-3 px-6 w-32 flex justify-end">
                                        <PencilIcon class="w-6 h-6 cursor-pointer hover:stroke-black" @click="editForm(element.id)" />
                                        <div class="bg-green-500 w-6 h-6 text-xs mx-2 rounded-full flex items-center">
                                            <div class="w-full text-center text-white">{{ element.count }}</div>
                                        </div>
                                        <TrashIcon class="w-6 h-6 cursor-pointer hover:stroke-red-600" @click="deleteItem(element)" />
                                    </li>
                                </ul>
                            </template>
                        </draggable>
                    </div>
                    <div class="w-full lg:w-2/3 px-2 py-6 lg:py-0 ">
                        <EditCreate class=" bg-white rounded shadow-sm p-2" v-if="isFormOpen" :isEdit="isFormEdit" :formData="formData" @wakaFormClose="closeForm"></EditCreate>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import axios from "axios";
import AppLayout from "@/Layouts/AppLayout.vue";
import EditCreate from "./EditCreate.vue";
import WkNotification from "@/Components/Bo/WkNotification.vue";
import {PlusIcon, TrashIcon, PencilIcon, Bars2Icon} from "@heroicons/vue/24/outline";
import draggable from "vuedraggable";

export default {
    props: ["tableauTags"],
    components: {
        AppLayout,
        EditCreate,
        WkNotification,
        PlusIcon,
        TrashIcon,
        PencilIcon,
        Bars2Icon,
        draggable,
    },

    data() {
        return {
            isFormOpen: false,
            isFormEdit: false,
            formData: {},
            isWorking: false,
            drag: false,
            modalTitle: "Modification tag",
        };
    },
    methods: {
        closeForm() {
            this.isFormOpen = false;
            this.isFormEdit = false;
        },
        async editForm(id) {
            this.isFormOpen = false;
            this.isFormEdit = false;
            this.formData = {};
            let formData = await axios.get("/bo/tableautags/" + id);
            this.formData = formData.data;
            this.isFormOpen = true;
            this.isFormEdit = true;
        },
        async createForm() {
            this.isFormOpen = false;
            this.isFormEdit = false;
            this.formData = {};
            let formData = await axios.get("/bo/tableauxtags/create");
            console.log(formData.data);
            this.formData = formData.data;
            this.isFormOpen = true;
        },
        deleteItem(item) {
            if (window.confirm("are you sure?")) {
                this.$inertia.delete(`/bo/tableautags/${item.id}`, {preserveScroll: true});
            }
        },
        onEndReorder(e) {
            let obj = {
                order: this.tableauTags.data.map(({id}) => id),
            };
            axios.post("/bo/tableautags/neworder", obj, {preserveScroll: true});
        },
    },
};
</script>
