<template>
    <textarea class="w-full" :id="formKey" type="text" :rows="config.rows ? config.rows : 5" v-model="form[formKey]" @input="$emit('input', $event.target.value)"/>
</template>

<script>


export default {
  props: {
    config: {
      type: Object,
      required: true,
    },
    form: {
      type: Object,
      required: true,
    },
    formKey: {
      type: String,
      required: true,
    },
  },
}
</script>
