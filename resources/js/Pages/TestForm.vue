<template>
  <div>
    <wakaForm :config="config" :formData="formData" @submit="submitForm" />
  </div>
</template>

<script>
import wakaForm from '@/Components/WakaForms/Form.vue'

export default {
  components: {
    wakaForm,
  },
  data() {
    return {
      config: {
        form: {
          url: '/bo/mycontroller{id}',
          class: 'flex flex-wrap',
        },
        fields: {
          name: {
            type: 'label',
            label: 'Nom',
            required: true,
            class: 'w-1/2 bg-red-500',
          },
          slug: {
            type: 'label',
            label: 'slug',
            required: true,
            class: 'w-1/2',
          },
          text: {
            type: 'richeditor',
            label: 'contenu',
            class: "w-full bg-red-200"
          },
          image: {
            type: 'fileuploader',
            label: 'Charger une image',
          },
        },
      },
      formData: {
        name: 'Hello World',
        slug: 'hello-world',
        text: '<p>Bonjour à tous</p>',
      },
    }
  },
  methods: {
    submitForm(data) {
      console.log('Form submitted:', data)
    },
  },
}
</script>