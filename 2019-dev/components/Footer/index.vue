<template>
    <div class="footer">
        <div class="footer__contact">
            <div class="subtitle">聯絡我們</div>
            <p class="subtitle email" v-clipboard:copy="email"
                v-clipboard:success="onCopy"
                v-clipboard:error="onError">{{email}}</p>
        </div>

        <div class="footer__social">
            <div class="subtitle">在這裡找到 #MOPCON</div>
            <div class="icons">
                <a href="https://www.facebook.com/mopcon/" target="_blank" class="svg-fb">
                    <IconFB />
                </a>
                <a href="https://twitter.com/mopcon" target="_blank" class="svg-twitter">
                    <IconTwitter />
                </a>
                <a href="https://www.instagram.com/mopcon.tw/" target="_blank" class="svg-ig">
                    <IconIg />
                </a>
                <a href="https://t.me/mopcon" target="_blank" class="svg-aircraft">
                    <IconAircraft />
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import IconFB from "./svg/icon-fb.svg";
import IconIg from "./svg/icon-ig.svg";
import IconAircraft from "./svg/icon-aircraft.svg";
import IconTwitter from "./svg/icon-twitter.svg";

export default {
    name: "Footer",
    components: {
        IconFB,
        IconIg,
        IconAircraft,
        IconTwitter
    },
    data() {
        return {
            email: "contact@mopcon.org"
        };
    },
    methods: {
        onCopy() {
            alert(`信箱 ${this.email} 複製成功`);
        },
        onError: function(e) {
            alert(`信箱 ${this.email} 複製失敗`);
        }
    }
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
