<?php
	interface ComponentInterface {		
		public function preExecute();
		public function postExecute();
		public function preRender();
		public function postRender();
	}
	
	class Component implements ComponentInterface {	
		protected $Controller;
		protected $options;
		
		public function preExecute() {
		}
		
		public function postExecute() {
		}
		
		public function preRender() {
		}
		
		public function postRender() {
		}
	}