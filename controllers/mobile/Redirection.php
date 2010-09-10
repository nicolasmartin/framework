<?php
	class RedirectionController extends Controller {

		public function index() {
			RedirectionComponent::cancel('mobile');
			$this->redirect('/');
		}
	}