<template>
  <Dialog
    v-if="speaker"
    :visible="visible"
    @close="$emit('update:visible', false)"
    @click.native="btnListShow && (btnListShow = false)"
  >
    <div slot="body" class="dialog-body">
      <speaker-topic
        :speaker="speaker"
        notitle
        class="-mt-4 md:mt-0"
        @handle-tag-click="toggleTag($event); $emit('update:visible', false);"
      />

      <speaker-info
        :speakers="speaker.speakers"
        :sponsor-id="speaker.sponsor_id"
        :sponsor-info="speaker.sponsor_info"
        class="mt-8 mb-4"
        type="schedule"
      />

      <section v-if="speaker.community_partner !== ''" class="mt-5 info">
        <h2>合作社群</h2>
        <h4 class="text-white text-xl mt-5 font-bold">
          {{ speaker.community_partner }}
        </h4>
      </section>
    </div>
    <div slot="footer">
      <div class="flex">
        <a v-if="speaker && speaker.link_slide" class="btn-ppt mr-4 text-center" :href="speaker? speaker.link_slide: '#'" target="_blank">簡報連結</a>
        <share-btn :btn-list-show.sync="btnListShow" :share-url="shareUrl" />
      </div>
    </div>
  </Dialog>
</template>

<script>
import Dialog from '@/components/Dialog'
import SpeakerInfo from './SpeakerInfo'
import SpeakerTopic from './SpeakerTopic'
import ShareBtn from './ShareBtn'

export default {
  name: 'ScheduleDialog',
  components: {
    Dialog,
    SpeakerInfo,
    SpeakerTopic,
    ShareBtn
  },
  props: {
    visible: {
      type: Boolean,
      default: false
    },
    speaker: {
      type: [Object, undefined],
      default: () => {}
    },
    toggleTag: {
      type: Function,
      default: () => {}
    }
  },
  data () {
    return {
      btnListShow: false,
      copySuccess: false
    }
  },
  computed: {
    shareUrl () {
      return process.client ? `${window.location.origin}/2020/schedule/${this.speaker.session_id}` : ''
    }
  },
  methods: {
    parseSummary (summary) {
      return summary.replace(/\n/gi, '<br>')
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
}
</style>
