<template>
  <v-container>
<v-card class="mb-4 mr-4">
        <v-simple-table>
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-left">Name</th>
                <th class="text-left">Score</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in user" :key="index">
                <td class="text-left">{{ item.name }}</td>
                <td class="text-left">{{ item.score }}</td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-card>      
</v-container>
</template>

<script>
import api from "@/service/api";
export default {
 async created () {
     await this.getTopUser();
  },
  data() {
    return {

       user:[]
    }
  },
  methods: {
     async  getTopUser() {
      let self = this;
     await api
        .topPlayers()
        .then((e) => {
          console.log(e.data);
          const arrayOfUser = e.data.replace(e.data[1], "");
          const split = JSON.parse(arrayOfUser);
          console.log(split);
          split.sort(function (a, b) {
            return b.score - a.score;
          });
          self.user = split;
        })
        .catch((e) => {
          console.log(e);
        });
    },
  },

}
</script>

<style>

</style>