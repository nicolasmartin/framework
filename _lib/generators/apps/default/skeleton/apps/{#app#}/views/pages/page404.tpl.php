<?php
	$this->set('ID', 			"page404");
	$this->set('TITLE', 		"Page introuvable");
	$this->set('DESCRIPTION',	"Cette page est introuvable");
?>

<div id="content" class="row">
	<div id="main">
		<h1>Page introuvable</h1>
		<p>La page que vous essayez de consulter n'existe pas.</p>
        <p><a href="<?= UrlHelper::path('/') ?>">Retourner à l'accueil ?</a></p>
	</div><!-- #main -->
</div><!-- #content -->
