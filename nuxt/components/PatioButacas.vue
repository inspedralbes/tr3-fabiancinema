<template>
  <div class="container">
    <div class="patio-butacas">
      <div v-for="fila in 7" :key="fila" class="fila">
        <div v-for="(asiento, index) in butacas[fila - 1]" :key="`fila-${fila}-asiento-${index + 1}`" class="asiento"
          :class="{ vip: asiento.vip, ocupado: asiento.ocupado }" @click="toggleAsiento(asiento)">
          <img :src="getButacaImage(asiento)" :alt="'Asiento ' + (asiento.vip ? 'VIP' : 'Normal')" />
        </div>
      </div>
    </div>
    <div class="pasarela-compra" v-if="mostrarPasarela">
      <h2>Detalles de la compra</h2>
      <p>Total: {{ total }}€</p>
      <button @click="comprarEntradas">Comprar</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      butacas: [],
      seleccionados: [],
      mostrarPasarela: false,
    };
  },
  mounted() {
    this.inicializarButacas();
  },
  methods: {
    inicializarButacas() {
      for (let fila = 1; fila <= 7; fila++) {
        let filaButacas = [];
        for (let asiento = 1; asiento <= 10; asiento++) {
          let vip = false;

          if (fila === 4) {
            vip = true;
          }
          filaButacas.push({
            vip: vip,
            ocupado: false,
            fila: fila,
            columna: asiento,
          });
        }
        this.butacas.push(filaButacas);
      }
    },
    toggleAsiento(asiento) {
      asiento.ocupado = !asiento.ocupado;
      this.actualizarSeleccionados();
    },
    actualizarSeleccionados() {
      this.seleccionados = [];
      this.butacas.forEach(fila => {
        fila.forEach(asiento => {
          if (asiento.ocupado) {
            this.seleccionados.push(asiento);
          }
        });
      });
      this.mostrarPasarela = this.seleccionados.length > 0;
    },
    comprarEntradas() {
      // Filtrar solo los asientos seleccionados
      const asientosSeleccionados = this.butacas.flatMap(fila => fila.filter(asiento => asiento.ocupado));

      if (asientosSeleccionados.length <= 10 && asientosSeleccionados.length > 0) {
        let entrada = [];

        for (let i = 0; i < asientosSeleccionados.length; i++) {
          entrada.push({
            id_sesion: this.$route.params.id_pelicula,
            fila: asientosSeleccionados[i].fila,
            columna: asientosSeleccionados[i].columna,
            precio: asientosSeleccionados[i].vip ? 8 : 6,
          });
        }

        return new Promise((resolve, reject) => {
          fetch('http://localhost:8000/api/entradas', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify(entrada),
          }).then(response => {
            if (response.status == 200) {
              return response.json();
            } else {
              reject('Error al comprar la entrada');
            }
          }).then(data => {
            JSON.stringify(data);
            resolve(data);
          }).catch(error => {
            reject(error);
          });
        });
      } else {
        alert('Puedes comprar un máximo de 10 entradas a la vez y debes seleccionar al menos una');
      }
    },

    getButacaImage(asiento) {
      if (asiento.vip) {
        return asiento.ocupado ? '/butacas/butaca-vip-ocupada.jpg' : '/butacas/butaca-vip-libre.jpg';
      } else {
        return asiento.ocupado ? '/butacas/butaca-normal-ocupada.jpg' : '/butacas/butaca-normal-libre.jpg';
      }
    },
  },
  computed: {
    total() {
      let total = 0;
      this.seleccionados.forEach(asiento => {
        total += asiento.vip ? 8 : 6;
      });
      return total;
    },
  },
};
</script>

<style scoped>
.container {
  display: flex;
}

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

.pasarela-compra {
  margin-left: 20px;
}
</style>
