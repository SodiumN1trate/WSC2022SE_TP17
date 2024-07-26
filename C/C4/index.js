//Here is your CODE!
window.addEventListener('load', () => {
    const  btn = document.querySelector('.render-btn')
    let text = document.querySelectorAll('p')
    const container = document.querySelector('.container')
    let changed = false


    btn.addEventListener('click', (e) => {
        const range = window.getSelection().getRangeAt(0)
        const  parentNode = range.startContainer.parentNode

        let result = parentNode.textContent.slice(0, range.startOffset) + '<span class="highlight">' + parentNode.textContent.slice(range.startOffset, range.endOffset) + '</span>' + parentNode.textContent.slice(range.endOffset)
        const newElement = document.createElement('p');
        console.log(result)
        newElement.innerHTML = `<p>${result}</p>`

        parentNode.parentNode.replaceChild(newElement.firstChild, parentNode)

            /*
        // let result = null
        // if(!changed) {
        //     let texts = [];
        //     text.forEach((row) => {
        //         texts.push(row.innerHTML)
        //     })
        //     result = texts.join('\n\n').replace(window.getSelection().toString(), `<span class="highlight">${window.getSelection().toString()}</span>`)
        // } else {
        //     result = text.replace(window.getSelection().toString(), `<span class="highlight">${window.getSelection().toString()}</span>`)
        // }
        // container.innerHTML = `<h1>WorldSkills</h1> ${result.replaceAll('\n\n', '<br><br>')}`
        // text = result
        // changed = true
         */
    })
})