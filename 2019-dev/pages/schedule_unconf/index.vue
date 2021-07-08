<template>
    <div class="schedule scheduleUnconf">
        <div class="schedule__banner"></div>
        <section class="schedule__desc">
            <h1 class="title schedule__desc__title"><span class="icon-brackets">{{$t('pages.schedule.title[1]')}}</span>{{$t('pages.schedule.title[2]')}}<span class="color-primary">{{$t('pages.schedule.title[3]')}}</span>; }</h1>
            <p class="schedule__desc__text">{{$t('pages.schedule.desc')}}</p>
        </section>

        <!-- 搜尋按鈕區 -->
        <section class="schedule__tool">
            <div class="schedule__tool__date">
                <div class="btn-group">
                    <button class="btn-primary"
                        :class="{active: checkDateExist(dateBtn.id)}"
                        @click="handleDateClick(sessionUnconfData, dateBtn.id)"
                        v-for="dateBtn in filterDateBtns(sessionUnconfData)"
                        :key="dateBtn.id">
                        {{dateBtn.name}}
                    </button>
                </div>
            </div>
        </section>

        <!--  議程時間表區塊 -->
        <div class="schedule__timeList--head" v-if="unConfAddr">{{unConfAddr}}</div>
        <section class="schedule__timeList" v-if="selectSessionDate">
            <TimeList :contentType="session.event ? 'title': 'card'"
                :hasTime="session.started_at ? true : false"
                v-for="(session, index) in selectSessionDate.period" :key="`sessionId-${index}`">
                <template slot="time" v-if="session.started_at">{{(session.started_at * 1000) | moment("HH:mm")}} - {{(session.ended_at * 1000) | moment("HH:mm")}}</template>
                <template slot="content-title" v-if="session.room.length === 0">{{session.event}}</template>
                <!-- 議程內容區塊 -->
                <template slot="content-card" v-else>
                    <div class="schedule__timeList__content"
                        v-for="room in session.room"
                        :key="room.session_id"
                        :class="{avatar: room.speakers[0].img.mobile}">
                        <h3 class="schedule__timeList__content__title">{{room[`topic${langPrefix}`]}}</h3>
                        <div class="schedule__timeList__content__speaker">
                            <img :src="room.speakers[0].img.mobile"
                                :alt="room.speakers[0][`name${langPrefix}`]"
                                class="schedule__timeList__content__speaker__avatar">
                            <p class="schedule__timeList__content__speaker__name">{{room.speakers[0][`name${langPrefix}`]}}</p>
                        </div>
                    </div>
                </template>
            </TimeList>
        </section>

        <!-- 手機版時間切換鈕 -->
        <section class="schedule__tool mobile">
            <div class="schedule__tool__date">
                <div class="btn-group">
                    <button class="btn-primary"
                        :class="{active: checkDateExist(dateBtn.id)}"
                        @click="handleDateClick(sessionUnconfData, dateBtn.id)"
                        v-for="dateBtn in filterDateBtns(sessionUnconfData)"
                        :key="dateBtn.id">{{dateBtn.name}}</button>
                </div>
            </div>
        </section>

        <SectionApp />
    </div>
</template>

<script>
import SectionApp from '~/components/SectionApp';
import TimeList from '~/components/TimeList';
import { mapGetters } from 'vuex';
import i18nMixin from '~/mixins/i18nMixin';
import scheduleMixin from '~/mixins/scheduleMixin';

export default {
    name: 'scheduleUnconf',
    head() {
        return {
            title: '交流議程 | MOPCON 2019',
        };
    },
    mixins: [i18nMixin, scheduleMixin],
    components: {
        SectionApp,
        TimeList,
    },
    data() {
        return {};
    },
    computed: {
        ...mapGetters(['sessionUnconfData']),
        // 因交流議程為固定同一個場地
        // 抓出第一筆交流議程的廳別、樓層來當預設值，
        unConfAddr() {
            if (this.selectSessionDate && this.selectSessionDate.period[0]) {
                return `${this.selectSessionDate.period[0].room[0].room} ${this.selectSessionDate.period[0].room[0].floor}`;
            } else {
                return '';
            }
        },
        // 交流議程顯示資料格式
        selectSessionDate() {
            if (this.sessionUnconfData.length === 0) return;
            let temp = {};
            // 搜尋時間
            if (this.filterDate) {
                temp = this.sessionUnconfData.find(
                    session => session.date === this.filterDate
                );
                if (!temp) return;
            }
            return temp;
        },
    },
    beforeRouteEnter: (to, from, next) => {
        if (!process.env.routeScheduleUnconf) return next('/');
        next();
    },
    created() {
        this.$store.dispatch('getSessionUnconfData');
    },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
