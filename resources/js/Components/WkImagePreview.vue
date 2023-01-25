<template>
    <!-- Global notification live region, render this permanently at the end of the document -->
    <img width="100" height="100" v-if="this.srcOptimised" :src="this.srcOptimised"/>
</template>

<script>

import axios from "axios";
export default {
    props: ["imageSrc"],
    data() {
        return {
            srcOptimised: null,
        };
    },
    watch: {
        imageSrc(newValue) {
            console.log('newValue')
            this.searchImage()
        }
    },
    methods: {
        async searchImage() {
            console.log(this.imageSrc);

            let value = null;
            if (!this.imageSrc) {
                return "rien";
            }
            if (this.imageSrc[0]) {
                value = this.imageSrc[0]["id"];
                if (value) {
                        let imageUrdQuery = await axios.get("/image-thumb/" + value)
                        console.log(imageUrdQuery)
                        this.srcOptimised = imageUrdQuery.data;
                        console.log(this.srcOptimised)
                    }
                }
        },
    },
};
</script>
