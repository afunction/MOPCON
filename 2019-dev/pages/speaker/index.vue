<template>
  <div class="speaker">
    <div class="speaker__banner"></div>
    <div class="section">
      <h2 class="title"><span>{ 驅動高速資訊交流圈</span><span class="color-primary">的佼佼者們</span><span>; }</span></h2>
      <p class="intro">每年我們都邀請了超過 25 位講師來到現場，包含知名的前端開發者、軟體工程師、資深架構師、設計師，以及專案經理等等，讓這場活動更加多元，也貫徹 MOPCON
        的精神，使參與的會眾都能從中獲得養分，甚至達到近一步的交流。</p>
      <div class="section-master-speaker">
        <h2 class="title"><span>{ 開箱</span><span class="color-primary">高手陣容</span><span>; }</span></h2>
        <div id="tag_area">
          <div class="tag">
            <label v-for="(tag, index) in tagsList" :class="{'active': selectedTags.includes(tag.name), 'filter-btn-primary': tag.color == '#01aaf0',
                        'filter-btn-third': tag.color == '#ff4492', 'filter-btn-secondary': tag.color == '#98ce02'}"
              :key="tag.name">
              <input class="hidden" type="checkbox" :value="tag.name" v-model="selectedTags">
              <span>{{ selectedTags.includes(tag.name)? 'x '+ tag.name : tag.name }}</span>
            </label>
          </div>
          <a href="#" class="clear__tag" @click.prevent="selectedTags = []"
            v-if="selectedTags.length !== 0"><small>清除篩選</small></a>
        </div>
        <div class="section__speaker__list" v-if="speakerHasTagsList.length != 0">
          <div class="section__speaker__card" v-for="speaker in speakerHasTagsList" :key="speaker.speaker_id"
            @click="openModal(speaker)">
            <img class="section-master-speaker__img" :src="speaker.img.web" alt="" width="140px" height="140px">
            <h3 class="section-master-speaker__name">{{ speaker.name }}</h3>
            <div class="section-master-speaker__content">
              <p>{{ speaker.company }}</p>
              <p>{{ speaker.job_title }}</p>
            </div>
            <span class="basic-badge-primary" v-for="tag in speaker.tags"
              :style="{'background-color': tag.color}">{{ tag.name }}</span>
          </div>
        </div>
        <div class="section__speaker__noSpeaker" v-else>
          <div class="section__speaker__noSpeaker-img"></div>
          <h3 class="color-primary">Oops！沒有符合篩選的講者哦！</h3>
        </div>
        <Modal :modal-open="modalOpen" @modal-close="closeModal">
          <div class="modal-body">
            <div class="section-master-speaker__info">
              <img v-if="tempSpeakerData.img" :src="tempSpeakerData.img.web" class="section-master-speaker__img" alt=""
                width="140px" height="140px">
              <div class="intro">
                <span class="speaker-badge-third" v-if="tempSpeakerData.is_keynote">Keynote</span>
                <h3 class="section-master-speaker__name">{{ tempSpeakerData.name }}</h3>
                <div class="section-master-speaker__content">
                  <p>{{ tempSpeakerData.company }}</p>
                  <p>{{ tempSpeakerData.job_title }}</p>
                </div>
              </div>
            </div>
            <div class="socail_media"
              :class="{'has_icon': tempSpeakerData.link_fb || tempSpeakerData.link_twitter || tempSpeakerData.link_github || tempSpeakerData.link_other}">
              <a v-if="tempSpeakerData.link_fb" :href="tempSpeakerData.link_fb" target="_blank">
                <img src="./images/icon/icon-fb.png" alt="" width="34.5px" height="34.5px">
              </a>
              <a v-if="tempSpeakerData.link_twitter" :href="tempSpeakerData.link_twitter" target="_blank">
                <img src="./images/icon/icon-twitter.png" alt="" width="34.5px" height="34.5px">
              </a>
              <a v-if="tempSpeakerData.link_github" :href="tempSpeakerData.link_github" target="_blank">
                <img src="./images/icon/icon-github.png" alt="" width="34.5px" height="34.5px">
              </a>
              <a v-if="tempSpeakerData.link_other" :href="tempSpeakerData.link_other" target="_blank">
                <img src="./images/icon/icon-web.png" alt="" width="34.5px" height="34.5px">
              </a>
            </div>
            <p class="summary" v-html="formatTextWrap(tempSpeakerData.bio)"></p>
            <div class="topic">
              <p v-if="tempSpeakerData.tags != ''">議程主題 <span class="basic-badge-primary" v-for="tag in tempSpeakerData.tags"
                :style="{'background-color': tag.color}" >{{ tag.name }}</span></p>
              <h3 class="topic__title color-third">{{ tempSpeakerData.topic }}</h3>
              <p class="topic__time" v-if="tempSpeakerData.started_at && tempSpeakerData.ended_at">時間：
                {{ fullTime }}　<br class="break">
                <span
                  v-if="tempSpeakerData.room && tempSpeakerData.floor">地點：{{ tempSpeakerData.room }}({{ tempSpeakerData.floor }})</span>
              </p>
            </div>
            <p class="desc" v-html="formatTextWrap(tempSpeakerData.summary)"></p>
            <div class="sponsor" v-if="tempSpeakerData.sponsor_id !== 0 && Object.keys(tempSpeakerData).length !== 0">
              <p class="color-primary">贊助廠商</p>
              <img :src="getSponsorData(tempSpeakerData.sponsor_id)" alt="" srcset="" width="60px" height="60px">
            </div>
            <div class="share">
              <div class="share__copy"
                :class="{active: copyUrlSuccess}"
                v-clipboard:copy="nowUrl"
                v-clipboard:success="onCopy"
                @click.prevent="copyLink(tempSpeakerData.speaker_id)">
                複製講者連結
              </div>
              <div class="share__fb">
                <no-ssr>
                  <social-sharing class="share__fb__btn" :url="shareUrl"
                    :title="`${tempSpeakerData.name} | 講者 MOPCON 2019`"
                    :description="tempSpeakerData.summary"
                    :quote="`${tempSpeakerData.name} | 講者 MOPCON 2019`"
                    hashtags="MOPCON"
                    inline-template>
                    <network network="facebook"></network>
                  </social-sharing>
                </no-ssr>
              </div>
              <div class="share__twitter">
                <no-ssr>
                  <social-sharing class="share__fb__btn" :url="shareUrl"
                    :title="`${tempSpeakerData.name} | 講者 MOPCON 2019`"
                    :description="tempSpeakerData.summary"
                    :quote="`${tempSpeakerData.name} | 講者 MOPCON 2019`"
                    hashtags="MOPCON"
                    inline-template>
                    <network network="twitter"></network>
                  </social-sharing>
                </no-ssr>
              </div>
              <small class="share_message">講者連結已複製</small>
            </div>
          </div>
        </Modal>
      </div>
    </div>
    <SectionApp />
  </div>
</template>

<script>
  import Modal from "~/components/Modal";
  import SectionApp from '~/components/SectionApp';

  export default {
    components: {
      Modal,
      SectionApp,
    },
    data() {
      return {
        spearkerList: [],
        modalOpen: false,
        tempSpeakerData: {},
        tagsList: [],
        selectedTags: [],
        nowUrl: '',
        imgUrl: '',
        copyUrlSuccess: false
      };
    },
    methods: {
      getSpeakerData() {
        const vm = this;
        vm.$axios
          .$get(`/api/2019/speaker`)
          .then(({ success, data, message }) => {
            if (success) {
              vm.spearkerList = data
            } else {
              console.log("error", message);
            }
          })
          .catch(error => {
            console.log(error);
          });
      },
      getTags() {
        const vm = this;
        vm.$axios.$get(`/api/2019/speaker/tags`)
          .then(({ success, data, message }) => {
            if (success) {
              vm.tagsList = data;
            }
          })
      },
      openModal(data) {
        const vm = this;
        vm.tempSpeakerData = data;
        vm.modalOpen = true;
      },
      closeModal(show) {
        this.modalOpen = show;
        this.copyUrlSuccess = false;
      },
      copyLink(link) {
        const vm = this;
        vm.nowUrl = `${process.env.BASE_URL}/2019/speaker/${link}`;
      },
      onCopy() {
        this.copyUrlSuccess = true;
        setTimeout(() => {
          this.copyUrlSuccess = false;
        }, 2000);
      },
      getSponsorData(id) {
        const vm = this;
        vm.$axios.$get(`/api/2019/sponsor?sponsor_id=${id}`)
          .then(({ success, data, message }) => {
            if (success) {
              vm.imgUrl = data[0].logo_path;
            }
          })
        return vm.imgUrl
      },
      // 將 \n 轉成 <br>
      formatTextWrap(text) {
        if (!text) return text;
        return text.replace(/\n/g, "<br>");
      }
    },
    computed: {
      shareUrl() {
        return `${process.env.baseUrl}/2019/speaker/${this.tempSpeakerData.speaker_id}`;
      },
      fullTime: function () {
        const vm = this;
        const startDate = new Date();
        startDate.setTime(vm.tempSpeakerData.started_at * 1000);
        const endDate = new Date();
        endDate.setTime(vm.tempSpeakerData.ended_at * 1000);
        const startHour = (startDate.getHours() < 10 ? '0' + startDate.getHours() : startDate.getHours())
        const startMin = (startDate.getMinutes() < 10 ? '0' + startDate.getMinutes() : startDate.getMinutes())
        const endHour = (endDate.getHours() < 10 ? '0' + endDate.getHours() : endDate.getHours())
        const endMin = (endDate.getMinutes() < 10 ? '0' + endDate.getMinutes() : endDate.getMinutes())
        const fullDate = `${startDate.getMonth() + 1}/${startDate.getDate()} ${startHour}:${startMin} ~ ${endHour}: ${endMin}`
        return fullDate
      },
      speakerHasTagsList: function () {
        const vm = this;
        if (vm.selectedTags.length == 0) {
          return vm.spearkerList;
        } else {
          return vm.spearkerList.filter((speaker) => {
            return speaker.tags.some(tag => vm.selectedTags.includes(tag.name))
          });
        }
      },
    },
    mounted() {
      const vm = this;
      vm.getTags();
      vm.getSpeakerData();
      const tagArea = document.getElementById("tag_area");
      const sticky = tagArea.offsetParent.offsetTop +
        tagArea.offsetParent.offsetParent.offsetTop +
        tagArea.offsetTop + 47 - 36;
      window.addEventListener('scroll', (event) => {
        if (window.pageYOffset > sticky) {
          tagArea.classList.add("sticky-top")
        } else {
          tagArea.classList.remove("sticky-top");
        }
      });
    },
  };
</script>

<style lang="scss" src="./style.scss" scoped></style>