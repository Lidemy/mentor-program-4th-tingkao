function join(arr, concatStr) {
  let result = arr[0]
  for (var i = 1; i < arr.length; i++) {
    result = result + concatStr + arr[i]
  }
  return result
}

function repeat(str, times) {
  let result = ''
  for (var j = 0; j < times; j++){
    result = result + str
  }
  return result
}

console.log(join(['a'], '!'));
console.log(repeat('a', 5));
