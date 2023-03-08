<template>
    <div v-if="links.length > 3" class="mx-auto">
        <div class="flex flex-wrap justify-center ">
        <template v-for="(link, key) in links">
            <div v-if="link.url === null" :key="key" class="mb-1 mr-1 px-4 py-3 text-gray-500 text-sm leading-4" v-html="link.label" />
            <button v-else :key="`link-${key}`" class="mb-1 mr-1 px-4 py-3 text-sm dark:text-gray-200 leading-4 hover:font-bold" :class="{ 'dark:text-white font-bold no-underline': link.active }" @click="submit(link.url)"  v-html="link.label" />
        </template>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {
  
    components: {
        Link,
    },
    props: {
            links: Array, 
    },
    methods: {
        submit(url) {
            this.$inertia.get(url, {} , {
                preserveScroll: true
            })
        }
        
    }
}
</script>
