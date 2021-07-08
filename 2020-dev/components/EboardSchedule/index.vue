<template>
  <!-- 判斷：講者 1 個以上加上 .hasMany-animate  -->
  <div
    class="eboardSchedule"
    :class="{'hasMany-animate': scheduleData.room.sidecar.length > 1, 'hasNewsheight': hasNews}"
  >
    <div class="mainSchedule">
      <div class="main text-white">
        <p class="type-title" :class="scheduleData.title_class">
          {{ scheduleData.title }}
        </p>
        <div class="text-opacity">
          <p class="delay animated slideInLeft fadeIn" :class="scheduleData.title_class">
            {{ fullTime(scheduleData.room.main.started_at, scheduleData.room.main.ended_at) }}
          </p>
        </div>
      </div>
      <div class="schedule__info">
        <p class="delay-7 animated slideInUp tag text-yellow-500">
          {{ scheduleData.room.main.room }} (
          {{ scheduleData.room.main.floor }} )
        </p>
        <p
          v-for="tag in scheduleData.room.main.tags"
          :key="tag"
          class="delay-7 animated slideInUp tag"
          :class="tag.class_name"
        >
          {{ tag.name }}
        </p>
      </div>
      <div class="schedule__topic">
        <p v-if="scheduleData.room.main.topic.length < 16" class="delay-8 animated slideInUp topic">
          {{ scheduleData.room.main.topic }}
        </p>
        <p v-else class="delay-8 animated slideInUp topic-sm">
          {{ scheduleData.room.main.topic }}
        </p>
      </div>
      <div v-if="scheduleData.room.main.speakers > 1" class="schedule__speaker">
        <div v-if="speaker in scheduleData.room.main.speakers" class="delay-9 animated slideInUp">
          <img :src="speaker.img.mobile" alt="" width="140" height="140" class="speaker__pic">
        </div>
      </div>
      <div v-else class="schedule__speaker">
        <div class="delay-9 animated slideInUp">
          <img
            :src="scheduleData.room.main.speakers[0].img.mobile"
            alt=""
            width="140"
            height="140"
            class="speaker__pic"
          >
        </div>
        <div class="delay-9 animated slideInUp speaker__intro">
          <p class="speaker__name">
            {{ scheduleData.room.main.speakers[0].name }}
          </p>
          <p class="speaker__job">
            {{ scheduleData.room.main.speakers[0].company }}
            {{ scheduleData.room.main.speakers[0].job_title }}
          </p>
        </div>
      </div>
    </div>
    <!-- 單一議程裝飾 -->
    <div v-if="scheduleData.room.sidecar.length == 0" class="otherSchedule" style="max-width: 400px; height: 100%;">
      <img src="./images/single-speaker.png" alt="" height="160%" class="rotateAnimate" style="margin: -60%;">
    </div>
    <!-- 多議程顯示 -->
    <div v-if="scheduleData.room.sidecar.length > 0" class="otherSchedule">
      <div class="delay-10 animated slideInRight">
        <div class="schedule__info">
          <p class="tag text-yellow-500">
            {{ scheduleData.room.sidecar[0].room }}
            ({{ scheduleData.room.sidecar[0].floor }})
          </p>
          <p
            v-for="tag in scheduleData.room.sidecar[0].tags"
            :key="'mutipel' + tag"
            class="tag tag-badge-outline-third"
            :class="tag.class_name"
          >
            {{ tag.name }}
          </p>
        </div>
        <div class="schedule__topic">
          <p class="topic">
            {{ scheduleData.room.sidecar[0].topic }}
          </p>
        </div>
        <div v-if="scheduleData.room.sidecar[0].speakers.length > 1" class="schedule__speaker">
          <div v-for="speaker in scheduleData.room.sidecar[0].speakers" :key="speaker.id" class="animated slideInUp">
            <img :src="speaker.img.mobile" alt="" width="80" height="80" class="speaker__pic">
          </div>
        </div>
        <div v-else class="schedule__speaker">
          <div class="animated slideInUp">
            <img
              :src="scheduleData.room.sidecar[0].speakers[0].img.mobile"
              alt=""
              width="80"
              height="80"
              class="speaker__pic"
            >
          </div>
          <div class="speaker__intro">
            <p class="speaker__name">
              {{ scheduleData.room.sidecar[0].speakers[0].name }}
            </p>
            <p class="speaker__job">
              {{ scheduleData.room.sidecar[0].speakers[0].company }}
              {{ scheduleData.room.sidecar[0].speakers[0].job_title }}
            </p>
          </div>
        </div>
      </div>
      <!-- 判斷 第三個 -->
      <div v-if="scheduleData.room.sidecar.length > 1" class="delay-11 animated slideInRight third-schedule">
        <div class="schedule__info">
          <p class="tag text-yellow-500">
            {{ scheduleData.room.sidecar[1].room }}
            ({{ scheduleData.room.sidecar[1].floor }})
          </p>
          <p
            v-for="tag in scheduleData.room.sidecar[1].tags"
            :key="'third' + tag"
            class="tag tag-badge-outline-third"
            :class="tag.class_name"
          >
            {{ tag.name }}
          </p>
        </div>
        <div class="schedule__topic">
          <p class="topic">
            {{ scheduleData.room.sidecar[1].topic }}
          </p>
        </div>
        <div v-if="scheduleData.room.sidecar[1].speakers.length > 1" class="schedule__speaker">
          <div v-for="speaker in scheduleData.room.sidecar[1].speakers" :key="'schedule_speaker' + speaker.id" class="animated slideInUp">
            <img :src="speaker.img.mobile" alt="" width="80" height="80" class="speaker__pic">
          </div>
        </div>
        <div v-else class="schedule__speaker">
          <div class="animated slideInUp">
            <img
              :src="scheduleData.room.sidecar[1].speakers[0].img.mobile"
              alt=""
              width="80"
              height="80"
              class="speaker__pic"
            >
          </div>
          <div class="speaker__intro">
            <p class="speaker__name">
              {{ scheduleData.room.sidecar[1].speakers[0].name }}
            </p>
            <p class="speaker__job">
              {{ scheduleData.room.sidecar[1].speakers[0].company }}
              {{ scheduleData.room.sidecar[1].speakers[0].job_title }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'EboaedSchedule',
  props: {
    scheduleData: {
      type: Object,
      default: () => {}
    },
    hasNews: {
      type: Boolean,
      default: false
    }
  },
  data () {
    return {
    }
  },
  methods: {
    fullTime (startDate, endDate) {
      startDate = new Date(startDate * 1000)
      endDate = new Date(endDate * 1000)
      const startHour = (startDate.getHours() < 10 ? '0' + startDate.getHours() : startDate.getHours())
      const startMin = (startDate.getMinutes() < 10 ? '0' + startDate.getMinutes() : startDate.getMinutes())
      const endHour = (endDate.getHours() < 10 ? '0' + endDate.getHours() : endDate.getHours())
      const endMin = (endDate.getMinutes() < 10 ? '0' + endDate.getMinutes() : endDate.getMinutes())
      return `${startHour}:${startMin} ~ ${endHour}:${endMin}`
    }
  }
}
</script>

<style lang="scss" src="./style.scss" scoped></style>
