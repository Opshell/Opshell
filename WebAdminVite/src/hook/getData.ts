// 從Axios 拉型別出來用
import { Method, AxiosRequestHeaders } from 'axios';

export interface iResult {
    status: boolean;
    msg: string;
    data: any;
}

export const getData = async function (
    url: string,
    method: Method = 'GET',
    data: any = {},
    headers: AxiosRequestHeaders = {},
): Promise<iResult | false> {
    return await axios({
        url,
        method,
        data,
        headers,
    })
        .then((response) => {
            const result: iResult = {
                status: false,
                msg: response.data.message,
                data: response.data.data,
            };

            if (response.status == 200 && response.data.status == 'Success') {
                result.status = true;
            }

            return result;
        })
        .catch(() => false);
};

export default {
    setup() {
        return {
            getData,
        };
    },
};
