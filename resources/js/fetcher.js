import axios from 'axios';

export const fetchData = async (url) => {
    return new Promise((resolve, reject) => {
        const response = axios.put(url);
        response.then(result => resolve(result.data))
        response.catch(error => reject(error))
    });
}

// module.exports = {
//     fetchData
// }
