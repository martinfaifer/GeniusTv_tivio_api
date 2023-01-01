<template>
    <div>
        <v-parallax src="images/pexels-jeshootscom-1040160.jpg">
            <v-card width="100%" height="100%" color="rgba(255,255,255,0.9)">
                <div
                    class="d-flex flex-column fill-height justify-start pt-16 align-center text-white"
                >
                    <h2
                        class="heading-2 text-h2 text-uppercase font-weight-normal text-center"
                    >
                        Programová skladba balíčků<br />
                    </h2>

                    <v-container class="d-flex justify-center mt-12">
                        <v-row>
                            <v-col cols="12">
                                <BasicChannelImagesCard headText="základ" :channels="channels" searcheableText="Základ" headColor="#dc0d15"></BasicChannelImagesCard>
                            </v-col>
                            <v-col cols="12">
                                <BasicChannelImagesCard headText="standart" :channels="channels" searcheableText="Standard" headColor="#dc0d15"></BasicChannelImagesCard>
                            </v-col>
                            <v-col cols="12">
                                <BasicChannelImagesCard headText="komplet" :channels="channels" searcheableText="Komplet" headColor="#dc0d15"></BasicChannelImagesCard>
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
