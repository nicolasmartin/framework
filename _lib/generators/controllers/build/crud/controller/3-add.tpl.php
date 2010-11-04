
	// Add
	public function add() {						
		if ($this->Request()->isPost()) {
			${#Model#} = new {#Model#}();
			${#Model#}->fromArray($this->Request()->post());	
			if (${#Model#}->isValid()) {
				${#Model#}->save();
				FlashComponent::set('success', "<?= cfirst('{#Singular#}') ?> créé{#female#}.");
				$this->redirect(array('action' => 'index'));
			} else {
				$errors = ${#Model#}->getErrorStack();
				FlashComponent::set('error', "Le formulaire contient ".pluralize(count($errors), '{une|#} erreur{s}.'));
			}
		} else {
			${#Model#} = new {#Model#}();
		}
		$this->View->setPath('{#controller#}/edit');
		$this->View->set('{#Model#}', ${#Model#});
	}
