function reverse(str) {
  let result = ''
  for(var i = str.length - 1; i >= 0; i--){
    result = result + str[i]
  }
  console.log(result)
}

reverse('hello');
