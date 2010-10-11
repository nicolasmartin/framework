
	// Add
	public function add() {						
		if ($_POST) {
			$<?= $settings['model'] ?> = new <?= $model ?>();
			$<?= $settings['model'] ?>->fromArray($_POST);	
			if ($<?= $settings['model'] ?>->isValid()) {
				$<?= $settings['model'] ?>->save();
				FlashComponent::set('success', "<?= ucfirst($settings['singular']) ?> créé<?= $settings['masc'] ? '' : 'e' ?>.");
				$this->redirect('<?= GeneratorHelper::getPath($app, $controller) ?>/');
			} else {
				$errors = $<?= $settings['model'] ?>->getErrorStack();
				FlashComponent::set('error', "Le formulaire contient ".pluralize(count($errors), '{une|#} erreur{s}.'));
			}
		} else {
			$<?= $settings['model'] ?> = new <?= $model ?>();
		}
		$this->View->setPath('<?= strtolower($controller) ?>/edit/');
		$this->View->set('<?= $settings['model'] ?>', $<?= $settings['model'] ?>);
	}
