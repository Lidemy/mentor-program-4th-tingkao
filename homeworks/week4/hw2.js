const request = require('request');
const process = require('process');

function printBookList(n) {
  request(`https://lidemy-book-store.herokuapp.com/books${n}`,
    (error, response, body) => {
      const bookList = JSON.parse(body);
      console.log(bookList);
    });
}
function deleteBook(n) {
  request.delete(`https://lidemy-book-store.herokuapp.com/books/${n}`,
    (error, response) => {
      if (response.statusCode >= 200 && response.statusCode < 300) {
        console.log(`成功刪除書籍，id: ${n}`);
      } else {
        console.log('無此書籍！');
      }
    });
}
function addBook(n) {
  request.post('https://lidemy-book-store.herokuapp.com/books', { form: { name: n } },
    (error, response) => {
      if (response.statusCode >= 200 && response.statusCode < 300) {
        console.log(`成功新增書籍：${n}`);
      }
    });
}

function updateBook(newId, newName) {
  if (!(newId && newName)) {
    console.log('請輸入正確資訊');
    return;
  }
  request.patch(`https://lidemy-book-store.herokuapp.com/books/${newId}`,
    { form: { name: newName } },
    (error, response) => {
      if (response.statusCode >= 200 && response.statusCode < 300) {
        console.log(`成功更改 ID:${newId} 的書籍名稱為 "${newName}"`);
      } else {
        console.log('請確認書籍 ID');
      }
    });
}

// node hw2.js list // 印出前二十本書的 id 與書名
if (process.argv[2] === 'list') {
  printBookList('?_limit=20');
}

// node hw2.js read 1 // 輸出 id 為 1 的書籍
if (process.argv[2] === 'read') {
  if (process.argv[3]) {
    printBookList(`/${process.argv[3]}`);
  } else {
    console.log('查無此書');
  }
}

// node hw2.js delete 1 // 刪除 id 為 1 的書籍
if (process.argv[2] === 'delete') {
  if (process.argv[3]) {
    deleteBook(`${process.argv[3]}`);
  } else {
    console.log('查無此書');
  }
}

// node hw2.js create "I love coding" // 新增一本名為 I love coding 的書
if (process.argv[2] === 'create') {
  const bookName = process.argv[3];
  addBook(bookName);
}
// node hw2.js update 1 "new name" // 更新 id 為 1 的書名為 new name
if (process.argv[2] === 'update') {
  const bookId = process.argv[3];
  const bookNewName = process.argv[4];
  updateBook(bookId, bookNewName);
}
