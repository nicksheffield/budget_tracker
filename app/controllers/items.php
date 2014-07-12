<?php

class Items extends Controller{





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





	function get($id){
		$item = new Item_model();

		$item->load($id);

		JSON::output($item->data);
	}





	function get_date($date){
		$items = new Item_collection();

		$items->load($date);

		JSON::output($items->items);
	}





	function save(){
		if(Input::posted()){
			$item = new Item_model();

			if(!Input::get('category_id')){
				JSON::output(array('success' => false, 'error' => 'No Category'));
				return;
			}

			if(!Input::get('price')){
				JSON::output(array('success' => false, 'error' => 'No price'));
				return;
			}

			$item->price        = Input::get('price');
			$item->description  = Input::get('description');
			$item->date         = date('Y-m-d H:i:s');
			$item->category_id  = Input::get('category_id');

			JSON::output(array('success' => $item->save(), 'item' => $item->data));
		}else{
			JSON::output(array('success' => false, 'error' => 'Nothing posted'));
		}
	}





	function delete(){
		if(Input::posted()){
			$item = new Item_model();

			$item->load(Input::get('id'));

			$item->delete();

			JSON::output(array('success' => $item->deleted));
		}else{
			JSON::output(array('success' => false, 'error' => 'Nothing posted'));
		}
	}





}