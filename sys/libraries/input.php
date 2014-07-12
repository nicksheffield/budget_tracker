<?php

class Input{

	public static $data = array();

	public static function get($key){
		if(isset(self::$data[$key])){
			return self::$data[$key];
		}else{
			return false;
		}
	}

	public static function set($key, $val){
		self::$data[$key] = $val;
	}

	public function has($key){
		return isset(self::$data[$key]);
	}

	public static function posted(){
		return !!count(self::$data);
	}

	public static function fake_ajax(){
		$_SERVER['HTTP_X_REQUESTED_WITH'] = true;
	}

	public static function ajax(){
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']);
	}

}