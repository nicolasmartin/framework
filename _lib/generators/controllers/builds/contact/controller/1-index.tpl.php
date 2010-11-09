
	// Index
	public function index() {	
		${#Model#} = new <?= $model ?>();
		$this->View->set('{#Model#}', ${#Model#});
	}
