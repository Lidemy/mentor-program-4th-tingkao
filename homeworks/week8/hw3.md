## 什麼是 Ajax？
AJAX即「Asynchronous JavaScript and XML」（非同步的JavaScript與XML技術，但是現在大多以 JSON 格式交換資料）

## 用 Ajax 與我們用表單送出資料的差別在哪？
- 相同之處：都是與伺服器端交換資料的方法

- 差異之處：

>      一般流程（按照程式碼順序執行，碰到 request，等 response 回來才繼續）：
>       Js 檔案（或表單）送 request -> 瀏覽器 -> 伺服器 -> response 給瀏覽器，瀏覽器重新渲染一個新的網頁 
>       但是一般來說前後兩頁面大部分的 HTML 是一樣的，所以耗費較多時間與寬頻

>     AJAX 流程（按照程式碼順序執行，碰到 request，送出 request 之後就繼續）： 
>       Js 檔案 送 request -> 瀏覽器 -> 伺服器 -> response 給瀏覽器，瀏覽器直接 pass 給 Js，並只有部分重新渲染
>       因為在伺服器和瀏覽器之間交換的資料大量減少，伺服器回應更快了，並且減少頁面空白時間、提高使用者體驗

- 在瀏覽器執行 Ajax 可透過：
  1. XMLHttpRequest
  2. $ajax (jQuery，based on (1.) )

- 在 node.js 執行 Ajax 可透過：
  1. require 一個名為 "request" 的 liberary 來傳送 request 給伺服器

## JSONP 是什麼？
1. 透過 ```<script src=""></script>```，不受跨網域限制的特性，由 cline 端提供 callBack Function，並由 sever 端執行該 callBack，資料由 callBack 參數帶入 cline 端。

2. 只能用在 get 的方式。因為是透過網址傳 request。
    ```<script src=“http://..&callback=getData"></script>```  (getData 是 cline 端提供的 function，由 server 端執行 getData(data)，並在參數 data 帶入資料傳回給 cline 端)

3. 有安全性的問題，因為在 server 端，如果被駭客更改參數並帶入有害的程式碼，那 clien 端也會受影響，因為是直接用 <script> 引入，跟自己用 <script> 引入 javascript 程式碼一樣

## 要如何存取跨網域的 API？
1. CORS：Server 必須在 Response 的 Header 裡面加上Access-Control-Allow-Origin。
2. 使用 JSONP，透過 ```<script src=“http://..&callback=getData"></script>```

## 為什麼我們在第四週時沒碰到跨網域的問題，這週卻碰到了？
因為第四週是利用 node.js 發 request，不透過瀏覽器; 而跨網域的問題是"瀏覽器"本身考量到網路安全問題，由“瀏覽器”本身的產生限制

## 參考網頁
[輕鬆理解 Ajax 與跨來源請求][1]
[前端基礎 JavaScript篇：網頁與伺服器的溝通][2]
[[第九週]透過瀏覽器交換資料 - 表單、AJAX、XMLHttpRequest][3]

[1]: https://blog.techbridge.cc/2017/05/20/api-ajax-cors-and-jsonp/
[2]:
https://medium.com/@hugh_Program_learning_diary_Js/%E5%89%8D%E7%AB%AF%E5%9F%BA%E7%A4%8E-javascript%E7%AF%87-%E7%B6%B2%E9%A0%81%E8%88%87%E4%BC%BA%E6%9C%8D%E5%99%A8%E7%9A%84%E6%BA%9D%E9%80%9A-eb921b02e836
[3]: 
https://medium.com/@miahsuwork/%E7%AC%AC%E4%B9%9D%E9%80%B1-%E9%80%8F%E9%81%8E%E7%80%8F%E8%A6%BD%E5%99%A8%E4%BA%A4%E6%8F%9B%E8%B3%87%E6%96%99-%E8%A1%A8%E5%96%AE-ajax-xmlhttprequest-fef80856da16






