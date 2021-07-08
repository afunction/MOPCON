<template>
    <div class="timeList">
        <div class="timeList__time" :class="{'empty': !hasTime}">
            <span>
                <slot name="time"></slot>
            </span>
        </div>
        <div class="timeList__content">
            <h3 v-if="contentType === 'title'" class="timeList__content__title">
                <slot name="content-title"></slot>
            </h3>
            <div v-if="contentType === 'card'" class="timeList__content__card">
                <slot name="content-card"></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'timeList',
    props: {
        contentType: {
            type: String,
            default: 'title',
        },
        hasTime: {
            type: Boolean,
            default: true,
        },
    },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
