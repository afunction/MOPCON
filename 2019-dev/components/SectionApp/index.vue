<template>
    <div class="sectionApp">
        <div class="sectionApp__content">
            <div class="sectionApp__info" :class="{english: $i18n.locale === 'en'}">
                <h3 class="sectionApp__info__title">{{$t('sectionApp.title')}}</h3>
                <div class="sectionApp__info__text">{{$t('sectionApp.subtitle')}}</div>
                <div class="sectionApp__info__downloads">
                    <a class="google-play" target="_blank" href="https://play.google.com/store/apps/details?id=org.mopcon.session.app"></a>
                    <a class="app-store" target="_blank" href="https://apps.apple.com/tw/app/mopcon/id721411970"></a>
                </div>
            </div>
            <div class="sectionApp__phone"></div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'sectionApp',
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
