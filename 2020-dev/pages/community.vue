<template>
  <div id="wrap">
    <!--我們在打造高速資訊交流圈-->
    <div class="container slogan">
      <div class="slogan-title">
        <h2 class="slogan-title-en">
          REVOLUTION
        </h2>
        <h1>
          我們在打造
          <br>
          <span>
            高速資訊交流圈
          </span>
        </h1>
        <ul class="slogan-content">
          MOPCON 為締造人、知識與產業的連結，旨在實現三項目標：
          <li>一、帶動南台灣高經濟產業循環</li>
          <li>二、培養高知識產值人才</li>
          <li>三、匯聚知識、人流、投資，促進創新創業機會。</li>
          為使目標達成，MOPCON 志在打造出一座「高速資訊交流圈」！
        </ul>
      </div>
      <div class="slogan-pic">
        <div class="slogan-pic-container" />
      </div>
    </div>
    <!--join us-->
    <div class="container joinus">
      <div class="logo logo-joinus" />
      <h2 class="joinus-title ">
        有興趣加入我們嗎?
      </h2>
      <div class="joinus-social">
        <button class="joinus-social-button" @click="linkTo('https://www.facebook.com/mopcon')">
          追蹤我們的FaceBook
          <img src="../assets/community/launch.svg" class="pl-2">
        </button>
      </div>
    </div>
    <!--hr-->
    <div class="container">
      <div class="logo logo-hr" />
    </div>
    <!--志工團隊-->
    <div class="container volunteer">
      <div class="volunteer-title-container">
        <img src="../assets/community/mopcon.svg">
        <h2 class="volunteer-title">
          志工團隊
        </h2>
      </div>
      <!--團隊-->
      <div class="volunteer-content">
        <div v-for="volunteer in volunteerList" :key="volunteer.id" class="volunteer-card">
          <a href="#" class="volunteer-card-pic" :style="{ 'background-image': 'url(' + volunteer.photo + ')' }" @click.prevent="openModal(volunteer.id,'volunteer')" />
          <p class="volunteer-card-title">
            {{ volunteer.name }}
          </p>
        </div>
      </div>
      <!--訊息-->
      <div class="volunteer-message">
        <div class="volunteer-message-card">
          <h5 class="volunteer-message-card-title yellow">
            「我想加入志工！」
          </h5>
          <div class="logo logo-volunteer mx-auto" />
          <button class="btn-second" @click="linkTo('https://www.facebook.com/mopcon')">
            追蹤 Facebook
          </button>
          <p>
            想要和我們一起改變南部資訊生態圈嗎？歡迎追蹤我們的 Facebook，我們會在下一屆準備開始前 PO 出徵才資訊！加入我們不僅有機會參與改變的過程，還可以得到寶貴的辦展經驗、認識大神們哦！
          </p>
        </div>
        <div class="volunteer-message-card">
          <h5 class="volunteer-message-card-title purple">
            「我有興趣贊助～」
          </h5>
          <div class="logo logo-donate mx-auto" />
          <a class="btn-third" href="mailto:sponsor@mopcon.org">
            有興趣贊助我們
          </a>
          <p>
            謝謝你願意成為全台最大行動科技領域社群研討會的參與者及貢獻者之一！
          </p>
        </div>
      </div>
    </div>
    <!--社群-->
    <div class="md:max-w-screen-xl community">
      <div class="community-title">
        <img src="../assets/community/mopcon.svg">
        <h2 class="volunteer-title ">
          參與社群
        </h2>
      </div>
      <div class="community-grid">
        <div v-for="community in communityList" :key="community.id" class="community-card">
          <a class="community-card-head">
            <a href="#" class="community-card-head-hover" @click.prevent="openModal(community.id,'community')">
              - Read more -
            </a>
            <div class="community-card-pic" :style="{ 'background-image': 'url(' + community.photo + ')' }" />
          </a>
          <div class="community-card-text">
            {{ community.name }}
          </div>
        </div>
      </div>
      <Modal :modal-open="modalOpen" @modal-close="closeModal">
        <div v-if="modaltype == 'volunteer'" class="modal-body">
          <div class="modal-content modal-volunteer-content">
            <div class="modal-volunteer-pic" :style="{ 'background-image': 'url(' + volunteerData.photo + ')' }" />
            <p class="modal-volunteer-title">
              {{ volunteerData.name }}
            </p>
            <p class="modal-volunteer-intro">
              {{ volunteerData.introduction }}
            </p>
            <div class="modal-volunteer-hr" />
            <p class="modal-volunteer-member-title">
              來看看成員有誰
            </p>
            <p class="modal-volunteer-member-name">
              <span v-for="member in volunteerData.members" :key="member">{{ member }}</span>
            </p>
          </div>
        </div>
        <div v-if="modaltype == 'community'" class="modal-body">
          <div class="modal-content ">
            <div class="modal-community-content">
              <div class="modal-community-pic" :style="{ 'background-image': 'url(' + communityData.photo + ')' }" />
              <p class="modal-community-title">
                {{ communityData.name }}
              </p>
            </div>
            <div class="modal-community-social">
              <a v-if="communityData.facebook" :href="communityData.facebook" target="_blank" class="text-white">
                <img src="../assets/community/fb.png" alt="">
              </a>
              <a v-if="communityData.event" :href="communityData.event" target="_blank" class="text-white">
                <img src="../assets/community/event.png" alt="">
              </a>
            </div>
            <p class="modal-community-intro-title">
              <span>\\</span>介紹
            </p>
            <p class="modal-community-intro-content">
              {{ communityData.introduction }}
            </p>
          </div>
        </div>
      </Modal>
    </div>
    <!--standard-->
    <div class="md:max-w-screen-sm standard">
      <h3 class="standard-en">
        STANDARD
      </h3>
      <h3 class="standard-ch">
        我們的<span><br>行為準則</span>
      </h3>
      <p class="standard-content">
        <span>所有此次活動的聽眾、演講者、贊助商和志工，都必須同意遵守下列行為準則。而主辦單位也將嚴格地執行這些準則，我們期待所有參加者的合作，以確保大家能有一個安全友善的環境。</span><br>
        <span>騷擾包括有關性別，性別認同、年齡、性向、殘疾、外貌、體型、種族、宗教的攻擊性言語，或是在公共場合散播色情圖片、蓄意恐嚇、跟踪、騷擾性的攝影或錄影、多次打斷活動、不恰當的身體接觸，和讓人感到不舒服的性關注。參與者必須停止任何騷擾行為並且立即遵守行為準則。贊助商也必須遵守行為準則。</span><br>
        <span>贊助商不應該使用帶有性意味的圖像、活動，或其它材料。工作人員（包括志工）不該穿著帶有性意味的衣服/制服/裝扮，或是建立一個具有性意味的環境。</span><br>
        <span>如果參與者從事騷擾行為，工作人員會採取其認為適當的任何手段，包括警告或是請離會場，並且不會退費。如果你被騷擾、看到別人受到騷擾，或有任何其他問題，請立即聯繫會議工作人員，工作人員身上會穿戴可以識別身份的特殊徽章或衣服。</span><br>
        <span>工作人員會很樂意幫助參與者聯繫酒店/場地警衛或當地警察、提供護送，或以其他方式幫助那些遇到騷擾的參與者感到安全。我們非常重視您的參與。</span><br>
        <span>我們希望參與者在各活動場合、會議有關的社群活動都能遵循這些規則。</span><br>
        <span>此行為準則是基於 Conference Code of Conduct ( http://confcodeofconduct.com/ )而訂定。</span>
      </p>
    </div>
  </div>
  </div>
</template>

<script>
import Modal from '~/components/Modal'

export default {
  name: 'Community',
  components: {
    Modal
  },
  data () {
    return {
      modalOpen: false,
      volunteerList: [],
      volunteerData: [],
      communityList: [],
      communityData: [],
      modaltype: ''
    }
  },
  created () {
    this.getVolunteerData()
    this.getCommunityData()
  },
  methods: {
    linkTo (url) {
      window.open(url, '_blank')
    },
    getVolunteerData () {
      const vm = this
      vm.$axios
        .$get('/api/2020/volunteer')
        .then(({ success, data, message }) => {
          if (success) {
            vm.volunteerList = data.volunteer
          } else {
            console.log('error', message)
          }
        })
        .catch((error) => {
          console.log(error)
        })
    },
    getCommunityData () {
      const vm = this
      vm.$axios
        .$get('/api/2020/community')
        .then(({ success, data, message }) => {
          if (success) {
            vm.communityList = data.participant
          } else {
            console.log('error', message)
          }
        })
        .catch((error) => {
          console.log(error)
        })
    },
    openModal (id, modaltype) {
      const vm = this
      vm.modaltype = modaltype
      if (vm.modaltype === 'volunteer') {
        vm.volunteerData = []
        vm.$axios
          .$get(`/api/2020/volunteer/${id}`)
          .then(({ success, data, message }) => {
            if (success) {
              vm.volunteerData = data
            } else {
              console.log('error', message)
            }
          })
          .catch((error) => {
            console.log(error)
          })
      } else if (vm.modaltype === 'community') {
        const vm = this
        vm.communityData = []
        vm.$axios
          .$get(`/api/2020/community/participant/${id}`)
          .then(({ success, data, message }) => {
            if (success) {
              vm.communityData = data
            } else {
              console.log('error', message)
            }
          })
          .catch((error) => {
            console.log(error)
          })
      }
      vm.modalOpen = true
    },
    closeModal (show) {
      this.modalOpen = show
      if (!show) { this.modatype = '' }
    }
  },
  head () {
    return {
      title: '主辦社群 | MOPCON 2020'
    }
  }
}

</script>

<style lang="scss" scoped>
@import '~@/assets/styles/mix';

$logo_map: (
  png:bg,
  svg:hr mopcon launch joinus volunteer donate close,
);
@include logo_map_mix(community);

@mixin btn($color){
  border-radius: 8px;
  background-color:$color;
  transition: all 0.15s;
  outline: none;
  box-shadow: 10px 10px 0 rgba($color, 0.32);
  width:100%;
  @apply px-0 py-3 text-xl text-black text-center;
  &:hover {
    transform: translate(3px, 3px);
    box-shadow: none;
  }
  @screen md {
    font-size: 1.75rem;
    width:80%;
    @apply px-32;

  }
  @screen sm {
    @apply px-24 text-2xl w-auto;
  }
}
@mixin bg-cover{
  background-position: center center;
  background-size: cover;
}
#wrap {
  background-image: url('~@/assets/community/bg.png');
  background-size: 115px 100px;
}
.container {
  @apply mx-auto;
}
.slogan {
  @apply text-white flex flex-wrap mb-12;
  @screen lg{
    @apply p-8;
  }
  &-title {
    @apply order-2 w-full;
    @screen lg{
      @apply order-1 w-1/2;
    }
    &-en{
      font-family: Poppins;
      font-size:3rem;
      letter-spacing: 0.125rem;
      opacity: 0.24;
      -webkit-text-stroke: 1px #ffffff;
      color: rgba(255, 255, 255, 0);
      @apply  font-semibold text-center;
      @screen lg{
        font-size: 5rem;
        @apply text-left;
      }
    }
    & h1{
      font-size: 2rem;
      letter-spacing: 0.2px;
      bottom:40px;
      @apply font-medium relative text-white text-center;
      @screen lg{
        bottom:55px;
        left:10px;
        @apply text-left;
      }
      & br{
        @apply block;
        @screen lg{
          @apply hidden;
        }
      }
      & span{
        @apply ml-2 text-yellow-500;
      }
      &:after {
        content: '';
        width: 80px;
        height: 6px;
        bottom:-20px;
        left: calc(50% - 40px);
        @apply bg-yellow-500 absolute;
        @screen lg{
          left:20px;
        }
      }
    }
  }
  &-content {
    line-height: 1.6875rem;
    letter-spacing: 0.2px;
    @apply px-3 mx-auto;
    @screen lg{
      padding-left:30px;
      padding-right:0px;
    }
    & li{
      @apply ml-3 list-none;
    }
  }
  &-pic{
    @apply w-full order-1 flex items-center justify-center;
    @screen lg{
      @apply w-1/2 order-2 items-end justify-end;
    }
    @screen xl{
      @apply justify-center;
    }
    &-container{
      @include bg-cover;
      background-image: url('~@/assets/community/revolution.svg');
      width:289px;
      height:166px;
      @apply my-8;
      @screen lg{
        width:450px;
        height:259px;
        @apply my-0;
      }
    }
  }
}
.joinus {
  @apply mx-auto mb-16;
  &-title {
    line-height: 27px;
    letter-spacing: 4px;
    @apply text-center text-xl text-white mb-12;
  }
  &-social{
    @apply flex justify-center;
    &-button{
      @apply text-base text-yellow-500 px-8 py-3 rounded-lg inline-flex items-center border-solid border-2 border-yellow-500;
      &:hover {
      box-shadow: 0 0 10px 0 #ffcc00;
      }
    }
  }
}
.logo{
  &-joinus{
    width:80%;
    height:184px;
    @apply mb-12 mx-auto;
  }
  &-hr {
    height: 15px;
    background-repeat: repeat no-repeat;
    background-position-x: left;
    background-size: auto 15px;
    margin-right:auto;
    margin-left:atuo;
    @apply mb-16;
    @screen md {
      height: 10px;
      background-size: auto 10px;
    }
  }
  &-volunteer, &-donate{
    width:128px;
    height:128px;
    @apply mb-8
  }
}
.volunteer{
  @apply mb-12;
  @screen md{
    @apply mb-20 relative;
  }
  &-title-container{
    @apply flex justify-center mb-10;
  }
  &-title{
    font-size:1.5rem;
    letter-spacing: 0.15px;
    @apply text-yellow-500 ml-2;
    @screen sm{
      font-size:2rem;
      letter-spacing:0.2px
    }
  }
  &-content{
    @apply flex flex-wrap justify-center mb-20;
  }
  &-card{
    @apply my-4;
      &-pic{
        @include bg-cover;
        width:124px;
        height:124px;
        @apply block mx-4 my-4;
        @screen lg{
          width:188px;
          height:188px;
          @apply mx-8 my-4;
        }
      }
      &-title{
        @apply text-white text-center;
      }
  }
  &-message{
    @apply grid grid-cols-1;
    @screen lg{
      @apply grid-cols-2;
    }
    &-card{
      @apply flex flex-col items-center;
      &-title{
        font-size:1.75rem;
        letter-spacing:0.18px;
        @apply mb-8;
        &.yellow{
          @apply text-yellow-500;
        }
        &.purple{
          color:#b594ff;
          @apply mt-8;
          @screen lg{
            @apply mt-0;
          }
        }
      }
      & p{
        line-height: 27px;
        letter-spacing: 0.1px;
        @apply mt-8 px-10 text-white;
        @screen lg{
          @apply px-24;
        }
      }
    }
  }
  &-pop{
    max-width:80%;
    z-index:9;
    overflow:hidden;
    @apply absolute mx-auto;
    @screen md{
      max-width:80%;
    }
    &-close{
      margin-bottom:1rem;
      @apply block flex justify-end;
    }
    &-card{
      background:#001333;
      @apply rounded-lg border-2 border-yellow-500 p-5;
      &-title{
        font-size:1.5rem;
        letter-spacing:0.43px;
        margin-bottom:10px;
        @apply text-white text-center font-semibold;
      }
      &-content{
        letter-spacing:0.2px;
        margin-bottom:24px;
        @apply text-white text-center;
      }
      &-hr{
        height:56px;
        width:2px;
        background-color:#6d02ff;
        margin-bottom:24px;
        @apply mx-auto;
      }
      &-member{
        letter-spacing:0.36px;
        margin-bottom:12px;
        @apply text-xl text-white text-center;
        &-list{
          color:#b594ff;
          letter-spacing:0.2px;
          @apply flex flex-wrap justify-center;
          span{
            @apply mx-4 my-1;
          }
        }
      }
    }
  }
}
.btn{
  &-second{
    @include btn(#ffcc00);
  }
  &-third{
    @include btn(#651fff);
    @apply text-white block;
  }
}
.community{
  @apply mx-auto p-6;
  &-title{
    @apply flex justify-center mb-8 ;
    @screen sm{
      @apply justify-start;
    }
  }
  &-grid{
    @apply grid grid-cols-1 relative;
    @screen md{
      @apply grid-cols-3 gap-4 mb-16;
    }
  }
  &-card{
    @apply mb-8;
    &-head{
      background-color:#051f4c;
      @apply flex items-center justify-center relative py-8;
      &-hover{
        @apply hidden;
      }
      &:hover .community-card-head-hover{
        display:block;
        height:100%;
        letter-spacing:0.29px;
        background-color: rgba(255, 204, 0, 0.7);
        z-index:1;
        top:0;
        left:0;
        @apply absolute flex justify-center items-center font-medium w-full;
      }
    }
    &-pic{
      @apply bg-contain bg-center bg-no-repeat;
      width:119px;
      height:90px;
    }
    &-text{
    height:51px;
      @apply flex bg-white text-lg items-center justify-center;
    }
  }
}
.standard{
  @apply mx-auto pb-8;
  &-en{
    font-family: Poppins;
    font-size: 2.5rem;
    letter-spacing: 0.125rem;
    opacity: 0.24;
    -webkit-text-stroke: 1px #ffffff;
    color: rgba(255, 255, 255, 0);
    @apply  font-semibold text-center;
    @screen md{
      font-size: 5rem;
    }
  }
  &-ch{
    font-size: 1.5rem;
    letter-spacing: 0.15px;
    top:-30px;
    @apply font-medium relative text-white text-center mb-8;
    @screen md{
      top:-50px;
      letter-spacing: 0.2px;
      font-size: 2rem;
      @apply mb-0;
    }
    &:after {
      content: '';
      width: 80px;
      height: 6px;
      left: calc(50% - 40px);
      bottom:-12px;
      @apply bg-yellow-500 absolute;
    }
    & span{
      @apply ml-2 text-yellow-500;
    }
    & br{
      @apply block;
      @screen sm{
        @apply hidden;
      }
    }
  }
  &-content{
    line-height:27px;
    letter-spacing:0.2px;
    @apply text-white;
    & span{
      @apply inline-block mb-1 p-6;
    }
  }
}
.modal{
  &-body{
    border-radius:12px;
    border:solid 2px #ffcc00;
    background-color:#001333;
  }
  &-volunteer{
    &-content{
      @apply flex flex-col items-center;
    }
    &-pic{
      @include bg-cover;
      height:140px;
      width:140px;
      @apply mb-4
    }
    &-title{
      letter-spacing:0.36px;
      @apply text-white mb-4 text-xl;
      @screen lg{
        letter-spacing:0.43px;
        @apply text-2xl;
      }
    }
    &-intro{
      letter-spacing:0.2px;
      @apply text-white mb-4;
    }
    &-hr{
      height:56px;
      width:2px;
      background-color:#6d02ff;
      @apply mx-auto mb-4;
    }
    &-member-title{
      @apply text-xl text-white mb-4;
    }
    &-member-name{
      color:#b594ff;
      letter-spacing:0.2px;
      @apply flex flex-wrap justify-center;
      & span{
        @apply mx-4 my-1;
      }
    }
  }
  &-community{
    &-content{
      @apply flex flex-col items-center mb-4;
      @screen lg{
        @apply flex flex-row;
      }
    }
    &-pic{
      @include bg-cover;
      height:140px;
      width:140px;
      @apply mb-4
    }
    &-title{
      @apply hidden;
      @screen lg{
        letter-spacing:0.43px;
        @apply block flex-grow text-center self-center text-2xl text-white;
      }
    }
    &-social{
      width:50%;
      @apply flex justify-around mx-auto mb-6;
      @screen sm{
        width:30%;
      }
      @screen lg{
        @apply mx-0;
      }
      & img{
        width:24px;
        height:24px;
      }
    }
    &-intro{
      &-title{
        font-size:1.125rem;
        letter-spacing:2px;
        @apply text-white mb-2;
        & span{
          @apply text-yellow-500 font-bold tracking-widest mr-2;
        }
      }
      &-content{
        letter-spacing:0.2px;
        @apply text-white;
      }
    }
  }
}
</style>
