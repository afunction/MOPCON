<template>
  <div id="schedule" class="logo-bg">
    <!--每一場都讓你收獲滿滿的議程規劃-->
    <schedule-intro />

    <!--日期搜尋區-->
    <date-selector :dates="schedules.map(item => item.date)" :active-date.sync="activeDate" />

    <section class="xl:max-w-screen-xl lg:max-w-screen-lg px-4 lg:px-0 xl:w-10/12 mx-auto mb-24 relative mt-24">
      <schedule-table
        :model="formatted"
        :column="1"
        :no-hover="true"
        :no-hash-tag="true"
      />
    </section>
    <app-section />
  </div>
</template>

<script>
import AppSection from '@/components/AppSection'
import ScheduleTable from '@/components/Schedule/ScheduleTable'
import ScheduleIntro from '@/components/Schedule/ScheduleIntro'
import DateSelector from '@/components/Schedule/DateSelector'
import { scheduleUnconf } from '@/api/url'

export default {
  name: 'ScheduleUnconf',
  components: {
    AppSection,
    ScheduleTable,
    ScheduleIntro,
    DateSelector
  },
  async asyncData ({ $axios, params }) {
    try {
      const { data } = await $axios.get(scheduleUnconf)

      const config = {
        schedules: data.data,
        activeDate: data.data[0].date
      }
      return config
    } catch (err) {}
  },
  data () {
    return {
      schedules: [],
      dialogShow: false,
      activeDate: null
    }
  },
  computed: {
    formatted () {
      return this.schedules
        .find(item => item.date === this.activeDate).period
        .map(item => ({
          timeRange: item.started_at
            ? this.$moment.unix(item.started_at).format('HH:mm') + ' - ' + this.$moment.unix(item.ended_at).format('HH:mm')
            : '',
          event: item.event,
          room: item.room.sort((a, b) => +a.floor[0] - +b.floor[0])
        }))
    }
  },
  head () {
    return {
      title: '交流議程 | MOPCON 2020'
    }
  }
}
</script>
