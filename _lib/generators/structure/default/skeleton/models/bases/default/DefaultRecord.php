<?php
class DefaultRecord extends Doctrine_Record
{
	public $defaultMessages = array(
		'notblank' 	=> "Ce champs est obligatoire",
		'notnull' 	=> "Ce champs est obligatoire",
		'nospace'	=> "Ce champs ne doit pas contenir d'espace",
		'readonly'	=> "Ce champs ne peut être modifié",
		'email'		=> "L'email entrée n'est pas valide",
		'unique'	=> "Cette valeur existe déjà dans la base de données",
		'unsigned'	=> "Cette valeur ne peut être négative",
		'regexp'	=> "Cette valeur n'est pas valide",
		'digits'	=> "Cette valeur est invalide",
		'range'		=> "Cette valeur doit être comprise entre %min% et %max%",
		'minlength'	=> "Cette valeur doit être supérieure %length%",
		'htmlcolor'	=> "Cette couleur n'est pas valide",
		'ip'		=> "Cette adresse IP n'est pas valide",
		'date'		=> "Cette date n'est pas valide",
		'past'		=> "Cette date est déjà passée",
		'future'	=> "Cette date n'est pas encore passée",
	);
	
	public function getErrorMessage($key, $field = null) {
		if (isset($this->messages) && isset($this->messages[$field][$key])) {
			$message = $this->messages[$field][$key];
		} else if (isset($this->messages) && isset($this->messages[$key])) {
			$message = $this->messages[$key];
		} else if (isset($this->defaultMessages[$key])) {
			$message = $this->defaultMessages[$key];
		} else {
			$message = cfirst($key);
		}

		if ($field) { 
			$columns = $this->getTable()->getColumns();
			if (isset($columns[$field])) { 
				$default = array(
					'minlength' => null,
					'range' 	=> array(null, null),
				);
				$column = array_merge($default, $columns[$field]);
				$message = str_replace('%length%', 	$column['minlength'],	$message);
				$message = str_replace('%min%', 	$column['range'][0], 	$message);
				$message = str_replace('%max%', 	$column['range'][1], 	$message);
			}
		}
		return $message;
	}
}