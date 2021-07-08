<template>
    <div class="eboardSponsor" v-if="sponsorData.sponsor_ad_img">
        <img src="./images/circle.png" width="635" alt="" class="bg-circle-1">
        <img src="./images/circle.png" width="872" alt="" class="bg-circle-2">
        <div class="sponsor__info" :class="{'hasNewsheight': hasNews}">
            <div class="area" style="overflow: hidden;">
               <img :src="sponsorData.sponsor_ad_img" alt="" class="sponsor__img">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'eboaedSchedule',
        props: {
            sponsorData: {
                type: Object,
                default: true,
            },
            hasNews: {
                type: Boolean,
                default: false,
            },
        },
        data() {
            return {
            }
        },
        methods: {
        },
    };
</script>

<style lang="scss" src="./style.scss" scoped></style>