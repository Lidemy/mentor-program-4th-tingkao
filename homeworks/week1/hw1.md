## 交作業流程

1. 新開一個 branch：`git branch week1`
2. 切換到 branch：`git checkout week1`
3. 開始做作業 hw1 hw2 hw3 hw4 hw5
4. 把作業放到暫存區：`git add .`
5. 作業 commit：`git commit -am "message week1"`
6. 把作業上傳到 github (把分支 push 到 github)：`git push original week1`
7. 到 github 按 PR：pull requests
8. 到學習系統的作業列表新增作業並把 PR 的網址貼上去
9. 等作業完成批改 (助教會 merge 檔案到 master，並刪除 github 上的分支)
10. 在本地端切換到 master branch：`git checkout master`
11. 在本地端把 merge 過的 master pull 下來：`git pull original master`(此時本地端的 branch 在 master 上)
12. 把作業分支刪除 `git branch -d week1`

## 跟老師的遠端同步

0. 如果寫作業寫到一半，把作業寫到一段落並在該 branch commit，再換到 master，`git checkout master`
1. 到本地端的 master，確認沒有其他東西需要 commit : git status
2. 把老師遠端(mentor-program-4th)的資料(master)拉下來同步到本地端的 master ： 
git pull https://github.com/Lidemy/mentor-program-4th master
3. 如果到 vim 的介面: :wq 再 enter
4. commit，git commit -am “update”
5. 把本地端更新好的 master 資料 push 到自己遠端(mentor-program-4th-tingkao)的資料(master) : git push origin master
6. 切回原本的 branch 繼續寫作業