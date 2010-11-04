
	// Delete
	public function delete($id = null) {	
		if ($this->Request()->post('id')) {
			${#Model#} = Doctrine::getTable('<?= $model ?>')->find($this->Request()->post('id'));
			if (!${#Model#}) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
			} else {
				${#Model#}->delete();
				FlashComponent::set('success', "<?= cfirst('{#Singular#}') ?> supprimé{#female#}.");
			}
			$this->redirect(array('action' => 'index'));
		} else {
			${#Model#} = Doctrine::getTable('<?= $model ?>')->find($id);
			if (!${#Model#}) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
				$this->redirect(array('action' => 'index'));
			}
		}
		$this->View->set('{#Model#}', ${#Model#});
	}
