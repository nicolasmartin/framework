
	// Edit
	public function edit($id = null) {	
		if (isset($_POST['id'])) {
			$<?= $settings['model'] ?> = Doctrine::getTable('<?= $model ?>')->find($_POST['id']);
			if (!$<?= $settings['model'] ?>) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
				$this->redirect('<?= GeneratorHelper::getPath($app, $controller) ?>/edit/'.$<?= $settings['model'] ?>['id']);
			}
			$<?= $settings['model'] ?>->fromArray($_POST);
			if ($<?= $settings['model'] ?>->isValid()) {
				$<?= $settings['model'] ?>->save();
				FlashComponent::set('success', "<?= ucfirst($settings['singular']) ?> édité<?= $settings['masc'] ? '' : 'e' ?>.");
				$this->redirect('/<?= $app ?>/<?= $controller ?>/');
			} else {
				$errors = $<?= $settings['model'] ?>->getErrorStack();
				FlashComponent::set('error', "Le formulaire contient ".pluralize(count($errors), '{une|#} erreur{s}.'));
			}
		} else {
			$<?= $settings['model'] ?> = Doctrine::getTable('<?= $settings['model'] ?>')->find($id);
			if (!$<?= $settings['model'] ?>) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
				$this->redirect('<?= GeneratorHelper::getPath($app, $controller) ?>/edit/'.$<?= $settings['model'] ?>['id']);
			}
		}
		$this->View->set('<?= $settings['model'] ?>', $<?= $settings['model'] ?>);
	}
