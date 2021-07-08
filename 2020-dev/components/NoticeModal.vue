<template>
  <Dialog :visible="dialogShow" class="w-full" @close="closeModal">
    <div slot="body">
      <h2 class="text-yellow-500 text-2xl text-center mb-6">
        MOPCON 2020 入場須知<span class="md:inline-block hidden">｜</span><br class="md:hidden block">防疫從你我做起
      </h2>
      <div class="text-white text-lg leading-8">
        因應「COVID-19」疫情，入場前有幾點注意事項，還請參與的會眾詳閱以下內容，並請配合工作人員的指示。<br>
        <ol class="list-decimal pl-6">
          <li>
            本活動採實聯制入場，參與者須填寫個人健康聲明書，於報到時檢核無誤後，即能參與 MOPCON 2020 大會活動。<br>
            <a class="text-yellow-500" href="https://docs.google.com/forms/d/1ukO8EBA9cTWToWsISWzVjkYGyel7naUv7YAhafJqKDY/viewform?edit_requested=true" target="_blank">
              【 填寫健康聲明書 】
            </a>
          </li>
          <li>活動期間會場內須全程配戴口罩，配合體溫量測(超過 37.5 ℃ 不得入場)、酒精消毒。</li>
          <li>如有呼吸道不適、居家隔離、嚴重特殊傳染性肺炎重症高風險族群，應避免參與活動。</li>
        </ol>
        更多詳細請閱讀<a class="text-yellow-500" href="#" @click.prevent="toPage">【MOPCON COVID-19 防疫守則】</a>
      </div>
    </div>
  </Dialog>
</template>

<script>
import Dialog from '@/components/Dialog'
export default {
  components: {
    Dialog
  },
  data () {
    return {
      dialogShow: false
    }
  },
  mounted () {
    this.dialogShow = this.$cookies.get('covid19Modal') ? !this.$cookies.get('covid19Modal') === 'already-seen' : false
  },
  methods: {
    setCloseCookie () {
      const expireDays = process.env.covid_cookie_expire
      this.$cookies.set('covid19Modal', 'already-seen', {
        path: '/',
        maxAge: 60 * 60 * 24 * expireDays
      })
    },
    closeModal () {
      this.dialogShow = false
      this.setCloseCookie()
    },
    toPage () {
      this.dialogShow = false
      location.href = '/2020/notice'
      this.setCloseCookie()
    }
  }
}
</script>

<style lang="scss" scoped>
::v-deep .dialog {
  width: 90%;
  @screen lg {
    width: 70%;
  }
  @screen xl {
    width: 60%;
  }
}
::v-deep .dialog-wrap {
  z-index: 100;
}
</style>
