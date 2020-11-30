<template>
  <form action="{{ route('statuses.store') }}" method="POST">
    @csrf
    <div class="card-body">
      <textarea
        name="body"
        class="form-control border-0 bg-light"
        placeholder="Qué estas pensando Rubén?"
      ></textarea>
    </div>
    <div class="card-footer">
      <button id="create-status" class="btn btn-primary">Publicar</button>
    </div>
  </form>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
</style>