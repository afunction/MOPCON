<template>
  <div id="survey" class="logo-bg pb-20 pt-8" style="min-height: calc(100vh - 63px - 160px);">
    <section class="container mx-auto flex flex-col items-center mb-6 top overflow-x-hidden">
      <div class="logo logo-speaker-title" />
      <div class="relative h-full top">
        <h2 class="relative mt-10 mb-12 md:text-4xl text-3xl text-white text-center z-10">
          <div class="logo logo-circles logo-circles-l" />MOPCON
          <span class="text-yellow-500">會後問卷</span>
          <div class="logo logo-circles logo-circles-r" />
        </h2>
      </div>
    </section>
    <section class="container mx-auto">
      <a class="btn-primary" href="https://www.surveycake.com/s/mDYkB" target="_blank">會後問卷</a>
    </section>
  </div>
</template>

<script>
export default {
  name: 'Survey',
  mounted () {
    location.href = 'https://www.surveycake.com/s/mDYkB'
  }
}
</script>

<style>
.btn-primary {
  width: auto;
  @apply block mx-auto text-center;
}
.btn-primary.disabled {
  pointer-events: none;
}
@screen md {
  .btn-primary {
    width: 40%;
    @apply px-40;
  }
}
</style>
