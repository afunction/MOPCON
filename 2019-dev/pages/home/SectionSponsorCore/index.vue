<template>
    <div class="section section-sponsorCore">
        <h2 class="title"><span>{ 核心</span><span class="color-primary">贊助商夥伴</span><span>; }</span></h2>
        <ul class="sponsors">
            <li class="sponsors__item"
                v-for="(item, index) in sponsors"
                :key="index"
                :style="`background-image: url(${require(`./images/${item.img}`)})`">
                <div class="sponsors__item__tag">
                    <span v-if="item.year > 1">連續贊助 {{item.year}} 年</span>
                    <span v-else>新贊助好夥伴</span>
                </div>
            </li>
            <li class="sponsors__item__more">
                <a href="sponsor" class="section-sponsorCore__more">更多贊助商夥伴</a>
            </li>
        </ul>
        <div class="section-sponsorCore__mobile">
            <a href="sponsor" class="section-sponsorCore__more__mobile">更多贊助商夥伴</a>
        </div>
    </div>
</template>

<script>
export default {
    name: 'sectionSponsorCore',
    data() {
        return {
            sponsors: [
                {
                    img: 'kkbox.png',
                    year: '8',
                },
                {
                    img: 'verizon-media.png',
                    year: '6',
                },
                {
                    img: 'aws.png',
                    year: '7',
                },
                {
                    img: 'pumo.png',
                    year: '4',
                },
                {
                    img: 'cathay.png',
                    year: '1',
                }
            ],
        };
    },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
