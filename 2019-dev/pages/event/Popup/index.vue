<template>
    <div class="popup-cover" :class="{action: isAction}">
        <div class="popup">
            <div class="popup__close" @click="handleClose"></div>
            <div class="popup__title">輸入分數</div>
            <div class="popup__desc">
                <span>輸入你的遊戲分數，</span>
                <span class="color-third">讓 MOPCON 算命仙告訴你是哪一類人</span>
            </div>
            <input @keyup.enter="sendScore" v-model="score" type="number" placeholder="輸入遊戲分數看你是誰" class="popup__input">
            <Btn @click.native="sendScore">現在開示</Btn>
        </div>
    </div>
</template>

<script>
import Btn from '~/components/Btn';
export default {
    name: 'Popup',
    components: {
        Btn,
    },
    props: {
        isAction: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            score: null,
        };
    },

    methods: {
        handleClose() {
            this.$emit('onPopupClose');
        },
        sendScore() {
            if (!this.score) return;
            this.$emit('onSendScore', this.score);
            this.score = null;
            this.handleClose();
        },
    },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
