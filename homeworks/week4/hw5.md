## 請以自己的話解釋 API 是什麼
- API 是一個可以讓兩端溝通的一個標準跟管道，並依據不同的東西跟使用方式有不一樣的名稱跟種類，例如：Web API（透過網路溝通的 API）
- 兩端分成：
1. 接收資料或功能的一方
2. 提供資料或功能的一方


## 請找出三個課程沒教的 HTTP status code 並簡單介紹
201 Created:
請求成功且新的資源成功被創建，通常用於 POST 或一些 PUT 請求後的回應。
(在做作業 week4 hw2，create 成功後的 status code)

400 Bad Request:
此回應意味伺服器因為收到無效語法，而無法理解請求。
(在做作業 week4 hw4，給予錯誤 URL 時有遇過)

414 URI Too Long:
客戶端的 URI 請求超過伺服器願意解析的長度。


## 假設你現在是個餐廳平台，需要提供 API 給別人串接並提供基本的 CRUD 功能，包括：回傳所有餐廳資料、回傳單一餐廳資料、刪除餐廳、新增餐廳、更改餐廳，你的 API 會長什麼樣子？請提供一份 API 文件。

### Base URL: https://lidemy-delicious-store.com

| 說明	|Method	|path	|參數	|範例
|------|-------|-----|-----|-----
| 獲取熱門餐廳資訊	|GET	|/stores	|_limit:限制回傳資料數量	|/stores?_limit=5
| 依種類搜尋餐廳資訊	|GET	|/stores/:type	|_limit:限制回傳資料數量 |/stores/:japanese?_limit=5
| 新增餐廳	|POST	|/stores	|name: 餐廳名稱	|無
| 刪除餐廳	|DELETE	|/stores/:餐廳編號	|無	|無
| 更改餐廳資訊	|PATCH	|/stores/:餐廳編號	|name: 餐廳名稱, type: 餐廳種類	|無