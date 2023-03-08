<template>
    <div
        class="rounded-full h-8 w-8 overflow-hidden   bg-gray-700 text-sm p-1 text-white focus:outline-none focus:ring-2 cursor-pointer focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 "
       
        @click="changeTheme"
    >
        <transition-group name="darkTransition">
            <!-- Light -->
            <MoonIcon
                v-if="darkMode === 'light'"
                class="h-6 w-6"
                key="light"
                alt="lightMode"
            />
            <!-- Dark -->
            <SunIcon
                v-if="darkMode === 'dark'"
                class="h-6 w-6"
                key="dark"
                alt="darkMode"
            />
        </transition-group>
    </div>
</template>

<script setup>
/* Main Functions */
import {defineComponent} from "vue";
import darkModeFn from "@/Functions/darkMode";
import {MoonIcon, SunIcon} from "@heroicons/vue/24/outline";
const {darkMode, appearingMode, changeTheme} = darkModeFn();
</script>

<style scoped>
.darkTransition-enter-active,
.darkTransition-leave-active {
    transition: all 500ms ease-in-out;
}

.darkTransition-enter-from {
    opacity: 0;
    transform: translateY(1rem) ;
}

.darkTransition-leave-to {
    opacity: 0;
    transform: translateY(-5rem) ;
}

.darkTransition-leave-from {
    opacity: 1;
    transform: translateY(0);
}

.darkTransition-enter-to {
    opacity: 1;
    transform: translateY(0);
}


</style>
