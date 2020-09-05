## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼
<!-- VARCHAR 會用在需要比較多文字內容的地方，例如：留言板的留言內容
TEXT 會用在一般訊息的儲存，例如：帳號、密碼 -->

作業檢討：
VARCAHR 可以設長度，所以建議用在當知道資料的大致長度的時候，以節省空間
TEXT 則用在當資料量比較大的時候，例如文章


## Cookie 是什麼？在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又是怎麼把 Cookie 帶去 Server 的？
Cookie 
1. 可以透過 Cookie 機制 存文字訊息在 clien 端
2. 瀏覽器提供 Cookie 給伺服器做 session 機制的方法，讓原本 stateless 的 HTTP 可以根據 session 機制來判斷 clien 端的狀態
3. 其他運用：身份驗證、廣告追蹤

在 HTTP 這一層要怎麼設定 Cookie：
1. 由伺服器回傳的 response 在 header 下 set-cookie 指令，然後瀏覽器便產生與紀錄一組 cookie 在 clien 端
2. 當瀏覽器再次傳送 request 到相同 domain 與 path 的 server 去時，會順便把相對應的 cookie 帶到 server


## 我們本週實作的會員系統，你能夠想到什麼潛在的問題嗎？
1. 當在留言板輸入有包含單引號（‘）或雙引號 (") 符號的時候，sql 會出現錯誤
2. 留言板沒有做特殊符號的 escape，可能被輸入程式語法


