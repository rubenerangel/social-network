<template>
  <div>
    <div class="container">
      <div class="row">
          <div class="col-8 mx-auto">
              <div class="card border-0 bg-light mb-3 shadow-sm">
                  <status-form></status-form>
              </div>
              <statuses-list></statuses-list>
          </div>
      </div>
    </div>
  </div>
</template>

<script>
import StatusForm from './StatusForm';
import StatusesList from './StatusesList';

export default {
  name: 'DisplayGetStatus',
  components: {
    StatusForm,
    StatusesList
  },
}
</script>

<style lang="scss" scoped>

</style>