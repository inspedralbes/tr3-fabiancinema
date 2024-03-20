<template>
  <div>
    <h1>Sesión</h1>
    <ficha-pelicula :pelicula="pelicula" />
    <h1>Patio de butacas</h1>
  </div>
</template>

<script>
import { useStore } from '../../stores/store'

export default {
  async asyncData({ params }) {
    const idPelicula = params.id_pelicula
    const store = useStore()

    // Obtener el ID de la película seleccionada desde el store
    const selectedMovieId = store.getSelectedMovieId()

    // Utilizar el ID de la película seleccionada para obtener sus detalles
    // Aquí debes tener lógica para obtener los detalles de la película
    // basados en el ID. Por ejemplo, podrías hacer una llamada a una API
    // para obtener los detalles de la película.

    // Supongamos que tienes una función en tu store para obtener los detalles
    // de la película por su ID.
    const pelicula = await store.getPeliculaById(selectedMovieId)

    return { pelicula }
  },
}
</script>
