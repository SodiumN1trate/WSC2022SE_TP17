const input = document.getElementById('file')
const reader = new FileReader();
const preview = document.getElementById('preview')
const canvas = document.getElementById('canvas')
const ctx = canvas.getContext('2d')
const color = document.getElementById('color')
const colorCOde = document.getElementById('color-code')
let image = null
input.addEventListener('input', (e) => {
    reader.readAsDataURL(input.files[0]);
    reader.addEventListener('load', (file) => {
        console.log(input.files[0])
        let img = new Image();
        img.addEventListener('load', (e) => {
            ctx.drawImage(img, 0, 0)
            image = img
        })
        img.src = file.target.result
    })
})

canvas.addEventListener('mousemove', (e) => {
    ctx.beginPath()
    ctx.clearRect(0, 0, 1920, 1028)
    ctx.closePath()
    ctx.drawImage(image, 0, 0)

    ctx.save()
    const cursor = ctx.getImageData(e.offsetX * canvas.width / canvas.clientWidth, e.offsetY * canvas.height / canvas.clientHeight, 1,1)
    color.style.backgroundColor = `rgba(${cursor.data[0]}, ${cursor.data[1]}, ${cursor.data[2]}, ${cursor.data[3]})`
    colorCOde.innerHTML = `rgba(${cursor.data[0]}, ${cursor.data[1]}, ${cursor.data[2]}, ${cursor.data[3]})`

    ctx.beginPath()
    let x = e.offsetX * canvas.width / canvas.clientWidth + 90
    let y = e.offsetY * canvas.height / canvas.clientHeight + 120
    ctx.arc(x, y, 100, 0, Math.PI * 2)
    ctx.clip()
    ctx.drawImage(image, x - 100 / 3,  y - 100 / 3, x - 100, y - 50, 200, 200)
    ctx.restore()

})
