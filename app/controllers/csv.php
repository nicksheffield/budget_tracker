<?php

class csv extends Controller{
	
	function index(){

		Load::library('form');

		Load::view('csv_upload');

	}

	function upload(){
		if(Input::posted()){

			$csv_data = '';

			Load::library('upload');

			if(Input::has('text')){
				$csv_data = Input::get('text');
				$data = array();

				$c_s = explode("\n", $csv_data);

				$c_s = array_slice($c_s, 8);

				foreach($c_s as $line){
					$e_line = explode(',', $line);

					$n_line = array(
						'date'   => $e_line[0],
						'id'     => $e_line[1],
						'type'   => $e_line[2],
						'cheque' => $e_line[3],
						'payee'  => $e_line[4],
						'memo'   => $e_line[5],
						'amount' => $e_line[6]
					);

					if($n_line['id']){
						$item = new Item_model();
						$item->date = date('Y-m-d H:i:s', strtotime($n_line['date']));
						$item->price = $n_line['amount'] * -1;
						$item->description = $n_line['payee'];


						echo '<pre>';print_r($item->data);echo '</pre>';
					}
				}
			}
		}
	}

}