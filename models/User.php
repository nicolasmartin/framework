<?php
class User extends BaseUser
{
	public $messages = array(
		'firstname' => array('notblank' => "Le prénom de l'utilisateur est obligatoire"),
		'name' 		=> array('notblank' => "Le nom de l'utilisateur est obligatoire"),
		'username' 	=> array('notblank' => "L'identifiant est obligatoire"),
		'password' 	=> array('notblank' => "Le mot de passe est obligatoire")
	);
  
	public function isAuthorized($password) {
		if ($password == $this->password && $this->status == 1) {
			return true;
		}
		return false;
	}
}