<template>
  <div>
    <v-container fluid>
      <v-card max-width="700" class="mx-auto">
        <v-toolbar color="primary" class="d-flex justify-center" dark flat>
          <v-toolbar-title class="">Perfil</v-toolbar-title>

          <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text class="text-center">
          <v-row align="center">
            <v-col cols="6">
              <v-text-field label="Nome" v-model="user.first_name" />
            </v-col>
            <v-col cols="6">
              <v-text-field label="Sobrenome" v-model="user.last_name" />
            </v-col>
            <v-col cols="12">
              <v-text-field label="E-mail" v-model="user.email" />
            </v-col>
          </v-row>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="success" outlined @click="update">Atualizar</v-btn>
        </v-card-actions>
      </v-card>
    </v-container>
  </div>
</template>

<script>
export default {
  data: () => ({
    user: {},
    id: 0
  }),

  mounted() {
    this.user = {...this.$userData};
    this.id = this.$route.params.id;
  },

  methods: {
    async update() {
      await this.$http.put(`me/update/${this.id}`, this.user);
    }
  }
};
</script>

<style>
</style>