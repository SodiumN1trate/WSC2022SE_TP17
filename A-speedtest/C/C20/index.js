const wordRank = (args) => {
    let score1 = 0
    let score2 = 0
    let alphabet = 'abcdefghijklmnopqrstuvwxz'
    word1.split('').forEach((letter) => {
        score1 += alphabet.split('').indexOf(letter.toLowerCase()) + 1
    })

    word2.split('').forEach((letter) => {
        score2 += alphabet.split('').indexOf(letter.toLowerCase()) + 1
    })
    if(score1 === score2) {
        return word1.split(' ')[0]
    }

    if(score1 > score2) {
        return word1
    } else {
        return word2
    }
}


console.log(wordRank('Hello world dasdas dsa das das das as as dsad asdasdasd', 'Hello world'))