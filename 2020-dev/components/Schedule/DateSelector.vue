<template>
  <section class="container flex justify-center mb-12 mx-auto">
    <div class="btn-group">
      <button
        v-for="(date, idx) in dates"
        :key="`data-${idx}`"
        :class="{'active': date === activeDate}"
        @click="$emit('update:activeDate', date)"
      >
        {{ $moment.unix(date).format('MM/DD(dd)') }}
      </button>
    </div>
  </section>
</template>

<script>
export default {
  name: 'DateSelector',
  props: {
    dates: {
      type: Array,
      default: () => []
    },
    activeDate: {
      type: Number,
      default: 0
    }
  }
}
</script>

<style lang="scss" scoped>
// 日期搜尋區
.btn-group{
  @apply inline-flex;
  & > button{
    letter-spacing:0.4px;
    color:rgba(241,188,24,0.6);
    @apply font-bold py-4 px-10 border border-2 border-yellow-500 outline-none;
    @screen sm{
      @apply px-12;
    }
    &:hover, &.active {
      color: #001333;
      @apply bg-yellow-500;
    }
  }
}
.btn-group > button:first-child {
  @apply rounded-l-lg border-r-0;
}
.btn-group > button:last-child {
  @apply rounded-r-lg;
}
</style>
