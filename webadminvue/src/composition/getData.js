// import { ref } from 'vue';
import axios from 'axios';

export const getData = async function (url, data = {}, type = 'POST', header = {}) {
    return await axios({
        url: url,
        method: type,
        data: data,
        headers: header,
    }).then((response) => {
        console.log(response);
        let result = {
            status: false,
            msg: response.data.message,
            data: response.data.data,
        }

        if (response.status == 200 && response.data.status == 'Success') {
                result.status = true;
        }

        return result;
    }).catch(() => {
        return false;
    });
}

export default {
    setup() {
        return {
            getData
        }
    }
}