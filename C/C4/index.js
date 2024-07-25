//Here is your CODE!
window.addEventListener('load', () => {
    const  btn = document.querySelector('.render-btn')
    let text = document.querySelectorAll('p')
    const container = document.querySelector('.container')
    let changed = false
    btn.addEventListener('click', (e) => {
        let result = null
        if(!changed) {
            let texts = [];
            text.forEach((row) => {
                texts.push(row.innerHTML)
            })
            result = texts.join('\n\n').replace(window.getSelection().toString(), `<span class="highlight">${window.getSelection().toString()}</span>`)
        } else {
            result = text.replace(window.getSelection().toString(), `<span class="highlight">${window.getSelection().toString()}</span>`)
        }
        container.innerHTML = `<h1>WorldSkills</h1> ${result.replaceAll('\n\n', '<br><br>')}`
        text = result
        changed = true
    })
})