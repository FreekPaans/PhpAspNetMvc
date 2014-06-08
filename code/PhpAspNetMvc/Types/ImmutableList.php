<?php

namespace PhpAspNetMvc\Types;

class ImmutableList implements \IteratorAggregate{
	private $_items;

	public static function CreateNew() {
		return new ImmutableList(array());
	}

	private function __construct($array) {
		$this->_items = $array;
	}

	public function Add($item) {
		$items = $this->_items;
		$items[] = $item;

		return new ImmutableList($items);
	}

	public function Count() {
		return count($this->_items);
	}

	public function getIterator() {
		return new \ArrayIterator($this->_items);
	}
}