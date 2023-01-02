<template>
    <div>
        <v-card
            min-height="80vh"
            rounded="lg"
            class="overflow-hidden blur shadow-blur"
            elevation-12
            color="white"
        >
            <p class="text-center text-h6 my-2">Novinky</p>
            <v-toolbar v-if="user.isAdmin == true" color="transparent" flat>
                <template v-slot:append>
                    <v-btn
                        @click="openNewTopicDialog()"
                        size="x-small"
                        style="
                            background: rgb(93, 214, 28);
                            background: linear-gradient(
                                183deg,
                                rgba(93, 214, 28, 1) 0%,
                                rgba(14, 172, 175, 1) 100%
                            );
                        "
                        icon="mdi-plus"
                        class="success-shadow-blur gradient-green-button text-white"
                    >
                        +
                    </v-btn>
                </template>
            </v-toolbar>
            <!-- list of news when of its clicked on , shows dialog with full message -->
            <v-list lines="two">
                <v-list-item
                    v-for="topic in topics"
                    :key="topic.id"
                    @click="openTopicDialog(topic.id)"
                >
                    <v-list-item-title
                        ><strong> {{ topic.title }}</strong></v-list-item-title
                    >
                    <v-list-item-subtitle class="mx-1 my-1">
                        {{ topic.text }}
                    </v-list-item-subtitle>
                    <v-divider class="my-2"> </v-divider>
                </v-list-item>
            </v-list>
        </v-card>

        <!-- dialogs -->
        <v-row justify="center">
            <v-dialog v-model="newTopicDialog" persistent max-width="800px">
                <v-card rounded="lg">
                    <v-container fluid>
                        <v-col cols="12" sm="12" md="12">
                            <v-text-field
                                density="compact"
                                variant="outlined"
                                :error-messages="errors.title"
                                v-model="formData.title"
                                label="Titulek"
                                prepend-icon="mdi-format-title"
                                type="text"
                                autofocus
                                class="my-3"
                            ></v-text-field>
                        </v-col>

                        <v-col>
                            <v-textarea
                                prepend-icon="mdi-comment-text"
                                density="compact"
                                variant="outlined"
                                label="Obsah"
                                v-model="formData.text"
                                :error-messages="errors.text"
                                counter="1600"
                            ></v-textarea>
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
                                @click="storeNewTopic()"
                                class="mx-7 mb-3"
                                rounded="lg"
                                color="green-darken-1"
                            >
                                Uložit
                            </v-btn>
                        </v-row>
                    </v-container>
                </v-card>
            </v-dialog>

            <v-dialog v-model="topicDialog" persistent max-width="800px">
                <v-card rounded="lg">
                    <v-card-title class="text-center">
                        {{ topic.title }}
                    </v-card-title>
                    <v-container fluid>
                        <v-col cols="12" sm="12" md="12">
                            <p v-html="topic.text"></p>
                        </v-col>
                    </v-container>

                    <v-container fluid class="mt-n4">
                        <v-row>
                            <v-btn
                                prepend-icon="mdi-close"
                                class="mx-7 mb-3"
                                rounded="lg"
                                color="red-darken-1"
                                @click="closeDialog()"
                            >
                                Zavřít
                            </v-btn>
                            <v-spacer></v-spacer>
                            <v-btn
                                v-if="user.isAdmin == true"
                                prepend-icon="mdi-delete"
                                class="mx-2 mb-3"
                                rounded="lg"
                                color="red-darken-1"
                                @click="deleteTopic(topic.id)"
                            >
                                Smazat
                            </v-btn>
                            <v-btn
                                v-if="user.isAdmin == true"
                                prepend-icon="mdi-update"
                                class="mx-2 mb-3"
                                rounded="lg"
                                color="orange-darken-1"
                                @click="updateTopic(topic)"
                            >
                                Upravit
                            </v-btn>
                        </v-row>
                    </v-container>
                </v-card>
            </v-dialog>

            <v-dialog v-model="updateTopicDialog" persistent max-width="800px">
                <v-card rounded="lg">
                    <v-container fluid>
                        <v-col cols="12" sm="12" md="12">
                            <v-text-field
                                density="compact"
                                variant="outlined"
                                :error-messages="errors.title"
                                v-model="topic.title"
                                label="Titulek"
                                prepend-icon="mdi-format-title"
                                type="text"
                                autofocus
                                class="my-3"
                            ></v-text-field>
                        </v-col>

                        <v-col>
                            <v-textarea
                                prepend-icon="mdi-comment-text"
                                density="compact"
                                variant="outlined"
                                label="Obsah"
                                v-model="topic.text"
                                :error-messages="errors.text"
                                counter="1600"
                            ></v-textarea>
                        </v-col>
                    </v-container>

                    <v-container fluid class="mt-n4">
                        <v-row>
                            <v-btn
                                prepend-icon="mdi-close"
                                class="mx-7 mb-3"
                                rounded="lg"
                                color="red-darken-1"
                                @click="closeDialog()"
                            >
                                Zavřít
                            </v-btn>
                            <v-spacer></v-spacer>
                            <v-btn
                                v-if="user.isAdmin == true"
                                prepend-icon="mdi-update"
                                class="mx-2 mb-3"
                                rounded="lg"
                                color="green-darken-1"
                                @click="storeUpdateTopic(topic)"
                            >
                                Upravit
                            </v-btn>
                        </v-row>
                    </v-container>
                </v-card>
            </v-dialog>
        </v-row>
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
            topics: [],
            topic: [],
            newTopicDialog: false,
            updateTopicDialog: false,
            topicDialog: false,
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
                .get("admin/topics")
                .then((response) => {
                    this.topics = response.data.data;
                })
                .catch((error) => {
                    if (error.response.status == 403) {
                        this.$router.push("/admin/login");
                    }
                });
        },
        openNewTopicDialog() {
            this.newTopicDialog = true;
        },
        openTopicDialog(topicId) {
            axios.get("admin/topics/" + topicId).then((response) => {
                this.topic = response.data.data;
                this.topicDialog = true;
            });
        },
        closeDialog() {
            this.newTopicDialog = false;
            this.topicDialog = false;
            this.formData = [];
            this.errors = [];
            this.updateTopicDialog = false;
        },
        storeNewTopic() {
            axios
                .post("admin/topics", {
                    title: this.formData.title,
                    text: this.formData.text,
                })
                .then((response) => {
                    this.closeDialog();
                    this.index();
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },

        deleteTopic(topicId) {
            axios.delete("admin/topics/" + topicId).then((response) => {
                this.closeDialog();
                this.index();
            });
        },
        updateTopic(topic) {
            this.formData = topic;
            this.updateTopicDialog = true;
        },

        storeUpdateTopic() {
            axios
                .patch("admin/topics/" + this.formData.id, {
                    title: this.formData.title,
                    text: this.formData.text,
                })
                .then((response) => {
                    this.closeDialog();
                    this.index();
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
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
