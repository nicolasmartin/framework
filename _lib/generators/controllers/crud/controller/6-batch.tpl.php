
	// Batch action
	public function batch() {
		if (!$this->post['action']) {
			FlashComponent::set('error', "Une action doit être choisie.");
			$this->redirect(array('action' => 'index'));
		} else {
    		$action = $this->post['action'];		    
		}
		if (!isset($this->post['id'])) {
			FlashComponent::set('error', "Au moins un éléments doit être coché.");
			$this->redirect(array('action' => 'index'));
		} else {
		    $id = $this->post['id'];
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
				FlashComponent::set('success', pluralize(count($id), "{<?= cfirst($settings['singular']) ?>|<?= cfirst($settings['plural']) ?>} effacé<?= $settings['male'] ? '' : 'e' ?>{s}"));
			break;
		}
		$this->redirect(array('action' => 'index'));
	}
