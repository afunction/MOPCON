<template>
  <section class="section sectionPastYears container">
    <h2 class="title">
      歷年 MOPCON
    </h2>

    <div class="swiper">
      <div class="swiper-button-prev" :class="{'opacity-50' : isBeginning}" @click="handleSwiperClick('prev')" />
      <div class="swiper-button-next" :class="{'opacity-50' : isEnd}" @click="handleSwiperClick('next')" />
      <div
        v-swiper:swiper="swiperOption"
        class="swiper-container"
        @reachEnd="reach"
        @reachBeginning="reach"
      >
        <div class="swiper-wrapper">
          <div v-for="year in years" :key="`mopcon-${year}`" class="swiper-slide">
            <a :href="`https://mopcon.org/album.php#mp${year}`" target="_blank" class="swiper-slide__inner">
              <div class="swiper-slide__image logo" :class="`logo-${year}`" />
            </a>
            <p class="swiper-slide__year">
              {{ year }}
            </p>
          </div>
        </div>
      </div>
    </div>

    <button class="btn-primary" @click="location('https://www.youtube.com/watch?v=PbWiavdubKA')">
      <span class="logo logo-play" />
      2019 影片回顧
    </button>
  </section>
</template>

<script>
export default {
  name: 'SectionPastYears',
  data () {
    const [startYear, currentYear] = [2014, new Date().getFullYear()]
    return {
      years: Array.from(Array(currentYear - startYear).keys())
        .map(item => currentYear - (item + 1)),
      swiperOption: {
        slidesPerView: 'auto',
        spaceBetween: 20
      },
      isBeginning: true,
      isEnd: false
    }
  },
  methods: {
    handleSwiperClick (direction) {
      this.swiper[direction === 'next' ? 'slideNext' : 'slidePrev']()
    },
    reach () {
      this.isBeginning = this.swiper.isBeginning
      this.isEnd = this.swiper.isEnd
    },
    location (url) {
      location.href = url
    }
  }
}
</script>

<style lang="scss" scoped>
// logo
@import '~@/assets/styles/_mix';
$logo_map: (
  jpg: 2014 2015 2016 2017 2018 2019 2020,
  svg: play
);
@include logo_map_mix(history);

.sectionPastYears {
  display: flex;
  flex-flow: column nowrap;

  .swiper {
    width: 100%;
    @screen sm {
      padding: 0 50px;
    }
    @apply relative;
    .swiper-container {
      width: 100%;

      .swiper-wrapper {
        .swiper-slide {
          width: 60%;

          @screen md {
            width: 22%;
          }
          @screen sm {
            width: 29%;
          }
          padding-bottom: 50px;

          &__inner {
            display: flex;
            width: 100%;
            height: 300px;
          }

          &__image {
            background-size: cover;
            width: 100%;
            height: 260px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 13px;
          }

          &__year {
            color: #f0f1f2;
            text-align: center;
            bottom: 12px;
            @apply absolute inset-x-0 text-lg;
            @screen sm {
              @apply bottom-0 text-xl;
            }
          }
        }
      }
    }
    .swiper-button-prev,
    .swiper-button-next {
      transform: scale(0.6, 0.9);
      @apply text-yellow-500 hidden;
      @screen sm {
        @apply inline-block;
      }
    }
  }

  & .btn-primary {
    width: 80%;
    @apply mt-6 mx-auto flex items-center justify-center;
    span {
      width: 25px;
      height: 25px;
      @apply inline-block mr-4;
    }
    @screen md {
      @apply px-32;
    }
    @screen sm {
      @apply px-16 w-auto mt-12;
      span {
        width: 36px;
        height: 36px;
      }
    }
  }
}
</style>
