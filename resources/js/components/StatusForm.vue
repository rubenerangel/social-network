<template>
  <div>
    <form @submit.prevent="submit">
      <div class="card-body">
        <textarea
          name="body"
          class="form-control border-0 bg-light"
          placeholder="Qué estas pensando Rubén?"
          v-model="body"
        ></textarea>
      </div>
      <div class="card-footer">
        <button id="create-status" class="btn btn-primary">Publicar</button>
      </div>
    </form>
    
  </div>
</template>

<script>
export default {
  name: 'StatusForm',
  data() {
    return {
      body: null,
    }
  },
  methods: {
    submit() {
      
      axios.post('/statuses', {body: this.body})
        .then(resp => {
          EventBus.$emit('status-created', resp.data)
          this.body = null;
        })
        .catch(error => {
          console.log(error.response.data);
        });
    }
  },
};
</script>

<style lang="scss" scoped>
</style>