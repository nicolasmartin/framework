<?php
	$this->set('TITLE', 		'Titre de la page');
	$this->set('DESCRIPTION',	'Description de la page');
?>
    <div id="home" class="current">
        <div class="toolbar">
            <h1>Titre du site</h1>
            <a class="button slideup" id="infoButton" href="#about">?</a>
        </div>
        <ul class="rounded">
            <li class="arrow"><a href="#page3">Page 1</a> <small class="counter">Vide</small></li>
            <li class="arrow"><a href="#page3">Page 2</a> <small class="counter">Vide</small></li>
            <li class="forward"><a href="#page3">Page 3</a></li>
        </ul>
        <p><a href="<?= UrlHelper::path('/mobile/redirection/') ?>" class="grayButton">Site traditionnel</a></p>
    </div>

    <div id="page1>">
        <div class="toolbar">
            <h1>Page 1</h1>
            <a class="back" href="#home">Retour</a>
        </div>
        <div class="info">
            <p>Texte d'information</p>
        </div>
        <ul class="rounded">
            <li>Diverses choses...</li>
            <li>Diverses choses...</li>
            <li>Diverses choses...</li>
        </ul>
    </div>
    
      <div id="page2>">
        <div class="toolbar">
            <h1>Page 2</h1>
            <a class="back" href="#home">Retour</a>
        </div>
        <div class="info">
            <p>Texte d'information</p>
        </div>
        <ul class="rounded">
            <li>Diverses choses...</li>
            <li>Diverses choses...</li>
            <li>Diverses choses...</li>
        </ul>
    </div>

    <div id="page3">
        <div class="toolbar">
            <h1>Page 3</h1>
            <a class="back" href="#home">Retour</a>
        </div>
        <div class="info">
            <p>Texte d'information</p>
        </div>
        <ul class="rounded">
            <li>Diverses choses...</li>
            <li>Diverses choses...</li>
            <li>Diverses choses...</li>
        </ul>
    </div>

    <div id="about" class="selectable">
        <h3>Titre du site</h3>
        <p>Description du site</p>
        
        <p><a href="<?= UrlHelper::mailto(Config::get('project.email')) ?>" class="whiteButton">Email</a></p>
        <p><a href="#" class="grayButton goback">Fermer</a></p>
    </div>