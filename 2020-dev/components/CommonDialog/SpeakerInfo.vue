<template>
  <section class="info">
    <h2 v-if="!notitle" class="mb-6">
      相關講者資訊
    </h2>
    <ul class="flex flex-col">
      <li
        v-for="speaker in Array.isArray(speakers) ? speakers : [speakers]"
        :key="'speaker' + speaker.speaker_id"
        class="flex items-center pt-3 flex-col md:flex-row text-center md:text-left mb-2"
        :class="{'pb-4': !speakerContactVisible(speaker), 'cursor-pointer': type === 'schedule'}"
        @click="linkToSpeaker(speaker.speaker_id)"
      >
        <div class="flex flex-col items-start">
          <div v-if="speaker.img.web" class="img-wrap">
            <img :src="speaker.img.web" alt="speaker img">
          </div>
          <speaker-contact v-if="speakerContactVisible(speaker)" :links="speaker" />
        </div>
        <div class="text-wrap">
          <h3>{{ speaker.name }}</h3>
          <p>{{ speaker.company }}</p>
          <p>{{ speaker.job_title }}</p>
        </div>
      </li>
    </ul>
    <a v-if="!notitle && sponsorId !== 0" class="mt-4 block" :href="`/2020/sponsor/${sponsorId}`">
      <h2 class="mb-6">
        贊助廠商
      </h2>
      <img :src="sponsorInfo.logo_path" class="logo logo-default" alt="">
    </a>
  </section>
</template>

<script>
import SpeakerContact from './SpeakerContact'

export default {
  name: 'SpeakerInfo',
  components: {
    SpeakerContact
  },
  props: {
    speakers: {
      type: [Object, Array, undefined],
      default: () => {}
    },
    notitle: {
      type: Boolean,
      default: false
    },
    sponsorInfo: {
      type: Object,
      default: () => {}
    },
    sponsorId: {
      type: Number,
      default: 0
    },
    type: {
      type: String,
      default: ''
    }
  },
  data () {
    return {
      imgUrl: ''
    }
  },
  methods: {
    speakerContactVisible (speaker) {
      return Object.entries(speaker).some(([key, value]) => key.startsWith('link_') && value)
    },
    linkToSpeaker (id) {
      if (this.type === 'schedule') { location.href = `/2020/speaker/${id}` }
    }
  }
}
</script>

<style scoped lang="scss">
.info {
  @apply text-white;
  h2 {
    @apply text-lg pl-4 relative mr-4;
    &::before {
      content: '\\\\';
      left: -5px;
      @apply absolute text-yellow-500 text-lg font-medium;
    }
  }
  .img-wrap {
    width: 115px;
    height: 115px;
    border-radius: 16px;
    transform: rotate(45deg);
    flex-shrink: 0;
    @apply border border-white overflow-hidden mb-8;
  }
  img {
    object-fit: cover;
    transform: rotate(-45deg) scale(1.3);
  }
  h3 {
    @apply text-xl mb-3;
  }
  p {
    @apply text-gray-400;
  }
  .text-wrap {
    @apply flex justify-center flex-col mb-auto;
  }
  @screen md {
    .img-wrap {
      @apply mr-16 ml-5 mb-0;
    }
    .text-wrap {
      height: 135px;
    }
  }
  .logo-default {
    width: 72px;
    height: 72px;
    object-fit: cover;
    transform: rotate(0deg) scale(1);
    @apply bg-purple-300 inline-block;
  }
}
</style>
