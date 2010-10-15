
	// Add
	public function add() {						
		if ($this->post) {
			$<?= $settings['model'] ?> = new <?= $model ?>();
			$<?= $settings['model'] ?>->fromArray($this->post);	
			if ($<?= $settings['model'] ?>->isValid()) {
				$<?= $settings['model'] ?>->save();
				FlashComponent::set('success', "<?= ucfirst($settings['singular']) ?> créé<?= $settings['male'] ? '' : 'e' ?>.");
				$this->redirect('<?= ThisGeneratorHelper::getPath($app, $controller) ?>/');
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