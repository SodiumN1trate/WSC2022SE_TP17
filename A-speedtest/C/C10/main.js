
let text = document.getElementById('txt').innerHTML
const resize = () => {
    const wrap = document.getElementById('wrap')
    const textContainer = document.getElementById('txt')
    if(textContainer.offsetWidth < wrap.offsetWidth) {
        textContainer.innerHTML = text
        return 0
    }
    let charsToDelete = Math.round((textContainer.offsetWidth - wrap.offsetWidth) / 10) * 2
    if(charsToDelete % 2 !== 0) {
        charsToDelete -= 1
    }
    textContainer.innerHTML = text.slice(0, (Math.floor(text.length / 2)) - (charsToDelete / 2)) + '...' + text.slice(Math.ceil((text.length / 2)) + (charsToDelete / 2), text.length)
}
new ResizeObserver(resize).observe(wrap)
