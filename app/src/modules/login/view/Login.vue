<template>
  <v-row align="center" justify="center">
    <v-col cols="12">
      <v-card
        class="elevation-12 mx-auto"
        style="z-index: 5"
        max-width="600"
        min-width="300"
        rounded="lg"
        dark
      >
        <v-card-text>
          <v-row class="mt-8">
            <v-col cols="12">
              <v-text-field
                outlined
                label="E-mail"
                v-model="login.email"
                prepend-icon="mdi-account"
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                outlined
                label="Senha"
                type="password"
                v-model="login.password"
                prepend-icon="mdi-lock"
              />
            </v-col>
          </v-row>
        </v-card-text>
        <v-card-actions class="mb-3">
          <v-row>
            <v-col cols="12" class="d-flex justify-center">
              <v-btn color="info" text> Esqueci minha senha </v-btn>
              <v-spacer></v-spacer>
              <v-btn color="info" outlined class="mx-2">Criar Conta</v-btn>
              <!-- to="/agenda" -->
              <v-btn
                outlined
                color="success"
                dark
                class="mr-2"
                :loading="loading"
                @click="loginApi()"
                >Login</v-btn
              >
            </v-col>
          </v-row>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import Cookies from "js-cookie";
export default {
  data: () => ({
    login: {
      email: "julio@julio.com",
      password: "julio123",
    },
    loading : false
  }),
  methods: {
    async loginApi() {
      try {
          this.loading = true;
        const response = await this.$http.post("login/email", this.login);
        if (response.data.access_token) {
          console.log(response.data.access_token);
          const token = response.data.access_token;
          Cookies.set("_todolist_token", token, { expires: 30 });
          this.$userData = response.data.user;

          console.log(this.$userData);
        }
      } catch (error) {
        this.$root.vtoast.show({
          message: error.response.data.error,
          color: "error",
        });

        console.log(error.response.data.message);
      } finally {
          this.loading = false;
      }
    },
  },
};
</script>

