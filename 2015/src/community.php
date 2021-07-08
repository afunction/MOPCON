<?php
function getAllCommunities()
{
    return  [
        [
            'id' => 'ksdg',
            'name' => 'KSDG',
            'image' => 'community/ksdg.png',
            'desc' => "Kaohsiung Software Developer Group 是高雄從事軟體開發、網路技術開發者一起交流的園地，2012/05首度聚會活動。\n\n目前每月舉辦 Meet-up 及 Web Course 各一場，交流主題涵蓋各種軟體技術，歡迎對軟體開發技術有興趣的朋友可以踴躍參與。",
            'links' => [
                'Facebook' => 'https://www.facebook.com/groups/KSDGroup',
            ],
        ],
        [
            'id' => 'CHK',
            'name' => 'CocoaHeads Kaohsiung',
            'image' => 'community/cocoaheads.jpg',
            'desc' => "CocoaHeads Kaohsiung 定位為南台灣 Mac/iOS 開發者的固定聚會。聚會不定期邀請各地講者與會員特定主題或經驗分享。\n\n您可能會遇到：開發者在聚會上分享各自的心得與點子。 \n\n也可能會遇到：開發者在聚會上與使用者面對面溝通，與其他開發人員面對面分享。\n\n您可能會在此找到新合作夥伴或更有挑戰性的工作、甚至新的商機。",
            'links' => [
                'Facebook' => 'https://www.facebook.com/groups/cocoaheads.kaohsiung',
                'Website' => 'http://cocoaheads.org:8106/tw/Kaohsiung/index.html',
            ],
        ],
        [
            'id' => 'MOSUT',
            'name' => 'MOSUT',
            'image' => 'community/mosut.png',
            'desc' => "MOSUT (Meet Open Source Users in Tainan) 是一群生活在台南、對資訊科技有熱情的朋友共同發起的聚會。 關注開放標準/開放規格、自由軟體 / 開放原始碼，進而到開放硬體等議題。\n\n每兩周舉辦一次聚會，提供大學院校、公司團體，以及個人作技術討論交流的機會。",
            'links' => [
                'Facebook' => 'https://www.facebook.com/groups/mosut',
            ],
        ],
        [
            'id' => 'KIMU',
            'name' => 'KIMU',
            'image' => 'community/kimu.jpg',
            'desc' => "高雄獨立遊戲開發者聚會(Kaohsiung Indies Meet Up)，簡稱KIMU。2012年由中山大學促進產業發展研究中心協助成立。 是一個以高雄為活動據點，推動南臺灣獨立遊戲開發國際化與相關產業活動的非營利性社群組織。",
            'links' => [
                'Facebook' => 'https://www.facebook.com/groups/kimugroup',
            ],
        ],
        [
            'id' => 'KaLUG',
            'name' => 'KaLUG',
            'image' => 'community/kalug.png',
            'desc' => "Kaohsiung Linux User Group (KaLUG) 是由一群熱愛 open source / free software 的高雄人所組成的團體。 平日討論的主題有 Linux, Debian, Ubuntu, Vim, Emacs, Git, Python, shell script, Drupal, OpenStreetMap, Security ... 等。",
            'links' => [
                'Website' => 'http://kalug.linux.org.tw/',
                'Google+' => 'https://plus.google.com/communities/113465528091946960161',
            ],
        ],
        [
            'id' => 'kf2e',
            'name' => '高雄前端社群',
            'image' => 'community/kf2e.jpg',
            'desc' => "高雄前端社群於2013年3月31日創立， 每月固定舉辦前端主題聚會，歡迎網頁設計師一塊前來交流",
            'links' => [
                'Website' => 'http://gonsakon-7655f2.kktix.cc/',
            ],
        ],
        [
            'id' => 'mobile_girls',
            'name' => 'Mobile Girls',
            'image' => 'community/mobile_girls.jpg',
            'desc' => "Mobile Girls 是由一群熱愛 iOS 與 Android 朋友所成立的社群，宗旨是希望能夠推廣 iOS/Android 程式語言給女性初學者，讓想了解 iOS 和 Android 的女性能有一個機會學習。我們歡迎沒有電腦程式設計基礎的女性朋友來參加，如果您對於 iOS/Android 的任何新奇有趣的 App 設計、原理及應用感到興趣，您將可以在這個環境找到同好，並藉由業界專業教練的指導，在小組內共同合作打造它，實現您在 App 世界的專屬夢想！",
            'links' => [
                'Facebook' => 'https://www.facebook.com/mobilegirlsfans',
                'Website' => 'http://mobile-girls.kktix.cc/',
            ],
        ],
        [
            'id' => 'gdg',
            'name' => 'GDG Kaohsiung',
            'image' => 'community/gdg.jpg',
            'desc' => "Google Developer Group Kaohsiung (原Android高雄開發者社群) 從事 Android App、Embedded 及 Design 一起交流的園地，2014 首次聚會活動，目前活動活動時間為每月第三週的禮拜四 meet-up，歡迎對 Android 有興趣的朋友可以參與聚會。",
            'links' => [
                'Facebook' => 'https://www.facebook.com/groups/1416205511963346/',
                'Website' => 'http://akdg.kktix.cc/',
            ],
        ],
    //    [
    //        'id' => 'design_plus',
    //        'name' => 'Design Plus in Kaohsiung',
    ////        'image' => 'community/akdg.png',
    //        'desc' => "設計+，讓高雄設計能量聚集與交流
    //        DESIGN plus in Kaohsiung
    //
    //        我們相信這個社會需要設計師美化工作，也惋惜南部沒有一個設計類社群能讓大家彼此交流。因此Colour Design成立這個社群，期盼能夠給予設計師友誼與資訊，讓設計師們都能在這裡彼此討論，互相成長。
    //
    //        我們期許「設計+」能匯集南部的設計資源，透過交流與討論來增進設計的能量，進而用設計師們的美感一點一滴活潤社會美感。",
    //        'links' => [
    //            'Website' => 'http://www.designplus.tw/',
    //        ],
    //    ],
    ];
}
