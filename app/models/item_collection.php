<?php

class Item_collection{

	public    $items = array();
	protected $table = 'items';
	protected $db    = null;

	public function __construct(){
		$this->db = Registry::$db;
	}

	public function load($start_date, $end_date){
		$this->db->select('*')->from($this->table);

		$this->db->where(array(
			'date > '  => $start_date.' '.Date('H:i:s'),
			'date <= ' => $end_date.' '.Date('H:i:s'),
			'deleted'  => 0
		));

		$this->db->order_by('date');

		$items = $this->db->get();

		foreach($items as $item){
			$newItem = new Item_model();
			$newItem->fill($item);

			$newItem->load_cat();

			$this->items[] = $newItem;
		}

		return $this->items;
	}

	public function get_cat($category_id){
		
	}
}