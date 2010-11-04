
	// Delete
	public function delete($id = null) {	
		if ($this->Request()->post('id')) {
			$<?= $settings['model'] ?> = Doctrine::getTable('<?= $model ?>')->find($this->Request()->post('id'));
			if (!$<?= $settings['model'] ?>) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
			} else {
				$<?= $settings['model'] ?>->delete();
				FlashComponent::set('success', "<?= cfirst($settings['singular']) ?> supprimé<?= $settings['male'] ? '' : 'e' ?>.");
			}
			$this->redirect(array('action' => 'index'));
		} else {
			$<?= $settings['model'] ?> = Doctrine::getTable('<?= $model ?>')->find($id);
			if (!$<?= $settings['model'] ?>) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
				$this->redirect(array('action' => 'index'));
			}
		}
		$this->View->set('<?= $settings['model'] ?>', $<?= $settings['model'] ?>);
	}
