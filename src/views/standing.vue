<template>
  <div>
    <div v-if="dataLoading" class="text-center mt-4">
      <v-progress-circular indeterminate color="primary"></v-progress-circular>
    </div>
    <div v-else class="mt-4">
      <v-container>
        <h3 class="my-4">All Leagues</h3>
        <v-card class="elevation-5 p-4">
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
            class="px-4"
          ></v-text-field>
          <v-data-table :search="search" :headers="headers" :items="table">
          </v-data-table>
        </v-card>
      </v-container>
    </div>
  </div>
</template>

<script>
import api from "@/service/api";
// import moment from "moment";
export default {
  data() {
    return {
      search: "",
      dataLoading: true,
      table: [],
      headers: [
        {
          text: "Country Name",
          sortable: true,
          value: "countryName",
        },
        {
          text: "League Name",
          sortable: true,
          value: "leagueName",
        },

        {
          text: "Start Year",
          sortable: true,
          value: "start",
        },
        {
          text: "End Year",
          sortable: true,
          value: "end",
        },
        // { text: "Team 1", value: "homeName", sortable: true },
        // { text: "Team 2", value: "awayName", sortable: true },
        // { text: "Venue Name", value: "venueName" },
      ],
    };
  },
  methods: {
    async getLeauge() {
      let self = this;
      await api
        .LEAUGE()
        .then((res) => {
          res.data.data.forEach((element) => {
            self.table.push({
              leagueName: element.name,
              countryName: element.countryName,
              start: element.expand.current_season[0].start,
              end: element.expand.current_season[0].end,
            });
          });
        })
        .catch((e) => {
          console.log(e);
        });
    },
  },
  async created() {
    let self = this;
    await self.getLeauge();
    self.dataLoading = false;
  },
};
</script>

<style></style>
