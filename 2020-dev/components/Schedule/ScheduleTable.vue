<template>
  <ul class="schedule-table">
    <li v-for="(item, idx) in model" :key="`schedule-${idx}`">
      <p class="schedule-time pt-10 pb-4 lg:py-0">
        {{ item.timeRange }}
      </p>
      <h2 v-if="item.event" class="schedule-evt">
        {{ item.event }}
      </h2>
      <ul
        v-else
        class="room-wrap"
        :class="`lg:grid-cols-${column}`"
      >
        <li
          v-for="(room, roomIdx) in item.room"
          :key="`room-${roomIdx}`"
          :class="{'lg:col-start-2': room.room == 'R2','lg:col-start-3': room.room == 'R3'}"
          @click="$emit('handle-click', room)"
        >
          <schedule-card :room-info="room" :no-hover="noHover" :no-hash-tag="noHashTag" />
        </li>
      </ul>
    </li>
  </ul>
</template>

<script>
import ScheduleCard from './ScheduleCard'

export default {
  name: 'ScheduleTable',
  components: {
    ScheduleCard
  },
  props: {
    model: {
      type: Array,
      default: () => []
    },
    column: {
      type: Number,
      default: 3
    },
    noHover: {
      type: Boolean,
      default: false
    },
    noHashTag: {
      type: Boolean,
      default: false
    }
  }
}
</script>

<style lang="scss" scoped>
.test {
  min-height: 80vh;
  background-image: url('~@/assets/community/bg.png');
  background-size: 115px 100px;
}

.schedule-table {
  @apply text-white;
  > li {
    @apply flex flex-col;
    > * {
      border: 1px solid #3d4b63;
      width: 100%;
      @apply bg-blue-950;
    }
    @screen lg {
      @apply flex-row;
      > * {
        width: calc(100% - 180px)
      }
      &:not(:first-child) > * {
        border-top: none;
      }
    }
  }
  .schedule-evt {
    @apply text-xl font-medium text-white py-4 text-center;
  }
  .room-wrap {
    @apply py-3 px-5 grid gap-3;
  }
  .schedule-time {
    width: 100%;
    color: rgba(255, 255, 255, 0.6);
    letter-spacing: .5px;
    @apply border-none bg-transparent flex items-center font-medium text-xl;
    @screen lg {
      width: 180px;
      @apply justify-center;
    }
  }
}
</style>
