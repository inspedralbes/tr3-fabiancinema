<template>
  <div v-if="sesion">
    <p class="session-info">{{ sesion.dia }}</p>
    <p class="session-info">{{ sesion.hora }}</p>
  </div>
</template>

<script>
export default {
  props: {
    sesion: {
      type: Object,
      required: true,
    },
    pelicula: {
      type: Object,
      required: true,
    },
  },
}
</script>

<style scoped>
.session-info {
  margin: 0;
  font-size: 0.9rem;
}
</style>
