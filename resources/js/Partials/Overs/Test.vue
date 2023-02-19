<script setup>
const props = defineProps({
    isOpen: Boolean,
    dialogTitle: String,

});

// setup code
</script>
<template>
    <div>
        <transition
            enter-from-class="opacity-0"
            leave-to-class="opacity-0"
            enter-active-class="transition duration-300"
            leave-active-class="transition duration-300"
        >
            <div
                class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400"
                v-if="isOpen"
            >
                <div
                    class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
                >
                    <div class="fixed inset-0 transition-opacity">
                        <div
                            class="absolute inset-0 bg-gray-500 opacity-75"
                        ></div>
                    </div>
                    <!-- This element is to trick the browser into centering the modal contents. -->
                    <span
                        class="hidden sm:inline-block sm:align-middle sm:h-screen"
                    ></span
                    >​
                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle max-w-4xl w-full"
                        role="dialog"
                        aria-modal="true"
                        aria-labelledby="modal-headline"
                    >
                        <slot />
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>
