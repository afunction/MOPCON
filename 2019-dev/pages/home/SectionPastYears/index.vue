<template>
    <div class="section sectionPastYears">
        <h2 class="title"><span>{ 歷年 </span><span class="color-primary">MOPCON</span><span> ; }</span></h2>

        <div class="slider">
            <div class="slider-navigation">
                <div class="swiper-button-prev" slot="button-prev"></div>
                <div class="swiper-button-next" slot="button-next"></div>
            </div>
            <div v-swiper:mySwiper="swiperOption" class="slider-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" v-for="year in years" :key="year.id">
                        <a :href="`${year.link}`" target="_blank" class="swiper-slide__inner">
                            <div class="swiper-slide__image" :style="`background-image: url(${require(`./images/${year.image}`)})`"></div>
                        </a>
                        <p class="swiper-slide__year">{{year.year}}</p>
                    </div>
                </div>
            </div>
        </div>

        <Btn class="sectionPastYears__btn">
            <a class="sectionPastYears__btn__link" href="https://www.youtube.com/playlist?list=PL0ny0trU2gnCzF7YZgXzwyj5dpQFp740U" target="_blank">
                <span class="icon-play"></span><span>2019 影片回顧</span>
            </a>
        </Btn>
    </div>
</template>

<script>
import Btn from "~/components/Btn";

export default {
    name: "sectionPastYears",
    components: {
        Btn
    },
    data() {
        return {
            years: [
                {
                    id: 0,
                    year: "2019",
                    image: "2019.jpg",
                    link: "https://mopcon.org/album.php#mp2019"
                },
                {
                    id: 1,
                    year: "2018",
                    image: "2018.jpg",
                    link: "https://mopcon.org/album.php#mp2018"
                },
                {
                    id: 2,
                    year: "2017",
                    image: "2017.jpg",
                    link: "https://mopcon.org/album.php#mp2017"
                },
                {
                    id: 3,
                    year: "2016",
                    image: "2016.jpg",
                    link: "https://mopcon.org/album.php#mp2016"
                },
                {
                    id: 4,
                    year: "2015",
                    image: "2015.jpg",
                    link: "https://mopcon.org/album.php#mp2015"
                },
                {
                    id: 5,
                    year: "2014",
                    image: "2014.jpg",
                    link: "https://mopcon.org/album.php#mp2014"
                }
            ],
            swiperOption: {
                slidesPerView: "auto",
                spaceBetween: 20,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                }
            }
        };
    }
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
