<template>
  <div class="container">
    <ficha-pelicula :pelicula="pelicula" class="ficha-pelicula" />
    <patio-butacas class="butacas" />
    <ficha-sesion :pelicula="pelicula" />
  </div>
</template>

<script>
import { useStore } from '../../stores/store'
import PatioButacas from '@/components/PatioButacas.vue'
import fichaSesion from '@/components/fichaSesion.vue'

export default {
  components: {
    PatioButacas,
    fichaSesion,
  },
  computed: {
    pelicula() {
      const store = useStore();
      return store.selectedMovie;
    },
  },
}
</script>

<style scoped>
.container {
  display: flex;
}

.ficha-pelicula {
  margin-left: 1vh;
  margin-top: 8vw;
}

.butacas {
  margin-left: 8vh;
  margin-top: 10vw;
}
</style>
