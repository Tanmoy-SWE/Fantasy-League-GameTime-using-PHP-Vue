<template>
  <v-app :dark="goDark">
    <v-container v-show="$vuetify.breakpoint.mdAndUp">
    <v-system-bar absolute app  
      light
      color="white"
      height="50"
      class="p-5"
    >
    <v-spacer></v-spacer>
    <club-list  class="mr-5">> </club-list>
    </v-system-bar>
    </v-container>

    <v-app-bar app color="transparent" dark>
   
    <v-container class="d-flex align-center">
       <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
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
          </div>
        </router-link>
                    <v-card color="white" class="p-3" href="https://www.premierleague.com/"  v-show="$vuetify.breakpoint.mdAndUp">
              <v-img
                dark
                alt="Vuetify Logo"
                src="https://cdn.freebiesupply.com/images/large/2x/premier-league-logo-png-transparent.png"
                transition="scale-transition"
                width="100"
                background-color="white"
              />
            </v-card>

        <v-spacer></v-spacer>
        <div class="text-center" v-show="$vuetify.breakpoint.mdAndUp">
          <v-btn v-for="(i, index) in nav" :key="index"  text :to="i.to">{{ i.name}}</v-btn>
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
    <v-navigation-drawer
      v-model="drawer"
      absolute
      left
      temporary
    >
      <v-list
        nav
        dense
      >
        <v-list-item-group
          v-model="group"
          active-class="deep-purple--text text--accent-4"
        >
        <v-list-item >
            <v-list-item-title>
                                  <v-card color="white" class="p-3"  href="https://www.premierleague.com/"   v-show="$vuetify.breakpoint.mdAndUp">
              <v-img
                dark
                alt="Vuetify Logo"
                src="https://cdn.freebiesupply.com/images/large/2x/premier-league-logo-png-transparent.png"
                transition="scale-transition"
                width="100"
                background-color="white"
              />
            </v-card>
            </v-list-item-title>
          </v-list-item>
          <v-list-item  v-for="(i, index) in nav" :key="index">
            <v-btn text :to="i.to">{{ i.name}}</v-btn>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
import ClubList from './components/ClubList.vue';
export default {
  components: { ClubList },
  name: "App",

  data() {
    return {
      goDark: false,
        drawer: false,
      group: null,
      nav:[
        {name:"Fixtures", to : "/fixture"},
        {name:"All Leagues",to:"/standing"},
        {name:"EPL Season",to:"/all-seasons"},
        //{name:"Teams",to:"/teams"},
        {name:"Fantasy league",to:"/play"},
        {name:"LeaderBoard",to:"/leaderboard"}]
    };
  },
  methods: {
    toggleTheme() {
      this.$vuetify.theme.dark = !this.$vuetify.theme.dark;
    },
  },
   watch: {
      group () {
        this.drawer = false
      },
    },
};
</script>
<style>
#app {
  background-image: url("./assets/bg.jpg");
  height: 100%;

  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.theme--dark.v-application {
  background-image: none !important;
}
.theme--light.v-application {
  background: #fff;
  color: rgb(255 255 255);
}
.theme--dark.v-application {
  background: #222831 !important;
  color: #ffffff !important;
}
</style>
