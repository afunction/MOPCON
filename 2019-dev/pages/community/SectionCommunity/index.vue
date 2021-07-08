<template>
  <section class="section section-community">
    <h2 class="title"><span>{ MOPCON </span><span class="color-primary">主辦社群</span><span>; }</span></h2>
    <h2 class="title_mobile"><span>{ 主辦社群 ; }</span></h2>
    <div class="community">
      <div class="community__card" v-for="community in communityList" :key="'community' + community.id"
        :id="'community' + community.id" :class="{'active': show == 'community' + community.id}">
        <div class="community__content">
          <div class="card-header">
            <img class="logo" :src="community.photo" alt="">
            <p>{{ community.name }}</p>
          </div>
          <div class="card-body" v-if="show == 'community' + community.id">
            <p class="intro">{{ tempCommunityData.introduction }}</p>
          </div>
        </div>
        <div class="community__aside">
          <div class="card-header">
            <a href="#" class="toggle_icon" @click.prevent="openCard('community', community.id)">
              <img v-if="show == 'community' + community.id" src="./images/Icon_times.png" width="25px">
              <img v-else src="./images/Icon_open.png" width="25px" height="25px">
            </a>
          </div>
          <div class="social_media">
            <a v-if="tempCommunityData.facebook" :href="tempCommunityData.facebook" target="_blank">
              <img src="./images/Icon_facebook.png" alt="facebookIcon" width="24px" height="24px">
            </a>
            <a v-if="tempCommunityData.twitter" :href="tempCommunityData.twitter" target="_blank">
              <img src="./images/Icon_Twitter.png" alt="twitterIcon" width="24px" height="24px">
            </a>
            <a v-if="tempCommunityData.instagram" :href="tempCommunityData.instagram" target="_blank">
              <img src="./images/Icon_Instagram.png" alt="instagramIcon" width="24px" height="24px">
            </a>
            <a v-if="tempCommunityData.telegram" :href="tempCommunityData.telegram" target="_blank">
              <img src="./images/Icon_Telegram.png" alt="telegramIcon" width="24px" height="24px">
            </a>
            <a v-if="tempCommunityData.event" :href="tempCommunityData.event" target="_blank">
              <img src="./images/event.png" alt="eventIcon" width="24px" height="24px">
            </a>
          </div>
        </div>
      </div>
    </div>
    <h2 class="participant title"><span>{ MOPCON </span><span class="color-primary">參與社群</span><span>; }</span></h2>
    <h2 class="participant title_mobile"><span>{ 參與社群 ; }</span></h2>
    <div class="community">
      <div class="community__card" v-for="participant in participantList" :key="'participant' + participant.id"
        :id="'participant' + participant.id" :class="{'active': show == 'participant' + participant.id}">
        <div class="community__content">
          <div class="card-header">
            <img class="logo" :src="participant.photo" alt="">
            <p>{{ participant.name }}</p>
          </div>
          <div class="card-body" v-if="show == 'participant' + participant.id">
            <p class="intro">{{ tempParticipantData.introduction }}</p>
          </div>
        </div>
        <div class="community__aside">
          <div class="card-header">
            <a href="#" class="toggle_icon" @click.prevent="openCard('participant', participant.id)">
              <img v-if="show == 'participant' + participant.id" src="./images/Icon_times.png" width="25px">
              <img v-else src="./images/Icon_open.png" width="25px" height="25px">
            </a>
          </div>
          <div class="social_media">
            <a v-if="tempParticipantData.facebook" :href="tempParticipantData.facebook" target="_blank">
              <img src="./images/Icon_facebook.png" alt="facebookIcon" width="24px" height="24px">
            </a>
            <a v-if="tempParticipantData.twitter" :href="tempParticipantData.twitter" target="_blank">
              <img src="./images/Icon_Twitter.png" alt="twitterIcon" width="24px" height="24px">
            </a>
            <a v-if="tempParticipantData.instagram" :href="tempParticipantData.instagram" target="_blank">
              <img src="./images/Icon_Instagram.png" alt="instagramIcon" width="24px" height="24px">
            </a>
            <a v-if="tempParticipantData.telegram" :href="tempParticipantData.telegram" target="_blank">
              <img src="./images/Icon_Telegram.png" alt="telegramIcon" width="24px" height="24px">
            </a>
            <a v-if="tempParticipantData.event" :href="tempParticipantData.event" target="_blank">
              <img src="./images/event.png" alt="eventIcon" width="24px" height="24px">
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>

  export default {
    name: "SectionCommunity",
    data() {
      return {
        communityList: [],
        participantList: [],
        tempCommunityData: [],
        tempParticipantData: [],
        show: -1,
      };
    },
    methods: {
      getCommunityData() {
        const vm = this;
        vm.$axios
          .$get(`/api/2019/community`)
          .then(({ success, data, message }) => {
            if (success) {
              vm.communityList = data.community
              vm.participantList = data.participant;
            } else {
              console.log("error", message);
            }
          })
          .catch(error => {
            console.log(error);
          });
      },
      openCard(type, id) {
        const vm = this;
        const card = document.querySelectorAll('.community__card');
        let url = '';
        let getData = '';
        if (type === 'community') {
          url = `/api/2019/community/organizer/${id}`;
          getData = `tempCommunityData`;
        } else if (type === 'participant') {
          url = `/api/2019/community/participant/${id}`;
          getData = `tempParticipantData`;
        }
        vm.$axios.$get(url)
          .then(({ success, data, message }) => {
            if (success) {
              vm.show = vm.show === type + id ? -1 : type + id;
              vm[getData] = data;
            }
          })
      },
    },
    created() {
      this.getCommunityData();
    }
  };
</script>

<style lang="scss" src="./style.scss" scoped></style>