/* eslint-disable no-unused-vars */
function solve(lines) {
  const N = Number(lines[0].split(' ')[0]);
  const M = Number(lines[0].split(' ')[1]);
  function isNarcissistic(n, digits) {
    const nStr = `${n}`;
    let result = 0;

    for (let j = 0; j < digits; j += 1) {
      result += (nStr[j] ** digits);
    }
    return (result === n);
  }
  for (let i = N; i <= M; i += 1) {
    const digits = (`${i}`).length;
    if (isNarcissistic(i, digits)) {
      console.log(i);
    }
  }
}
