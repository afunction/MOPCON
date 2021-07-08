<template>
  <div class="modal fade modal-2020">
    <div class="modal-content">
      <div class="clearfix">
        <span class="close" @click="close()">&times;</span>
      </div>
      <div class="modal-body">
        <div class="banner"></div>
        <h4 class="title">
          { MOPCON 2020
          <br class="br-md-block" />籌備中; }
        </h4>
        <div class="content">
          <p>
            10/24（六）- 10/25（日)
            <br />高雄國際會議中心 ICCK
          </p>
        </div>
        <div class="track-btn">
          <a href="https://www.facebook.com/mopcon/" class="btn-third" target="_blank">追蹤我們</a>
        </div>
        <div class="c-btn">
          <a :href="baseUrl + '/2020/cfp'" class="btn-primary" target="_blank">稿件徵求</a>
          <a href="mailto:sponsor@mopcon.org" class="btn-primary" target="_blank">贊助我們</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'sectionModal',
  data() {
    return {
      modalOpen: false,
      baseUrl: process.env.BASE_URL,
    };
  },
  methods: {
    close() {
      this.modalChange(false);
    },
    modalChange(status = false) {
      const body = document.querySelector('body');
      const modal = document.getElementById('SectionModal');
      if (status) {
        body.classList.add('modal-open');
        modal.style.display = 'block';
        setTimeout(function() {
          modal.classList.add('show');
        }, 5);
      } else {
        modal.style.display = 'none';
        modal.classList.remove('show');
        body.classList.remove('modal-open');
      }
    },
  },
  mounted() {
    this.modalChange(true);
  },
};
</script>
<style lang="scss" src="./style.scss" scoped></style>
