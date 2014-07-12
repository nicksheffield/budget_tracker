<?php

class Categories extends Controller{





	function get_all(){
		$categories = new Category_collection();

		$categories->load();

		JSON::output($categories->items);
	}
}