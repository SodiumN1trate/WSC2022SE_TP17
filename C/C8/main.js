const cycle = () => {
    document.body.childNodes.forEach((row) => {
        if(row.nodeName === 'DIV') {
            row.style.backgroundPositionX = (parseInt(row.style.backgroundPositionX.slice(0, -1)) - 200) + 'px'
        }
    })
}

const generateFireWork = () => {
    document.body.innerHTML += `<div class="${Math.round(Math.random()) === 1 ? 'explode' : 'explode2'}"></div>`
    document.body.lastChild.style.backgroundPositionX = 0
    document.body.lastChild.style.left = Math.round(Math.random() * 1000) + 'px'
    document.body.lastChild.style.top = Math.round(Math.random() * 100) + 'px'
}

setInterval(() => {
    generateFireWork()
}, 1000)

setInterval(() => {
    cycle()
}, 75)
