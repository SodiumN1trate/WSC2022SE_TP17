

const textarea = document.getElementById('text')
const resultContainer = document.getElementById('result')

const checkForStars = (row) => {
    if (row.indexOf('**') > -1) {
        let tempRow = row.replace('**', '<b>')
        if(tempRow.indexOf('**') > -1) {
            tempRow = tempRow.replace('**', '</b>')
            return checkForStars(tempRow)
        }
        return row
    }
    return row
}

const checkForLinks = (row) => {
    if (row.match(/\[[^\]]+\]\(http[^\s)]+\)/g)) {
        let regName = new RegExp(/\[(.*?)\]\(http[^\s)]+\)/, 'g')
        let regLing = new RegExp(/\[[^\]]+\]\((http[^\s)]+)\)/, 'g')
        let name = regName.exec(row)[1]
        let link = regLing.exec(row)[1]
        row = row.replace(`[${name}](${link})`, `<a href="${link}">${name}</a>`)
        if (row.match(/\[[^\]]+\]\(http[^\s)]+\)/g)) {
            return checkForLinks(row)
        }
    }
    return row
}

const checkForImageLinks = (row) => {
    if (row.match(/!\[[^\]]+\]\(http[^\s)]+\)/g)) {
        let regName = new RegExp(/!\[(.*?)\]\(http[^\s)]+\)/, 'g')
        let regLing = new RegExp(/!\[[^\]]+\]\((http[^\s)]+)\)/, 'g')
        let name = regName.exec(row)[1]
        let link = regLing.exec(row)[1]
        row = row.replace(`![${name}](${link})`, `<img src="${link}" width="200px" alt="${name}">`)
        if (row.match(/\[[^\]]+\]\(http[^\s)]+\)/g)) {
            return checkForLinks(row)
        }
    }
    return row
}

textarea.addEventListener('input', () => {
    resultContainer.innerHTML = ''
    textarea.value.split('\n').map((row) => {
        if ((row.match(/#/g) || []).length > 0) {
            const header = row.match(/#/g).length
            row = row.replaceAll('#', '')
            resultContainer.innerHTML += `<h${header}>${row}</h${header}>\n`
        } else if (row === '---') {
            resultContainer.innerHTML += `<hr>\n`
        }  else if (row[0] === '-' && row[1] === '-') {
            row = row.replace('--', '')
            resultContainer.innerHTML += `<li>${row}</li>\n`
        }  else if (row[0] === '-' && row[1] === '-') {
            row = row.replace('--', '')
            resultContainer.innerHTML += `<li>${row}</li>\n`
        }   else {
            row = checkForStars(row)
            row = checkForImageLinks(row)
            row = checkForLinks(row)
            resultContainer.innerHTML += `<p>${row}</p>\n`
        }
    })
})