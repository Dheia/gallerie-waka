<template>
  <div class="flex items-center">
    <div class="flex w-full bg-white rounded shadow">
      <input class="relative px-6 py-3 w-full rounded-r focus:shadow-outline" autocomplete="off" type="text" name="search" placeholder="Search…" v-model="formMeta.search" />
    </div>
    <button class="ml-3 text-gray-500 hover:text-gray-700 focus:text-indigo-500 text-sm" type="button" @click="$emit('reset')">Reset</button>
    <Popover class="relative">
      <PopoverButton class="p-2 w-48 bg-white shadow-lg">Trier par : {{ formMeta.sort }}</PopoverButton>

      <PopoverPanel class="absolute z-10 w-96">
        <div class="p-4 w-full bg-gray-200 shadow-xl">
          <div v-for="(field, key) in data.metas" :key="key" :value="field.label">
            <div class="flex p-2" v-if="field.ordorable">
              <div class="w-1/2">{{ field.label }}</div>
              <PopoverButton  @click="updateSort(key)"
                ><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0l-3.75-3.75M17.25 21L21 17.25" /></svg
              ></PopoverButton>
              <PopoverButton @click="updateSort('-'+key)"
                ><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h5.25m5.25-.75L17.25 9m0 0L21 12.75M17.25 9v12" /></svg
              ></PopoverButton>
            </div>
          </div>
        </div>
      </PopoverPanel>
    </Popover>
  </div>
</template>

<script>
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import { SortAscendingIcon, SortDescendingIcon } from '@vue-hero-icons/outline'
import throttle from 'lodash/throttle'
import pickBy from 'lodash/pickBy'
export default {
  components: {
    Popover,
    PopoverButton,
    PopoverPanel,
    SortAscendingIcon,
    SortDescendingIcon,
    throttle,
  },
  data() {
    return {
      formMeta: {
        search: this.data.search,
        sort: this.data.sort || 'id',
      },
    }
  },
  props: {
    data: Object,
    meta: Object,
    modelValue: String,
    maxWidth: {
      type: Number,
      default: 300,
    },
  },
  watch: {
    formMeta: {
      deep: true,
      handler: throttle(function () {
        console.log(pickBy(this.formMeta))
        this.$inertia.get('/organizations', pickBy(this.formMeta), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    updateSort(ev) {
        this.formMeta.sort = ev;
    }
  },
}
</script>
