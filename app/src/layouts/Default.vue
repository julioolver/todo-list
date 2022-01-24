<template>
  <v-app>
    <v-app-bar app>
      <v-app-bar-nav-icon></v-app-bar-nav-icon>

      <v-toolbar-title>Page title</v-toolbar-title>

      <v-spacer></v-spacer>
      <v-menu bottom min-width="200px" rounded offset-y>
        <template v-slot:activator="{ on }">
          <v-btn icon x-large v-on="on">
            <v-avatar color="brown" size="48">
              <span class="white--text text-h5">{{ user.first_name }}</span>
            </v-avatar>
          </v-btn>
        </template>
        <v-card>
          <v-list-item-content class="justify-center">
            <div class="mx-auto text-center">
              <v-avatar color="brown">
                <span class="white--text text-h5">{{ user.first_name }}</span>
              </v-avatar>
              <h3></h3>
              <p class="text-caption mt-1">
                {{ user.email }}
              </p>
              <v-divider class="my-3"></v-divider>
              <v-btn
                depressed
                rounded
                text
                :to="{ name: 'profile', params: { id: user.id } }"
              >
                Edit Account
              </v-btn>
              <v-divider class="my-3"></v-divider>
              <v-btn depressed rounded text> Disconnect </v-btn>
            </div>
          </v-list-item-content>
        </v-card>
      </v-menu>
    </v-app-bar>
    <v-container fluid>
      <!-- <v-layout> -->
      <router-view />
      <!-- </v-layout> -->
    </v-container>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    user: {},
  }),

  async mounted() {
    // const userData = await this.$http.get("/me");
    // Vue.prototype.$userData = userData.data.user;
    this.user = this.$userData;

    console.log(this.$userData);
  },
  methods: {},
};
</script>