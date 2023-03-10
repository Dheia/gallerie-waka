<template>
    <AppLayout title="Dashboard">
        <template #header-title>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Les Pages</h2>
                <div>
                    <button class="btn btn-primary btn-inline" @click="createForm()"><span>Nouvelle page</span><PlusIcon class="ml-2 -mr-1 h-8 w-8" /></button>
                </div>
            </div>
        </template>
        <div class="p-4">
            <WkNotification :message="$page.props.flash.message" />
            <div class="mx-auto sm:px-6 mt-8">
                <div class="pt-12 flex">
                    <div class="w-1/4 max-h-[600px] overflow-y-auto">
                        <div v-for="element in pages.data" :key="element.id">
                            <ul class="border border-gray-400 flex w-full items-center text-gray-500 bg-white text-sm hover:bg-gray-100 focus-within:bg-gray-100">
                                <li class="py-3 px-6 flex-1 whitespace-nowrap">
                                    Nom : {{ element.name }}<br />slug: <i class="text-xs">{{ element.slug }}</i>
                                </li>

                                <li class="py-3 px-6 w-32 flex justify-end">
                                    <PencilIcon class="w-6 h-6 cursor-pointer hover:stroke-black" @click="editForm(element.id)" />
                                    <TrashIcon class="w-6 h-6 cursor-pointer hover:stroke-red-600" @click="deleteItem(element)" />
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="w-full lg:w-2/3 px-2 py-6 lg:py-0 ">
                        <EditCreate class="bg-white rounded shadow-sm p-2" v-if="isFormOpen" :isEdit="isFormEdit" :formData="formData" @wakaFormClose="closeForm"></EditCreate>
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
    props: ["pages"],
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
            modalTitle: "Modification pages",
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
            let formData = await axios.get("/bo/pages/" + id);
            this.formData = formData.data;
            this.isFormOpen = true;
            this.isFormEdit = true;
        },
        async createForm() {
            this.isFormOpen = false;
            this.isFormEdit = false;
            this.formData = {};
            let formData = await axios.get("/bo/pages/create");
            console.log(formData.data);
            this.formData = formData.data;
            this.isFormOpen = true;
        },
        // deleteItem(item) {
        //     if (window.confirm("are you sure?")) {
        //         this.$inertia.delete(`/bo/pages/${item.id}`, {preserveScroll:true});
        //     }
        // },
        onEndReorder(e) {
            let obj = {
                order: this.tableauTags.data.map(({id}) => id),
            };
            axios.post("/bo/pages/neworder", obj, {preserveScroll: true});
        },
    },
};
</script>
