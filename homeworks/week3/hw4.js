/* eslint-disable no-unused-vars */
function solve(lines) {
  let result = '';
  for (let i = lines[0].length - 1; i >= 0; i -= 1) {
    result += lines[0][i];
  }
  if (result === lines[0]) {
    console.log('True');
  } else {
    console.log('False');
  }
}
