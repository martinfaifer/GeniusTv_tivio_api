<template>
    <v-main
        style="
            background-image: url('images/cervene_pozadi.jpg');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        "
    >
        <v-container class="d-flex fill-height justify-start align-center">
            <v-row class="d-flex align-center justify-center">
                <v-col cols="12" sm="12" md="6" lg="7">
                    <v-form @submit.prevent="LoginCustomer()">
                        <v-card
                            style="
                                background: rgba(255, 255, 255, 0.75);
                                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
                                backdrop-filter: blur(4.5px);
                                -webkit-backdrop-filter: blur(4.5px);
                                border-radius: 10px;
                                border: 1px solid rgba(255, 255, 255, 0.18);
                            "
                        >
                            <v-card-text>
                                <v-col cols="12" class="d-flex justify-center">
                                    <img
                                        src="images/logo_grape_genius_tv_300x300_px.png"
                                        loading="lazy"
                                        width="100"
                                        alt=""
                                        class=""
                                    />
                                </v-col>
                                <v-col cols="12" sm="12" md="12">
                                    <v-text-field
                                        prepend-inner-icon="mdi-account"
                                        autofocus
                                        density="compact"
                                        variant="outlined"
                                        label="Uživatelské jméno do aplikace GeniusTV"
                                        required
                                        v-model="
                                            formInputData.identity_username
                                        "
                                        :error-messages="
                                            errors.identity_username
                                        "
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
                                        v-model="
                                            formInputData.identity_password
                                        "
                                        :error-messages="
                                            errors.identity_password
                                        "
                                    ></v-text-field>
                                </v-col>
                                <v-col
                                    v-if="nanguIsps.length != 0"
                                    cols="12"
                                    sm="12"
                                    md="12"
                                >
                                    <v-alert
                                        type="warning"
                                        title="Nepodařilo se přihlásit"
                                        text="Prosím vyberte svého poskytovatele IPTV."
                                        rounded="md"
                                        class="overflow-hidden warning-shadow-blur"
                                    >
                                    </v-alert>
                                </v-col>
                                <v-col
                                    v-if="nanguIsps.length != 0"
                                    cols="12"
                                    sm="12"
                                    md="12"
                                >
                                    <v-autocomplete
                                        :items="nanguIsps"
                                        item-title="nangu_isp"
                                        item-value="nangu_isp_id"
                                        density="compact"
                                        variant="outlined"
                                        label="Vyberte poskytovatele služby"
                                        v-model="formInputData.nanguIsp"
                                        :error-messages="errors.nanguIsp"
                                    ></v-autocomplete>
                                </v-col>
                                <v-col cols="12" sm="12" md="12">
                                    <v-btn
                                        :loading="loading"
                                        variant="flat"
                                        color="#AB1A19"
                                        block
                                        type="submit"
                                        class="rounded-md font-size-bold text-h6 my-2 text-white"
                                        ><strong>Přihlásit se</strong></v-btn
                                    >
                                </v-col>
                            </v-card-text>
                        </v-card>
                    </v-form>
                </v-col>
            </v-row>
            <div class="text-center">
                <v-snackbar
                    v-model="currSnackBar"
                    :timeout="timeout"
                    color="red"
                >
                    {{ serverResponse.message }}
                </v-snackbar>
            </div>
        </v-container>
    </v-main>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            loading: false,
            currSnackBar: false,
            serverResponse: [],
            timeout: 5000,
            errors: [],
            formInputData: [],
            alert: false,
            nanguIsps: [],
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

                if (this.customerData != "") {
                    this.$router.push({ name: "Customer" });
                }
            });
        },
        LoginCustomer() {
            this.loading = true;
            axios
                .post("login", {
                    identity_username: this.formInputData.identity_username,
                    identity_password: this.formInputData.identity_password,
                    ispCode:
                        this.formInputData.nanguIsp == undefined
                            ? null
                            : this.formInputData.nanguIsp,
                })
                .then((response) => {
                    this.loading = false;
                    this.serverResponse = response.data;
                    if (response.data.status == "error") {
                        this.currSnackBar = true;
                        this.serverResponse = response.data;
                        setTimeout(() => {
                            this.resetVars();
                        }, 6000);
                    } else if (response.data.status == "warning") {
                        this.getIsps();
                    } else {
                        this.serverResponse = response.data;
                        this.$router.push(response.data.payload);
                    }
                })
                .catch((error) => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },

        getIsps() {
            axios.get("iptv/isps").then((response) => {
                this.nanguIsps = response.data.data;
            });
        },

        resetVars() {
            this.serverResponse = [];
            this.nanguIsps = [];
            this.currSnackBar = false;
        },
    },
    watch: {},
};
</script>
