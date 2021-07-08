# Speaker API

取得講者資訊

## 取得所有講者資訊

### 欄位說明

- name(string): 講師中文姓名
- name_e(string): 講師英文名稱
- company(string): 講師公司（如果沒給會給空字串）
- company_e(string): 講師公司英文名稱（如果沒給會給空字串）
- job_title(string): 講師職稱（如果沒有給會給空字串）
- job_title_e(string): 講師英文職稱（如果沒有給會給空字串）
- bio(string): 講師中文介紹
- bio_e(string): 講師英文介紹
- img(object):
  - web(string): web 介面使用的 image url
  - mobile(string): mobile 介面使用的 image url
- link_fb(string): Facebook（如果沒有給會給空字串）
- link_github(string): Github（如果沒有給會給空字串）
- link_twitter(string): Twitter（如果沒有給會給空字串）
- link_other(string): 個人部落格或其他網站（如果沒有給會給空字串）
- session(int): 議程編號
- topic(string): 議程中文名稱
- topic_e(string): 議程英文名稱
- summary(string): 議程簡介中文
- summary_e(string): 議程簡介英文
- community_partner(string): 合作社群
- is_keynote(bool): 是否為 keynote ，色碼為 `#ff4492`
- is_online(bool): 是否為遠距議程
- started_at(timestamp): 議程開始時間，單位為秒
- ended_at(timestamp): 議程開始時間，單位為秒
- room(string): 講師議程
- floor(string): 議程所在樓層
- sponsor_id(int): 對應到 Sponsor API 的 sponsor_id ，如果沒有贊助廠商則為 0 ，反之則為「夥伴議程」色碼為 `#98ce02`
- recordable(bool): 此議程是否可以錄影，色碼為 `#ff4492`
- level(string): 議程等級
- tags(object): 此議程標籤
  - ${color_hex}(array): 這個分類的 tags ， color_hex 為這個類別的色碼，只要是這個 tag 都是給這個色碼

### Request

- **URL**

  `/api/2019/speaker`

- **Method**

  `GET`

- **URL Params**

  None

- **Data Params**

  None

- **Success Response:**

  - Code: 200

    Content:

    ```json
    {
      "success": true,
      "message": "Success.",
      "data": [
        {
          "name": "家佳",
          "name_e": "Hilbert Boyle",
          "speaker_id": 1,
          "company": "大國集團公司",
          "company_e": "Da Kao",
          "job_title": "incidunt",
          "job_title_e": "incidunt",
          "bio": "Ullam alias magni fugiat at. Error earum aut aperiam cupiditate. Atque suscipit voluptas aut sed ullam architecto.",
          "bio_e": "Aliquam voluptatem iste tenetur nesciunt. Maiores consequatur labore minus voluptatum odio inventore magni. Vero suscipit debitis commodi fugit non.",
          "img": {
            "web": "https://picsum.photos/200",
            "mobile": "https://picsum.photos/200",
          },
          "link_fb": "https://www.funk.com/sit-voluptas-cumque-reiciendis-est",
          "link_github": "https://www.schoen.com/id-sunt-ut-quod-modi-voluptas-commodi-maxime",
          "link_twitter": "http://oconnell.info/ut-et-iste-necessitatibus-reprehenderit",
          "link_other": "http://www.sporer.com/quis-eveniet-incidunt-quibusdam-illo-commodi-et-eaque",
          "session_id": 2019001,
          "topic": "Maxime nesciunt.",
          "topic_e": "Est aliquid sed eum quae in.",
          "summary": "Repudiandae voluptatem placeat qui modi quia dignissimos. Tempora in ex saepe officiis sunt laborum. Quia eum qui totam dolor numquam.",
          "summary_e": "Aut ducimus odio distinctio vitae. Iure delectus quam voluptatem iste reiciendis nisi et. Temporibus nihil repellat earum molestiae. Autem ut a eveniet omnis quidem. Eveniet ducimus et quaerat. Vitae porro sed molestiae architecto veritatis modi. Earum et consequuntur ut qui quas ex et. Neque eos dolore ut maiores perspiciatis dolor.",
          "community_partner": "",
          "is_keynote": true,
          "is_online": false,
          "started_at": "1571446800",
          "ended_at": "1571450400",
          "room": "R2",
          "floor": "4F",
          "sponsor_id": "1",
          "recordable": true,
          "level": "Basic",
          "tags": [
            {
            "color": "#01aaf0",
            "name": "IoT"
            },
            {
              "color": "#01aaf0",
              "name": "Blockchain"
            },
            {
              "color": "#ff4492",
              "name": "Startup"
            },
          ]
        }
      ]
    }
    ```

- **Error Response:**

  - Code: 404

    Content:

    ```json
    {
      "Success": false,
      "message": "Not found",
      "data": []
    }
    ```

## 取得單一講者資訊

### 欄位說明

- name(string): 講師中文姓名
- name_e(string): 講師英文名稱
- company(string): 講師公司（如果沒給會給空字串）
- company_e(string): 講師公司英文名稱（如果沒給會給空字串）
- job_title(string): 講師職稱（如果沒有給會給空字串）
- job_title_e(string): 講師英文職稱（如果沒有給會給空字串）
- bio(string): 講師中文介紹
- bio_e(string): 講師英文介紹
- img(object):
  - web(string): web 介面使用的 image url
  - mobile(string): mobile 介面使用的 image url
- link_fb(string): Facebook（如果沒有給會給空字串）
- link_github(string): Github（如果沒有給會給空字串）
- link_twitter(string): Twitter（如果沒有給會給空字串）
- link_other(string): 個人部落格或其他網站（如果沒有給會給空字串）
- session_id(int): 議程編號
- topic(string): 議程中文名稱
- topic_e(string): 議程英文名稱
- summary(string): 議程簡介中文
- summary_e(string): 議程簡介英文
- community_partner(string): 合作社群
- is_keynote(bool): 是否為 keynote ，色碼為 `#ff4492`
- is_online(bool): 是否為遠距議程
- started_at(timestamp): 議程開始時間，單位為秒
- ended_at(timestamp): 議程開始時間，單位為秒
- room(string): 講師議程
- floor(string): 議程所在樓層
- sponsor_id(int): 對應到 Sponsor API 的 sponsor_id ，如果沒有贊助廠商則為 0 ，反之則為「夥伴議程」色碼為 `#98ce02`
- recordable(bool): 此議程是否可以錄影，色碼為 `#ff4492`
- level(string): 議程等級
- tags(object): 此議程標籤
  - ${color_hex}(array): 這個分類的 tags ， color_hex 為這個類別的色碼，只要是這個 tag 都是給這個色碼

### Request

- **URL**

  `/api/2019/speaker/:id`

- **Method**

  `GET`

- **URL Params**

  **Required:**

  - id=[integer]

- **Data Params**

  None

- **Success Response:**

  - Code: 200

    Content:

    ```json
    {
      "success": true,
      "message": "Success.",
      "data": {
        "name": "家佳",
        "name_e": "Hilbert Boyle",
        "speaker_id": 1,
        "company": "大國集團公司",
        "company_e": "Da Kao",
        "job_title": "incidunt",
        "job_title_e": "incidunt",
        "bio": "Ullam alias magni fugiat at. Error earum aut aperiam cupiditate. Atque suscipit voluptas aut sed ullam architecto.",
        "bio_e": "Aliquam voluptatem iste tenetur nesciunt. Maiores consequatur labore minus voluptatum odio inventore magni. Vero suscipit debitis commodi fugit non.",
        "img": {
          "web": "https://picsum.photos/200",
          "mobile": "https://picsum.photos/200",
        },
        "link_fb": "https://www.funk.com/sit-voluptas-cumque-reiciendis-est",
        "link_github": "https://www.schoen.com/id-sunt-ut-quod-modi-voluptas-commodi-maxime",
        "link_twitter": "http://oconnell.info/ut-et-iste-necessitatibus-reprehenderit",
        "link_other": "http://www.sporer.com/quis-eveniet-incidunt-quibusdam-illo-commodi-et-eaque",
        "session_id": 2019001,
        "topic": "Maxime nesciunt.",
        "topic_e": "Est aliquid sed eum quae in.",
        "summary": "Repudiandae voluptatem placeat qui modi quia dignissimos. Tempora in ex saepe officiis sunt laborum. Quia eum qui totam dolor numquam.",
        "summary_e": "Aut ducimus odio distinctio vitae. Iure delectus quam voluptatem iste reiciendis nisi et. Temporibus nihil repellat earum molestiae. Autem ut a eveniet omnis quidem. Eveniet ducimus et quaerat. Vitae porro sed molestiae architecto veritatis modi. Earum et consequuntur ut qui quas ex et. Neque eos dolore ut maiores perspiciatis dolor.",
        "community_partner": "MO",
        "is_keynote": true,
        "is_online": false,
        "started_at": "1571446800",
        "ended_at": "1571450400",
        "room": "R2",
        "floor": "4F",
        "sponsor_id": "1",
        "recordable": true,
        "level": "Basic",
        "tags": [
          {
            "color": "#01aaf0",
            "name": "IoT"
          },
          {
            "color": "#01aaf0",
            "name": "Blockchain"
          },
          {
            "color": "#ff4492",
            "name": "Startup"
          },
        ]
      }
    }
    ```

- **Error Response:**

  - Code: 404

    Content:

    ```json
    {
      "Success": false,
      "message": "Not found",
      "data": []
    }
    ```

  - Code: 400

    Content:

    ```json
    {
      "Success": false,
      "message": "Error Message",
      "data": []
    }
    ```

## 取得所有講師演講主題

### 欄位說明

回傳目前議程所有的 Tags ，此 API 目前僅為 Web 需使用

### Request

- **URL**

  `/api/2019/speaker/tags`

- **Method**

  `GET`

- **URL Params**

  None

- **Data Params**

  None

- **Success Response:**

  - 2019

    - Code: 200

      Content:

      ```json
      {
        "success": true,
        "message": "Success.",
        "data": [
          {
            "color": "#01aaf0",
            "name": "IoT"
          },
          {
            "color": "#ff4492",
            "name": "Startup"
          },
          {
            "color": "#01aaf0",
            "name": "Mobile App"
          }
        ]
      }
      ```
  - 2020 (含)以後

    - Code: 200

      Content:

      ```json
      {
        "success": true,
        "message": "Success.",
        "data": [
          {
            "color": {
              "web": "#651fff",
              "mobile": "#ffcc00"
            },
            "name": "UI/UX"
          },
          {
            "color": {
              "web": "#651fff",
              "mobile": "#ffcc00"
            },
            "name": "Web"
          },
          {
            "color": {
              "web": "#651fff",
              "mobile": "#ffcc00"
            },
            "name": "Data Analyzing"
          },
        ]
      }
      ```

- **Error Response:**

  - Code: 400

    Content:

    ```json
    {
      "Success": false,
      "message": "Error message",
      "data": []
    }
    ```
