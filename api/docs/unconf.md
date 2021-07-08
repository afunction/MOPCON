# 交流場次 API

## 交流場次資訊
### 欄位說明

交流場次 API 的 resopnse 主要分為兩層，第一層為以天分類，會依照時間順序 group 起來，時間以當天的0點0分為timestamp，第二層為當天交流場次的詳細資料。

##### 注意事項

1. 時間有呈現順序，直接跑迴圈依序呈現 api 所提供的資訊即可， API 已經有排序過了

- date(timestamp): 當天 0 點 0 分 0 秒的 timestamp，單位為秒
- period(array): 交流場次相關資訊，可以參考下方

    ```json
    {
        "success": true,
        "message": "success",
        "data": [
            {
                "date": 1571414400,
                "period": []
            },
            {
                "date": 1571500800,
                "period": []
            }
        ]
    }
    ```
### 欄位說明

- date(timestamp): 議程日時間，單位為秒
- period(array): 本日議程所有交流議程
  - started_at(timestamp): 本議程區間開始時間，單位為秒
  - ended_at(timestamp): 本議程區間結束時間，單位為秒
  - isBroadCast(bool): 是否為聯播議程
  - event(string): 議程區塊名稱，通常用來顯示無議程表示（EX: 休息、報到等），如果在議程時間則為空字串
  - room(array): 議程詳細資訊，如果沒有議程會以 empty array 表示
    - speakers(array): 講師鎮列，在交流議程僅會有一位
        - name(string): 講師中文名稱
        - name_e(string): 講師英文名稱
        - speaker_id(int): 講者 ID (恆為 0)
        - company(string): 公司中文名稱 (恆為 empty string)
        - company_e(string): 公司英文名稱 (恆為 empty string)
        - job_title(string): 職位中文名稱 (恆為 empty string)
        - job_title_e(string): 職位英文名稱 (恆為 empty string)
        - img(object): 講者圖片
          - web(string): 網頁版使用 (恆為 empty string)
          - mobile(string): 手機版使用 (恆為 empty string)
    - topic(string): 議程名稱
    - topic_e(string): 議程英文名稱
    - summary(string): 議程簡介中文 (恆為 empty string)
    - summary_e(string): 議程簡介英文 (恆為 empty string)
    - is_keynote(bool): 是否為 keynote 議程 (恆為 false)
    - started_at(timestamp): 議程開始時間，單位為秒
    - ended_at(timestamp): 議程結束時間，單位為秒
    - room(string): 議程廳
    - floor(string): 樓層
    - sponsor_id(int): 贊助商編號，如果不是贊助商講者則為 0
    - recordable(bool): 是否提供錄影 (恆為 false)
    - level(string): 議程難易度
    - tags(array): 議程標籤
      - color(string): 標籤色碼
      - name(string): 標籤名稱
    - session_id(int): 議程編號

### Request

- **URL**

  /api/2019/unconf

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
            "started_at": 1571447700,
            "ended_at": 1571450400,
            "isBroadCast": false,
            "event": "",
            "room": [
              {
                "speakers": [
                  {
                    "name": "家佳",
                    "name_e": "Hilbert Boyle",
                    "speaker_id": 0,
                    "company": "",
                    "company_e": "",
                    "job_title": "",
                    "job_title_e": "",
                    "img": {
                      "web": "",
                      "mobile": "",
                    }
                  }
                ],
                "topic": "Maxime nesciunt.",
                "topic_e": "Est aliquid sed eum quae in.",
                "summary": "",
                "summary_e": "",
                "is_keynote": false,
                "started_at": 1571446800,
                "ended_at": 1571450400,
                "room": "UnConf",
                "floor": "3F",
                "tags": [],
                "recordable": false,
                "level": "Basic",
                "session_id": 2019101,
                "sponsor_id": 0
              }
            ]
          }
        ]
      }
    ]
  }
  ```

## Unconf 議程清單

列出所有交流議程清單

- **URL**

### 欄位說明

- speakers(array): 講師陣列，在交流場次僅有一位講者
    - name(string): 講師中文名稱
    - name_e(string): 講師英文名稱
    - speaker_id(int): 講者 ID (恆為 0)
    - company(string): 公司中文名稱 (恆為 empty string)
    - company_e(string): 公司英文名稱 (恆為 empty string)
    - job_title(string): 職位中文名稱 (恆為 empty string)
    - job_title_e(string): 職位英文名稱 (恆為 empty string)
    - img(object): 講者圖片
      - web(string): 網頁版使用 (恆為 empty string)
      - mobile(string): 手機版使用 (恆為 empty string)
- topic(string): 議程名稱
- topic_e(string): 議程英文名稱
- summary(string): 議程簡介中文 (恆為 empty string)
- summary_e(string): 議程簡介英文 (恆為 empty string)
- is_keynote(bool): 是否為 keynote 議程 (恆為 false)
- started_at(timestamp): 議程開始時間，單位為秒
- ended_at(timestamp): 議程結束時間，單位為秒
- room(string): 議程廳
- floor(string): 樓層
- sponsor_id(int): 贊助商編號，如果不是贊助商講者則為 0
- recordable(bool): 是否提供錄影 (恆為 false)
- level(string): 議程難易度
- tags(array): 議程標籤
  - color(string): 標籤色碼
  - name(string): 標籤名稱
- session_id(int): 議程編號

### Request

- **URL**

  `/api/2019/unconf/list`

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
        "speakers": [
          {
            "name": "家佳",
            "name_e": "Hilbert Boyle",
            "speaker_id": 0,
            "company": "",
            "company_e": "",
            "job_title": "",
            "job_title_e": "",
            "img": {
              "web": "",
              "mobile": "",
            }
          }
        ],
        "topic": "Maxime nesciunt.",
        "topic_e": "Est aliquid sed eum quae in.",
        "summary": "",
        "summary_e": "",
        "is_keynote": false,
        "started_at": 1571446800,
        "ended_at": 1571450400,
        "room": "UnConf",
        "floor": "3F",
        "tags": [],
        "recordable": false,
        "level": "Basic",
        "session_id": 2019101,
        "sponsor_id": 0
      }
    ]
  }
  ```

## 主要議程資訊

提供單一議程資訊

- **URL**

### 欄位說明

- speakers(array): 講師資料
    - name(string): 講師中文名稱
    - name_e(string): 講師英文名稱
    - speaker_id(int): 講者 ID (恆為 0)
    - company(string): 公司中文名稱 (恆為 empty string)
    - company_e(string): 公司英文名稱 (恆為 empty string)
    - job_title(string): 職位中文名稱 (恆為 empty string)
    - job_title_e(string): 職位英文名稱 (恆為 empty string)
    - topic(string): 議程名稱
    - topic_e(string): 議程英文名稱
    - img(object): 講者圖片
      - web(string): 網頁版使用 (恆為 empty string)
      - mobile(string): 手機版使用 (恆為 empty string)
- summary(string): 議程簡介中文 (恆為 empty string)
- summary_e(string): 議程簡介英文 (恆為 empty string)
- is_keynote(bool): 是否為 keynote 議程 (恆為 false)
- started_at(timestamp): 議程開始時間，單位為秒
- ended_at(timestamp): 議程結束時間，單位為秒
- room(string): 議程廳
- floor(string): 樓層
- sponsor_id(int): 贊助商編號，如果不是贊助商講者則為 0
- recordable(bool): 是否提供錄影 (恆為 false)
- level(string): 議程難易度
- tags(array): 議程標籤
  - color(string): 標籤色碼
  - name(string): 標籤名稱
- session_id(int): 議程編號

### Request

- **URL**

  `/api/2019/unconf/:session_id`

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
          "speaker_id": 0,
          "company": "",
          "company_e": "",
          "job_title": "",
          "job_title_e": "",
          "img": {
            "web": "",
            "mobile": "",
          }
        }
      ],
      "topic": "Maxime nesciunt.",
      "topic_e": "Est aliquid sed eum quae in.",
      "summary": "",
      "summary_e": "",
      "is_keynote": false,
      "started_at": 1571446800,
      "ended_at": 1571450400,
      "room": "UnConf",
      "floor": "3F",
      "tags": [],
      "recordable": false,
      "level": "Basic",
      "session_id": 2019101,
      "sponsor_id": 0
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
