# 志工團隊 API

## 志工團隊清單

列出所有志工團隊

### 欄位說明

- volunteer(string): 代表為志工清單
    - id(int): 組別 ID
    - name(string): 組別名稱
    - name_e(string): 組別英文名稱，沒有則為空字串
    - photo(string): icon 圖片

### Request

- **URL**

    /api/2019/volunteer

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
      "volunteer": [
        {
          "id": 1,
          "name": "議程委員會",
          "name_e": "",
          "photo": "/images/community/qwdqwdqwdq.jpg"
        },
        {
          "id": 2,
          "name": "議程組",
          "name_e": "",
          "photo": "/images/community/qwdqwdqwdq.jpg"
        },
        {
          "id":"3",
          "name": "財務組",
          "name_e": "",
          "photo": "/images/community/qwdqwdqwdq.jpg"
        }
      ]
    }
  }
  ```

## 志工團隊 Volunteer

取得單一組別詳細資訊

### 欄位說明

- name(string): 組別名稱
- name_e(string): 組別英文名稱，沒有則為空字串
- photo(string): icon圖片
- members(array): 組員名單
    - (string): 組員名稱
- introduction(string): 中文簡介
- introduction_e(string): 英文簡介，沒有則為空字串

### Request

- **URL**

  /api/2019/volunteer/:id

- **Method**

  `GET`

- **URL Params**

    **Required:**

    - id=[integer]

- **Success Response**

  - Code: 200
  - Content:
  ```JSON
  {
    "success": true,
    "message": "Success.",
    "data": {
      "name": "場務組",
      "name_e": "",
      "photo": "/images/community/qwdqwdqwdq.jpg",
      "members": [
        "李曉明",
        "王曉華"
      ],
      "introduction": "場地之守護神，照料與會者的一切，為工人把屎把尿。場地的一切柴米油鹽醬醋茶都是我們負責。",
      "introduction_e": ""
    }
  }
  ```

- **Error Response**

  錯誤的 id

  - Code: 400
  - Content:
  ```JSON
  {
    "success": false,
    "message": "Bad request",
    "data": []
  }
  ```

  不存在的 id
  - Code: 404
  - Content:
  ```JSON
  {
    "success": false,
    "message": "Not found",
    "data": []
  }
  ```
