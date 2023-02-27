<template>
  <div>
    <Head title="Organizations" />
    <h1 class="mb-8 text-3xl font-bold">Tableaux</h1>
    <search-filter :data="tabData" class="mr-4 w-full max-w-md">
      
    </search-filter>
    <div class="flex items-center justify-between mb-6">
      <Link class="btn-indigo" :href="route('tableau.create')">
        <span>Créer</span>
        <span class="hidden md:inline">&nbsp;Tableau</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <thead>
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6">Name</th>
            <th class="pb-4 pt-6 px-6">City</th>
            <th class="pb-4 pt-6 px-6">Phone</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in organizations.data" :key="item.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td v-for="(meta, key) in metas" :key="key" class="px-6 py-4">{{ item[key] }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <Pagination class="mt-6" :links="organizations.links" />
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'

import Pagination from '@/Components/Pagination2'
import HeaderMeta from '@/Components/HeaderMeta'
import SearchFilter from '@/Components/SearchFilter'
import mapValues from 'lodash/mapValues'

export default {
  components: {
    Head,
    Link,
    Pagination,
    HeaderMeta,
    SearchFilter,
  },
  layout: Layout,
  props: {
    filters: Object,
    metas: Object,
    organizations: Object,
    sort: Object,
  },
  data() {
    return {
      tabData: {
        search: this.filters.search,
        sort: this.sort.sort,
        metas: this.metas
      },
    }
  },
}
</script>
