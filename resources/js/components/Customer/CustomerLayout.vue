<template>
    <div>
        <v-app-bar image="images/cervene_pozadi.jpg" cover>
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
                Zákaznická zóna
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
            <v-container fluid v-cloak>
                <v-row>
                    <!-- alert -->
                    <v-col
                        v-show="
                            customerNanguDetail.subscriptionState == 'SUSPENDED'
                        "
                        cols="12"
                    >
                        <v-alert
                            type="warning"
                            title="Služba pozastavena"
                            text="Prosím obraťte se na svého poskytovatele."
                            rounded="lg"
                            closable
                            class="overflow-hidden warning-shadow-blur"
                        >
                        </v-alert>
                    </v-col>
                    <!-- Download Apps links -->
                    <v-col cols="12">
                        <v-card color="transparent" flat elevation-12>
                            <v-card-title class="text-center text-h6">
                                <!-- Aplikace ke stažení -->
                            </v-card-title>
                            <v-container fluid class="d-flex justify-center">
                                <v-card
                                    flat
                                    color="transparent"
                                    class="mr-6"
                                    link
                                    href="https://apps.apple.com/cz/app/genius-mobiletv/id1565113308?l=cs"
                                    target="_blank"
                                >
                                    <v-img
                                        src="images/badge-example-preferred.png"
                                        width="120"
                                    >
                                    </v-img>
                                </v-card>
                                <v-card
                                    flat
                                    link
                                    color="transparent"
                                    class="mr-6"
                                    href="https://play.google.com/store/apps/details?id=cz.geniustv.mobile&pli=1"
                                    target="_blank"
                                >
                                    <v-img
                                        src="images/en-play-badge.png"
                                        width="140"
                                    >
                                    </v-img>
                                </v-card>
                                <v-card
                                    color="transparent"
                                    flat
                                    link
                                    class="mr-6"
                                    href="https://play.google.com/store/apps/details?id=cz.geniustv.tv"
                                    target="_blank"
                                >
                                    <v-img
                                        src="images/Android-TV_2.jpeg"
                                        width="140"
                                    >
                                    </v-img>
                                </v-card>
                                <!-- src="images/logo_grape_genius_tv_300x300_px.png" -->
                                <v-card
                                    color="transparent"
                                    flat
                                    link
                                    href="http://tv.geniustv.cz"
                                    target="_blank"
                                >
                                    <v-img src="images/genius.png" width="140">
                                    </v-img>
                                </v-card>
                            </v-container>
                        </v-card>
                    </v-col>
                    <!-- Service informations -->
                    <v-col cols="12" sm="12" md="6" lg="6">
                        <v-card
                            rounded="xl"
                            class="overflow-hidden rounded-xl blur shadow-blur"
                            elevation-12
                            color="white"
                        >
                            <v-card-title class="text-center text-h6">
                                <v-container
                                    fluid
                                    class="d-flex justify-center"
                                >
                                    <v-spacer></v-spacer>
                                    <span> Informace o službě </span>
                                    <v-spacer></v-spacer>
                                </v-container>
                            </v-card-title>
                            <v-card-text>
                                <v-list color="transparent">
                                    <v-list-item>
                                        <v-row>
                                            <v-col
                                                cols="12"
                                                sm="12"
                                                md="6"
                                                lg="6"
                                                class="font-weight-normal text-subtitle-2"
                                            >
                                                Zaplacení Prima bez reklam:
                                            </v-col>
                                            <v-col
                                                cols="12"
                                                sm="12"
                                                md="6"
                                                lg="6"
                                            >
                                                <v-btn
                                                    @click="
                                                        primaPayment(
                                                            customerNanguDetail.subscriptionCode
                                                        )
                                                    "
                                                    color="green"
                                                    size="small"
                                                >
                                                    <strong> Zaplatit </strong>
                                                </v-btn>
                                            </v-col>
                                        </v-row>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-row>
                                            <v-col
                                                cols="12"
                                                sm="12"
                                                md="6"
                                                lg="6"
                                                class="font-weight-normal text-subtitle-2"
                                            >
                                                Služba:
                                            </v-col>
                                            <v-col
                                                cols="12"
                                                sm="12"
                                                md="6"
                                                lg="6"
                                            >
                                                {{
                                                    customerNanguDetail.tariffCode
                                                }}
                                            </v-col>
                                        </v-row>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-row>
                                            <v-col
                                                cols="12"
                                                sm="12"
                                                md="6"
                                                lg="6"
                                                class="font-weight-normal text-subtitle-2"
                                            >
                                                Stav služby:
                                            </v-col>
                                            <v-col
                                                cols="12"
                                                sm="12"
                                                md="6"
                                                lg="6"
                                                :class="
                                                    getCollorByState(
                                                        customerNanguDetail.subscriptionState
                                                    )
                                                "
                                            >
                                                {{
                                                    translateSubscriptionState(
                                                        customerNanguDetail.subscriptionState
                                                    )
                                                }}
                                            </v-col>
                                        </v-row>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-row>
                                            <v-col
                                                cols="12"
                                                sm="12"
                                                md="6"
                                                lg="6"
                                                class="font-weight-normal text-subtitle-2"
                                            >
                                                Rodičovský PIN:
                                            </v-col>
                                            <v-col
                                                cols="12"
                                                sm="12"
                                                md="6"
                                                lg="6"
                                            >
                                                {{
                                                    customerNanguDetail.parentalPin
                                                }}
                                            </v-col>
                                        </v-row>
                                    </v-list-item>
                                </v-list>
                                <v-list
                                    v-if="
                                        customerNanguDetail.pairedDeviceLimits !=
                                        undefined
                                    "
                                >
                                    <v-list-subheader
                                        >Maximální počet přihlášených zařízení
                                    </v-list-subheader>
                                    <v-list-item>
                                        <v-row>
                                            <v-col
                                                cols="12"
                                                sm="12"
                                                md="6"
                                                lg="6"
                                                class="font-weight-normal text-subtitle-2 text-capitalize"
                                            >
                                                Celkem
                                            </v-col>
                                            <v-col
                                                cols="12"
                                                sm="12"
                                                md="6"
                                                lg="6"
                                            >
                                                {{
                                                    customerNanguDetail.pairedDevicesLimit
                                                }}
                                            </v-col>
                                        </v-row>
                                    </v-list-item>
                                </v-list>
                                <v-list
                                    v-if="
                                        customerNanguDetail.pairedDeviceLimits !=
                                        undefined
                                    "
                                >
                                    <v-list-subheader
                                        >Nebo maximální počty přihlášených
                                        zařízení dle typů</v-list-subheader
                                    >
                                    <v-list-item
                                        v-for="deviceTypeInfoLimit in customerNanguDetail
                                            .pairedDeviceLimits
                                            .pairedDeviceLimit"
                                        :key="deviceTypeInfoLimit"
                                        v-show="
                                            deviceTypeInfoLimit.deviceType !=
                                                'STB' &&
                                            deviceTypeInfoLimit.deviceType !=
                                                'SAGEM'
                                        "
                                    >
                                        <v-row>
                                            <v-col
                                                cols="12"
                                                sm="12"
                                                md="6"
                                                lg="6"
                                                class="font-weight-normal text-subtitle-2 text-capitalize"
                                            >
                                                {{
                                                    translateDeviceType(
                                                        deviceTypeInfoLimit.deviceType
                                                    )
                                                }}
                                            </v-col>
                                            <v-col
                                                cols="12"
                                                sm="12"
                                                md="6"
                                                lg="6"
                                            >
                                                {{ deviceTypeInfoLimit.limit }}
                                            </v-col>
                                        </v-row>
                                    </v-list-item>
                                </v-list>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <!-- Logged Devices -->
                    <v-col cols="12" sm="12" md="6" lg="6">
                        <v-card
                            rounded="xl"
                            class="overflow-hidden rounded-xl blur shadow-blur"
                            elevation-12
                            color="white"
                        >
                            <v-card-title class="text-h6">
                                <v-container
                                    fluid
                                    class="d-flex justify-center"
                                >
                                    <v-spacer></v-spacer>
                                    <span> Přihlášená zařízení </span>
                                    <v-spacer></v-spacer>
                                    <!-- <v-btn
                                        v-if="
                                            customerNanguDetail.pairedDevices !=
                                            undefined
                                        "
                                        variant="outlined"
                                        color="red"
                                        prepend-icon="mdi-delete"
                                        >Odebrat vše</v-btn
                                    > -->
                                </v-container>
                            </v-card-title>

                            <v-card-text>
                                <div
                                    v-if="
                                        customerNanguDetail.pairedDevices !=
                                        undefined
                                    "
                                >
                                    <v-list>
                                        <v-list-item
                                            v-for="device in customerNanguDetail.pairedDevices"
                                            :key="device.deviceId"
                                            lines="two"
                                            v-show="device.deviceType != 'STB'"
                                        >
                                            <v-list-item-title>
                                                {{ device.deviceType }}
                                            </v-list-item-title>
                                            <v-list-item-subtitle>
                                                {{ device.deviceName }}
                                                - naposledy přihlášen
                                                {{
                                                    new Date(
                                                        device.lastLoginDate
                                                    ).toLocaleDateString()
                                                }}
                                            </v-list-item-subtitle>

                                            <!-- <v-list-item-subtitle
                                                color="hidden-sm-and-down"
                                                class="d-flex justify-center mt-n4 hidden-sm-and-down"
                                            >
                                                naposledy přihlášen
                                                {{
                                                    new Date(
                                                        device.lastLoginDate
                                                    ).toLocaleDateString()
                                                }}
                                            </v-list-item-subtitle> -->

                                            <template v-slot:prepend>
                                                <v-avatar
                                                    color="grey-lighten-1"
                                                >
                                                    <v-icon
                                                        color="white"
                                                        v-if="
                                                            device.deviceType ==
                                                            'MOBILE'
                                                        "
                                                        >mdi-cellphone</v-icon
                                                    >

                                                    <v-icon
                                                        color="white"
                                                        v-if="
                                                            device.deviceType ==
                                                            'PC'
                                                        "
                                                        >mdi-laptop</v-icon
                                                    >

                                                    <v-icon
                                                        color="white"
                                                        v-else-if="
                                                            device.deviceType ==
                                                            'SAMSUNG_TV'
                                                        "
                                                        >mdi-television</v-icon
                                                    >
                                                </v-avatar>
                                            </template>
                                            <template v-slot:append>
                                                <v-btn
                                                    color="red-lighten-1"
                                                    icon="mdi-delete"
                                                    variant="text"
                                                    @click="
                                                        deleteDevice(
                                                            device.deviceId
                                                        )
                                                    "
                                                ></v-btn>
                                            </template>
                                        </v-list-item>
                                    </v-list>
                                </div>
                                <div v-else>
                                    <v-alert
                                        type="info"
                                        rounded="lg"
                                        title="Nenalezeno žádné zařízení"
                                        text="U vaší služby nejsou evidovány žádná zařízení"
                                    >
                                    </v-alert>
                                </div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
        <SnackBar
            :showSnackBar="showSnackBar"
            :message="notificationData.message"
            :snackColor="snackColor"
        ></SnackBar>
    </div>
</template>
<script>
import axios from "axios";
import SvgIcon from "@jamescoyle/vue-icon";
import { mdiAccount } from "@mdi/js";
import SnackBar from "../Share/SnackBar.vue";
export default {
    data() {
        return {
            showSnackBar: false,
            customerData: [],
            customerNanguDetail: [],
            notificationData: [],
            snackColor: "",
        };
    },
    components: {
        SnackBar,
    },

    created() {
        this.index();
        this.loadDetailsFromNangu();
    },
    methods: {
        async index() {
            await axios.get("customer").then((response) => {
                this.customerData = response.data;
            });
        },

        async loadDetailsFromNangu() {
            await axios.get("customer/nangu/details").then((response) => {
                this.customerNanguDetail = response.data;
            });
        },

        deleteDevice(deviceId) {
            if (this.customerData.nangu_isp != null) {
                axios
                    .delete(
                        "customer/nangu/device/" +
                            this.customerNanguDetail.subscriptionCode +
                            "/" +
                            deviceId +
                            "/" +
                            this.customerData.nangu_isp
                    )
                    .then((response) => {
                        this.notificationData = response.data;

                        if (this.notificationData.status == "success") {
                            this.loadDetailsFromNangu();
                            this.snackColor = "green";
                        } else {
                            this.snackColor = "error";
                        }
                        this.showSnackBar = true;
                        setTimeout(function () {
                            this.notificationData = [];
                            this.showSnackBar = false;
                        }, 3000);
                    });
            } else {
                axios
                    .delete(
                        "customer/nangu/device/" +
                            this.customerNanguDetail.subscriptionCode +
                            "/" +
                            deviceId
                    )
                    .then((response) => {
                        this.notificationData = response.data;

                        if (this.notificationData.status == "success") {
                            this.loadDetailsFromNangu();
                            this.snackColor = "green";
                        } else {
                            this.snackColor = "error";
                        }
                        this.showSnackBar = true;
                        setTimeout(function () {
                            this.notificationData = [];
                            this.showSnackBar = false;
                        }, 3000);
                    });
            }
        },

        redirectToHome() {
            this.$router.push("/");
        },

        logout() {
            axios.post("logout").then((response) => {
                this.redirectToHome();
            });
        },

        translateDeviceType(deviceType) {
            if (deviceType == "CONNECTED_TV") {
                return "TV";
            }

            return deviceType;
        },

        translateSubscriptionState(state) {
            if (state == "BILLING") {
                return "Aktivní";
            }
        },

        getCollorByState(state) {
            if (state == "BILLING") {
                return "text-green";
            }
        },

        primaPayment(subscriptionCode) {
            axios
                .post("customer/tivio/subscriptionCode", {
                    subscriptionCode: subscriptionCode,
                })
                .then((response) => {
                    window.open(response.data, "_blank");
                });
        },
    },

    computed: {},

    watch: {
        $route(to, from) {},
        notificationData() {
            if (this.notificationData.length != 0) {
                this.showSnackBar = true;
                setTimeout(function () {
                    this.notificationData = [];
                    this.showSnackBar = false;
                }, 3000);
            }
        },
    },
    beforeDestroy: function () {},
};
</script>
