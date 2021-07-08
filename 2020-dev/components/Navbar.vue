<template>
  <div :class="{'fixed w-screen': navOpen, 'sticky': !navOpen}" class="top-0 z-50">
    <nav :class="{'navActive': navOpen}">
      <div class="container mx-auto flex items-center h-full">
        <div class="logo-box">
          <nuxt-link to="/" class="logo logo-mopcon" />
        </div>
        <ul
          class="navbar"
          :class="{'navbar-mobile' : isMobile,
                   'navbar-mobile_active' : navOpen}"
        >
          <li
            v-for="item in navOpenList"
            :key="item.url"
            class="relative h-full"
            :class="{'hasSub': item.subIsOpen, 'hasSubMobile': isMobile, 'active': item.subIsOpen && isMobile && nowSubOpen == item.name}"
          >
            <a v-if="item.subIsOpen" :href="item.url" class="whitespace-no-wrap block" @click.prevent="toggleSubNav(item.name, item.subIsOpen)">
              <span :class="{'mobile-subicon': isMobile}">{{ item.name }}</span>
              <span v-if="!isMobile" class="material-icons align-bottom">
                arrow_drop_down
              </span>
            </a>
            <a v-else :href="item.url" class="whitespace-no-wrap block">{{ item.name }}</a>
            <ul v-if="item.subIsOpen" class="history-link" :class="{'history-link_active': subNavOpen}" @click.stop>
              <li v-for="(subNav, index) in checkOpen(item.subNav)" :key="`subNav_${index}`">
                <a :href="subNav.url" :target="setTarget(item.targetEnabled)"><span>{{ subNav.name }}</span></a>
              </li>
            </ul>
          </li>
        </ul>
        <div
          class="navbar-mobile-btn"
          :class="{'navbar-mobile-btn_active' : navOpen}"
          @click="closeNav"
        />
      </div>
    </nav>
  </div>
</template>
<script>
export default {
  props: {
    navOpen: Boolean,
    isMobile: Boolean,
    subNavOpen: Boolean,
    innerWidth: {
      type: Number,
      default: 1024
    }
  },
  data () {
    const [startYear, currentYear] = [2012, new Date().getFullYear()]
    return {
      navList: [
        {
          name: '首頁',
          url: './',
          subNav: [],
          subIsOpen: false,
          open: true,
          targetEnabled: false
        },
        {
          name: '主辦社群',
          url: './community',
          subNav: [],
          subIsOpen: false,
          open: process.env.route_community,
          targetEnabled: false
        },
        {
          name: '議程介紹',
          url: './schedule',
          subNav: [
            {
              name: '主要議程',
              url: './schedule',
              open: process.env.route_schedule
            },
            {
              name: '交流議程',
              url: './schedule_unconf',
              open: process.env.route_schedule_unconf
            }
          ],
          subIsOpen: true,
          open: process.env.route_schedule || process.env.route_schedule,
          targetEnabled: false
        },
        {
          name: '講者陣容',
          url: './speaker',
          subNav: [],
          subIsOpen: false,
          open: process.env.route_speaker,
          targetEnabled: false
        },
        {
          name: '贊助夥伴',
          url: './sponsor',
          subNav: [],
          subIsOpen: false,
          open: process.env.route_sponsor,
          targetEnabled: false
        },
        {
          name: '票種介紹',
          url: './ticket',
          subNav: [],
          subIsOpen: false,
          open: process.env.route_ticket,
          targetEnabled: false
        },
        {
          name: '防疫守則',
          url: './notice',
          subNav: [],
          subIsOpen: false,
          open: process.env.route_notice,
          targetEnabled: false
        },
        {
          name: '共筆文件',
          url: 'https://hackmd.io/@mopcon/2020',
          subNav: [],
          subIsOpen: false,
          open: process.env.route_note,
          targetEnabled: true
        },
        {
          name: '歷年 MOPCON',
          url: '',
          subNav: Array.from(Array(currentYear - startYear).keys())
            .map(function (item) {
              return {
                open: true,
                url: `https://mopcon.org/${startYear + item}/`,
                name: startYear + item
              }
            }),
          subIsOpen: true,
          open: '',
          targetEnabled: true
        },
        {
          name: '歷年相簿',
          url: 'https://mopcon.org/album.php',
          subNav: [],
          subIsOpen: false,
          open: false,
          targetEnabled: true
        }
      ],
      historyLink: Array.from(Array(currentYear - startYear).keys())
        .map(item => `https://mopcon.org/${startYear + item}/`),
      nowSubOpen: ''
    }
  },
  computed: {
    navOpenList () {
      return this.navList.filter(nav => nav.open !== false)
    }
  },
  watch: {
    navOpen (val) {
      if (val) {
        document.querySelector('body').classList.add('custom-overflow-hidden')
      } else {
        document.querySelector('body').classList.remove('custom-overflow-hidden')
      }
    }
  },
  methods: {
    toggleSubNav (name, hasSub) {
      if (hasSub) {
        this.nowSubOpen !== name ? (this.nowSubOpen = name) : (this.nowSubOpen = '')
      } else {
        this.nowSubOpen = ''
      }
    },
    setTarget (targetEnabled) {
      return targetEnabled ? '_blank' : '_self'
    },
    closeNav () {
      if (this.isMobile) {
        this.$emit('update', !this.navOpen)
      }
    },
    checkOpen (data) {
      return data.filter(item => item.open)
    }
  }
}
</script>

<style lang="scss" scoped>
// logo
@import '~@/assets/styles/_mix';
$logo_map: (
  svg: mopcon fb twitter ig telegram
);
@include logo_map_mix(base);
nav {
  height: 43px;
  @apply bg-blue-900 text-white relative border-yellow-500 border-b;
  &.navActive {
    @media (max-width: 487px) {
      @apply bg-gray-700;
      .navbar-mobile {
        top: 42px;
      }
    }
  }
  .logo-box {
    @apply mr-auto;
  }
  .logo {
    width: 99px;
    height: 12px;
    @apply mt-1;
  }
  .navbar-mobile {
    max-width: 487px;
    transform: translateX(100%);
    transition: all .6s ease-out;
    z-index: -1;
    top: 43px;
    @apply bg-gray-700 fixed right-0 bottom-0 text-center w-full h-full pt-8 overflow-y-auto pb-12;
    > li {
      @apply py-2 h-auto;
    }
    .history-link {
      transition: all .6s ease-in-out;
      // transform: scaleY(0);
      transform-origin: top;
      top: -100%;
      @apply bg-gray-700 text-white border-0 leading-8;
      li {
        @apply p-0;
      }
      &_active {
        top: 0px;
        transform: scaleY(1);
        @apply  h-auto opacity-100;
      }
    }
    &::before {
      // content: '';
      transition: all .6s ease-out;
      @apply absolute top-0 left-0 w-full bg-gray-700 h-full;
    }
    &_active {
      // transition start
      transform: translateX(0%);
      transition: all .6s ease-out;
      @apply h-full z-50;
    }
  }
  a {
    letter-spacing: 1px;
  }
  .navbar-mobile-btn {
    height: 50%;
    transition: all .5s;
    @apply w-8 mr-4 relative;
    &::after, &::before {
      content: '';
      bottom: 4px;
      transition: all .5s;
      @apply absolute right-0 h-1 w-4 bg-white;
    }
    &::before {
      top: 4px;
      height: 2px;
      @apply left-0 w-8;
    }
    &_active {
      &::after, &::before {
        transform: rotate(210deg);
        height: 2px;
        top: 10px;
        @apply w-full;
      }
      &::before {
        transform: rotate(-210deg);
      }
    }
  }
  .icon-arrow {
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid white;
    transform: translateY(-3px);
    @apply w-0 h-0 inline-block;
  }
  .history-link {
    top: calc(100% + 1px);
    @apply w-full z-10 flex-col items-start text-white py-2 leading-7 bg-gray-700;
    @screen lg {
      @apply hidden absolute bg-gray-700;
    }
    li {
      @apply w-full cursor-pointer;
    }
  }
  .history-mopcon {
    @apply relative cursor-pointer;
    &:before {
      content: '';
      @apply absolute top-0 left-0 w-full h-12 bg-transparent;
    }
  }
  .line {
    height: 1px;
    top: 43px;
    opacity: 0;
    z-index: -1;
    @apply w-full absolute;
  }
  .line-leave-active {
    animation: line .7s linear .3s;
    @apply bg-teal-400;
  }
}

.logo {
  @apply inline-block;
}
@screen lg {
  .navbar > li.hasSub > a:hover {
    & + .history-link {
      @apply block;
    }
  }
  nav {
    height: 64px;
    .logo-box {
      @apply mr-0;
    }
    .logo {
      width: 140px;
      height: 20px;
    }
    .navbar {
      @apply flex h-full justify-around items-center ml-auto;
      > li {
        @apply h-full;
      }
      > li > a {
        @apply px-4 flex items-center h-full;
      }
      > li > a:hover {
        @apply text-yellow-500 border-teal-400;
        .icon-arrow {
          border-top: 5px solid #4dd0e1;
        }
      }
      &-mobile-btn {
        @apply hidden;
      }
    }
    .history-mopcon:hover .history-link {
      @apply flex;
    }
    .history-link:hover {
      @apply block;
    }
    .history-link li a:hover {
      @apply text-yellow-500;
    }
    .line {
      @apply hidden;
    }
  }
}
.hasSubMobile {
  max-height: 40px;
  transition: all 1.2s;
  @apply overflow-hidden;
  .history-link {
    display: none;
  }
  .mobile-subicon {
    position: relative;
  }
  .mobile-subicon::before {
    position: absolute;
    font-family: 'Material Icons';
    content: "add";
    -webkit-font-feature-settings: 'liga';
    vertical-align: bottom;
    width: 16px;
    height: 16px;
    left: -20px;
  }
  &.active {
    max-height: 100%;
    .history-link {
      display: flex;
    }
    .mobile-subicon::before {
      content: "remove";
    }
  }
}
.history-link li a {
  @apply block text-center text-yellow-300;
  @screen lg {
    @apply text-white py-2;
  }
  span {
    @apply border-b border-transparent py-1;
    @screen lg {
      @apply border-0;
    }
  }
  &:hover {
    span {
      @apply border-white;
    }
  }
}
</style>
