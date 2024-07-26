/**
 *  Your Code
 */

const canvas = document.querySelector("canvas");
const ctx = canvas.getContext("2d");

const particles = [
    {
        size: 10,
        color: 'red',
        offsetX: -50,
        offsetY: -50
    },
    {
        size: 20,
        color: 'blue',
        offsetX: -30,
        offsetY: -30
    },
    {
        size: 20,
        color: 'blue',
        offsetX: -30,
        offsetY: -30
    },
    {
        size: 20,
        color: 'blue',
        offsetX: -30,
        offsetY: -30
    },
    {
        size: 20,
        color: 'blue',
        offsetX: -30,
        offsetY: -30
    },
    {
        size: 20,
        color: 'blue',
        offsetX: -30,
        offsetY: -30
    },    {
        size: 20,
        color: 'blue',
        offsetX: -30,
        offsetY: -30
    },    {
        size: 20,
        color: 'blue',
        offsetX: -30,
        offsetY: -30
    },
    {
        size: 20,
        color: 'blue',
        offsetX: -30,
        offsetY: -30
    },    {
        size: 20,
        color: 'blue',
        offsetX: -30,
        offsetY: -30
    },    {
        size: 20,
        color: 'blue',
        offsetX: -30,
        offsetY: -30
    },    {
        size: 20,
        color: 'blue',
        offsetX: -30,
        offsetY: -30
    },    {
        size: 20,
        color: 'blue',
        offsetX: -30,
        offsetY: -30
    },    {
        size: 20,
        color: 'blue',
        offsetX: -30,
        offsetY: -120
    },    {
        size: 20,
        color: 'blue',
        offsetX: -30,
        offsetY: -120
    },    {
        size: 20,
        color: 'blue',
        offsetX: -30,
        offsetY: -30
    },










]

canvas.addEventListener('mousemove', (e) => {
    ctx.beginPath()
    ctx.fillStyle = "white"
    ctx.fillRect(0, 0, 1000, 800)
    console.log(e)
    particles.forEach((ball) => {
        ctx.beginPath();
        ctx.arc((e.clientX + ball.offsetX) + ((Math.random() - 0.5) * 120), (e.clientY + ball.offsetY) + ((Math.random() - 0.5) * 120), ball.size + ((Math.random() * 5) * 2), 0, 2 * Math.PI, false)
        ctx.fillStyle = ball.color
        ctx.fill()
        ctx.closePath()
    })
    ctx.closePath()
})
