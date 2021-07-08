<template>
  <div class="eboardSite">
    <img src="./images/bg.png" width="770" alt="" class="bg-circle-1">
    <img src="./images/bg-r.png" width="354" alt="" class="bg-circle-2">
    <div class="site__info" :class="{'hasNewsheight': hasNews}">
      <div class="area">
        <div class="site__info__title">
          <p class="title">
            {{ siteData.title }}
          </p>
          <span class="line" />
          <p class="text-yellow-500">
            {{ siteData.subtitle }}
          </p>
        </div>
        <div class="site__info__img">
          <img :src="siteData.map" alt="">
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'EboardSite',
  props: {
    siteData: {
      type: Object,
      default: () => {}
    },
    hasNews: {
      type: Boolean
    }
  },
  data () {
    return {
    }
  },
  watch: {
    hasNews () {
      console.log(this)
    }
  }
}
</script>

<style lang="scss" src="./style.scss" scoped></style>
