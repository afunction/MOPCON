# APP Initail API

APP 剛啟動時獲得一些設定資訊

- URL

  /2019/initial

- Method

  `GET`

- URL Params

  null

- Data Params

  null

- Success Response

  - Code: 200
  - Content:

  ```json
  {
    "success": true,
    "message": "Success.",
    "data": {
    	"api_server": {
    		"mopcon": "https://mopcon.org",
    		"game": "https://game.mopcon.org"
    	},
    	"enable_game": false
    }
  }
  ```
- Error Response

  - Code: 404
  - Content:

  ```json
  {
    "success": false,
    "message": "Resource file not found",
    "data": {}
  }
  ```
