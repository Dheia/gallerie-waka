<template>
    <div v-if="editor">
    <bubble-menu
      class="flex p-1 rounded-lg bg-gray-700 fill-white space-x-2"
      :tippy-options="{ duration: 100 }"
      :editor="editor"
    >
      <button @click="editor.chain().focus().toggleBold().run()" :class="{ ' fill-slate-400': editor.isActive('bold') }">
        <RiBold class="h-4 w-4 "/>
      </button>
      <button @click="editor.chain().focus().toggleItalic().run()" :class="{ 'fill-slate-400': editor.isActive('italic') }">
        <RiItalic class="h-4 w-4"/>
      </button>
    </bubble-menu>
  </div>
  <editor-content :editor="editor" />
</template>

<script>
import StarterKit from '@tiptap/starter-kit'
import { Editor,  BubbleMenu, EditorContent } from '@tiptap/vue-3'
import { RiBold, RiItalic } from "vue-remix-icons";

export default {
  components: {
    EditorContent,
    BubbleMenu,
    RiBold,
    RiItalic

  },

  props: {
    modelValue: {
      type: String,
      default: '',
    },
  },

  emits: ['update:modelValue'],

  data() {
    return {
      editor: null,
    }
  },

  watch: {
    modelValue(value) {
      // HTML
      const isSame = this.editor.getHTML() === value

      // JSON
      // const isSame = JSON.stringify(this.editor.getJSON()) === JSON.stringify(value)

      if (isSame) {
        return
      }

      this.editor.commands.setContent(value, false)
    },
  },

  mounted() {
    this.editor = new Editor({
        editorProps: {
            attributes: {
            class: 'p-1  max-w-none form-textarea border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm',
            },
        },
        extensions: [
            StarterKit,
        ],
        content: this.modelValue,
        onUpdate: () => {
            // HTML
            this.$emit('update:modelValue', this.editor.getHTML())

            // JSON
            // this.$emit('update:modelValue', this.editor.getJSON())
        },
        })
  },

  beforeUnmount() {
    this.editor.destroy()
  },
}
</script>