/**
 * Deep Clone
 */

function deepClone(data) {
    if (!Array.isArray(data)) {
        let copy = {}
        Object.keys(data).forEach((field) => {
            copy[field] = data[field]
        })
        return  copy
    }
    let copy = []
    Object.keys(data).forEach((field) => {
        copy.push(data[field])
    })
    return copy
}





