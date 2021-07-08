<template>
  <div class="edashboard logo-bg">
    <div v-if="hasNews" class="news" style="height: 152px;">
      <marquee scrollamount="10" align="middle">
        <p class="text-yellow-500">
          {{ newsData.title }}：
        </p>
        <p class="text-white">
          {{ newsData.description }}
        </p>
      </marquee>
    </div>
    <div class="slider sponsor_carrousel">
      <div v-if="boardData.length > 0" ref="mySwiper" v-swiper:mySwiper="swiperOption" class="slider-container" @load="slideChange()">
        <div class="swiper-wrapper">
          <div v-for="(data, index) in boardData" :key="data.data.name" class="swiper-slide" :data-swiper-autoplay="(data.play_time*1000)">
            <div v-if="data.type == 'ad'" v-show="nowActive == index">
              <eboardSponsor :sponsor-data="data.data" :has-news="hasNews" />
            </div>
            <div v-else-if="data.type == 'session'" v-show="nowActive == index">
              <eboardSchedule :schedule-data="data.data" :has-news="hasNews" />
            </div>
            <div v-else-if="data.type == 'map'" v-show="nowActive == index">
              <eboardSite :site-data="data.data" :has-news="hasNews" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { board } from '@/api/url'
import eboardSchedule from '~/components/EboardSchedule'
import eboardSponsor from '~/components/EboardSponsor'
import eboardSite from '~/components/EboardSite'
export default {
  layout: 'dashboard',
  name: 'Edashboard',
  components: {
    eboardSchedule,
    eboardSponsor,
    eboardSite
  },
  // eslint-disable-next-line require-await
  async asyncData ({ params }) {
    try {
      return {
        boardId: params.id
      }
    } catch (error) {
      console.log(error)
    }
  },
  data () {
    const vm = this
    return {
      boardId: '',
      boardType: 'outroom',
      hasNews: false, // 是否有上方的公告
      newsData: {
        title: '',
        description: ''
      },
      nowActive: 0,
      swiperOption: {
        effect: 'slide',
        loop: true,
        autoplay: {
          delay: 1000
        },
        on: {
          slideChange () {
            vm.nowActive = this.realIndex
          }
        }
      },
      boardData: [],
      testTime: 0
    }
  },
  watch: {
    nowActive () {
    }
  },
  updated () {
    if (this.mySwiper) {
      console.log(this.mySwiper)
      this.$nextTick(() => {
        this.mySwiper.loopDestroy()
        this.mySwiper.loopCreate()
      })
    }
  },
  mounted () {
    const vm = this
    this.getBoardData()
    setInterval(function () {
      vm.getBoardData()
    },
    60000)
  },
  created () {
    const vm = this
    if (vm.$route.query.now) {
      vm.testTime = vm.$route.query.now
    }
    if (vm.$route.query.type) {
      vm.boardType = vm.$route.query.type
    }
  },
  methods: {
    getBoardData () {
      const vm = this
      vm.$axios.$get(`${board}${vm.boardId}?type=${vm.boardType}&now=${vm.testTime}`)
        .then(({ success, data, message }) => {
          if (success) {
            vm.boardData = data.content
            if (data.news.length > 0) {
              vm.$nextTick(() => {
                vm.hasNews = true
              })
              vm.newsData = {
                title: data.news[0].title,
                description: data.news[0].description
              }
            } else {
              vm.$nextTick(() => {
                vm.hasNews = false
              })
            }
          }
        })
    }
  }
}
</script>

<style lang="scss" src="./style.scss" scoped></style>
