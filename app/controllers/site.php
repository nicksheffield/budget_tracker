<?php

class Site extends Controller{

	function index(){

		$cats = new Category_collection();

		$cats->load();

		$data['categories'] = array('_'=>'Please select');

		foreach($cats->items as $cat){
			$data['categories'][$cat->id] = $cat->name;
		}

		Load::view('header');
		Load::view('add_view', $data);
		Load::view('footer');
	}

	function save(){
		$response = array();

		if(Input::ajax() && Input::posted()){
			$item = new Item_model();

			if(Input::has('price') && Input::get('category') != '_'){

				$item->price        = Input::get('price');
				$item->description  = Input::get('description');
				$item->date         = date('Y-m-d H:i:s');
				$item->category_id  = Input::get('category');

				if($item->save()){
					$response['success'] = true;
				}else{
					$response['success'] = false;
					$response['error'] = '<i class="fa fa-times"></i>Either the price or category were not set';
				}

			}else{
				$response['success'] = false;
				$response['error'] = '<i class="fa fa-times"></i>Either the price or category were not set';
			}

			echo json_encode($response);
			return;
		}

		URL::redirect('/');
	}

	function list_items($month = false, $year = false){

		$data = $this->_get_items($month, $year);

		# View stuff

		Load::view('header');
		Load::view('list_view', $data);
		Load::view('footer');
	}

	function json_items($month = false, $year = false){
		Load::model('collections_of_items');

		$dates = $this->_get_dates($month, $year);

		$c = new Collections_of_items();

		$c->load($dates['start_year'].'-'.$dates['start_month'].'-17', $dates['end_year'].'-'.$dates['end_month'].'-17');

		echo json_encode($c->items);
		return;
	
	}

	function filter_list(){
		if(Input::posted()){
			URL::redirect('/list/'.Input::get('month').'/'.Input::get('year'));
		}else{
			URL::redirect('/list');
		}
	}

	function _get_items($month, $year){
		# Date stuff

		$dates = $this->_get_dates($month, $year);
		$data['start_date'] = $dates['start_date'];
		$data['end_date'] = $dates['end_date'];
		

		if($month) Sticky::set('month', $month);
		if($year)  Sticky::set('year', $year);

		# Collection stuff

		$item_collection = new Item_collection();

		$item_collection->load($dates['start_year'].'-'.$dates['start_month'].'-17', $dates['end_year'].'-'.$dates['end_month'].'-17');

		$data['items'] = $item_collection->items;

		return $data;
	}

	function _get_dates($month, $year){
		$end_month = $month ? $month : Date('n');
		$end_year  = $year ? $year : Date('Y');

		if($end_month == 1){
			$start_month = 12;
			$start_year = $end_year - 1;
		}else{
			$start_month = $end_month - 1;
			$start_year = $end_year;
		}

		$data['start_date'] = '17/'.$start_month.'/'.$start_year;
		$data['end_date'] = '17/'.$end_month.'/'.$end_year;

		$data['start_month'] = $start_month;
		$data['start_year'] = $start_year;

		$data['end_month'] = $end_month;
		$data['end_year'] = $end_year;

		return $data;
	}

	function delete($id = false){
		if($id){
			$item = new Item_model();

			$item->load($id);

			$item->delete();
		}

		URL::redirect('/list');
	}
}