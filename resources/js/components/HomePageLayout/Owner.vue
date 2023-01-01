<template>
    <div>
        <v-parallax src="images/bile_pozadi.jpg" height="750">
            <v-card width="100%" height="100%" color="rgba(255,255,255,0.5)">
                <div class="d-flex flex-column fill-height pt-16 align-center">
                    <h2
                        class="heading-2 text-h2 text-uppercase font-weight-normal text-center"
                    >
                        provozovatel<br />
                    </h2>
                    <img
                        src="images/logo.svg"
                        loading="lazy"
                        width="400"
                        alt=""
                        class="mt-12"
                    />

                    <v-container fluid>
                        <v-card
                            height="480"
                            flat
                            color="transparent hidden-sm-and-down"
                            style="
                                background-image: url('images/GRAPACEK_palec.png');
                                background-repeat: no-repeat;
                                background-position: right;
                                background-size: auto 500px;
                            "
                        >
                            <v-card-text>
                                <v-container fluid>
                                    <v-row class="justify-center">
                                        <p
                                            class="font-weight-medium text-h6 text-center text-black"
                                        >
                                            <span class="font-weight-bold"
                                                >Sídlo</span
                                            ><br />Karlovo náměstí 559/28, Nové
                                            Město 120 00 Praha 2<br />IČO: 25708783<br />DIČ: CZ25708783<br /><br /><strong
                                                >telefon: </strong
                                            >
                                            <a
                                                href="tel:800911911"
                                                style="
                                                    color: #df2831;
                                                    text-decoration: none;
                                                "
                                                ><strong>800 911 911</strong></a
                                            ><strong><br />e-mail: </strong>
                                            <a
                                                href="mailto:info@grapesc.cz?subject=IPTV"
                                                class="font-weight-bold text-h6"
                                                style="
                                                    color: #df2831;
                                                    text-decoration: none;
                                                "
                                                >info@grapesc.cz</a
                                            ><strong><br /></strong><br />
                                            <a
                                                href="http://www.grapesc.cz"
                                                target="_blank"
                                                style="
                                                    color: #df2831;
                                                    text-decoration: none;
                                                "
                                                class="font-weight-bold text-h6"
                                            >
                                                www.grapesc.cz
                                            </a>
                                        </p>
                                    </v-row>
                                </v-container>
                            </v-card-text>
                        </v-card>
                         <v-card
                            height="450"
                            flat
                            color="transparent hidden-md-and-up"
                        >
                            <v-card-text>
                                <v-container fluid>
                                    <v-row class="justify-center">
                                        <p
                                            class="font-weight-medium text-h6 text-center text-black"
                                        >
                                            <span class="font-weight-bold"
                                                >Sídlo</span
                                            ><br />Karlovo náměstí 559/28, Nové
                                            Město 120 00 Praha 2<br />IČO: 25708783<br />DIČ: CZ25708783<br /><br /><strong
                                                >telefon: </strong
                                            >
                                            <a
                                                href="tel:800911911"
                                                style="
                                                    color: #df2831;
                                                    text-decoration: none;
                                                "
                                                ><strong>800 911 911</strong></a
                                            ><strong><br />e-mail: </strong>
                                            <a
                                                href="mailto:info@grapesc.cz?subject=IPTV"
                                                class="font-weight-bold text-h6"
                                                style="
                                                    color: #df2831;
                                                    text-decoration: none;
                                                "
                                                >info@grapesc.cz</a
                                            ><strong><br /></strong><br />
                                            <a
                                                href="http://www.grapesc.cz"
                                                target="_blank"
                                                style="
                                                    color: #df2831;
                                                    text-decoration: none;
                                                "
                                                class="font-weight-bold text-h6"
                                            >
                                                www.grapesc.cz
                                            </a>
                                        </p>
                                    </v-row>
                                </v-container>
                            </v-card-text>
                        </v-card>
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
