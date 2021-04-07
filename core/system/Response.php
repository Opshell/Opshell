<?php
namespace Core;

class Response {
	private $headers = array();
	private $output;

	public function addHeader($header) {
		$this->headers[] = $header;
	}

	public function setHttpCode($code){
		http_response_code($code);
	}

	public function redirect($url) {
		header('Location: ' . $url);
		exit;
	}

	public function setOutput($output, $type = 'html') {
		if($type == 'json'){
			$this->addHeader('Accept: application/json');
			$this->addHeader('Content-Type: application/json; charset=UTF-8');
			$output = json_encode($output,JSON_UNESCAPED_UNICODE);
		}

		$this->output = $output;
	}

	public function output() {
		if ($this->output) {
			if (!headers_sent()) {
				foreach ($this->headers as $header) {
					header($header, true);
				}
			}

			echo $this->output;
		}
	}
}