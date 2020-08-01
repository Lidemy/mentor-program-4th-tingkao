/* eslint-disable no-unused-vars */
function solve(lines) {
  const num = Number(lines[0]);
  function isPrime(n) {
    if (n === 1) return 'Composite';
    for (let j = 2; j < n; j += 1) {
      if ((n % j === 0)) return 'Composite';
    }
    return 'Prime';
  }
  for (let i = 1; i <= num; i += 1) {
    const N = Number(lines[i]);
    console.log(isPrime(N));
  }
}
