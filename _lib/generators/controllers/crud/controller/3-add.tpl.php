
	// Add
	public function add() {						
		if ($this->post) {
			$<?= $settings['model'] ?> = new <?= $model ?>();
			$<?= $settings['model'] ?>->fromArray($this->post);	
			if ($<?= $settings['model'] ?>->isValid()) {
				$<?= $settings['model'] ?>->save();
				FlashComponent::set('success', "<?= cfirst($settings['singular']) ?> créé<?= $settings['male'] ? '' : 'e' ?>.");
				$this->redirect(array('action' => 'index'));
			} else {
				$errors = $<?= $settings['model'] ?>->getErrorStack();
				FlashComponent::set('error', "Le formulaire contient ".pluralize(count($errors), '{une|#} erreur{s}.'));
			}
		} else {
			$<?= $settings['model'] ?> = new <?= $model ?>();
		}
		$this->View->setPath('<?= strtolower($controller) ?>/edit');
		$this->View->set('<?= $settings['model'] ?>', $<?= $settings['model'] ?>);
	}
