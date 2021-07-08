/*
** 只在生產模式的客戶端中使用
*/
if (process.client && process.env.NODE_ENV === 'production') {
  /*
  ** Google Analytics
  */
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  /*
  ** 當前頁的訪問統計
  */
  ga('create', 'UA-34651129-1', 'auto')
}

export default ({ app: { router }, store }) => {
  /*
  ** 只在生產模式的客戶端中使用
  ** 每次路由變更時進行PV統計
  */
  if (process.client && process.env.NODE_ENV === 'production') {
    router.afterEach((to, from) => {
      /*
      ** 告訴GA增加一個PV
      */
      const urlPrefix = '/2019'
      ga('set', 'page', `${urlPrefix}${to.fullPath}`)
      ga('send', 'pageview')
    })
  }
}