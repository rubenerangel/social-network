 <template>
  <div @click="redirectIfGuest()">
    <div
      v-for="(status, index) in statuses"
      :key="index"
      class="card mb-3 border-0 shadow-sm"
    >
      <div class="card-body d-flex flex-column">
        <div class="d-flex align-items-center mb-3">
          <img
            width="40px"
            src="https://aprendible.com/images/default-avatar.jpg"
            alt=""
            class="rounded mr-3"
          />
          <div>
            <h5 class="mb-1" v-text="status.user_name"></h5>
            <div class="small text-muted" v-text="status.created_at"></div>
          </div>
        </div>
        <p v-text="status.body" class="card-text text-secondary"></p>
        
      </div>
      <div class="card-footer p-2">
        <button
          v-if="status.is_liked"
          dusk="unlike-btn"
          @click="unlike(status)"
          class="btn btn-link btn-sm"
        >
          <i class="fa fa-thumbs-up text-primary mr-1"></i>
          <strong>TE GUSTA</strong>
        </button>
        <button 
          v-else 
          dusk="like-btn" 
          @click="like(status)"
          class="btn btn-link btn-sm"
        >
          <i class="far fa-thumbs-up text-primary mr-1"></i>
          ME GUSTA
        </button>
      </div>
    </div>
  </div>
</template>
 
<script>
export default {
  name: "StatusesList",
  data() {
    return {
      statuses: [],
    };
  },
  mounted() {
    axios
      .get("/statuses")
      .then((resp) => {
        this.statuses = resp.data.data;
      })
      .catch((error) => {
        console.log(error.response.data);
      });

    EventBus.$on("status-created", (status) => {
      this.statuses.unshift(status);
    });
  },
  methods: {
    like(status) {
      axios.post(`/statuses/${status.id}/likes`).then((resp) => {
        status.is_liked = true;
      });
    },
    unlike(status) {
      axios.delete(`/statuses/${status.id}/likes`).then((resp) => {
        status.is_liked = false;
      });
    },
  },
};
</script>
 
 <style lang="scss" scoped>
</style>