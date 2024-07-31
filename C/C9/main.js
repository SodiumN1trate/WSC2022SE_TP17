const canvas = document.getElementById('canvas')
const ctx = canvas.getContext('2d')

const colors = [
    'red',
    'blue',
    'pink',
    'purple',
]

const particles = []

let lastTime = []

class Particle {
    constructor(x, y) {
        this.x = x
        this.y = y - 10
        this.radius = 4.3
        this.color = colors[Math.floor(Math.random() * 4)]
    };

    update() {
        this.x += (Math.random() - 0.5) * 4
        this.y += (Math.random() - 0.5) * 2 + 1.5

        if(this.y > 300) {
            const index = particles.indexOf(this)
            particles.splice(index, 1)
        }
    }

    draw () {
        ctx.beginPath()
        ctx.arc(this.x, this.y, 4.3, 0, Math.PI * 2)
        ctx.fillStyle = this.color
        ctx.fill()
        ctx.closePath()
    }
}

const render = (startX, number, render) => {
    number = NUMBERS[number]
    let posX = startX
    let posY = 100
    for (let y = 0; y < 10; y++) {
        for (let x = 0; x < 10; x++) {
            if(number[y][x] === 1) {
                ctx.beginPath()
                ctx.arc(posX, posY, 4.3, 0, Math.PI * 2)
                ctx.fillStyle = 'black'
                ctx.fill()
                ctx.closePath()
                if(render) {
                    particles.push(new Particle(posX, posY))

                }
            }
            posX += 10
        }
        posX = startX
        posY += 10
    }
}

const clear = () => {
    ctx.beginPath()
    ctx.clearRect(0, 0, 1000, 1000)
    ctx.closePath()
}

const drawTimer = (forRender) => {
    const hours = (new Date()).getHours().toString().padEnd(2, '0').split('')
    const minutes = (new Date()).getMinutes().toString().padStart(2, '0').split('')
    const seconds = (new Date()).getSeconds().toString().padStart(2, '0').split('')
    if(lastTime[0] !== hours[0]) {
        render(100, hours[0], true)
    } else {
        render(100, hours[0], false)
    }

    if(lastTime[1] !== hours[1]) {
        render(200, hours[1], true)
    } else {
        render(200, hours[1], false)
    }

    if(lastTime[2] !== minutes[0]) {
        render(400, minutes[0], true)
    } else {
        render(400, minutes[0], false)
    }

    if(lastTime[3] !== minutes[1]) {
        render(500, minutes[1], true)
    } else {
        render(500, minutes[1], false)
    }

    if(lastTime[4] !== seconds[0]) {
        render(700, seconds[0], true)
    } else {
        render(700, seconds[0], false)
    }

    if(lastTime[5] !== seconds[1]) {
        render(800, seconds[1], true)
    } else {
        render(800, seconds[1], false)
    }
    render(300, 10, false)
    render(600, 10, false)

    lastTime = [hours[0], hours[1], minutes[0], minutes[1], seconds[0], seconds[1]]

}

setInterval(() => {
    clear()
    drawTimer(true)
}, 1000)

setInterval(() => {
    clear()
    drawTimer(false)

    particles.forEach((particle) => {
        particle.update()
        particle.draw()
    } )
}, 5)