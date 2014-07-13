<?php

class Categories extends Controller{




	/**
	 * Outputs a JSON list containing all categories
	 * @return void
	 */
	function get_all(){
		$categories = new Category_collection();

		$categories->load();

		JSON::output($categories->items);
	}
}