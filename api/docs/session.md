# 主要議程 API

## 主要議程表

議程時間表

### 欄位說明

- date(timestamp): 議程日時間，單位為秒
- period(array): 本日議程所有議程
  - started_at(timestamp): 本議程區間開始時間，單位為秒，若此議程不標示時間則不會有此 key
  - ended_at(timestamp): 本議程區間結束時間，單位為秒，若此議程不標示時間則不會有此 key
  - isBroadCast(bool): 是否為聯播議程
  - event(string): 議程區塊名稱，通常用來顯示無議程表示（EX: 休息、報到等），如果在議程時間則為空字串
  - room(array): 議程詳細資訊，如果沒有議程會以 empty array 表示
    - speakers(array): 講師鎮列
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
    - topic(string): 議程名稱
    - topic_e(string): 議程英文名稱
    - summary(string): 議程簡介中文
    - summary_e(string): 議程簡介英文
    - community_partner(string): 合作社群
    - is_keynote(bool): 是否為 keynote 議程
    - is_online(bool): 是否為遠距議程
    - started_at(timestamp): 議程開始時間，單位為秒
    - ended_at(timestamp): 議程結束時間，單位為秒
    - room(string): 議程廳
    - floor(string): 樓層
    - sponsor_id(int): 贊助商編號，如果不是贊助商講者則為 0
    - recordable(bool): 是否提供錄影
    - level(string): 議程難易度
    - tags(array): 議程標籤
      - color(string): 標籤色碼
      - name(string): 標籤名稱
    - session_id(int): 議程編號
    - sponsor_info(object): 如果沒有贊助廠商就不會有這個 key 存在
      - name(string): 贊助商中文名稱
      - name_e(string): 贊助商英文名稱
      - logo_path(string): 贊助商圖片

### Request

- **URL**

  /api/2019/session

- **Method**

  `GET`

- **Success Response**

  - Code: 200
  - Content:

  ```json
  {
    "success": true,
    "message": "Success.",
    "data": [
      {
        "date": 1571414400,
        "period": [
          {
            "started_at": 1571445000,
            "ended_at": 1571446800,
            "isBroadCast": false,
            "event": "報到",
            "room": []
          },
          {
            "started_at": 1571446800,
            "ended_at": 1571447700,
            "isBroadCast": false,
            "event": "開幕",
            "room": []
          },
          {
            "started_at": 1571447700,
            "ended_at": 1571450400,
            "isBroadCast": true,
            "event": "",
            "room": [
              {
                "speakers": [
                  {
                    "name": "家佳",
                    "name_e": "Hilbert Boyle",
                    "speaker_id": 1,
                    "company": "大國集團公司",
                    "company_e": "Da Kao",
                    "job_title": "incidunt",
                    "job_title_e": "incidunt",
                    "img": {
                      "web": "https://picsum.photos/200",
                      "mobile": "https://picsum.photos/200"
                    }
                  }
                ],
                "topic": "Maxime nesciunt.",
                "topic_e": "Est aliquid sed eum quae in.",
                "summary": "summary",
                "summary_e": "summary",
                "community_partner": "",
                "is_keynote": true,
                "is_online": false,
                "started_at": 1571446800,
                "ended_at": 1571450400,
                "room": "R2",
                "floor": "4F",
                "tags": [
                  {
                    "color": "#01aaf0",
                    "name": "Blockchain"
                  },
                  {
                    "color": "#01aaf0",
                    "name": "IoT"
                  },
                  {
                    "color": "#ff4492",
                    "name": "Startup"
                  }
                ],
                "recordable": true,
                "level": "Basic",
                "session_id": 2019001,
                "sponsor_info": {
                  "name": "大國集團公司",
                  "name_e": "Da Kao",
                  "logo_path": "https://picsum.photos/200"
                }
              }
            ]
          },
          {
            "started_at": 1571446800,
            "ended_at": 1571447700,
            "isBroadCast": false,
            "event": "休息",
            "room": {}
          },
          {
            "started_at": 1571447700,
            "ended_at": 1571450400,
            "isBroadCast": false,
            "room": [
              {
                "speakers": [
                  {
                    "name": "家佳",
                    "name_e": "Hilbert Boyle",
                    "speaker_id": 2,
                    "company": "大國集團公司",
                    "company_e": "Da Kao",
                    "job_title": "incidunt",
                    "job_title_e": "incidunt",
                    "img": {
                      "web": "https://picsum.photos/200",
                      "mobile": "https://picsum.photos/200"
                    }
                  }
                ],
                "topic": "Maxime nesciunt.",
                "topic_e": "Est aliquid sed eum quae in.",
                "summary": "summary",
                "summary_e": "summary",
                "community_partner": "MO",
                "is_keynote": false,
                "is_online": false,
                "started_at": 1571446800,
                "ended_at": 1571450400,
                "room": "R1",
                "floor": "3F",
                "tags": [
                  {
                    "color": "#01aaf0",
                    "name": "Blockchain"
                  },
                  {
                    "color": "#01aaf0",
                    "name": "IoT"
                  },
                  {
                    "color": "#ff4492",
                    "name": "Startup"
                  }
                ],
                "recordable": true,
                "level": "Basic",
                "session_id": 2019002,
                "sponsor_info": {
                  "name": "大國集團公司",
                  "name_e": "Da Kao",
                  "logo_path": "https://picsum.photos/200"
                }
              },
              {
                "speakers": [
                  {
                    "name": "家佳",
                    "name_e": "Hilbert Boyle",
                    "speaker_id": 3,
                    "company": "大國集團公司",
                    "company_e": "Da Kao",
                    "job_title": "incidunt",
                    "job_title_e": "incidunt",
                    "img": {
                      "web": "https://picsum.photos/200",
                      "mobile": "https://picsum.photos/200"
                    }
                  }
                ],
                "topic": "Maxime nesciunt.",
                "topic_e": "Est aliquid sed eum quae in.",
                "summary": "summary",
                "summary_e": "summary",
                "community_partner": "",
                "is_keynote": false,
                "is_online": false,
                "started_at": 1571446800,
                "ended_at": 1571450400,
                "room": "R2",
                "floor": "4F",
                "tags": [
                  {
                    "color": "#01aaf0",
                    "name": "Blockchain"
                  },
                  {
                    "color": "#01aaf0",
                    "name": "IoT"
                  },
                  {
                    "color": "#ff4492",
                    "name": "Startup"
                  }
                ],
                "recordable": true,
                "level": "Basic",
                "session_id": 2019003,
                "sponsor_info": {
                  "name": "大國集團公司",
                  "name_e": "Da Kao",
                  "logo_path": "https://picsum.photos/200"
                }
              },
              {
                "speakers": [
                  {
                    "name": "家佳",
                    "name_e": "Hilbert Boyle",
                    "speaker_id": 4,
                    "company": "大國集團公司",
                    "company_e": "Da Kao",
                    "job_title": "incidunt",
                    "job_title_e": "incidunt",
                    "img": {
                      "web": "https://picsum.photos/200",
                      "mobile": "https://picsum.photos/200"
                    }
                  }
                ],
                "topic": "Maxime nesciunt.",
                "topic_e": "Est aliquid sed eum quae in.",
                "summary": "summary",
                "summary_e": "summary",
                "community_partner": "",
                "is_keynote": false,
                "is_online": false,
                "started_at": 1571446800,
                "ended_at": 1571450400,
                "room": "R3",
                "floor": "4F",
                "tags": [
                  {
                    "color": "#01aaf0",
                    "name": "Blockchain"
                  },
                  {
                    "color": "#01aaf0",
                    "name": "IoT"
                  },
                  {
                    "color": "#ff4492",
                    "name": "Startup"
                  }
                ],
                "recordable": true,
                "level": "Basic",
                "session_id": 2019004,
                "sponsor_info": {
                  "name": "大國集團公司",
                  "name_e": "Da Kao",
                  "logo_path": "https://picsum.photos/200"
                }
              }
            ]
          }
        ]
      }
    ]
  }
  ```

## 主要議程清單

提供過濾議程標籤後的議程清單

- **URL**

### 欄位說明

- speakers(array): 講師鎮列
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
- topic(string): 議程名稱
- topic_e(string): 議程英文名稱
- summary(string): 議程簡介中文
- summary_e(string): 議程簡介英文
- is_keynote(bool): 是否為 keynote 議程
- started_at(timestamp): 議程開始時間，單位為秒
- ended_at(timestamp): 議程結束時間，單位為秒
- room(string): 議程廳
- floor(string): 樓層
- sponsor_id(int): 贊助商編號，如果不是贊助商講者則為 0
- recordable(bool): 是否提供錄影
- level(string): 議程難易度
- tags(array): 議程標籤
  - color(string): 標籤色碼
  - name(string): 標籤名稱
- session_id(int): 議程編號，會與 speaker_id 一樣
- sponsor_info(object):
  - name(string): 贊助商中文名稱
  - name_e(string): 贊助商英文名稱
  - logo_path(string): 贊助商圖片

### Request

- **URL**

  /api/2019/session/list?tags=:tags

- **Method**

  `GET`

- **URL Params**

    **Optional:**

    - tags=[string]
      - e.g., `/api/2019/session/list?tags=ai,cloud`

- **Success Response**

  - Code: 200
  - Content:

  ```json
  {
    "success": true,
    "message": "Success.",
    "data": [
      {
        "speakers": [
          {
            "name": "家佳",
            "name_e": "Hilbert Boyle",
            "speaker_id": 1,
            "company": "大國集團公司",
            "company_e": "Da Kao",
            "job_title": "incidunt",
            "job_title_e": "incidunt",
            "img": {
              "web": "https://picsum.photos/200",
              "mobile": "https://picsum.photos/200"
            }
          }
        ],
        "topic": "Maxime nesciunt.",
        "topic_e": "Est aliquid sed eum quae in.",
        "summary": "summary",
        "summary_e": "summary",
        "community_partner": "",
        "is_keynote": true,
        "is_online": false,
        "started_at": 1571446800,
        "ended_at": 1571450400,
        "room": "R2",
        "floor": "4F",
        "tags": [
          {
            "color": "#01aaf0",
            "name": "Blockchain"
          },
          {
            "color": "#01aaf0",
            "name": "IoT"
          },
          {
            "color": "#ff4492",
            "name": "Startup"
          }
        ],
        "recordable": true,
        "level": "Basic",
        "session_id": 2019001,
        "sponsor_info": {
          "name": "大國集團公司",
          "name_e": "Da Kao",
          "logo_path": "https://picsum.photos/200"
        }
      }
    ]
  }
  ```

## 主要議程資訊

提供單一議程資訊

- **URL**

### 欄位說明

- speakers(array): 講師鎮列
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
- topic(string): 議程名稱
- topic_e(string): 議程英文名稱
- summary(string): 議程簡介中文
- summary_e(string): 議程簡介英文
- is_keynote(bool): 是否為 keynote 議程
- started_at(timestamp): 議程開始時間，單位為秒
- ended_at(timestamp): 議程結束時間，單位為秒
- room(string): 議程廳
- floor(string): 樓層
- sponsor_id(int): 贊助商編號，如果不是贊助商講者則為 0
- recordable(bool): 是否提供錄影
- level(string): 議程難易度
- tags(array): 議程標籤
  - color(string): 標籤色碼
  - name(string): 標籤名稱
- session_id(int): 議程編號，會與 speaker_id 一樣
- sponsor_info(object):
  - name(string): 贊助商中文名稱
  - name_e(string): 贊助商英文名稱
  - logo_path(string): 贊助商圖片

### Request

- **URL**

  /api/2019/session/:session_id

- **Method**

  `GET`

- **URL Params**

  **Required:**

  - session_id=[integer]

- **Success Response**

  - Code: 200
  - Content:

  ```json
  {
    "success": true,
    "message": "Success.",
    "data": {
      "speakers": [
        {
          "name": "家佳",
          "name_e": "Hilbert Boyle",
          "speaker_id": 1,
          "company": "大國集團公司",
          "company_e": "Da Kao",
          "job_title": "incidunt",
          "job_title_e": "incidunt",
          "img": {
            "web": "https://picsum.photos/200",
            "mobile": "https://picsum.photos/200"
          }
        }
      ],
      "topic": "Maxime nesciunt.",
      "topic_e": "Est aliquid sed eum quae in.",
      "summary": "summary",
      "summary_e": "summary",
      "community_partner": "",
      "is_keynote": true,
      "is_online": true,
      "started_at": 1571446800,
      "ended_at": 1571450400,
      "room": "R2",
      "floor": "4F",
      "tags": [
        {
          "color": "#01aaf0",
          "name": "Blockchain"
        },
        {
          "color": "#01aaf0",
          "name": "IoT"
        },
        {
          "color": "#ff4492",
          "name": "Startup"
        }
      ],
      "recordable": true,
      "level": "Basic",
      "session_id": 2019001,
      "sponsor_info": {
        "name": "大國集團公司",
        "name_e": "Da Kao",
        "logo_path": "https://picsum.photos/200"
      }
    }
  }
  ```

- **Error Response**

  錯誤的 id

  - Code: 400
  - Content:

  ```json
  {
    "success": false,
    "message": "Bad request",
    "data": []
  }
  ```

  不存在的 id

  - Code: 404
  - Content:

  ```json
  {
    "success": false,
    "message": "Not found",
    "data": []
  }
  ```
