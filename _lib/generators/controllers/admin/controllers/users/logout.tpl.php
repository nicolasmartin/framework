
	// Logout 
	public function logout() {
		FlashComponent::set('success', "Déconnecté. A bientôt ".$this->Components['protection']->getUser()->name." !");
		$this->Components['protection']->logout();
		$this->redirect('/admin/users/login');
	}