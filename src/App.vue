<template>
  <v-app :dark="goDark">
    <v-app-bar app color="primary" dark>
      <v-container class="d-flex align-center">
        <router-link to="/">
          <div class="d-flex align-center">
            <v-img
              alt="Vuetify Logo"
              class="shrink mr-2"
              contain
              src="@/assets/logo.png"
              transition="scale-transition"
              width="70"
              height = "90"
            />
            <div class="display-1" style="color: white !important">
              GameTime
            </div>
          </div>
        </router-link>

        <v-spacer></v-spacer>
        <div class="text-center">
          <v-btn text to="/fixture">Fixtures</v-btn>
          <v-btn text to="/standing">Matches</v-btn>
          <v-btn text to="/all-seasons">EPL Season</v-btn>
          <v-btn text to="/teams">Teams</v-btn>
          <v-btn text to="/play">play fantasy league</v-btn>
          <v-btn text to="/leaderboard">LeaderBoard</v-btn>
        </div>
        <v-spacer></v-spacer>
        <v-btn color="white" to="/admin" icon><v-icon>mdi-login</v-icon></v-btn>
        <v-btn icon v-if="!$vuetify.theme.dark" @click="toggleTheme()">
          <v-icon class="mr-1" color="blue-grey darken-4">mdi-lightbulb</v-icon>
        </v-btn>
        <v-btn icon v-if="$vuetify.theme.dark" @click="toggleTheme()">
          <v-icon color="white">mdi-lightbulb-outline</v-icon>
        </v-btn>
      </v-container>
    </v-app-bar>
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
export default {
  name: "App",

  data() {
    return {
      goDark: false,
    };
  },
  methods: {
    toggleTheme() {
      this.$vuetify.theme.dark = !this.$vuetify.theme.dark;
    },
  },
};
</script>
<style>
.v-application a {
  color: #fff0f0;
  text-decoration: none;
}
.theme--dark.v-application {
  background: #222831 !important;
  color: #ffffff !important;
}
.v-application.white {
  background-color: #393e46 !important;
  border-color: #fff !important;
}
.theme--dark.v-card {
  background-color: #393e46 !important;
  color: #fff;
}
.v-application.white {
  background-color: #222831 !important;
  border-color: #fff !important;
}
.theme--dark.v-data-table {
  background: #222831 !important;
  color: #ffffff !important;
}

.theme--dark.v-data-table > .v-data-table__wrapper > table > thead > tr > th {
  color: #ffffff !important;
}
</style>
