
	// Delete
	public function delete($id = null) {	
		if (isset($_POST['id'])) {
			$<?= $settings['model'] ?> = Doctrine::getTable('<?= $model ?>')->find($_POST['id']);
			if (!$<?= $settings['model'] ?>) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
			} else {
				$<?= $settings['model'] ?>->delete();
				FlashComponent::set('success', "<?= ucfirst($settings['singular']) ?> supprimé<?= $settings['masc'] ? '' : 'e' ?>.");
			}
			$this->redirect('<?= GeneratorHelper::getPath($app, $controller) ?>/');	
		} else {
			$<?= $settings['model'] ?> = Doctrine::getTable('<?= $model ?>')->find($id);
			if (!$<?= $settings['model'] ?>) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
				$this->redirect('<?= GeneratorHelper::getPath($app, $controller) ?>/edit/'.$<?= $settings['model'] ?>['id']);
			}
		}
		$this->View->set('<?= $settings['model'] ?>', $<?= $settings['model'] ?>);
	}
