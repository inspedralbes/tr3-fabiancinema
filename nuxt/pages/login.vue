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
        // console.log('Inicio de sesión correcto');
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
.login-container {
  width: 100%;
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f9f9f9;
}

.login-title {
  font-size: 24px;
  margin-bottom: 20px;
  text-align: center;
}

.login-form {
  display: flex;
  flex-direction: column;
}

.form-group {
  margin-bottom: 15px;
}

.form-label {
  font-weight: bold;
}

.form-input {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.login-button {
  padding: 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.login-button:hover {
  background-color: #0056b3;
}

.error-message {
  color: #dc3545;
  margin-top: 10px;
}
</style>
