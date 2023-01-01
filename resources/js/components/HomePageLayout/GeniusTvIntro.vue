<template>
    <div>
        <v-parallax src="images/cervene_pozadi.jpg" height="">
            <div
                class="d-flex flex-column fill-height justify-start pt-16 align-center text-white"
            >
                <img
                    src="images/logo_grape_genius_tv_300x300_px.png"
                    loading="lazy"
                    width="200"
                    alt=""
                    class="mb-8"
                    elevation-24
                />
                <h1 class="text-h2 font-weight-medium text-center" mb-4>
                    Chytrá TV<br />pro každou domácnost
                </h1>

                <v-card
                    width="100%"
                    style="margin-top: 220px"
                    color="rgba(255,255,255,0.9)"
                >
                    <v-container fluid>
                        <v-row  justify="center">
                            <v-col cols="12" sm="12" md="1" lg="1">
                                <v-card flat color="transparent">
                                    <v-card-text>
                                        <v-img
                                            class="mx-auto"
                                            src="images/web_rec.svg"
                                            width="80"
                                            height="90"
                                            alt=""
                                        >
                                        </v-img>
                                        <div class="pt-3">
                                            <p
                                                class="text-uppercase text-center font-weight-medium"
                                                style="color: #1387cc"
                                            >
                                                Nahrávání až 100 hodin
                                            </p>
                                        </div>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                            <v-col cols="12" sm="12" md="1" lg="1">
                                <v-card flat color="transparent">
                                    <v-card-text>
                                        <v-img
                                            class="mx-auto"
                                            src="images/web_pretaceni.svg"
                                            width="80"
                                            height="90"
                                            alt=""
                                        >
                                        </v-img>
                                        <div class="pt-3">
                                            <p
                                                class="text-uppercase text-center font-weight-medium"
                                                style="color: #1387cc"
                                            >
                                                přetáčení až 14 dní zpět
                                            </p>
                                        </div>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                            <v-col cols="12" sm="12" md="1" lg="1">
                                <v-card flat color="transparent">
                                    <v-card-text>
                                        <v-img
                                            class="mx-auto"
                                            src="images/web_uhd.svg"
                                            width="80"
                                            height="90"
                                            alt=""
                                        >
                                        </v-img>
                                        <div class="pt-3">
                                            <p
                                                class="text-uppercase text-center font-weight-medium"
                                                style="color: #1387cc"
                                            >
                                                Kanály i v Ultra HD
                                            </p>
                                        </div>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                            <v-col cols="12" sm="12" md="1" lg="1">
                                <v-card flat color="transparent">
                                    <v-card-text>
                                        <v-img
                                            class="mx-auto"
                                            src="images/web_tel_pc.svg"
                                            width="80"
                                            height="90"
                                            alt=""
                                        >
                                        </v-img>
                                        <div class="pt-3">
                                            <p
                                                class="text-uppercase text-center font-weight-medium"
                                                style="color: #1387cc"
                                            >
                                                telefon tablet i PC
                                            </p>
                                        </div>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                            <v-col cols="12" sm="12" md="1" lg="1">
                                <v-card flat color="transparent">
                                    <v-card-text>
                                        <v-img
                                            class="mx-auto"
                                            src="images/web_samsung.svg"
                                            width="80"
                                            height="90"
                                            alt=""
                                            lazy-src="images/web_samsung.svg"
                                        >
                                        </v-img>
                                        <div class="pt-3">
                                            <p
                                                class="text-uppercase text-center font-weight-medium"
                                                style="color: #1387cc"
                                            >
                                                STB,
                                            </p>
                                            <p
                                                class="text-uppercase text-center font-weight-medium"
                                                style="color: #1387cc"
                                            >
                                                SamsungTV,
                                            </p>
                                            <p
                                                class="text-uppercase text-center font-weight-medium"
                                                style="color: #1387cc"
                                            >
                                                AndroidTV
                                            </p>
                                        </div>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card>
            </div>
        </v-parallax>
    </div>
</template>
