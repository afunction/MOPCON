<template>
    <div class="card"
        :class="[type, {more: cardData.speakers.length > 1}, {exceed: cardData.speakers.length > 3}]"
        @click="handleShowDetail(cardData.session_id)">
        <div class="card__head">
            <span class="card__head__room">{{cardData.room}}({{cardData.floor}})</span>
            <span class="card__head__time" v-if="showTime">{{(cardData.started_at * 1000) | moment("HH:mm")}} - {{(cardData.ended_at * 1000) | moment("HH:mm")}}</span>
        </div>
        <div class="card__content">

            <!-- 課程類型標籤 -->
            <div class="card__content__tags">
                <div class="card__content__tag filter-btn-primary active"
                    :style="`backgroundColor: ${tag.color}`"
                    v-for="tag in cardData.tags"
                    :key="tag.name"
                    @click.stop="handleTagClick(tag.name)">
                    {{tag.name}}
                </div>
            </div>

            <h3 class="card__content__name">{{cardData[`topic${langPrefix}`]}}</h3>

            <!-- 提示標籤 -->
            <div class="card__content__promptTags">
                <div class="tag-btn-secondary" v-if="cardData.sponsor_id !== 0">{{$t('pages.schedule.sponsor')}}</div>
                <div class="tag-btn-third" v-if="!cardData.recordable">{{$t('pages.schedule.noRecording')}}</div>
                <div class="tag-btn-primary" v-if="cardData.level">{{cardData.level}}</div>
            </div>

            <!-- 講者介紹 -->
            <div class="card__content__speaker" v-if="cardData.speakers.length > 0">
                <div class="card__content__speaker__item"
                    v-for="speaker in cardData.speakers"
                    :key="speaker.speaker_id">
                    <img class="card__content__speaker__avatar"
                        :src="speaker.img.mobile"
                        :alt="speaker[`name${langPrefix}`]">
                    <div class="card__content__speaker__name">{{speaker[`name${langPrefix}`]}}</div>
                </div>
            </div>
        </div>
        <div class="card__btn" @click="handleShowDetail(cardData.session_id)"></div>
    </div>
</template>

<script>
export default {
    name: 'card',
    props: {
        type: {
            type: String,
            default: 'big',
        },
        cardData: {
            type: Object,
            required: true,
        },
        langPrefix: {
            type: String,
            default: '',
        },
        showTime: {
            type: Boolean,
            default: false,
        },
    },
    methods: {
        handleTagClick(id) {
            this.$emit('onTagClick', id);
        },
        handleShowDetail(id) {
            this.$emit('onShowDetail', id);
        },
    },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
