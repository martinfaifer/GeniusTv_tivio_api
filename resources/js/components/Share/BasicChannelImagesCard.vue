<template>
    <div>
        <v-card color="transparent" elevation-6 class="rounded-lg">
            <p
                class="text-center rounded-t-lg text-uppercase"
                :style="'background-color:' + headColor"
                style="font-weight: 500; padding: 10px 10px 13px"
            >
                {{ headText }}
            </p>
            <v-card class="rounded-lg mt-n2" elevation="24">
                <v-container fluid>
                    <v-row class="justify-center">
                        <div
                            v-for="channel in separatedChannels(channels)"
                            :key="channel.id"
                        >
                            <v-img
                                :lazy-src="channel.logo"
                                :src="channel.logo"
                                :aspect-ratio="16 / 9"
                                width="120"
                                class="my-2 mx-5"
                                :alt="channel.nazev"
                            >
                                <v-tooltip
                                    class="image-tooltip"
                                    activator="parent"
                                    location="bottom"
                                    open-delay="500"
                                    max-width="210"
                                >
                                    <p
                                        class="text-h6 text-center font-weight-bold mt-2"
                                    >
                                        {{ channel.nazev }}
                                    </p>
                                    <p class="my-3 text-center">
                                        <span class="font-weight-bold">{{
                                            channel.popis
                                        }}</span>
                                    </p>
                                </v-tooltip>
                            </v-img>
                        </div>
                    </v-row>
                </v-container>
            </v-card>
        </v-card>
    </div>
</template>
<script>
export default {
    props: {
        headColor: String,
        headText: String,
        channels: Array,
        searcheableText: String,
        exeptionText: String,
    },

    data() {
        return {};
    },

    methods: {
        separatedChannels(channels) {
            let channelList = [];
            channels.forEach((element) => {
                if (
                    element.channelPackages.includes(this.searcheableText) ===
                    true
                ) {
                    if (!element.channelPackages.includes(this.exeptionText)) {
                        if (element.logo != null) {
                            channelList.push(element);
                        }
                    }
                }
            });

            return channelList;
        },
    },
};
</script>
