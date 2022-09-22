// 從Axios 拉型別出來用
import { Method, AxiosRequestHeaders } from "axios";

// enum HTTP_VERBS {
//     GET = 'GET',
//     POST = 'POST',
//     PUT = 'PUT',
//     DELETE = 'DELETE',
//     PATCH = 'PATCH',
// }
// type tHttpVerbs = keyof typeof HTTP_VERBS;

export interface iResult {
    status: boolean;
    msg: string;
    data: any;
}

export const getData = async function (
    url: string,
    method: Method = 'GET',
    data: any = {},
    headers: AxiosRequestHeaders = {}
): Promise<iResult | false> {
    return await axios({
        url,
        method,
        data,
        headers,
    }).then((response) => {
        let result: iResult = {
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