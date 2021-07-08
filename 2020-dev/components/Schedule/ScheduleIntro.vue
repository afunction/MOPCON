<template>
  <section class="container slogan">
    <div class="slogan-title">
      <h3 class="slogan-title-en">
        Satisfy
      </h3>
      <h1>
        每一場都讓你收穫滿滿的
        <br>
        <span>
          議程規劃
        </span>
      </h1>
      <p class="slogan-content">
        MOPCON 目前已是南台灣最大技術社群研討會，成立宗旨為連結產業與資訊工程技術，以培養更多資訊科技人才，推動高雄產業創新發展，而沒有夥伴們的支持，這個願景就不可能成真！謝謝這 8 年來每一位夥伴的加入，和我們一起凝聚南臺灣的人才和知識，共同成長、學習！
      </p>
    </div>
    <div class="slogan-pic">
      <div class="slogan-pic-container" />
    </div>
  </section>
</template>

<script>
export default {
  name: 'ScheduleIntor'
}
</script>

<style lang="scss" scoped>
// 每一場都讓你收獲滿滿的議程規劃
.slogan {
  @apply text-white flex flex-wrap mb-12 mx-auto;
  @screen lg{
    @apply py-8;
  }
  &-title {
    @apply order-2 w-full;
    @screen xl{
      @apply order-1 w-1/2;
    }
    &-en{
      font-family: 'Poppins', sans-serif;
      font-size:3rem;
      right:0px;
      letter-spacing: 0.125rem;
      opacity: 0.24;
      -webkit-text-stroke: 1px #ffffff;
      color: rgba(255, 255, 255, 0);
      @apply  font-semibold text-center relative;
      @screen lg{
          font-size: 5rem;
          @apply text-center;
      }
      @screen xl{
        right:15px;
        @apply text-left;
      }
    }
    & h1{
      font-size: 1.5rem;
      letter-spacing: 0.2px;
      bottom:40px;
      @apply font-medium relative text-white text-center;
      @screen lg{
        font-size:2rem;
        bottom:55px;
      }
      @screen xl{
        @apply text-left;
      }
      & br{
        @apply block;
        @screen xl{
          @apply hidden;
        }
      }
      & span{
        @apply ml-2 text-yellow-500;
      }
      &:after {
        content: '';
        width: 80px;
        height: 6px;
        bottom:-20px;
        left: calc(50% - 40px);
        @apply bg-yellow-500 absolute;
        @screen xl{
          left:20px;
        }
      }
    }
  }
  &-content {
    line-height: 1.6875rem;
    letter-spacing: 0.2px;
    @apply mx-auto;
    @screen xl{
      width:498px;
      margin-left: 0px;
    }
  }
  &-pic{
    @apply w-full order-1 flex items-center justify-center;
    @screen xl{
      @apply w-1/2 order-2 items-end justify-center;
    }
    &-container{
      background-image: url('~@/assets/schedule/schedule_intro.svg');
      width:289px;
      height:166px;
      @apply my-8 bg-cover bg-center;
      @screen xl{
        width:450px;
        height:259px;
        @apply my-0;
      }
    }
  }
}
</style>
