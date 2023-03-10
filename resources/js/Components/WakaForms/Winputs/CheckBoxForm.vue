<template>
    <input class="my-1 w-6 h-6" :id="formKey" type="checkbox" v-model="form[this.formKey]" @input="$emit('input', $event.target.value)">
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
  mounted() {
    // console.log('mounted label')
    // console.log(this.form[this.formKey])
  }
}

</script>
