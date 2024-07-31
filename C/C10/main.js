
let text = document.getElementById('txt').innerHTML
const resize = () => {
    const wrap = document.getElementById('wrap')
    const textContainer = document.getElementById('txt')
    if(textContainer.offsetWidth < wrap.offsetWidth) {
        textContainer.innerHTML = text
        return 0
    }
    let charsToDelete = Math.round((textContainer.offsetWidth - wrap.offsetWidth) / 10) * 2
    if(textContainer.offsetWidth - wrap.offsetWidth <= 100) {
        charsToDelete = Math.round((textContainer.offsetWidth - wrap.offsetWidth) / 2) * 2
    }
    textContainer.innerHTML = text.slice(0, (text.length / 2) - (charsToDelete / 2)) + '...' + text.slice((text.length / 2) + (charsToDelete / 2), text.length)
}
new ResizeObserver(resize).observe(wrap)
