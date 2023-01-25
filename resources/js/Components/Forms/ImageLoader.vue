<template>
  <div>
    <form>
        <input type="file" @change="uploadImages" ref="imageInput" class="form-control" multiple>
        <progress v-if="uploadPercentage" :value="uploadPercentage" max="100"></progress>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      uploadPercentage: null
    }
  },
  methods: {
    async uploadImages() {
      let input = this.$refs.imageInput
      let files = input.files

      for (let i = 0; i < files.length; i++) {
        let file = files[i]
        let formData = new FormData()
        formData.append('image', file)

        try {
          let response = await this.$inertia.post('/image-upload', formData, {
            headers: {
              'Content-Type': 'multipart/form-data'
            },
            onUploadProgress: progressEvent => {
              this.uploadPercentage = parseInt(
                Math.round((progressEvent.loaded * 100) / progressEvent.total)
              )
            }
          })
          console.log(response.data)
        } catch (error) {
          console.log(error)
        }
      }
    }
  }
}