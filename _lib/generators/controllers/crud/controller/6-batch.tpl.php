
	// Batch action
	public function batch() {
		$id 	= $this->post['id'];
		$action = $this->post['action'];

		if (!$action) {
			FlashComponent::set('error', "Une action doit être choisie.");
			$this->redirect(array('action' => 'index'));
		}
		if (!count($id)) {
			FlashComponent::set('error', "Un<?= $settings['male'] ? '' : 'e' ?> ou plusieurs <?= ucfirst($settings['plural']) ?> doivent être coché<?= $settings['male'] ? '' : 'e' ?>s.");
			$this->redirect(array('action' => 'index'));
		}

		switch ($action) {
			case "delete":
                $Items = Doctrine::getTable('<?= $model ?>')
                            ->createQuery()
                            ->whereIn('id', $id)
                            ->execute();
				foreach ($Items as $Item) {
					$Item->delete();
				}
				FlashComponent::set('success', pluralize(count($id), "{<?= ucfirst($settings['singular']) ?>|<?= ucfirst($settings['plural']) ?>} effacé<?= $settings['male'] ? '' : 'e' ?>{s}"));
			break;
		}
		$this->redirect(array('action' => 'index'));
	}
