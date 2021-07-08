<template>
    <div class="navbar">
        <div class="navbar__items">
            <div class="navbar__item"
                :class="[`nav__${item.name} ${nextStatus}`, {active: item.id === currentActive}]"
                v-for="item in sections"
                :key="item.id"
                @click="gotoSection(item)">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "navbar",
    props: {
        isReady: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            currentActive: 0,
            nextStatus: "",
            stopScrollMagic: false,
            sections: [
                {
                    id: 0,
                    name: "sectionHero",
                },
                {
                    id: 1,
                    name: "sectionImageWall",
                },
                {
                    id: 2,
                    name: "sectionSpeaker",
                },
                {
                    id: 3,
                    name: "sectionAbout",
                },
                {
                    id: 4,
                    name: "sectionPlace",
                },
                {
                    id: 5,
                    name: "sectionSponsorCore",
                },
                {
                    id: 6,
                    name: "sectionFbNews",
                },
                {
                    id: 7,
                    name: "sectionPastYears",
                },
            ],
            scrollController: null,
            scrollMagicObj: {}
        };
    },
    watch: {
        isReady(val) {
            if (val) this.scrollMagicInit();
        },
    },
    methods: {
        handleUpdateActive(id) {
            this.updatNextStatus(id);
            this.currentActive = id;
        },
        updatNextStatus(newId) {
            if (newId === this.currentActive) return;
            if (this.currentActive > newId) {
                this.nextStatus = "prev";
            } else {
                this.nextStatus = "next";
            }
        },
        gotoSection(item) {
            if (item.id === this.currentActive) return;
            this.handleUpdateActive(item.id);
            const _this = this;
            this.stopScrollMagic = true;
            TweenLite.to(window, 1, {
                scrollTo: {
                    y: `#${item.name}`,
                    autoKill: false,
                    offsetY: 80,
                },
                onComplete() {
                    _this.stopScrollMagic = false;
                },
            });
        },
        scrollMagicInit() {
            // scrollMagic 設定
            this.scrollController = new _ScrollMagic.Controller({
                globalSceneOptions: {
                    duration: 0,
                    offset: 0,
                },
            });
            this.scrollMagicTrigger();
        },
        scrollMagicTrigger() {
            this.sections.forEach(item => {
              const triggerTarget = item.id === 0 ? '.hero__btn' : `#${item.name}`

              this.scrollMagicObj[item.name] = new _ScrollMagic.Scene({
                  triggerElement: triggerTarget,
              })
              .on("start", event => {
                  if (!this.stopScrollMagic) this.handleUpdateActive(item.id);
              })
              .addTo(this.scrollController);
            });
        },
    },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
