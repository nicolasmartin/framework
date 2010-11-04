
	// Edit
	public function edit($id = null) {	
		if ($this->Request()->post('id')) {
			${#Model#} = Doctrine::getTable('<?= $model ?>')->find($this->Request()->post('id'));
			if (!${#Model#}) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
				$this->redirect(array('action' => 'index'));
			}
			${#Model#}->fromArray($this->Request()->post());
			if (${#Model#}->isValid()) {
				${#Model#}->save();
				FlashComponent::set('success', "<?= cfirst('{#Singular#}') ?> édité{#female#}.");
				$this->redirect(array('action' => 'index'));
			} else {
				$errors = ${#Model#}->getErrorStack();
				FlashComponent::set('error', "Le formulaire contient ".pluralize(count($errors), '{une|#} erreur{s}.'));
			}
		} else {
			${#Model#} = Doctrine::getTable('<?= $model ?>')->find($id);
			if (!${#Model#}) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
				$this->redirect(array('action' => 'index'));
			}
		}
		$this->View->set('{#Model#}', ${#Model#});
	}
