<template>
    <div>
        <v-container fluid>
            <v-app-bar color="transparent" flat>
                <v-btn
                    :loading="invoiceButtonLoading"
                    v-if="user.nangu_isp != null"
                    style="
                        background: rgb(33, 150, 243);
                        background: linear-gradient(
                            188deg,
                            rgba(33, 150, 243, 1) 0%,
                            rgba(33, 150, 200, 1) 100%
                        );
                    "
                    rounded="md"
                    class="info-button-shadow-blur gradient-info-button text-white mx-4"
                    @click="openInvoiceDialog()"
                >
                    Zobrazit vyúčtování
                </v-btn>

                <template v-slot:append>
                    <v-btn
                        v-if="user.isAdmin == true"
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
                        @click="openUploadDialog()"
                    >
                        Nahrát nový soubor
                    </v-btn>
                </template>
            </v-app-bar>
            <v-row>
                <v-col cols="12" sm="12" md="3" lg="3">
                    <News :user="user"></News>
                </v-col>
                <v-col cols="12" sm="12" md="9" lg="9">
                    <v-row>
                        <!-- Download logclient links -->
                        <v-col cols="12" sm="12" md="6" lg="6">
                            <IspAppCard
                                :apps="apps"
                                filterString="diagnostic"
                                headText="Diagnostické aplikace"
                            ></IspAppCard>
                        </v-col>

                        <v-col cols="12" sm="12" md="6" lg="6">
                            <IspAppCard
                                :apps="apps"
                                filterString="TV"
                                headText="Samsung TV aplikace"
                            ></IspAppCard>
                        </v-col>
                        <v-col cols="12" sm="12" md="6" lg="6">
                            <IspAppCard
                                :apps="apps"
                                filterString="androidTV"
                                headText="Android TV aplikace"
                            ></IspAppCard>
                        </v-col>
                        <v-col cols="12" sm="12" md="6" lg="6">
                            <IspAppCard
                                :apps="apps"
                                filterString="androidMobile"
                                headText="Android mobile aplikace"
                            ></IspAppCard>
                        </v-col>
                        <v-col cols="12" sm="12" md="6" lg="6">
                            <IspAppCard
                                :apps="apps"
                                filterString="LGTV"
                                headText="LG TV aplikace"
                            ></IspAppCard>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>

            <v-row justify="center">
                <v-dialog
                    v-model="fileUploadDialog"
                    persistent
                    max-width="600px"
                >
                    <v-card rounded="lg">
                        <v-container fluid>
                            <v-col cols="12" sm="12" md="12">
                                <v-file-input
                                    prepend-icon="mdi-file"
                                    density="compact"
                                    variant="outlined"
                                    label="Nahrajte soubor"
                                    @change="selectFile"
                                    :error-messages="errors.file"
                                ></v-file-input>
                            </v-col>

                            <v-col cols="12" sm="12" md="12">
                                <v-combobox
                                    prepend-icon="mdi-file-tree"
                                    :items="categories"
                                    item-title="category"
                                    item-value="id"
                                    density="compact"
                                    variant="outlined"
                                    label="Vyberte kategorii"
                                    v-model="formDatas.category"
                                    :error-messages="errors.category"
                                ></v-combobox>
                            </v-col>
                            <v-col>
                                <v-textarea
                                    prepend-icon="mdi-comment-text"
                                    density="compact"
                                    variant="outlined"
                                    label="Popis aplikace"
                                    v-model="formDatas.description"
                                    :error-messages="errors.description"
                                    counter="250"
                                ></v-textarea>
                            </v-col>
                        </v-container>

                        <v-container fluid class="mt-n6">
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
                                    prepend-icon="mdi-plus"
                                    class="mx-7 mb-3"
                                    rounded="lg"
                                    color="green-darken-1"
                                    @click="UploadFile()"
                                    :disabled="
                                        file == '' || !formDatas.category
                                    "
                                >
                                    Nahrát
                                </v-btn>
                            </v-row>
                        </v-container>
                    </v-card>
                </v-dialog>

                <v-dialog v-model="invoiceDialog" persistent max-width="600px">
                    <v-card rounded="lg">
                        <v-container fluid>
                            <v-col cols="12" sm="12" md="12">
                                <v-table fixed-header height="400">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Období</th>
                                            <th class="text-right"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="invoice in formDatas"
                                            :key="invoice.id"
                                        >
                                            <td>
                                                {{
                                                    showCreated(
                                                        invoice.created_at
                                                    )
                                                }}
                                            </td>
                                            <td>
                                                <v-icon
                                                    color="green"
                                                    @click="
                                                        downloadInvoice(
                                                            invoice.path,
                                                            invoice.name
                                                        )
                                                    "
                                                    style="cursor: pointer"
                                                    >mdi-download</v-icon
                                                >
                                            </td>
                                        </tr>
                                    </tbody>
                                </v-table>
                            </v-col>
                        </v-container>

                        <v-container fluid class="mt-n2">
                            <v-row>
                                <v-spacer></v-spacer>
                                <v-btn
                                    prepend-icon="mdi-close"
                                    class="mx-7 mb-3"
                                    rounded="lg"
                                    color="red-darken-1"
                                    @click="closeDialog()"
                                >
                                    Zavřít
                                </v-btn>
                            </v-row>
                        </v-container>
                    </v-card>
                </v-dialog>
            </v-row>
            <SnackBar
                :message="message"
                :showSnackBar="showSnackBar"
                :snackColor="snackColor"
            ></SnackBar>
        </v-container>
    </div>
</template>
<script>
import News from "../News/news.vue";
import SnackBar from "../../Share/SnackBar.vue";
import axios from "axios";
import SvgIcon from "@jamescoyle/vue-icon";
import { mdiAccount } from "@mdi/js";
import IspAppCard from "../../Share/IspAppCard.vue";
export default {
    props: {
        user: Object,
    },
    data() {
        return {
            invoiceButtonLoading: false,
            showSnackBar: false,
            notificationData: [],
            message: "",
            snackColor: "",
            file: [],
            fileUploadDialog: false,
            invoiceDialog: false,
            errors: [],
            categories: [],
            formDatas: [],
            timeout: 3000,
            apps: [],
        };
    },
    components: { IspAppCard, SnackBar, News },

    created() {
        this.index();
    },
    methods: {
        index() {
            axios
                .get("admin/apps")
                .then((response) => {
                    this.apps = response.data.data;
                })
                .catch((error) => {
                    if (error.response.status == 403) {
                        this.$router.push("/admin/login");
                    }
                });
        },

        websocketData() {
            Echo.channel("realoadApps").listen(
                "BroadcastReloadApplicationsContentEvent",
                (e) => {
                    this.index();
                }
            );
        },

        selectFile(event) {
            this.file = event.target.files[0];
        },

        UploadFile() {
            const formData = new FormData();
            formData.append("file", this.file, this.file.name);
            formData.append("category", this.formDatas.category.id);
            if (this.formDatas.description) {
                formData.append("description", this.formDatas.description);
            }
            axios.post("admin/apps", formData).then((response) => {
                this.notificationData = response.data;
                this.message = response.data.message;
                if (response.data.status == "error") {
                    this.snackColor = "error";
                } else {
                    this.closeDialog();
                    this.index();
                }
                this.showSnackBar = true;
            });
        },

        openUploadDialog() {
            axios.get("admin/apps/categories").then((response) => {
                this.categories = response.data;
                this.fileUploadDialog = true;
            });
        },

        openInvoiceDialog() {
            this.invoiceButtonLoading = true;
            axios.get("admin/invoice/" + this.user.id).then((response) => {
                this.invoiceButtonLoading = false;
                this.formDatas = response.data;
                this.invoiceDialog = true;
            });
        },

        closeDialog() {
            this.invoiceButtonLoading = false;
            this.index();
            this.fileUploadDialog = false;
            this.invoiceDialog = false;
            this.formDatas = [];
            this.file = "";
        },

        showCreated(created_at) {
            let dt = new Date(created_at);
            let month = dt.getMonth() + 1;
            let year = dt.getFullYear();

            return month + ". " + year;
        },

        downloadInvoice(path, name) {
            axios
                .post(
                    "admin/invoice/",
                    {
                        path: path,
                    },
                    { responseType: "blob" }
                )
                .then((response) => {
                    window.open(URL.createObjectURL(response.data));
                });
        },
    },
    mounted() {
        this.websocketData();
    },
    computed: {},

    watch: {
        $route(to, from) {},
    },
    beforeDestroy: function () {},
};
</script>
