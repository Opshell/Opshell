<?php
namespace Core;

class RESTful {
    private $httpVersion = "HTTP/1.1";
    private $httpStatus = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => '(Unused)',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported'
    ];
    private $headers = [];
    private $output;

    /** 後端強制跳轉
     * @param STRING $url
     */
    public function redirect($url){
        header('Location: ' . $url);
        exit;
    }

    /** 設定header
     * @param STRING $header
     */
    public function addHeader($header){
        $this->headers[] = $header;
    }

    /** 設定HttpStatusCode
     * @param STRING $header
     */
    public function setHttpCode($code){
        // 設定輸出status
        http_response_code($code);
        $statusMessage = ($this->httpStatus[$code]) ?? $this->httpStatus[500];
        $this->addHeader($this->httpVersion . " " . $code . " " . $statusMessage);
    }

    /** 設定輸出
     *  @param $data 輸出的資料
     *  @param STRING $ContentType 輸出的格式 {html, json, xml}
     *  @param INT $statusCode 輸出的狀態 $this->statusCode
     *  @param STRING $charset 輸出的編碼
     *  @return $this->outpot
     */
    public function setOutput($data, $statusCode = 200, $ContentType = 'html', $charset = 'UTF-8'){
        if(http_response_code() == 200){ // 未設定過 或 設定200 覆寫他的設定
            $this->setHttpCode($statusCode);
        }

        // 設定輸出格式 & 格式化資料
        if($ContentType == 'html'){
            $this->addHeader('Accept: text/html');
            $this->addHeader('Content-Type: text/html; charset=' . $charset);
        }else if ($ContentType == 'json') {
            $this->addHeader('Accept: application/json');
            $this->addHeader('Content-Type: application/json; charset='. $charset);

            $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        }else if($ContentType == 'xml'){
            $this->addHeader('Accept: application/xml');
            $this->addHeader('Content-Type: application/xml; charset=' . $charset);

            $xml = new \SimpleXMLElement('<?xml version="1.0"?><site></site>');
            foreach ($data as $k => $v) {
                $xml->addChild($k, $v);
            }
            $data = $xml->asXML();
        }

        $this->output = $data;
    }

    // 輸出
    public function output(){
        if ($this->output) { // 有要輸出的資料
            if (!headers_sent()) { // 如果後端沒有強制跳轉
                foreach ($this->headers as $header) { // 就設定輸出header
                    header($header, true);
                }
            }

            echo $this->output; // 輸出
        }
    }
}