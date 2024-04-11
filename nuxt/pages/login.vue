<template>
    <div class="login-container">
      <h1 class="login-title">Iniciar sesión</h1>
      <form @submit.prevent="login" class="login-form">
        <div class="form-group">
          <label for="email" class="form-label">Correo electrónico:</label>
          <input type="email" id="email" v-model="email" class="form-input">
        </div>
        <div class="form-group">
          <label for="password" class="form-label">Contraseña:</label>
          <input type="password" id="password" v-model="password" class="form-input">
        </div>
        <button type="submit" class="login-button">Iniciar sesión</button>
        <p v-if="error" class="error-message">{{ error }}</p>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        email: '',
        password: '',
        error: ''
      };
    },
    methods: {
      async login() {
        try {
          const response = await fetch('/login', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              email: this.email,
              password: this.password
            })
          });
  
          if (!response.ok) {
            throw new Error('Credenciales incorrectas');
          }
          console.log('Inicio de sesión correcto');
          this.$router.push('/admin');
        } catch (error) {
          console.error('Error al iniciar sesión:', error);
          // Mostrar mensaje de error
          this.error = 'Credenciales incorrectas. Por favor, inténtalo de nuevo.';
        }
      }
    }
  };
  </script>
  
  <style scoped>
  /* Estilos CSS específicos para este componente */
  </style>
  