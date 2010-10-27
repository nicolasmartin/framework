<?php
class DefaultRecord extends Doctrine_Record
{
	public $default = array(
		'notblank' 	=> "Ce champs est obligatoire",
		'unique'	=> "Cette valeur existe déjà dans la base de données",
		'email'		=> "L'email entrée n'est pas valide",
		'nospace'	=> "Ce champs ne doit pas contenir d'espace",
	);
}