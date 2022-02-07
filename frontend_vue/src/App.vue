<template>
  <div id="app">
    <Navigation />
    <main class="my-8">
      <router-view />
    </main>
  </div>
</template>
<script>
import Navigation from "@/components/Navigation";

export default {
  name: "App",
  components: {
    Navigation,
  },
  setup() {},
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;
}
#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
