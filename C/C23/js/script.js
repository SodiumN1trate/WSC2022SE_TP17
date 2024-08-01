// Input your code

const circleLeft = document.querySelector('.circle-left')
let circleLeftPressed = false
const slider = document.getElementById('slider')

circleLeft.addEventListener('mousedown', (e) => {
    circleLeftPressed = true
})

document.addEventListener('mousemove', (e) => {
    const min = slider.getBoundingClientRect().left
    const max = slider.getBoundingClientRect().right
    if(circleLeftPressed) {
        let pos = e.pageX - 310
        if(min >= pos && pos <= max) {
            circleLeft.style.left = pos - min + 'px'
        }
    }
})