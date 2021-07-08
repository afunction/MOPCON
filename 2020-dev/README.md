# MOPCON 2020

## 環境變數設定

複製 `.env.example` 至 `.env`。

```
cp .env.example .env
```

至 `.env` 設定環境變數，請將以下設定依照開發環境修改。

```dotenv
BASE_URL=https://mopcon.org
```

控制頁面顯示，false 不顯示，(預設 true)

```dotenv
SPEAKER=true
SCHEDULE=false
SCHEDULE_UNCONF=false
SPONSOR=false
COMMUNITY=false
```

## Build Setup

```bash
# install dependencies
$ npm install

# serve with hot reload at localhost:3000
$ npm run dev

# generate static project
$ npm run generate
```

# http://localhost:3000/2020

For detailed explanation on how things work, checkout [Nuxt.js docs](https://nuxtjs.org).
