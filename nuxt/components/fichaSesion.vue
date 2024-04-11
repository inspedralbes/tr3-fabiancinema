<template>
    <div v-if="sesion" class="session-info">
        <p class="info-sesion">Día: {{ sesion.dia }}</p>
        <p class="info-sesion">Hora: {{ sesion.hora }}</p>
    </div>
</template>

<script>
export default {
    props: {
        sesion: {
            type: Object,
            required: true,
        },
    },
}
</script>

<style scoped>
.session-info {
  background-color: #666;
  padding: 2vh;
  border-radius: 2vw;
}

.info-sesion {
  margin: 0;
  color: #fff;
  font-size: 2vw;
}
</style>
