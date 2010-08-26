<?php
class User extends BaseUser
{
	public $messages = array(
		'firstname' => array('notblank' => "Le prénom de l'utilisateur est obligation"),
		'name' 		=> array('notblank' => "Le nom de l'utilisateur est obligation"),
		'username' 	=> array('notblank' => "L'identifiant de l'utilisateur est obligation"),
		'password' 	=> array('notblank' => "Le mot de passe de l'utilisateur est obligation")
	);
	
	public function __set($name, $value) {
		if ($name == "password") {
			return $this->_set('password', sha1($value));
		}
		return $this->_set($name, $value);
	}

  
	public function isAuthorized($password) {
		if (sha1($password) == $this->password && $this->status == 1) {
			return true;
		}
		return false;
	}
}