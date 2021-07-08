import { mapGetters } from 'vuex';

export default {
  computed: {
    ...mapGetters(['localeApiPrefix']),
    // 依據當前所選語系, 選擇對應的語系資料 (name, name_e)
    // zh => '',  en => '_e'
    langPrefix() {
      const apiPrefix = this.localeApiPrefix.find(
        item => item.lang === this.$i18n.locale
      );

      if (apiPrefix) return apiPrefix.prefix;
      return '';
    },
  },
};
