<template>
    <div class="admin">
        <h1 class="admin-heading">Administración de Películas</h1>

        <!-- Formulario para crear una nueva película -->
        <div class="crear-pelicula">
            <h2 class="form-heading">Crear Nueva Película</h2>
            <form @submit.prevent="crearPelicula" class="form">
                <div class="form-group">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" id="titulo" v-model="nuevaPelicula.titulo" required class="form-input">
                </div>

                <div class="form-group">
                    <label for="director" class="form-label">Director:</label>
                    <input type="text" id="director" v-model="nuevaPelicula.director" required class="form-input">
                </div>

                <div class="form-group">
                    <label for="genero" class="form-label">Género:</label>
                    <input type="text" id="genero" v-model="nuevaPelicula.genero" required class="form-input">
                </div>

                <div class="form-group">
                    <label for="duracion" class="form-label">Duración (minutos):</label>
                    <input type="number" id="duracion" v-model="nuevaPelicula.duracion" required class="form-input">
                </div>

                <button type="submit" class="form-button primary-button">Crear Película</button>
            </form>
        </div>

        <!-- Listado de películas existentes -->
        <div class="listado-peliculas">
            <h2 class="list-heading">Listado de Películas</h2>
            <ul class="list">
                <li v-for="pelicula in peliculas" :key="pelicula.id_pelicula" class="list-item">
                    {{ pelicula.titulo }}
                    <div class="list-buttons">
                        <button @click="editarPelicula(pelicula)" class="list-button edit-button">Editar</button>
                        <button @click="eliminarPelicula(pelicula)" class="list-button delete-button">Eliminar</button>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Formulario para editar una película -->
        <div v-if="peliculaEditando" class="editar-pelicula">
            <h2 class="form-heading">Editar Película</h2>
            <form @submit.prevent="actualizarPelicula" class="form">
                <div class="form-group">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" id="titulo" v-model="peliculaEditando.titulo" required class="form-input">
                </div>

                <div class="form-group">
                    <label for="director" class="form-label">Director:</label>
                    <input type="text" id="director" v-model="peliculaEditando.director" required class="form-input">
                </div>

                <div class="form-group">
                    <label for="genero" class="form-label">Género:</label>
                    <input type="text" id="genero" v-model="peliculaEditando.genero" required class="form-input">
                </div>

                <div class="form-group">
                    <label for="duracion" class="form-label">Duración (minutos):</label>
                    <input type="number" id="duracion" v-model="peliculaEditando.duracion" required class="form-input">
                </div>

                <div class="form-buttons">
                    <button type="submit" class="form-button primary-button">Actualizar Película</button>
                    <button @click="cancelarEdicion" class="form-button secondary-button">Cancelar</button>
                </div>
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
    background-color: #f0f0f0;
    padding: 20px;
    border-radius: 10px;
}

.admin-heading {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

.crear-pelicula,
.editar-pelicula {
    margin-bottom: 20px;
}

.form-heading {
    font-size: 20px;
    margin-bottom: 10px;
    color: #333;
}

.form-label {
    margin-bottom: 5px;
    display: block;
    font-weight: bold;
    color: #333;
}

.form-input {
    margin-bottom: 10px;
    padding: 8px;
    width: calc(100% - 16px);
    border: 1px solid #ccc;
    border-radius: 4px;
}

.form-button {
    margin-top: 10px;
    margin-right: 10px; /* Separación entre botones */
    padding: 8px 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.form-button:hover {
    background-color: #0056b3;
}

.primary-button {
    background-color: #007bff;
}

.secondary-button {
    background-color: #dc3545;
}

.secondary-button:hover {
    background-color: #c82333;
}

.list-heading {
    font-size: 20px;
    margin-bottom: 10px;
    color: #333;
}

.list {
    list-style: none;
    padding: 0;
}

.list-item {
    margin-bottom: 10px;
    display: flex;
    align-items: center;
}

.list-buttons {
    margin-left: auto;
}

.list-button {
    padding: 5px 10px;
    background-color: transparent;
    color: #dc3545;
    border: 1px solid #dc3545;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
}

.list-button:hover {
    background-color: #dc3545;
    color: #fff;
}
</style>
