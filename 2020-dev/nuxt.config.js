const path = require('path')
const axios = require('axios')
require('dotenv').config()

module.exports = {
  mode: 'universal',
  /*
  ** Headers of the page
  */
  head: {
    htmlAttrs: {
      lang: 'zh-Hant'
    },
    title: '行動科技年會 2020 | Mobile / Open / Platform Conference',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0' },
      { 'http-equiv': 'X-UA-Compatible', content: 'ie=edge' },
      { hid: 'description', name: 'description', content: 'MOPCON 2020 堅持濁水溪以南，南台灣最大行動科技年會，10/24 -10/25 高雄國際會議中心與您見面。持續匯集知識與人才，打造高速資訊交流圈，提升個人與團隊價值，讓知識影響正向循環。' },
      // fb seo
      {
        hid: 'og-title',
        property: 'og:title',
        content: '行動科技年會 2020 | Mobile / Open / Platform Conference'
      },
      {
        hid: 'og-description',
        property: 'og:description',
        content:
          'MOPCON 2020 堅持濁水溪以南，南台灣最大行動科技年會，10/24 -10/25 高雄國際會議中心與您見面。持續匯集知識與人才，打造高速資訊交流圈，提升個人與團隊價值，讓知識影響正向循環。'
      },
      { hid: 'og-type', property: 'og:type', content: 'website' },
      {
        hid: 'og-site_name',
        property: 'og:site_name',
        content: '行動科技年會 2020 | Mobile / Open / Platform Conference'
      },
      {
        hid: 'og-url',
        property: 'og:url',
        content: 'https://mopcon.org/2020/'
      },
      {
        hid: 'og-image',
        property: 'og:image',
        content: '/2020/og-image.png'
      },
      { hid: 'og-locale', property: 'og:locale', content: 'zh_tw' },
      // twitter seo
      { hid: 'twitter-card', name: 'twitter:card', content: 'app' },
      {
        hid: 'twitter-site',
        name: 'twitter:site',
        content: '行動科技年會 2020 | Mobile / Open / Platform Conference'
      },
      {
        hid: 'twitter-description',
        name: 'twitter:description',
        content:
          'MOPCON 2020 堅持濁水溪以南，南台灣最大行動科技年會，10/24 -10/25 高雄國際會議中心與您見面。持續匯集知識與人才，打造高速資訊交流圈，提升個人與團隊價值，讓知識影響正向循環。'
      },
      {
        hid: 'twitter-app:name:iphone',
        name: 'twitter:app:name:iphone',
        content: '行動科技年會 2020 | Mobile / Open / Platform Conference'
      },
      {
        hid: 'twitter-app:name:ipad',
        name: 'twitter:app:name:ipad',
        content: '行動科技年會 2020 | Mobile / Open / Platform Conference'
      }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/2020/favicon.ico' },
      { rel: 'stylesheet', href: 'https://fonts.googleapis.com/icon?family=Material+Icons' },
      { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css2?family=Poppins&display=swap' },
      { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap' }
    ]
  },
  /*
  ** Customize the progress-bar color
  */
  loading: { color: '#fff' },
  /*
  ** Global CSS
  */
  css: [
    '~assets/styles/all.scss',
    '~assets/styles/_base.scss'
  ],
  /*
  ** Plugins to load before mounting the App
  */
  plugins: [
    { src: '~/plugins/vue-awesom-swiper', mode: 'client' },
    { src: '~/plugins/pixel', mode: 'client' },
    { src: '~/plugins/ga', mode: 'client' },
    { src: '~/plugins/jsonld' }
  ],
  /*
  ** Nuxt.js dev-modules
  */
  buildModules: [
    // Doc: https://github.com/nuxt-community/eslint-module
    '@nuxtjs/eslint-module',
    '@nuxtjs/style-resources',
    '@nuxtjs/tailwindcss',
    '@nuxtjs/moment',
    'vue-social-sharing/nuxt'
  ],
  styleResources: {
    scss: ['./assets/styles/variables.scss']
  },
  /*
  ** Nuxt.js modules
  */
  modules: [
    // Doc: https://axios.nuxtjs.org/usage
    '@nuxtjs/axios',
    '@nuxtjs/pwa',
    // Doc: https://github.com/nuxt-community/dotenv-module
    '@nuxtjs/dotenv',
    '@nuxtjs/sitemap',
    'cookie-universal-nuxt', ['cookie-universal-nuxt', { parseJSON: true }]
  ],
  sitemap: {
    path: '/sitemap.xml',
    hostname: `${process.env.BASE_URL}`,
    exclude: [
      '/speaker/*/*',
      '/ticket/*',
      '/home/*/*',
      '/schedule/*'
    ],
    routes: async () => {
      const { data } = await axios.get(`${process.env.BASE_URL}/api/2020/speaker`)
      return data.data.map(speaker => `/speaker/${speaker.speaker_id}`)
    }
  },
  env: {
    covid_cookie_expire: process.env.COVID_COOKIE_EXPIRE || 3,
    BASE_URL: process.env.BASE_URL || 'http://localhost:3000',
    buyTicketUrl: '',
    // route 變數前面加 route_
    route_speaker: process.env.SPEAKER !== 'false',
    route_schedule: process.env.SCHEDULE !== 'false',
    route_schedule_unconf: process.env.SCHEDULE_UNCONF !== 'false',
    route_sponsor: process.env.SPONSOR !== 'false',
    route_community: process.env.COMMUNITY !== 'false',
    route_ticket: process.env.TICKET !== 'false',
    route_notice: process.env.NOTICE !== 'false',
    route_note: process.env.NOTE !== 'false'
  },
  /*
  ** Axios module configuration
  ** See https://axios.nuxtjs.org/options
  */
  axios: {
    baseURL: `${process.env.PROXY_URL}${process.env.BASE_URL}`
  },
  /*
  ** Build configuration
  */
  build: {
    /*
    ** You can extend webpack config here
    */
    extend (config, ctx) {
      // Run ESLint on save
      if (ctx.isDev && ctx.isClient) {
        config.module.rules.push({
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /(node_modules)/
        })
      }
    }
  },
  router: {
    base: path.resolve(__dirname, '/2020/'),
    middleware: 'route'
  },
  generate: {
    dir: path.resolve(__dirname, '../2020/'),
    // 從 api 抓取所有講者 id 後動態產生所有講者 html 頁面
    routes () {
      const pages = [
        '/edashboard/R1',
        '/edashboard/R2',
        '/edashboard/R3',
        '/survey'
      ]
      const speakers = axios.get(`${process.env.BASE_URL}/api/2020/speaker`).then((res) => {
        pages.push('/speaker')
        res.data.data.forEach((speaker) => {
          pages.push(`/speaker/${speaker.speaker_id}`)
        })
      })
      const sponsors = axios.get(`${process.env.BASE_URL}/api/2020/sponsor`).then((res) => {
        pages.push('/sponsor')
        res.data.data.forEach((item) => {
          item.data.forEach((sponsor) => {
            pages.push(`/sponsor/${sponsor.sponsor_id}`)
          })
        })
      })
      const flatDeep = (arr, d = 1) => {
        return d > 0 ? arr.reduce((acc, val) => acc.concat(Array.isArray(val) ? flatDeep(val, d - 1) : val), [])
          : arr.slice()
      }
      const schedules = axios.get(`${process.env.BASE_URL}/api/2020/session`).then((res) => {
        pages.push('/schedule')
        const allRooms = flatDeep(res.data.data.map(item => item.period.map(s => s.room)), 2)
        allRooms.forEach((room) => {
          pages.push(`/schedule/${room.session_id}`)
        })
      })

      return Promise.all([speakers, sponsors, schedules]).then(() => {
        return pages
      })
    }
  },
  moment: {
    locales: ['zh-tw']
  }
}
