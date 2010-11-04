
	// Edit
	public function edit($id = null) {	
		if ($this->Request()->post('id')) {
			$<?= $settings['model'] ?> = Doctrine::getTable('<?= $model ?>')->find($this->Request()->post('id'));
			if (!$<?= $settings['model'] ?>) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
				$this->redirect(array('action' => 'index'));
			}
			$<?= $settings['model'] ?>->fromArray($this->Request()->post());
			if ($<?= $settings['model'] ?>->isValid()) {
				$<?= $settings['model'] ?>->save();
				FlashComponent::set('success', "<?= cfirst($settings['singular']) ?> édité<?= $settings['male'] ? '' : 'e' ?>.");
				$this->redirect(array('action' => 'index'));
			} else {
				$errors = $<?= $settings['model'] ?>->getErrorStack();
				FlashComponent::set('error', "Le formulaire contient ".pluralize(count($errors), '{une|#} erreur{s}.'));
			}
		} else {
			$<?= $settings['model'] ?> = Doctrine::getTable('<?= $model ?>')->find($id);
			if (!$<?= $settings['model'] ?>) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
				$this->redirect(array('action' => 'index'));
			}
		}
		$this->View->set('<?= $settings['model'] ?>', $<?= $settings['model'] ?>);
	}
