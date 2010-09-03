	<?php $this->set('TITLE', "Page introuvable"); ?>
	<?php $this->set('ID', "page404"); ?>
    
	<div id="content">
		<h3>Page introuvable</h3>
		<p>La page que vous essayez de consulter n'existe pas.</p>
        <p><a href="<?= UrlHelper::path('/') ?>">Retourner à l'accueil ?</a></p>
    </div>