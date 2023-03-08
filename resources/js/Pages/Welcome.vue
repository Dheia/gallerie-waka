<template>
    <Head title="Bienvenue" />
    <div ref="top"
        class="relative flex items-top justify-center min-h-screen w-full dark:text-gray-300 text-gray-600 bg-white dark:bg-mydark sm:items-center sm:pt-0"
    >
        <div class="w-full" >
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-wrap pt-2 lg:pt-16 lg:mb-8" >
                    <div
                        class="flex justify-center flex-wrap items-center sm:justify-start sm:pt-0"
                    >
                    <transition v-show="showIntro" enter-from-class="opacity-0  translate-x-4" enter-active-class="transition duration-1000">
                        <img class="h-96 w-auto rounded-full" :src="page.image"/>
                    </transition>
                    <transition v-show="showIntro" enter-from-class="opacity-0 -translate-x-4" enter-active-class="transition duration-1000">
                        <div v-html="page.title" class="text-gray-900 dark:text-white font-heading text-4xl lg:text-8xl p-1    "/>
                           
                    </transition>
                    <transition  enter-from-class="opacity-0 translate-y-4 opacity-0" enter-active-class="transition-all duration-1000">
                        <div  v-if="showBio" class="px-2 md:px-0">
                            <div v-html="page.content" class=" max-w-none  mx-auto prose dark:prose-invert font-heading text-base mt-12    "></div>
                            <Badge class=" font-heading my-2" @clickOnBadge="showBio=false"/>
                        </div>
                    </transition>
                        
                    </div>
                </div>
                <NavigationBar  id="myanchor" 
                    :searchDatas="queriesToSend"  
                    @toogleBio="toogleBio()" 
                    :showBio="showBio"  
                    @openOver="openOrCloseOver(true)"
                    class="w-full my-8" 
                />

                 <div  class="relative flex  items-center justify-center">
                    <div class="lg:ml-6">
                        <div class="flex flex-wrap items-center justify-center space-x-4 font-heading">
                            <div class="">
                                <div class="flex items-center relative w-max cursor-pointer select-none" @click="changeTagMode()"  >
                                    <input class="appearance-none transition-colors cursor-pointer w-14 h-7 rounded-full"  :class="{ ' bg-gray-900': queriesToSend.tagMode == 'OU', 'bg-gray-600 ': queriesToSend.tagMode == 'ET'  }" />
                                    <span class="absolute font-medium text-xs uppercase right-1 text-white"> OU </span>
                                    <span class="absolute font-medium text-xs uppercase right-8 text-white"> ET </span>
                                    <span class="w-7 h-7 right-7 absolute rounded-full transform transition-transform bg-gray-200" :class="{  'translate-x-7 ': queriesToSend.tagMode == 'ET'  }"  />
                                </div>
                            </div>
                             <button v-for="button in allTags" :key="button.id" 
                             :class="{ ' bg-gray-700 text-white' : isActive(button.slug) }"
                             class=" rounded p-1 inline-flex  text-xs uppercase  hover:bg-gray-400 hover:text-white"
                              @click="handleClick(button.slug)">
                               {{ button.name }} <span v-if="(isActive(button.slug) && queriesToSend.tagMode == 'ET')" class="text-[10px] ">&nbsp;{{ queriesToSend.tagMode }}</span>
                            </button>
                        </div>
                    </div>
                </div>


                <Gallerie class="w-full my-8" :tableaux="tableaux" />
                <Pagination class="my-8" :links="tableaux.links" />

            </div>
        </div>
    </div>
</template>
<script>
import { Head, Link } from "@inertiajs/vue3";
import NavigationBar from "@/Components/Front/NavigationBar.vue";
import Gallerie from "@/Components/Front/Gallerie.vue";
import Pagination from "@/Components/Front/Pagination.vue";
import Over from "@/Partials/Overs/Over.vue";
import Badge from "@/Partials/Btns/Badge.vue";
import throttle from "lodash/throttle";
import mapValues from "lodash/mapValues";
import pickBy from "lodash/pickBy";



export default {
    components: {
        Head,
        Pagination,
        Gallerie,
        NavigationBar,
        Over,
        Badge
        
    },

    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
        tableaux: Object,
        filter: Object,
        allTags: Object,
        page: Object,
    },
    data() {
        return {
            queriesToSend: {
                filter: {
                    global: this.filter?.global ?  this.filter.global : null,
                    inTags: this.filter?.inTags ? this.filter.inTags[0].split(',') : [],
                },
                tagMode: this.tagMode ? this.tagMode : "OU",
            },
            showBio: false,
            showIntro: false,
            isOverOpen: false,
        };
    },
    mounted() {
        this.showIntro =  true
        this.showBio =  false
    },
    watch: {
        queriesToSend: {
            deep: true,
            handler: throttle(function () {

                let filter = Object.assign({}, this.queriesToSend.filter);
                if(!filter.inTags.length) {
                    // console.log("je delete")
                    // delete obj.filter.inTags
                } else {
                    filter.inTags = [filter.inTags.join(',')]
                }
                if(!filter.global) {
                    delete filter.global
                } 
                this.$inertia.get("/", pickBy({filter: filter, tagMode: this.queriesToSend.tagMode}), {
                    preserveState: true, preserveScroll: true,
                });
            }, 1000),
        },
        showBio: {
            deep: true,
             handler() {
                 //console.log(this.showBio)
             }
        }
    },
    methods: {
        handleClick(slug) {
            if(this.queriesToSend.tagMode == "OU") {
                if (this.isActive(slug)) {
                    this.queriesToSend.filter.inTags = []
                } else {
                    this.queriesToSend.filter.inTags = [slug]
                }
            } else {
                if (this.isActive(slug)) {
                    this.queriesToSend.filter.inTags =  _.without(this.queriesToSend.filter.inTags, slug)
                } else {
                    this.queriesToSend.filter.inTags.push(slug);
                }
            }
            
           
            // // handle button click event here
            // console.log(`Button ${slug} was clicked`)
        },
        isActive(name) {
            if(!this.queriesToSend.filter.inTags) {
                return
            }
            //console.log(this.queriesToSend)
            return this.queriesToSend.filter.inTags.includes(name);
        },
        changeTagMode() {
            if(this.queriesToSend.tagMode == "OU") {
                this.queriesToSend.tagMode = "ET"
            } else {
                this.queriesToSend.tagMode = "OU"
                this.queriesToSend.filter.inTags = []
            }
        },
        toogleBio() {
            this.showBio = !this.showBio
            if(this.showBio) {
                this.$refs["top"].scrollIntoView({behavior: "smooth"});
            } 
        },
        openOrCloseOver(value) {
            this.isOverOpen = value
        }
        
    }
        
};
</script>
