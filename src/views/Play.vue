<template>
  <div>
    <div class="d-flex text-center justify-center mt-5">
      <div v-if="!showPlayGround">
        <v-card class="p-5" width="400">
          <v-card class="elevation-12">
            <v-toolbar dark color="primary">
              <v-toolbar-title>Want To play?</v-toolbar-title>
            </v-toolbar>
            <v-card-text>
              <v-form ref="form" v-model="valid" lazy-validation>
                <v-text-field
                  prepend-icon="mdi-person"
                  name="login"
                  label="Login"
                  type="text"
                  v-model="email"
                  :rules="[(v) => !!v || 'email is required']"
                ></v-text-field>
                <v-text-field
                  id="password"
                  prepend-icon="mdi-lock"
                  name="password"
                  label="Password"
                  type="password"
                  v-model="password"
                  :rules="[(v) => !!v || 'pasword is required']"
                ></v-text-field>
              </v-form>
            </v-card-text>
            <v-card-actions>
              <v-btn
                :disabled="!valid"
                color="primary"
                class="mr-4"
                @click="signUp('signup')"
                >Sign up</v-btn
              >
              <v-spacer></v-spacer>
              <v-btn
                :disabled="!valid"
                color="primary"
                class="mr-4"
                @click="signUp('login')"
                >Login</v-btn
              >
            </v-card-actions>
          </v-card></v-card
        >
      </div>
      <div v-if="showPlayGround">
        <v-card :loading="loading" class="mb-4 mr-4" width="800">
          <v-card-text>
            <v-simple-table>
              <template v-slot:default>
                <thead>
                  <tr>
                    <th class="text-left">date</th>
                    <th class="text-center">Team 1</th>
                    <th class="text-center">Team 2</th>
                    <th class="text-right">Play</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item in list" :key="item.name">
                    <td class="text-left">{{ item.date }}</td>
                    <td class="text-center">{{ item.homeName }}</td>
                    <td class="text-center">{{ item.awayName }}</td>
                    <td class="text-right">
                      <v-btn icon color="primary" @click="predict(item)">
                        <v-icon>mdi-soccer</v-icon></v-btn
                      >
                    </td>
                  </tr>
                </tbody>
              </template>
            </v-simple-table>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" rounded @click="logout">logout</v-btn>
          </v-card-actions>
        </v-card>
      </div>
    </div>
    <v-dialog
      v-model="moadl"
      persistent
      :overlay="false"
      max-width="500px"
      transition="dialog-transition"
    >
      <v-card style="">
        <v-card-title
          class="bg primary"
          style="justify-content: center; color: white"
          primary-title
        >
          who will win?
          <span style="cursor: pointer" @click="moadl = false" class="ml-auto"
            ><v-icon color="white">mdi-close</v-icon></span
          ></v-card-title
        >
        <v-card-actions style="justify-content: center; text-align: center">
          <v-form ref="form2" v-model="valid2" lazy-validation>
            <div class="">
              <v-radio-group
                :rules="[(v) => !!v || 'Team is required']"
                row
                v-model="match.willWin"
              >
                <v-radio
                  :label="match.homeName"
                  :value="match.homeName"
                ></v-radio>
                <v-radio
                  :label="match.awayName"
                  :value="match.awayName"
                ></v-radio>
              </v-radio-group>

              <v-select
                class="mt-4"
                rounded
                solo
                :items="[0, 1, 2, 3, 4, 5]"
                v-model="match.byGoals"
                label="By Goals"
              ></v-select>

              <v-btn color="primary" block rounded ripple @click="submit"
                >Submit</v-btn
              >
            </div>
          </v-form>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-snackbar :color="snackbarColor" v-model="snackbar">
      {{ snackbarText }}
    </v-snackbar>
  </div>
</template>
<script>
import api from "@/service/api";
import moment from "moment";

export default {
  async created() {
    if (localStorage.getItem("loggedIn") == "true") {
      this.showPlayGround = true;
      await this.getSeasons();
    }
   
  },
  data() {
    return {
      loading: true,
      matches: [],
      user: [],
      snackbarColor: "",
      snackbar: false,
      snackbarText: "",
      valid: true,
      valid2: true,
      loggedin: true,
      showPlayGround: false,
      moadl: false,
      email: "",
      password: "",
      leauge: "",
      match: {},
      desserts: [],
    };
  },
  methods: {
    logout() {
      localStorage.removeItem("loggedIn");
      localStorage.removeItem("user");
      this.showPlayGround = false;
    },
    notify(color, text) {
      this.snackbar = true;
      (this.snackbarText = text), (this.snackbarColor = color);
    },
    async signUp(type) {
      if (type == "signup") {
        if (this.$refs.form.validate()) {
          let user = {
            email: this.email,
            password: this.password,
            point: 0,
            matches: 0,
          };
          let self = this;
          await api
            .signUp(user)
            .then(() => {
              self.notify("success", "Successfulley Registrer");
              localStorage.setItem("loggedIn", true);
              localStorage.setItem("user", this.email);
              self.getSeasons();
              this.showPlayGround = true;
            })
            .catch((er) => {
              self.notify("error", "can not Sign now, Try again");
              console.log(er);
            });
        }
      } else if (type == "login") {
        if (this.$refs.form.validate()) {
          let user = {
            email: this.email,
          };
          let self = this;
          await api
            .login(user)
            .then((e) => {
              if (e.data == false) {
                self.notify("error", "User Not Found");
              } else {
                self.notify("success", "Successfulley logegd in");
                localStorage.setItem("loggedIn", true);
                localStorage.setItem("user", this.email);
                self.getSeasons();
                this.showPlayGround = true;
              }
            })
            .catch((er) => {
              self.notify("error", "User Not Found");
              console.log(er);
            });
        }
      }
    },
    predict(item) {
      this.openModal(item);
    },
    submit() {
      let self = this;
      if (this.$refs.form2.validate()) {
        api
          .predictMtch(this.match)
          .then((e) => {
            self.notify("success", "Successfully predicted");
            self.moadl = false;
            console.log(e);
          })
          .catch((e) => {
            console.log(e);
          });
      }
    },
    openModal(item) {
      this.moadl = true;
      this.match.homeName = item.homeName;
      this.match.awayName = item.awayName;
       this.match.user = localStorage.getItem("user");
      this.match.league = item.league;
      this.match.date = item.date;
    },
    async getSeasons() {
      let self = this;

      const user = localStorage.getItem("user");
      await api
        .FIXTURES()
        .then((res) => {
          if (self.desserts.length == 0) {
            res.data.data.forEach((element, i) => {
              if (i < 3) {
                self.desserts.push({
                  date: moment(element.date).format("MM-DD-YYYY hh:mm A"),
                  homeName: element.homeName,
                  awayName: element.awayName,
                  willWin: 0,
                  byGoals: 0,
                  user: user,
                  league: element.leagueName,
                });
              }
            });
          }
          self.loading = false;
        })
        .catch((e) => {
          console.log(e);
          self.loading = false;
        });
    },
  },
  computed: {
    list() {
      return this.desserts;
    },
  },
};
</script>
