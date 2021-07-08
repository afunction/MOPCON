<template>
  <div id="ticket" class="logo-bg pt-16">
    <div class="logo-main header-width" />
    <section class="container mx-auto flex flex-col items-center mb-16 top overflow-x-hidden">
      <div class="logo logo-speaker-title" />
      <div class="relative h-full">
        <h2 class="relative mt-16 mb-12 md:text-3xl text-2xl text-white text-center z-10 md:px-6 md:py-4">
          <div class="logo logo-circles logo-circles-l" />
          現在就跟我們 <span class="text-yellow-500 md:inline-block block">一起參與這場盛會</span>
          <div class="logo logo-circles logo-circles-r" />
        </h2>
        <h3 class="background-title md:block hidden">
          CON WITH US
        </h3>
      </div>
      <p class="header-width text-white">
        不管你是新手入村，還是專家級高手，都歡迎共同參與每天精彩的議程。我們針對不同族群需求，開出各種票種，就是希望每個人都可以找到最適合自己的方案，年輕學生可以選擇以划算價格來現場見到心中的大神，或你是超級 VIP，就可以享有更多好康。
      </p>
    </section>
    <div class="container mx-auto">
      <div class="logo logo-hr" />
    </div>

    <h3 class="relative mt-16 mb-12 text-3xl text-white text-center">
      票種<span class="text-yellow-500">介紹</span>
    </h3>
    <!-- 票種介紹 -->
    <section class="mb-32">
      <div class="container mx-auto">
        <h4 class="text-purple-400 text-2xl">
          一般票種
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 md:gap-8 gap-4 mt-6">
          <ticketCard v-for="ticket in ticketData.normalTicket" :key="'normalTicket' + ticket.id" :ticket-data="ticket" />
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 md:gap-8 gap-4 mt-20 mb-24">
          <div class="">
            <h4 class="text-yellow-500 text-2xl">
              VIP 票
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 md:gap-8 gap-4 mt-6">
              <ticketCard v-for="ticket in ticketData.vipTicket" :key="'specialTicket' + ticket.id" :ticket-data="ticket" />
            </div>
          </div>
          <div class="lg:mt-0 mt-6">
            <h4 class="text-purple-400 text-2xl">
              開源貢獻票
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 md:gap-8 gap-4 my-6">
              <ticketCard v-for="ticket in ticketData.studentTicket" :key="'specialTicket' + ticket.id" :ticket-data="ticket" />
            </div>
          </div>
        </div>
      </div>
    </section>
    <app-section />
  </div>
</template>

<script>
import AppSection from '@/components/AppSection'
import ticketCard from './ticketCard'
export default {
  name: 'Ticket',
  components: {
    ticketCard,
    AppSection
  },
  data () {
    return {
      ticketData: {
        normalTicket: [
          {
            title: '會眾票',
            id: 1,
            status: 2, // 0 => 敬請期待, 1 => 顯示價格, 2 => 已完售
            count: 400,
            price: 800,
            class: {
              bg: 'bg-purple-700',
              text: 'text-white',
              btn: 'btn-white',
              cardBg: 'normal-card-bg-circle'
            },
            description: '',
            lists: ['兩日議程'],
            link: 'https://mopcon.kktix.cc/events/2020-general'
          },
          {
            title: '社群優惠票',
            id: 2,
            status: 2,
            count: 300, // 限量張數
            price: 700, // 票價
            class: {
              bg: 'bg-purple-700',
              text: 'text-white',
              btn: 'btn-white',
              cardBg: 'normal-card-bg-circle'
            },
            description: '需以老鳥、社群、志工優惠碼購票',
            lists: ['兩日議程'], // 項目說明
            link: 'https://mopcon.kktix.cc/events/2020-general'
          },
          {
            title: '團購優惠票',
            id: 3,
            status: 2,
            count: 100, // 限量張數
            price: 700, // 票價
            class: {
              bg: 'bg-purple-700',
              text: 'text-white',
              btn: 'btn-white',
              cardBg: 'normal-card-bg-circle'
            },
            description: '最低起購五張',
            lists: ['兩日議程'], // 項目說明
            link: 'https://mopcon.kktix.cc/events/2020-group'
          }
          // {
          //   title: '現場票',
          //   id: 4,
          //   status: 0,
          //   count: 10, // 限量張數
          //   price: 1000, // 票價
          //   class: {
          //     bg: 'bg-purple-700',
          //     text: 'text-white',
          //     btn: 'btn-white',
          //     cardBg: 'normal-card-bg-circle'
          //   },
          //   description: '',
          //   lists: ['兩日議程'], // 項目說明
          //   link: ''
          // }
        ],
        vipTicket: [
          {
            title: '豪華獨享 VIP',
            id: 5,
            status: 2,
            count: 20, // 限量張數
            price: 2600, // 票價
            class: {
              bg: 'bg-yellow-500',
              text: '',
              btn: 'btn-dark text-yellow-500',
              cardBg: 'vip-card-bg-circle'
            },
            description: '',
            lists: ['兩日議程', '精緻午餐', '快速通關', '紀念 T', '晚宴'], // 項目說明
            link: 'https://mopcon.kktix.cc/events/2020-vip'
          },
          {
            title: '尊絕不凡',
            id: 6,
            status: 2,
            count: 10, // 限量張數
            price: 3200, // 票價
            class: {
              bg: 'bg-yellow-500',
              text: '',
              btn: 'btn-dark text-yellow-500',
              cardBg: 'vip-card-bg-circle'
            },
            description: '',
            lists: ['兩日議程', '精緻午餐', '快速通關', '紀念 T', '獨家紀念品', '晚宴'], // 項目說明
            link: 'https://mopcon.kktix.cc/events/2020-vip'
          }
        ],
        studentTicket: [
          {
            title: '開源貢獻票',
            id: 7,
            status: 2,
            count: 100, // 限量張數
            price: 400, // 票價
            class: {
              bg: 'bg-purple-400',
              text: '',
              btn: 'btn-white text-purple-700',
              cardBg: 'card-img-wave'
            },
            description: '需以優惠碼購票',
            lists: ['兩日議程'], // 項目說明
            link: 'https://mopcon.kktix.cc/events/2020-general'
          }
        ]
      }
    }
  },
  head () {
    return {
      title: '票種介紹 | MOPCON 2020'
    }
  }
}
</script>

<style lang="scss" src="./style.scss" scoped></style>
