<template>
    <section class="section section-place">
        <div class="peoples">
            <div class="people-1"></div>
            <div class="people-2"></div>
            <div class="msg-hola"></div>
        </div>
        <h2 class="title">{ 會場 ; }</h2>
        <div class="section-place__addr">
            <ul class="image-wall">
                <div class="image-wall__item"></div>
                <div class="image-wall__item"></div>
                <div class="image-wall__item"></div>
            </ul>

            <ul class="section-place__addr__lists">
                <li class="section-place__addr__list">
                    <p>在哪裡呢？</p>
                    <h3 class="subtitle">高雄國際會議中心 3F</h3>
                </li>
                <li class="section-place__addr__list">
                    <p>地址</p>
                    <h3 class="subtitle">高雄市鹽埕區中正四路274號</h3>
                    <a href="https://goo.gl/maps/ofr23X19YmPK4L3j9" target="_blank" class="google-map">Google 地圖<span class="icon-goto"></span></a>
                </li>

            </ul>

        </div>

        <div class="section-place__traffic">
            <h3 class="section-place__traffic__title">交通方式</h3>
            <ul class="section-place__traffic__items">

                <li class="section-place__traffic__item"
                    v-for="item in placeTraffic" :key="item.id">
                    <h4 class="title-line">{{item.title}}</h4>
                    <p v-html="item.desc"></p>
                </li>
            </ul>

        </div>

        <div class="section-place__traffic--mobile">
            <div class="section-place__traffic--mobile__title">交通方式</div>
            <ul class="section-place__traffic--mobile__head title-line">
                <li v-for="item in placeTraffic" :key="item.id"
                    class="item" :class="{active: item.id === placeTrafficActive}"
                    @click="placeTrafficActive = item.id">{{item.title}}</li>
            </ul>
            <p v-html="item.desc" v-for="item in placeTraffic" :key="item.id"
                class="section-place__traffic--mobile__content"
                :class="{active: item.id === placeTrafficActive}">
            </p>
        </div>

    </section>
</template>

<script>
export default {
    name: "sectionPlace",
    data() {
        return {
            placeTraffic: [
                {
                    id: 0,
                    title: "公車",
                    desc:
                        "歷史博物館 0 南 (單邊停靠)、0 北 (單邊停靠)、11、25、33、56、60、76、77、82、建國幹線、91、214、219、248"
                },
                {
                    id: 1,
                    title: "火車 / 高鐵",
                    desc:
                        "1. 左營高鐵站 / 高雄火車站搭捷運紅線<br>2. 至捷運美麗島站換乘橘線往西子灣方向"
                },
                {
                    id: 3,
                    title: "捷運",
                    desc: "捷運鹽埕埔站下車，二號出口步行約 250 公尺可至會場"
                }
            ],
            placeTrafficActive: 0
        };
    }
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
