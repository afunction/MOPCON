<template>
    <div class="hero">
        <div class="hero__content">
            <div class="hero__logo"></div>
            <div class="event-logo"></div>
            <Btn class="hero__btn">
                <a href="https://quizizz.com/join/game-code/" target="_blank">PLAY GAME</a>
            </Btn>
            <Btn @click.native="handlePopupOpen" class="hero__btn">輸入分數</Btn>
        </div>
    </div>
</template>

<script>
import Btn from '~/components/Btn';

export default {
    name: 'hero',
    components: {
        Btn,
    },
    methods: {
        handlePopupOpen() {
            this.$emit('onPopupOpen');
        },
    },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
