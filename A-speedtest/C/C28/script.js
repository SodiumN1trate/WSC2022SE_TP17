const pals = ['000', '088', '00d', '438', '800', '888', '8cf', 'aa2', 'b82', 'c18', 'fbb', 'e00', 'fd0', 'feb', 'ddd', 'fff'];

const canvas = document.getElementById('canvas')
const ctx = canvas.getContext('2d')
const form = document.getElementById('form')


const width = 320
const height = 320
let color = '#000'
let colors = ''

pals.forEach((pal) => {
    colors += `<input type="radio" name="color" id="${'#' + pal}" style="background-color: ${ '#' + pal}">`
})
form.innerHTML = colors

form.childNodes.forEach((input) => {
    input.addEventListener('click', () => {
        color = input.id
    })
})
for(let y = 0; y <= 320; y += 20) {
    ctx.beginPath()
    ctx.moveTo(0, y)
    ctx.lineTo(width, y);
    ctx.stroke()
    ctx.closePath()
}

for(let x = 0; x <= 320; x += 20) {
    ctx.beginPath()
    ctx.moveTo(x, 0)
    ctx.lineTo(x, height);
    ctx.stroke()
    ctx.closePath()
}

canvas.addEventListener('click', (e) => {
    const x = Math.floor(e.clientX / 20) * 20
    const y = Math.floor(e.clientY / 20) * 20

    ctx.beginPath()
    ctx.rect(x, y, 20, 20)
    ctx.fillStyle = color
    ctx.fill()
    ctx.closePath()
})