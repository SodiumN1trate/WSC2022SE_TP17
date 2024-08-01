const button = document.getElementById('button')

button.addEventListener('click', (e) => {
    const ripple = button.appendChild(document.createElement('span'))
    ripple.style.left = `${e.clientX - 5}px`
    ripple.style.top = `${e.clientY - 5}px`
    ripple.classList.add('ripple')
    setTimeout(() => {
        ripple.remove()
    }, 1000)
})