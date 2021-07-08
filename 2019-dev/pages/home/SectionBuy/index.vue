<template>
    <div class="section-sectionBuy">
        <div class="section-sectionBuy__bg"></div>
        <h2 class="title"><span>{ 購票</span><span class="color-primary">入場</span><span>; }</span></h2>
        <p>還等什麼呢？想見心中大神、認識更多高手、找到工作機會和合作夥伴？</p>
    </div>
</template>

<script>
import Btn from '~/components/Btn';

export default {
    name: 'sectionBuy',
    components: {
        Btn,
    },
    computed: {
        buyTicketUrl() {
            return this.$store.getters.buyTicketUrl + this.$store.getters.utm;
        },
    },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
