<template>
  <div class="container">
    <Header />
    <div class="info-peliculas">
      <ficha-pelicula :pelicula="pelicula" :sesion="sesion" class="ficha-pelicula" />
      <patio-butacas class="butacas" />
    </div>
  </div>
</template>

<script>
import Header from '@/components/Header.vue';
import { useStore } from '../../stores/store'
import PatioButacas from '@/components/PatioButacas.vue'
import fichaSesion from '@/components/fichaSesion.vue'
import { obtenerSesion } from '../services/communicationManager'

export default {
  components: {
    Header,
    PatioButacas,
    fichaSesion,
  },
  data() {
    return {
      sesion: {}
    };
  },
  mounted() {
    obtenerSesion(this.$route.params.id_pelicula).then(data => {
      this.sesion = data;
    }).catch(error => {
      console.error("Error al obtener la sesión:", error);
      this.$router.push('/');
    })
    this.checkIfMovieSelected();
  },
  methods: {
    checkIfMovieSelected() {
      const store = useStore();
      try {
        if (!store.selectedMovie) {
          throw new Error("No se ha seleccionado una película");
        }
      } catch (error) {
        console.error("Error:", error);
        this.reenviarInicio();
      }
    },
    reenviarInicio() {
      const router = useRouter();
      router.push('/');
    }
  },
  computed: {
    pelicula() {
      const store = useStore();
      return store.selectedMovie;
    },
  }
}
</script>

<style scoped>
.container {
  display: grid;
  grid-template-columns: 1fr;
}

.ficha-pelicula {
  margin-left: 40vh;
  margin-top: 10vw;
}

.info-peliculas {
  background-color: #c5c5c5;
  display: flex;
  left: 1vh;
  width: 100vw;
  height: 95vh;
}

.ficha-sesion {
  margin-top: 0;
}

.butacas {
  margin-left: 20vh;
  margin-top: 10vw;
}
</style>
