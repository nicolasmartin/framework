	
	// Show
	public function show($id = null) {
		$<?= $settings['model'] ?> = Doctrine::getTable('<?= $model ?>')->find($id);
		if (!$<?= $settings['model'] ?>) {
			FlashComponent::set('error', "Cet enregistrement n'existe pas.");
			$this->redirect('<?= GeneratorHelper::getPath($app, $controller) ?>');
		}
		$this->View->set('<?= $settings['model'] ?>', $<?= $settings['model'] ?>);
	}
