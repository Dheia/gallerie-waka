<template>
    <Disclosure as="nav" class="border-t border-t-middle border-b border-b-middle" v-slot="{open}">
        <div class="mx-auto max-w-7xl px-2">
            <div class="relative flex h-16 items-center justify-between">
                <div class="flex flex-1 justify-start px-2">
                    <div class="w-full max-w-lg lg:max-w-xs">
                        <label for="search" class="sr-only">Chercher un tableau</label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <MagnifyingGlassIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                            </div>
                            <input
                                id="search"
                                v-model="searchDatas.filter.global"
                                name="search"
                                class="block w-full rounded-md border border-transparent bg-gray-700 py-2 pl-10 pr-3 leading-5  placeholder-gray-400 focus:border-white focus:bg-white focus:text-gray-900 focus:outline-none focus:ring-white sm:text-sm"
                                placeholder="Chercher un tableau"
                                type="search" />
                        </div>
                    </div>
                </div>
                <div class="flex items-center px-2 lg:px-0">
                    <div class="hidden lg:ml-6 lg:block">
                        <div class="flex space-x-4 font-heading">
                            <button
                                v-html="showBio ? 'Cacher Bio' : 'Ma bio'"
                                @click="$emit('toogleBio')"
                                class="rounded-md px-3 py-2 font-medium  hover:bg-gray-700 hover:text-white"></button>
                            <Mail />
                        </div>
                    </div>
                </div>

                <div class="flex lg:hidden">
                    <!-- Mobile menu button -->
                    <DisclosureButton
                        class="inline-flex items-center justify-center rounded-md p-2  hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                        <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
                    </DisclosureButton>
                </div>
                <div class="hidden lg:ml-4 lg:block">
                    <div class="flex items-center">
                        <ThemeSelector/>

                        <!-- Profile dropdown -->
                        <Menu as="div" class="relative ml-4 flex-shrink-0">
                            <div>
                                <MenuButton
                                    class="flex rounded-full bg-gray-700 text-sm p-1 text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                                    <span class="sr-only">Ouvrir le menu</span>
                                    <LockClosedIcon class="h-6 w-6" aria-hidden="true" />
                                </MenuButton>
                            </div>
                            <transition
                                enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95">
                                <MenuItems
                                    v-if="$page.props.user"
                                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <MenuItem v-slot="{active}">
                                        <a :href="route('tableaux.index')" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Gestion des tableaux</a>
                                    </MenuItem>
                                    <MenuItem v-slot="{active}">
                                        <a href="#" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Gestion des tags</a>
                                    </MenuItem>
                                    <MenuItem v-slot="{active}">
                                        <button @click="logout()" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
                                            <b>Quitter</b> la gestion du site
                                        </button>
                                    </MenuItem>
                                </MenuItems>
                                <MenuItems
                                    v-else
                                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <MenuItem v-slot="{active}">
                                        <a :href="route('tableaux.index')" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Accès sécurisé</a>
                                    </MenuItem>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>
        </div>

        <DisclosurePanel class="lg:hidden">
            <div class="space-y-1 px-2 pt-2 pb-3 font-heading">

                <DisclosureButton
                    @click="$emit('toogleBio')"
                    as="button"
                    class="w-full text-left block rounded-md px-3 py-2 text-base font-medium t hover:bg-gray-700 hover:text-white">{{ showBio ? 'Cacher Bio' : 'Ma bio' }}</DisclosureButton>
                <DisclosureButton as="a" href="#" class="block rounded-md px-3 py-2 text-base font-medium  hover:bg-gray-700 hover:text-white"
                    >M'écrire</DisclosureButton
                >
                <DisclosureButton
                    @click="$emit('toogleBio')"
                    href="'pages/mentions"
                    class="w-full text-left block rounded-md px-3 py-2 text-base font-medium  hover:bg-gray-700 hover:text-white">Mentions légales</DisclosureButton>
            </div>
            <div class="border-t border-gray-700 pt-4 pb-3" v-if="$page.props.user">
                <div class="flex items-center px-5"></div>
                <div class="mt-3 space-y-1 px-2">
                    <DisclosureButton as="a" :href="route('tableaux.index')" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
                        >Gestion des tableaux</DisclosureButton
                    >
                    <DisclosureButton as="a" :href="route('tags.index')" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
                        >Gestion des tags</DisclosureButton
                    >
                    <DisclosureButton as="a" :href="route('pages.index')" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
                        >Gestion des pages</DisclosureButton
                    >
                    <form @submit.prevent="logout">
                        <DisclosureButton as="button" @click="logout()" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
                            >Quitter la gestion du site</DisclosureButton
                        >
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-4 pb-3" v-else>
                <div class="flex items-center px-5"></div>
                <div class="mt-1 space-y-1 px-2">
                    <DisclosureButton as="a" :href="route('tableaux.index')" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">
                        Accès sécurisé</DisclosureButton>
                </div>
            </div>
        </DisclosurePanel>
    </Disclosure>
</template>

<script setup>
import {Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue";
import {MagnifyingGlassIcon} from "@heroicons/vue/20/solid";
import {Bars3Icon, BellIcon, XMarkIcon, LockClosedIcon, LockOpenIcon} from "@heroicons/vue/24/outline";
import {Head, Link, router} from "@inertiajs/vue3";
import Mail from "@/Partials/Forms/Mail.vue";
import ThemeSelector from "@/Components/Front/ThemeSelector.vue";
const props = defineProps({
    searchDatas: Object,
    showBio: Boolean,
});

const logout = () => {
    router.post(route("logout"));
};
</script>
