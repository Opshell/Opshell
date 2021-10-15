/** 常用的 js function 集合
 *  Version: 0.0.1
 *  Author: Opshell
 * 
 *  p.s. Need ES6
 *  Last Update time: 2021-01-15
 */

/** 檢查值 沒有的話給預設值 ES6前用
 * @param {*} v 
 * @param {*} def 
 */
function chkDefault(v, def) { 
    v = (typeof v !== 'undefined') ? v : def;
    return v;
}


/** 不滿字數的字串補字
 * @param {str} string 需要補字的字串
 * @param {len} int 要補到的長度
 * @param {char} string 要補的字元
 * @param {side} string 要補的方向 left || right
 * @return {str} string 回傳補好的字串
 */
function padChar(str, len = 2, char = '0', side = 'left') {
    var tmp = '';
    if (str.length < len) {
        var count = parseInt(len) - str.length;
        for (let i = 0; i < count; i++) {
            tmp += char;
        }
    }

    return  (side == 'left') ? tmp + str : str + tmp;
}


/** 價格數字轉換成特定格式字串
 * @param {price} int 價格 ex: 1000
 * @param {float} int 保留小數位 ex: 2
 * @param {delimiter} string 分隔符號 ex: ','
 * @param {currency} string 貨幣符號 ex: '$NT '
 * 
 * @retuen {result} string ex: "$NT 1,000.00"
 */
function priceFormat(price, float = 2, delimiter = ',', currency = 'NT$ ') {
    var p = parseFloat(price); // 轉數字
    if (isNaN(p)) return false;

    float = parseInt(float);
    // 取小數點位數
    var digits = parseInt(padChar('1', float + 1, '0', 'right'));
    var p = Math.round(price * digits) / digits;

    var s = p.toString();
    var rs = s.indexOf('.');
    if (rs < 0 && float > 0) { // 結果為-1則無小數點出現，補小數點
        s += '.';
        s += padChar('', float, '0', 'right');
    }

    // 切割字串
    var leftNum = s.split(".")[0];
    var rightNum = (float > 0)?"." + s.split(".")[1]:"";
    var result = s;

    var resultArray = new Array();
    if(leftNum.length > 3){
        var i = true;
        while (i){
            resultArray.push(leftNum.slice(-3));
            leftNum = leftNum.slice(0, leftNum.length-3);
            if(leftNum.length < 4){
                i = false;
            }
        }

        // 因為從後向前截取，所以倒敘回來重組
        var sortArray = new Array();
        for(var i = resultArray.length-1; i >= 0; i--){
            sortArray.push(resultArray[i]);
        }
        result = leftNum + delimiter+sortArray.join(delimiter) + rightNum;
    }

    return currency + result;
}


/** Vue 模板載入
 *  @param {fileName} String // 模板名稱
 *  @param {filePath} String // 檔案路徑 預設 library/js/vue-template/
 */
function templateLoader(fileName, filePath = 'library/js/vue-template/') {
    url = filePath + fileName;
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", url, false);
    xhttp.send();
    if(xhttp.readyState == 4 && xhttp.status == 200){
        return xhttp.responseText;
    }
    return '<p style="color:red;">Template URL Error.</p>';
}