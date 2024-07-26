const buttons = document.querySelectorAll('.btn')

buttons.forEach((button) => {
    button.addEventListener('click', (e) => {
        if (e.target.id === 'rating') {
            alert('nop')
        }
        let parent = e.target.parentNode.parentNode
        if (parent.parentNode.id) {
            parent = parent.parentNode
        }

        let icon = e.target
        if(!icon.classList.contains('fa-thumbs-up') && !icon.classList.contains('fa-thumbs-down') && icon.childNodes[0].classList.contains('fa-thumbs-up') || icon.childNodes[0].classList.contains('fa-thumbs-down')) {
            icon = icon.childNodes[0]
        }
        console.log(icon)
    })
})