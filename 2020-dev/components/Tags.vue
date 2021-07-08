<template>
  <ul class="tags-wrap">
    <li
      v-for="(tag, index) in tags"
      :key="`tag-${index}`"
      @click="toggleTag(tag)"
    >
      <button
        class="btn-tag"
        :class="{'active' : activeTags.includes(tag)}"
      >
        <span class="logo logo-check" />
        {{ tag }}
      </button>
    </li>
  </ul>
</template>

<script>
export default {
  name: 'Tags',
  props: {
    tags: {
      type: Array,
      default: () => []
    },
    activeTags: {
      type: Array,
      default: () => []
    },
    toggleTag: {
      type: Function,
      default: () => {}
    }
  }
}
</script>

<style lang="scss" scoped>
// logo
@import '~@/assets/styles/_mix';
$logo_map: (
  svg: speaker-title check,
);
@include logo_map_mix(speaker);

.tags-wrap {
  width: 80%;
  @apply flex flex-wrap mt-8 justify-center;
  li {
    @apply mr-4 mb-4;
    &:last-child {
      @apply mr-0;
    }
  }
  .btn-tag {
    @apply bg-purple-700;
    &:hover {
      opacity: .8;
    }
  }
}
</style>
