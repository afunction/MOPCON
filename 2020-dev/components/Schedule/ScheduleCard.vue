<template>
  <div class="card-wrap" :class="[floorColor(roomInfo.room), {'no-hover': noHover}]">
    <ul class="card-header">
      <li
        v-for="(item, idx) in roomInfo.speakers"
        :key="`speaker-img-${idx}`"
        class="flex"
      >
        <div v-if="item.img.web" class="img">
          <img :src="item.img.mobile" alt="speaker_img">
        </div>
        <h3>{{ item.name }}</h3>
      </li>
    </ul>

    <h2>{{ roomInfo.topic }}</h2>

    <div class="text-sm location-wrap" :class="{'notime': !roomInfo.timeRange}">
      <p>
        <span class="logo logo-location" />
        {{ roomInfo.room }}({{ roomInfo.floor }})
      </p>
      <p v-if="roomInfo.timeRange" class="time-range">
        {{ roomInfo.timeRange }}
      </p>
    </div>

    <ul class="tag-wrap">
      <li v-for="(tag, idx) in roomInfo.tags" :key="`tag-${idx}`">
        <button class="btn-tag btn-tag-outline">
          {{ tag.name }}
        </button>
      </li>
    </ul>
    <ul v-if="!noHashTag" class="hashtag-wrap">
      <li v-if="roomInfo.sponsor_id !== 0">
        <a href=""># 夥伴議程</a>
      </li>
      <li v-if="!roomInfo.recordable">
        <a href="#"># 禁止錄影</a>
      </li>
      <li v-if="roomInfo.isBroadCast">
        <a href="#"># Panel</a>
      </li>
      <li v-if="roomInfo.community_partner !== ''">
        <a href="#"># {{ roomInfo.community_partner }}</a>
      </li>
      <li v-if="roomInfo.is_online">
        <a href="#"># 遠距議程</a>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'ScheduleCard',
  props: {
    roomInfo: {
      type: Object,
      default: () => {}
    },
    noHover: {
      type: Boolean,
      default: false
    },
    noHashTag: {
      type: Boolean,
      default: false
    }
  },
  data () {
    return {
    }
  },
  methods: {
    floorColor (floor) {
      switch (floor) {
        case 'R2':
          return 'blue'
        case 'R3':
          return 'green'
        default:
          return 'orange'
      }
    }
  }
}
</script>

<style lang="scss" scoped>
// logo
@import '~@/assets/styles/_mix';
$logo_map: (
  svg: location,
);
@include logo_map_mix(speaker);

.card-wrap {
  background: rgba(255,255,255,0.12);
  border-radius: 8px;
  width: 100%;
  height: 100%;
  @apply text-gray-400 pr-3 pl-5 pb-4 pt-5 relative flex flex-col;
  &::before {
    content: '';
    border-radius: 8px;
    @apply absolute inset-0 border-l-8;
  }
  &.orange::before {
    @apply border-orange-300;
  }
  &.green::before {
    @apply border-green-300;
  }
  &.blue::before {
    @apply border-blue-300;
  }
  &:not(.no-hover) {
    @apply cursor-pointer;
    &:hover::after {
      content: '- Read more -';
      background: rgba(255, 204, 0, 0.7);
      border-radius: 8px;
      @apply absolute inset-0 text-black flex items-center justify-center font-medium;
    }
  }
  @screen xl {
    min-width: 275px;
  }
  @screen lg {
    min-width: 230px;
  }
}
h2 {
  flex: auto;
  @apply text-gray-100 text-lg pt-1 pb-1;
}
.card-header {
  @apply flex flex-col;
  .img {
    transform: rotate(45deg);
    @apply w-6 h-6 bg-indigo-300 rounded-md mr-4 overflow-hidden;
  }
  img {
    transform: rotate(-45deg) scale(1.2);
  }
  li {
    @apply mb-4;
  }
}
.logo {
  width: 20px;
  height: 18px;
  transform: translateY(3px);
  @apply inline-block;
}
.location-wrap {
  top: 19px;
  right: 16px;
  @apply flex items-center pt-3;
  .time-range {
    margin-top: 1px;
    @apply ml-3;
  }
  &.notime {
    @apply absolute pt-0;
  }
}
.tag-wrap, .hashtag-wrap {
  @apply flex flex-wrap pt-2 text-sm mt-auto;
  li {
    @apply mr-2 mt-2;
  }
}
.hashtag-wrap {
  @apply mt-auto;
}
.btn-tag-outline {
  border-radius: 18px;
  padding: 2px 8px;
  @apply border-2 border-purple-700 text-sm outline-none text-purple-400;
}

</style>
