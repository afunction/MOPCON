# 電子看板 API

## 電子看板

電子看板播放清單

### 欄位說明
- news(array)
  - title(string): 該消息的題目
  - description(string): 該消息的內文
- content(array)
  - type(string): session/ad/map
  - play_time(int): 輪播切換時間，單位為秒
  - data(for session)
    - title(string): 議程進行中/議程預告/同步轉播中
    - title_class(string): 套用的 class name
    - started_at(timestamp): 本議程區間開始時間，單位為秒
    - ended_at(timestamp): 本議程區間結束時間，單位為秒
    - isBroadCast(bool): 是否為聯播議程
    - room(array): 議程詳細資訊
      - main(array):
        - topic(string): 議程名稱
        - topic_e(string): 議程英文名稱
        - summary(string): 議程簡介中文
        - summary_e(string): 議程簡介英文
        - started_at(timestamp): 議程開始時間，單位為秒
        - ended_at(timestamp): 議程結束時間，單位為秒
        - room(string): 議程廳
        - floor(string): 樓層
        - level(string): 議程難易度
        - tags(array): 議程標籤（禁止攝影/議程現場/同步轉播）
          - class_name(string): 標籤樣式 class name
          - name(string): 標籤名稱
        - speakers(array): 講師資料
          - name(string): 講師中文名稱
          - name_e(string): 講師英文名稱
          - speaker_id(int): 講者 ID
          - company(string): 公司中文名稱
          - company_e(string): 公司英文名稱
          - job_title(string): 職位中文名稱
          - job_title_e(string): 職位英文名稱
          - img(object): 講者圖片
            - web(string): 網頁版使用
            - mobile(string): 手機版使用
      - sidecar(array): 其他廳議程
        - topic(string): 議程名稱
        - topic_e(string): 議程英文名稱
        - summary(string): 議程簡介中文
        - summary_e(string): 議程簡介英文
        - started_at(timestamp): 議程開始時間，單位為秒
        - ended_at(timestamp): 議程結束時間，單位為秒
        - room(string): 議程廳
        - floor(string): 樓層
        - level(string): 議程難易度
        - tags(array): 議程標籤（禁止攝影/議程現場/同步轉播）
          - class_name(string): 標籤樣式 class name
          - name(string): 標籤名稱
        - speakers(array): 講師資料
          - name(string): 講師中文名稱
          - name_e(string): 講師英文名稱
          - speaker_id(int): 講者 ID
          - company(string): 公司中文名稱
          - company_e(string): 公司英文名稱
          - job_title(string): 職位中文名稱
          - job_title_e(string): 職位英文名稱
          - img(object): 講者圖片
            - web(string): 網頁版使用
            - mobile(string): 手機版使用
  - data(for ad)
    - sponsor_ad_img(string): 贊助商電子看板圖片連結
  - data(for map)
    - title(string): 標題
    - subtitle(string): 副標題
    - map(string): 地圖圖片連結

#### content 欄位補充說明
data 有三種格式，不會同時出現
content 的實際內容為
- content(array)
  - type(string): session/ad/map
  - play_time(int): 輪播切換時間，單位為秒
  - data(array): 輪播內容 session/ad/map


### Request
- **URL**

    /api/2019/board/:room?type=:string&now=:timestamp

- **URL Params**

  **Required:**

  - room=[string]

  **Optional:**

  - type=[string] (default: `outroom`)
    - e.g., `/api/2020/board/:room?type=inroom&now=:timestamp`
    - e.g., `/api/2020/board/:room?type=outroom&now=:timestamp`
  - now=[integer]
    - e.g., `/api/2019/board/:room?now=1571447700`

- **Method**

    `GET`

- **Success Response**

  - Code: 200
  - Content:
  ```json
  {
    "success": true,
    "message": "success",
    "data": {
      "news": [
        {
          "title": "大家好～～",
          "description": "大家好"
        }
      ],
      "content": [
        {
          "type": "session",
          "play_time": 10,
          "data": {
            "title": "議程預告",
            "title_class": "color-secondary",
            "started_at": 1571447700,
            "ended_at": 1571450400,
            "isBroadCast": true,
            "room": {
              "main": {
                "topic": "HI AI~",
                "topic_e": "HI AI~",
                "summary": "從 Hello World 到 Hi Siri ，人類與機器互動的方式正不斷隨著 AI 技術的演化而產生變化，人的洞察與智能在機器智慧不斷提升的情境之下應何去何從？身為亞洲領先的人工智慧實驗室領導人，開創 ptt 鄉民文化的杜奕瑾將再次重返 MOPCON 與家鄉高雄，告訴我們他們如何將前緣技術結合真實需求，透過結合 HI(Human Intelligence) 與 AI ，打造具備實務經驗的 AI 人才搖籃，帶動產業的創新力量。",
                "summary_e": "",
                "started_at": 1571447700,
                "ended_at": 1571450400,
                "room": "R1",
                "floor": "3F",
                "level": "Normal",
                "tags": [
                  {
                    "class_name": "tag-badge-outline-primary",
                    "name": "議程現場"
                  }
                ],
                "speakers": [
                  {
                    "name": "杜奕瑾",
                    "name_e": "Ethan Tu",
                    "speaker_id": 1,
                    "company": "台灣人工智慧實驗室",
                    "company_e": "Taiwan AI Labs",
                    "job_title": "創辦人",
                    "job_title_e": "Founder",
                    "img": {
                      "web": "http://localhost/api/2019/speaker/images/web/speaker_1",
                      "mobile": "http://localhost/api/2019/speaker/images/mobile/speaker_1"
                    }
                  }
                ]
              },
              "sidecar": [
                {
                  "topic": "HI AI~",
                  "topic_e": "HI AI~",
                  "summary": "從 Hello World 到 Hi Siri ，人類與機器互動的方式正不斷隨著 AI 技術的演化而產生變化，人的洞察與智能在機器智慧不斷提升的情境之下應何去何從？身為亞洲領先的人工智慧實驗室領導人，開創 ptt 鄉民文化的杜奕瑾將再次重返 MOPCON 與家鄉高雄，告訴我們他們如何將前緣技術結合真實需求，透過結合 HI(Human Intelligence) 與 AI ，打造具備實務經驗的 AI 人才搖籃，帶動產業的創新力量。",
                  "summary_e": "",
                  "started_at": 1571447700,
                  "ended_at": 1571450400,
                  "room": "R2",
                  "floor": "4F",
                  "level": "Normal",
                  "tags": [
                    {
                      "class_name": "tag-badge-outline-secondary",
                      "name": "同步轉播"
                    }
                  ],
                  "speakers": [
                    {
                      "name": "杜奕瑾",
                      "name_e": "Ethan Tu",
                      "speaker_id": 1,
                      "company": "台灣人工智慧實驗室",
                      "company_e": "Taiwan AI Labs",
                      "job_title": "創辦人",
                      "job_title_e": "Founder",
                      "img": {
                        "web": "http://localhost/api/2019/speaker/images/web/speaker_1",
                        "mobile": "http://localhost/api/2019/speaker/images/mobile/speaker_1"
                      }
                    }
                  ]
                },
                {
                  "topic": "HI AI~",
                  "topic_e": "HI AI~",
                  "summary": "從 Hello World 到 Hi Siri ，人類與機器互動的方式正不斷隨著 AI 技術的演化而產生變化，人的洞察與智能在機器智慧不斷提升的情境之下應何去何從？身為亞洲領先的人工智慧實驗室領導人，開創 ptt 鄉民文化的杜奕瑾將再次重返 MOPCON 與家鄉高雄，告訴我們他們如何將前緣技術結合真實需求，透過結合 HI(Human Intelligence) 與 AI ，打造具備實務經驗的 AI 人才搖籃，帶動產業的創新力量。",
                  "summary_e": "",
                  "started_at": 1571447700,
                  "ended_at": 1571450400,
                  "room": "R3",
                  "floor": "4F",
                  "level": "Normal",
                  "tags": [
                    {
                      "class_name": "tag-badge-outline-secondary",
                      "name": "同步轉播"
                    }
                  ],
                  "speakers": [
                    {
                      "name": "杜奕瑾",
                      "name_e": "Ethan Tu",
                      "speaker_id": 1,
                      "company": "台灣人工智慧實驗室",
                      "company_e": "Taiwan AI Labs",
                      "job_title": "創辦人",
                      "job_title_e": "Founder",
                      "img": {
                        "web": "http://localhost/api/2019/speaker/images/web/speaker_1",
                        "mobile": "http://localhost/api/2019/speaker/images/mobile/speaker_1"
                      }
                    }
                  ]
                }
              ]
            }
          }
        },
        {
          "type": "ad",
          "play_time": 5,
          "data": {
            "sponsor_ad_img": "http://localhost/api/2019/board/images/sponsor/sponsor_20"
          }
        },
        {
          "type": "ad",
          "play_time": 5,
          "data": {
            "sponsor_ad_img": "http://localhost/api/2019/board/images/sponsor/sponsor_22"
          }
        },
        {
          "type": "ad",
          "play_time": 5,
          "data": {
            "sponsor_ad_img": "http://localhost/api/2019/board/images/sponsor/sponsor_23"
          }
        },
        {
          "type": "ad",
          "play_time": 5,
          "data": {
            "sponsor_ad_img": "http://localhost/api/2019/board/images/sponsor/sponsor_25"
          }
        },
        {
          "type": "ad",
          "play_time": 5,
          "data": {
            "sponsor_ad_img": "http://localhost/api/2019/board/images/sponsor/sponsor_1"
          }
        },
        {
          "type": "map",
          "play_time": 5,
          "data": {
            "title": "休息一下！後續還有精彩議程！",
            "subtitle": "會場地圖",
            "map": "http://localhost/api/2019/board/images/field/map"
          }
        }
      ]
    }
  }
  ```
