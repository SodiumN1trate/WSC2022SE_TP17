const wrap = document.getElementById('wrap')
const textContainer = document.getElementById('txt')
let text = textContainer.innerHTML

const resize = () => {
    if(textContainer.offsetWidth < wrap.offsetWidth) {
        console.log(123)
        textContainer.innerHTML = text
        return 0
    }
    let charsToDelete = Math.round((textContainer.offsetWidth - wrap.offsetWidth) / 10) * 2
    if (charsToDelete % 2 === 1) {
        charsToDelete += 1
    }
    if(wrap.offsetWidth < textContainer.offsetWidth) {
        textContainer.innerHTML = text.slice(0, (text.length / 2) - (charsToDelete / 2)) + '...' + text.slice((text.length / 2) + (charsToDelete / 2), text.length)
    }
}
new ResizeObserver(resize).observe(wrap)
