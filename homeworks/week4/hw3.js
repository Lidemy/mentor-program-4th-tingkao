const request = require('request');
const process = require('process');

// node hw3.js tai

function search(key) {
  request(`https://restcountries.eu/rest/v2/name/${key}`,
    (error, response, body) => {
      const List = JSON.parse(body);
      if (response.statusCode >= 200 && response.statusCode < 300) {
        let result = '';
        for (let i = 0; i < List.length; i += 1) {
          result = `${result}
============
國家：${List[i].name}
首都：${List[i].capital}
貨幣：${List[i].currencies[0].code}
國碼：${List[i].callingCodes}`;
        }
        console.log(result);
      } else {
        console.log('找不到國家資訊');
      }
    });
}
if (process.argv[2]) {
  const key = process.argv[2];
  search(key);
} else {
  console.log('請輸入關鍵字');
}
