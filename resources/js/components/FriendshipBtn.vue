<template>
  
    <button 
      @click="sendFriendshipRequest"
      dusk="request-friendship">
      {{ TextBtn }}
    </button>
  
</template>

<script>
  export default {
    name: 'FriendshipBtn',
    props: {
      recipient: {
        type: Object,
        required: true
      }
    },
    data() {
      return {
        TextBtn: 'Solicitar amistad'
      }
    },
    methods: {
      sendFriendshipRequest () {
        axios.post(`friendships/${this.recipient.name}`)
          .then(res => {
            this.TextBtn = 'Solicitud enviada...'
          })
          .catch(error => {
            console.log(error.data);
          })
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>