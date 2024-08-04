const buttons = document.querySelectorAll('.digicode-button')
const clickSound = new Audio('beep.mp3')
const successSound = new Audio('success.mp3');
let input = ''

const validateCode = () => {
    if(input === '6789') {
        successSound.play()
        document.querySelector('.led').classList.add('on')
    }
}

buttons.forEach((button) => {
    button.addEventListener('click', (e) => {
        clickSound.play()
        input += e.target.innerHTML
        validateCode()
    })
})