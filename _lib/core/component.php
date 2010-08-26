<?php
	abstract class ComponentCore implements ComponentCoreInterface {	
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
	
	interface ComponentCoreInterface {		
		public function preExecute();
		
		public function postExecute();
		
		public function preRender();
		
		public function postRender();
	}