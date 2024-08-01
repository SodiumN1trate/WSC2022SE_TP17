const cursor  = document.getElementById('cursor')
const container = document.querySelector('.container')
container.addEventListener('mousemove', (e) => {
    cursor.style.left = e.clientX + 'px'
    cursor.style.top = e.clientY + 'px'
})

document.addEventListener('mousedown', (e) => {
    const ripple = container.appendChild(document.createElement('span'))
    ripple.classList.add('ripple')
    ripple.style.left = e.clientX + 'px'
    ripple.style.top = e.clientY + 'px'
    setTimeout(() => {
        ripple.remove()
    }, 1000)
})