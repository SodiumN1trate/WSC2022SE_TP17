const image = document.getElementById('image')
const cursor = document.getElementById('cursor')

let size = 10

document.addEventListener('mousemove', (e) => {
    cursor.style.left = e.clientX - (size / 2) - 5 + 'px'
    cursor.style.top = e.clientY - (size / 2) - 5 + 'px'
})

document.addEventListener('wheel', (e) => {
    if(e.deltaY > 0 && size >= 10) {
        size -= 5
        cursor.style.width = size + 'px'
        cursor.style.height = size + 'px'
    } else {
        size += 5
        cursor.style.width = size + 'px'
        cursor.style.height = size + 'px'
    }
    cursor.style.left = e.clientX - (size / 2) - 5 + 'px'
    cursor.style.top = e.clientY - (size / 2) - 5 + 'px'
})
