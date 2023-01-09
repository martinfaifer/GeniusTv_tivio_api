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
                            class="overflow-hidden rounded-lg blur shadow-blur-basic-card"
                        >
                            <v-card-text>
                                <v-col cols="12" class="d-flex justify-center">
                                    <img
                                        src="images/logo_grape_genius_tv_300x300_px.png"
                                        loading="lazy"
                                        width="48"
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
                                <v-col cols="12" sm="12" md="12">
                                    <v-btn
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
        </v-container>
    </v-main>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            errors: [],
            formInputData: [],
            alert: false,
        };
    },

    components: {},
    created() {
        // this.index();
    },
    methods: {
        LoginCustomer() {
            axios
                .post("login", {
                    identity_username: this.formInputData.identity_username,
                    identity_password: this.formInputData.identity_password,
                })
                .then((response) => {
                    if (response.data.status == "error") {
                        this.systemResponse = response.data;
                    } else {
                        this.systemResponse = response.data;
                        this.$router.push(response.data.payload);
                    }
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
    },
    watch: {},
};
</script>
