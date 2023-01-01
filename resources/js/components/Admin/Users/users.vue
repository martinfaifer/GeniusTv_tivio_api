<template>
    <div>
        <v-container fluid>
            <v-app-bar v-if="user.isAdmin == true" color="transparent" flat>
                <template v-slot:append>
                    <v-btn
                        style="
                            background: rgb(93, 214, 28);
                            background: linear-gradient(
                                183deg,
                                rgba(93, 214, 28, 1) 0%,
                                rgba(14, 172, 175, 1) 100%
                            );
                        "
                        rounded="md"
                        class="success-shadow-blur gradient-green-button text-white"
                        @click="openCreateUserDialog()"
                    >
                        Nový uživatel
                    </v-btn>
                </template>
            </v-app-bar>
            <v-row>
                <!-- Download logclient links -->
                <v-col cols="12" sm="12" md="12" lg="12">
                    <v-card
                        rounded="xl"
                        class="overflow-hidden rounded-xl blur shadow-blur"
                        elevation-12
                        color="white"
                    >
                        <v-card-text>
                            <v-table fixed-header>
                                <thead>
                                    <tr>
                                        <th class="text-left">email</th>
                                        <th class="text-left">jméno</th>
                                        <th class="text-left">admin</th>
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in users" :key="user.id">
                                        <td>
                                            {{ user.email }}
                                        </td>
                                        <td>
                                            {{ user.name }}
                                        </td>
                                        <td>
                                            <v-icon
                                                v-if="user.isAdmin == true"
                                                color="green"
                                                >mdi-check</v-icon
                                            >
                                            <v-icon v-else color="red">
                                                mdi-close
                                            </v-icon>
                                        </td>
                                        <td>
                                            <v-icon
                                                color="red"
                                                @click="
                                                    openWarningDialog(user.id)
                                                "
                                                >mdi-delete</v-icon
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </v-table>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>

            <v-row justify="center">
                <v-dialog
                    v-model="createUserDialog"
                    persistent
                    max-width="600px"
                >
                    <v-card rounded="lg">
                        <v-container fluid>
                            <v-col cols="12" sm="12" md="12" lg="12">
                                <v-text-field
                                    autofocus
                                    density="compact"
                                    variant="outlined"
                                    label="Jméno uživatele"
                                    required
                                    v-model="formData.name"
                                    :error-messages="errors.name"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="12" md="12" lg="12">
                                <v-text-field
                                    density="compact"
                                    variant="outlined"
                                    label="Email uživatele"
                                    required
                                    v-model="formData.email"
                                    :error-messages="errors.email"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="12" md="12" lg="12">
                                <v-text-field
                                    density="compact"
                                    variant="outlined"
                                    label="Heslo"
                                    required
                                    v-model="formData.password"
                                    :error-messages="errors.password"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="12" md="12" lg="12">
                                <v-checkbox
                                    density="compact"
                                    variant="outlined"
                                    label="Je admin?"
                                    required
                                    v-model="formData.isAdmin"
                                    :error-messages="errors.isAdmim"
                                ></v-checkbox>
                            </v-col>
                        </v-container>

                        <v-container fluid class="mt-n6">
                            <v-row>
                                <v-btn
                                    class="mx-7 mb-3"
                                    rounded="lg"
                                    color="red-darken-1"
                                    @click="closeDialog()"
                                >
                                    Zavřít
                                </v-btn>
                                <v-spacer></v-spacer>
                                <v-btn
                                    class="mx-7 mb-3"
                                    rounded="lg"
                                    color="green-darken-1"
                                    @click="createUser()"
                                >
                                    Uložit
                                </v-btn>
                            </v-row>
                        </v-container>
                    </v-card>
                </v-dialog>

                <v-dialog v-model="warningDialog" persistent max-width="600px">
                    <v-card rounded="lg">
                        <v-container fluid>
                            <v-col
                                cols="12"
                                sm="12"
                                md="12"
                                lg="12"
                                class="mb-3"
                            >
                                <p class="text-h6 font-size-medium text-center">
                                    <v-icon
                                        color="red"
                                        class="mx-4"
                                        size="x-large"
                                        >mdi-alert</v-icon
                                    >
                                    Opravdu si přejete odebrat uživatele?
                                </p>
                            </v-col>
                        </v-container>

                        <v-container fluid class="mt-n6">
                            <v-row>
                                <v-btn
                                    class="mx-7 mb-3"
                                    rounded="lg"
                                    color="red-darken-1"
                                    @click="closeDialog()"
                                >
                                    <v-icon class="mr-2"> mdi-close </v-icon>
                                    Zavřít
                                </v-btn>
                                <v-spacer></v-spacer>
                                <v-btn
                                    class="mx-7 mb-3"
                                    rounded="lg"
                                    color="green-darken-1"
                                    @click="deleteUser()"
                                >
                                    <v-icon class="mr-2"> mdi-check </v-icon>
                                    Odebrat
                                </v-btn>
                            </v-row>
                        </v-container>
                    </v-card>
                </v-dialog>
            </v-row>
        </v-container>
    </div>
</template>
<script>
import axios from "axios";
import SvgIcon from "@jamescoyle/vue-icon";
import { mdiAccount } from "@mdi/js";
export default {
    props: {
        user: Object,
    },
    data() {
        return {
            errors: [],
            formData: [],
            users: [],
            createUserDialog: false,
            warningDialog: false,
        };
    },
    components: {},

    created() {
        this.index();
    },
    methods: {
        index() {
            axios
                .get("admin/genius/users")
                .then((response) => {
                    this.users = response.data.data;
                })
                .catch((error) => {
                    if (error.response.status == 403) {
                        this.$router.push("/admin/login");
                    }
                });
        },
        createUser() {
            axios
                .post("admin/genius/users", {
                    name: this.formData.name,
                    email: this.formData.email,
                    password: this.formData.password,
                    isAdmin: this.formData.isAdmin,
                })
                .then((response) => {
                    if (response.data.status == "success") {
                        this.index();
                        this.closeDialog();
                    }
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
        closeDialog() {
            this.index();
            this.formData = [];
            this.createUserDialog = false;
            this.warningDialog = false;
        },

        openCreateUserDialog() {
            this.createUserDialog = true;
        },

        openWarningDialog(userId) {
            this.formData.userId = userId;
            this.warningDialog = true;
        },

        deleteUser() {
            axios
                .delete("admin/genius/users/" + this.formData.userId)
                .then((response) => {
                    this.closeDialog();
                    this.index();
                });
        },
    },

    computed: {},

    watch: {
        $route(to, from) {},
    },
    beforeDestroy: function () {},
};
</script>
