<template>
  <div id="schedule" class="logo-bg">
    <!--每一場都讓你收獲滿滿的議程規劃-->
    <schedule-intro />

    <!--日期搜尋區-->
    <date-selector :dates="schedules.map(item => item.date)" :active-date.sync="activeDate" />

    <!--標籤搜尋區-->
    <section class="container flex justify-center mb-16 mx-auto">
      <tags :tags="tags" :active-tags="activeTags" :toggle-tag="toggleTag" />
    </section>

    <section class="xl:max-w-screen-xl lg:max-w-screen-lg px-4 lg:px-0 w-full mx-auto mb-24 relative">
      <ul class="floor-list">
        <li><div class="bg-orange-300" />R1(3F)</li>
        <li><div class="bg-blue-300" />R2(4F)</li>
        <li><div class="bg-green-300" />R3(4F)</li>
      </ul>

      <schedule-table
        v-if="!activeTags.length"
        :model="formatted"
        @handle-click="openDialog"
      />
      <ul
        v-else-if="activeTags.length && filterRoom.length"
        class="grid grid-cols-1 lg:grid-cols-3 gap-6 w-4/5 mx-auto"
      >
        <li v-for="(room, roomIdx) in filterRoom" :key="`room-${roomIdx}`" @click="openDialog(room)">
          <schedule-card :room-info="room" />
        </li>
      </ul>
      <div v-else class="text-center text-white w-1/2 mx-auto pt-6">
        <img src="@/assets/schedule/nodata.png" alt="">
        <p class="text-xl mt-16">
          Oops！沒有符合篩選的議程哦！
        </p>
      </div>
    </section>

    <schedule-dialog :visible.sync="dialogShow" :speaker="currentRoom" :toggle-tag="toggleTag" />
    <app-section />
  </div>
</template>

<script>
import AppSection from '@/components/AppSection'
import ScheduleTable from '@/components/Schedule/ScheduleTable'
import ScheduleDialog from '@/components/CommonDialog/ScheduleDialog'
import ScheduleCard from '@/components/Schedule/ScheduleCard'
import ScheduleIntro from '@/components/Schedule/ScheduleIntro'
import DateSelector from '@/components/Schedule/DateSelector'
import Tags from '@/components/Tags'
import { schedule, tags } from '@/api/url'

export default {
  name: 'Schedule',
  components: {
    AppSection,
    ScheduleTable,
    ScheduleDialog,
    ScheduleCard,
    ScheduleIntro,
    DateSelector,
    Tags
  },
  async asyncData ({ $axios, params }) {
    try {
      const { data } = await $axios.get(schedule)
      const res = await $axios.get(tags)

      const config = {
        schedules: data.data,
        tags: res.data.data.map(tag => tag.name),
        activeDate: data.data[0].date
      }
      if (params.schedule_id) {
        const room = await $axios.get(schedule + '/' + params.schedule_id)
        config.currentRoom = room.data.data
        config.dialogShow = true
      }
      return config
    } catch (err) {
    }
  },
  data () {
    return {
      tags: [],
      schedules: [],
      dialogShow: false,
      currentRoom: null,
      activeDate: null,
      activeTags: []
    }
  },
  computed: {
    formatted () {
      return this.schedules
        .find(item => item.date === this.activeDate).period
        .map(item => ({
          isBroadCast: item.isBroadCast,
          timeRange: item.started_at
            ? this.$moment.unix(item.started_at).format('HH:mm') + ' - ' + this.$moment.unix(item.ended_at).format('HH:mm')
            : '',
          event: item.event,
          room: item.room.sort((a, b) => +a.floor[0] - +b.floor[0])
        }))
    },
    filterRoom () {
      return this.formatted
        .reduce((acc, item) => {
          const hasTimeRoom = item.room.map(room => ({
            ...room,
            timeRange: item.timeRange,
            isBroadCast: item.isBroadCast
          }))
          return acc.concat(hasTimeRoom)
        }, [])
        .filter(room => room.tags.some(tag => this.activeTags.includes(tag.name)))
    }
  },
  methods: {
    openDialog (room) {
      this.dialogShow = true
      this.currentRoom = room
    },
    toggleTag (tag) {
      if (Array.isArray(tag)) {
        this.activeTags = tag
      } else {
        !this.activeTags.includes(tag)
          ? this.activeTags.push(tag)
          : this.activeTags.splice(this.activeTags.indexOf(tag), 1)
      }
    }
  },
  head () {
    return {
      title: '主議程 | MOPCON 2020'
    }
  }
}
</script>

<style lang="scss" scoped>
.floor-list {
  top: -40px;
  right: 0;
  @apply text-white flex justify-end absolute;
  li {
    @apply flex items-center mr-3;
  }
  div {
    @apply w-4 h-4 rounded mr-2;
  }
}
</style>
