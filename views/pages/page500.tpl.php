	<?php $this->set('TITLE', 	"Erreur dand l'application"); ?>
	<?php $this->set('ID', 		"page500"); ?>
    
	<div id="content">
        <h1>Erreur dans l'application</h1>
        <p>Une erreur s'est produite dans l'application. Veuillez nous en excuser.</p>
        <p><a href="<?= UrlHelper::path('/') ?>">Retourner à l'accueil ?</a></p>
    </div>