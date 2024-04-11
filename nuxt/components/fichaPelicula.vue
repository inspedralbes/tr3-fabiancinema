<template>
  <div v-if="pelicula" class="pelicula-info">
    <img :src="pelicula.portada" :alt="pelicula.titulo" class="cover-image" />
    <div class="details">
      <h2 class="movie-title">{{ pelicula.titulo }}</h2>
      <h3 class="movie-subtitle">{{ calcularDuracion(pelicula.duracion) }}</h3>
      <p class="movie-info">{{ pelicula.fecha }}</p>
    </div>
  </div>
  <div v-else>
    <p>No se ha proporcionado información sobre la película.</p>
  </div>
</template>

<script>
export default {
  props: {
    pelicula: {
      type: Object,
      required: true,
    },
  },
  methods: {
    calcularDuracion(duracion) {
      if (duracion) {
        const horas = Math.floor(duracion / 60);
        const minutos = duracion % 60;
        if (horas === 0) {
          return `${minutos} min`;
        } else {
          return `${horas}h ${minutos} min`;
        }
      } else {
        return '';
      }
    },
  },
};
</script>

<style scoped>
.pelicula-info {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 2vh; /* Ajuste de margen inferior */
  padding: 2vw; /* Ajuste de padding */
  transition: transform 0.3s ease;
}

.cover-image {
  width: 90%; /* Ajuste de ancho de imagen */
  max-width: 300px;
  height: auto;
  border-radius: 2vw; /* Ajuste de border-radius */
  margin-bottom: 2vh; /* Ajuste de margen inferior */
  transition: filter 0.3s ease;
}

.cover-image:hover {
  opacity: 0.7;
}

.details {
  width: 90%;
  text-align: center;
}

.movie-title {
  font-size: 3vw;
  margin-bottom: 2vh;
}

.movie-subtitle {
  font-size: 2vw;
  margin-bottom: 2vh;
}

.movie-info {
  font-size: 1.5vw;
  margin-bottom: 2vh;
}

</style>
