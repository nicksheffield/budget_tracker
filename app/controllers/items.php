<?php

class Items extends Controller{




	/**
	 * Output a JSON object representing a single item
	 * @param  int $id
	 * @return void
	 */
	function get($id){
		$item = new Item_model();

		$item->load($id);

		JSON::output($item->data);
	}




	/**
	 * Output a JSON list of all items in a given month
	 * @param  string $date Must be a full textual month and a 4 character year separated by a comma, ie, january-2014
	 * @return void
	 */
	function get_date($date){
		$items = new Item_collection();

		$items->load($date);

		JSON::output($items->items);
	}




	/**
	 * Saves a new item into the database
	 * @return void
	 */
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




	/**
	 * Deletes an item from the database
	 * @return void
	 */
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