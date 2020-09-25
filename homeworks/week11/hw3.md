## 請說明雜湊跟加密的差別在哪裡，為什麼密碼要雜湊過後才存入資料庫
編碼（Encode）、加密（Encrypt）跟雜湊（Hash）

### 加密 encryption：（可逆，一對一）例如：對稱加密（凱薩加密、AES）、非對稱加密（RSA）
aaa -> 加密 -> bbb
bbb -> 解密 -> aaa

### 雜湊 Hash：（不可逆，多對一）
aaa -> Hash -> WEBYBHSDJB  => 一樣的輸入(aaa)，一定得到一個固定的輸出(WEBYBHSDJB)
ddd -> Hash -> WEBYBHSDJB  => 不同的輸入(bbb)，也可能得到一個同樣的輸出(WEBYBHSDJB)

* 驗證 aaa 是不是密碼，只能輸入 aaa 然後經過 Hash 來比對結果。
* 拿到 Hash 後的結果，無法倒推回去
* 碰撞：不同的輸入，得到相同的結果。好的雜湊機制，碰撞機率很低

hash 特性：
1. 不可逆。雜湊函式是一種單向函示，沒有辦法從結果去逆推回原本的內容。如上圖中輸入「Fox」經過雜湊，得到雜湊值「DFCD3454」，我們卻無法透過任何函式或算法，去知道「DFCD3454」雜湊前的原文是「FOX」。
2. 同樣的輸入經過雜湊，保證一定會得到同樣的輸出。如圖「Fox」不管經過幾次雜湊，不會得到「DFCD3454」以外的值。
3. 不定長度、無窮可能的輸入，都會得到固定長度的雜湊值，亦即輸出的長度不受原本長度的影響。如「Fox」和 「The red fox runs across the ice」經過雜湊後，得到一樣長度的雜湊值。
4. 雖然機率很低，但是有可能「不同的輸入」卻有「相同的雜湊值」，如果有這種情形，稱為碰撞(collision)。一個雜湊函式的好壞，也取決於是不是容易發生碰撞。
5. 即使只有一點點不一樣，雜湊出來的值仍然天差地遠，看不出關係。

常見雜湊演算法：
1. SHA-0
2. SHA-1 ( 已經被證明不夠安全)
3. SHA-256
4. MD-5 (已經被證明不夠安全)
5. RIPEMD-160

防範“彩虹表” => 雜湊加鹽（可加在原密碼前面、後面、中間）=> 駭客必須同時拿到”彩虹表” 以及 “鹽” 

### 為什麼密碼要雜湊過後才存入資料庫：避免當資料庫被竊取時，使用者的帳號密碼直接一覽無遺

### 參考網頁：
[密碼存明碼，怎麼不直接去裸奔算了？淺談 Hash , 用雜湊保護密碼](https://medium.com/@brad61517/%E8%B3%87%E8%A8%8A%E5%AE%89%E5%85%A8-%E5%AF%86%E7%A2%BC%E5%AD%98%E6%98%8E%E7%A2%BC-%E6%80%8E%E9%BA%BC%E4%B8%8D%E7%9B%B4%E6%8E%A5%E5%8E%BB%E8%A3%B8%E5%A5%94%E7%AE%97%E4%BA%86-%E6%B7%BA%E8%AB%87-hash-%E7%94%A8%E9%9B%9C%E6%B9%8A%E4%BF%9D%E8%AD%B7%E5%AF%86%E7%A2%BC-d561ad2a7d84)

[聽說不能用明文存密碼，那到底該怎麼存？](https://medium.com/starbugs/how-to-store-password-in-database-sefely-6b20f48def92)

## `include`、`require`、`include_once`、`require_once` 的差別
通過 PHP ，可以用幾個不同的方式來重複使用程式程式碼。要使用哪些函式端視你要重複使用的是怎樣的內容而定。
主要的函式包括：
* include() 與 include_once()
* require() 與 require_once()

### 兩者差異
- 當引用檔案有問題時，require 會產生錯誤訊息並停止程式執行。而 include 會顯示警告訊息，但是程式會繼續往下執行
- 在 include 載入檔案執行時，文件每次都要進行讀取與評估
- include 能回傳值，require 則不行
所以 include 可以被放在判斷式中，若抓不到檔案，會回傳 false（適合用在有不同 plan 時）; 而如果使用 require，當檔案有問題時，整個程式直接停止（適合用在當檔案 100% 必須被引入時）
```php
if (@include 'file.php') {
	// Plan A
} else {
	// Plan B - for when 'file.php' cannot be included
}
```

### require 使用：函數通常放在 PHP 程序的最前面，PHP 程序在執行前，就會先讀入 require 所指定引入的文件，使它變成 PHP 程序網頁的一部份。常用的函數，亦可以這個方法將它引入網頁中。
- 引用的檔案很重要，因為讀取檔案錯誤的同時，程式也會停止，避免更多錯誤產生
- 引入檔的程式碼使用率較高的

### include 使用：函數一般是放在流程控制的處理部分中。PHP 程序網頁在讀到 include 的文件時，才將它讀進來。這種方式，可以把程序執行時的流程簡單化。
- 若是在迴圈或是判斷式中引入檔案，建議使用 include 方法

### 使用 include_once 與 require_once
若是在程式中載入的次數非常頻繁，常會忘了是否多次引入，如此可能造成引入檔中所定義的變數衝突或是重複載入的問題，進而造成程式錯誤。
所以 PHP 提供了 include_once 與 required_once 兩個方法來避免這個問題。使用方法不變，但是在引入程式檔之前，會先檢查是否已經引入過了

### 參考網頁：
[Day 12 - 程式引入檔](https://ithelp.ithome.com.tw/articles/10205664?sc=iThelpR)
[include和require的區別](https://blog.xuite.net/ttddmon/oldfriend/12896656-include%E5%92%8Crequire%E7%9A%84%E5%8D%80%E5%88%A5)
[Difference Between 'include' and 'require' Statements in PHP](https://andy-carter.com/blog/difference-between-include-and-require-statements-in-php)


## 請說明 SQL Injection 的攻擊原理以及防範方法
### 攻擊原理：
當 query 是以字串拼接的方式顯示，那使用者在輸入帶有雙引號或是單引號的訊息時，會被解讀成 query 本身的一部分，進而可以更改 query 的指令，達到可以撈取資料庫資料的狀態

### 防範方法：
SQL Injection：讓 SQL 把 cline 端輸入的東西全部以 s(string) 來解析 => 防止 SQL 惡意指令的輸入，
讓 $conn 執行 prepare 的狀態（變數內容先以問號代替），然後把而後需要串接的變數內容，全部以 string 方式解讀
```php
    $sql = "SELECT `password` FROM `tingkao_members` WHERE `username` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    if($conn->error || $stmt->error){
        echo "錯誤訊息：" . $conn->error . $stmt->error;
    }
```

##  請說明 XSS 的攻擊原理以及防範方法

### 攻擊原理:
使用者所輸入的內容被解讀成程式碼，例如：<h1>123</h1>，在顯示上 h1 會被以標籤方式解讀，變成“有標題樣式的”123，而不是純文字 <h1>123</h1>
以此概念為基準，使用者就可以惡意植入程式碼（html、Js），等於是讓使用者可以有能力隨意竄改你的程式碼，例如：利用圖片的不限網域特性把使用者的 cookie 往其他網域帶

重點一：存在資料庫裡的資料應該要為使用者原本輸入的（不先 encode 之後，再存入），因為該資料可能給手機版軟體使用，所以如果做了 encode 再存進資料庫，其他系統可能無法解讀。
重點二：clien 端可以輸入的資料都要防
=> 一般先撈資料（使用者所輸入的內容）->  encode 之後再 render 到頁面上（所以是 render 到 html 上的東西才要 encode）

### 防範方法:
1. 使用 php 內建的函式，來達到 encode 的效果（輸出資料的時候，全部以純文字顯示）
2. 若在 Js 要做 escape (沒有像 php 有內建 function )：
```js
function escodeHtml(unsafe) {
    return unsafe
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/"/g, "&quot;")
         .replace(/'/g, "&#039;");
 }
 ```
## 請說明 CSRF 的攻擊原理以及防範方法
Cross Site Request Forgery

### 狀態：
我在網頁後端那邊做一下驗證，驗證 request 有沒有帶 session id 上來，
也驗證這篇文章是不是這個 id 的作者寫的，都符合的話才刪除文章。
### 問題：
的確是「只有作者本人可以刪除自己的文章」，但如果他不是自己「主動刪除」，而是在不知情的情況下刪除呢？

### 情境：使用者在不知情的情況下點擊下方的連結：

地雷一：（用 GET 傳資料，被使用 <a> 或 <img> 達成 CSRF，因為該二標籤不具跨網域限制）
```html
<a href='https://small-min.blog.com/delete?id=3'>開始測驗</a>
或
<img src='https://small-min.blog.com/delete?id=3' width='0' height='0' />
<a href='/test'>開始測驗</a>
```

地雷二：把刪除改成 POST ，這樣不就無法透過 <a> 或是 <img> 來攻擊了。但可以使用 <form>
```html
<form action="https://small-min.blog.com/delete" method="POST”>
    <input type="hidden" name="id" value="3"/> 
    <input type="submit" value="開始測驗”/>
</form>
```

### 防禦方法
- 使用者的防禦：
CSRF 攻擊之所以能成立，是因為使用者在被攻擊的網頁是處於已經登入的狀態，所以才能做出一些行為。
所以使者者可以在每次使用完網站就登出，就可以避免掉 CSRF。

- Server 的防禦：
CSRF 之所以可怕是因為 CS 兩個字：Cross Site，你可以在任何一個網址底下發動攻擊。CSRF 的防禦就可以從這個方向思考，簡單來說就是：「我要怎麼擋掉從別的 domain 來的 request」
    1. 檢查 Referer - request 的 header 裡面會帶一個欄位叫做 referer，代表這個 request 是從哪個地方過來的，可以檢查這個欄位看是不是合法的 domain，不是的話直接 reject 掉即可。
    2. 加上圖形驗證碼、簡訊驗證碼等等 - 就跟網路銀行轉帳的時候一樣，都會要你收簡訊驗證碼，多了這一道檢查就可以確保不會被 CSRF 攻擊，因為攻擊者不知道圖形
    3. 加上 CSRF token

### 參考資料：
[讓我們來談談 CSRF](https://blog.techbridge.cc/2017/02/25/csrf-introduction/)