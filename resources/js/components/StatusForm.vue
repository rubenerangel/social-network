<template>
  <div>
    <form @submit.prevent="submit" v-if="isAuthenticated">
      <div class="card-body">
        <textarea
          v-model="body"
          required
          name="body"
          class="form-control border-0 bg-light"
          :placeholder="`Qué estas pensando ${currentUser.name}?`"
        ></textarea>
      </div>
      <div class="card-footer">
        <button 
          id="create-status" 
          class="btn btn-primary">
          <i class="fa fa-paper-plane mr-1"></i>
          Publicar
        </button>
      </div>
    </form>
    <div v-else class="card-body">
      <a href="/login">Debes hacer login</a>
    </div>
    
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
          EventBus.$emit('status-created', resp.data.data)
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