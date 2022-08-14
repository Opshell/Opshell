/**  字串相關 */
const str = {
    /** 補字 - 輸出成字串
     * @param {*} str // 輸入字
     * @param {Int} length // 最終長度
     * @param {String} padStr // 要補字
     * @param {String} type // 左補或右補 ('left' or 'right')
     * @returns {String} result
     */
    strPad: function(input, length, padStr = '0', type = 'left') {
        const oriText = input.toString();
        const inpLen = oriText.length;
        let addText = '';

        if (inpLen < length) {
            for (let i = inpLen; i < length; i++) {
                addText += padStr;
            }
        }

        const result = (type == 'left') ? addText + oriText : oriText + addText;
        return result;
    }
}
/** 物件相關 */
const obj = {
    /** 解深拷貝 */
    deepCopy: function(obj) {
        return JSON.parse(JSON.stringify(obj));
    },
    /** 判斷是否是物件
     * @param {*} obj
     * @returns
     */
    isObj: function(obj) {
        return obj != null && typeof obj === 'object';
    },
    /** 判斷物件是否為空 */
    isObjEmpty: function(obj) {
        return Object.keys(obj).length === 0;
    },
    /** 判斷兩個物件Key、value是否相等
     * @param {Object} obj1
     * @param {Object} obj2
     * @returns {Boolean}
     */
    isObjEqual: function(obj1, obj2) {
        const keys1 = Object.keys(obj1);
        const keys2 = Object.keys(obj2);

        if (keys1.length !== keys2.length) {
            return false;
        }

        for (let index = 0; index < keys1.length; index++) {
            const val1 = obj1[keys1[index]];
            const val2 = obj2[keys2[index]];
            const areObjects = obj.isObj(val1) && obj.isObj(val2);
            if (areObjects && !obj.isObjEqual(val1, val2) ||
                !areObjects && val1 !== val2) {
                return false;
            }
        }

        return true;
    },
    /** Object.prototype.hasOwnProperty.call
     * @param {Object} obj
     * @param {String} key
     * @returns {Boolean}
     */
    objHOP: function(obj, key) {
        return Object.prototype.hasOwnProperty.call(obj, key);
    }
}
/** 浮點數相關 */
const flt = {
    /** 浮點數相加
     * @param {*} float1
     * @param {*} float2
     * @returns
     */
    floatAddUp: function(float1, float2) {
        return parseFloat(float1) + parseFloat(float2);
    }
}

const Pligin = {
    install: function (vue) {
        for (const functionName in str) {
            if (Object.hasOwnProperty.call(str, functionName)) {
                const func = str[functionName];
                vue.config.globalProperties[functionName] = func;
            }
        }
        for (const functionName in obj) {
            if (Object.hasOwnProperty.call(obj, functionName)) {
                const func = obj[functionName];
                vue.config.globalProperties[functionName] = func;
            }
        }
        for (const functionName in flt) {
            if (Object.hasOwnProperty.call(flt, functionName)) {
                const func = flt[functionName];
                vue.config.globalProperties[functionName] = func;
            }
        }
    }
};

export default Pligin;
