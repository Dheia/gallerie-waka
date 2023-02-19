<template>
    <TransitionRoot as="template" :show="isOpen">
        <Dialog as="div" class="relative z-10" @close="setIsOpen(false)">
            <TransitionChild
                as="template"
                enter="ease-out duration-500"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in duration-500"
                leave-from="opacity-100"
                leave-to="opacity-0">
                <div class="fixed inset-0 bg-white/80 dark:bg-black/80 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild
                        as="template"
                        enter="ease-out duration-500"
                        enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        enter-to="opacity-100 translate-y-0 sm:scale-100"
                        leave="ease-in duration-500"
                        leave-from="opacity-100 translate-y-0 sm:scale-100"
                        leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel
                            class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                            <slot />
                            <OutlineBtn class="mr-1" @click="setIsOpen(false)">Deactivate</OutlineBtn>
                            <OutlineBtn @click="setIsOpen(false)">Annuler</OutlineBtn>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
import {TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle, DialogDescription} from "@headlessui/vue";
import OutlineBtn from "@/Partials/Btns/OutlineBtn.vue";

export default {
    props: {
        isOpen: Boolean,
    },
    components: {
        Dialog,
        DialogPanel,
        DialogTitle,
        DialogDescription,
        TransitionRoot,
        TransitionChild,
        OutlineBtn,
    },
    methods: {
        setIsOpen(value) {
            console.log("close");
            this.$emit("openOver", value);
        },
    },
};
</script>
