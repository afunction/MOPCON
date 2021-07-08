import Vue from 'vue';
import VueMoment from 'vue-moment';
import moment from 'moment';
import 'moment/locale/zh-tw';
moment.locale('zh-tw');

Vue.use(VueMoment, { moment });
