<template>
  <div>
    <div class="info-pelicula">
            <img :src="pelicula.portada" :alt="pelicula.titulo" class="cover-image" />
            <div class="movie-details">
              <h2 class="movie-title">{{ pelicula.titulo }}</h2>
              <h3 class="movie-subtitle">{{ calcularDuracion(pelicula.duracion) }}</h3>
              <p class="movie-info">{{ pelicula.fecha }}</p>
              <p class="movie-info">{{ pelicula.director }}</p>
              <p class="movie-info">{{ pelicula.genero }}</p>
            </div>
          </div>
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
      const horas = Math.floor(duracion / 60);
      const minutos = duracion % 60;
      return `${horas}h ${minutos}min`;
    }
  },

  }

</script>

<style>

</style>