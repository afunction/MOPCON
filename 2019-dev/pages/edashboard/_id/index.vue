<template>
    <div class="edashboard">
        <div class="news" style="height: 152px;" v-if="hasNews">
            <marquee scrollamount="10" align="middle">
                <p class="color-primary">{{newsData.title}}：<p>{{newsData.description}}</p></p>
            </marquee>
        </div>
        <div class="slider sponsor_carrousel">
            <div v-if="boardData.length > 0" v-swiper:mySwiper="swiperOption" ref="mySwiper" class="slider-container" v-on:load="slideChange()">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" v-for="(data, index) in boardData" :key="data.data.name"  :data-swiper-autoplay="(data.play_time*1000)">
                        <div v-if="data.type == 'ad'" v-show="nowActive == index" >
                            <eboardSponsor :sponsorData="data.data" :hasNews="hasNews"/>
                        </div>
                        <div v-else-if="data.type == 'session'" v-show="nowActive == index" >
                            <eboardSchedule :scheduleData="data.data" :hasNews="hasNews"/>
                        </div>
                        <div v-else-if="data.type == 'map'" >
                            <eboardSite :siteData="data.data" :hasNews="hasNews"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import eboardSchedule from '~/components/EboardSchedule';
import eboardSponsor from '~/components/EboardSponsor';
import eboardSite from '~/components/EboardSite';
export default {
    layout: 'dashboard',
    name: 'edashboard',
    components: {
        eboardSchedule,
        eboardSponsor,
        eboardSite,
    },
    data() {
        const vm = this;
        return {
            boardId: '',
            hasNews: false, //是否有上方的公告
            newsData: {
                title: '',
                description: '',
            },
            nowActive: 0,
            swiperOption: {
                effect: 'slide',
                loop: true,
                autoplay: {
                    delay: 1000,
                },
                on: {
                    slideChange() {
                        vm.nowActive = this.realIndex;
                    }
                }
            },
            boardData: [],
            testTime: 0,
        };
    },
    updated () {
        if (this.mySwiper) {
            this.$nextTick(() => {
                this.mySwiper.loopDestroy();
                this.mySwiper.loopCreate();
            })
        }
    },
    methods: {
        getBoardData() {
            const vm = this;
            vm.$axios.$get(`api/2019/board/${vm.boardId}?now=${vm.testTime}`)
            .then(({ success, data, message }) => {
                if (success) {
                    vm.boardData = data.content;
                    if (data.news.length > 0) {
                        vm.$nextTick(() => {
                            vm.hasNews = true;
                        })
                        vm.newsData = {
                            title: data.news[0].title,
                            description: data.news[0].description,
                        };
                    } else {
                        vm.$nextTick(() => {
                            vm.hasNews = false;
                        })
                    }
                }
            })
        },
    },
    async asyncData({ params }) {
        try {
            return {
                boardId: params.id
            }
        }  catch (error) {
            console.log(error);
        }
    },
    watch: {
        nowActive() {
        },
    },
    mounted() {
        const vm = this;
        this.getBoardData();
        setInterval(function() { 
            vm.getBoardData();
        }, 
        60000);
    },
    created() {
        const vm = this;
        if (vm.$route.query.now) {
            vm.testTime = vm.$route.query.now;
        }
    }
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
