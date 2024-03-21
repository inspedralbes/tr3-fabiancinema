<template>
    <div v-if="sesion">
        <p class="info-sesion">{{ sesion.dia }}</p>
        <p class="info-sesion">{{ sesion.hora }}</p>
    </div>
</template>

<script>
export default {
    props: {
        sesion: {
            type: Object,
            required: true,
        },
        pelicula: {
            type: Object,
            required: true,
        },
    },
}
</script>

<style>
</style>
