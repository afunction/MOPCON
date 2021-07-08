# APP 首頁 API

## 首頁資訊

提供banner圖片清單及列出最新消息(新-舊)

### 欄位說明
- banner(array): 首頁上方 banner，沒有則為 empty array
  - img(string): banner 圖片
  - link(string): 點擊後導向連結，沒有則為空字串
- news(array): 代表為最新消息清單，沒有則為 empty array
  - id(int): 對應該消息的 id
  - date(timestamp): 消息產生的時間點，單位為秒
  - title(string): 該消息的題目
  - description(string): 該消息的內文
  - link(string): 對應到該消息的 url

### Request

- **URL**

    /api/2019/home

- **Method**

    `GET`

- **Success Response**

  - Code: 200
  - Content:
  ```JSON
  {
    "success": true,
    "message": "Success.",
    "data": {
      "banner": [
        {
          "img": "https://picsum.photos/200",
          "link": ""
        }
      ],
      "news": [
        {
          "id": 6,
          "date": 1571454900,
          "title": "PLAY啥咪 GAME?",
          "description": "APP大地遊戲&現場攤位遊戲等你來PLAY!",
          "link": "https://www.facebook.com/mopcon/posts/1786796171446091" 
        }
      ]
    }
  }
  ```
