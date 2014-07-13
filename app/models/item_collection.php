<?php

class Item_collection{

	public    $items = array();
	protected $table = 'items';
	protected $db    = null;

	public function __construct($date = false){
		$this->db = Registry::$db;

		if($date) $this->load($date);
	}

	public function load($date = false){
		$this->db
			->select('items.id, categories.name, description, price, date, deleted')
			->from('items, categories')
			->join('items.category_id = categories.id');

		# If the date was provided
		if($date){
			# Figure out what the end month and year are
			$emonth = date('m', $stamp);
			$eyear  = date('Y', $stamp);

		# If the date was not provided
		}else{
			# Figure out the current month and year
			$emonth = date('m');
			$eyear  = date('Y');
		}

		# Figure out the start date.
		# If the month is january
		if($emonth == 1){
			# Then we need to roll back the year by 1
			$syear = $eyear - 1;
			# And set to december of that year
			$smonth = 12;

		# If the month is not january,
		}else{
			# use the same current year
			$syear = $eyear;
			# and just roll the month back
			$smonth = $emonth - 1;
		}

		$this->db->where(array(
			'date > '  => "$syear-$smonth-17",
			'date <= ' => "$eyear-$emonth-17",
			'deleted'  => 0
		));

		$this->db->order_by('date');

		$this->items = $this->db->get();

		return $this->items;
	}
}