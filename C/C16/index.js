const canvas = document.getElementById('canvas')
const ctx = canvas.getContext('2d')
let isDrawing = false
let color = 'black'
let width = canvas.clientWidth
let height = canvas.height

canvas.addEventListener('mousedown', () => {
    isDrawing = true
})

canvas.addEventListener('mousemove', (e) => {
    if(!isDrawing) { return }
    ctx.beginPath()
    ctx.arc(e.offsetX * canvas.width / canvas.clientWidth, e.offsetY * canvas.height / canvas.clientHeight, 15, 0, Math.PI * 2)
    ctx.fillStyle = color
    ctx.fill()
    ctx.closePath()
})

canvas.addEventListener('mouseup', () => {
    isDrawing = false
})

const setColor = (pickedColor) => {
    color = pickedColor
}

setInterval(() => {
    const wrap = document.getElementById('wrapper')
    if(width !== wrap.offsetWidth || height !== wrap.offsetHeight) {
        const drawing = canvas
        width = wrap.clientWidth
        height = wrap.clientHeight
        canvas.width = width
        canvas.height = height
        ctx.drawImage(drawing, 0, 0)
    }
}, 100)

const save = (extension) => {
    let downloadLink = document.createElement('a')
    downloadLink.setAttribute('download', `Canvas.${extension}`)
    canvas.toBlob((blob) => {
        downloadLink.setAttribute('href', URL.createObjectURL(blob))
        downloadLink.click()
    })
}