<template>
  <div class="landing">
    <Header />
    <div class="content">
      <h2 class="subtitle">PRÓXIMAS SESIONES</h2>
      <div v-if="peliculas.length" class="movie-container">
        <div v-for="pelicula in peliculas" :key="pelicula.id" class="pelicula">
          <nuxt-link :to="{ name: 'entradas-id_pelicula', params: { id_pelicula: pelicula.id_pelicula } }"
            class="movie-link" @click="seleccionarPelicula(pelicula)">
            <FichaPelicula :pelicula="pelicula" />
          </nuxt-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Header from '@/components/Header.vue';
import FichaPelicula from '@/components/fichaPelicula.vue';
import { useStore } from '../stores/store';
import { obtenerPeliculas } from '../services/communicationManager';

export default {
  components: {
    Header,
    FichaPelicula,
  },
  data() {
    return {
      peliculas: [],
    };
  },
  mounted() {
    obtenerPeliculas().then(data => {
      this.peliculas = data;
    });
  },
  methods: {
    seleccionarPelicula(pelicula) {
      const store = useStore();
      store.setSelectedMovie(pelicula);
      this.$router.push({ name: 'entradas-id_pelicula', params: { id_pelicula: pelicula.id_pelicula } });
    },
  },
};
</script>

<style scoped>
.landing {
  background-color: #494949;
  color: #fff;
  min-height: 100vh;
}

.content {
  padding: 40px;
}

.title {
  font-size: 2.5rem;
  margin-bottom: 20px;
}

.subtitle {
  font-size: 2rem;
  margin-bottom: 30px;
}

.movie-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  grid-gap: 20px;
  justify-items: center;
}

.pelicula {
  border-radius: 10px;
  background-color: #333;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
  transition: transform 0.3s ease;
}

.pelicula:hover {
  transform: translateY(-5px);
}

.movie-link {
  color: inherit;
  text-decoration: none;
}
</style>
