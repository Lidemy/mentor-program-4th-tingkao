/* 檢討程式碼：更改前 */
function isFilled() {
  const blanks = document.querySelectorAll('.required');
  for (let i = 0; i < blanks.length; i += 1) {
    if (!(blanks[i].value)) return false;
  }
  if (document.querySelector('#gameType01').checked || document.querySelector('#gameType02').checked) {
    return true;
  }
  const mutichoice = document.querySelector('.mutichoice');
  if (!(mutichoice.value) && !(mutichoice.classList.contains('unfilled_blank'))) {
    mutichoice.insertAdjacentHTML('afterend', '<div class="unfilled_warning">資料不可空白</div>');
    mutichoice.classList.add('unfilled_blank');
  }
  return false;
}

document.querySelector('.list__submit').addEventListener('click', (e) => {
  if (!(isFilled())) {
    document.querySelectorAll('.required').forEach((element) => {
      if (!(element.value) && !(element.classList.contains('unfilled_blank'))) {
        element.insertAdjacentHTML('afterend', '<div class="unfilled_warning">資料不可空白</div>');
        element.classList.add('unfilled_blank');
      }
    });

    e.preventDefault();
    document.querySelectorAll('input').forEach((element) => {
      if (element.classList.contains('unfilled_blank')) {
        element.addEventListener('keydown', () => {
          element.classList.remove('unfilled_blank');
          const isValid = element.nextSibling.classList;
          if (isValid && isValid[0] === 'unfilled_warning') {
            element.nextSibling.remove();
          }
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
