const modal = document.querySelector('.modal')

modal.style.display = 'none'

document.getElementById('open').addEventListener('click', (e) => {
    modal.style.display = 'block'
    modal.style.backgroundColor = '#000000c7'
    modal.style.width = '100vw'
    modal.style.height = '100vh'
    modal.style.display = 'flex'
    modal.style.alignItems = 'center'
    modal.style.justifyContent = 'center'
    modal.style.flexDirection = 'column'
    modal.style.position = 'absolute'
    modal.style.left = '0px'
    modal.style.top = '0px'
    document.body.style.overflow = 'hidden'

    const p = modal.querySelector('p')
    p.style.padding = '10px'
    p.style.backgroundColor = 'white'
})

document.getElementById('close').addEventListener('click', (e) => {
    modal.style.display = 'none'
    document.body.style.overflow = 'visible'

})