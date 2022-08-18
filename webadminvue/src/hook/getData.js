// import { ref } from 'vue';
import axios from 'axios';

export const getData = async function (url, type = 'GET', data = {}, header = {}) {
    return await axios({
        url: url,
        method: type,
        data: data,
        headers: header,
    }).then((response) => {
        let result = {
            status: false,
            msg: response.data.message,
            data: response.data.data,
        }

        if (response.status == 200 && response.data.status == 'Success') {
            result.status = true;
        }

        return result;
    }).catch(() => false);
}

export default {
    setup() {
        return {
            getData
        }
    }
}