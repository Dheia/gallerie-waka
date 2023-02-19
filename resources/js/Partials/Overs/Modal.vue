<template>
    <!-- Wrap your dialog in a `TransitionRoot`. -->
    <TransitionRoot :show="isOpen" as="template">
        <Dialog>
            <!-- Wrap your backdrop in a `TransitionChild`. -->
            <TransitionChild
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-300 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black/30" />
            </TransitionChild>

            <!-- Wrap your panel in a `TransitionChild`. -->
            <TransitionChild
                enter="duration-300 ease-out"
                enter-from="opacity-0 scale-95"
                enter-to="opacity-100 scale-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100 scale-100"
                leave-to="opacity-0 scale-95"
            >
                <!-- Full-screen scrollable container -->
                <div class="fixed inset-0 overflow-y-auto">
                    <!-- Container to center the panel -->
                    <div
                        class="flex min-h-full items-center justify-center p-4"
                    >
                        <!-- The actual dialog panel -->
                        <DialogPanel
                            class="w-full bg-white rounded-lg overflow-hidden shadow-xl"
                            :class="panelClass"
                        >
                            <DialogTitle class="text-xl font-bold p-2">{{ dialogTitle }}</DialogTitle>
                            <slot />
                        </DialogPanel>
                    </div>
                </div>
            </TransitionChild>
        </Dialog>
    </TransitionRoot>
</template>
<script>
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";

export default {
    props: {
        isOpen: Boolean,
        dialogTitle: String,
        panelClass: {
            type: String,
            default: 'max-w-2xl'
        } 
    },
    components: {
        TransitionRoot,
        TransitionChild,
        Dialog,
        DialogPanel,
        DialogTitle,
    },
};
</script>
