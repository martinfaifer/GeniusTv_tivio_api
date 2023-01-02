require("./bootstrap");
import "../sass/main.scss";
import { createApp } from "vue";
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

import eventBus from "./event-bus";

const vuetify = createVuetify({
    components,
    directives,
});

//import your scss here
import "../sass/main.scss";

import { createRouter, createWebHashHistory } from "vue-router";

import App from "./App.vue";

// import SnackBar from "./components/Share/SnackBar.vue";

const Home = () => import("./components/Home.vue");
const CustomerLayout = () => import("./components/Customer/CustomerLayout.vue");
const Isp = () => import("./components/Admin/Isp.vue");

const AdminLogin = () => import("./components/Admin/Login/login.vue");

const Page404 = () => import("./components/404/404.vue");

const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        {
            path: "/",
            name: "Home",
            component: Home,
        },
        {
            path: "/customer",
            name: "Customer",
            component: CustomerLayout,
        },
        {
            path: "/admin/login",
            name: "AdminLogin",
            component: AdminLogin,
        },
        {
            path: "/admin/isp/:component",
            name: "ISP",
            component: Isp,
        },
        {
            path: "/:pathMatch(.*)*",
            component: Page404,
        },
    ],
});

const app = createApp(App);

app.use(eventBus).use(vuetify).use(router);

router.isReady().then(() => {
    app.mount("#app");
});
