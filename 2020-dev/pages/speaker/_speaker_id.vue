<template>
  <div
    id="speaker"
    class="logo-bg"
  >
    <section class="top container">
      <div class="logo logo-speaker-title" />
      <h2>
        <div class="logo logo-circles logo-circles-l" />
        驅動高速資訊交流圈的 <span>佼佼者們</span>
        <div class="logo logo-circles logo-circles-r" />
      </h2>
      <p>
        每年我們都邀請了超過 25 位講師來到現場，包含知名的前端開發者、軟體工程師、資深架構師、設計師，以及專案經理等等，讓這場活動更加多元，也貫徹 MOPCON 的精神，使參與的會眾都能從中獲得養分，甚至達到近一步的交流。
      </p>
    </section>

    <div class="container">
      <div class="logo logo-hr" />
    </div>

    <section class="content container">
      <h2>開箱 <span>高手陣容</span></h2>

      <tags :tags="tags" :active-tags="activeTags" :toggle-tag="toggleTag" />

      <ul v-if="speakers.length" class="speaker-list">
        <li
          v-for="speaker in formatSpeakers"
          :key="speaker.speaker_id"
          @click="handleSpeakerClick(speaker.speaker_id)"
        >
          <div class="speaker-img-wrap">
            <img :src="speaker.img.web" alt="">
          </div>
          <h3>{{ speaker.name }}</h3>
          <p>{{ speaker.company }}</p>
          <div class="speaker-btn-wrap">
            <button
              v-for="(tag, idx) in speaker.tags"
              :key="`tags-${idx}`"
              class="btn-tag btn-tag-outline"
            >
              {{ tag.name }}
            </button>
          </div>
        </li>
      </ul>
    </section>
    <app-section />
    <speaker-dialog :visible.sync="dialogShow" :speaker="CurrentSpeaker" :toggle-tag="toggleTag" />
  </div>
</template>

<script>
import { speaker, tags } from '@/api/url'
import AppSection from '@/components/AppSection'
import SpeakerDialog from '@/components/CommonDialog/SpeakerDialog'
import Tags from '@/components/Tags'

export default {
  name: 'Speaker',
  components: {
    SpeakerDialog,
    AppSection,
    Tags
  },
  async asyncData ({ $axios, params }) {
    try {
      const { data } = await $axios.get(speaker)
      const res = await $axios.get(tags)

      const config = {
        speakers: data.data,
        tags: res.data.data.map(tag => tag.name)
      }
      if (params.speaker_id) {
        config.activeSpeaker = +params.speaker_id
        config.dialogShow = true
      }
      return config
    } catch (err) {}
  },
  data () {
    return {
      activeTags: [],
      dialogShow: false,
      speakers: [],
      folded: true,
      activeSpeaker: 0,
      tags: []
    }
  },
  computed: {
    formatSpeakers () {
      let formatArr = this.speakers
      if (this.activeTags.length) {
        formatArr = formatArr.filter(speaker => speaker.tags.some(tag => this.activeTags.includes(tag.name)))
      }
      return formatArr
    },
    CurrentSpeaker () {
      return this.speakers.find(speaker => speaker.speaker_id === this.activeSpeaker)
    }
  },
  methods: {
    toggleTag (tag) {
      if (Array.isArray(tag)) {
        this.activeTags = tag
      } else {
        !this.activeTags.includes(tag)
          ? this.activeTags.push(tag)
          : this.activeTags.splice(this.activeTags.indexOf(tag), 1)
      }
    },
    handleSpeakerClick (id) {
      this.activeSpeaker = id
      this.dialogShow = true
    }
  },
  head () {
    return {
      title: this.dialogShow ? `${this.CurrentSpeaker.name} | 講者 MOPCON 2020` : '講者陣容 | MOPCON 2020',
      meta: [
        {
          hid: 'description',
          name: 'description',
          content: this.dialogShow ? this.CurrentSpeaker.summary : ''
        },
        // fb
        {
          hid: 'og-title',
          property: 'og:title',
          content: this.dialogShow ? `${this.CurrentSpeaker.name} | 講者 MOPCON 2020` : '講者陣容 | MOPCON 2020'
        },
        {
          hid: 'og-description',
          property: 'og:description',
          content: this.dialogShow ? this.CurrentSpeaker.summary : ''
        },
        {
          hid: 'og-url',
          property: 'og:url',
          content: this.dialogShow ? `${process.env.BASE_URL}/2020/speaker/${this.CurrentSpeaker.speaker_id}` : `${process.env.BASE_URL}/2020/speaker`
        },
        {
          hid: 'og-image',
          property: 'og:image',
          content: this.dialogShow ? `${this.CurrentSpeaker.img.web}` : `${process.env.BASE_URL}/2020/og-image.png`
        },
        // twitter seo
        {
          hid: 'twitter-site',
          name: 'twitter:site',
          content: this.dialogShow ? `${this.CurrentSpeaker.name} | 講者 MOPCON 2020` : '講者陣容 | MOPCON 2020'
        },
        {
          hid: 'twitter-description',
          name: 'twitter:description',
          content: this.dialogShow ? this.CurrentSpeaker.summary : ''
        },
        {
          hid: 'twitter-app:name:iphone',
          name: 'twitter:app:name:iphone',
          content: this.dialogShow ? `${this.CurrentSpeaker.name} | 講者 MOPCON 2020` : '講者陣容 | MOPCON 2020'
        },
        {
          hid: 'twitter-app:name:ipad',
          name: 'twitter:app:name:ipad',
          content: this.dialogShow ? `${this.CurrentSpeaker.name} | 講者 MOPCON 2020` : '講者陣容 | MOPCON 2020'
        }
      ]
    }
  }
}
</script>

<style lang="scss" scoped>
// logo
@import '~@/assets/styles/_mix';
$logo_map: (
  svg: speaker-title,
);
@include logo_map_mix(speaker);

#speaker {
  @apply text-white;
}
.container {
  margin: 0 auto;
}
::v-deep > section {
  @apply mx-auto overflow-x-hidden pt-10 pb-12;
  > h2 {
    @apply text-2xl;
  }
  @screen md {
    @apply pt-16 pb-20;
    > h2 {
      @apply text-4xl;
    }
  }
  @screen sm {
    > h2 {
      @apply text-3xl;
    }
  }
}

// section
.top {
  @apply flex flex-col justify-center items-center;
  .logo-speaker-title {
    width: 100%;
    height: 250px;
    margin: 0 auto;
  }
  h2 {
    @apply relative mt-16 mb-20 text-center;
    span {
      @apply text-yellow-500 block;
    }
  }
  p {
    width: 90%;
  }
  .logo-circles {
    width: 60px;
    height: 20px;
    &-l {
      left: -25px;
      top: -25px;
    }
    &-r {
      right: -25px;
      bottom: -14px;
    }
  }
  @screen sm {
    p {
      width: 80%;
    }
  }
  @screen md {
    .logo-speaker-title {
      width: 436px;
      height: 279px;
    }
    p {
      width: 65%;
    }
    h2 {
      @include border-primary;
      span {
        @apply inline-block;
      }
    }
    .logo-circles {
      width: 60px;
      height: 10px;
      &-l {
        left: -60px;
        top: -25px;
      }
      &-r {
        right: -75px;
        bottom: -14px;
      }
    }
  }
}

.content {
  @apply flex flex-col justify-center items-center;
  h2 {
    span {
      @apply text-yellow-500;
    }
  }
  .speaker-list {
    width: 90%;
    @apply flex justify-start px-4 flex-col;
    li {
      @apply flex flex-col items-center pt-10 cursor-pointer;
      &:hover {
        .speaker-img-wrap {
          &::before {
            content: '';
            border-radius: 40px;
            opacity: .7;
            @apply absolute top-0 left-0 w-full h-full z-10 bg-yellow-500;
          }
          &::after {
            content: '- Read more -';
            transform: rotate(-45deg);
            @apply absolute inset-0 text-blue-950 w-full h-full flex items-center justify-center
            font-medium z-10;
          }
        }
      }
    }
    .speaker-img-wrap {
      width: 140px;
      height: 140px;
      transform: rotate(45deg);
      border-radius: 40px;
      @apply border-2 border-white mb-5 relative overflow-hidden;
      img {
        object-fit: cover;
        transform: rotate(-45deg) scale(1.2);
      }
    }
    h3 {
      @apply text-xl relative mb-5 mt-2;
      &::after {
        content: '';
        bottom: -10px;
        height: 4px;
        @apply absolute inset-x-0 mx-auto bg-yellow-500;
      }
    }
    p {
      color: rgba(242, 242, 247, 0.72);
      min-height: 21px;
      @apply text-sm;
    }
    .speaker-btn-wrap {
      @apply flex justify-center flex-wrap;
      .btn-tag-outline {
        @apply mr-2 mt-2;
      }
    }
  }
  @screen md {
    .speaker-list {
      @apply flex-row flex-wrap mt-16;
      li {
        width: 33.33333%;
        @apply mb-6 pb-6;
      }
    }
  }
  @screen xl {
    .speaker-list {
      @apply px-16;
    }
  }
}
</style>
