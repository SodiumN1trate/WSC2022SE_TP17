const buttons = document.querySelectorAll('.thumbs-up ,.thumbs-down')

const clearClasses = (comment) => {
    const buttons = comment.querySelectorAll('.thumbs-up ,.thumbs-down')
    buttons[0].classList.remove('highlight')
    buttons[1].classList.remove('highlight')
}

buttons.forEach((button) => {
    button.addEventListener('click', (e) => {
        let button = e.target
        if (e.target.parentNode.classList.contains('thumbs-up') || e.target.parentNode.classList.contains('thumbs-down')) {
            button = button.parentNode
        }
        let comment = button.parentNode.parentNode
        if(button.classList.contains('highlight')) {
            button.classList.remove('highlight')
        } else {
            clearClasses(comment)
            button.classList.add('highlight')
        }
    })
})

const summary = () => {
    let thumbsUp = 0;
    let thumbsDown = 0;
    document.querySelectorAll('.highlight').forEach((button) => {
        if(button.classList.contains('thumbs-up')) {
            thumbsUp += 1
        }
        if(button.classList.contains('thumbs-down')) {
            thumbsDown += 1
        }
    })

    alert(`Thumbs-up: ${thumbsUp} \n Thumbs-down: ${thumbsDown}`)
}