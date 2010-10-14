
	// Batch action
	public function batch() {
		$id 	= $this->post['id'];
		$action = $this->post['action'];

		if (!$action) {
			FlashComponent::set('error', "Une action doit être choisie.");
			$this->redirect('<?= ThisGeneratorHelper::getPath($app, $controller) ?>/');
		}

		if (!count($id)) {
			FlashComponent::set('error', "Un ou plusieurs <?= ucfirst($settings['plural']) ?> doivent être coché<?= $settings['male'] ? '' : 'e' ?>s.");
			$this->redirect('<?= ThisGeneratorHelper::getPath($app, $controller) ?>/');
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
		$this->redirect('<?= ThisGeneratorHelper::getPath($app, $controller) ?>/');
	}
