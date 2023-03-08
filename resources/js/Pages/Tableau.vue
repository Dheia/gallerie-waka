<script setup>
import { Link } from '@inertiajs/vue3';
import {ref, onMounted} from "vue";
import Badge from "@/Partials/Btns/Badge.vue";
import ThemeSelector from "@/Components/Front/ThemeSelector.vue";

const show = ref(false);
const props = defineProps({
    data: Object,
    url: String,
});
onMounted(() => {
    show.value = true;
});
function goBack() {
    window.history.back();
}
</script>

<template>
    <div class="relative flex flex-col md:flex-row justify-center min-h-screen md:h-screen w-screen bg-white dark:bg-mydark dark:text-white">
        <transition enter-from-class="opacity-0 translate-x-4" enter-active-class="transition duration-1000">
            <div
                v-if="show"
                class="self-center p-8 w-full md:w-1/4 flex flex-col space-y-2 text-center md:text-right border-r border-r-mydark dark:border-r-white order-last md:order-first">
                <div class="font-heading">
                    Nom du tableau : <br /><span class="text-2xl font-bold">{{ data.name }}</span>
                </div>
                <div class="text-xs md:text-base">
                    <b>Description : </b><span>{{ data.description }}</span>
                </div>
                <div class="">
                    <b>Date : </b><span>{{ $date(data.painted_at).format("MMM YYYY") }}</span>
                </div>
                <div class="">
                    <b>Tags</b>
                    <ul>
                        <li v-for="tag in data.tableau_tags" :key="tag.id" href="/" class="hover:text-gray-500">
                            <Link class="text-sm" :href="'/?filter[inTags][]='+tag.slug">{{ tag.name }}</Link>
                        </li>
                    </ul>
                </div>

                <div>
                    <Badge class="font-heading" @clickOnBadge="goBack()"><template #label>Retour</template></Badge>
                </div>
            </div>
        </transition>
        <transition enter-from-class="opacity-0 -translate-x-4" enter-active-class="transition duration-1000">
            <div v-if="show" class="relative w-full md:w-3/4 h-1/2 md:h-full flex-grow mx-auto">
                <div class="absolute inset-0 p-4">
                    <a :href="url" target="_blank"><img class="object-contain drop-shadow-xl dark:drop-shadow-xl-white h-full w-full" :src="url" /></a>
                </div>
            </div>
        </transition>
    </div>
</template>
