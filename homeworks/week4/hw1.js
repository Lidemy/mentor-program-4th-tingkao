const request = require('request');

request('https://lidemy-book-store.herokuapp.com/books?_limit=10',
  (error, response, body) => {
    const bookList = JSON.parse(body);
    for (let i = 0; i < bookList.length; i += 1) {
      console.log(`${bookList[i].id} ${bookList[i].name}`);
    }
  });
