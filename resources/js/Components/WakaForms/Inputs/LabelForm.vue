<template>
  <div>
    <InputLabel :for="config.key" :value="config.label" />
    <input :id="config.key" type="text" v-model="form[config.key]" @input="$emit('input', $event.target.value)">
    <InputError class="mt-2" :message="form.errors ? form.errors[config.key] : ''" />
  </div>
</template>

<script>
import InputLabel from '@/Components/WakaForms/Labels/InputLabel.vue'
import InputError from '@/Components/WakaForms/Labels/InputError.vue'

export default {
  components: {
    InputLabel,
    InputError,
  },
  props: {
    config: {
      type: Object,
      required: true,
    },
    form: {
      type: Object,
      required: true,
    },
  },
  mounted() {
    console.log('mounted!')
  },
}
</script>
