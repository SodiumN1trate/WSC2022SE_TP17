const text = document.getElementById('text')
const input = document.getElementById('search-value')

// alert('123'.replace('1', '3'))

const colors = [
    'red',
    'green',
    'yellow',
    'blue',
    'gold',
    'gray'
]


document.getElementById('btn').addEventListener('click', () => {
    text.innerHTML = text.innerHTML.replaceAll(input.value, `<span style="background-color: ${colors[Math.floor(Math.random() * 6)]}">${input.value}</span>`)
})