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
            <h2 class="title">{ 贊助商<span class="color-primary">招募中</span>; }</h2>
            <h3 class="subtitle">成為全台最大行動科技領域社群研討會的參與者及貢獻者之一</h3>
            <Btn>
                <a :href="pdfLink" target="_blank">贊助企劃書</a>
            </Btn>
            <p class="email" v-clipboard:copy="email"
                v-clipboard:success="onCopy"
                v-clipboard:error="onError">sponsor@mopcon.org</p>
            <p class="text">MOPCON 2019 贊助組 收</p>
            <div class="line"></div>
        </div>
        <ul class="section-sponsor__logos">
            <!-- <li class="section-sponsor__logo appier"></li>
            <li class="section-sponsor__logo google"></li>
            <li class="section-sponsor__logo oath"></li> -->
        </ul>
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
