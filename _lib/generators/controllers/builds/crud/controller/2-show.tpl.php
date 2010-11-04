	
	// Show
	public function show($id = null) {
		${#Model#} = Doctrine::getTable('<?= $model ?>')->find($id);
		if (!${#Model#}) {
			FlashComponent::set('error', "Cet enregistrement n'existe pas.");
			$this->redirect(array('action' => 'index'));
		}
		$this->View->set('{#Model#}', ${#Model#});
	}
