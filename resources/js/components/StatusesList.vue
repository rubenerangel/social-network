 <template>
   <div>
     <div v-for="(status, index) in statuses" :key="index" v-text="status.body"></div>
   </div>
 </template>
 
 <script>
   export default {
     name: 'StatusesList',
     data() {
       return {
         statuses: []
       }
     },
     mounted() {
       axios.get('/statuses')
        .then(resp => {
          this.statuses = resp.data.data
        })
        .catch(error => {
          console.log(error.response.data)
        });

        EventBus.$on('status-created', status => {
          this.statuses.unshift(status);
        });
     }
   }
 </script>
 
 <style lang="scss" scoped>
 
 </style>