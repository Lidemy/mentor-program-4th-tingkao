let memberState = 'register';
const registerBtn = document.querySelector('.register-btn');
// 表單檢查
function formCheck() {
  document.querySelector(`.handle-${memberState}-btn`).addEventListener('click', (e) => {
    let hasBlank = false;
    document.querySelectorAll(`.comment__${memberState} input`).forEach((el) => {
      if (!el.value) {
        hasBlank = true;
      }
    });
    if (hasBlank) {
      alert('請填妥資料');
      e.preventDefault();
      e.stopImmediatePropagation();
    }
  });
}

if (registerBtn) {
  document.querySelector('.register-btn').addEventListener('click', () => {
    document.querySelector('.comment__register').classList.remove('hidden');
    formCheck();
  });
}

document.querySelectorAll('.cancel').forEach((el) => {
  el.addEventListener('click', () => {
    el.parentNode.classList.add('hidden');
  });
});

document.querySelector('.to-login').addEventListener('click', () => {
  document.querySelector('.comment__register').classList.add('hidden');
  document.querySelector('.comment__login').classList.remove('hidden');
  memberState = 'login';
  formCheck();
});

document.querySelector('.to-register').addEventListener('click', () => {
  document.querySelector('.comment__login').classList.add('hidden');
  document.querySelector('.comment__register').classList.remove('hidden');
  memberState = 'register';
  formCheck();
});
