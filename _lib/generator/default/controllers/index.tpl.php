
	// Index
	public function index() {
		$<?= $settings['collection'] ?> = Doctrine::getTable('<?= $model ?>')->findAll();
		$this->View->set('<?= $settings['collection'] ?>', $<?= $settings['collection'] ?>);
	}
