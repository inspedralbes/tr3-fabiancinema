<template>
  <div class="patio-butacas">
    <div v-for="fila in 7" :key="fila" class="fila">
      <div v-for="(asiento, index) in butacas[fila - 1]" :key="`fila-${fila}-asiento-${index + 1}`" class="asiento"
        :class="{ vip: asiento.vip, ocupado: asiento.ocupado }" @click="toggleAsiento(asiento)">
        <img :src="getButacaImage(asiento)" :alt="'Asiento ' + (asiento.vip ? 'VIP' : 'Normal')" />
      </div>
    </div>
    <div class="pasarela-compra" v-if="mostrarPasarela">
      <h2>Detalles de la compra</h2>
      <p>Total: {{ total }}€</p>
      <button @click="solicitarCorreoYComprar">Comprar</button>
    </div>
  </div>
</template>

<script>
import { actualizarEstadoAsientos, comprarEntradasFetch } from '../services/communicationManager';

export default {
  data() {
    return {
      butacas: [],
      seleccionados: [],
      asientosTemporalesSeleccionados: [],
      mostrarPasarela: false,
      correoElectronico: '',
    };
  },
  mounted() {
    this.inicializarButacas();
    actualizarEstadoAsientos(this.$route.params.id_pelicula).then(data => {
      this.actualizarButacas(data);
    });
    setInterval(() => {
      actualizarEstadoAsientos(this.$route.params.id_pelicula).then(data => {
        this.actualizarButacas(data);
      });
    }, 5000);
  },
  methods: {
    async inicializarButacas() {
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
    async actualizarButacas(entradas) {
      const idSesionActual = this.$route.params.id_pelicula;
      entradas.forEach(entrada => {
        if (entrada.id_sesion == idSesionActual) {
          const fila = entrada.fila - 1;
          const columna = entrada.columna - 1;
          if (fila >= 0 && fila < this.butacas.length && columna >= 0 && columna < this.butacas[fila].length) {
            this.butacas[fila][columna].ocupado = true;
          }
        }
      });
    },
    toggleAsiento(asiento) {
      if (!asiento.ocupado) {
        asiento.ocupado = !asiento.ocupado;
        this.asientosTemporalesSeleccionados.push(asiento);
        this.actualizarSeleccionados();
      } else if (!this.asientosTemporalesSeleccionados.includes(asiento)) {
        alert('Este asiento ya está ocupado. Por favor, seleccione otro.');
      } else {
        asiento.ocupado = !asiento.ocupado;
        const index = this.asientosTemporalesSeleccionados.indexOf(asiento);
        if (index > -1) {
          this.asientosTemporalesSeleccionados.splice(index, 1);
        }
        this.actualizarSeleccionados();
      }
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
    async solicitarCorreoYComprar() {
      const correo = prompt('Por favor, ingresa tu correo electrónico:');
      if (correo) {
        this.correoElectronico = correo;
        await this.comprarEntradas(); // Llamar al método comprarEntradas después de obtener el correo
      }
    },
    async comprarEntradas() {
      if (this.asientosTemporalesSeleccionados.length <= 10 && this.asientosTemporalesSeleccionados.length > 0) {
        let entradas = [];

        for (let i = 0; i < this.asientosTemporalesSeleccionados.length; i++) {
          entradas.push({
            id_sesion: this.$route.params.id_pelicula,
            fila: this.asientosTemporalesSeleccionados[i].fila,
            columna: this.asientosTemporalesSeleccionados[i].columna,
            precio: this.asientosTemporalesSeleccionados[i].vip ? 8 : 6,
            correo: this.correoElectronico,
          });
        }

        try {
          await comprarEntradasFetch(entradas);
          console.log('Entradas compradas correctamente');
          // this.enviarCorreoConfirmacion(this.correoElectronico);
          this.$router.push('/');
        } catch (error) {
          alert('Error al comprar las entradas');
          console.error(error);
        }
      } else {
        alert('Puedes comprar un máximo de 10 entradas a la vez y debes seleccionar al menos una');
      }
    },
    // async enviarCorreoConfirmacion(correoElectronico) {
    //   try {
    //     const response = await fetch(`${url}/enviar-correo`, {
    //       method: 'POST',
    //       headers: {
    //         'Content-Type': 'application/json'
    //       },
    //       body: JSON.stringify({ correo: correoElectronico })
    //     });
    //     if (response.status === 200) {
    //       console.log('Correo electrónico enviado correctamente');
    //     } else {
    //       console.error('Error al enviar el correo electrónico');
    //     }
    //   } catch (error) {
    //     console.error('Error al enviar el correo electrónico:', error);
    //   }
    // },
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
      this.asientosTemporalesSeleccionados.forEach(asiento => {
        total += asiento.vip ? 8 : 6;
      });
      return total;
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
  justify-content: center;
  margin-bottom: 2vh;
}

.asiento {
  margin: 1vw;
}

.asiento img {
  width: 5vw;
}

.pasarela-compra {
  margin-top: 5vh;
  text-align: center;
}
</style>
