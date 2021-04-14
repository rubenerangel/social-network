 <template>
  <div @click="redirectIfGuest()">
    <!--  -->
    <status-list-item
      v-for="(status, index) in statuses"
      :key="index"
      :status="status"
    ></status-list-item>
  </div>
</template>
 
<script>
import StatusListItem from './StatusListItem';

export default {
  name: "StatusesList",
  components: {
    StatusListItem,
  },
  props: {
    url: String
  },
  data() {
    return {
      statuses: [],
    };
  },
  mounted() {
    axios
      .get(this.getUrl)
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
  computed: {
    getUrl() {
      return this.url ? this.url : '/statuses'
    }
  }
};
</script>
 
 <style lang="scss" scoped>
</style>