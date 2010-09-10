<?php
	class UsersController extends Controller {
		public function preExecute() {
			$this->addComponent('protection');
			parent::preExecute();
		}
		
		public function login() {
			if ($_POST) {
				$User = Doctrine::getTable('User')->findOneByUsername($_POST['username']);
				
				if (Config::get('su.username') == $_POST['username'] && Config::get('su.password') == sha1($_POST['password'])) {
					$Admin = new User();
					$Admin->fromArray(array(
						'firstname' => 'Administrateur',
						'username' 	=> 'admin'
					));
					$this->Components['protection']->login($Admin);
					FlashComponent::set('success', "Connecté. Bienvenue Administrateur !");
					$this->redirect('/admin/');
				} else if ($User && $User->isAuthorized($_POST['password'])) {
					$this->Components['protection']->login($User);
					FlashComponent::set('success', "Connecté. Bienvenue ".$User['firstname']." !");
					$this->redirect('/admin/');
				} else {
					FlashComponent::set('error', "Mot de passe incorrect.");
				}
			} else {
				$User = new User();
			}
			$this->View->set('User', $User);
		}
		
		public function logout() {
			FlashComponent::set('success', "Déconnecté. A bientôt ".$this->Components['protection']->getUser()->firstname." !");
			$this->Components['protection']->logout();
			$this->redirect('/admin/users/login');
		}
		
		public function create() {
			$User = new User();			
			$User->fromArray($this->getParams());
			if ($User->isValid()) {
				$User->save();
				FlashComponent::set('success', "Utilisateur '".$User->username."' créé.");
			} else {
				FlashComponent::set('error', "Une erreur est survenue. L'utilisateur n'a pas été créé.");
			}
			$this->redirect('/admin/');
		}	
	}
?>