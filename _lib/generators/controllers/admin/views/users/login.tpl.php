[? $this->set('ID',    '<?= strtolower($settings['model']) ?>Page') ?]
[? $this->set('TITLE', 'Identification') ?]

<div id="content">
	<div id="main">
		<h1>Accès privé</h1>
		
[?= $this->partial("flash") ?][? $i = 0 ?]

		<form action="<?= ThisGeneratorHelper::getPath($app, $controller) ?>/login/" method="post">

		<fieldset>
		<legend>Identification</legend>
		
			<div class="[?= ++$i % 2 ? 'odd': 'even' ?]">
				<label>Identifiant</label>
				<input type="text" name="username" value="[?= $<?= $settings['model'] ?>['username'] ?]" size="40" placeholder="Votre identifiant" />
			</div>
			
			<div class="[?= ++$i % 2 ? 'odd': 'even' ?]">
				<label>Mot de passe</label>
				<input type="password" name="password" value="[?= $<?= $settings['model'] ?>['password'] ?]" size="40" placeholder="Votre mot de passe" />
			</div>
			
			<div class="[?= ++$i % 2 ? 'odd': 'even' ?]">
				<input class="button" type="submit" value="S'identifier" /> 
			</div>	
			
		</fieldset>	
		</form>
		
	</div>
</div>