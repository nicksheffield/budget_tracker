<?php

class Categories extends Controller{





	function __construct(){
		Input::fake_ajax();
		
		if(!Input::ajax()){
			Load::error('forbidden');
			exit;
		}
	}





	function index(){
		Load::error('forbidden');
	}





	function get_all(){
		$categories = new Category_collection();

		$categories->load();

		JSON::output($categories->items);
	}
}