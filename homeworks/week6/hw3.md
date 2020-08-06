## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。
- figure 標籤
用來包住圖片 img 跟 圖說 figcaption

- figcaption 標籤
圖片文字解說

使用方法如下：

<figure>
  <img
  src="https://developer.mozilla.org/static/img/favicon144.png"
  alt="The beautiful MDN logo.">
  <figcaption>MDN Logo</figcaption>
</figure>

- main 標籤
網頁的主要內容，一頁 HTML 只能出現一次。

- aside 標籤
元素定義了除了內容之外的其他內容。例如：側邊欄。
內容應該與周圍的內容有相關性。


## 請問什麼是盒模型（box modal）
- box-sizing: content-box;
content-box 為在設定 width 的時候，其實預設的 width 包含了該元素的 border / padding / content

- box-sizing: border-box;
border-box 為設定 width 數值為 content 實際數值

## 請問 display: inline, block 跟 inline-block 的差別是什麼？

### inline 
- 常見標籤為：
```
<a>,<span>,<em>,<strong>,<input>,<label>
```
- 不能設定 width & height，寬高是依據內容而定
- 不能設定 margin-top & margin-bottom
- 可以設定 padding ，但是 padding-top & padding-bottom 不佔空間，但是視覺上會顯示
- 可以與其他 inline 跟 inline-block 元素並排

### block 
- 常見標籤為：
```
<div>,<h1>,<p>,<ul>
```
- 可以設定 width & height
- 可以設定 margin 跟 padding
- 自己佔一整列，不可以與其他 inline 跟 inline-block 元素並排

### inline-block
- 常見標籤為：
```
<img>
```
- 可以設定 width & height
- 可以設定 margin 跟 padding
- 可以與其他 inline 跟 inline-block 元素並排


## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？分別各舉一個會用到的場合
left、right、top、bottom 的作用要有 position 的配合
position: static/ absolute/ relative/ fixed / sticky

### static
- 預設值，不能調整 left、right、top、bottom

### relative
- 位置狀態在沒有調整 left、right、top、bottom 一樣，但是可以調整 left、right、top、bottom 
- 該子層需要用到 absolute 或 fixed ，或是單純要調整位置但是不希望影響到左右元素的原始排版狀態

### absolute
- 根據上一層有設定 position 的父層(除了 static)來定位 left、right、top、bottom ，並且原本所佔的位置會消失，由下個元素遞補
- 垂直置中的其中一個方法，搭配 top、left 和 transform 使用
```
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
```

### fixed
- 根據螢幕位置來定位 left、right、top、bottom ，並且原本所佔的位置會消失，由下個元素遞補
- 用在蓋板廣告或是導覽列