<template>
  <div class="relative">
      <file-pond
        name="imageFilepond"
        ref="pond"
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
    </div>
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

const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview, FilePondPluginFilePoster);

export default {
    components: {
        FilePond,
    },
    data() {
        return {
            myFiles: [],
        };
    },
    props: {
        config: {
            type: Object,
            required: true,
        },
        form: {
            type: Object,
            required: true,
        },
        formKey: {
            type: String,
            required: true,
        },
    },
    methods: {
        handleFilePondInit() {
            console.log("handleFilePondInit")
            console.log(this.form)
            console.log(this.formKey)
            console.log(this.form[this.formKey])
            if (this.form[this.formKey]) {
                this.myFiles = [
                    {
                        source: this.form[this.formKey],
                        options: {
                            type: "local",
                            metadata: {
                                poster: this.form[this.formKey],
                            },
                        },
                    },
                ];
            } else {
                this.myFiles = [];
            }
        },
        handleFilePondLoad(response) {
            this.form[this.formKey] = response;
        },
        handleFilePondRemove(source, load, error) {
          this.form[this.formKey] = null
          load();
        },
        handleFilePondRevert(uniqueId, load, error) {
            axios.post("/bo/upload-images-revert", {
                image: this.form[this.formKey],
            });
            load();
        },
    },
};
</script>
<style >

</style>