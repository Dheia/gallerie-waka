<template>
  <div>
    <div class="flex items-center mb-4">
      <label for="search" class="text-gray-600 mr-2">Search:</label>
      <input
        type="text"
        id="search"
        class="rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
        :value="searchModel"
        @input="updateSearch($event.target.value)"
      />
    </div>
    <div class="flex items-center mb-4">
      <label for="sort" class="text-gray-600 mr-2">Sort by:</label>
      <select
        id="sort"
        class="rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
        :value="sortModel"
        @input="updateSort($event.target.value)"
      >
        <option v-for="(meta, key) in metas" :value="key" :key="key">{{ meta }}</option>
      </select>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    metas: Object,
    search: String,
    sort: String,
  },
  computed: {
    searchModel: {
      get() {
        return this.search;
      },
      set(value) {
        this.$emit('update:search', value);
      },
    },
    sortModel: {
      get() {
        return this.sort;
      },
      set(value) {
        this.$emit('update:sort', value);
      },
    },
  },
  methods: {
    updateSearch(value) {
      this.searchModel = value;
    },
    updateSort(value) {
      this.sortModel = value;
    },
  },
};
</script>