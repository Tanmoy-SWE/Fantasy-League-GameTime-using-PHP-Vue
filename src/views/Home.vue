<template>
  <v-container class="m-5 p-5 text-center">
    <div v-if="dataLoading" class="text-center mt-4">
      <v-progress-circular indeterminate color="primary"></v-progress-circular>
    </div>
    <div v-else>
      <v-tabs
        v-model="tab"
        background-color="white"
        centered
        light
        icons-and-text
        dense
      >
        <v-tabs-slider></v-tabs-slider>

        <v-tab href="#1">
          Top 5 scorer
          <v-icon color="primary">mdi-soccer</v-icon>
        </v-tab>

        <v-tab href="#2">
          Top red cards
          <v-icon>mdi-credit-card-remove</v-icon>
        </v-tab>

        <v-tab href="#3">
          Top yellow card
          <v-icon>mdi-card-multiple</v-icon>
        </v-tab>
      </v-tabs>
      <carousel-3d controlsVisible height="340" width="400">
        <slide v-for="(p, index) in playerList" :key="index" :index="index">
          <div class="">
            <v-card>
              <v-img :src="p.image" contain height="200"></v-img>
              <div class="primary white--text">
                <v-card-title>Player Name: {{ p.name }} <br /> </v-card-title>
                <v-card-text>
                  <div>Country: {{ p.country }}</div>
                  <div v-if="tab == 2 || tab == 3">Cards: {{ p.card }}</div>
                  <div v-else>Goals: {{ p.goals }}</div>
                  <div>Rank: {{ p.rank }}</div>
                </v-card-text>
              </div>

              <h3></h3
            ></v-card>
          </div>
        </slide>
      </carousel-3d>
    </div>
  </v-container>
</template>

<script>
import { Carousel3d, Slide } from "vue-carousel-3d";
import axios from "axios";
import api from "@/service/api";
export default {
  name: "Home",
  data() {
    return {
      tab: null,
      playerList: [],
      redCards: [],
      yellowCards: [],
      playerListCopy: [],
      dataLoading: true,
    };
  },
  methods: {
    async getToken() {
      let data = "grant_type=client_credentials";
      const authorization =
        "MW5kYnRqbjBybzFhaHZmb3NyOHBzanNmbDI6MWxzcmU2cmtibWQ0NDR1a3Y5dTRvOHIyMWZyMGY4YTl1Mjh0ZGhzZzF1NW0wazZpM2xzZg==";
      await axios
        .post("https://oauth2.elenasport.io/oauth2/token", data, {
          headers: {
            Authorization: "Basic " + authorization,
            "Content-Type": "application/x-www-form-urlencoded",
          },
        })
        .then((res) => {
          console.log("response");
          localStorage.setItem("token", res.data.access_token);
        })
        .catch((e) => {
          // console.log(localStorage.getItem("token"));
          // self.getToken();
          // self.getTopScorer();
          console.log("error", e.status);
        });
    },
    async getTopScorer() {
      let self = this;
      await api
        .TOP_SCORER()
        .then((res) => {
          res.data.data.forEach((el, i) => {
            if (i < 6) {
              if (el.expand !== null) {
                if (el.expand.player !== null) {
                  el.expand.player.forEach((element) => {
                    self.playerList.push({
                      name: element.fullName,
                      image: element.photoURL,
                      country: element.nationalities[0],
                      rank: el.rank,
                      goals: el.totalGoals,
                    });
                  });
                }
              }
            }
          });
          self.playerListCopy = self.playerList;
        })
        .catch((e) => {
          console.log(e);
        });
    },
    async getRedCards() {
      let self = this;
      self.dataLoading = true;
      await api
        .TOP_RED_CARD()
        .then((res) => {
          self.dataFormat(res, self.redCards);
          self.redCards.push(self.redCards[0]);
        })
        .catch((e) => {
          console.log(e);
        });
      self.dataLoading = false;
    },
    async getYellowCards() {
      let self = this;
      self.dataLoading = true;
      await api
        .TOP_YELLOW_CARD()
        .then((res) => {
          self.dataFormat(res, self.yellowCards);
        })
        .catch((e) => {
          console.log(e);
        });
      self.dataLoading = false;
    },
    dataFormat(response, list) {
      response.data.data.forEach((el, i) => {
        if (i < 6) {
          if (el.expand !== null) {
            if (el.expand.player !== null) {
              el.expand.player.forEach((element) => {
                if (element.nationalities !== null) {
                  list.push({
                    name: element.fullName,
                    image: element.photoURL,
                    country: element.nationalities[0],
                    rank: el.rank,
                    card: el.tot,
                  });
                }
              });
            }
          }
        }
      });
    },
  },
  components: {
    Carousel3d,
    Slide,
  },
  async created() {
    let self = this;
    await self.getToken();

    if (localStorage.getItem("token" == null)) {
      await self.getToken();
    }
    await self.getTopScorer();
    this.dataLoading = false;
  },
  watch: {
    async tab(value) {
      if (value == 2) {
        if (this.redCards.length == 0) {
          await this.getRedCards();
          this.playerList = this.redCards;
        } else {
          this.playerList = this.redCards;
        }
      }
      if (value == 1) {
        this.playerList = this.playerListCopy;
      }
      if (value == 3) {
        if (this.yellowCards.length == 0) {
          await this.getYellowCards();
          this.playerList = this.yellowCards;
        } else {
          this.playerList = this.yellowCards;
        }
      }
    },
  },
};
</script>
