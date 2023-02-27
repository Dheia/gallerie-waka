<template>
  <form @submit.prevent="submitForm">
    <slot v-for="(field, key) in fields" :name="key">
        <div v-if="field.type =='label'" :key="key">
            <LabelForm v-model="formData[key]" :config="field" :form="formData"/>
        </div>
        <div v-if="field.type =='richeditor'" :key="key">
            <RicheditorForm v-model="formData[key]" :config="field" :form="formData"/>
        </div>
        <div v-if="field.type =='fileuploader'" :key="key">
            <FileuploaderForm v-model="formData[key]" :config="field" :form="formData"/>
        </div>
    </slot>
    <button type="submit">Submit</button>
  </form>
</template>

<script>
import LabelForm from '@/components/WakaForms/Inputs/LabelForm.vue'
import RicheditorForm from '@/components/WakaForms/Inputs/RicheditorForm.vue'
import FileuploaderForm from '@/components/WakaForms/Inputs/FileuploaderForm.vue'

export default {
  props: {
    config: {
      type: Object,
      required: true,
    },
    formData: {
      type: Object,
      default: () => ({}),
    },
  },
  components: {
    LabelForm,
    RicheditorForm,
    FileuploaderForm,
  },
  computed: {
    fields() {
      return this.config.fields || {}
    },
  },
  methods: {
    submitForm() {
      this.$emit('submit', this.formData)
    },
  },
}
</script>
