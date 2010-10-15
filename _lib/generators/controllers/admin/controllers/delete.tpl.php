
	// Delete
	public function delete($id = null) {	
		if (isset($this->post['id'])) {
			$<?= $settings['model'] ?> = Doctrine::getTable('<?= $model ?>')->find($this->post['id']);
			if (!$<?= $settings['model'] ?>) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
			} else {
				$<?= $settings['model'] ?>->delete();
				FlashComponent::set('success', "<?= ucfirst($settings['singular']) ?> supprimé<?= $settings['male'] ? '' : 'e' ?>.");
			}
			$this->redirect('<?= ThisGeneratorHelper::getPath($app, $controller) ?>/');	
		} else {
			$<?= $settings['model'] ?> = Doctrine::getTable('<?= $model ?>')->find($id);
			if (!$<?= $settings['model'] ?>) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
				$this->redirect('<?= ThisGeneratorHelper::getPath($app, $controller) ?>/edit/'.$<?= $settings['model'] ?>['id']);
			}
		}
		$this->View->set('<?= $settings['model'] ?>', $<?= $settings['model'] ?>);
	}
