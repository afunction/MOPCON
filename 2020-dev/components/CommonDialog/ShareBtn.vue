<template>
  <div class="relative w-full">
    <button class="btn-share" @click.stop="speaker ? $emit('update:btnListShow', !btnListShow) : copylink()">
      <span class="logo logo-share" />
      分享議程
    </button>
    <transition-group name="list-fade" mode="out-in">
      <ul v-if="btnListShow" key="list" class="share-list">
        <li>
          <client-only>
            <ShareNetwork
              :url="shareUrl"
              :title="`${speaker.name} | 講者 MOPCON 2020`"
              :description="speaker.summary"
              :quote="`${speaker.name} | 講者 MOPCON 2020`"
              hashtags="MOPCON"
              network="facebook"
            >
              分享 Facebook
            </ShareNetwork>
          </client-only>
        </li>
        <li>
          <client-only>
            <ShareNetwork
              :url="shareUrl"
              :title="`${speaker.name} | 講者 MOPCON 2020`"
              :description="speaker.summary"
              :quote="`${speaker.name} | 講者 MOPCON 2020`"
              hashtags="MOPCON"
              network="twitter"
            >
              分享 Twitter
            </ShareNetwork>
          </client-only>
        </li>
        <li @click="copylink">
          複製講者連結
        </li>
      </ul>
      <p v-if="copySuccess" key="success" class="copy-success">
        連結複製成功！
      </p>
    </transition-group>
  </div>
</template>

<script>
export default {
  name: 'ShareBtn',
  props: {
    speaker: {
      type: [Object, undefined],
      default: () => {}
    },
    btnListShow: {
      type: Boolean,
      default: false
    },
    shareUrl: {
      type: String,
      default: ''
    }
  },
  data () {
    return {
      copySuccess: false
    }
  },
  methods: {
    copylink () {
      navigator.clipboard.writeText(this.shareUrl).then(() => {
        this.copySuccess = true
        setTimeout(() => {
          this.copySuccess = false
        }, 1000)
      }).catch(() => {})
    }
  }
}
</script>

<style scoped lang="scss">
// logo
@import '~@/assets/styles/_mix';
$logo_map: (
  svg: share,
);
@include logo_map_mix(speaker);

p {
  @apply mt-3 text-gray-400;
}
.share-list {
  bottom: -110px;
  border-radius: 4px;
  @apply py-2 right-0 absolute bg-blue-800 text-gray-400;
  li {
    @apply px-4 py-2 bg-blue-800;
    &:hover {
      filter: brightness(130%);
    }
  }
}
.btn-share {
  border-radius: 8px;
  @apply bg-yellow-500 py-3 w-full mt-8 text-blue-950 text-lg outline-none;
  .logo {
    width: 18px;
    height: 20px;
    transform: translateY(4px);
    @apply mr-1 inline-block;
  }
  &:hover {
    opacity: .9;
  }
}
.copy-success {
  top: -10px;
  @apply absolute inset-x-0 text-center text-sm;
}

.list-fade-enter-active, .list-fade-leave-active {
  transition: opacity .3s;
}
.list-fade-enter, .list-fade-leave-to {
  opacity: 0;
}
</style>
