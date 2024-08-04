/**
 *  Your Code
 */

const canvas = document.querySelector("canvas");
const ctx = canvas.getContext("2d");
let balls = []
let eventHappened = false
let colors = [
    'purple',
    'blue',
    'green',
    'pink',
]

const render = () => {
    ctx.beginPath()
    ctx.fillStyle = "white"
    ctx.fillRect(0, 0, 1000, 800)
    ctx.closePath()
    balls.map((ball) => {
        ball.update()
        ball.draw(ctx)
    })
}

class Ball {
    constructor(x, y) {
        this.x = x
        this.y = y
        this.radius = Math.random() * 10 + 2
        this.color = colors[Math.round(Math.random() * 4)]
        this.dx = (Math.random() - 0.5) * 2
        this.dy = (Math.random() - 0.5) * 2
        this.alpha = 1
        this.decay = Math.random() * 0.02 + 0.01
    }

    draw (ctx) {
        ctx.globalAlpha = this.alpha
        ctx.beginPath()
        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2)
        ctx.fillStyle = this.color
        ctx.fill()
        ctx.closePath()
        ctx.globalAlpha = 1
    }

    update () {
        this.alpha -= this.decay
        this.x += this.dx
        this.y += this.dy

        if(this.alpha <= 0) {
            const index = balls.indexOf(this)
            if (index > -1) {
                balls.splice(index, 1)
            }
        }
    }
}

canvas.addEventListener('mousemove', (e) => {
    render()
    if(eventHappened) { return 0 }
    balls.push(new Ball(e.clientX, e.clientY))
    eventHappened = true
})
setInterval(() => {
    eventHappened = false
    render()
}, 5)