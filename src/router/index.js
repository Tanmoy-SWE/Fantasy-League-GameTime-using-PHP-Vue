import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/fixture",
    name: "fixture",
    component: () => import("../views/Fixture.vue"),
  },
  {
    path: "/standing",
    name: "standing",
    component: () => import("../views/standing.vue"),
  },
  {
    path: "/all-seasons",
    name: "all-seasons",

    component: () => import("../views/AllSeasons.vue"),
  },
  {
    path: "/play",
    name: "play-seasons",
    component: () => import("../views/Play.vue"),
  },
  {
    path: "/teams",
    name: "teams",
    component: () => import("../views/teams.vue"),
  },
  {
    path: "/leaderboard",
    name: "leaderboard",
    component: () => import("../views/LeaderBoard.vue"),
  },
  {
    path: "/admin",
    name: "admin",
    component: () => import("../views/Admin.vue"),
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
