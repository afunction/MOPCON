<template>
  <div class="sponsor logo-bg pt-16">
    <div class="logo logo-sponsor_banner sponsor-content-height sponsor-content-width" />
    <section class="sponsor-header container">
      <div class="logo logo-sponsor-title" />
      <div class="relative h-full">
        <h2 class="sponsor-title text-center">
          <div class="logo logo-circles logo-circles-l" />
          我們感謝 <span>過往支持
            <span class="md:inline-block block">MOPCON 的贊助商</span></span>
          <div class="logo logo-circles logo-circles-r" />
        </h2>
      </div>
      <p class="sponsor-content-width mt-8">
        MOPCON 目前已是南台灣最大技術社群研討會，成立宗旨為連結產業與資訊工程技術，以培養更多資訊科技人才，推動高雄產業創新發展，而沒有夥伴們的支持，這個願景就不可能成真！謝謝這 7 年來每一位夥伴的加入，和我們一起凝聚南臺灣的人才和知識，共同成長、學習！
      </p>
    </section>
    <div class="container mx-auto lg:px-32 md:px-16 text-white">
      <div ref="swiper" class="swiper md:px-10">
        <div
          v-swiper:swiper="swiperOption"
          class="swiper-container"
        >
          <div class="swiper-wrapper">
            <div v-for="(n, index) in 6" :key="'sponsor-swiper' + index" class="swiper-slide">
              <div class="sponsor-swiper" :class="'logo-sponsor-' + n" />
            </div>
          </div>
        </div>
      </div>
      <div class="sponsor-swiper-navigation">
        <a href="#" @click.prevent="handleSwiperClick('prev')">
          <span class="material-icons align-middle text-gray-500">
            arrow_back
          </span>
        </a>
        <a href="#" class="ml-6 mr-8" @click.prevent="handleSwiperClick('prev')">
          <span class="sponsor-swiper-circle-btn" />
        </a>
        <a href="#" class="mr-6 ml-8" @click.prevent="handleSwiperClick('next')">
          <span class="sponsor-swiper-circle-btn" />
        </a>
        <a href="#" @click.prevent="handleSwiperClick('next')">
          <span class="material-icons align-middle text-gray-500">
            arrow_forward
          </span>
        </a>
      </div>
      <h3 class="sponsor-title md:text-left text-center">
        想加入<span>我們嗎？</span>
      </h3>
      <p class="mb-10 md:text-left text-center">
        想了解加入贊助商，會遇到什麼樣的與會民眾嗎？
      </p>
      <div class="sponsor-intro">
        <div class="sponsor-intro-banner">
          <div class="logo logo-sponsor_intro sponsor-intro-banner-height w-full" />
        </div>
        <div class="sponsor-intro-description">
          <p>
            # 濁水溪以南 <span>破千人研討會</span>
          </p>
          <p>
            # 與會者以<span>軟體開發者</span>居多，也有<span>設計師、學生</span>等等
          </p>
          <p>
            # 每年超過 30 場<span>高品質議程，邀請超過 25 位講師</span>
          </p>
          <h4 class="sponsor-intro-subtitle">
            \\ 參與者目的
          </h4>
          <ul class="lg:text-lg">
            <li class="color-primary progress">
              <span class="progress-100" />
              <span class="text-purple-400 mr-1">Top 1</span> 支持濁水溪以南科技研討會
            </li>
            <li class="color-primary progress">
              <span class="progress-70" />
              <span class="text-purple-400 mr-1">Top 2</span> 想聽取不同領域的相關議題
            </li>
            <li class="color-primary progress">
              <span class="progress-35" />
              <span class="text-purple-400 mr-1">Top 3</span> 有感興趣的議題
            </li>
          </ul>
        </div>
      </div>
      <h3 class="sponsor-title text-center md:px-0 px-6">
        加入我們，<span class="md:inline-block block">最實質的收穫是什麼？</span>
      </h3>
      <ul class="sponsor-reward">
        <li>
          <div class="sponsor-reward-img logo logo-sponsor_has1 mx-auto" />
          <h4 class="sponsor-reward-title">
            品牌曝光
          </h4>
          <p>接觸逾千名參與者的行動科技社群，是推廣服務及產品、曝光品牌的絕佳機會。</p>
        </li>
        <li>
          <div class="sponsor-reward-img logo logo-sponsor_has2 mx-auto" />
          <h4 class="sponsor-reward-title">
            與講者接觸
          </h4>
          <p>透過聚餐和厲害的講者們有更進一步的接觸，奠定日後合作關係。</p>
        </li>
        <li>
          <div class="sponsor-reward-img logo logo-sponsor_has3 mx-auto" />
          <h4 class="sponsor-reward-title">
            徵才媒合
          </h4>
          <p>接觸大量相關領域的高品質人才，大幅提升市場開發及徵才的效率及成功率。</p>
        </li>
        <li>
          <div class="sponsor-reward-img logo logo-sponsor_has4 mx-auto" />
          <h4 class="sponsor-reward-title">
            推廣產品
          </h4>
          <p>在活動中提升知名度，也將產品導入贊助廣告中。</p>
        </li>
      </ul>
    </div>
    <div class="container mx-auto pb-32">
      <h3 class="sponsor-title md:text-left text-center">
        我們的<span>夥伴們</span>
      </h3>
      <div v-for="(sponsorGroup, index) in sponsors" :key="'sponsor_block' + index" class="mt-10">
        <p class="sponsor-partner-title">
          // {{ sponsorGroup.name }}
        </p>
        <div class="sponsor-partner">
          <sponsorCard v-for="sponsor in sponsorGroup.data" :key="sponsor.id" :sponsor-data="sponsor" @modalOpen="openModal" />
        </div>
      </div>
    </div>
    <Dialog v-if="activeSponsor !== -1" :visible="dialogShow" class="w-full" @close="closeModal">
      <div slot="body">
        <sponsorDialog :now-sponsor="sponsorInfo" />
      </div>
    </Dialog>
  </div>
</template>

<script>
import { sponsor } from '@/api/url'
import Dialog from '@/components/Dialog'
import sponsorCard from './sponsorCard'
import sponsorDialog from './sponsorDialog'
export default {
  name: 'Sponsor',
  components: {
    sponsorCard,
    sponsorDialog,
    Dialog
  },
  async asyncData ({ $axios, params }) {
    try {
      const { data } = await $axios.get(sponsor)
      const config = {
        sponsors: data.data
      }
      if (params.sponsor_id) {
        config.activeSponsor = +params.sponsor_id
        config.dialogShow = true
      }
      return config
    } catch (err) {}
  },
  data () {
    return {
      sponsors: [],
      activeSponsor: -1,
      dialogShow: false,
      swiperOption: {
        slidesPerView: 3,
        spaceBetween: 20,
        breakpoints: {
          479: {
            slidesPerView: 1,
            spaceBetween: 20
          },
          768: {
            slidesPerView: 2,
            spaceBetween: 20
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 20
          }
        }
      }
    }
  },
  computed: {
    sponsorInfo () {
      return this.sponsors.map(sponsor => sponsor.data)
        .reduce((acc, sponsor) => acc.concat(...sponsor), [])
        .find(sponsor => sponsor.sponsor_id === this.activeSponsor)
    }
  },
  methods: {
    openModal (val) {
      this.dialogShow = val.open
      this.activeSponsor = val.id
    },
    closeModal () {
      this.dialogShow = false
      setTimeout(function () {
        this.activeSponsor = -1
      }, 500)
    },
    handleSwiperClick (direction) {
      this.swiper[direction === 'next' ? 'slideNext' : 'slidePrev']()
    }
  },
  head () {
    return {
      title: this.dialogShow ? `${this.sponsorInfo.name} | 贊助夥伴 MOPCON 2020` : '贊助夥伴 | MOPCON 2020',
      meta: [
        {
          hid: 'description',
          name: 'description',
          content: this.dialogShow ? this.sponsorInfo.about_us : ''
        },
        // fb
        {
          hid: 'og-title',
          property: 'og:title',
          content: this.dialogShow ? `${this.sponsorInfo.name} | 贊助夥伴 MOPCON 2020` : '贊助夥伴 | MOPCON 2020'
        },
        {
          hid: 'og-description',
          property: 'og:description',
          content: this.dialogShow ? this.sponsorInfo.sponsor_id : ''
        },
        {
          hid: 'og-url',
          property: 'og:url',
          content: this.dialogShow ? `${process.env.BASE_URL}/2020/sponsor/${this.sponsorInfo.sponsor_id}` : `${process.env.BASE_URL}/2020/sponsor`
        },
        {
          hid: 'og-image',
          property: 'og:image',
          content: this.dialogShow ? `${this.sponsorInfo.logo_path}` : `${process.env.BASE_URL}/2020/og-image.png`
        },
        // twitter seo
        {
          hid: 'twitter-site',
          name: 'twitter:site',
          content: this.dialogShow ? `${this.sponsorInfo.name} | 贊助夥伴 MOPCON 2020` : '贊助夥伴 | MOPCON 2020'
        },
        {
          hid: 'twitter-description',
          name: 'twitter:description',
          content: this.dialogShow ? this.sponsorInfo.about_us : ''
        },
        {
          hid: 'twitter-app:name:iphone',
          name: 'twitter:app:name:iphone',
          content: this.dialogShow ? `${this.sponsorInfo.name} | 贊助夥伴 MOPCON 2020` : '贊助夥伴 | MOPCON 2020'
        },
        {
          hid: 'twitter-app:name:ipad',
          name: 'twitter:app:name:ipad',
          content: this.dialogShow ? `${this.sponsorInfo.name} | 贊助夥伴 MOPCON 2020` : '贊助夥伴 | MOPCON 2020'
        }
      ]
    }
  }
}
</script>

<style lang="scss" src="./style.scss" scoped></style>
