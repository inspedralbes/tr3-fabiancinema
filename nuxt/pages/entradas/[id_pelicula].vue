<template>
  <div class="container">
    <div class="info-peliculas">
      <ficha-pelicula :pelicula="pelicula" :sesion="sesion" class="ficha-pelicula" />
      <patio-butacas class="butacas" />
    </div>
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
  data() {
    return {
      sesion: null,
    };
  },
  mounted() {
    this.obtenerSesion();
  },
  methods: {
    async obtenerSesion() {
      try {
        console.log("BBBBBBBBBBBBBBBBBBBBB", this.$route.params.id_pelicula);
        const response = await fetch(`http://localhost:8000/api/sesiones/${this.$route.params.id_pelicula}`);
        if (!response.ok) {
          throw new Error("No se pudo obtener la sesión");
        }
        const data = await response.json();
        this.sesion = data;
      } catch (error) {
        console.error("Error al obtener la sesión:", error);
      }
    },
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
  display: grid;
  grid-template-columns: 1fr;
  /* Una sola columna */
}

.ficha-pelicula {
  margin-left: 1vh;
  margin-top: 8vw;
}

.info-peliculas {
  display: flex;
  left: 1vh;
}

.ficha-sesion {
  margin-top: 0;
}

.butacas {
  margin-left: 8vh;
  margin-top: 10vw;
}
</style>
