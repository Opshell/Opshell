// [-] 字串相關
export const str = {
    // 補字 - 輸出成字串
    strPad: function (input: string, length: number, padStr = '0', type = 'left') {
        const oriText = input.toString();
        const inpLen = oriText.length;
        let addText = '';

        if (inpLen < length) {
            for (let i = inpLen; i < length; i++) {
                addText += padStr;
            }
        }

        const result = type == 'left' ? addText + oriText : oriText + addText;
        return result;
    },
};

/** 物件相關 */
interface iAnyObj {
    [key: string]: any;
}
export const obj = {
    /** 解深拷貝 */
    deepCopy: function (obj: iAnyObj) {
        return JSON.parse(JSON.stringify(obj));
    },
    /** 判斷是否是物件 */
    isObj: function (obj: iAnyObj) {
        return obj != null && typeof obj === 'object';
    },
    /** 判斷物件是否為空 */
    isObjEmpty: function (obj: iAnyObj) {
        return Object.keys(obj).length === 0;
    },
    /** 判斷兩個物件Key、value是否相等 */
    isObjEqual: function (obj1: iAnyObj, obj2: iAnyObj) {
        const keys1 = Object.keys(obj1);
        const keys2 = Object.keys(obj2);

        if (keys1.length !== keys2.length) {
            return false;
        }

        for (let index = 0; index < keys1.length; index++) {
            const val1 = obj1[keys1[index]];
            const val2 = obj2[keys2[index]];
            const areObjects = obj.isObj(val1) && obj.isObj(val2);
            if ((areObjects && !obj.isObjEqual(val1, val2)) || (!areObjects && val1 !== val2)) {
                return false;
            }
        }

        return true;
    },
    // [-] Object.prototype.hasOwnProperty.call
    objHOP: function (obj: iAnyObj, key: string) {
        return Object.prototype.hasOwnProperty.call(obj, key);
    },
};
type tNumStrUnion = number | string;

/** 浮點數相關 */
export const flt = {
    /** 浮點數相加 */
    floatAddUp: function (float1: tNumStrUnion, float2: tNumStrUnion) {
        if (typeof float1 === 'string') {
            float1 = parseFloat(float1);
        }
        if (typeof float2 === 'string') {
            float2 = parseFloat(float2);
        }

        return float1 + float2;
    },
};

export default {
    setup() {
        return {
            str,
            obj,
            flt,
        };
    },
};

// const Pligin = {
//     install: function (vue) {
//         for (const functionName in str) {
//             if (Object.hasOwnProperty.call(str, functionName)) {
//                 const func = str[functionName];
//                 vue.config.globalProperties[functionName] = func;
//             }
//         }
//         for (const functionName in obj) {
//             if (Object.hasOwnProperty.call(obj, functionName)) {
//                 const func = obj[functionName];
//                 vue.config.globalProperties[functionName] = func;
//             }
//         }
//         for (const functionName in flt) {
//             if (Object.hasOwnProperty.call(flt, functionName)) {
//                 const func = flt[functionName];
//                 vue.config.globalProperties[functionName] = func;
//             }
//         }
//     },
// };

// export default Pligin;
