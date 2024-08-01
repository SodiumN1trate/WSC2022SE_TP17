


document.addEventListener('keydown', (e) => {
    if(e.key.toLowerCase() === 'a') {
        Synth.play('0', 'C', 4, 1)
    }
    if(e.key.toLowerCase() === 's') {
        Synth.play('0', 'D', 4, 1)
    }
    if(e.key.toLowerCase() === 'd') {
        Synth.play('0', 'E', 4, 1)
    }
    if(e.key.toLowerCase() === 'f') {
        Synth.play('0', 'F', 4, 1)
    }
    if(e.key.toLowerCase() === 'j') {
        Synth.play('0', 'G', 4, 1)
    }
    if(e.key.toLowerCase() === 'k') {
        Synth.play('0', 'A', 4, 1)
    }
    if(e.key.toLowerCase() === 'l') {
        Synth.play('0', 'B', 4, 1)
    }
    document.getElementById(e.key.toLowerCase()).classList.add('pressed')
})

document.addEventListener('keyup', (e) => {
    document.getElementById(e.key.toLowerCase()).classList.remove('pressed')
})
