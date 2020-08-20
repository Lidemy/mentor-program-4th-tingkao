document.querySelector('.wrap').addEventListener('click', (e) => {
  const btn = e.target.parentNode.classList.contains('game__btn');

  if (!(btn)) {
    return;
  }

  const request = new XMLHttpRequest();
  request.onload = () => {
    if (request.status >= 200 && request.status < 400) {
      const reward = JSON.parse(request.responseText).prize;
      const rewardTxt = {
        FIRST: [1, '頭獎！', '日本東京來回雙人遊！', 'url(./img/first.jpg)'],
        SECOND: [1, '二獎！', '二獎！90 吋電視一台！', 'url(./img/second.jpg)'],
        THIRD: [1, '三獎！', '恭喜你抽中三獎：知名 YouTuber 簽名握手會入場券一張，bang！', 'url(./img/third.jpg)'],
        NONE: [0, '沒有中獎ＱＱ', '銘謝惠顧!', 'url(./img/bgc.jpg)'],
      };
      const result = document.querySelector('.result');
      if (!(rewardTxt[reward])) {
        alert('系統不穩定，再試一次');
        return;
      }
      const [index, prize, introduction, bgcURL] = rewardTxt[reward];
      result.innerHTML = `
<div class="txt">${introduction}</div>
<div class="game__btn"><a href="#">我要抽獎</a></div>`;
      document.querySelector('.promotion__card').classList.add('hidden');
      if ((index) === 0) {
        document.querySelector('.result').style.color = '#fff';
        document.querySelector('.bgc__img').classList.add('active');
        document.querySelector('.bgc__img').style.backgroundImage = bgcURL;
      } else {
        document.querySelector('.result').style.color = '#000';
        document.querySelector('.bgc__img').classList.remove('active');
        document.querySelector('.bgc__img').style.backgroundImage = bgcURL;
      }
      alert(`得獎結果出爐！${prize}`);
      document.querySelector('.wrap').appendChild(result);
    } else {
      console.log('有錯誤');
    }
  };
  request.onerror = () => {
    console.log('有錯誤');
  };
  request.open('GET', 'https://dvwhnbka7d.execute-api.us-east-1.amazonaws.com/default/lottery', true);
  request.send();
});
