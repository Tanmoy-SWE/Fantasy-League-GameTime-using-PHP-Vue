<template>
  <div class="p-5 mt-4">
    <v-data-table
      :headers="headers"
      class="elevation-5 m-4 pl-4 pr-4"
      pagination.sync="pagination"
      :loading="loading"
      search="search"
    >
      <template slot="body">
        <tbody>
          <tr v-for="item in items" :key="item.id">
            <td>
              {{ item.date }}
            </td>
            <td>{{ item.league }}</td>
            <td class="text-xs-right">{{ item.homeName }}</td>
            <td class="text-xs-right">{{ item.awayName }}</td>
            <td class="text-xs-right">
              <v-btn icon color="primary"
                ><v-icon @click="selectMatch(item)">mdi-pen</v-icon></v-btn
              >
            </td>
          </tr>
        </tbody>
      </template>
    </v-data-table>
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
          Update Score
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
  </div>
</template>

<script>
import api from "@/service/api";
import moment from "moment";
export default {
  data() {
    return {
      moadl: false,
      loading: true,
      headers: [
        {
          text: "Date",
          align: "start",
          value: "date",
          sortable: true,
        },
        { text: "league", value: "league", sortable: true },
        { text: "Home Team", value: "homeName", sortable: true },
        { text: "Away Team", value: "awayName", sortable: true },
        { text: "Action" },
      ],
      items: [],
      match: {},
      valid2: true,
    };
  },
  methods: {
    selectMatch(item) {
      this.openModal(item);
    },
    openModal(item) {
      this.moadl = true;
      this.match.homeName = item.homeName;
      this.match.awayName = item.awayName;
      this.match.league = item.league;
      this.match.date = item.date;
    },
    async getMatches() {
      let self = this;

      await api
        .FIXTURES()
        .then((res) => {
          res.data.data.forEach((element, i) => {
            if (i < 3) {
              self.items.push({
                date: moment(element.date).format("MM-DD-YYYY hh:mm A"),
                homeName: element.homeName,
                awayName: element.awayName,
                league: element.leagueName,
              });
            }
          });
          self.loading = false;
        })
        .catch((e) => {
          console.log(e);
          self.loading = false;
        });
    },
    submit() {
      let self = this;
      if (this.$refs.form2.validate()) {
        console.log(self.match);
        api
          .updateScore(this.match)
          .then((e) => {
            self.moadl = false;
            console.log(e);
          })
          .catch((e) => {
            console.log(e);
          });
      }
    },
  },

  async created() {
    await this.getMatches();
  },
};
</script>

<style></style>
