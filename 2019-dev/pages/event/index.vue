<template>
    <div class="event">
        <Popup :isAction="popupAction" @onPopupClose="onPopupClose" @onSendScore="onSendScore" />
        <SectionHero @onPopupOpen="onPopupOpen" />
        <div class="event__desc section">
            <h2 class="title">{ 活動辦法 ; }</h2>
            <p class="subtitle">嘿嘿❗MOPCON 遊戲潛入 <span class="color-primary">COSCUP</span> 囉～<br>
                我們將不定期開房間，依照以下步驟挑戰成功，有機會換取<span class="color-third">精美限量紀念小物</span>！<br>
                別猶豫了～快到 <span class="color-primary">南港中央研究院 2F</span> 尋找 MOPCON 攤位，心動不如趕快行動</p>
        </div>
        <div class="event__steps section">
            <h2 class="title">{ 活動流程 ; }</h2>
            <div class="event__step" v-for="(step, index) in steps" :key="index">
                <p class="event__step__count">{{step.step}}</p>
                <p class="event__step__text" v-html="step.text"></p>
            </div>
        </div>
    </div>
</template>

<script>
import Popup from './Popup';
import SectionHero from './SectionHero';

export default {
    name: 'pageEvent',
    head() {
        return {
            title: '小智慧大PK MOPCON 2019',
        };
    },
    components: {
        SectionHero,
        Popup,
    },
    data() {
        return {
            popupAction: false,
            steps: [
                {
                    step: 'Step 0',
                    text: '工作人員不定期開房間',
                },
                {
                    step: 'Step 1',
                    text: '點擊 Play Game，輸入 Game Code 加入遊戲。',
                },
                {
                    step: 'Step 2',
                    text: '等待參賽者加入，開始《小智慧大 PK 》',
                },
                {
                    step: 'Step 3',
                    text: '依序答題 10 題，除了答對，答題越快分數越高',
                },
                {
                    step: 'Step 4',
                    text:
                        "遊戲結束後回到此頁，輸入分數<span class='color-third'>讓算命仙告訴你是哪一類人</span>",
                },
                {
                    step: 'Step 5',
                    text: '分享遊戲成果到個人 FB 並設為公開可享好康限定哦',
                },
            ],
        };
    },
    methods: {
        onPopupClose() {
            this.popupAction = false;
        },
        onSendScore(score) {
            const rootUrl =
                location.protocol + '//' + location.host + process.env.yearUrl;
            let targetUrl = '';
            console.log('rootUrl', rootUrl);

            // 肝鐵人
            if (score <= 2500) {
                targetUrl = '/iron-man';
            }

            // 黑寡婦
            if (score > 2500 && score <= 5500) {
                targetUrl = '/black-widow';
            }

            // 綠句人耗克
            if (score > 5500 && score <= 7500) {
                targetUrl = '/hulk';
            }

            // 歹丸隊長
            if (score > 7500) {
                targetUrl = '/captain-america';
            }

            if (!targetUrl) return;
            window.location.href = `${rootUrl}/event${targetUrl}`;
        },
        onPopupOpen() {
            this.popupAction = true;
        },
    },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
