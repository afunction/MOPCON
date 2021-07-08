<template>
  <div>
    <div id="myModal" class="modal fade">
      <div class="modal-content">
        <div class="clearfix">
          <span class="close" @click="close()">&times;</span>
        </div>
        <slot />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Modal',
  props: {
    modalOpen: Boolean
  },
  data () {
    return {
      show: this.modalOpen
    }
  },
  watch: {
    modalOpen (show) {
      this.modalChange(show)
      this.show = show
    },
    show (show) {
      this.$emit('modal-close', show)
    }
  },
  mounted () {
    const vm = this
    window.onclick = function (event) {
      const modal = document.getElementById('myModal')
      if (event.target === modal) {
        vm.close()
        vm.modalChange()
      }
    }
  },
  methods: {
    close () {
      this.show = false
    },
    modalChange (status = false) {
      const body = document.querySelector('body')
      const modal = document.getElementById('myModal')
      if (status) {
        body.classList.add('modal-open')
        modal.style.display = 'block'
        setTimeout(function () {
          modal.classList.add('show')
        }, 5)
      } else {
        modal.style.display = 'none'
        modal.classList.remove('show')
        body.classList.remove('modal-open')
      }
    }
  }
}
</script>

<style lang="scss" src="./style.scss" scoped></style>
