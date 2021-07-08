<template>
  <section class="section-fb-news container">
    <h2 class="title">
      最新動態
    </h2>
    <div class="posts">
      <a v-for="post in posts" :key="post.id" :href="post.url" target="_blank" class="post">
        <div class="post__head">
          <div class="logo logo-mopcon-icon post__head__logo" />
          <p class="post__head__title">Mobile Open Platform Conference</p>
        </div>
        <img class="post__review" :src="post.full_picture">
        <div class="post__text">
          {{ post.message }}
        </div>
        <ul class="post__icons">
          <li class="post__icon">
            <div class="logo logo-like" />
            <span class="post__icon__count">{{ post.likes }}</span>
          </li>
          <li class="post__icon">
            <div class="logo logo-message" />
          </li>
          <li class="post__icon">
            <div class="logo logo-share" />
            <span class="post__icon__count">{{ post.shares }}</span>
          </li>
          <li class="post__icon">
            <div class="logo logo-facebook" />
          </li>
        </ul>
      </a>
    </div>
    <!-- <a class="section-fb-news__link" href="https://www.facebook.com/mopcon/" target="_blank">
      <span>VIEW MORE ON FACEBOOK</span>
      <span class="logo logo-launch" />
    </a> -->
  </section>
</template>

<script>
export default {
  name: 'FbNews',
  props: {
    posts: {
      type: Array,
      default: () => []
    }
  }
}
</script>

<style lang="scss" scoped>
// logo
@import '~@/assets/styles/_mix';
$logo_map: (
  png: facebook like share message mopcon-icon
);
@include logo_map_mix(card);

.logo {
  width: 27px;
  height: 27px;
  // &-launch {
  //   background-image: url('~@/assets/home/launch.svg');
  // }
}

.section-fb-news {
  display: flex;
  flex-flow: column nowrap;
  overflow: hidden;

  .title {
    margin-bottom: 40px;
  }

  .posts::-webkit-scrollbar {
    width: 3px;
    height: 3px;
    border-radius: 3px;
    background-color: #101721;
  }

  .posts::-webkit-scrollbar-thumb {
    border-radius: 3px;
    @apply bg-yellow-500;
  }

  .posts {
    display: flex;
    flex-flow: row wrap;
    overflow-x: hidden;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    width: 92%;
    height: 75vh;
    margin: 0 auto;
    @screen md {
      width: calc(100% + 40px);
      height: 80vh;
      margin-left: -20px;
    }
  }

  .post {
    display: flex;
    flex-flow: column nowrap;
    background: transparent;
    width: 100%;
    margin: 20px 0;
    @screen md {
      width: calc(50% - 20px);
      margin: 20px 10px;
    }
    @apply border border-yellow-500;
    &:hover {
      background: rgba(#fff, 0.05);
    }

    &__head {
      display: flex;
      align-items: center;
      padding: 18px 20px 16px 20px;

      &__logo {
        margin-right: 16px;
      }

      &__title {
        color: #f0f1f2;
        letter-spacing: 0.8px;
      }
    }

    &__review {
      width: 100%;
    }

    &__text {
      font-size: 16px;
      line-height: 1.5;
      letter-spacing: 0.8px;
      padding: 18px 16px;
      word-break: break-all;
      @screen sm {
        padding: 25px 35px;
      }
    }

    &__icons {
      display: flex;
      margin-top: auto;
      padding: 45px 20px 21px 20px;
      @screen sm {
        padding: 50px 25px 15px;
      }
    }

    &__icon {
      display: flex;
      align-items: center;
      margin-right: 32px;

      &__count {
        margin-left: 9px;
        color: #f0f1f2;
        font-size: 16px;
        line-height: 1.5;
        letter-spacing: 0.8px;
      }
    }

    &__icon:last-child {
      margin: 0 0 0 auto;
    }
  }

  // &__link {
  //   display: flex;
  //   align-items: center;
  //   margin-top: 20px;
  //   margin-left: auto;
  //   padding-right: 10px;
  //   color: #fff;
  //   font-size: 16px;
  //   font-weight: normal;
  //   letter-spacing: 0.8px;

  //   &__icon {
  //     margin-top: 3px;
  //     margin-left: 8px;
  //   }
  // }
}
</style>
