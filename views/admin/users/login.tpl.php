<?php
	$this->set('TITLE', 		'Titre de la page');
	$this->set('DESCRIPTION',	'Description de la page');
?>
<div id="content" class="row">

	<div id="main">
		<h1>Accès privé</h1>
<?= $this->partial("flash") ?>
		<form action="/admin/users/login/" method="post">

		<div class="<?= ++$i%2 ? 'odd': 'even' ?>">
			<label>Identifiant</label>
			<input type="text" name="username" value="<?= $User['username'] ?>" size="40" placeholder="Votre identifiant" />
		</div>

		<div class="<?= ++$i%2 ? 'odd': 'even' ?>">
			<label>Mot de passe</label>
			<input type="password" name="password" value="<?= $User['password'] ?>" size="40" placeholder="Votre mot de passe" />
		</div>
		
		<div class="<?= ++$i%2 ? 'odd': 'even' ?>">
			<input type="submit" value="S'identifier" /> 
		</div>		
		</form>
	</div><!-- #main -->

</div><!-- #content -->