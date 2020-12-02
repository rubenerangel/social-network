 <template>
   <div>
     <div v-for="(status, index) in statuses" :key="index" class="card mb-3 border-0 shadow-sm">
       <div class="card-body d-flex flex-column">
         <div class="d-flex align-items-center mb-3">
          <img width="40px" src="https://aprendible.com/images/default-avatar.jpg" alt="" class="rounded mr-3">
          <div>
            <h5 class="mb-1">Rubén Rangel</h5>
            <div class="small text-muted">Hace una hora</div>
          </div>
         </div>
         <p v-text="status.body" class="card-text text-secondary"></p>

       </div>
     </div>
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