const wordRank = (word1, word2) => {
    let score1 = 0
    let score2 = 0
    let alphabet = 'abcdefghijklmnopqrstuvwxz'
    word1.split('').forEach((letter) => {
        score1 += alphabet.split('').indexOf(letter.toLowerCase())
    })

    word2.split('').forEach((letter) => {
        score2 += alphabet.split('').indexOf(letter.toLowerCase())
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


console.log(wordRank('Hello world', 'Hello world'))