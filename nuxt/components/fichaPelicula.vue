<template>
  <div v-if="pelicula">
    <div class="info-pelicula">
      <img :src="pelicula.portada" :alt="pelicula.titulo" class="cover-image" />
      <div class="movie-details">
        <h2 class="movie-title">{{ pelicula.titulo }}</h2>
        <h3 class="movie-subtitle">{{ calcularDuracion(pelicula.duracion) }}</h3>
        <p class="movie-info">{{ pelicula.fecha }}</p>
        <fichaSesion :sesion="sesion" :pelicula="pelicula" class="ficha-sesion" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      pelicula: null,
      sesion: null,
    };
  },
  mounted() {
    this.obtenerSesion();
  },
  props: {
    pelicula: {
      type: Object,
      required: true,
    },
  },
  methods: {
    async obtenerSesion() {
      try {
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
    calcularDuracion(duracion) {
      const horas = Math.floor(duracion / 60);
      const minutos = duracion % 60;

     console.log(duracion);
      if (horas === 0) {
        return `${minutos}min`;
      } else {
        return `${horas}h ${minutos}min`;
      }
    }
  },
}
</script>

<style>
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
  width: 16vw;
  height: 46vh;
  border-radius: 5px 5px 5px 5px;
  margin-right: 1vh;
  margin-left: 1vh;
  margin-top: 1vh;
}

.movie-details {
  padding: 10px;
  margin-bottom: 10px;
  margin-top: 2vh;
}

.movie-title {
  font-size: 1.2rem;
  margin-top: 5px;
}

.movie-subtitle {
  font-size: 1rem;
  margin-top: 0;
}

.movie-info {
  margin-bottom: -5px;
}

.movie-link {
  color: inherit;
  text-decoration: none;
}
</style>
