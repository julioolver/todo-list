<template>
  <v-app class="background-dark">
    <div id="nav">
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link>
    </div>
    <!-- mx-6 mt-3 -->
    <v-main class="">
      <transition name="slide" mode="out-in">
        <router-view />
      </transition>
      <!-- <HelloWorld /> -->
    </v-main>
    <vtoast ref="vtoast" />
  </v-app>
</template>

<script>
import vtoast from "@/components/Toast.vue";
export default {
  name: "App", //or whatever your root is
  components: {
    vtoast,
  },
  mounted() {
    this.$root.vtoast = this.$refs.vtoast;
  },
};
</script>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
.background-dark {
  background-image: linear-gradient(
    rgba(22, 29, 49, 0.9) 44%,
    rgba(22, 29, 49, 0.43) 73%,
    rgba(22, 29, 49, 0)
  );
  background-position-x: initial;
  background-position-y: initial;
  background-size: initial;
  background-repeat-x: initial;
  background-repeat-y: initial;
  background-attachment: initial;
  background-origin: initial;
  background-clip: initial;
  background-color: initial;
}

#nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
