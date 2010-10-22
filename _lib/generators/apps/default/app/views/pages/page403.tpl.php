<?php
	$this->set('ID', 			"page403");
	$this->set('TITLE', 		"Accès refusé");
	$this->set('DESCRIPTION',	"Vous n'avez pas les droits d'accès à cette page");
?>

<div id="content" class="row">
	<div id="main">
		<h1>Accès refusé</h1>
        <p>Vous n'avez pas les droits d'accès à cette page.</p>
        <p><a href="<?= UrlHelper::path('/') ?>">Retourner à l'accueil ?</a></p>
	</div><!-- #main -->
</div><!-- #content -->
