import {createWebHistory, createRouter} from "vue-router";
import Home from "./views/Home.vue";
import About from "./views/About.vue";
import Assistance from "./views/Assistances.vue";
import SignUp from "./views/SignUp.vue";
import SignIn from "./views/SignIn.vue";
import AidCenters from "./views/AidCenters.vue";
import Shelters from "./views/Shelters.vue";
import Regions from "./views/Regions.vue";
import Screen from "./views/Screen.vue";

const routes = [
    {path: "/", name: "Home", component: Home},
    {path: "/about", name: "About", component: About},
    {path: "/sing-up", name: "SignUp", component: SignUp},
    {path: "/sing-in", name: "SignIn", component: SignIn},
    {path: "/screen", name: "Screen", component: Screen},
    {path: "/regions", name: "Regions", component: Regions},
    {path: "/shelters/:regionId", name: "Shelters", component: Shelters, props: true},
    {path: "/assistance", name: "Assistance", component: Assistance},
    {path: "/aid-centers", name: "AidCenters", component: AidCenters},
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
