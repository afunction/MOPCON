export default {
  data() {
    return {
      filterDate: 1571414400, // 預設選取時間
    };
  },
  methods: {
    checkDateExist(dateId) {
      if (this.filterDate === dateId) return true;
      return false;
    },
    // 依據議程 sessionData 資料整理出按鈕格式陣列
    filterDateBtns(sessionData) {
      if (sessionData.length === 0) return;
      let btns = [];
      sessionData.forEach(item => {
        const weeks = [
          { zh: '日', en: 'Sun' },
          { zh: '一', en: 'Mon' },
          { zh: '二', en: 'Tue' },
          { zh: '三', en: 'Wed' },
          { zh: '四', en: 'Thu' },
          { zh: '五', en: 'Fri' },
          { zh: '六', en: 'Sat' },
        ];

        const timestamp = item.date * 1000;
        const month = new Date(timestamp).getMonth() + 1;
        const day = new Date(timestamp).getDate();
        const week = new Date(timestamp).getDay();

        const btn = {
          id: item.date,
          name: `${month}/${day} (${weeks[week][this.$i18n.locale]})`,
        };

        btns.push(btn);
      });
      return btns;
    },
    handleDateClick(sessionData, dateId) {
      const isExist = sessionData.some(item => item.date === dateId);
      if (!isExist) return;

      this.filterDate = dateId;
    },
  },
};
