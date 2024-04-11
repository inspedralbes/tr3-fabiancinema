<template>
  <header class="site-header">
    <nav class="navbar">
      <div class="logo">
        <router-link to="/" class="logo-link">Fabian Cine</router-link>
      </div>
    </nav>
  </header>
</template>

<script>
export default {
}
</script>

<style scoped>
.site-header {
  background-color: #1a1a1a;
  color: #fff;
  padding: 10px 0;
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 20px;
}

.logo-link {
  color: #fff;
  text-decoration: none;
  font-size: 1.5rem;
  font-weight: bold;
}

.logo-link:hover {
  text-decoration: underline;
}
</style>