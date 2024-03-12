<template>
  <div class="landing">
    <h1>CINE FABIÁN</h1>
    <p>Disfruta de las mejores películas en nuestra sala de cine.</p>
    <button @click="comprarEntradas">Comprar entradas</button>
  </div>
</template>

<script>
export default {
  methods: {
    comprarEntradas() {
      // Lógica para redirigir a la página de compra de entradas
    }
  }
}
</script>

<style scoped>
.landing {
  text-align: center;
  padding: 20px;
  background-color: #f2f2f2;
}
</style>
