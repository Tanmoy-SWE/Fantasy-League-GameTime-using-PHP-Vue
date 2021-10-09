<template>
  <div>
    <div v-if="dataLoading" class="text-center mt-4">
      <v-progress-circular indeterminate color="primary"></v-progress-circular>
    </div>
    <div v-else class="mt-4">
      <v-container>
        <h3 class="my-4 white--text">Fixtures</h3>
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
import moment from "moment";
export default {
  data() {
    return {
      search: "",
      dataLoading: true,
      table: [],
      headers: [
        {
          text: "League Name",
          sortable: true,
          value: "leagueName",
        },
        {
          text: "Country Name",
          sortable: true,
          value: "countryName",
        },

        {
          text: "Date",
          align: "start",
          value: "date",
        },
        { text: "Team 1", value: "homeName", sortable: true },
        { text: "Team 2", value: "awayName", sortable: true },
        { text: "Venue Name", value: "venueName" },
      ],
    };
  },
  methods: {
    async getFixtures() {
      let self = this;
      await api
        .FIXTURES()
        .then((res) => {
          res.data.data.forEach((element) => {
            self.table.push({
              leagueName: element.leagueName,
              countryName: element.countryName,
              date: moment(element.date).format("MM-DD-YYYY hh:mm A"),
              homeName: element.homeName,
              awayName: element.awayName,
              venueName: element.venueName,
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
    await self.getFixtures();
    self.dataLoading = false;
  },
};
</script>

<style></style>
