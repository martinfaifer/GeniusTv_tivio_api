<template>
    <div>
        <v-parallax src="images/pexels-andrea-piacquadio-3769029.jpg">
            <v-card width="100%" height="100%" color="rgba(255,255,255,0.9)">
                <div
                    class="d-flex flex-column fill-height justify-start pt-16 align-center text-white"
                >
                    <h2
                        class="heading-2 text-h2 text-uppercase font-weight-normal text-center"
                    >
                        Prémiové balíčky<br />
                    </h2>

                    <v-container class="d-flex justify-center mt-12">
                        <v-row>
                            <v-col cols="12">
                                <BasicChannelImagesCard headText="Balíček Plus" :channels="channels" searcheableText="Plus" headColor="#149FE3"></BasicChannelImagesCard>
                            </v-col>
                            <v-col cols="12">
                                <BasicChannelImagesCard headText="balíček filmbox" :channels="channels" searcheableText="Filmbox" headColor="#149FE3"></BasicChannelImagesCard>
                            </v-col>
                            <v-col cols="12">
                                <BasicChannelImagesCard headText="balíček hbo max" :channels="channels" searcheableText="MAX" headColor="#149FE3"></BasicChannelImagesCard>
                            </v-col>
                            <v-col cols="12">
                                <BasicChannelImagesCard headText="balíček hbo" :channels="channels" searcheableText="HBO" exeptionText="Cinemax" headColor="#149FE3"></BasicChannelImagesCard>
                            </v-col>
                            <v-col cols="12">
                                <BasicChannelImagesCard headText="balíček cinemax" :channels="channels" searcheableText="Cinemax" headColor="#149FE3"></BasicChannelImagesCard>
                            </v-col>
                            <v-col cols="12">
                                <BasicChannelImagesCard headText="balíček sport" :channels="channels" searcheableText="Sport" headColor="#149FE3"></BasicChannelImagesCard>
                            </v-col>
                            <v-col cols="12">
                                <BasicChannelImagesCard headText="balíček 4k UHD" :channels="channels" searcheableText="4K" headColor="#149FE3"></BasicChannelImagesCard>
                            </v-col>
                        </v-row>
                    </v-container>
                </div>
            </v-card>
        </v-parallax>
    </div>
</template>
<script>
import axios from "axios";
import BasicChannelImagesCard from "../Share/BasicChannelImagesCard.vue";
export default {
    data() {
        return {
            channels: [],
        };
    },
    components: {
        BasicChannelImagesCard,
    },

    created() {
        this.index();
    },
    methods: {
        index() {
            axios.get("channels").then((response) => {
                this.channels = response.data;
            });
        },
    },
};
</script>
