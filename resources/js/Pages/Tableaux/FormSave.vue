<template>
    <form @submit.prevent="submit">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                <div class="mb-4">
                    <InputLabel for="name" value="Nom : " />
                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-96"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Entrez un nom"
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="mb-4">
                    <InputLabel for="description" value="Description : " />
                    <TextArea
                        id="description"
                        v-model="form.description"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="description"
                        placeholder="Entrez un nom"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.description"
                    />
                </div>
                <div class="mb-4">
                    <InputLabel for="slug" value="Slug : " />
                    <Multiselect
                        v-model="form.tagIds"
                        valueProp="id"
                        label="name"
                        mode="tags"
                        :close-on-select="false"
                        :options="tagData"
                    />
                </div>
                <div class="mb-4">
                    <label
                        for="formBookImage"
                        class="block text-gray-700 text-sm font-bold mb-2"
                        >Images :</label
                    >
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
                                url: '/upload-images',
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
            </div>
        </div>

        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                <button
                    type="button"
                    v-show="!isEdit"
                    @click="$emit('formsave', form)"
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                    :disabled="isWorking"
                >
                    <SvgLoading :show="isWorking" />
                    Save
                </button>
            </span>

            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                <button
                    type="button"
                    v-show="isEdit"
                    @click="$emit('formsave', form)"
                    class="inline-flex items-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                    :disabled="isWorking"
                >
                    <SvgLoading :show="isWorking" />

                    Update
                </button>
            </span>
            <span
                class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto"
            >
                <button
                    type="button"
                    @click="$emit('formclose')"
                    class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                    :disabled="isWorking"
                >
                    Cancel
                </button>
            </span>
        </div>
    </form>
</template>

<script>
import axios from "axios";
import Multiselect from "@vueform/multiselect";
import InputError from "@/Components/Forms/InputError.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import TextArea from "@/Components/Forms/TextArea.vue";
//
import SvgLoading from "@/Partials/Svgs/SvgLoading.vue";
//
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
    props: ["form", "tagData", "isOpen", "isEdit", "isWorking"],
    components: {
        InputError,
        InputLabel,
        TextInput,
        TextArea,
        SvgLoading,
        FilePond,
        Multiselect,
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
            if (this.form.media?.length) {
                this.myFiles = [
                    {
                        source: this.form.media[0].original_url,
                        options: {
                            type: "local",
                            metadata: {
                                poster: this.form.media[0].original_url,
                            },
                        },
                    },
                ];
            } else {
                this.myFiles = [];
            }
        },
        handleFilePondLoad(response) {
            this.form.image = response;
        },
        handleFilePondRemove(source, load, error) {
            this.form.image = "";
            load();
        },
        handleFilePondRevert(uniqueId, load, error) {
            axios.post("bo/upload-images-revert", {
                image: this.form.image,
            });
            load();
        },
    },
};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
