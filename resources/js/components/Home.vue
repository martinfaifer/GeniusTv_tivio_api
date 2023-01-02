<template>
    <div>
        <AppBar></AppBar>
        <GeniusTVIntro></GeniusTVIntro>

        <IptvOffer></IptvOffer>
        <ChannelPackages></ChannelPackages>
        <PremiumPackages></PremiumPackages>
        <Partners></Partners>
        <Owner></Owner>
    </div>
</template>
<script>
import AppBar from "./HomePageLayout/AppBar.vue";
import GeniusTVIntro from "./HomePageLayout/GeniusTvIntro.vue";
import IptvOffer from "./HomePageLayout/IptvOffer.vue";
import ChannelPackages from "./HomePageLayout/ChannelPackages.vue";
import PremiumPackages from "./HomePageLayout/PremiumPackages.vue"
import Partners from "./HomePageLayout/Partners.vue";
import Owner from "./HomePageLayout/Owner.vue"
export default {
    data() {
        return {};
    },
    components: {
        AppBar,
        GeniusTVIntro,
        IptvOffer,
        ChannelPackages,
        PremiumPackages,
        Partners,
        Owner
    },

    created() {
    },
    methods: {
        //
    },

    watch: {
        $route(to, from) {},
    },
    beforeDestroy: function () {},
};
</script>
