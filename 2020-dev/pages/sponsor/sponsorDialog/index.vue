<template>
  <div v-if="nowSponsor" class="sponsor-dialog">
    <div class="sponsor-dialog-info">
      <img :src="nowSponsor.logo_path" alt="" width="114">
      <h4>
        {{ nowSponsor.name }}
      </h4>
      <ul class="sponsor-dialog-info-contact">
        <li v-if="nowSponsor.facebook_url">
          <a target="_blank" :href="nowSponsor.facebook_url" class="logo logo-fb" />
        </li>
        <li v-if="nowSponsor.official_website">
          <a target="_blank" :href="nowSponsor.official_website" class="logo logo-web" />
        </li>
      </ul>
    </div>
    <h5 v-if="nowSponsor.about_us !== ''" class="sponsor-dialog-subtitle">
      <span>\\</span> 關於我們
    </h5>
    <p v-html="parseSummary(nowSponsor.about_us)" />
    <div v-if="nowSponsor.speaker_information.length > 0" class="mt-8">
      <h5 class="sponsor-dialog-subtitle">
        <span>\\ </span>相關講者資訊
      </h5>
      <a
        v-for="(sponsorSpeaker, index) in nowSponsor.speaker_information"
        :key="'sponsorSpeaker' + sponsorSpeaker.speaker_id"
        :href="'/2020/speaker/' + sponsorSpeaker.speaker_id"
      >
        <div class="sponsor-dialog-speaker">
          <div class="sponsor-dialog-speaker-img-wrap">
            <img :src="sponsorSpeaker.img.web" alt="">
          </div>
          <div class="sponsor-dialog-speaker-info">
            <h4>
              {{ sponsorSpeaker.name }}
            </h4>
            <p>
              {{ sponsorSpeaker.job_title }}
            </p>
          </div>
          <div class="sponsor-dialog-speaker-place">
            <p class="">
              <span class="material-icons align-middle text-sm">
                event
              </span>
              {{ speakerTimeTrans(sponsorSpeaker.started_at, sponsorSpeaker.endeded_at) }}
            </p>
            <p>
              <span class="material-icons align-middle text-sm">
                location_on
              </span>
              {{ sponsorSpeaker.room }} ({{ sponsorSpeaker.floor }})
            </p>
          </div>
        </div>
        <div
          v-show="nowSponsor.speaker_information.length > 1
            && nowSponsor.speaker_information.length - 1 !== index"
          class="logo logo-hr w-full"
        />
      </a>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    nowSponsor: {
      type: Object,
      default: () => {}
    }
  },
  methods: {
    speakerTimeTrans (start, end) {
      const startDate = this.$moment.unix(start).format('MM/DD')
      const startTime = this.$moment.unix(start).format('HH:mm')
      const endTime = this.$moment.unix(end).format('HH:mm')
      return `${startDate} ${startTime} ~ ${endTime}`
    },
    parseSummary (summary) {
      return summary.replace(/\n/gi, '<br>')
    }
  }
}
</script>

<style lang="scss" src="./style.scss" scoped></style>
