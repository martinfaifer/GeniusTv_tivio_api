<template>
    <div>
        <v-container fluid class="my-auto">
            <v-row align="center" justify="center" class="my-auto">
                <v-col cols="12" sm="12" md="5" lg="5">
                    <v-form @submit.prevent="login()">
                        <v-card
                            class="overflow-hidden rounded-xl blur shadow-blur"
                        >
                            <v-card-text>
                                <h1 class="my-4 text-center">
                                    <strong>ISP zóna</strong>
                                </h1>

                                <v-text-field
                                    density="compact"
                                    variant="outlined"
                                    :error-messages="errors.email"
                                    v-model="email"
                                    label="Email"
                                    name="username"
                                    prepend-inner-icon="mdi-account"
                                    type="text"
                                    color="#328AF1"
                                    autofocus
                                    class="my-3"
                                ></v-text-field>

                                <v-text-field
                                    density="compact"
                                    variant="outlined"
                                    :error-messages="errors.password"
                                    v-model="password"
                                    label="Heslo"
                                    name="password"
                                    prepend-inner-icon="mdi-lock"
                                    type="password"
                                    color="#328AF1"
                                ></v-text-field>
                                <v-btn
                                    variant="flat"
                                    color="black"
                                    block
                                    type="submit"
                                    class="rounded-md font-size-bold text-h6 my-2"
                                    ><strong> Přihlášení</strong></v-btn
                                >
                            </v-card-text>
                        </v-card>
                    </v-form>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            errors: [],
            email: null,
            password: null,
            alert: false,
        };
    },

    components: {},
    created() {
        this.index();
    },
    methods: {
        index() {
            axios
                .get("admin/auth/logged")
                .then((response) => {
                    this.$router.push("/admin/isp/applications");
                })
                .catch((error) => {
                    if (error.response.status == 403) {
                        //
                    }
                });
        },

        login() {
            this.errors = [];
            axios
                .post("/admin/auth/login", {
                    email: this.email,
                    password: this.password,
                })
                .then((response) => {
                    if (response.data.status == "success") {
                        this.$router.push("/admin/isp/applications");
                    } else {
                        this.alert = true;
                        this.email = null;
                        this.password = null;
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
