<template>
  <div id="notice" class="logo-bg pb-20 pt-8">
    <section class="container mx-auto flex flex-col items-center mb-6 top overflow-x-hidden">
      <div class="w-full flex justify-end">
        <a class="switch-btn" href="/2020/notice/en"><small>English</small></a>
      </div>
      <div class="logo logo-speaker-title" />
      <div class="relative h-full top">
        <h2 class="relative mt-10 mb-12 md:text-3xl text-2xl text-white text-center z-10">
          <div class="logo logo-circles logo-circles-l" />MOPCON
          <span class="text-yellow-500 md:inline-block block">COVID-19 防疫守則</span>
          <div class="logo logo-circles logo-circles-r" />
        </h2>
      </div>
      <p class="text-white">
        因應 COVID-19 疫情， MOPCON 依據中央流行疫情指揮中心訂定之『 COVID-19 (武漢肺炎) 』因應指引：公眾集會及相關防疫規範，特訂定本處理原則，以供參加活動參考。
      </p>
    </section>
    <section class="container mx-auto notice-content">
      <div class="header-width">
        <h3 class="notice-title">
          \\ 防疫聲明：
        </h3>
        <ol class="list-decimal pl-6">
          <li>
            本活動採實聯制入場，參與者須填寫個人<a class="text-yellow-500" href="https://docs.google.com/forms/d/1ukO8EBA9cTWToWsISWzVjkYGyel7naUv7YAhafJqKDY/viewform?edit_requested=true" target="_blank">
              【 健康聲明書 】
            </a>，於報到時檢核無誤後，領取識別證件，即能參與 MOPCON 2020 大會活動。(如有填寫不實等行為，依傳染病防治法第 62 條，最高可處 50 萬元罰鍰。)
          </li>
          <li>活動期間會場內須全程配戴口罩，因服藥、飲食、補充水份等狀況不在此限，並於服用完畢後立即戴回口罩。</li>
          <li>各議程廳採人數總量管制，請聽從工作人員指示，若會議室已達人數上限請勿進入。</li>
          <li>活動期間會場提供酒精與肥皂，入內時請消毒雙手。</li>
          <li>活動期間配合體溫量測，超過 37.5 ℃ 者將安排前往觀察區，待複測體溫正常後入場，或由工作人員協助安排返家或就醫事宜並協助辦理退票；入場時已有明顯發燒及呼吸道症狀者禁止入場，並不予退還活動票券費用</li>
          <li>落實自我健康狀況監測，倘活動中有發燒、急性呼吸道感染症或腹瀉等相關症狀者，請立即停止參與大會活動並與工作人員通報。</li>
          <li>若有身體不適或具感染風險（居家隔離、居家檢疫、自主健康管理），以及「 65 歲以上者」或「慢性病患」等情形者，為嚴重特殊傳染性肺炎重症高風險族群，應避免參與活動。</li>
          <li>本活動會因應政府對疫情的控制與變化所為的行政行為，而適時調整相關資訊與規範，請您諒解與留意。</li>
        </ol>
        <h3 class="notice-title">
          \\ 大會防疫準備：
        </h3>
        <ol class="list-decimal pl-6">
          <li>活動前後落實公共區域定時清潔與消毒</li>
          <li>參加人員每天量測體溫（含講者、工作人員等）並配戴口罩</li>
          <li>我們將為參加者的報到狀況造冊記錄</li>
          <li>會場提供酒精與肥皂以進行手部消毒</li>
        </ol>
        <h3 class="notice-title">
          \\ 實聯制個資宣告事項：
        </h3>
        <p>
          實聯制因涉及蒐集個人資料情形，為增加整體防疫措施之透明性、提高民眾之信賴，在蒐集民眾個人資料時，應明確告知下列事項：
        </p>
        <ol>
          <li>(一) 蒐集機關： MOPCON</li>
          <li>(二) 蒐集之目的：防疫目的，依據「個人資料保護法之特定目的及個人資料之類別」為代號 012 公共衛生或傳染病防治之特定目的，且不得為目的外利用。</li>
          <li>(三) 蒐集之個人資料項目：姓名、聯絡方式(電話號碼或住址或電子信箱)。</li>
          <li>(四) 個人資料利用之期間：自蒐集日起 28 日內。</li>
          <li>(五) 個人資料利用之對象及方式：為防堵疫情而有必要時，得提供衛生主管機關依傳染病防治法等規定進行疫情調查及聯繫使用。</li>
          <li>(六) 當事人就其個人資料得依個人資料保護法規定，向蒐集之機關行使權利，包括查詢或請求閱覽、請求製給複製本、請求補充或更正、請求蒐集、處理或利用、請求刪除，及行使方式。</li>
          <li>(七) 當事人如不同意提供個人資料，將無法進入本館參觀及參與活動。</li>
        </ol>
        <p>請您與我們一同遵守，保護自己與他人的健康。</p>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'Notice',
  data () {
    return {}
  },
  mounted () {},
  methods: {}
}
</script>
<style lang="scss" scoped>
@import "~@/assets/styles/_mix";
.container {
  @screen md {
    @apply px-32;
  }
  @screen lg {
    @apply px-48;
  }
}
.top h2 {
  @screen md {
    @include border-primary;
  }
}
.notice-title {
  @apply text-xl text-yellow-500 mt-6;
}
.notice-content {
  @apply text-white;
  li, p {
    @apply my-2;
  }
}
.switch-btn {
  @apply text-yellow-500 p-1 px-2 border border-yellow-500 rounded-lg;
  &:hover {
    @apply bg-yellow-500 text-blue-950;
  }
}
</style>
