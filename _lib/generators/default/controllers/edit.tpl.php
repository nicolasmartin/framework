
	// Edit
	public function edit($id = null) {	
		if (isset($this->post['id'])) {
			$<?= $settings['model'] ?> = Doctrine::getTable('<?= $model ?>')->find($this->post['id']);
			if (!$<?= $settings['model'] ?>) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
				$this->redirect('<?= ThisGeneratorHelper::getPath($app, $controller) ?>/edit/'.$<?= $settings['model'] ?>['id']);
			}
			$<?= $settings['model'] ?>->fromArray($this->post);
			if ($<?= $settings['model'] ?>->isValid()) {
				$<?= $settings['model'] ?>->save();
				FlashComponent::set('success', "<?= ucfirst($settings['singular']) ?> édité<?= $settings['male'] ? '' : 'e' ?>.");
				$this->redirect('<?= ThisGeneratorHelper::getPath($app, $controller) ?>/');
			} else {
				$errors = $<?= $settings['model'] ?>->getErrorStack();
				FlashComponent::set('error', "Le formulaire contient ".pluralize(count($errors), '{une|#} erreur{s}.'));
			}
		} else {
			$<?= $settings['model'] ?> = Doctrine::getTable('<?= $model ?>')->find($id);
			if (!$<?= $settings['model'] ?>) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
				$this->redirect('<?= ThisGeneratorHelper::getPath($app, $controller) ?>/edit/'.$<?= $settings['model'] ?>['id']);
			}
		}
		$this->View->set('<?= $settings['model'] ?>', $<?= $settings['model'] ?>);
	}
