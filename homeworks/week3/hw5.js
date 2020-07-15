/* eslint-disable no-unused-vars */
function solve(lines) {
  const num = Number(lines[0]);
  function winnerPk(A, B) {
    for (let j = 0; j < A.length; j += 1) {
      if (Number(A[j]) > Number(B[j])) return ['A', 'B'];
      if (Number(A[j]) < Number(B[j])) return ['B', 'A'];
    }
    return ['DRAW'];
  }
  for (let i = 1; i <= num; i += 1) {
    const set = lines[i].split(' ');
    let bigger = '';
    let result = '';
    let opposite = false;
    if (set[0][0] !== '-' && set[1][0] === '-') {
      bigger = ['A', 'B'];
    } else if (set[0][0] === '-' && set[1][0] !== '-') {
      bigger = ['B', 'A'];
    } else {
      if (set[0][0] === '-' && set[1][0] === '-') {
        opposite = true;
      }
      if (set[0].length > set[1].length) {
        bigger = ['A', 'B'];
      } else if (set[0].length < set[1].length) {
        bigger = ['B', 'A'];
      } else {
        bigger = winnerPk(set[0], set[1]);
      }
    }
    if (bigger[0] === 'DRAW') {
      console.log(bigger[0]);
    } else {
      const [large, small] = bigger;
      if (Number(set[2]) === 1) {
        if (opposite) {
          result = small;
        } else {
          result = large;
        }
      } else if (Number(set[2]) === -1) {
        if (opposite) {
          result = large;
        } else {
          result = small;
        }
      }
      console.log(result);
    }
  }
}
