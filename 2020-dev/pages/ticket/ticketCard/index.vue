<template>
  <a
    v-if="ticketData.class"
    href="#"
    :class="[ticketData.class.bg, ticketData.class.text, ticketData.class.cardBg, {'disabled': ticketData.status !== 1}]"
    class="card-ticket rounded-md px-6 py-4 flex flex-col relative overflow-hidden lg:mb-0 mb-4"
    style="min-height: 360px"
    @click.prevent="openLink(ticketData.link, ticketData.title, ticketData.price)"
  >
    <div>
      <div class="flex justify-between items-center flex-wrap">
        <h4 class="text-xl font-bold">
          {{ ticketData.title }}
        </h4>
        <p>限量 {{ ticketData.count }} 名</p>
      </div>
      <ul class="mt-4">
        <li v-for="(goods, index) in ticketData.lists" :key="index" class="checkmark mb-2">
          {{ goods }}
        </li>
      </ul>
      <p class="mt-6">
        {{ ticketData.description }}
      </p>
    </div>
    <button class="btn mt-auto mx-auto font-bold" :class="ticketData.class.btn">
      {{ ticketStatusText(ticketData.status, ticketData.price) }}
    </button>
  </a>
</template>

<script>
/* global ga, fbq */
export default {
  props: {
    ticketData: {
      type: Object,
      default () {
        return {}
      }
    }
  },
  methods: {
    ticketStatusText (status, price = '') {
      if (status === 0) {
        return '敬請期待'
      } else if (status === 1) {
        return `NT$ ${price}`
      } else if (status === 2) {
        return '已完售'
      }
    },
    openLink (link, type, price = 0) {
      if (window.ga) {
        ga('send', 'event', 'Ticket', 'Purchase', type)
      }
      if (window.fbq) {
        fbq('track', 'ViewContent', {
          content_name: type,
          content_type: 'product',
          currency: 'TWD',
          value: price
        })
      }
      window.open(link)
    }
  }
}
</script>

<style lang="scss" src="./style.scss" scoped>

</style>
