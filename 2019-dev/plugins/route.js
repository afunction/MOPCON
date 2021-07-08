export default ({ app }) => {
  app.router.beforeEach((to, from, next) => {
    let isPass = true;

    if (to.name === 'schedule') isPass = process.env.routeSchedule;
    if (to.name === 'schedule_unconf') isPass = process.env.routeScheduleUnconf;
    if (to.name === 'speaker') isPass = process.env.routeSpeaker;
    if (to.name === 'sponsor') isPass = process.env.routeSponsor;
    if (to.name === 'community') isPass = process.env.routeCommunity;

    if (isPass === 'false') return next('/');
    next();
  });
};
