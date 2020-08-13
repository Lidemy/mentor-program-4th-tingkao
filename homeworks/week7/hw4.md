## 什麼是 DOM？
DOM（文件物件模型，Document Object Model） 
- 瀏覽器提供的橋樑(HTML 與 JavaScript 的橋樑)
- document 中元素，對應到的 JavaScript 物件，我們就統稱為 DOM
- 透過 DOM 的操作，可以重構整個 HTML 檔案，或更改其 CSS 樣式，透過添加、移除、改變其項目來與達到與使用者互動的目的

## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？
windows(最外層) -> document -> 父父層元素 -> 父層元素 -> 子層元素

addEventListener 在使用的時候雖然滑鼠點擊的時候是同一個地方，但是各個元素的功能其實是分開的而且他們的位置會像圖層一樣堆疊在一起，點擊的時候雖然以為點的是子層，但是因為層層堆疊的關係，所以父層以上的也會被觸發。
但是有時候我們的功能設定只想要限定某些元素層有作用，我們就會使用到捕獲跟冒泡的概念。
例如：
1. 防止他繼續傳播下去到父層和父父層等都觸發 (event.stopPropagation())
2. 事件綁定在父層，讓即使是新增的子層也能享有該功能 (event delegation)，事件代理

- 兩重點：
1. 先捕獲，再冒泡
2. 當事件傳到 target 本身，沒有分捕獲跟冒泡(依照原始碼順序執行)

- 解析：
1. 冒泡 - 從最內層的子元素慢慢往外層元素 (windows) 跑
子層元素 -> 父層元素 -> 父父層元素 -> document -> windows(最外層)
2. 捕獲 - 從最外層 (windows) 傳到子元素
windows(最外層) -> document -> 父父層元素 -> 父層元素 -> 子層元素

## 什麼是 event delegation，為什麼我們需要它？
- 後來才新增的 元件 節點並不會有 click 事件的註冊
- 把 click 事件改由外層的 父層元素 來監聽，利用事件傳遞的原理，判斷 e.target 是我們要的目標節點時，才去執行後續的動作

## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？
- e.preventDefault - 取消瀏覽器的預設行為，最常見的做法就是阻止超連結跟表單的 submit。即使使用了preventDefault，傳遞機制仍然還在，所以可以只綁在 windows 上，並傳遞下來，凍結所有子元素的預設行為。

- e.stopPropagation - 取消事件繼續往下傳遞，這邊指的「事件傳遞被停止」，意思是說不會再把事件傳遞給「下一個節點」，但若是在同一個節點上有不只一個 listener，還是會被執行到。(同樣層級的東西一樣會被執行)，若是想要讓其他同一層級的 listener 也不要被執行，可以改用e.stopImmediatePropagation();