<template>
    <div class="admin">
        <h1>Administración de Películas</h1>

        <!-- Formulario para crear una nueva película -->
        <div class="crear-pelicula">
            <h2>Crear Nueva Película</h2>
            <form @submit.prevent="crearPelicula">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" v-model="nuevaPelicula.titulo" required>

                <label for="director">Director:</label>
                <input type="text" id="director" v-model="nuevaPelicula.director" required>

                <label for="genero">Género:</label>
                <input type="text" id="genero" v-model="nuevaPelicula.genero" required>

                <label for="duracion">Duración (minutos):</label>
                <input type="number" id="duracion" v-model="nuevaPelicula.duracion" required>

                <button type="submit">Crear Película</button>
            </form>
        </div>

        <!-- Listado de películas existentes -->
        <div class="listado-peliculas">
            <h2>Listado de Películas</h2>
            <ul>
                <li v-for="pelicula in peliculas" :key="pelicula.id_pelicula">
                    {{ pelicula.titulo }}
                    <button @click="editarPelicula(pelicula)">Editar</button>
                    <button @click="eliminarPelicula(pelicula)">Eliminar</button>
                </li>
            </ul>
        </div>

        <!-- Formulario para editar una película -->
        <div v-if="peliculaEditando" class="editar-pelicula">
            <h2>Editar Película</h2>
            <form @submit.prevent="actualizarPelicula">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" v-model="peliculaEditando.titulo" required>

                <label for="director">Director:</label>
                <input type="text" id="director" v-model="peliculaEditando.director" required>

                <label for="genero">Género:</label>
                <input type="text" id="genero" v-model="peliculaEditando.genero" required>

                <label for="duracion">Duración (minutos):</label>
                <input type="number" id="duracion" v-model="peliculaEditando.duracion" required>

                <button type="submit">Actualizar Película</button>
                <button @click="cancelarEdicion">Cancelar</button>
            </form>
        </div>
    </div>
</template>

<script>
// Importa las funciones desde communicationManager.js
import { obtenerPeliculas, obtenerSesion, actualizarEstadoAsientos, comprarEntradasFetch, crearPelicula, actualizarPelicula, eliminarPelicula } from '../services/communicationManager';


export default {
    data() {
        return {
            peliculas: [],
            nuevaPelicula: {
                titulo: '',
                director: '',
                genero: '',
                duracion: null
            },
            peliculaEditando: null
        };
    },
    async mounted() {
        await this.obtenerPeliculas();
    },
    methods: {
        async obtenerPeliculas() {
            try {
                this.peliculas = await obtenerPeliculas();
            } catch (error) {
                console.error('Error al obtener las películas:', error);
            }
        },
        async crearPelicula() {
            try {
                await crearPelicula(this.nuevaPelicula);
                this.nuevaPelicula = { titulo: '', director: '', genero: '', duracion: null };
                await this.obtenerPeliculas();
            } catch (error) {
                console.error('Error al crear la película:', error);
            }
        },
        editarPelicula(pelicula) {
            this.peliculaEditando = { ...pelicula };
        },
        async actualizarPelicula() {
            try {
                await actualizarPelicula(this.peliculaEditando.id_pelicula, this.peliculaEditando);
                this.peliculaEditando = null;
                await this.obtenerPeliculas();
            } catch (error) {
                console.error('Error al actualizar la película:', error);
            }
        },
        async eliminarPelicula(pelicula) {
            try {
                await eliminarPelicula(pelicula.id_pelicula);
                await this.obtenerPeliculas();
            } catch (error) {
                console.error('Error al eliminar la película:', error);
            }
        },
        cancelarEdicion() {
            this.peliculaEditando = null;
        }
    }
};
</script>

<style scoped>
.admin {
    margin: 20px;
}

.crear-pelicula,
.editar-pelicula {
    margin-bottom: 20px;
}

button {
    margin-top: 10px;
}
</style>