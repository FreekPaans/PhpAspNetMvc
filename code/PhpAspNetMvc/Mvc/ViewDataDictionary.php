<?php

namespace PhpAspNetMvc\Mvc;

class ViewDataDictionary {
	private $_model;
	private $_items;

	private function __construct($model=null, array $items=null) {
		$this->_model = $model;

		if($items===null) {
			$this->_items = array();
		}
		else {
			$this->_items = $items;
		}
	}

	public static function GetEmpty(){
		return new ViewDataDictionary();
	}

	public function WithModel($model) {
		return new ViewDataDictionary($model,$this->_items);
	}

	public function GetModel() {
		return $this->_model;
	}

	public function ContainsItem($key) {
		return array_key_exists($key, $this->_items);
	}

	public function GetItem($key) {
		return $this->_items[$key];
	}

	public function AddItem($key, $value) {
		if($this->ContainsItem($key)) {
			throw new \Exception(new String("Item with key {0} already exists"), $key);
		}

		$newItems = $this->_items;
		$newItems[$key] = $value;		

		return new ViewDataDictionary($this->_model, $newItems);
	}
}