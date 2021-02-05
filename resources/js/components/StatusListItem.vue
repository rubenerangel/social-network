<template>
  <div>
    <div
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

      <div class="card-footer p-2 d-flex justify-content-between align-items-center">
        <like-btn
          :status="status"
        ></like-btn>

        <div class="mr-2 text-secondary">
          <i class="far fa-thumbs-up"></i>
          <span dusk="likes-count">{{ status.likes_count }}</span> 
        </div>

        <form @submit.prevent="addComment">
          <textarea name="comment" v-model="newComment"></textarea>
          <button dusk="comment-btn">Enviar</button>
        </form>

        <div v-for="comment in comments" >
          {{ comment.user_name }}
          {{ comment.body }} 
        </div>
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
    }
  },
}
</script>

<style lang="scss" scoped>

</style>