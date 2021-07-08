<template>
    <div class="cardDetail">
        <div class="cardDetail__time">
            <span>{{cardData.floor}} {{cardData.room}}</span>
            <span>{{(cardData.started_at * 1000) | moment("HH:mm")}} - {{(cardData.ended_at * 1000) | moment("HH:mm")}}</span>
        </div>

        <!-- 課程類型標籤 -->
        <div class="cardDetail__tags">
            <div class="cardDetail__tag filter-btn-primary active"
                :style="`backgroundColor: ${tag.color}`"
                v-for="tag in cardData.tags"
                :key="tag.name"
                @click="handleTagClick(tag.name)">
                {{tag.name}}
            </div>
        </div>

        <h2 class="cardDetail__title">{{formatTextWrap(cardData[`topic${langPrefix}`])}}</h2>
        <p class="cardDetail__desc" v-html="formatTextWrap(cardData[`summary${langPrefix}`])"></p>

        <!-- 提示標籤 -->
        <div class="cardDetail__promptTags">
            <div class="tag-btn-secondary" v-if="cardData.sponsor_id">{{$t('pages.schedule.sponsor')}}</div>
            <div class="tag-btn-third" v-if="!cardData.recordable">{{$t('pages.schedule.noRecording')}}</div>
            <div class="tag-btn-primary" v-if="cardData.level">{{cardData.level}}</div>
        </div>

        <!-- 講者介紹 -->
        <div class="cardDetail__speaker" v-if="cardData.speakers.length > 0">
            <a :href="speakerUrl(speaker.speaker_id)"
                class="cardDetail__speaker__item"
                v-for="speaker in cardData.speakers"
                :key="speaker.speaker_id">
                <img class="cardDetail__speaker__avatar"
                    :src="speaker.img.mobile"
                    :alt="speaker[`name${langPrefix}`]">
                <div class="cardDetail__speaker__info">
                    <div class="cardDetail__speaker__info__name">{{speaker[`name${langPrefix}`]}}</div>
                    <div class="cardDetail__speaker__info__company">{{speaker[`company${langPrefix}`]}}</div>
                    <div class="cardDetail__speaker__info__job">{{speaker[`job_title${langPrefix}`]}}</div>
                </div>
            </a>
        </div>
        <!-- 夥伴議程 -->
        <a :href="`/2019/sponsor/?id=${cardData.sponsor_id}`" class="cardDetail__sponsor" v-if="cardData.sponsor_id !== 0">
            <p class="cardDetail__sponsor__title color-primary">贊助夥伴</p>
            <img class="cardDetail__sponsor__logo" :src="cardData.sponsor_info.logo_path" alt="">
        </a>
        <div class="cardDetail__btn__group">
            <div class="cardDetail__btn"
                v-clipboard:copy="detailUrl"
                v-clipboard:success="onCopy"
                v-clipboard:error="onError">
                {{$t('pages.schedule.sharingSchedule')}}
            </div>
            <a v-if="cardData.link_slide" :href="cardData.link_slide" class="cardDetail__btn" target="_blank">
                簡報下載
            </a>
        </div>
    </div>
</template>

<script>
export default {
    name: 'cardDetail',
    props: {
        langPrefix: {
            type: String,
            default: '',
        },
        detailUrl: {
            type: String,
            default: '',
        },
        cardData: {
            type: Object,
            default: true,
        },
    },
    methods: {
        onCopy() {
            alert(this.$t('pages.schedule.scheduleCopySuccess'));
        },
        onError: function(e) {
            alert(this.$t('pages.schedule.scheduleCopyFail'));
        },
        handleTagClick(id) {
            this.modalClose();
            this.$emit('onTagClick', id);
        },
        modalClose() {
            this.$emit('onModalClose', false);
        },
        speakerUrl(id) {
            return `${process.env.baseUrl}/2019/speaker/${id}`;
        },
        // 將 \n 轉成 <br>
        formatTextWrap(text) {
            if (!text) return text;
            return text.replace(/\n/g, "<br>");
        },
    },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
