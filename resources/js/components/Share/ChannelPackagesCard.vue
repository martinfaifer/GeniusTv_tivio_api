<template>
    <v-card flat color="transparent" height="100%" class="rounded-lg">
        <p
            class="text-center rounded-t-lg text-uppercase"
            style="
                background-color: #dc0d15;
                font-weight: 500;
                padding: 10px 10px 13px;
            "
        >
            {{ headText }} <small>( {{ oldName }} )</small>
        </p>
        <v-card class="rounded-lg mt-n2" height="100%">
            <div class="div-block-4">
                <p
                    class="text-center text-h2 font-weight-medium"
                    style="color: #283583; margin-top: 40px"
                >
                    <span class="text-span text-h1 font-weight-medium">
                        {{ packageInfo.all }}
                    </span>
                    <br />kanálů
                </p>
                <p
                    class="text-center mt-6"
                    style="color: #283583; font-size: 18px"
                >
                    (více než {{ packageInfo.hd }} v HD kvalitě)
                </p>
                <p
                    class="text-center mb-3"
                    style="
                        margin-top: 35px;
                        padding-right: 15px;
                        padding-left: 15px;
                        font-family: Ubuntu, Helvetica, sans-serif;
                        font-size: 16px;
                    "
                >
                    přetáčení až 14dní zpět<br />4× set-top-box, SmartTV,
                    telefon, tablet, PC <br />H264 i H265 codec<br />
                </p>
            </div>
        </v-card>
    </v-card>
</template>
<script>
export default {
    props: {
        headText: String,
        numberOfChannels: Number,
        oldName: String,
        packageName: String,
    },

    data() {
        return {
            packageInfo: []
        }
    },
    created() {
        this.index();
    },
    methods: {
        index() {
            axios.get("package/" + this.packageName).then((response) => {
                this.packageInfo = response.data;
            });
        },
    },
};
</script>
