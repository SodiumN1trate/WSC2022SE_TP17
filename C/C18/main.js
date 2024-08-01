const images = document.querySelectorAll('img')
let imageOpen = false
let srcOfImages = []
let currentImage = null

images.forEach((image) => {
    srcOfImages.push(image.getAttribute('src'))
    image.addEventListener('click', (event) => {
        if(imageOpen) { return }
        imageOpen = true
        currentImage = image.getAttribute('src')
        const overlay = document.body.appendChild(document.createElement('div'))
        overlay.style.width = '100vw'
        overlay.style.height = '100vh'
        overlay.style.backgroundColor = 'rgba(0,0,0,0.63)'
        overlay.style.position = 'absolute'
        overlay.style.left = '0px'
        overlay.style.top = '0px'
        overlay.style.display = 'flex'
        overlay.style.justifyContent = 'center'
        overlay.style.alignItems = 'center'
        overlay.style.gap = '10px'
        overlay.addEventListener('click', (e) => {
            if(e.target.classList.contains('prevButton') || e.target.classList.contains('nextButton')) {
                return 0
            }
            overlay.remove()
            imageOpen = false
        })


        const cross = overlay.appendChild(document.createElement('div'))
        cross.innerHTML = 'X'
        cross.style.color = 'red'
        cross.style.fontSize = '32px'
        cross.style.position = 'absolute'
        cross.style.right = '50px'
        cross.style.top = '40px'
        cross.style.fontFamily = 'Arial, serif'
        cross.style.cursor = 'pointer'

        const prevButton = overlay.appendChild(document.createElement('div'))
        prevButton.style.padding = '10px'
        prevButton.style.backgroundColor = 'blue'
        prevButton.style.color = 'white'
        prevButton.innerHTML = '<'
        prevButton.style.cursor = 'pointer'
        prevButton.style.fontFamily = 'Arial, serif'
        prevButton.classList.add('prevButton')


        const previewImage = overlay.appendChild(document.createElement('img'))
        previewImage.style.width = '1200px'
        previewImage.setAttribute('src', image.getAttribute('src'))


        const nextButton = overlay.appendChild(document.createElement('div'))
        nextButton.style.padding = '10px'
        nextButton.style.backgroundColor = 'blue'
        nextButton.style.color = 'white'
        nextButton.innerHTML = '>'
        nextButton.style.cursor = 'pointer'
        nextButton.style.fontFamily = 'Arial, serif'
        nextButton.classList.add('nextButton')

        prevButton.addEventListener('click', () => {
            let index = srcOfImages.indexOf(currentImage)
            if (index - 1 < 0) {
                index = srcOfImages.length - 1
            } else {
                index -= 1
            }
            currentImage = srcOfImages[index]
            previewImage.setAttribute('src', currentImage)
        })

        nextButton.addEventListener('click', () => {
            let index = srcOfImages.indexOf(currentImage)
            if (index + 1 > srcOfImages.length - 1) {
                index = 0
            } else {
                index += 1
            }
            currentImage = srcOfImages[index]
            previewImage.setAttribute('src', currentImage)
        })
    })

})