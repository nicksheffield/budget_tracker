<?php

class Item_model extends Model{
	protected $table    = 'items';
	protected $singular = 'Item';

	public function load_cat(){
		if($this->data['category_id']){
			$cat = new Category_model();

			$cat->load($this->data['category_id']);

			$this->data['category'] = $cat;
		}else{
			return false;
		}
	}
}