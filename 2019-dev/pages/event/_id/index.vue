<template>
    <div class="eventResult">
        <div class="section section-logo">
            <div class="eventResult__logo"></div>
        </div>

        <div class="section eventResult__content">
            <img :src="require(`./images/${resultImage}`)" class="eventResult__content__image">
            <div class="eventResult__content__info">
                <div class="subtitle">
                    <span class="color-third">MOPCON算命仙 : </span><br>
                    咦!原來...<br>
                    你是<span class="color-primary">{{resultTitle}}</span>
                </div>
                <p class="desc">{{resultDesc}}</p>
                <no-ssr>
                    <social-sharing class="fb-share" :url="shareUrl"
                        :title="resultTitle"
                        :description="resultDesc"
                        :quote="`MOPCON算命仙: 咦!原來...你是${resultTitle}`"
                        hashtags="MOPCON"
                        inline-template>
                        <div>
                            <network class="fb-share__btn" network="facebook">
                                分享
                            </network>
                        </div>
                    </social-sharing>
                </no-ssr>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'eventResult',
    scrollToTop: true,
    head() {
        return {
            title: `${this.resultTitle} | 小智慧大PK MOPCON 2019`,
            meta: [
                {
                    hid: 'description',
                    name: 'description',
                    content: this.resultDesc,
                },
                // fb
                {
                    hid: 'og-title',
                    property: 'og:title',
                    content: `${this.resultTitle} | 小智慧大PK MOPCON 2019`,
                },
                {
                    hid: 'og-description',
                    property: 'og:description',
                    content: this.resultDesc,
                },
                {
                    hid: 'og-url',
                    property: 'og:url',
                    content: `https://mopcon.org/2019/event/${this.resultId}`,
                },
                {
                    hid: 'og-image',
                    property: 'og:image',
                    content: `https://mopcon.org/2019/images/${this.resultImage}`,
                },
                // twitter seo
                {
                    hid: 'twitter-site',
                    name: 'twitter:site',
                    content: `${this.resultTitle} | 小智慧大PK MOPCON 2019`,
                },
                {
                    hid: 'twitter-description',
                    name: 'twitter:description',
                    content: this.resultDesc,
                },
                {
                    hid: 'twitter-app:name:iphone',
                    name: 'twitter:app:name:iphone',
                    content: `${this.resultTitle} | 小智慧大PK MOPCON 2019`,
                },
                {
                    hid: 'twitter-app:name:ipad',
                    name: 'twitter:app:name:ipad',
                    content: `${this.resultTitle} | 小智慧大PK MOPCON 2019`,
                },
            ],
        };
    },
    data() {
        return {
            resultTitle: '',
            resultDesc: '',
            resultId: '',
            resultImage: '',
        };
    },
    computed: {
        shareUrl() {
            return `${process.env.baseUrl}/2019/event/${this.resultId}`;
        },
    },
    async asyncData({ store, params, redirect }) {
        try {
            const results = [...store.getters.eventResults];
            const currentResult = results.find(item => item.id === params.id);
            // 若沒輸入 id, 或無符合就返回 /event
            if (params.id === undefined || !currentResult) {
                redirect(`/event`);
            }

            return {
                resultTitle: currentResult ? currentResult.title : '',
                resultDesc: currentResult ? currentResult.desc : '',
                resultId: currentResult ? currentResult.id : '',
                resultImage: currentResult ? currentResult.image : '',
            };
        } catch (error) {
            console.log(error);
        }
    },
    mounted() {
        window.scrollTo({
            top: 0,
        });
    },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
