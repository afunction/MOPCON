<template>
  <section class="topic">
    <div class="flex items-center">
      <h2 v-if="!notitle">
        議程主題
      </h2>
      <ul class="tags-wrap">
        <li
          v-for="(tag, index) in speaker.tags"
          :key="`tag-${index}`"
          @click="$emit('handle-tag-click', [tag.name])"
        >
          <button class="btn-tag btn-tag-outline">
            {{ tag.name }}
          </button>
        </li>
      </ul>
    </div>
    <h3>{{ speaker.topic }}</h3>
    <div class="topic-info">
      <p v-if="speaker.started_at !== ''">
        <span class="logo logo-calendar" />
        {{ $moment(speaker.started_at * 1000).format('MM/DD HH:mm') }}
        ~
        {{ $moment(speaker.ended_at * 1000).format('HH:mm') }}
      </p>
      <p v-if="speaker.floor !== ''">
        <span class="logo logo-location" />
        {{ speaker.room }}({{ speaker.floor }})
      </p>
    </div>
    <!-- eslint-disable-next-line vue/no-v-html -->
    <p class="mt-3" v-html="parseSummary(speaker.summary)" />
  </section>
</template>

<script>
export default {
  name: 'SpeakerTopic',
  props: {
    speaker: {
      type: [Object, undefined],
      default: () => {}
    },
    notitle: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    parseSummary (summary) {
      return summary.replace(/\n/gi, '<br>')
    }
  }
}
</script>

<style scoped lang="scss">
// logo
@import '~@/assets/styles/_mix';
$logo_map: (
  svg: calendar location,
);
@include logo_map_mix(speaker);

.topic {
  @apply text-white;
  .btn-tag-outline {
    @apply text-sm text-purple-400;
  }
  .tags-wrap {
    @apply flex flex-wrap -mt-2;
    li {
      @apply mr-2 mt-2;
    }
  }
  h2 {
    min-width: 100px;
    @apply text-lg pl-4 relative mr-4;
    &::before {
      content: '\\\\';
      left: -5px;
      @apply absolute text-yellow-500 text-lg font-medium;
    }
  }
  h3 {
    letter-spacing: .5px;
    @apply text-2xl mt-3 font-bold;
  }
  p {
    @apply mr-4 mt-2 text-gray-400;
  }
  &-info {
    @apply flex;
    .logo {
      height: 18px;
      width: 16px;
      transform: translateY(3px);
      @apply mr-1 inline-block;
    }
  }
  @screen md {
    .tags-wrap {
      li {
        @apply mr-4;
      }
    }
  }
}
</style>
