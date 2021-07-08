<template>
    <section class="section section-about">
        <h2 class="title"><span>{ 關於 </span><span class="color-primary">MOPCON</span><span>; }</span></h2>
        <RunNumber class="runNumber" />
        <div class="section-about__content">
            <div class="section-about__img"></div>
            <div class="section-about__info">
                <h3 class="subtitle"># <span class="color-secondary">堅持濁水溪以南最大最 Skr 的千人開源年會</span></h3>
                <h3 class="subtitle"># <span class="color-secondary">努力七年成為台灣三大開源年會之一</span></h3>
                <p>MOPCON 為熱愛「科技」的民間好手所自發的活動，今年邁入第 8 年囉！每年吸引跨產業參加人數持續攀升，去年達到近 1000 人，可稱史上南台灣最大科技年會！</p>
                <p>今年籌劃共計動用約 100 位工作人員，期望帶給大家更驚豔、更豐富的行動科技年會。2019 年的議程核心導向以 AI (人工智慧)、Quant (量化投資) 為主，當然一樣會將 Moblie APP (行動科技) 、UI/UX、IoT 作為我們一貫的討論重點。</p>
                <p>透過每年堅持的交流盛會，持續匯集知識、人才與資源，打造高速資訊交流圈，也促進人才流動與就業機會，帶動南台灣高經濟產業循環 。相信每個參與者都能將這些知識與資源帶回自己公司、團隊，讓這份能力產生更大的影響力。</p>
            </div>
        </div>
    </section>
</template>

<script>
import RunNumber from "~/components/RunNumber";

export default {
    name: "sectionAbout",
    components: {
        RunNumber
    }
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
