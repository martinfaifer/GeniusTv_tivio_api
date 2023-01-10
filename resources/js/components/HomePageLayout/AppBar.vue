<template>
    <div>
        <v-app-bar color="transparent" elevation="0">
            <template v-slot:append>
                <v-btn
                    class="mx-3 bg-white"
                    variant="outlined"
                    size="small"
                    rounded="lg"
                    @click="openTivioDialog()"
                >
                    Prima bez reklam</v-btn
                >

                <v-btn
                    variant="outlined"
                    size="small"
                    rounded="lg"
                    class="bg-white"
                    @click="openLoginCustomerDialog()"
                    :loading="userButtonLoading"
                >
                    Zákaznická zóna</v-btn
                >
            </template>
        </v-app-bar>

        <v-row justify="center">
            <v-dialog
                v-model="customerLoginDialog"
                persistent
                max-width="600px"
            >
                <v-card rounded="lg">
                    <v-card-text class="my-3">
                        <v-col cols="12" sm="12" md="12">
                            <!-- <v-text-field
                                autofocus
                                density="compact"
                                variant="outlined"
                                label="Mac adresa Vašeho set top boxu ve formátu xx:xx:xx:xx:xx:xx"
                                required
                                v-model="formInputData.mac"
                                :error-messages="errors.mac"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                            <v-text-field
                                density="compact"
                                variant="outlined"
                                label="Uživatelské jméno do aplikace GeniusTV"
                                required
                                v-model="formInputData.identity"
                                :error-messages="errors.identity"
                            ></v-text-field>
                        </v-col> -->
                            <v-text-field
                                prepend-inner-icon="mdi-account"
                                autofocus
                                density="compact"
                                variant="outlined"
                                label="Uživatelské jméno do aplikace GeniusTV"
                                required
                                v-model="formInputData.identity_username"
                                :error-messages="errors.identity_username"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                            <v-text-field
                                type="password"
                                prepend-inner-icon="mdi-lock"
                                density="compact"
                                variant="outlined"
                                label="Heslo do aplikace GeniusTV"
                                required
                                v-model="formInputData.identity_password"
                                :error-messages="errors.identity_password"
                            ></v-text-field>
                        </v-col>
                    </v-card-text>
                    <v-container fluid>
                        <v-row>
                            <v-btn
                                class="mx-7 mb-3"
                                color="red-darken-1"
                                rounded="md"
                                @click="closeDialogs()"
                            >
                                Zavřít
                            </v-btn>
                            <v-spacer></v-spacer>
                            <v-btn
                                class="mx-7 mb-3"
                                rounded="md"
                                color="green-darken-1"
                                @click="LoginCustomer()"
                            >
                                Přihlásit
                            </v-btn>
                        </v-row>
                    </v-container>
                </v-card>
            </v-dialog>

            <v-dialog v-model="tivioDialog" persistent max-width="600px">
                <v-card rounded="lg">
                    <v-card-text class="my-3">
                        <v-col cols="12" sm="12" md="12">
                            <v-text-field
                                autofocus
                                density="compact"
                                variant="outlined"
                                label="Mac adresa Vašeho set top boxu ve formátu xx:xx:xx:xx:xx:xx"
                                required
                                v-model="formInputData.mac"
                                :error-messages="errors.mac"
                            ></v-text-field>
                        </v-col>
                    </v-card-text>
                    <v-container fluid>
                        <v-row>
                            <v-btn
                                class="mx-7 mb-3"
                                color="red-darken-1"
                                rounded="md"
                                @click="closeDialogs()"
                            >
                                Zavřít
                            </v-btn>
                            <v-spacer></v-spacer>
                            <v-btn
                                class="mx-7 mb-3"
                                rounded="md"
                                color="green-darken-1"
                                @click="goToTivio()"
                            >
                                Přesměrovat na platbu
                            </v-btn>
                        </v-row>
                    </v-container>
                </v-card>
            </v-dialog>
        </v-row>

        <div class="text-center">
            <v-snackbar
                v-model="showSnackBar"
                :timeout="timeout"
                :color="snackColor"
            >
                {{ systemResponse.message }}
            </v-snackbar>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
    data() {
        return {
            userButtonLoading: false,
            customerLoginDialog: false,
            tivioDialog: false,
            formInputData: [],
            errors: [],
            showSnackBar: false,
            timeout: 3000,
            systemResponse: [],
            snackColor: "red",
            customerData: [],
        };
    },
    components: {},

    created() {
        this.index();
    },
    methods: {
        async index() {
            await axios.get("customer").then((response) => {
                this.customerData = response.data;
            });
        },
        // close all dialogs
        closeDialogs() {
            this.customerLoginDialog = false;
            this.tivioDialog = false;
            this.formInputData = [];
            this.errors = [];
        },

        // open login customer Dialog
        openLoginCustomerDialog() {
            this.$router.push({ name: "CustomerLogin" });
            // if (this.customerData == "") {
            //     this.customerLoginDialog = true;
            // } else {
            //     this.userButtonLoading = true;
            //     this.$router.push({ name: "CustomerLogin" });
            // }
        },

        goToTivio() {
            axios
                .post("customer/tivio/stb_mac", {
                    mac: this.formInputData.mac,
                })
                .then((response) => {
                    window.open(response.data, "_blank");
                    this.closeDialogs();
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },

        openTivioDialog() {
            this.tivioDialog = true;
        },

        LoginCustomer() {
            axios
                .post("login", {
                    // mac: this.formInputData.mac,
                    // identity: this.formInputData.identity,
                    identity_username: this.formInputData.identity_username,
                    identity_password: this.formInputData.identity_password,
                })
                .then((response) => {
                    if (response.data.status == "error") {
                        this.showSnackBar = true;
                        this.systemResponse = response.data;
                        this.snackColor = "red";
                    } else {
                        this.showSnackBar = true;
                        this.snackColor = "green";
                        this.systemResponse = response.data;
                        this.$router.push(response.data.payload);
                    }
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
    },

    watch: {
        $route(to, from) {},
    },
    beforeDestroy: function () {},
};
</script>
