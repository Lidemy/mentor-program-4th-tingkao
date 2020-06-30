function capitalize(str) {
  let result = ''
  if(str[0] > 'a' && str[0] < 'z'){
    result = result + str[0].toUpperCase()
    for(var i = 1; i < str.length; i++){
      result = result + str[i]
    }
    return result
  }else {
    return str
  }
}

console.log(capitalize('hello'));
