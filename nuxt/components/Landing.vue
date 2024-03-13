<template>
  <div class="landing">
    <h1 class="title">CINE FABIÁN</h1>
    <h2 class="subtitle">PRÒXIMES SESSIONS</h2>
    <div v-if="peliculas.length" class="movie-container">
      <div v-for="pelicula in peliculas" :key="pelicula.id" class="pelicula">
        <div class="info-pelicula">
          <img :src="pelicula.portada" :alt="pelicula.titulo" class="cover-image" />
            <div class="movie-details" @click="goToAnotherComponent">
            <h2 class="movie-title">{{ pelicula.titulo }}</h2>
            <p class="movie-info">{{ pelicula.fecha }}</p>
            <p class="movie-info">Director: {{ pelicula.director }}</p>
            <p class="movie-info">Género: {{ pelicula.genero }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
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
    comprarEntradas() {},
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
  margin-bottom: -1vw;
}

.movie-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  height: 89vh;
  width: 95vw;
  align-items: center;
}

.pelicula {
  margin: 2vh;
  padding: 10px;
  border: 1px solid black;
  border-radius: 5px;
  max-width: 300px;
  background-color: #f9f9f9;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease;
  height: 70%;
}

.info-pelicula {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100%;
}

.pelicula:hover {
  transform: translateY(-5px);
}

.cover-image {
  
  width: 100%;
  height: 100%;
  border-radius: 5px 5px 5px 5px;
}

.movie-details {
  padding: 10px;
}

.movie-title {
  font-size: 1.2rem;
  margin-bottom: 5px;
}

.movie-info {
  margin-bottom: 5px;
}

</style>
