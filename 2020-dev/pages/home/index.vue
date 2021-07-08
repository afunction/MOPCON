<template>
  <div id="home" class="logo-bg">
    <section class="top container">
      <div class="logo logo-mopcon" />
      <div class="top-title text-style-main">
        <p>社會參與</p>
        <span>X</span>
        <p>遠距職場</p>
        <span>X</span>
        <p>數位轉型</p>
      </div>
      <h3>10/24（六）<span>～</span>10/25（日）<br>高雄國際會議中心 ICCK</h3>
    </section>

    <div class="container">
      <div class="logo logo-hr" />
    </div>

    <section class="catch container">
      <h2>${con} With Us  堅持濁水溪以南</h2>
      <div class="text-wrap text-style-main">
        <p>聚集知識與人才</p>
        <span>X</span>
        <p>南台灣最大行動科技年會</p>
        <span>X</span>
        <p>放大科技創新力</p>
      </div>
      <div class="img-grid">
        <a href="#" class="video-bg" @click.prevent="openVideoModal(true)">
          <div class="logo logo-video-preview w-full h-full" />
        </a>
        <div class="fixed inset-0 z-50" :class="modalShow? 'block' : 'hidden'">
          <a href="#" class="fixed close-modal-icon" @click.prevent="openVideoModal(false)">x</a>
          <iframe
            ref="home-video-iframe"
            class="mx-auto"
            width="100%"
            height="100%"
            src=""
            frameborder="0"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
          />
        </div>
        <div class="logo logo-catch-2" />
        <div class="logo logo-catch-3" />
      </div>
    </section>

    <div class="container">
      <div class="logo logo-hr" />
    </div>

    <section class="about container">
      <h2>關於 MOPCON</h2>
      <div class="about-wrap">
        <div>
          <p>持續舉辦</p>
          <span>8</span>
          <p>年</p>
        </div>
        <div>
          <p>精彩議程</p>
          <span>30</span>
          <p>場以上</p>
        </div>
        <div>
          <p>熱情會眾</p>
          <span>1000</span>
          <p>人以上</p>
        </div>
      </div>
      <div class="text-wrap">
        <div class="logo logo-border" />
        <div class="logo logo-arrow" />
        <p>
          MOPCON 為熱愛「科技」的民間好手所自發的活動，今年邁入第 9 年囉！每年吸引跨產業參加人數持續攀升，去年達到近 1000 人，可稱史上南台灣最大科技年會！
          <br><br>今年籌劃共計動用約 100 位工作人員，期望帶給大家更驚豔、更豐富的行動科技年會。2020 年的議程核心以社會參與、遠距職場和數位轉型為主。當然，MOPCON 一樣會將 Moblie APP (行動科技) 、UI/UX、IoT 作為我們一貫的討論重點。
          <br><br>透過每年堅持的交流盛會，持續匯集知識、人才與資源，打造高速資訊交流圈，也促進人才流動與就業機會，帶動南台灣高經濟產業循環 。相信每個參與者都能將這些知識與資源帶回自己公司、團隊，讓這份能力產生更大的影響力。
        </p>
        <div class="logo logo-arrow arrow-reverse" />
        <div class="logo logo-border border-reverse" />
      </div>
    </section>

    <div class="container">
      <div class="logo logo-hr" />
    </div>

    <section class="sponser container">
      <h2>
        <div class="logo logo-circles logo-circles-l" />
        我有興趣贊助你們
        <div class="logo logo-circles logo-circles-r" />
      </h2>
      <button class="btn-primary" @click="mailTo">
        聯絡我們
      </button>
      <p>謝謝你願意成為全台最大行動科技領域<br>社群研討會的參與者及貢獻者之一！</p>
    </section>

    <div class="container">
      <div class="logo logo-hr" />
    </div>

    <section class="traffic container">
      <h2>會場</h2>
      <div class="traffic-main">
        <div class="img-grid">
          <div class="logo logo-section-place-img-1" />
          <div class="logo logo-section-place-img-2" />
          <div class="logo logo-section-place-img-3" />
        </div>
        <div class="location">
          <h3>高雄國際會議中心</h3>
          <p>高雄市鹽埕區中正四路274號</p>
          <a href="https://goo.gl/maps/pY4WDRfLgRZk17Ks6" target="_blank">Google 地圖<span class="logo logo-launch" /></a>
        </div>
      </div>
      <h2 class="traffic-way-title">
        交通方式
      </h2>
      <div class="traffic-way hidden sm:grid">
        <div v-for="(item, index) in traffic" :key="`traffic-${index}`">
          <div class="logo logo-arrow" />
          <h3>{{ item.type }}</h3>
          <p>{{ item.des }}</p>
        </div>
      </div>
      <div class="traffic-way mobile sm:hidden">
        <ul class="traffic-nav">
          <li
            v-for="(item, index) in traffic"
            :key="`traffic-mobile-${index}`"
            @click="active = index"
          >
            <h3 :class="{ 'active' : index === active }">
              {{ item.type }}
            </h3>
          </li>
        </ul>
        <p class="traffic-content">
          {{ traffic[active].des }}
        </p>
      </div>
    </section>

    <div class="container">
      <div class="logo logo-hr" />
    </div>

    <section-fb-news :posts="posts" />

    <div class="container">
      <div class="logo logo-hr" />
    </div>

    <section-past-years />
  </div>
</template>

<script>
import { fbNews } from '@/api/url'
import SectionFbNews from './components/SectionFbNews'
import SectionPastYears from './components/SectionPastYears'

export default {
  name: 'Home',
  components: {
    SectionFbNews,
    SectionPastYears
  },
  async asyncData ({ $axios }) {
    try {
      const { data } = await $axios.get(fbNews)
      return {
        posts: data.data
      }
    } catch (err) {}
  },
  data () {
    return {
      traffic: [
        {
          type: '公車',
          des: '歷史博物館 0 南 (單邊停靠)、0 北 (單邊停靠)、11、25、33、56、60、76、77、82、建國幹線、91、214、219、248'
        },
        {
          type: '高鐵',
          des: '左營高鐵站 / 高雄火車站搭捷運紅線'
        },
        {
          type: '火車',
          des: '至捷運美麗島站換乘橘線往西子灣方向'
        },
        {
          type: '捷運',
          des: '捷運鹽埕埔站下車，二號出口步行約 250 公尺可至會場'
        }
      ],
      active: 0,
      posts: [],
      modalShow: false
    }
  },
  jsonld () {
    return {
      '@context': 'http://schema.org',
      '@type': 'Event',
      name: '行動科技年會 2020 | Mobile / Open / Platform Conference',
      description: 'MOPCON 2020 堅持濁水溪以南，南台灣最大行動科技年會，10/24 -10/25 高雄國際會議中心與您見面。持續匯集知識與人才，打造高速資訊交流圈，提升個人與團隊價值，讓知識影響正向循環。',
      image: [
        '/2020/og-image.png'
      ],
      url: 'https://mopcon.org/2020/',
      startDate: '2020-09-24T08:30:00+08:00',
      endDate: '2020-09-25T18:00:00+08:00',
      location: {
        '@type': 'Place',
        name: '高雄國際會議中心',
        address: {
          '@type': 'PostalAddress',
          streetAddress: '高雄市鹽埕區中正四路274號',
          addressLocality: '高雄',
          addressCountry: '臺灣'
        }
      }
    }
  },
  methods: {
    openVideoModal (show) {
      this.modalShow = show
      if (!show) {
        this.$refs['home-video-iframe'].src = ''
      } else {
        this.$refs['home-video-iframe'].src = 'https://www.youtube.com/embed/OBcHwivBTjQ?loop=1&playlist=OBcHwivBTjQ'
      }
    },
    mailTo () {
      window.open('mailto:sponsor@mopcon.org')
    }
  }
}
</script>

<style lang="scss" scoped>
// logo
@import '~@/assets/styles/_mix';

$logo_map: (
  svg: mopcon arrow border launch,
  jpg: section-place-img-1 section-place-img-2 section-place-img-3 catch-1 catch-2 catch-3,
  png: icon-play video-preview
);
@include logo_map_mix(home);

#home {
  @apply text-white;
}
::v-deep > section {
  @apply mx-auto overflow-x-hidden pt-10 pb-12;
  > h2 {
    @apply text-2xl;
  }
  @screen md {
    @apply pt-16 pb-20;
    > h2 {
      @apply text-4xl;
    }
  }
  @screen sm {
    > h2 {
      @apply text-3xl;
    }
  }
}
.text-style-main {
  p {
    @apply inline-block text-yellow-500;
  }
  span {
    transform: scale(1.3, 1);
    @apply mx-1 inline-block font-light text-sm;
  }
  @screen md {
    span {
      transform: scale(1.3, 1);
      @apply text-base;
    }
  }
  @screen sm {
    @apply mx-2;
    span {
      transform: scale(1.3, 1) translateY(-1px);
    }
  }
}
.container {
  margin: 0 auto;
}

.close-modal-icon {
  z-index: 200;
  width: 48px;
  font-size: 30px;
  text-align: center;
  @apply fixed right-0 bg-yellow-500 text-blue-950 py-1;
}
// section
.top {
  @apply flex flex-col items-center justify-center pt-8 pb-4;
  .logo-mopcon {
    width: 100%;
    height: 200px;
  }
  .top-title {
    @apply mt-5 text-xl;
    span {
      position: relative;
      top: -2px;
      @apply text-base;
    }
  }
  h3 {
    @apply mt-5 mb-6 text-center text-xl;
    span {
      @apply inline-block mr-3;
    }
  }
  @screen md {
    .logo-mopcon {
      width: 750px;
      height: 360px;
    }
  }
  @screen sm {
    @apply pb-8;
    .logo-mopcon {
      width: 100%;
      height: 300px;
    }
    .top-title {
      @apply mt-10 text-2xl;
      span {
        @apply text-lg;
      }
    }
    h3 {
      @apply text-2xl mb-10;
      span {
        @apply mr-5;
      }
    }
  }
}
.catch {
  .text-wrap {
    line-height: 32px;
    @apply mt-4 text-center;
    p {
      @apply text-lg;
    }
    span {
      @apply mx-1 font-normal;
    }
  }
  .img-grid {
    grid-template-columns: auto;
    grid-template-rows: 240px;
    @apply grid mt-6;
    .video-text {
      top: 75%;
      @apply absolute w-full text-center
    }
    .video-bg {
      @apply relative;
      &:hover {
        &::before {
          @apply bg-opacity-0
        }
      }
      &::before {
        content: "";
        @apply absolute bg-gray-900 bg-opacity-25 w-full h-full;
      }
    }
    .logo {
      @apply hidden bg-cover;
      &:last-child {
        @apply col-span-2;
      }
      &:first-child {
        @apply inline-block;
      }
    }
  }
  @screen sm {
    .text-wrap {
      line-height: 27px;
      @apply text-left;
      span {
        @apply mx-2;
      }
    }
    .img-grid {
      grid-template-columns: 52% auto;
      grid-template-rows: 220px 230px;
      @apply mt-8 gap-6;
      .logo {
        @apply inline-block;
      }
    }
  }
  @screen md {
    .text-wrap p {
      @apply text-xl;
    }
    .img-grid {
      grid-template-rows: 320px 340px;
      @apply gap-8;
    }
  }
}
.about {
  &-wrap {
    @apply text-2xl mt-8 flex justify-around text-center flex-wrap;
    > div {
      @apply mb-5 w-full;
      &:last-child {
        @apply w-full mt-6;
      }
    }
    span {
      font-size: 100px;
      line-height: 120px;
      text-shadow: 6px 3px 0 rgb(67, 79, 99);
      transform: scaleY(1.1);
      @apply text-yellow-500 inline-block;
      @include border-primary;
      &::before {
        left: -8px;
        top: 7px;
        display: none;
      }
      &::after {
        right: -18px;
        bottom: 8px;
        display: none;
      }
    }
  }
  .text-wrap {
    @apply px-10 py-6 relative mt-8;
  }
  .logo-arrow {
    width: 30px;
    @apply h-10 absolute inset-y-0 my-auto;
    &:not(.arrow-reverse) {
      left: -5px;
    }
  }
  .arrow-reverse {
    transform: rotate(180deg);
    right: -5px;
  }
  .logo-border {
    width: 60px;
    height: 45px;
    @apply absolute;
    &:not(.border-reverse) {
      @apply top-0 left-0;
    }
  }
  .border-reverse {
    transform: rotate(180deg);
    @apply right-0 bottom-0;
  }
  @screen md {
    &-wrap {
      @apply text-3xl px-0 mt-12 justify-between flex-no-wrap;
      > div:last-child {
        @apply w-auto mt-0;
      }
      span {
        font-size: 130px;
        line-height: 150px;
        &::before, &::after {
          @apply inline-block;
        }
      }
    }
    .text-wrap {
      @apply text-xl px-16 mt-16;
    }
    .logo-border {
      width: 100px;
      height: 70px;
    }
    .logo-arrow {
      width: 40px;
      @apply h-12;
    }
  }
  @screen sm {
    &-wrap {
      > div {
        @apply mb-0 w-auto;
      }
    }
    .text-wrap {
      @apply text-lg py-8;
    }
    .logo-arrow {
      &:not(.arrow-reverse) {
        left: -10px;
      }
    }
    .arrow-reverse {
      right: -10px;
    }
    .logo-border {
      width: 80px;
      height: 60px;
    }
  }
}
.sponser {
  @apply text-center pt-16 pb-12;
  h2 {
    @apply text-yellow-500 mb-12 relative inline-block text-2xl;
    @include border-primary;
  }
  .btn-primary {
    width: 80%;
    @apply block mx-auto;
  }
  p {
    @apply mt-12 text-lg;
  }
  @screen md {
    @apply pt-20 pb-24;
    h2 {
      font-size: 2.5rem;
    }
    p {
      @apply text-2xl;
    }
  }
  @screen sm {
    h2 {
      @apply text-4xl;
    }
    p {
      @apply text-xl;
    }
    .btn-primary {
      width: auto;
      @apply px-40;
    }
  }
}
.traffic {
  @apply pb-12;
  > h2:not(.traffic-way-title) {
    @apply text-center;
  }
  .traffic-main {
    @apply flex mt-5 flex-wrap;
  }
  .img-grid {
    grid-template-columns: 30% auto;
    grid-template-rows: 150px 130px;
    @apply grid col-gap-2 row-gap-2 w-full;
    .logo {
      background-size: cover;
    }
    .logo:last-child {
      @apply col-span-2;
    }
  }
  .location {
    @apply pt-6 text-center w-full text-xl;
    h3 {
      @apply text-yellow-500 mb-2;
    }
    a {
      @apply text-yellow-300 inline-block mt-4 text-lg;
      &:hover {
        opacity: 0.8;
      }
    }
    .logo {
      width: 20px;
      height: 20px;
      transform: translateY(2px);
      @apply inline-block ml-4;
    }
  }
  .traffic-way-title {
    @apply text-yellow-500 mt-8 text-xl;
  }
  .traffic-way {
    grid-template-rows: auto auto auto auto;
    @apply grid-cols-1 row-gap-8 col-gap-16 mt-3 text-lg;
    h3 {
      @apply inline-block mb-3 text-xl;
    }
    .logo-arrow {
      width: 28px;
      height: 20px;
      transform: none;
      @apply hidden;
    }
    .traffic-nav {
      @apply flex justify-between border-b border-yellow-500 mb-5;
      h3 {
        transition: all 0.3s;
        @apply mb-0 pb-1 pr-1 relative;
        &::before {
          content: '';
          bottom: -2px;
          height: 2px;
          transition: all .3s;
          @apply absolute left-0 w-full;
        }
        &.active::before {
          @apply bg-yellow-500;
        }
      }
    }
    .traffic-content {
      min-height: 85px;
    }
  }
  @screen md {
    .traffic-main {
      @apply flex-no-wrap justify-between;
    }
    .img-grid {
      width: 60%;
      grid-template-columns: 156px 280px;
      grid-template-rows: 170px 138px;
      @apply col-gap-4 row-gap-4;
    }
    .location {
      width: 35%;
      @apply pt-16 text-3xl text-left;
      a {
        @apply mt-8 text-2xl;
      }
    }
    .traffic-way-title {
      font-size: 1.75rem;
      @apply mt-12;
    }
    .traffic-way {
      @apply grid-cols-2 grid-rows-2 row-gap-10 text-xl;
      h3 {
        @apply text-2xl mb-5;
      }
      .logo-arrow {
        transform: translateY(2px);
      }
    }
  }
  @screen sm {
    > h2 {
      @apply text-left;
    }
    .traffic-main {
      @apply mt-8;
    }
    .img-grid {
      grid-template-columns: 30% auto;
      grid-template-rows: 200px 160px;
      @apply col-gap-6 row-gap-6;
    }
    .location {
      font-size: 1.65rem;
      @apply pt-10;
      a {
        @apply text-xl;
      }
      .logo {
        width: 20px;
        height: 20px;
        transform: translateY(2px);
        @apply inline-block ml-4;
      }
    }
    .traffic-way-title {
      font-size: 1.65rem;
    }
    .traffic-way {
      @apply mt-6;
      > div {
        @apply static;
      }
      h3 {
        @apply text-3xl;
      }
      .logo-arrow {
        @apply inline-block;
      }
    }
  }
}
</style>
