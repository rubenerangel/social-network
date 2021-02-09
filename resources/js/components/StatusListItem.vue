<template>
  <div>
    <div class="card mb-3 border-0 shadow-sm">
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

      <div class="card-footer p-2 d-flex justify-content-between align-items-center">
        <like-btn
          dusk="like-btn"
          :model="status"
          :url="`/statuses/${status.id}/likes`"
        ></like-btn>

        <div class="mr-2 text-secondary">
          <i class="far fa-thumbs-up"></i>
          <span dusk="likes-count">{{ status.likes_count }}</span> 
        </div>
      </div>

      <div class="card-footer">
        <div v-for="(comment, index) in comments" :key="index" class="mb-3">

          <div class="d-flex">
            <img width="34px" height="34px" :src="comment.user_avatar" :alt="comment.user_name" class="rounded shadow-sm mr-2">
            <div class="flex-grow-1">
              <div class="card border-0 shadow-sm">
                <div class="card-body p-2 text-secondary">
                  <a href="#"><strong>{{ comment.user_name }}</strong></a> 
                  {{ comment.body }} 
                </div>
              </div>

              <small dusk="comment-likes-count" class="badge badge-pill py-1 px-2 mt-1 badge-primary float-right">
                <i class="fa fa-thumbs-up"></i>
                {{ comment.likes_count }}</small>
              <like-btn
                dusk="comment-like-btn"
                :model="comment"
                :url="`/comments/${comment.id}/likes`"
                class="comments-like-btn"
              ></like-btn>
            </div>
          </div>
        </div>

        <form @submit.prevent="addComment" v-if="isAuthenticated">
          <div class="d-flex align-items-center">
            <img width="34px" src="https://aprendible.com/images/default-avatar.jpg" :alt="currentUser.name" class="rounded shadow-sm float-left mr-2">

            <div class="input-group">
              <textarea 
                v-model="newComment" 
                name="comment" 
                rows="1" 
                required
                placeholder="Escribe un comentario..."
                class="form-control border-0 shadow-sm"
              ></textarea>
            
              <div class="input-group-append">
                <button dusk="comment-btn" class="btn btn-primary">Enviar</button>
              </div>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</template>

<script>
import LikeBtn from './LikeBtn';

export default {
  name: 'StatusListItem',
  components: {
    LikeBtn,
  },
  props: {
    status: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      newComment: null,
      comments: this.status.comments,
    }
  },
  methods: {
    addComment() {
      axios.post(`/statuses/${this.status.id}/comments`, {body: this.newComment})
        .then(resp => {
          this.newComment = null;
          this.comments.push(resp.data.data)
        })
        .catch(error => {
          console.log(error.response.data);
        });
    },
  },
}
</script>

<style lang="scss" scoped>

</style>