<?php

namespace PhpAspNetMvc\Mvc;

use PhpAspNetMvc\Types\String;

class ContentResult extends ActionResult{
	private $_content;
	private $_contentType;

	public function __construct(String $content=null, String $contentType=null) {
		if($content===null) {
			$content = new String('');
		}

		if($contentType===null) {
			$contentType = new String('text/plain; charset=utf-8');
		}

		$this->_content = $content;
		$this->_contentType = $contentType;
	}
	
	public function ExecuteResult(ControllerContext $context) {
		$response = $context->GetHttpContext()->GetResponse();

		$response->SetContentType($this->_contentType);
		$response->Write($this->_content);
	}
}