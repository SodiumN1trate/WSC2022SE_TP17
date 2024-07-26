const input = document.getElementById('color-input')

const hexToRgb = (hex) => {
    hex = hex.replace('#', '')

    try {
        let rgb = `rgb(${parseInt(hex.substring(0, 2), 16)}, ${parseInt(hex.substring(2, 4), 16)}, ${parseInt(hex.substring(4, 6), 16)})`
        if (rgb.includes('NaN')) {
            showError()
        }
    } catch {
        showError()
    }
}

const rgbToHex = (rgb) => {
    let numbers = rgb.match(/\d+/g)
    return `#${parseInt(numbers[0]).toString(16).padStart(2, '0')}${parseInt(numbers[1]).toString(16).padStart(2, '0')}${parseInt(numbers[2]).toString(16).padStart(2, '0')}`
}

const showError = () => {
    document.getElementById('result-control').style.display = 'none'
    document.querySelector('.error-result').style.display = 'block'
}

const hideError = () => {
    document.getElementById('result-control').style.display = 'block'
    document.querySelector('.error-result').style.display = 'none'
}
input.addEventListener('input', (e) => {
    const value = e.target.value
    if(value.length === 7 && value.includes('#')) {
        hideError()
        document.querySelector('.hex-color-value').innerHTML = value
        document.querySelector('.rgb-color-value').innerHTML = hexToRgb(value)
    } else if(value.length >= 10) {
        hideError()
        document.getElementById('result-control').style.display = 'initial'
        document.querySelector('.rgb-color-value').innerHTML = value
        document.querySelector('.hex-color-value').innerHTML = rgbToHex(value)
    }
})
