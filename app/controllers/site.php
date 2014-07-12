<?php

class Site extends Controller{

	function index(){

		Load::view('header');
		Load::view('add_view');
		Load::view('list_view');
		Load::view('footer');

	}

}