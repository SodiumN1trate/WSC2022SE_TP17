export const url = import.meta.env.VITE_APP_API
export const media = import.meta.env.VITE_MEDIA_URL

export const headers = {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'Authorization': 'Bearer ' + localStorage.getItem('token')
}