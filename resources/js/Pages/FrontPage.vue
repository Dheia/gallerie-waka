<script setup>
import {Head, Link} from "@inertiajs/vue3";
import Badge from "@/Partials/Btns/Badge.vue";

const props = defineProps({
    page: Object,
});
function goBack() {
    window.history.back();
}
</script>
<template>
    <Head :title="page.name" />
    <div class="dark:text-gray-300 text-gray-600 bg-white dark:bg-mydark p-4">
        <div class="max-w-4xl py-8 mx-auto">
            <Badge class="font-heading" @clickOnBadge="goBack()"><template #label>Retour</template></Badge>
        </div>
        <div v-html="page.content" class="prose dark:prose-invert mx-auto max-w-4xl"></div>
        <div class="max-w-4xl py-8 mx-auto">
            <Badge class="font-heading" @clickOnBadge="goBack()"><template #label>Retour</template></Badge>
        </div>
        <div class="text-center text-gray-500 p-8">2023 - Notilac - <Link class="underline dark:hover:text-white hover:text-mydark" :href="'page/mentions'">Mentions</Link></div>
    </div>
</template>

