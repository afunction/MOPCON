<template>
  <ul class="contact">
    <li v-if="links.link_fb">
      <a target="_blank" :href="links.link_fb" class="logo logo-fb" />
    </li>
    <li v-if="links.link_twitter">
      <a target="_blank" :href="links.link_twitter" class="logo logo-twitter" />
    </li>
    <li v-if="links.link_github">
      <a target="_blank" :href="links.link_github" class="logo logo-git" />
    </li>
    <li v-if="links.link_other">
      <a target="_blank" :href="links.link_other" class="logo logo-web" />
    </li>
  </ul>
</template>

<script>
export default {
  name: 'SpeakerContact',
  props: {
    links: {
      type: [Object, undefined],
      default: () => {}
    }
  }
}
</script>

<style scoped lang="scss">
// logo
@import '~@/assets/styles/_mix';
$logo_map: (
  png: fb git twitter web,
);
@include logo_map_mix(speaker);

.contact {
  @apply flex w-full justify-center mb-3;
  li {
    @apply mx-2;
  }
  a {
    width: 24px;
    height: 24px;
    @apply inline-block;
  }
  @screen md {
    width: 155px;
    @apply static justify-center mt-8;
    li {
      @apply mr-2;
    }
  }
}
</style>
