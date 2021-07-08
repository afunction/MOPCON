<template>
  <div>
    <div class="sponsor-card-head">
      <a href="#" class="sponsor-card-head-hover" @click.prevent="openModal(sponsorData.sponsor_id)">
        - Read more -
      </a>
      <div class="sponsor-card-pic" :style="{ 'background-image': 'url(' + sponsorData.logo_path + ')' }" />
    </div>
    <div class="sponsor-card-text">
      {{ sponsorData.name }}
    </div>
  </div>
</template>

<script>

export default {
  props: {
    sponsorData: {
      type: Object,
      default () {
        return {}
      }
    }
  },
  methods: {
    openModal (sponsorId) {
      this.$emit('modalOpen', { open: true, id: sponsorId })
    }
  }
}
</script>

<style lang="scss" src="./style.scss" scoped></style>
