<template>
  <div id="app" class="p-4 bg-gray-200 min-h-screen">
    <button class="px-4 py-2 mb-4 text-lg text-white text-semibold bg-blue-600 rounded-md" @click="add">Add new card</button>
    <transition-group
      enter-active-class="transform-gpu opacity-0 scale-0"
      enter-class="opacity-0 scale-0 "
      enter-to-class="opacity-100 scale-100 "
      leave-active-class="transform-gpu"
      leave-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-0"
      tag="div"
      class="relative flex flex-wrap justify-center w-full bg-white dark:bg-mydark sm:items-center sm:pt-0"
    >
      <article
        v-for="(item, index) in tableaux.data"
        v-bind:key="item.id"
        class="flex items-center p-4 bg-white rounded-md shadow-md transition-all duration-300"
      >
        <div class="flex-1">
          
          <div>{{item.name}}</div>
        </div>
        <button class="p-2 hover:bg-gray-100 rounded-md focus:outline-none" @click="remove(index)">
          <svg
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            class="h-6 w-6"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
            />
          </svg>
        </button>
      </article>
    </transition-group>
  </div>
</template>

<script>
export default {
  props: ["tableaux"],
  methods: {
    add: function () {
      this.tableaux.unshift(this.tableaux.length++);
    },
    remove: function (index) {
      this.tableaux.splice(index, 1);
    },
  }
};
</script>
