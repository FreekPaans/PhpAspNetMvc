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

	public static function FromArray(array $array) {
		return new ImmutableList($array);
	}

	public function Map(callable $mapper) {
		return new ImmutableList(array_map($mapper,$this->_items));
	}

	public function Filter(callable $filter) {
		return new ImmutableList(array_values(array_filter($this->_items, $filter))); //TODO check if arraay_values preserves order
	}

	public function GetLength() {
		return new Integer(count($this->_items));
	}

	public function InRange(Integer $position) {
		return $position->ToInt() < $this->GetLength()->ToInt();
	}

	public function ItemAt(Integer $index) {
		if($index->ToInt()>=$this->GetLength()->ToInt()) {
			throw new \Exception(String::Format(new String("Index out of range: {0}, size: {1}"),$index,$this->GetLength()));
		}
		return $this->_items[$index->ToInt()];
	}
}