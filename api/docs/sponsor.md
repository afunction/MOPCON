**Sponsor Api**
----

Returns json data about sponsor information.

### 欄位說明

贊助商 API 的 resopnse 主要分為兩層，第一層為贊助級別分類，會依照級別將贊助商 group 起來，第二層為各個級別之贊助商細資料

#### 贊助商類別分類

##### 注意事項

1. 級別有呈現順序，直接跑迴圈依序呈現 api 所提供的資訊即可， API 已經有排序過了
2. 如果此級別沒有任何贊助商則不會有這個 key ，主要目的為讓 Client 可以無需進行任何判斷直接進行呈現

- name(string): 贊助商級別中文名稱
- name_e(string): 贊助商級別英文名稱
- data(array): 贊助商相關資訊，可以參考下方

```json
{
  "success": true,
  "message": "success",
  "data": [
    {
      "name": "Tony Stark",
      "name_e": "Tony Stark",
      "data": []
    },
    {
      "name": "Bruce Wayne",
      "name_e": "Bruce Wayne",
      "data": []
    },
    {
      "name": "Hacker",
      "name_e": "Hacker",
      "data": []
    },
    {
      "name": "Geek",
      "name_e": "Geek",
      "data": []
    },
    {
      "name": "Developer",
      "name_e": "Developer",
      "data": []
    },
    {
      "name": "教育贊助",
      "name_e": "Education Sponsor",
      "data": []
    },
    {
      "name": "特別感謝",
      "name_e": "Special Thanks",
      "data": []
    },
    {
      "name": "協辦單位",
      "name_e": "Co Organizer",
      "data": []
    },
    {
      "name": "高雄市經濟發展局獎勵會議展覽活動計畫贊助",
      "name_e": "高雄市經濟發展局獎勵會議展覽活動計畫贊助",
      "data": []
    }
  ]
}
```
#### 贊助商欄位

- logo(string): 贊助商 LOGO
- name(string): 贊助商中文名稱
- name_e(string): 贊助商英文名稱
- sponsor_id(int): 贊助商 id
- about_us(string): 贊助商簡介
- about_us_e(string): 贊助商英文簡介
- facebook_url(string): 粉絲頁連結（如果沒有提供會使用 empty string)
- official_website(string): 企業官方網站（如果沒有提供會使用 empty string）
- career_information(string): 企業徵才資訊連結（如果沒有提供會使用 empty string)
- sponsor_type(string): 贊助商級別
- speaker_information(array): 此企業的相關講師（如果沒有則會使用 empty array)
  - img(object):
    - mobile(string): Mobile 使用的圖片連結
    - web(string): Web 使用的圖片連結
  - speaker_id(int): Speaker ID
  - session_id(int): Session ID
  - name(string): 講者名稱
  - name_e(string): 講者英文名稱
  - topic_name(string): 演講題目
  - topic_name_e(string): 演講英文題目
  - started_at(timestamp): 演講開始時間，單位為秒
  - ended_at(timestamp): 演講結束時間，單位為秒
  - room(string): 會議廳
  - tags(object):
    - ${color_hex}(array): 這個分類的 tags ， color_hex 為這個類別的色碼，只要是這個 tag 都是給這個色碼

### Request

* **URL**
  * **贊助商資訊**

    `/api/2019/sponsor`

* **Method:**

  `GET`

* **URL Params**

  **Optional:**

    sponsor_id = {sponsor_id}

* **Data Params**

  None

* **Success Response:**

  * **Code:** 200 <br />
    **Content:**

    `/api/2019/sponsor`
    ```json
    {
      "success": true,
      "message": "success",
      "data": {
        "1": {
          "name": "Bruce Wayne",
          "name_e": "Bruce Wayne",
          "data": [
            {
              "logo_path": "https://www.logaster.com/blog/wp-content/uploads/2018/05/LogoMakr.png",
              "sponsor": "史塔克",
              "sponsor_e": "Stark-industry0",
              "sponsor_id": 1,
              "about_us": "我們是台灣史塔克,史塔克很棒棒",
              "about_us_e": "We are Stark-industry Taiwan. We are great",
              "facebook_url": "https://www.facebook.com/Stark-industryTaiwan/?brand_redir=104958162837",
              "official_website": "https://www.Stark-industry.com",
              "career_information": "https://careers.Stark-industry.com/jobs/",
              "sponsor_type": "tony_stark",
              "speaker_information": [
                {
                  "img": {
                    "web": "https://png.pngtree.com/svg/20170518/274aed119e.svg",
                    "mobile": "https://png.pngtree.com/svg/20170518/274aed119e.svg"
                  },
                  "speaker_id": 1,
                  "session_id": 2019001,
                  "name": "小明",
                  "name_e": "little min",
                  "topic_name": "Stark-industry Taiwan CEO",
                  "topic_name_e": "Stark-industry Taiwan CEO",
                  "started_at": 1571537400,
                  "ended_at": 1571539800,
                  "room": "R1",
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
                  ]
                }
              ]
            }
          ]
        }
      }
    }
    ```
    `/api/2019/sponsor?sponsor_id=1`
    ```json
    {
        "success": true,
        "message": "success",
        "data": [
            {
                "logo_path": "https://www.logaster.com/blog/wp-content/uploads/2018/05/LogoMakr.png",
                "sponsor": "史塔克",
                "sponsor_e": "Stark-industry0",
                "sponsor_id": 1,
                "about_us": "我們是台灣史塔克,史塔克很棒棒",
                "about_us_e": "We are Stark-industry Taiwan. We are great",
                "facebook_url": "https://www.facebook.com/Stark-industryTaiwan/?brand_redir=104958162837",
                "official_website": "https://www.Stark-industry.com",
                "career_information": "https://careers.Stark-industry.com/jobs/",
                "sponsor_type": "tony_stark",
                "speaker_information": [
                    {
                        "img": {
                            "web": "https://png.pngtree.com/svg/20170518/274aed119e.svg",
                            "mobile": "https://png.pngtree.com/svg/20170518/274aed119e.svg",
                        },
                        "speaker_id": 1,
                        "session_id": 2019001,
                        "name": "小明",
                        "name_e": "little min",
                        "topic_name": "Stark-industry Taiwan CEO",
                        "topic_name_e": "Stark-industry Taiwan CEO",
                        "started_at": 1571537400,
                        "ended_at": 1571539800,
                        "room": "R1",
                        "tags": {
                          "#98ce02": [],
                          "#ff4492": [],
                          "#01aaf0": [
                            "IoT"
                          ]
                        }
                    }
                ]
            }
        ]
    }
    ```

* **Sample Call:**

  ```javascript
    $.ajax({
      url: "/api/2019/sponsor",
      dataType: "json",
      type : "GET",
      success : function(r) {
        console.log(r);
      }
    });
  ```
