<template>
  <transition name="dialog-fade">
    <div
      v-show="visible"
      ref="dialogWrap"
      class="dialog-wrap"
      @click.self="hide"
    >
      <div class="dialog">
        <div class="dialog-header">
          <h2 slot="title" />
          <span
            class="logo logo-close"
            @click.self="hide"
          />
        </div>

        <div class="dialog-body">
          <slot name="body" />
        </div>

        <div class="dialog-footer">
          <slot name="footer" />
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  name: 'Dialog',
  props: {
    visible: {
      type: Boolean,
      default: false
    }
  },
  data () {
    return {
    }
  },
  watch: {
    visible: {
      handler (val) {
        if (process.client) {
          document.documentElement.style.overflow = val ? 'hidden' : 'auto'
          if (val && this.$refs.dialogWrap) {
            this.$nextTick(() => {
              this.$refs.dialogWrap.scrollTop = 0
            })
          }
        }
      },
      immediate: true
    }
  },
  methods: {
    hide (cancel) {
      if (cancel !== false) {
        this.$emit('update:visible', false)
        this.$emit('close')
      }
    }
  }
}
</script>

<style lang="scss" scoped>
// logo
@import '~@/assets/styles/_mix';
$logo_map: (
  svg: close,
);
@include logo_map_mix(speaker);

.dialog-wrap {
  background: rgba(#000, 0.4);
  @apply fixed inset-0 z-50 flex justify-center items-start overflow-scroll pb-16 pt-32;
}

.logo-close {
  @apply cursor-pointer;
}

.dialog {
  max-width: 100%;
  border-radius: 12px;
  @apply border-2 border-yellow-500 bg-blue-950 relative pt-10 pb-10 px-6;
  &-header {
    .logo-close {
      width: 32px;
      height: 32px;
      top: -45px;
      right: 16px;
      @apply inline-block absolute;
    }
  }
  @screen md {
    max-width: 85%;
    @apply px-12 py-10;
  }
}

.dialog-fade-enter-active {
  animation: dialog-fade-in .3s;
}
.dialog-fade-leave-active {
  animation: dialog-fade-out .3s;
}
@keyframes dialog-fade-in {
  0% {
    transform: translate3d(0, -20px, 0);
    opacity: 0;
  }
  100% {
    transform: translate3d(0, 0, 0);
    opacity: 1;
  }
}
@keyframes dialog-fade-out {
  0% {
    transform: translate3d(0, 0, 0);
    opacity: 1;
  }
  100% {
    transform: translate3d(0, -20px, 0);
    opacity: 0;
  }
}
</style>
