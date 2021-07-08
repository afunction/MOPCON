<template>
    <section class="section section-speaker">
        <h2 class="title"><span>{ 講者</span><span class="color-primary">介紹</span><span>; }</span></h2>

        <div class="section-speaker__content">
            <!-- KEYNOTES 講者 -->
            <h3 class="section-speaker__content__title">KEYNOTES</h3>
            <div class="speakers-keynotes">
                <a class="speakers-keynotes__item" v-for="item in getSpeakerById(speakerKeynotes)" :href="item.link_speaker" :key="item.speaker_id">
                    <p class="speakers-keynotes__item__title">{{item.topic}}</p>
                    <div class="speakers-keynotes__item__content">
                        <img :src="item.img.web" :alt="item.name" class="speakers-keynotes__item__avatar">
                        <p class="speakers-keynotes__item__name">{{item.name}}</p>
                        <p class="speakers-keynotes__item__company">{{item.company}}</p>
                    </div>
                </a>
            </div>

            <!-- 職涯論壇 講者 -->
            <h3 class="section-speaker__content__title">職涯論壇</h3>
            <p class="section-speaker__content__subtitle">接下來要繼續當工程師，或者轉職到管理職？</p>
            <div class="speakers">
                <a class="speakers__item"
                    :href="item.link_speaker"
                    v-for="item in getSpeakerById(speakerCareers)"
                    :key="item.speaker_id">
                    <img :src="item.img.web" :alt="item.name" class="speakers__item__avatar">
                    <p class="speakers__item__name">{{item.name}}</p>
                    <p class="speakers__item__company">{{item.company}}</p>
                </a>
            </div>
        </div>

        <a href="speaker" class="section-speaker__more">看更多講者</a>
    </section>
</template>

<script>
export default {
    name: 'sectionSpeaker',
    data() {
        return {
            speakerKeynotes: [1, 2],
            speakerCareers: [38, 39, 40],
            speakers: [],
        };
    },
    methods: {
        // 依據陣列 id 找出對應講者資料
        getSpeakerById(speakerIds) {
            if (speakerIds.length === 0 || this.speakers.length === 0)
                return [];

            const speakers = [];
            speakerIds.forEach(id => {
                const speaker = this.speakers.find(
                    item => item.speaker_id === id
                );

                // 新增講者超連結完後才新增
                if (speaker) {
                    speaker.link_speaker = `${process.env.baseUrl}/2019/speaker/${id}`;
                    speakers.push(speaker);
                }
            });
            return speakers;
        },
        async getSpeakerData() {
            try {
                const { status, data } = await this.$axios.get(
                    '/api/2019/speaker'
                );
                if (
                    status === 200 &&
                    data &&
                    data.data &&
                    data.data.length > 0
                ) {
                    this.speakers = data.data;
                }
            } catch (err) {
                console.log('err', err);
            }
        },
    },
    mounted() {
        this.getSpeakerData();
    },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
