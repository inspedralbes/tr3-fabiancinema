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
  padding: 10px;
  border-radius: 5px;
}

.info-sesion {
  margin: 0;
  color: #fff;
}
</style>
