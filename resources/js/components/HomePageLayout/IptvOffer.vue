<template>
    <div>
        <v-parallax src="images/pexels-andrea-piacquadio-3811867.jpg">
            <v-card width="100%" height="100%" color="rgba(255,255,255,0.9)">
                <div
                    class="d-flex flex-column fill-height justify-start pt-16 align-center text-white"
                >
                    <h2
                        class="heading-2 text-h2 text-uppercase font-weight-normal text-center"
                    >
                        nabídka iptv<br />
                    </h2>

                    <v-container class="d-flex justify-center mt-12">
                        <v-row>
                            <v-hover v-slot="{ isHovering, props }">
                                <v-col
                                    cols="12"
                                    sm="12"
                                    md="4"
                                    lg="4"
                                    class="mt-6"
                                >
                                    <ChannelPackagesCard
                                        :elevation="isHovering ? 23 : 6"
                                        :class="{ 'on-hover': isHovering }"
                                        v-bind="props"
                                        headText="Základ"
                                        :numberOfChannels="80"
                                    ></ChannelPackagesCard>
                                </v-col>
                            </v-hover>
                            <v-hover v-slot="{ isHovering, props }">
                                <v-col cols="12" sm="12" md="4" lg="4">
                                    <ChannelPackagesCard
                                        :elevation="isHovering ? 23 : 6"
                                        :class="{ 'on-hover': isHovering }"
                                        v-bind="props"
                                        headText="Standard"
                                        :numberOfChannels="120"
                                    ></ChannelPackagesCard>
                                </v-col>
                            </v-hover>
                            <v-hover v-slot="{ isHovering, props }">
                                <v-col cols="12" sm="12" md="4" lg="4">
                                    <ChannelPackagesCard
                                        :elevation="isHovering ? 23 : 6"
                                        :class="{ 'on-hover': isHovering }"
                                        v-bind="props"
                                        headText="Komplet"
                                        :numberOfChannels="150"
                                    ></ChannelPackagesCard>
                                </v-col>
                            </v-hover>
                        </v-row>
                    </v-container>

                    <v-container class="mt-16">
                        <v-card
                            color="transparent"
                            elevation-6
                            height="100%"
                            class="rounded-lg"
                        >
                            <p
                                class="text-center rounded-t-lg text-uppercase"
                                style="
                                    background-color: #dc0d15;
                                    font-weight: 500;
                                    padding: 10px 10px 13px;
                                "
                            >
                                přídavné balíčky
                            </p>
                            <v-card
                                class="rounded-lg mt-n2"
                                height="100%"
                                elevation="24"
                            >
                                <v-card-text>
                                    <v-container
                                        fluid
                                        class="d-flex justify-space-between"
                                    >
                                        <v-row>
                                            <a
                                                class="text-h5 font-weight-bold text-decoration-none text-uppercase mx-auto"
                                                style="color: #283583"
                                            >
                                                PLUS
                                            </a>
                                            <a
                                                class="text-h5 font-weight-bold text-decoration-none text-uppercase mx-auto"
                                                style="color: #283583"
                                            >
                                                Filmbox
                                            </a>
                                            <a
                                                class="text-h5 font-weight-bold text-decoration-none text-uppercase mx-auto"
                                                style="color: #283583"
                                            >
                                                HBO
                                            </a>

                                            <a
                                                class="text-h5 font-weight-bold text-decoration-none text-uppercase mx-auto"
                                                style="color: #283583"
                                            >
                                                cinemax
                                            </a>

                                            <a
                                                class="text-h5 font-weight-bold text-decoration-none text-uppercase mx-auto"
                                                style="color: #283583"
                                            >
                                                hbo max
                                            </a>

                                            <a
                                                class="text-h5 font-weight-bold text-decoration-none text-uppercase mx-auto"
                                                style="color: #283583"
                                            >
                                                sport
                                            </a>
                                            <a
                                                class="text-h5 font-weight-bold text-decoration-none text-uppercase mx-auto"
                                                style="color: #283583"
                                            >
                                                4k-uhd
                                            </a>
                                        </v-row>
                                    </v-container>
                                </v-card-text>
                            </v-card>
                        </v-card>
                    </v-container>
                </div>
            </v-card>
        </v-parallax>
    </div>
</template>
<script>
import ChannelPackagesCard from "../Share/ChannelPackagesCard.vue";
export default {
    components: {
        ChannelPackagesCard,
    },
};
</script>
