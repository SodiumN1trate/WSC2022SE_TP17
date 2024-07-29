document.getElementById('mode').addEventListener('input', (e) => {
    const text = document.getElementById('text')
    const body = document.body

    if (e.target.checked) {
        text.innerHTML = 'Night mode test'
        body.style.color = '#fff'
        body.style.backgroundColor = '#000'
    } else {
        text.innerHTML = 'Light Mode Test'
        body.style.color = '#000'
        body.style.backgroundColor = '#fff'
    }
})