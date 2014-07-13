<?php

class Site extends Controller{

	/**
	 * Load the views necessary for the page
	 * @return void
	 */
	function index(){

		Load::view('header');
		Load::view('add_view');
		Load::view('list_view');
		Load::view('footer');

	}

}