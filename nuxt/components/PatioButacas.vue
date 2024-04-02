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
            fila: fila, // Agregar fila y columna para identificar el asiento
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
      // Enviar los asientos seleccionados al backend
      fetch('http://localhost:8000/api/entradas', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ asientos: this.seleccionados }),
      })
      .then(response => {
        if (response.ok) {
          return response.json();
        } else {
          throw new Error('Error al comprar entradas');
        }
      })
      .then(data => {
        // Manejar la respuesta del backend (por ejemplo, mostrar un mensaje de éxito)
        console.log('Entradas compradas:', data);
      })
      .catch(error => {
        // Manejar cualquier error que ocurra al comunicarse con el backend
        console.error('Error al comprar entradas:', error);
      });
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
