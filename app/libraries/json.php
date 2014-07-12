<?php

class JSON{

	public static $data = array();

	public static function add($arr){
		self::$data = array_merge(self::$data, $arr);
	}

	public static function header(){
		header('Content-Type: application/json');
	}

	public function output($arr = flase){
		if($arr){
			self::add($arr);
		}

		self::header();

		echo json_encode(self::$data);
	}

}