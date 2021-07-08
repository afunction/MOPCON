<template>
  <div class="sponsor">
    <div class="sponsor__banner"></div>
    <div class="section">
      <img class="coin" src="./images/coin.png" alt="">
      <h2 class="title"><span>{ 我們感謝</span><span class="color-primary"><br class="break">過往支持 MOPCON 的贊助商</span><span>;
          }</span></h2>
      <p class="intro">MOPCON 目前已是南台灣最大技術社群研討會，成立宗旨為<span
          class="color-secondary">連結產業與資訊工程技術，以培養更多資訊科技人才，推動高雄產業創新發展</span>，而沒有夥伴們的支持，這個願景就不可能成真！謝謝這 7
        年來每一位夥伴的加入，和我們一起凝聚南臺灣的人才和知識，共同成長、學習！</p>
      <div class="slider sponsor_carrousel">
        <div class="slider-navigation">
          <div class="swiper-button-prev" slot="button-prev"></div>
          <div class="swiper-button-next" slot="button-next"></div>
        </div>
        <div v-swiper:mySwiper="swiperOption" class="slider-container">
          <div class="swiper-wrapper">
            <div class="swiper-slide" v-for="n in 9" :style="`background-image: url(${require(`./images/sponsor_carrousel/sponsor_carrousel_${n}.png`)})`"></div>
          </div>
        </div>
      </div>
      <SectionWantToJoin />
      <SectionReward />
      <SectionPartner />
      <SectionSponsor />
    </div>
  </div>
</template>

<script>
  import SectionWantToJoin from './SectionWantToJoin';
  import SectionReward from './SectionReward';
  import SectionPartner from './SectionPartner';
  import SectionSponsor from './SectionSponsor';

  export default {
    name: 'sponsor',
    components: {
      SectionWantToJoin,
      SectionReward,
      SectionPartner,
      SectionSponsor,
    },
    data() {
      return {
        swiperOption: {
          effect: 'coverflow',
          grabCursor: true,
          loop: true,
          centeredSlides: true,
          slidesPerView: 'auto',
          coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
          }
        }
      }
    }
  };
</script>

<style lang="scss" src="./style.scss" scoped></style>