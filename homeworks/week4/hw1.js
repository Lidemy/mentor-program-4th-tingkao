const request = require('request');

request('https://lidemy-book-store.herokuapp.com/books',
  (error, response, body) => {
    const bookList = JSON.parse(body);
    for (let i = 1; i <= 10; i += 1) {
      console.log(`${bookList[i - 1].id} ${bookList[i - 1].name}`);
    }
  });
