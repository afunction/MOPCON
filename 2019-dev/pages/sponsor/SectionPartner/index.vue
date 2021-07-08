<template>
  <div class="section-partner">
    <h2 class="title"><span>{ 我們的</span><span class="color-primary">夥伴們</span><span> ; }</span></h2>
    <div class="partner-outline" v-for="sponsor in sponsorList">
      <div class="partner" v-if="sponsor.data">
        <h2 class="partner__title">{{ sponsor.name }}</h2>
        <span class="decoration-line"></span>
        <div class="partner__list">
          <div class="logo" v-for="partner in sponsor.data">
            <img class="logo_img" :src="partner.logo_path" alt="">
            <div class="hover" @click="openModal(partner)">
              <img src="./images/more.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
    <Modal :modal-open="modalOpen" @modal-close="closeModal">
      <div class="modal-body">
        <div class="company">
          <img :src="tempSponsorData.logo_path" alt="" height="138px">
          <div class="company__content">
            <h4 class="company__name" :class="{'no-info': !(tempSponsorData.official_website || tempSponsorData.career_information)}">{{ tempSponsorData.name }}</h4>
            <div v-if="(tempSponsorData.speaker_information && tempSponsorData.speaker_information.length == 0) && tempSponsorData.about_us == ''">
              <a class="basic-btn" v-if="tempSponsorData.official_website" target="_blank" :href="tempSponsorData.official_website">官方網站</a>
              <a class="basic-btn"  target="_blank" v-if="tempSponsorData.career_information"
                :href="tempSponsorData.career_information">徵才訊息</a>
            </div>
          </div>
        </div>
        <div class="nav-mobile show-md" v-if="(tempSponsorData.speaker_information && tempSponsorData.speaker_information.length > 0) || (tempSponsorData.about_us !== '')">
          <a href="#" v-if="tempSponsorData.about_us !== ''" :class="{'color-white active': mobileNavActive == 'aboutus'}"
            @click.prevent="mobileNavActive = 'aboutus'">關於我們</a>
          <a href="#" v-if="tempSponsorData.speaker_information && tempSponsorData.speaker_information.length > 0" :class="{'color-white active': mobileNavActive == 'speakerInfo'}"
            @click.prevent="mobileNavActive = 'speakerInfo'">相關講者資訊</a>
        </div>
        <p class="abous_us" :class="{'hidden-md': mobileNavActive !== 'aboutus'}" v-html="formatTextWrap(tempSponsorData.about_us)"></p>
        <div class="partner-speaker" :class="{'hidden-md': mobileNavActive !== 'speakerInfo'}"
          v-if="tempSponsorData.speaker_information && tempSponsorData.speaker_information.length > 0">
          <div class="column">
            <p class="hidden-md">相關講者資訊</p>
            <p class="hidden-md">場次時間</p>
          </div>
          <a class="speaker__info" v-for="speaker in tempSponsorData.speaker_information"
            :href="`/2019/speaker/${speaker.speaker_id}`">
            <div class="content">
              <img class="speaker__logo" :src="speaker.img.web" alt="" width="64px" height="64px">
              <div class="speaker__detail">
                <p class="color-primary">{{ speaker.name }}</p>
                <p class="color-primary">{{ speaker.job_title }}</p>
              </div>
            </div>
            <div class="speaker__time">
              <p class="color-white show-md">場次時間</p>
              <div class="speaker__time__info">
                <p class="color-primary">{{fullTime(speaker.started_at) }}</p>
                <p class="color-primary">{{ speaker.room }}({{ speaker.floor }})</p>
              </div>
            </div>
          </a>
        </div>
        <div class="btn" v-if="(tempSponsorData.speaker_information && tempSponsorData.speaker_information.length > 0) || (tempSponsorData.about_us !== '')">
          <a class="basic-btn" v-if="tempSponsorData.official_website" target="_blank" :href="tempSponsorData.official_website">官方網站</a>
          <a class="basic-btn" v-if="tempSponsorData.career_information" target="_blank"
            :href="tempSponsorData.career_information">徵才訊息</a>
        </div>
      </div>
    </Modal>
  </div>
</template>

<script>
  import Modal from "~/components/Modal";

  export default {
    name: 'SectionPartner',
    components: {
      Modal,
    },
    data() {
      return {
        modalOpen: false,
        sponsorList: [],
        tempSponsorData: {},
        mobileNavActive: 'aboutus',
      }
    },
    methods: {
      getSponsorData() {
        const vm = this;
        vm.$axios
          .$get(`/api/2019/sponsor`)
          .then(({ success, data, message }) => {
            if (success) {
              vm.sponsorList = data;
            } else {
              console.log("error", message);
            }
          })
          .catch(error => {
            console.log(error);
          });
      },
      openModal(data) {
        const vm = this;
        vm.tempSponsorData = data;
        vm.modalOpen = true;
      },
      closeModal(show) {
        this.modalOpen = show;
        this.mobileNavActive = 'aboutus';
        if (!show) this.$router.push('/sponsor/');
      },
      fullTime(start) {
        const vm = this;
        const startDate = new Date();
        startDate.setTime(start * 1000);
        const startHour = (startDate.getHours() < 10 ? '0' + startDate.getHours() : startDate.getHours())
        const startMin = (startDate.getMinutes() < 10 ? '0' + startDate.getMinutes() : startDate.getMinutes())
        const fullDate = `${startDate.getMonth() + 1}/${startDate.getDate()} ${startHour}:${startMin}`
        return fullDate
      },
      // 將 \n 轉成 <br>
      formatTextWrap(text) {
        if (!text) return text;
        return text.replace(/\n/g, "<br>");
      },
    },
    created() {
      this.getSponsorData();
      const vm = this;
      if (vm.$route.query.id) {
        vm.$axios
          .$get(`/api/2019/sponsor?sponsor_id=${vm.$route.query.id}`)
          .then(({ success, data, message }) => {
            if (success) {
              vm.openModal(data[0])
            } else {
              console.log("error", message);
            }
          })
          .catch(error => {
            console.log(error);
          });
      }
    }
  };
</script>

<style lang="scss" src="./style.scss" scoped></style>
