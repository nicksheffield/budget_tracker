<?php

class Category_collection{

	public    $items = array();
	protected $table = 'categories';
	protected $db    = null;

	public function __construct(){
		$this->db = Registry::$db;
	}

	public function load(){
		$this->items = $this->db->select('*')->from($this->table)->get();

		return $this->items;
	}

}