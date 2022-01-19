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
        <v-tabs
          v-model="tab"
          active-class="blue"
          height="40"
          background-color="grey darken-2"
          fixed-tabs
          hide-slider
        >
          <v-tabs-slider></v-tabs-slider>

          <v-tab href="#tab-1">
            Fazer Login
            <v-icon>mdi-login</v-icon>
          </v-tab>

          <v-tab href="#tab-2">
            Novo Usuário
            <v-icon>mdi-account-plus</v-icon>
          </v-tab>
        </v-tabs>
        <v-tabs-items v-model="tab" dark>
          <v-tab-item :value="'tab-1'">
            <v-card-text>
              <v-card flat> </v-card>
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
          </v-tab-item>
          <v-tab-item :value="'tab-2'">
            <v-card-text>
              <v-card flat> </v-card>
              <v-row class="mt-8">
                <v-col cols="6">
                  <v-text-field
                    outlined
                    label="Nome"
                    v-model="register.first_name"
                    prepend-icon="mdi-account"
                  />
                </v-col>
                <v-col cols="6">
                  <v-text-field
                    outlined
                    label="Sobrenome"
                    v-model="register.last_name"
                    prepend-icon="mdi-account"
                  />
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    outlined
                    label="E-mail"
                    v-model="register.email"
                    prepend-icon="mdi-account"
                  />
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    outlined
                    label="Senha"
                    type="password"
                    compact
                    v-model="register.password"
                    prepend-icon="mdi-lock"
                  />
                </v-col>
              </v-row>
            </v-card-text>
            <v-card-actions class="mb-3">
              <v-row>
                <v-col cols="12" class="d-flex justify-center">
                  <v-btn
                    outlined
                    color="success"
                    dark
                    class="mr-2"
                    :loading="loading"
                    @click="registerUser()"
                    >Cadastrar</v-btn
                  >
                </v-col>
              </v-row>
            </v-card-actions>
          </v-tab-item>
        </v-tabs-items>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import Cookies from "@/services/cookie";

export default {
  data: () => ({
    tab: 0,
    login: {
      email: "julio@julio.com",
      password: "julio123",
    },

    register: {
      first_name: null,
      last_name: null,
      email: null,
      password: null,
    },
    loading: false,
  }),
  methods: {
    async loginApi() {
      try {
        this.loading = true;
        const response = await this.$http.post("login/email", this.login);
        if (response.data.access_token) {
          console.log(response.data.access_token);
          const token = response.data.access_token;
          Cookies.setToken(token);
        
          // this.$router.push('/');
        }
      } catch (error) {
        this.$root.vtoast.show({
          message: error.response.data.error,
          color: "error",
        });
      } finally {
        this.loading = false;
      }
    },

    async registerUser() {
      try {
        this.loading = true;
        const response = await this.$http.post("register/email", this.register);
        console.log(response.data.first_name);
        this.$root.vtoast.show({
          message: 'success'
        })

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

