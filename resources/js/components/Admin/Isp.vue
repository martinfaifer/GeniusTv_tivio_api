<template>
    <div>
        <v-app-bar image="images/cervene_pozadi.jpg" cover v-cloak>
            <template v-slot:image>
                <v-img
                    gradient="to top right, rgba(110,16,16,.8), rgba(110,0,0,.8)"
                ></v-img>
            </template>
            <img
                src="images/logo_grape_genius_tv_300x300_px.png"
                height="48"
                loading="lazy"
                alt=""
                @click="redirectToHome()"
                style="cursor: pointer"
            />
            <v-app-bar-title class="text-white font-weight-bold">
                Isp zóna
            </v-app-bar-title>
            <template v-slot:append>
                <v-menu>
                    <template v-slot:activator="{ props }">
                        <v-btn
                            icon="mdi-account"
                            size="small"
                            v-bind="props"
                        ></v-btn>
                    </template>

                    <v-list density="compact">
                        <v-list-item
                            v-if="user.isAdmin == true"
                            prepend-icon="mdi-account"
                        >
                            <v-list-item-title
                                class="text-body-2"
                                @click="goToUsers()"
                                style="cursor: pointer"
                            >
                                Správa uživatelů
                            </v-list-item-title>
                        </v-list-item>

                        <v-list-item
                            v-if="user.isAdmin == true"
                            prepend-icon="mdi-ipod"
                        >
                            <v-list-item-title
                                class="text-body-2"
                                @click="goToApps()"
                                style="cursor: pointer"
                            >
                                Správa aplikací
                            </v-list-item-title>
                        </v-list-item>

                        <v-list-item prepend-icon="mdi-logout">
                            <v-list-item-title
                                class="text-body-2"
                                @click="logout()"
                                style="cursor: pointer"
                            >
                                Odhlásit se
                            </v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
            </template>
        </v-app-bar>
        <v-main>
            <!-- components -->
            <Applications
                v-if="$route.params.component == 'applications'"
                :user="user"
            ></Applications>
            <Users
                v-if="$route.params.component == 'users'"
                :user="user"
            ></Users>
        </v-main>
    </div>
</template>
<script>
import axios from "axios";
import SvgIcon from "@jamescoyle/vue-icon";
import { mdiAccount } from "@mdi/js";
import Applications from "./Apps/applications.vue";
import Users from "./Users/users.vue";
import SnackBar from "../Share/SnackBar.vue";
export default {
    data() {
        return {
            showSnackBar: false,
            notificationData: [],
            message: "",
            snackColor: "",
            file: [],
            fileUploadDialog: false,
            errors: [],
            categories: [],
            formDatas: [],
            timeout: 3000,
            apps: [],
            user: [],
        };
    },
    components: {
        Applications,
        Users,
        SnackBar,
    },

    created() {
        this.getUser();
    },
    methods: {
        async getUser() {
            await axios.get("admin/auth/logged").then((response) => {
                this.user = response.data;
            });
        },

        redirectToHome() {
            this.$router.push("/");
        },

        logout() {
            axios.post("logout").then((response) => {
                this.redirectToHome();
            });
        },

        goToUsers() {
            this.$router.push("/admin/isp/users");
        },

        goToApps() {
            this.$router.push("/admin/isp/applications");
        },

        resetNotification() {
            setTimeout(function () {
                this.notificationData = [];
                this.message = "";
                this.showSnackBar = false;
            }, 3000).bind(this);
        },
    },

    computed: {},

    watch: {
        $route(to, from) {},
    },
    beforeDestroy: function () {},
};
</script>
