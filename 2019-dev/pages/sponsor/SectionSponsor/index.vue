<template>
    <section class="section section-sponsor">
        <div class="section-sponsor__content">
            <div class="people-3"></div>
            <div class="people-4"></div>
            <div class="people-5"></div>
            <div class="people-6"></div>
            <div class="people-7"></div>

            <div class="light">
                <div class="light__head"></div>
            </div>
            <h2 class="title">{ 贊助商<span class="color-primary">招募</span>; }</h2>
            <h3 class="subtitle">今年的徵求贊助計畫已順利結束，但是我們明年仍然會繼續舉辦，如果您有意願持續支持我們，請寄到我們的贊助信箱。</h3>
            <Btn>
                <a :href="pdfLink" target="_blank">贊助企劃書</a>
            </Btn>
            <p class="email" v-clipboard:copy="email"
                v-clipboard:success="onCopy"
                v-clipboard:error="onError">sponsor@mopcon.org</p>
            <p class="text">MOPCON 2019 贊助組 收</p>
            <div class="line"></div>
        </div>
    </section>
</template>

<script>
import Btn from "~/components/Btn";

export default {
    name: "sectionSponsor",
    components: {
        Btn
    },
    data() {
        return {
            email: "sponsor@mopcon.org",
            pdfLink:
                "https://drive.google.com/open?id=1fbjbdAOrs9hGy3r-DkMnyNl5eWgYJsKd"
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
