<template>
    <!-- 判斷：講者 1 個以上加上 .hasMany-animate  -->
    <div class="eboardSchedule"
        :class="{'hasMany-animate': scheduleData.room.sidecar.length > 1, 'hasNewsheight': hasNews}">
        <div class="mainSchedule">
            <div class="main color-secondary">
                <p class="type-title" :class="scheduleData.title_class"> {{scheduleData.title}}</p>
                <div class="text-opacity">
                    <p class="delay animated slideInLeft fadeIn" :class="scheduleData.title_class">{{ fullTime(scheduleData.room.main.started_at, scheduleData.room.main.ended_at) }}</p>
                </div>
            </div>
            <div class="schedule__info">
                <p class="delay-7 animated slideInUp tag color-primary">{{scheduleData.room.main.room}} (
                    {{scheduleData.room.main.floor}} )</p>
                <p class="delay-7 animated slideInUp tag" v-for="tag in scheduleData.room.main.tags"
                    :class="tag.class_name">{{ tag.name }}</p>
            </div>
            <div class="schedule__topic">
                <p class="delay-8 animated slideInUp topic" v-if="scheduleData.room.main.topic.length < 16">
                    {{scheduleData.room.main.topic}}</p>
                <p class="delay-8 animated slideInUp topic-sm" v-else>{{scheduleData.room.main.topic}}</p>
            </div>
            <div class="schedule__speaker" v-if="scheduleData.room.main.speakers > 1">
                <div class="delay-9 animated slideInUp" v-if="speaker in scheduleData.room.main.speakers">
                    <img :src="speaker.img.mobile" alt="" width="140" height="140" class="speaker__pic">
                </div>
            </div>
            <div class="schedule__speaker" v-else>
                <div class="delay-9 animated slideInUp">
                    <img :src="scheduleData.room.main.speakers[0].img.mobile" alt="" width="140" height="140"
                        class="speaker__pic">
                </div>
                <div class="delay-9 animated slideInUp speaker__intro">
                    <p class="speaker__name">{{scheduleData.room.main.speakers[0].name}}</p>
                    <p class="speaker__job">{{scheduleData.room.main.speakers[0].company}}
                        {{scheduleData.room.main.speakers[0].job_title}}</p>
                </div>
            </div>
        </div>
        <!-- 單一議程裝飾 -->
        <div class="otherSchedule" style="max-width: 400px; height: 100%;" v-if="scheduleData.room.sidecar.length == 0">
            <img src="./images/single-speaker.png" alt="" height="160%" class="rotateAnimate" style="margin: -60%;">
        </div>
        <!-- 多議程顯示 -->
        <div class="otherSchedule" v-if="scheduleData.room.sidecar.length > 0">
            <div class="delay-10 animated slideInRight">
                <div class="schedule__info">
                    <p class="tag color-primary">{{scheduleData.room.sidecar[0].room}}
                        ({{scheduleData.room.sidecar[0].floor}})</p>
                    <p class="tag tag-badge-outline-third" v-for="tag in scheduleData.room.sidecar[0].tags"
                        :class="tag.class_name">{{ tag.name }}</p>
                </div>
                <div class="schedule__topic">
                    <p class="topic">{{scheduleData.room.sidecar[0].topic}}</p>
                </div>
                <div class="schedule__speaker" v-if="scheduleData.room.sidecar[0].speakers.length > 1">
                    <div class="animated slideInUp" v-for="speaker in scheduleData.room.sidecar[0].speakers">
                        <img :src="speaker.img.mobile" alt="" width="80" height="80" class="speaker__pic">
                    </div>
                </div>
                <div class="schedule__speaker" v-else>
                    <div class="animated slideInUp">
                        <img :src="scheduleData.room.sidecar[0].speakers[0].img.mobile" alt="" width="80" height="80"
                            class="speaker__pic">
                    </div>
                    <div class="speaker__intro">
                        <p class="speaker__name">{{scheduleData.room.sidecar[0].speakers[0].name}}</p>
                        <p class="speaker__job">{{scheduleData.room.sidecar[0].speakers[0].company}}
                            {{scheduleData.room.sidecar[0].speakers[0].job_title}}</p>
                    </div>
                </div>
            </div>
            <!-- 判斷 第三個 -->
            <div class="delay-11 animated slideInRight third-schedule" v-if="scheduleData.room.sidecar.length > 1">
                <div class="schedule__info">
                    <p class="tag color-primary">{{scheduleData.room.sidecar[1].room}}
                        ({{scheduleData.room.sidecar[1].floor}})</p>
                    <p class="tag tag-badge-outline-third" v-for="tag in scheduleData.room.sidecar[1].tags"
                        :class="tag.class_name">{{ tag.name }}</p>
                </div>
                <div class="schedule__topic">
                    <p class="topic">{{scheduleData.room.sidecar[1].topic}}</p>
                </div>
                <div class="schedule__speaker" v-if="scheduleData.room.sidecar[1].speakers.length > 1">
                    <div class="animated slideInUp" v-for="speaker in scheduleData.room.sidecar[1].speakers">
                        <img :src="speaker.img.mobile" alt="" width="80" height="80" class="speaker__pic">
                    </div>
                </div>
                <div class="schedule__speaker" v-else>
                    <div class="animated slideInUp">
                        <img :src="scheduleData.room.sidecar[1].speakers[0].img.mobile" alt="" width="80" height="80"
                            class="speaker__pic">
                    </div>
                    <div class="speaker__intro">
                        <p class="speaker__name">{{scheduleData.room.sidecar[1].speakers[0].name}}</p>
                        <p class="speaker__job">{{scheduleData.room.sidecar[1].speakers[0].company}}
                            {{scheduleData.room.sidecar[1].speakers[0].job_title}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'eboaedSchedule',
        props: {
            scheduleData: {
                type: Object,
                default: true,
            },
            hasNews: {
                type: Boolean,
                default: false,
            },
        },
        data() {
            return {
            }
        },
        methods: {
            fullTime(startDate,endDate) {
                const vm = this;
                startDate = new Date(startDate * 1000);
                endDate = new Date(endDate * 1000);
                const startHour = (startDate.getHours() < 10 ? '0' + startDate.getHours() : startDate.getHours());
                const startMin = (startDate.getMinutes() < 10 ? '0' + startDate.getMinutes() : startDate.getMinutes());
                const endHour = (endDate.getHours() < 10 ? '0' + endDate.getHours() : endDate.getHours());
                const endMin = (endDate.getMinutes() < 10 ? '0' + endDate.getMinutes() : endDate.getMinutes());
                return `${startHour}:${startMin} ~ ${endHour}:${endMin}`;
            },
        },
    };
</script>

<style lang="scss" src="./style.scss" scoped></style>