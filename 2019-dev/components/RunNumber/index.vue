<template>
  <div class="runNumber">
    <ul class="runNumber__items trigger">
      <li class="runNumber__item">
        <div class="runNumber__item__top">持續舉辦</div>
        <div class="runNumber__item__center">
          <div class="runNumber__animation runNumber1"
            ref="runNumber1"></div>
        </div>
        <div class="runNumber__item__bottom">年</div>
      </li>
      <li class="runNumber__item">
        <div class="runNumber__item__top">精彩議程</div>
        <div class="runNumber__item__center">
          <div class="runNumber__animation runNumber2"
            ref="runNumber2"></div>
        </div>
        <div class="runNumber__item__bottom">場以上</div>
      </li>
      <li class="runNumber__item">
        <div class="runNumber__item__top">熱情會眾</div>
        <div class="runNumber__item__center">
          <div class="runNumber__animation runNumber3"
            ref="runNumber3"></div>
        </div>
        <div class="runNumber__item__bottom">人以上</div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "runNumber",
  data() {
    return {
      numberToggle: false
    };
  },
  mounted() {
    const _this = this;
    const number1 = new _Filp({
      node: this.$refs.runNumber1,
      from: 0,
      duration: 1
    });

    const number2 = new _Filp({
      node: this.$refs.runNumber2,
      from: 11,
      duration: 1
    });

    const number3 = new _Filp({
      node: this.$refs.runNumber3,
      from: 9123,
      duration: 1
    });

    // scrollMagic 設定
    var controller = new _ScrollMagic.Controller({
      globalSceneOptions: {
        offset: -300
      }
    });

    new _ScrollMagic.Scene({ triggerElement: ".trigger" })
      .on("start", function() {
        _this.numberToggle = !_this.numberToggle;
        if (_this.numberToggle) {
          if (window.innerWidth <= 768) {
            setTimeout(() => {
              number1.flipTo({ to: 7 });
            }, 700);
            setTimeout(() => {
              number2.flipTo({ to: 30 });
            }, 1000);
            setTimeout(() => {
              number3.flipTo({ to: 1200 });
            }, 1300);
          } else {
            number1.flipTo({ to: 7 });
            number2.flipTo({ to: 30 });
            number3.flipTo({ to: 1200 });
          }
        } else {
          number1.flipTo({ to: 7 });
          number2.flipTo({ to: 30 });
          number3.flipTo({ to: 1200 });
        }
      })
      .setClassToggle(".trigger", "active")
      .addTo(controller);
  }
};
</script>

<style lang="scss" src="./RunNumber.scss" scoped></style>
