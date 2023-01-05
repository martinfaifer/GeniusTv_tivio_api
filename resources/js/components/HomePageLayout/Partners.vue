<template>
    <div>
        <v-parallax
            src="images/pexels-andrea-piacquadio-3811867.jpg"
            height="550"
        >
            <v-card width="100%" height="100%" color="rgba(255,255,255,0.9)">
                <div
                    class="d-flex flex-column fill-height justify-start pt-16 align-center text-white"
                >
                    <h2
                        class="heading-2 text-h2 text-uppercase font-weight-normal text-center"
                    >
                        Partnerské sítě<br />
                    </h2>

                    <v-container class="d-flex justify-center mt-12">
                        <v-row class="justify-center">
                            <a
                                href="http://www.grapesc.cz/televize"
                                target="_blank"
                            >
                                <v-img
                                    src="images/logo.svg"
                                    lazy-src="images/logo.svg"
                                    width="200"
                                    height="44"
                                    class="my-2 mx-3"
                                ></v-img
                            ></a>
                            <a href="http://www.airweb.cz" target="_blank">
                                <v-img
                                    src="images/airweb.png"
                                    lazy-src="images/airweb.png"
                                    width="200"
                                    height="44"
                                    class="my-2 mx-3"
                                ></v-img
                            ></a>
                            <a
                                href="https://www.stylsoft.cz/televize"
                                target="_blank"
                            >
                                <v-img
                                    src="images/stylsoft.png"
                                    lazy-src="images/stylsoft.png"
                                    width="200"
                                    height="44"
                                    class="my-2 mx-3"
                                ></v-img>
                            </a>
                            <a href="https://www.bmb-green.cz/" target="_blank"
                                ><v-img
                                    src="images/bnb.png"
                                    lazy-src="images/bnb.png"
                                    width="200"
                                    height="44"
                                    class="my-2 mx-3"
                                ></v-img
                            ></a>
                            <a
                                href="http://www.cbcnet.cz/televize"
                                target="_blank"
                                ><v-img
                                    src="images/cbcnet.png"
                                    lazy-src="images/cbcnet.png"
                                    width="200"
                                    height="44"
                                    class="my-2 mx-3"
                                ></v-img
                            ></a>
                            <a href="http://www.jhcomp.cz" target="_blank"
                                ><v-img
                                    src="images/jhcomp.png"
                                    lazy-src="images/jhcomp.png"
                                    width="200"
                                    height="44"
                                    class="my-2 mx-3"
                                ></v-img
                            ></a>
                            <a
                                href="https://www.moses.cz/#tag_televize"
                                target="_blank"
                                ><v-img
                                    src="images/moses.png"
                                    lazy-src="images/moses.png"
                                    width="200"
                                    height="44"
                                    class="my-2 mx-3"
                                ></v-img
                            ></a>
                            <a
                                href="http://www.racingnet.cz/iptv/"
                                target="_blank"
                                ><v-img
                                    src="images/racing.svg"
                                    lazy-src="images/racing.svg"
                                    width="200"
                                    height="44"
                                    class="my-2 mx-3"
                                ></v-img
                            ></a>
                            <a
                                href="https://www.rtyne.net/televize"
                                target="_blank"
                                ><v-img
                                    src="images/rtyne.png"
                                    lazy-src="images/rtyne.png"
                                    width="200"
                                    height="44"
                                    class="my-2 mx-3"
                                ></v-img
                            ></a>
                            <a href="http://www.sauron.cz" target="_blank"
                                ><v-img
                                    src="images/sauron.png"
                                    lazy-src="images/sauron.png"
                                    width="200"
                                    height="44"
                                    class="my-2 mx-3"
                                ></v-img
                            ></a>
                            <a
                                href="https://skvely.net/sluzba-iptv"
                                target="_blank"
                                ><v-img
                                    src="images/skvely.png"
                                    lazy-src="images/skvely.png"
                                    width="200"
                                    height="44"
                                    class="my-2 mx-3"
                                ></v-img
                            ></a>
                            <a href="http://www.tlapnet.cz" target="_blank"
                                ><v-img
                                    src="images/tlapnet.png"
                                    lazy-src="images/tlapnet.png"
                                    width="200"
                                    height="44"
                                    class="my-2 mx-3"
                                ></v-img
                            ></a>
                            <a href="http://www.wolfnet.cz" target="_blank"
                                ><v-img
                                    src="images/wolfnet.png"
                                    lazy-src="images/wolfnet.png"
                                    width="200"
                                    height="44"
                                    class="my-2 mx-3"
                                ></v-img
                            ></a>
                            <a href="http://www.websoft.cz" target="_blank"
                                ><v-img
                                    src="images/websoft.png"
                                    lazy-src="images/websoft.png"
                                    width="200"
                                    height="44"
                                    class="my-2 mx-3"
                                ></v-img
                            ></a>
                            <a href="https://www1.kabel1.cz/" target="_blank"
                                ><v-img
                                    src="images/kabel1.png"
                                    lazy-src="images/kabel1.png"
                                    width="200"
                                    height="44"
                                    class="my-2 mx-3"
                                ></v-img
                            ></a>
                        </v-row>
                    </v-container>
                </div>
            </v-card>
        </v-parallax>
    </div>
</template>
<script>
import axios from "axios";
export default {
    data() {
        return {
            channels: [],
        };
    },
    components: {},

    created() {},
    methods: {},
};
</script>
