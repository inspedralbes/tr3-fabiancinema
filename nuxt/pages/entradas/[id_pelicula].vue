<template>
  <div>
    <h1>Sesión</h1>
    <ficha-pelicula :pelicula="pelicula" />
    <patio-butacas />
  </div>
</template>

<script>
import { useStore } from '../../stores/store'
import PatioButacas from '@/components/PatioButacas.vue'

export default {
  data() {
    return {
      pelicula: {},
    };
  },
  components: {
    PatioButacas,
  },
  async mounted() {
    const store = useStore();
    this.pelicula = store.selectedMovieId;
    console.log("AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA",pelicula);
    const id_pelicula = store.selectedMovieId;
    try {
      const response = await fetch(`http://localhost:8000/api/peliculas/${id_pelicula}`);
      if (!response.ok) {
        throw new Error("No se pudo obtener la película");
      }
      const data = await response.json();
      
      this.pelicula = data;
    } catch (error) {
      console.error("Error al obtener la película:", error);
    }
  },
}
</script>
