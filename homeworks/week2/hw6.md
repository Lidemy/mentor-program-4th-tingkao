``` js
function isValid(arr) {
  for(var i=0; i<arr.length; i++) {
    if (arr[i] <= 0) return 'invalid'
  }
  for(var i=2; i<arr.length; i++) {
    if (arr[i] !== arr[i-1] + arr[i-2]) return 'invalid'
  }
  return 'valid'
}

isValid([3, 5, 8, 13, 22, 35])
```

## 執行流程
0. 執行第 12 行，執行 function isValid，並帶入一個陣列 [3, 5, 8, 13, 22, 35]
1. 執行第 3 行，設定變數 i 是 0，檢查 i 是否 < 6(arr 的長度)，是，繼續執行，開始進入第一圈迴圈
2. 執行第 4 行，判斷 arr[0] 是否小於等於 0，不是，繼續往下
3. i ++，此時 i === 1
4. 迴圈還沒結束，回到第 3 行，檢查 i 是否 < 6(arr 的長度)，是，繼續執行，開始進入第二圈迴圈
5. 執行第 4 行，判斷 arr[1] 是否小於等於 0，不是，繼續往下
6. i ++，此時 i === 2
...
...
...
7. i ++，此時 i === 6
8. 迴圈還沒結束，回到第 3 行，檢查 i 是否 < 6(arr 的長度)，否，迴圈結束

9. 執行第 6 行，設定變數 i 是 2，檢查 i 是否 < 6(arr 的長度)，是，繼續執行，開始進入第一圈迴圈
10. 執行第 7 行，判斷 arr[2] 是否不等於 arr[1] + arr[0]，不是，繼續往下
11. i ++，此時 i === 3
12. 迴圈還沒結束，回到第 6 行，檢查 i 是否 < 6(arr 的長度)，是，繼續執行，開始進入第二圈迴圈
13. 執行第 7 行，判斷 arr[3] 是否不等於 arr[2] + arr[1]，不是，繼續往下
14. i ++，此時 i === 4
15. 迴圈還沒結束，回到第 6 行，檢查 i 是否 < 6(arr 的長度)，是，繼續執行，開始進入第二圈迴圈
16. 執行第 7 行，判斷 arr[4] 是否不等於 arr[3] + arr[2]，是，回傳字串 invalid，結束整個 function
17. 執行完畢