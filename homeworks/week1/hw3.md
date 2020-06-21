
## 教你朋友 CLI

### Command Line Interface (CLI) 是一種操作電腦的方法 > 純文字操作電腦
#### ex: 新增資料夾：到 terminal 去輸入 touch newfile01
### Graphical User Interface (GUI) 圖形化介面 > 我們使用的電腦介面
#### ex: 新增資料夾：用滑鼠右鍵新增資料夾，命名 newfile01
***
## Command Line Tool
windows >>> cmder
mac >>> iterm (電腦內建終端機)

### 操作指令
`pwd` => 我現在在哪裡
`ls` => 此位置裡有哪些東西
`ls -al` => 更詳盡的資訊
man => 說明書 // `man pwd` (查閱 pwd 的功能)

rm => remove 移除資料 // `rm file`
rmdir => remove 移除資料夾 // `rmdir folder`
rm-r => remove 移除資料夾 // `rm-r folder`

mkdir=> make 新增資料夾// `mkdir newfolder`
touch=> (無該檔案)新增資料/(有檔案)更改資料最後修改時間 // `touch newfile`

cd=> 跳轉位置// `cd ..` (回上一頁)

mv => 移動檔案或是改名// 
`mv file.txt folder`(移動到 folder 資料夾)
`mv file.txt file2.txt`(改名)

cp=> 複製// `cp file file01`
cp -r=> 複製資料夾// `cp -r newfolder`

>vim 環境（打開檔案做編輯）/ `vim file` (要編輯的檔案名稱)
i => 打文字
esc => （普通狀態）不可打文字，可以複製、貼上、刪除
:q => 離開
:wq => 儲存後離開

`cat file` （也可以看檔案內容）
grep => 抓關鍵字 / `grep if hello` (查看hello 這個檔案裡面有沒有 if ，有的話列出來)

wget => 下載檔案（不是內建指令，如果沒有可以去下載）/ `wget https://www.google.com` （載入google 原始碼） / wget 圖片網址 （載入圖片）

curl => 送出 request (可以用來測試 API ) / `curl API網址` （會得到 response）/ `curl -I API` 網址 （可以拿到 該header資訊）

| => pipe，把一端的輸出當成另一端的輸入 /
`cat hello.js | grep if` (把 hello.js 顯示出來後，找看看有沒有‘if’)

'>' => 重新導向 input 跟 output / 
`ls -al > 123.txt` (把 ls -al 輸出的資訊放到一個檔案裡面,如果 123.txt 原本就存在,則覆蓋原本檔案，若 123.txt 原本不存在,就會建立一個新檔案並放入資料若是要加在原始檔案的後面,不覆蓋檔案則使用 >> ，`ls -al >> 123.txt` ，>>為 append 的意思)