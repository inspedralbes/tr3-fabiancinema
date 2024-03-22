<template>
  <div class="patio-butacas">
    <div v-for="fila in 7" :key="fila" class="fila">
      <div v-for="asiento in 10" :key="`fila-${fila}-asiento-${asiento}`" class="asiento"
           :class="{ vip: asiento.vip, ocupado: asiento.ocupado }" @click="toggleAsiento(asiento)">
        <img :src="getButacaImage(asiento)" :alt="'Asiento ' + (asiento.vip ? 'VIP' : 'Normal')" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      butacas: [],
    };
  },
  mounted() {
    this.inicializarButacas();
  },
  methods: {
    inicializarButacas() {
      for (let fila = 1; fila <= 7; fila++) {
        for (let asiento = 1; asiento <= 10; asiento++) {
          let vip = false; // Inicialmente todos son normales
          // Si es la fila 4 y está entre el cuarto y el noveno asiento, lo marcamos como VIP
          if (fila === 4 && asiento >= 3 && asiento <= 8) {
            vip = true;
          }
          this.butacas.push({
            vip: vip,
            ocupado: false,
          });
        }
      }
    },
    toggleAsiento(asiento) {
      asiento.ocupado = !asiento.ocupado;
    },
    getButacaImage(asiento) {
      if (asiento.vip) {
        return asiento.ocupado ? '/butacas/butaca-vip-ocupada.jpg' : '/butacas/butaca-vip-libre.jpg';
      } else {
        return asiento.ocupado ? '/butacas/butaca-normal-ocupada.jpg' : '/butacas/butaca-normal-libre.jpg';
      }
    },
  },
};
</script>

<style scoped>
.patio-butacas {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.fila {
  display: flex;
}

.asiento {
  margin: 5px;
}

.asiento img {
  width: 50px;
}

.asiento.vip {
  border: 2px solid gold;
}

.asiento.ocupado {
  border: 2px solid red;
}
</style>
