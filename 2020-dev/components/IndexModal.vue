<template>
  <Dialog :visible="dialogShow" class="w-full" @close="closeModal">
    <div slot="body">
      <div class="logo-box">
        <div class="logo logo-mopcon" />
      </div>
      <h3 class="title">
        2021 線上研討會 <br class="md-show">講者募集中
      </h3>
      <p class="subtitle">
        6/15 - 7/15
      </p>
      <div class="btn-group">
        <a target="_blank" href="https://www.accupass.com/event/2106151141012050302398" class="btn">來去投稿</a>
        <a target="_blank" href="https://www.accupass.com/event/2106151141116052481170" class="btn">推薦講者</a>
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
    this.dialogShow = this.$cookies.get('m_notice') ? !this.$cookies.get('m_notice') === 'already-seen' : true
  },
  methods: {
    setCloseCookie () {
      this.$cookies.set('m_notice', 'already-seen', {
        path: '/',
        maxAge: 60 * 60 * 2
      })
    },
    closeModal () {
      this.dialogShow = false
      this.setCloseCookie()
    },
    toPage () {
      this.dialogShow = false
      this.setCloseCookie()
    }
  }
}
</script>

<style lang="scss" scoped>
@import '~@/assets/styles/_mix';
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
$logo_map: (
  svg: mopcon
);
@include logo_map_mix(base);
.logo-box {
  .logo-mopcon {
    width: 80%;
    height: 80px;
    margin: auto;
  }
   @screen md {
    .logo-mopcon {
      width: 750px;
      height: 360px;
    }
  }
  @screen sm {
    .logo-mopcon {
      width: 50%;
      height: 100px;
    }
  }
}
.title {
  @apply text-white text-center;
  font-size: 2rem;
  @screen md {
    @apply mt-5;
  }
}
.subtitle {
  @apply text-yellow-500 text-center mt-3;
  font-size: 2rem;
}
.md-show {
  display: block;
  @screen md {
    display: none;
  }
}
.btn-group {
  @apply flex;
  .btn {
    &:not(:last-child) {
      @apply mr-3;
    }
    border-radius: 8px;
    @apply block text-center bg-yellow-500 py-3 w-full mt-8 text-blue-950 text-lg outline-none;
    &:hover {
      opacity: .9;
    }
  }
}
</style>
