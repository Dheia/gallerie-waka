<template>
    <file-pond
        name="imageFilepond"
        ref="pond"
        class="w-3/5 mx-auto"
        v-bind:allow-multiple="false"
        accepted-file-types="image/png, image/jpeg"
        v-bind:server="{
            url: '',
            timeout: 7000,
            process: {
                url: '/bo/upload-images',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $page.props.csrf_token,
                },
                withCredentials: false,
                onload: handleFilePondLoad,
                onerror: () => {},
            },
            remove: handleFilePondRemove,
            revert: handleFilePondRevert,
        }"
        v-bind:files="myFiles"
        v-on:init="handleFilePondInit"
    >
    </file-pond>
        
</template>

<script>
import axios from "axios";
import vueFilePond from "vue-filepond";
import "filepond/dist/filepond.min.css";
// Import FilePond plugins
// Please note that you need to install these plugins separately
// Import image preview plugin styles
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";
// Import the plugin code
import FilePondPluginFilePoster from "filepond-plugin-file-poster";
// Import the plugin styles
import "filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css";
// Import image preview and file type validation plugins
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";

const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview,
    FilePondPluginFilePoster
);

export default {
    props: ["modelValue"],
    emits: ['update:modelValue'],
    components: {
        FilePond,
    },
    data() {
        return {
            myFiles: [],
        };
    },
    activated() {
        console.log("beforeUpdate");
    },
    methods: {
        handleFilePondInit() {
            if (this.modelValue) {
                this.myFiles = [
                    {
                        source: this.modelValue,
                        options: {
                            type: "local",
                            metadata: {
                                poster: this.modelValue,
                            },
                        },
                    },
                ];
            } else {
                this.myFiles = [];
            }
        },
        handleFilePondLoad(response) {
            console.log(response)
            this.$emit('update:modelValue', response)
        },
        handleFilePondRemove(source, load, error) {
            this.$emit('update:modelValue', '')
            load();
        },
        handleFilePondRevert(uniqueId, load, error) {
            axios.post("/bo/upload-images-revert", {
                image: this.modelValue,
            });
            load();
        },
    },
};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
