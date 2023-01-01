<template>
    <div class="text-center">
        <v-snackbar
            v-model="currSnackBar"
            :timeout="timeout"
            :color="snackColor"
        >
            {{ message }}
        </v-snackbar>
    </div>
</template>
<script>
import axios from "axios";
export default {
    props: {},
    data() {
        return {
            timeout: 3000,
            currSnackBar: false,
            user: [],
            message: "",
            snackColor: "",
            showSnackBar: false,
        };
    },
    created() {
        this.index();
    },

    methods: {
        index() {
            axios.get("user").then((response) => {
                this.user = response.data;
                this.websocketData();
            });
        },
        websocketData() {
            Echo.channel("UserNotification_" + this.user.id).listen(
                "BroadcastFrontEndNotificationEvent",
                (e) => {
                    this.showSnackBar = true;
                    this.status = e.status;
                    this.message = e.message;
                }
            );
        },
    },
    mounted() {
        this.websocketData();
    },
    watch: {
        showSnackBar() {
            if (this.showSnackBar == true) {
                this.currSnackBar = true;
            }
        },
    },
};
</script>
