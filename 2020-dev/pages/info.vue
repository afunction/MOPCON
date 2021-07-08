<template>
  <div id="info" class="logo-bg pb-20 pt-8" style="min-height: calc(100vh - 63px - 160px);">
    <section class="container mx-auto flex flex-col items-center mb-6 top overflow-x-hidden">
      <div class="logo logo-speaker-title" />
      <div class="relative h-full top">
        <h2 class="relative mt-10 mb-12 md:text-4xl text-3xl text-white text-center z-10">
          <div class="logo logo-circles logo-circles-l" />MOPCON
          <span class="text-yellow-500">懶人包</span>
          <div class="logo logo-circles logo-circles-r" />
        </h2>
      </div>
    </section>
    <section class="container mx-auto notice-content">
      <div class="header-width px-sm-10 px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 md:gap-8 gap-6 mt-6">
          <div
            style="min-height: 200px;"
            class="bg-yellow-500 rounded-lg p-4 relative overflow-hidden"
          >
            <div class="bg-decoration logo-bg-circle" />
            <div class="flex items-center mt-5">
              <a href="https://play.google.com/store/apps/details?id=org.mopcon.session.app" target="_blank" class="logo-google logo-google-play" />
              <a href="https://apps.apple.com/tw/app/mopcon/id721411970" target="_blank" class="logo-apple logo-app-store" />
            </div>
            <h3 class="mt-3 text-2xl text-gray-900 font-bold mx-1">
              MOPCON App 下載
            </h3>
            <p class="text-gray-900 mx-1">
              下載 MOPCON App，建立你的行事曆吧！
            </p>
          </div>
          <a
            v-for="info in infoList"
            :key="info.id"
            :href="info.link"
            target="_blank"
            style="min-height: 200px;"
            class="bg-yellow-500 rounded-lg p-4 relative overflow-hidden"
          >
            <div class="bg-decoration logo-bg-circle" />
            <!-- eslint-disable-next-line vue/no-v-html -->
            <div class="bg-white rounded-full info-icon" style="width: 80px; height: 80px;" v-html="info.img" />
            <h3 class="mt-3 text-2xl text-gray-900 font-bold mx-1">
              {{ info.title }}
            </h3>
            <p class="text-gray-900 mx-1">
              {{ info.content }}
            </p>
          </a>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'Notice',
  data () {
    return {
      infoList: [
        {
          id: 1,
          img: '<span class="material-icons">facebook</span>',
          link: 'https://www.facebook.com/mopcon/',
          title: 'MOPCON 粉絲專頁',
          content: '粉專按讚追蹤起來，最新、最夯資訊通通報你知。'
        },
        {
          id: 2,
          img: '<span class="material-icons">history_edu</span>',
          link: 'https://medium.com/mopcon-%E5%B7%A5%E4%BA%BA%E6%99%BA%E6%85%A7%E8%A8%98%E4%BA%8B%E6%9C%AC  ',
          title: 'MOPCON攻略',
          content: 'MOPCON的 好好行、好好聽、好好買、好好說和好好玩，統統幫你整理好啦！參加 MOPCON 不忙不亂。'
        },
        {
          id: 3,
          img: '<span class="material-icons">restaurant_menu</span>',
          link: 'https://rdr.mopcon.org/foodmap',
          title: '美食地圖',
          content: '大會中午不供餐，在此附上精選私藏美食地圖，好吃的傳統美食、必喝的在地飲料，都在這份 MOPCON 的私藏美食地圖中（別忘了回來聽議程啊，下午的演講也很精彩）'
        },
        {
          id: 4,
          img: '<span class="material-icons">people</span>',
          link: 'https://hackmd.io/@mopcon/MOPCON2020_BoF',
          title: 'BoF',
          content: 'BoF 就像是社群同樂會！你可以是發起者，也可以是參與者，把握這個難得的交流機會！只要到此共筆連結，做發起或報名參加，依上面說明的時間地點參加即可。'
        },
        {
          id: 5,
          img: '<span class="material-icons">Assignment</span>',
          link: 'https://www.surveycake.com/s/mDYkB',
          title: '會後問卷',
          content: ''
        }
      ]
    }
  },
  mounted () {},
  methods: {}
}
</script>
<style lang="scss" scoped>
@import '~@/assets/styles/_mix';
$logo_map: (
  png: bg-circle google-play,
  svg: app-store
);
@include logo_map_mix(info);

@mixin bg-contain {
  @apply bg-contain bg-center bg-no-repeat;
}
.bg-decoration {
  width: 100%;
  height: 150%;
  position: absolute;
  z-index: 10;
  right: -40%;
  z-index: 0;
  @include bg-contain
}
.logo-google {
  width: 120px;
  height: 60px;
  @include bg-contain
  @apply block;
}
.logo-apple {
  width: 180px;
  height: 38px;
  @include bg-contain
  @apply block;
}
.notice-content h3, .notice-content p, .notice-content a {
  position: relative;
  z-index: 2;
}
.info-icon {
  @apply flex items-center justify-center;
}
::v-deep .info-icon span {
  font-size: 62px;
}
</style>
