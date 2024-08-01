const romanNumbers = {
  I: 1,
  V: 5,
  X: 10,
  L: 50,
  C: 100,
  D: 500,
  M: 1000
}

function romanConverter(romanString) {
  const splittedString = romanString.split('')
  let result = 0
  for(let i = 0; i < splittedString.length; i++) {
    if(splittedString[i+1] && romanNumbers[splittedString[i]] < romanNumbers[splittedString[i + 1]]) {
      result -= romanNumbers[splittedString[i]]
    } else {
      result += romanNumbers[splittedString[i]]
    }
  }
  console.log(result)
  return result
}


romanConverter('DV')