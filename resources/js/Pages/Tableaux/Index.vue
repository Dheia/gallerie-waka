<template>
    <AppLayout title="Gestion tableaux">
        <Head title="Organizations" />
        <h1 class="mb-8 text-3xl font-bold">Tableaux</h1>
        <div>
            <search-filter :data="tabData" class="my-2">
                <Link class="btn btn-primary"  :href="route('tableaux.create')">
                    <span>Créer</span>
                    <span class="hidden md:inline">&nbsp;Tableau</span>
                </Link>
            </search-filter>
            <div class="bg-white rounded-md shadow overflow-x-auto text-gray-600">
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="text-left font-bold bg-slate-300">
                            <th v-for="(meta, key) in metas" :key="key" class="px-2 py-4">{{ meta.label }}</th>
                            <th class="py-3 px-6">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in tableaux.data" :key="item.id" class="hover:bg-gray-100 text-sm focus-within:bg-gray-100 group ">
                            <td v-for="(meta, key) in metas" :key="key" class="px-2 py-1">
                                <div v-if="meta.type == 'fileUploader'" class="w-12 h-12"><img :src="item[key]" /></div>
                                <div v-else @click="edit(item)" class="cursor-pointer" :class="meta.class">{{ item[key] }}</div>
                            </td>
                            <td class="py-3 px-6">
                                <div class="inline-flex items-center w-6 h-6">
                                    <div class="m-1 flex flex-col justify-between">
                                        <ChevronUpIcon class="h-4 w-4 hover:text-black cursor-pointer" @click="move('up', item)" />
                                        <ChevronDownIcon class="h-4 w-4 hover:text-black cursor-pointer" @click="move('down', item)" />
                                    </div>
                                    <div class="m-1 flex flex-col justify-between">
                                        <ChevronDoubleUpIcon class="h-4 w-4 hover:text-black cursor-pointer" @click="move('start', item)" />
                                        <ChevronDoubleDownIcon class="h-4 w-4 hover:text-black cursor-pointer" @click="move('end', item)" />
                                    </div>
                                    <div><ChevronRightIcon class="w-8 h-8 fill-gray-400 group-hover:fill-primary"/></div>
                                </div>
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <Pagination class="mt-6" :links="tableaux.links" />
        </div>
    </AppLayout>
</template>

<script>
import {Head, Link} from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Components/WakaForms/Partials/Pagination.vue";
import SearchFilter from "@/Components/WakaForms/Partials/SearchFilter.vue";
import {PlusIcon, TrashIcon, PencilIcon, ChevronRightIcon, ChevronUpIcon, ChevronDoubleUpIcon, ChevronDownIcon, ChevronDoubleDownIcon} from "@heroicons/vue/24/solid";

export default {
    inject: ['animate'],
    components: {
        AppLayout,
        Head,
        Link,
        Pagination,
        SearchFilter,
        PlusIcon,
        TrashIcon,
        PencilIcon,
        ChevronRightIcon,
        ChevronUpIcon,
        ChevronDoubleUpIcon,
        ChevronDownIcon,
        ChevronDoubleDownIcon,
    },
    props: {
        filter: Object,
        metas: Object,
        columnsConfig: Object,
        tableaux: Object,
        sort: Object,
    },
    data() {
        return {
            tabData: {
                filter: {
                    global: this.filter ? this.filter.global : null,
                },
                sort: this.sort.sort ? this.sort.sort : this.columnsConfig.defaultOrder,
                metas: this.metas,
            },
        };
    },
    mounted() {
        //console.log(this.filters);
        
    },
    methods: {
        edit(item) {
            //console.log(item);
            this.animate = "slide-fade"
            this.$inertia.get(`tableaux/${item.id}`);
        },
        move(modeOrientation, item) {
            let obj = {
                mode: modeOrientation,
                
            };
            this.$inertia.put(`tableaux/${item.id}/moveorder`, obj, {preserveScroll: true});
        },
    },
};
</script>
