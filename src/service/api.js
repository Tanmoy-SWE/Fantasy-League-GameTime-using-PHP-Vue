import axios from "axios";

// for elena sports
const appClient = axios.create({
  baseURL: "https://football.elenasport.io/v2/",
  headers: getHeaders(),
});

// for mysql
const appServer = axios.create({
  baseURL: "http://localhost/game/api/",
});

function getHeaders() {
  const headers = {};
  if (localStorage.getItem("token") != null) {
    headers["Authorization"] = "Bearer " + localStorage.getItem("token");
  }
  return headers;
}
export default {
  TOP_SCORER() {
    return appClient.get("seasons/4210/topscorers?expand=player");
  },
  TOP_RED_CARD() {
    return appClient.get("seasons/4210/topredcards?expand=player");
  },
  TOP_YELLOW_CARD() {
    return appClient.get("seasons/4210/topyellowcards?expand=player");
  },
  FIXTURES() {
    return appClient.get("upcoming");
  },
  LEAUGE() {
    return appClient.get("leagues?expand=country,seasons,current_season");
  },
  SEASONS() {
    return appClient.get("leagues/234/seasons?expand=upcoming");
  },
  // server
  signUp(payload) {
    return appServer.get(
      `create.php?name=${payload.name}&&email=${payload.email}&&matches=${payload.matches}&&score=${payload.point}&&password=${payload.password}`
    );
  },
  login(payload) {
    return appServer.post(`login.php`, payload);
  },
  topPlayers() {
    return appServer.get("top-players.php");
  },
  predictMtch(payload) {
    return appServer.post(
      `matches.php?date=${payload.date}&&user=${payload.user}&&league=${payload.league}&&willWin=${payload.willWin}&&byGoals=${payload.byGoals}&&homeName=${payload.homeName}&&awayName=${payload.awayName}`
    );
  },

  getMatches() {
    return appServer.get("allMatches.php");
  },
  updateScore(payload) {
    return appServer.post(
      `update-score.php?date=${payload.date}&&id=${payload.id}&&league=${payload.league}&&willWin=${payload.willWin}&&byGoals=${payload.byGoals}&&homeName=${payload.homeName}&&awayName=${payload.awayName}`
    );
  },
};
