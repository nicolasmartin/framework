	<?php $this->set('TITLE', "Accès refusé"); ?>
	<?php $this->set('ID', "page403"); ?>
    
    <div id="content">
        <h3>Accès refusé</h3>
        <p>Vous n'avez pas les droits d'accès à cette page.</p>
        <p><a href="<?= UrlHelper::path('/') ?>">Retourner à l'accueil ?</a></p>
    </div>