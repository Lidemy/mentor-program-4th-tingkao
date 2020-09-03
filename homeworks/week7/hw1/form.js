/* 檢討程式碼：更改後
1. 不要直接監聽按鈕上面的 click，因為 enter 也可以送出表單
所以要用整個 document.querySelector('form') 監聽 submit 事件(只監聽按鈕的 click 和 Enter 也不行)
2. 原本的部分為用 class 來判斷 user 是否有填寫(沒有達到“樣式與功能分開”)
最好的辦法為，寫好錯誤訊息的 html 然後直接利用 classList.remove() 和 classList.add()
達到 visibility: hidden;(看不見但是仍佔有空間))
這樣就不用過濾是否已經有該 warning_error 了(不然每按一次“提交”，就會增加一次 warning_error)
*** (概念同上)如果要改用 變數 來紀錄程式狀態，就變成要把元素先寫好再隱藏的方式
否則會變成還是要判斷他是否已經出現錯誤訊息（不然會按一次按鈕就出現一次錯誤訊息）=> 原本是靠 class 來判斷
3. 可加強部分（未改）：注意擴充性，當在 html 加了新的欄位的時候，不用改 Js 或 CSS 即可達到驗證功能
（利用 .require[type:radio] 和 .require[type:checkbox] 來選，就不會只對“單一”元素有綁定到事件）
*/
function isFilled() {
  let hasfilled = false;
  const blanks = document.querySelectorAll('.required');
  for (let i = 0; i < blanks.length; i += 1) {
    if (!(blanks[i].value)) {
      return hasfilled;
    }
  }
  if (document.querySelector('#gameType01').checked || document.querySelector('#gameType02').checked) {
    hasfilled = true;
    return hasfilled;
  }
  return hasfilled;
}

document.querySelector('form').addEventListener('submit', (e) => {
  if (!(isFilled())) {
    document.querySelectorAll('.required').forEach((element) => {
      if (!(element.value)) {
        element.nextElementSibling.classList.remove('hidden');
        element.classList.add('unfilled_blank');
      }
    });
    const mutichoice = document.querySelector('.mutichoice');
    const mutiStatus = (mutichoice.querySelector('#gameType01').checked || mutichoice.querySelector('#gameType02').checked);
    if (!(mutiStatus) && !(mutichoice.classList.contains('unfilled_blank'))) {
      mutichoice.nextElementSibling.classList.remove('hidden');
      mutichoice.classList.add('unfilled_blank');
    }
    e.preventDefault();
    document.querySelectorAll('.mutichoice > input').forEach((element) => {
      element.addEventListener('click', () => {
        if (element.checked) {
          mutichoice.nextElementSibling.classList.add('hidden');
          mutichoice.classList.remove('unfilled_blank');
        }
      });
    });
    document.querySelectorAll('input').forEach((element) => {
      if (element.classList.contains('unfilled_blank')) {
        element.addEventListener('keydown', () => {
          element.classList.remove('unfilled_blank');
          element.nextElementSibling.classList.add('hidden');
        });
      }
    });
  } else {
    let enrollType = '';
    let elseInfo = '';
    if (document.querySelector('#gameType01').checked) {
      enrollType = document.querySelector('.gameType01').innerText;
    } else {
      enrollType = document.querySelector('.gameType02').innerText;
    }
    if (document.querySelector('#advice').value) {
      elseInfo = document.querySelector('#advice').value;
    }
    alert(`
    暱稱：${document.querySelector('#nickname').value}
    電子郵件：${document.querySelector('#eMail').value}
    手機號碼:${document.querySelector('#phoneNum').value}
    報名類型：${enrollType}
    活動消息來源：${document.querySelector('#resource').value}
    其他：${elseInfo}
    `);
  }
});
