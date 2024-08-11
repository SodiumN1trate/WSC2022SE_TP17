export const url = 'http://localhost:8000/module_c_solution/api/v1'
export const media = 'http://localhost:8000/module_c_solution'

export const headers = {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'Authorization': 'Bearer ' + localStorage.getItem('token')
}