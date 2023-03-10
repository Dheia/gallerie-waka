<template>
    <div class="w-full flex space-x-4 justify-end">
        <div class="flex justify-start space-x-4 items-center">
            <div class="flex bg-white shadow">
                <input class="" autocomplete="off" type="text" name="search" placeholder="Rechercher..." v-model="formMeta.filter.global" />
            </div>
            <Popover class="relative ">
                <PopoverButton class="btn btn-primary btn-inline m-0"><span>Trier par : {{ formMeta.sort }}</span><ChevronUpDownIcon class="ml-2 -mr-1 h-6 w-6" /></PopoverButton>
                <PopoverPanel class="absolute z-10 w-64">
                    <div class="p-2 w-full bg-gray-200 shadow-xl">
                        <div v-for="(field, key) in data.metas" :key="key" :value="field.label">
                            <div class="flex py-1" v-if="field.ordorable">
                                <div class="flex-1 text-sm pr-1">{{ field.label }}</div>
                                <PopoverButton @click="updateSort(key)"
                                    ><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0l-3.75-3.75M17.25 21L21 17.25" /></svg
                                ></PopoverButton>
                                <PopoverButton @click="updateSort('-' + key)"
                                    ><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h5.25m5.25-.75L17.25 9m0 0L21 12.75M17.25 9v12" /></svg
                                ></PopoverButton>
                            </div>
                        </div>
                    </div>
                </PopoverPanel>
            </Popover>
            <button class="rounded-btn fill-gray-300 border border-gray-300 hover:border-gray-600 hover:fill-gray-600 w-10 h-10" @click="reset()">
                <RiEraserFill class=" mx-auto w6 h-6"/>
            </button>
        </div>
        <slot />
    </div>
</template>

<script>
import {Popover, PopoverButton, PopoverPanel} from "@headlessui/vue";
import {SortAscendingIcon, SortDescendingIcon, ChevronUpDownIcon} from "@heroicons/vue/24/solid";
import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";
import mapValues from "lodash/mapValues";
import { RiEraserFill } from "vue-remix-icons";
export default {
    components: {
        Popover,
        PopoverButton,
        PopoverPanel,
        SortAscendingIcon,
        SortDescendingIcon,
        ChevronUpDownIcon,
        throttle,
        RiEraserFill,
    },
    data() {
        return {
            formMeta: {
                filter: this.data.filter,
                sort: this.data.sort || "id",
            },
        };
    },
    props: {
        data: Object,
        meta: Object,
        modelValue: String,
        maxWidth: {
            type: Number,
            default: 300,
        },
    },
    watch: {
        formMeta: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get("tableaux", pickBy(this.formMeta), {preserveState: true});
            }, 250),
        },
    },
    methods: {
        updateSort(ev) {
            this.formMeta.sort = ev;
        },
        reset() {
            this.formMeta.filter.global = null;
            this.formMeta.sort = this.data.metas.defaultOrder;
                
        },
    },
    mounted() {
        // console.log(this.data)
    },
};
</script>
