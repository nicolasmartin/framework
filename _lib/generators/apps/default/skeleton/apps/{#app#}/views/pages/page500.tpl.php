<?php
	$this->set('ID', 			"page500");
	$this->set('TITLE', 		"Erreur dans l'application");
	$this->set('DESCRIPTION',	"L'application a rencontré un erreur");
?>

<div id="content" class="row">
	<div id="main">
		<h1>Erreur dans l'application</h1>
        <p>Une erreur s'est produite dans l'application. Veuillez nous en excuser.</p>
        <p><a href="<?= UrlHelper::path('/') ?>">Retourner à l'accueil ?</a></p>
	</div><!-- #main -->
</div><!-- #content -->
