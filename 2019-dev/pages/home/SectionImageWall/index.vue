<template>
    <section class="section section-image-wall">
        <div class="bg-cover bg-cover--1"></div>
        <div class="bg-cover bg-cover--2"></div>
        <div class="people-flashlight"></div>
        <h2 class="title"><span>{ 南台灣</span><span class="color-primary">最大行動科技年會</span><span>; }</span></h2>
        <p><span>聚集知識與人才</span><span class="symbol-x"></span><span>堅持濁水溪以南</span><span class="symbol-x"></span><span>放大科技創新力</span></p>
        <ul class="image-wall">
            <li class="image-wall__item image-wall__item--video" @click="galleryIndex = 0">
                <div class="icon-play"></div>
                <p class="image-wall__item__text">35 秒了解南台灣最狂研討會 </p>
                <div class="video-line video-line--left"></div>
                <div class="video-line video-line--right"></div>
            </li>
            <li class="image-wall__item"></li>
        </ul>
        <ul class="desc">
            <h3 class="desc__title"> 三大你不能錯過的理由！</h3>
            <li class="desc__item" v-for="item in descList" :key="item.tag">
                <div class="desc__item__head">
                    <div class="desc__item__head__tag">{{item.tag}}</div>
                    <div class="desc__item__head__title">{{item.title}}</div>
                </div>
                <p class="desc__item__text">{{item.text}}</p>
            </li>
        </ul>
        <no-ssr>
            <gallery :images="galleryVideo" :index="galleryIndex" @close="galleryIndex = null"></gallery>
        </no-ssr>
    </section>
</template>

<script>
export default {
    name: 'sectionImageWall',
    data() {
        return {
            galleryIndex: null,
            galleryVideo: [
                {
                    title: 'MOPCON 2019 宣傳片',
                    href: 'https://www.youtube.com/watch?v=OgS8GJSWHgc',
                    type: 'text/html',
                    youtube: 'OgS8GJSWHgc',
                    poster:
                        'https://scontent.ftpe8-4.fna.fbcdn.net/v/t1.0-9/64367484_2119386408187064_4329139962772455424_o.jpg?_nc_cat=111&_nc_ht=scontent.ftpe8-4.fna&oh=75605108075ccdb151e7971b3efea113&oe=5DBC6173',
                },
            ],
            descList: [
                {
                    tag: '1',
                    title: '次齊聚大神開講！',
                    text:
                        '聚焦 AI、App、Web、敏捷、UI/UX、Quant、Cloud、營運等不同領域共 33 場議程 （3 場Keynote 、2 場 Panel），與您面對面分享最新技術與經驗，跟上趨勢脈動不落人後！',
                },
                {
                    tag: '2',
                    title: '天認識新朋友！',
                    text:
                        '還在孤軍奮戰？不如找組織抱團！我們有豐富的社群攤位、Lightning Talk 與 BoF 活動，讓你結交各領域志同道合的夥伴，一起交流與成長！',
                },
                {
                    tag: '3',
                    title: '個未來新機會！',
                    text:
                        '我們有豐富的企業攤位與交流場次，滿足你找新工作、找新產品服務、找新合作夥伴的需求，在這裡每一次互動都有未來無限可能！',
                },
                {
                    tag: 'Bonus',
                    title: '最後再加碼！',
                    text:
                        '我們還有~ 與講者親密接觸的醞釀之夜、挑戰大地遊戲拿好禮、工程師看了會流淚的獨家紀念 T 恤與周邊、老街美食與奶茶(?)，今年唯一的盛會千萬別錯過！',
                },
            ],
        };
    },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
