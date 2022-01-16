<template>
  <div
    class="d-flex justify-center skewed-bg"
    style="width: 100%; height: 100%"
  >
    <v-container fill-height fluid>
      <v-layout>
        <router-view />
      </v-layout>
    </v-container>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
.skewed-bg {
  background-image: linear-gradient(to bottom, #431e74, #100818);
  padding: 2em;
  position: relative;
  min-height: 300px;
  overflow: hidden;
}
</style>