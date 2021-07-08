<template>
    <section class="section section-fb-news">
        <h2 class="title">{ 最新動態 ; }</h2>
        <div class="posts">
            <a :href="post.url" target="_blank" class="post" v-for="post in posts" :key="post.id">
                <div class="post__head">
                    <IconLogo class="post__head__logo" />
                    <p class="post__head__title">Mobile Open Platform Conference</p>
                </div>
                <img class="post__review" :src="post.full_picture">
                <div class="post__text">
                    {{post.message}}
                </div>
                <ul class="post__icons">
                    <li class="post__icon">
                        <IconLike />
                        <span class="post__icon__count">{{post.likes}}</span>
                    </li>
                    <li class="post__icon">
                        <IconMsg />
                    </li>
                    <li class="post__icon">
                        <IconShare />
                        <span class="post__icon__count">{{post.shares}}</span>
                    </li>
                    <li class="post__icon">
                        <IconFb />
                    </li>
                </ul>
            </a>
        </div>
        <a class="section-fb-news__link" href="https://www.facebook.com/mopcon/" target="_blank">
            <span>VIEW MORE ON FACEBOOK</span>
            <IconLink class="section-fb-news__link__icon" />
        </a>
    </section>
</template>

<script>
import IconLink from "./svg/icon-link.svg";
import IconLogo from "./svg/icon-logo.svg";
import IconLike from "./svg/icon-like.svg";
import IconMsg from "./svg/icon-msg.svg";
import IconShare from "./svg/icon-share.svg";
import IconFb from "./svg/icon-fb.svg";

export default {
    name: "fb-news",
    components: {
        IconLink,
        IconLogo,
        IconLike,
        IconMsg,
        IconShare,
        IconFb,
    },
    data() {
        return {
            posts: [],
        };
    },
    mounted() {
        this.$axios
            .$get("/api/2019/facebook/posts")
            .then(({ success, data, message }) => {
                if (success) {
                    this.posts = [...data];
                } else {
                    console.log("error", message);
                }
            })
            .catch(error => {
                console.log(error);
            });
    },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
