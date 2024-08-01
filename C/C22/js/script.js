// Input your code
const cards = document.querySelectorAll('.card')

cards.forEach((card, index) => {
    console.log(card)
    card.setAttribute('draggable', true)
    card.addEventListener('dragstart', (e) => {
        e.dataTransfer.clearData()
        e.dataTransfer.setData('text/plain', index.toString())
        e.dataTransfer.setDragImage(new Image(), 0, 0)
    })

    card.addEventListener('drag', (e) => {
        e.preventDefault();
        e.target.style.position = 'absolute'
        e.target.style.width = '368px'
        e.target.style.left = e.screenX + 'px'
        e.target.style.top = e.screenY + 'px'
        // e.target.style.display = 'none'
        e.target.style.transform = 'rotate(5deg)'
        // e.target.style.transition = '1s all'
        // e.target.style.opacity = '1'
    })

    card.addEventListener('dragover', (e) => {
        e.preventDefault()
        // card.style.marginTop = '300px'
        console.log(e.target)
    })

})

document.querySelectorAll('.group-sortable').forEach((group) => {
    console.log(group)
    group.addEventListener('dragover', (e) => {
        e.preventDefault()
    })
    group.addEventListener('drop', (e) => {
        e.preventDefault()
        console.log(e)
        let card = cards[e.dataTransfer.getData('text')]
        card.style.left = '0px'
        card.style.top = '0px'
        card.style.position = 'relative'
        card.style.transform = 'none'
        group.appendChild(cards[e.dataTransfer.getData('text')])
    })
})
