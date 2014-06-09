<?php

namespace PhpAspNetMvc\Net;

use PhpAspNetMvc\Types\String;
use PhpAspNetMvc\Types\Integer;

class Uri {
	private $_scheme;
	private $_host;
	private $_pathAndQuery;

	public function __construct(String $scheme, String $host, String $pathAndQuery) {
		$this->_scheme = $scheme;
		$this->_host = $host;
		$this->_pathAndQuery = $pathAndQuery;
	}

	public function __toString() {
		return (string)String::Format(new String("{0}://{1}{2}"), $this->_scheme,$this->_host,$this->_path);
	}

	public function GetPathAndQuery() {
		return $this->_pathAndQuery;
	}

	public function GetPath() {
		if(!$this->_pathAndQuery->Contains(new String("?"))) {
			return $this->_pathAndQuery;
		}

		return $this->_pathAndQuery->Substring(new Integer(0), $this->_pathAndQuery->IndexOf(new String("?")));
	}

	public function GetQuery() {
		$path = $this->GetPath();
		$pathAndQuery = $this->GetPathAndQuery();

		return $pathAndQuery->Substring($path->GetLength());
	}
}