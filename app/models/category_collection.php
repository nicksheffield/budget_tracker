<?php

class Category_collection{

	public $items = array();
	public $table = 'categories';
	private $db   = null;

	public function __construct(){
		$this->db = Registry::$db;
	}

	public function load(){
		$cats = $this->db->select('*')->from($this->table)->get();

		foreach($cats as $cat){
			$category = new Category_model();

			$category->fill($cat);

			$this->items[] = $category;
		}

		return $this->items;
	}

}