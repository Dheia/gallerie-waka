<template>
    <WkNotification :message="$page.props.flash.message" />
    <button @click="openEmail()" class="rounded-md px-3 py-2 font-medium  hover:bg-gray-700 hover:text-white">M'écrire</button>
    <TransitionRoot as="template" :show="isOpen">
        <Dialog as="div" class="absolute top-0 left-0 w-full h-screen z-10" @close="isOpen = false">
            <TransitionChild
                as="template"
                enter="ease-out duration-500"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in duration-500"
                leave-from="opacity-100"
                leave-to="opacity-0">
                <div class="fixed inset-0 bg-white/80 dark:bg-black/90 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto ">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild
                        as="template"
                        enter="ease-out duration-500"
                        enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        enter-to="opacity-100 translate-y-0 sm:scale-100"
                        leave="ease-in duration-500"
                        leave-from="opacity-100 translate-y-0 sm:scale-100"
                        leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel class="relative transform overflow-hidden text-left  sm:my-8 sm:w-full sm:max-w-lg sm:p-6  bg-white dark:bg-black border border-gray-700">
                            <div class="w-full  text-2xl py-6 dark:text-white"><p>Envoyer un email</p></div>
                            <form @submit.prevent="submit">
                                <div class="mb-4">
                                    <InputLabel for="email" value="Email : " class="dark:text-white" />
                                    <TextInput
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        class="mt-1 block w-full text-dark "
                                        required
                                        rows="2"
                                        autofocus
                                        autocomplete="email"
                                        placeholder="Votre email" />
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>
                                <div class="mb-4">
                                    <InputLabel for="subject" value="Le sujet de votre message : " class="dark:text-white" />
                                    <TextInput
                                        id="subject"
                                        v-model="form.subject"
                                        type="text"
                                        class="mt-1 block w-full  text-dark"
                                        required
                                        rows="1"
                                        autofocus
                                        autocomplete="subject"
                                        placeholder="Le sujet de votre message" />
                                    <InputError class="mt-2" :message="form.errors.subject" />
                                </div>
                                <div class="mb-4">
                                    <InputLabel for="contenu" value="Contenu : " class="dark:text-white" />
                                    <TextArea
                                        id="contenu"
                                        v-model="form.contenu"
                                        type="text"
                                        class="mt-1 block w-full  text-dark"
                                        required
                                        autofocus
                                        autocomplete="message"
                                        placeholder="Votre message..." />
                                    <InputError class="mt-2" :message="form.errors.contenu" />
                                </div>
                            </form>
                            <div class="flex justify-end  space-x-2">
                                <button
                                    type="button"
                                    @click="sendEmail()"
                                    class="btn btn-front"
                                    :disabled="isWorking">
                                    <SvgLoading :show="isWorking" />

                                    Envoyer
                                </button>
                                <button class="btn btn-front" @click="isOpen = false">Fermer</button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
import {TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle, DialogDescription} from "@headlessui/vue";
import {useForm} from "@inertiajs/vue3";
import InputError from "@/Components/Forms/InputError.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import TextArea from "@/Components/Forms/TextArea.vue";
//
import SvgLoading from "@/Partials/Svgs/SvgLoading.vue";
import WkNotification from "@/Components/WkNotification.vue";

const defaultFormObject = useForm({
    email: "",
    subject: "",
    contenu: "",
});

export default {
    components: {
        Dialog,
        DialogPanel,
        DialogTitle,
        DialogDescription,
        TransitionRoot,
        TransitionChild,
        InputError,
        InputLabel,
        TextInput,
        TextArea,
        SvgLoading,
        WkNotification,
    },
    data() {
        return {
            isOpen: false,
            form: defaultFormObject,
            isWorking: false
        };
    },
    methods: {
        openEmail() {
            this.isOpen = true;
        },
        sendEmail() {
            //console.log("envoyer le mail");
            let formOptions = {
                onSuccess: () => {
                    this.form.reset("email", "subject", "contenu"), (this.isOpen = false);
                    this.isWorking = false;
                    //console.log("succès");
                    //console.log(this.$page.props)
                },
                onError: () => {
                    this.isWorking = false;
                    //console.log("erreur");
                    //console.log(this.$page.props)
                },
            };
            this.form.post("/mail", formOptions);
        },
    },
};
</script>
