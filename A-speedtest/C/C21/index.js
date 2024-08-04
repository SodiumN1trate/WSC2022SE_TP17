let bubbles = []

const colors = [
    'red',
    'blue',
    'green',
    'pink',
    'purple'
]

setInterval( () => {
    if(bubbles.length > 10) {
        bubbles[0].remove()
        bubbles.splice(0, 1)
    }
    const bubble = document.body.appendChild(document.createElement('div'))
    bubble.style.backgroundColor = colors[Math.round(Math.random() * 5)]
    bubble.style.position = 'absolute'
    bubble.style.left = Math.round(Math.random() * window.innerWidth) + 'px'
    bubble.style.top = Math.round(Math.random() * window.innerHeight) + 'px'
    bubble.style.width = '50px'
    bubble.style.height = '50px'
    bubble.style.borderRadius = '50%'
    bubbles.push(bubble)
}, 500)