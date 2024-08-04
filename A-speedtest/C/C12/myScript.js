const links = document.querySelectorAll('a')

links.forEach((link) => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        const url = e.target.getAttribute('href')
        fetch(url).then(url).then((response) => response.text()).then((data) => {
            const domParser = new DOMParser()
            const newDoc = domParser.parseFromString(data, 'text/html')

            const currentContent = document.querySelector('main')
            currentContent.innerHTML = newDoc.querySelector('main').innerHTML
        })
    })
})