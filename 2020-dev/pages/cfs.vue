<template>
  <div class="wrap cfs">
    <div class="md:max-w-screen-xl mx-auto">
      <!-- "MPCON贊助募集"標題 -->
      <h1 class="cfs-title">
        {MOPCON
        <span class="text-yellow-500">
          <span class="inline-block md:hidden">需要你</span>
          <span class="hidden md:inline-block">贊助募集</span>
        </span>;}
      </h1>
      <div class="hr" />
      <!-- 贊助方案內容 -->
      <div class="mobile-table-header" style="top: 43px">
        <a
          :class="{'active': tableActiveItem == 'Developer'}"
          href="#"
          class="mobile-table-header-item"
          @click.prevent="toggleTableActive('Developer')"
        >Developer</a>
        <a
          :class="{'active': tableActiveItem == 'Hacker'}"
          href="#"
          class="mobile-table-header-item"
          @click.prevent="toggleTableActive('Hacker')"
        >Hacker</a>
        <a
          :class="{'active': tableActiveItem == 'Bruce'}"
          href="#"
          class="mobile-table-header-item"
          @click.prevent="toggleTableActive('Bruce')"
        >Bruce Wayne</a>
        <a
          :class="{'active': tableActiveItem == 'Tony'}"
          href="#"
          class="mobile-table-header-item"
          @click.prevent="toggleTableActive('Tony')"
        >Tony Stark</a>
      </div>
      <table :class="tableActiveItem" class="option support-type">
        <thead class="md:table-header-group hidden">
          <tr class="align-baseline">
            <th class="option-sticky option-top" />
            <th class="option-sticky option-top">
              Developer
            </th>
            <th class="option-sticky option-top">
              Hacker
            </th>
            <th class="option-sticky option-top">
              Bruce Wayne
            </th>
            <th class="option-sticky option-top">
              Tony Stark
            </th>
          </tr>
        </thead>
        <tbody>
          <tr class="option-desc">
            <td />
            <td>
              最經濟實惠的現場與數位曝光，可搭配加購滿足特定需求
            </td>
            <td>
              享有在人潮多處的靜態曝光，和實體交流 UnConference
            </td>
            <td>
              享有主動線攤位，與今年新增的媒體專訪、專欄文章、線上面試服務等等項目
            </td>
            <td>
              享有所有項目，和最顯眼的演講時段與曝光位置
            </td>
          </tr>
          <tr class="option-list-title">
            <td>
              <h3 class="whitespace-no-wrap">
                實體曝光
              </h3>
            </td>
            <td />
            <td />
            <td />
            <td />
          </tr>
          <tr class="option-list">
            <td class="relative">
              <div class="flex justify-between">
                <h4 class="option-list-desc mr-2">
                  場內告示牌商標置入
                </h4>
                <a href="#" class="icon icon-info" @click.prevent="toggleInfo('signboard')" />
              </div>
              <div v-if="activeItem == 'signboard'" class="option-card-body" @click.prevent="toggleInfo('signboard')">
                <div class="option-img-Signboard option-img" />
                <p>場內告示牌商標置入</p>
              </div>
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
          </tr>
          <tr class="option-list">
            <td class="relative">
              <div class="flex justify-between">
                <h4 class="option-list-desc mr-2">
                  電子看版 (企業形象圖)
                </h4>
                <a href="#" class="icon icon-info" @click.prevent="toggleInfo('digiboard')" />
              </div>
              <div v-if="activeItem == 'digiboard'" class="option-card-body" @click.prevent="toggleInfo('digiboard')">
                <div class="option-img-Digiboard option-img" />
                <p>電子看版</p>
              </div>
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
          </tr>
          <tr class="option-list">
            <td class="relative">
              <div class="flex justify-between">
                <h4 class="option-list-desc mr-2">
                  場間投影片廣告 (企業形象圖文)
                </h4>
                <a href="#" class="icon icon-info" @click.prevent="toggleInfo('powerpoint')" />
              </div>
              <div v-if="activeItem == 'powerpoint'" class="option-card-body" @click.prevent="toggleInfo('powerpoint')">
                <div class="option-img-PPT option-img" />
                <p>場間投影片廣告 (企業形象圖文)</p>
              </div>
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
          </tr>
          <tr class="option-list">
            <td class="relative">
              <div class="flex justify-between">
                <h4 class="option-list-desc mr-2">
                  主動線旗幟廣告
                </h4>
                <a href="#" class="icon icon-info" @click.prevent="toggleInfo('banner')" />
              </div>
              <div v-if="activeItem == 'banner'" class="option-card-body" @click.prevent="toggleInfo('banner')">
                <div class="option-img-Banner option-img" />
                <p>主動線旗幟廣告</p>
              </div>
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td class="option-list-content">
              1 個
            </td>
            <td class="option-list-content">
              2 個
            </td>
            <td class="option-list-content">
              2 個
            </td>
          </tr>
          <tr class="option-list">
            <td class="relative">
              <div class="flex justify-between">
                <h4 class="option-list-desc mr-2">
                  700 人演講廳旗幟 3F
                </h4>
                <a href="#" class="icon icon-info" @click.prevent="toggleInfo('lectureBanner700')" />
              </div>
              <div v-if="activeItem == 'lectureBanner700'" class="option-card-body" @click.prevent="toggleInfo('lectureBanner700')">
                <div class="option-img-LectureBanner option-img" />
                <p>700 人演講廳旗幟 3F</p>
              </div>
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td class="option-list-content">
              1 個
            </td>
            <td class="option-list-content">
              2 個
            </td>
            <td class="option-list-content">
              4 個
            </td>
          </tr>
          <tr class="option-list">
            <td class="relative">
              <div class="flex justify-between">
                <h4 class="option-list-desc mr-2">
                  350 人演講廳旗幟 4F A/B廳
                </h4>
                <a href="#" class="icon icon-info" @click.prevent="toggleInfo('lectureBanner350')" />
              </div>
              <div v-if="activeItem == 'lectureBanner350'" class="option-card-body" @click.prevent="toggleInfo('lectureBanner350')">
                <div class="option-img-LectureBanner option-img" />
                <p>350 人演講廳旗幟 4F A/B 廳</p>
              </div>
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td class="option-list-content">
              各廳各 1
            </td>
            <td class="option-list-content">
              各廳各 1
            </td>
            <td class="option-list-content">
              各廳各 2
            </td>
          </tr>
          <tr class="option-list">
            <td class="relative">
              <div class="flex justify-between">
                <h4 class="option-list-desc mr-2">
                  ICCK 大門兩側全版廣告空間
                </h4>
                <a href="#" class="icon icon-info" @click.prevent="toggleInfo('icck')" />
              </div>
              <div v-if="activeItem == 'icck'" class="option-card-body" @click.prevent="toggleInfo('icck')">
                <div class="option-img-Icck option-img" />
                <p>包含場內告示版與議程資訊張貼處</p>
              </div>
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
          </tr>
          <tr class="option-list">
            <td class="relative">
              <div class="flex justify-between">
                <h4 class="option-list-desc mr-2">
                  報到處全版廣告空間
                </h4>
                <a href="#" class="icon icon-info" @click.prevent="toggleInfo('checkin')" />
              </div>
              <div v-if="activeItem == 'checkin'" class="option-card-body" @click.prevent="toggleInfo('checkin')">
                <div class="option-img-Checkin option-img" />
                <p>報到處全版廣告空間</p>
              </div>
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
          </tr>
          <tr class="option-list">
            <td class="relative">
              <div class="flex justify-between">
                <h4 class="option-list-desc mr-2">
                  迎賓袋放入公司產品 / 文宣 / 問卷
                </h4>
                <a href="#" class="icon icon-info" @click.prevent="toggleInfo('welcomeBag')" />
              </div>
              <div v-if="activeItem == 'welcomeBag'" class="option-card-body" @click.prevent="toggleInfo('welcomeBag')">
                <div class="option-img-WelcomeBag option-img" />
                <p>迎賓袋放入公司產品 / 文宣 / 問卷</p>
              </div>
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
          </tr>
          <tr class="option-list-title">
            <td>
              <h3>數位曝光</h3>
            </td>
            <td />
            <td />
            <td />
            <td />
          </tr>
          <tr class="option-list">
            <td class="option-list-desc">
              粉絲頁貼文
            </td>
            <td class="option-list-content">
              1 則
            </td>
            <td class="option-list-content">
              1 則
            </td>
            <td class="option-list-content">
              1 則
            </td>
            <td class="option-list-content">
              1 則
            </td>
          </tr>
          <tr class="option-list">
            <td class="option-list-desc">
              官網企業商標與連結
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
          </tr>
          <tr class="option-list">
            <td class="option-list-desc">
              官網站內介紹專頁
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
          </tr>
          <tr class="option-list">
            <td class="option-list-desc">
              電子報曝光 (企業形象圖文)
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td class="option-list-content">
              1 則
            </td>
            <td class="option-list-content">
              1 則
            </td>
            <td class="option-list-content">
              1 則
            </td>
          </tr>
          <tr class="option-list">
            <td class="option-list-desc">
              KKTIX 報名頁面商標露出
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
          </tr>
          <tr class="option-list">
            <td class="option-list-desc">
              部落格報導
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
          </tr>
          <tr class="option-list">
            <td class="option-list-desc">
              專業媒體專訪
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
          </tr>
          <tr class="option-list-title">
            <td>
              <h3 class="whitespace-no-wrap">
                實體互動
              </h3>
            </td>
            <td />
            <td />
            <td />
            <td />
          </tr>
          <tr class="option-list">
            <td class="option-list-desc">
              Keynote Session (45分鐘、含直播)
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td class="option-list-content">
              1 場
            </td>
          </tr>
          <tr class="option-list">
            <td class="option-list-desc">
              Sponsor Session (45分鐘、含直播)
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td class="option-list-content">
              1 場
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
          </tr>
          <tr class="option-list">
            <td class="option-list-desc">
              UnConference (30分鐘、不含直播)
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td class="option-list-content">
              1 場
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td class="option-list-content">
              1 場
            </td>
          </tr>
          <tr class="option-list">
            <td class="option-list-desc">
              主動線攤位
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td class="option-list-content">
              1 個
            </td>
            <td class="option-list-content">
              1 個
            </td>
          </tr>
          <tr class="option-list">
            <td class="option-list-desc">
              VIP 入場套票（含入場門票 + 晚宴入場券一張）
            </td>
            <td class="option-list-content">
              1 份
            </td>
            <td class="option-list-content">
              2 份
            </td>
            <td class="option-list-content">
              3 份
            </td>
            <td class="option-list-content">
              6 份
            </td>
          </tr>
          <tr class="option-list-title">
            <td>
              <h3 class="whitespace-no-wrap">
                數位互動
              </h3>
            </td>
            <td />
            <td />
            <td />
            <td />
          </tr>
          <tr class="option-list">
            <td class="option-list-desc">
              大地遊戲置入配合
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
          </tr>
          <tr class="option-list">
            <td class="option-list-desc">
              線上直播 AMA (Ask Me Anything)
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
          </tr>
          <tr class="option-list">
            <td class="option-list-desc">
              Meet.jobs 線上面試服務
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-close" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
            <td>
              <div class="icon icon-check" />
            </td>
          </tr>
        </tbody>
        <tfoot />
      </table>
    </div>
    <!-- "心有餘力有足" -->
    <h2 class="extra-title">
      {心有餘
      <span class="text-yellow-500">力有足？</span>;}
    </h2>
    <!-- 卡片區塊 -->
    <div class="extra-section">
      <h3 class="extra-section-title">
        實體交流
      </h3>
      <a
        href="#"
        :class="{'icon-minus': cardAciveItem == 'entity', 'icon-plus': cardAciveItem != 'entity'}"
        class="icon block md:hidden"
        @click.prevent="toggleCard('entity')"
      />
    </div>
    <div :class="{'active': cardAciveItem == 'entity'}" class="extra-group">
      <div class="extra-card">
        <div class="extra-card-body">
          <h3 class="extra-card-title">
            Sponsor Session
          </h3>
          <h4 class="extra-card-content">
            選取活動當天一場議程
          </h4>
          <h5 class="extra-card-desc">
            適合搭配產品、服務做技術議題的分享
          </h5>
        </div>
        <h3 class="extra-card-footer">
          可加購 1 場，限量 5 場
        </h3>
      </div>
      <div class="extra-card">
        <div class="extra-card-body">
          <h3 class="extra-card-title">
            UnConference
          </h3>
          <h4 class="extra-card-content">
            ⼤會現場議程廳外舉辦非正式的⼩型會議
          </h4>
          <h5 class="extra-card-desc">
            更貼近會眾的⽅式交流分享
          </h5>
        </div>
        <h3 class="extra-card-footer">
          可加購 1 場，限量 10 場
        </h3>
      </div>
      <div class="extra-card">
        <div class="extra-card-body">
          <h3 class="extra-card-title">
            主動線攤位
          </h3>
          <h4 class="extra-card-content">
            可於現場擺攤，與參與者深入互動
          </h4>
          <h5 class="extra-card-desc">
            與千名以上會眾以及現場工作人員、贊助商交流
          </h5>
        </div>
        <h3 class="extra-card-footer">
          可加購 1 場，限量 10 場
        </h3>
      </div>
      <div class="extra-card">
        <div class="extra-card-body">
          <h3 class="extra-card-title">
            VIP 入場套票
          </h3>
          <h4 class="extra-card-content">
            (每套入場套票含入場門票 + 晚宴入場券一張)<br>
            入場快速通關、講者交流晚宴與獨家紀念商品
          </h4>
          <h5 class="extra-card-desc">
            與贊助商代表、講者深入互動
          </h5>
        </div>
        <h3 class="extra-card-footer">
          數量不限
        </h3>
      </div>
    </div>
    <div class="lg:px-32 md:mt-8 mt-5 flex justify-between">
      <h3 class="extra-section-title">
        數位交流
      </h3>
      <a
        href="#"
        :class="{'icon-minus': cardAciveItem == 'digit', 'icon-plus': cardAciveItem != 'digit'}"
        class="icon block md:hidden"
        @click.prevent="toggleCard('digit')"
      />
    </div>
    <div :class="{'active': cardAciveItem == 'digit'}" class="extra-group">
      <div class="extra-card">
        <div class="extra-card-body">
          <h3 class="extra-card-title">
            線上直播 AMA
          </h3>
          <h4 class="extra-card-content">
            Ask Me Anything 將由我們採訪關於貴公司的 QA 問答影片
          </h4>
          <h5 class="extra-card-desc">
            適合搭配產品、服務做技術議題的分享
          </h5>
        </div>
        <h3 class="extra-card-footer">
          可加購 1 場，限量 5 場
        </h3>
      </div>
      <div class="extra-card">
        <div class="extra-card-body">
          <h3 class="extra-card-title">
            Meet.jobs 線上面試服務
          </h3>
          <h4 class="extra-card-content">
            Meet.jobs 透過其系統媒合企業與會眾，並於會後提供線上面試的系統服務，只收取確定錄取者的年薪 8% 作為服務費。
          </h4>
          <h5 class="extra-card-desc">
            簡化投履歷流程，加強徵才轉化率。尤其適合需要遠端招募的公司。
          </h5>
        </div>
        <h3 class="extra-card-footer">
          可加購 1 場，數量不限
        </h3>
      </div>
    </div>
    <div class="extra-section">
      <h3 class="extra-section-title">
        實體曝光
      </h3>
      <a
        href="#"
        :class="{'icon-minus': cardAciveItem == 'entityExposure', 'icon-plus': cardAciveItem != 'entityExposure'}"
        class="icon block md:hidden"
        @click.prevent="toggleCard('entityExposure')"
      />
    </div>
    <div :class="{'active': cardAciveItem == 'entityExposure'}" class="extra-group">
      <div class="extra-card">
        <div class="extra-card-body">
          <h3 class="extra-card-title">
            主動線旗幟廣告
          </h3>
          <h4 class="extra-card-content">
            主動線擺放旗幟廣告
          </h4>
          <h5 class="extra-card-desc">
            觸及千名以上會眾以及現場工作人員、贊助商
          </h5>
        </div>
        <h3 class="extra-card-footer">
          數量不限
        </h3>
      </div>
      <div class="extra-card">
        <div class="extra-card-body">
          <h3 class="extra-card-title">
            迎賓袋放入公司產品 / 文宣 / 問卷
          </h3>
          <h4 class="extra-card-content">
            於會議舉辦的迎賓袋中放入公司文宣和問卷
          </h4>
          <h5 class="extra-card-desc">
            觸及千名以上會眾以及現場工作人員、贊助商
          </h5>
        </div>
        <h3 class="extra-card-footer">
          可加購 1 份，限量 10 份
        </h3>
      </div>
      <div class="extra-card">
        <div class="extra-card-body">
          <h3 class="extra-card-title">
            識別證商標曝光
          </h3>
          <h4 class="extra-card-content">
            只限一間贊助商獨有的獨家曝光方式
          </h4>
          <h5 class="extra-card-desc">
            觸及千名以上會眾以及現場工作人員、贊助商
          </h5>
        </div>
        <h3 class="extra-card-footer">
          可加購 1 份，限量 1 份
        </h3>
      </div>
    </div>
    <div class="extra-section">
      <h3 class="extra-section-title">
        數位曝光
      </h3>
      <a
        href="#"
        :class="{'icon-minus': cardAciveItem == 'digiExposure', 'icon-plus': cardAciveItem != 'digiExposure'}"
        class="icon block md:hidden"
        @click.prevent="toggleCard('digiExposure')"
      />
    </div>
    <div :class="{'active': cardAciveItem == 'digiExposure'}" class="extra-group">
      <div class="extra-card">
        <div class="extra-card-body">
          <h3 class="extra-card-title">
            粉絲頁貼文置頂一週曝光
          </h3>
          <h4 class="extra-card-content">
            於會議舉辦前在 MOPCON 的粉絲專頁張貼一則貼文，可預告現場活動內容或是介紹廠商產品
          </h4>
          <h5 class="extra-card-desc">
            曝光超過千名受眾
          </h5>
        </div>
        <h3 class="extra-card-footer">
          數量不限
        </h3>
      </div>
      <div class="extra-card">
        <div class="extra-card-body">
          <h3 class="extra-card-title">
            電子報曝光（企業形象圖文）
          </h3>
          <h4 class="extra-card-content">
            每期期刊都會以信件方式寄送給往年購票會眾以及 MOPCON 的支持者們
          </h4>
          <h5 class="extra-card-desc">
            曝光超過千名受眾
          </h5>
        </div>
        <h3 class="extra-card-footer">
          數量不限
        </h3>
      </div>
      <div class="extra-card">
        <div class="extra-card-body">
          <h3 class="extra-card-title">
            部落格報導
          </h3>
          <h4 class="extra-card-content">
            以文章報導形式，撰寫贊助商需要曝光的主題
          </h4>
          <h5 class="extra-card-desc">
            曝光超過千名受眾，且會議結束後仍將持續帶來流量
          </h5>
        </div>
        <h3 class="extra-card-footer">
          數量不限
        </h3>
      </div>
    </div>
    <div class="extra-section">
      <h3 class="extra-section-title">
        教育贊助
      </h3>
      <a
        href="#"
        :class="{'icon-minus': cardAciveItem == 'edu', 'icon-plus mb-12': cardAciveItem != 'edu'}"
        class="icon block md:hidden"
        @click.prevent="toggleCard('edu')"
      />
    </div>
    <div :class="{'active': cardAciveItem == 'edu'}" class="extra-group">
      <div class="extra-card">
        <div class="extra-card-body">
          <h3 class="extra-card-title">
            教育票券認購贊助 50 張
          </h3>
          <h4 class="extra-card-content">
            鼓勵資訊教育紮根，贊助學生參與 MOPCON，購買單位為 50 張
          </h4>
        </div>
        <h3 class="extra-card-footer">
          可購買 4 份，限量 200 份
        </h3>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CFS',
  data () {
    return {
      activeItem: '',
      cardAciveItem: 'entity',
      tableActiveItem: 'Developer'
    }
  },
  mounted () {
  },
  methods: {
    toggleInfo (id) {
      const vm = this
      vm.activeItem !== id ? (vm.activeItem = id) : (vm.activeItem = '')
    },
    toggleCard (id) {
      const vm = this
      vm.cardAciveItem !== id ? (vm.cardAciveItem = id) : (vm.cardAciveItem = '')
    },
    toggleTableActive (id) {
      const vm = this
      vm.tableActiveItem = id
    }
  }
}
</script>
<style lang="scss" scoped>
.wrap {
  @apply bg-gray-900 px-6;
}
.cfs {
  &-title {
    font-size: 2rem;
    @apply pt-12 text-left text-white font-medium pb-6;
    @screen md {
      font-size: 5rem;
      @apply pt-20 text-center;
    }
  }
  .icon {
    width: 24px;
    height: 24px;
    @apply flex-shrink-0 bg-center bg-no-repeat;
    &-check {
      background-image: url('~@/assets/cfs/cfs-check.svg');
      @apply m-auto;
    }
    &-close {
      background-image: url('~@/assets/cfs/cfs-close.svg');
      @apply m-auto;
    }
    &-info {
      background-image: url('~@/assets/cfs/cfs-info.svg');
    }
    &-plus {
      background-image: url('~@/assets/cfs/cfs-plus.svg');
    }
    &-minus{
      background-image: url('~@/assets/cfs/cfs-minus.svg');
    }
  }
}
.hr {
  @apply bg-yellow-500 rounded-sm h-1;
}
.mobile-table-header {
  @apply flex overflow-x-scroll sticky bg-gray-900 mt-10 mb-2 z-10;
  @screen md {
    @apply hidden;
  }
  &-item {
    @apply whitespace-no-wrap text-2xl px-5 text-gray-500 py-3;
  }
  &-item.active {
    @apply text-yellow-500 border-b-2 border-yellow-500;
  }
}
.option {
  &-top {
    @apply text-xl text-yellow-500 pt-12 pb-6 px-4 z-10 bg-gray-900 sticky
  }
  &-sticky {
    top: 43px;
  }
  &-desc {
    @apply hidden;
    @screen md {
      @apply table-row;
    }
    td {
      @apply pb-12 px-4 align-top text-white text-base text-center ;
    }
  }
  &-list-title td {
    @apply border-0 border-yellow-500 text-yellow-500 text-2xl py-5;
    @screen md {
      @apply border-t border-b;
    }
  }
  &-list {
    td {
      @apply py-8;
    }
    &:hover {
      background-color: rgba(255, 85, 0, 0.3);
    }
    &-desc {
      @apply text-base text-white;
      @screen md {
        @apply text-xl
      }
    }
    &-content {
      @apply text-center text-base text-white;
    }
  }
  &-card-body {
    background: white;
    min-width: 250px;
    top: 80%;
    left: 50%;
    z-index: 9;
    overflow: hidden;
    @apply absolute rounded-lg;
    @screen md {
      top: 50%;
      left: 155%;
    }
    p {
      @apply p-2 text-xs;
    }
  }
  &-img {
    height: 250px;
    background-size: cover;
    &-Icck {
    background-image: url('~@/assets/cfs/cfs-7.jpg');
    background-position: center left;
    }
    &-Signboard {
      background-image: url('~@/assets/cfs/cfs-1.jpg');
      background-position: center left;
    }
    &-Digiboard {
      background-image: url('~@/assets/cfs/cfs-2.jpg');
      background-position: center;
    }
    &-PPT {
      background-image: url('~@/assets/cfs/cfs-3.jpg');
      background-position: center;
    }
    &-Banner {
      background-image: url('~@/assets/cfs/cfs-4.jpg');
      background-position: center;
    }
    &-LectureBanner {
      background-image: url('~@/assets/cfs/cfs-5.jpg');
      background-position: center;
    }
    &-Checkin {
      background-image: url('~@/assets/cfs/cfs-8.jpg');
      background-position: center;
    }
    &-WelcomeBag {
      background-image: url('~@/assets/cfs/cfs-9.jpg');
      background-position: center left;
    }
  }
  &-footer th {
    @apply w-1/5 pb-3 px-4 align-top text-yellow-500 text-center text-xl;
    span {
      @apply text-base;
    }
  }
}
.extra {
  &-title {
    font-size: 2rem;
    @apply text-white text-left pt-12;
    @screen md {
      font-size: 3rem;
      @apply text-center;
    }
  }
  &-section {
    @apply mt-5 flex justify-between;
    @screen lg {
      @apply px-32;
    }
    &-title {
      @apply text-yellow-500 text-xl mb-6;
    }
  }
  &-group {
    max-height: 0px;
    transition: all 1s;
    @apply overflow-hidden grid grid-cols-1 gap-4 items-start;
    @screen md {
      max-height: 1200px;
      @apply grid-cols-3
    }
    @screen lg {
      @apply px-32 grid-cols-4;
    }
    &.active {
      max-height: 1200px;
    }
  }
  &-card {
    min-height:252px;
    @screen lg {
      min-height:350px;
    }
    @apply border flex flex-col justify-between border-solid border-yellow-500 rounded-lg p-5;
    &-title {
      @apply text-2xl text-yellow-500 mb-2 font-bold;
    }
    &-content {
      @apply text-base text-yellow-500 mb-6;
    }
    &-desc{
      @apply text-base text-white;
    }
    &-footer {
      margin-top:3.5rem;
      @apply text-base text-white font-bold;
    }
    &:hover {
      @apply bg-yellow-500;
      .extra-card-title, .extra-card-content,
      .extra-card-desc, .extra-card-footer {
        @apply text-gray-900;
      }
    }
  }
}

.support-type {
  tfoot {
    display: none;
    @screen md {
      display: table-footer-group;
    }
  }
  tbody tr td:not(:first-child) {
    display: none;
    @screen md {
      display: table-cell;
      width: 20%;
    }
  }
  &.Developer tbody tr td:nth-of-type(2),
  &.Hacker tbody tr td:nth-of-type(3),
  &.Bruce tbody tr td:nth-of-type(4),
  &.Tony tbody tr td:nth-of-type(5) {
    display: table-cell;
    width: 50%;
    @screen md {
      width: auto;
    }
  }
}

</style>
