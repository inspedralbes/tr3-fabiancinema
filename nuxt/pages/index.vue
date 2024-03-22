<template>
  <div class="landing">
    <h1 class="title">Cines Kinépolis Barcelona Splau</h1>
    <h2 class="subtitle">PRÒXIMES SESSIONS</h2>
    <div v-if="peliculas.length" class="movie-container">
      <div v-for="pelicula in peliculas" :key="pelicula.id" class="pelicula">
        <nuxt-link :to="{ name: 'entradas-id_pelicula', params: { id_pelicula: pelicula.id_pelicula } }"
          class="movie-link" @click="seleccionarPelicula(pelicula)">
          <fichaPelicula :pelicula="pelicula" :sesion="obtenerSesiones(pelicula.id_pelicula)" />
        </nuxt-link>
      </div>
    </div>
  </div>
</template>

<script>
import { useStore } from "../stores/store";

export default {
  data() {
    return {
      peliculas: [],
    };
  },
  mounted() {
    this.obtenerPeliculas();
  },
  methods: {
    async obtenerPeliculas() {
      try {
        const response = await fetch("http://localhost:8000/api/peliculas");
        if (!response.ok) {
          throw new Error("No se pudo obtener la lista de películas");
        }
        const data = await response.json();
        this.peliculas = data;
      } catch (error) {
        console.error("Error al obtener las películas:", error);
      }
    },
    async obtenerSesiones(idPelicula) {
      try {
        const response = await fetch(`http://localhost:8000/api/sesiones/${idPelicula}`);
        if (!response.ok) {
          throw new Error("No se pudo obtener la sesión");
        }
        const data = await response.json();
        return data;
      } catch (error) {
        console.error("Error al obtener la sesión:", error);
        return null;
      }
    },
    async seleccionarPelicula(pelicula) {
      const store = useStore();
      store.setSelectedMovie(pelicula);
      this.$router.push({ name: 'entradas-id_pelicula', params: { id_pelicula: pelicula.id_pelicula } });
    },
  },
};
</script>

<style scoped>
.landing {
  text-align: center;
  margin: 20px;
}

.title {
  font-size: 2rem;
  margin-top: 40px;
  margin-bottom: -1vw;
}

.subtitle {
  font-size: 2rem;
  margin-top: 40px;
  margin-bottom: 1vw;
}

.movie-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  height: 80vh;
  width: 95vw;
  align-items: center;
}

.pelicula {
  margin: 2vh;
  margin-bottom: 200px;
  padding: 10px;
  border: 1px solid black;
  border-radius: 5px;
  max-width: 300px;
  background-color: #f9f9f9;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease;
  height: 80%;
}
</style>
