const buttons = document.querySelectorAll('.btn')

let comments = []

const like = (commentId, liked) => {
    let removeHighlight = false
    let commentContainer = document.getElementById(commentId)
    commentContainer.childNodes[3].childNodes[1].style.backgroundColor = '#f8f9fa'
    commentContainer.childNodes[3].childNodes[3].style.backgroundColor = '#f8f9fa'

    let existingComment = comments.filter((comment) => comment.id === commentId)
    if (existingComment.length === 1 && existingComment[0].liked === liked) {
        comments = comments.filter((comment) => comment.id !== commentId)
        removeHighlight = true
    } else {
        comments = comments.filter((comment) => comment.id !== commentId)
        comments.push({
            id: commentId,
            liked: liked
        })
    }

    if (!removeHighlight && liked) {
        let button = commentContainer.childNodes[3].childNodes[1]
        button.style.backgroundColor = 'gray'
    } else if (!removeHighlight && liked === false) {
        let button = commentContainer.childNodes[3].childNodes[3]
        button.style.backgroundColor = 'gray'
    }
}

const summary = () => {
    const likes = comments.filter((comment) => comment.liked === true)
    const dislikes = comments.filter((comment) => comment.liked === false)
    alert(`Thumbs up: ${likes.length} \n Thumbs down: ${dislikes.length}`)
}