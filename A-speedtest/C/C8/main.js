const cycle = () => {
    document.body.childNodes.forEach((row) => {
        if(row.nodeName === 'DIV') {
            row.style.backgroundPositionX = (parseInt(row.style.backgroundPositionX.slice(0, -1)) - 200) + 'px'
            if(parseInt(row.style.backgroundPositionX) < -4000) {
                row.remove()
            }
        }
    })
}

const generateFireWork = () => {
    document.body.innerHTML += `<div class="${Math.round(Math.random()) === 1 ? 'explode' : 'explode2'}"></div>`
    document.body.lastChild.style.backgroundPositionX = 0
    document.body.lastChild.style.left = Math.round(Math.random() * window.innerWidth) + 'px'
    document.body.lastChild.style.top = Math.round(Math.random() * window.innerHeight) + 'px'
}

setInterval(() => {
    generateFireWork()
}, 1000)

setInterval(() => {
    cycle()
}, 75)
