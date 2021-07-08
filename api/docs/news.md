# 最新消息 API

## 最新消息資訊
### 欄位說明

交流場次 API 的 resopnse 只會有一層 array，預設回傳5則最新消息，可以透過 limit 這個參數決定要回傳多少則

##### 注意事項

1. array 排序為由新消息到舊消息，直接跑迴圈依序呈現 api 所提供的資訊即可， API 已經有排序過了

#### 最新消息欄位

- id(int): 對應該消息的 id
- date(timestamp): 消息產生的時間點，單位為秒
- title(string): 該消息的題目
- description(string): 該消息的內文
- link(string): 對應到該消息的 url
### Request
- **URL**

    /api/2019/news

- **Method**

    `GET`
*  **URL Params**

   **Optional:**
 
   `limit=[integer]`

- **Success Response**

  - Code: 200
  - Content:
  ```json
    {
        "success": true,
        "message": "success",
        "data": [
            {
                "id": 6,
                "date": 1571454900,
                "title": "PLAY啥咪 GAME?",
                "description": "APP大地遊戲&現場攤位遊戲等你來PLAY!",
                "link": "https://www.facebook.com/mopcon/posts/1786796171446091"
            }
        ]
    }
  ```
### 欄位說明

回傳對應 id 的最新消息

#### 最新消息欄位

- id(int): 對應該消息的 id
- date(timestamp): 消息產生的時間點，單位為秒
- title(string): 該消息的題目
- description(string): 該消息的內文
- link(string): 該貼文對應的url

### Request

**URL**

    /api/2019/news/:id

- **Method**

    `GET`
    
*  **URL Params**

   **Required:**
 
   `id=[integer]`

- **Success Response**

  - Code: 200
  - Content:
  ```json
    {
        "success": true,
        "message": "success",
        "data": {
            "id": 6,
            "date": 1571454900,
            "title": "PLAY啥咪 GAME?",
            "description": "APP大地遊戲&現場攤位遊戲等你來PLAY!",
            "link": "https://www.facebook.com/mopcon/posts/1786796171446091"
        }
    }
  ```