
	// Login 
	public function login() {
		if ($this->post) {
			$<?= $settings['model'] ?> = Doctrine::getTable('<?= $model ?>')->findOneByUsername($this->post['username']);
			
			if (Config::get('su.username') == $this->post['username'] && Config::get('su.password') == sha1($this->post['password'])) {
				$Admin = new <?= $settings['model'] ?>();
				$Admin->fromArray(array(
					'firstname'	=> 'Administrateur',
					'username' 	=> 'admin'
				));
				$this->Components['protection']->login($Admin);
				FlashComponent::set('success', "Connecté. Bienvenue Administrateur !");
				$this->redirect('<?= ThisGeneratorHelper::getPath($app) ?>/');
			} else if ($<?= $settings['model'] ?> && $<?= $settings['model'] ?>->isAuthorized(sha1($this->post['password']))) {
				$this->Components['protection']->login($<?= $settings['model'] ?>);
				FlashComponent::set('success', "Connecté. Bienvenue ".$<?= $settings['model'] ?>['firstname']." !");
				$this->redirect('<?= ThisGeneratorHelper::getPath($app) ?>/');
			} else {
				$<?= $settings['model'] ?> = new <?= $settings['model'] ?>();
				$<?= $settings['model'] ?>->fromArray($this->post);
				$<?= $settings['model'] ?>['password'] = '';
				FlashComponent::set('error', "Mot de passe incorrect.");
			}
		} else {
			$<?= $settings['model'] ?> = new <?= $settings['model'] ?>();
		}
		$this->View->set('<?= $settings['model'] ?>', $<?= $settings['model'] ?>);
	}
