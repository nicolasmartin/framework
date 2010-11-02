<?php
class DefaultController extends Controller {	

	// Protection
	public function preExecute() {
		$this->addComponent('protection', 
			array('basic' => array(
				'username' => Config::get('su.username'), 
				'password' => Config::get('su.password')
			))
		);
		parent::preExecute();
	}
	
	// Index
	public function index() {
	}
}