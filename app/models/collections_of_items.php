<?php

class Collections_of_items{

	private $db = null;
	public $items = array();

	public function __construct(){
		$this->db = Registry::$db;
	}

	public function load($start, $end, $id = false){
		$this->db
			->select('items.id, description, price, date, categories.name')
			->from('categories, items')
			->join('categories.id = items.category_id')
			->where(array(
				'deleted' => 0,
				'date > ' => $start,
				'date <=' => $end
			));

		if($id){
			$this->db->where(array('items.category_id' => $id));
		}

		$this->items = $this->db->get();

		return $this->items;
	}
}