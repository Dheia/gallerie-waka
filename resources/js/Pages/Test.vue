<template>
  <div class="row">
    <div class="col-1">
      <button class="btn btn-secondary button" @click="add">Add</button>
    </div>

    <div class="col-7">
      <h3>Draggable {{ draggingInfo }}</h3>

      <draggable
        tag="ul"
        :list="list"
        handle=".handle"
        item-key="name"
      >
        <template #item="{ element, index }">
          <li class="inline-flex w-full h-8">
            <Bars2Icon class="handle"/>

            <span class="text">{{ element.name }} </span>

            <input type="text" class="form-control" v-model="element.text" />

            <div @click="removeAt(index)">X</div>
          </li>
        </template>
      </draggable>
    </div>

    <rawDisplayer class="col-3" :value="list" title="List" />
  </div>
</template>

<script>
let id = 3;
import draggable from "vuedraggable";
import { Bars2Icon } from "@heroicons/vue/24/outline"
export default {
  name: "handle",
  display: "Handle",
  instruction: "Drag using the handle icon",
  order: 5,
  components: {
    draggable,
    Bars2Icon
  },
  data() {
    return {
      list: [
        { name: "John", text: "", id: 0 },
        { name: "Joao", text: "", id: 1 },
        { name: "Jean", text: "", id: 2 }
      ],
      dragging: false
    };
  },
  computed: {
    draggingInfo() {
      return this.dragging ? "under drag" : "";
    }
  },
  methods: {
    removeAt(idx) {
      this.list.splice(idx, 1);
    },
    add: function() {
      id++;
      this.list.push({ name: "Juan " + id, id, text: "" });
    }
  }
};
</script>
<style scoped>
.button {
  margin-top: 35px;
}
.handle {
  float: left;
  padding-top: 8px;
  padding-bottom: 8px;
}
.close {
  float: right;
  padding-top: 8px;
  padding-bottom: 8px;
}
input {
  display: inline-block;
  width: 50%;
}
.text {
  margin: 20px;
}
</style>