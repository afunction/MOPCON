<template>
    <div class="hero">
        <div class="hero__content">
            <div class="hero__logo"></div>
            <h2 class="subtitle">人工智慧<span class="icon-x"></span>量化投資</h2>
            <div class="hero__desc">
                <p>10/19（六）～ 10/20（日)<br>
                    高雄國際會議中心 ICCK</p>
            </div>
            <div class="hero__countdown hero__countdown--mobile">
                <span>{{countDownDay}}</span>
                <span class="day">天</span>
                <span>{{countDownHour}}</span>
                <span class="hour">小時</span>
                <span>{{countDownMin}}</span>
                <span class="min">分鐘</span>
                <!-- <span>{{countdown.sec}}</span>
                <span>秒</span> -->
            </div>
            <Btn class="hero__btn">
                <a href="https://www.facebook.com/mopcon/" target="_blank">追蹤粉絲專頁</a>
            </Btn>
        </div>
        <div class="hero__countdown hero__countdown--pc">
            <span>{{countDownDay}}</span>
            <span class="day">天</span>
            <span>{{countDownHour}}</span>
            <span class="hour">小時</span>
            <span>{{countDownMin}}</span>
            <span class="min">分鐘</span>
            <!-- <span>{{countdown.sec}}</span>
            <span>秒</span> -->
        </div>
    </div>
</template>

<script>
import Btn from "~/components/Btn";

export default {
    name: "hero",
    components: {
        Btn
    },
    data () {
        return {
            countdown: {
                day: '',
                hour: '',
                min: '',
                sec: ''
            },
            timer: null,
            targetTime: '2019/10/19',
            runTimeInterval: 60 // 秒單位, 每60秒更新一次
        };
    },
    computed: {
        countDownDay () {
            if (this.countdown.day.toString().length >= 3) {
                return `0${this.countdown.day}`.substr(-3);
            } else {
                return `0${this.countdown.day}`.substr(-2);
            }
        },
        countDownHour () {
            return `0${this.countdown.hour}`.substr(-2);
        },
        countDownMin () {
            return `0${this.countdown.min}`.substr(-2);
        }
    },
    methods: {
        calculationCountDown (targetTime) {
            const endTime = new Date(targetTime).getTime()
            const diff = (endTime - new Date().getTime()) / 1000
            this.countdown.day = parseInt(diff / 24 / 60 / 60)
            this.countdown.hour = parseInt(diff / 60 / 60 % 24)
            this.countdown.min = parseInt(diff / 60 % 60)
            // this.countdown.sec = parseInt(diff % 60)
        },
        runCountDown () {
            this.timer = setInterval(() => {
                this.calculationCountDown(this.targetTime)
            }, this.runTimeInterval * 1000)

        },
    },
    mounted () {
        this.calculationCountDown(this.targetTime)
        this.runCountDown()
    },
    beforeDestroy () {
        clearInterval(this.timer)
    }
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
