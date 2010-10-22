[? 	$this->set('ID', '<?= strtolower($settings['model']) ?>Page'); ?]		 
[? if ($<?= $settings['model'] ?>['id']) {
	$this->set('TITLE', 'Edition d\'<?= $settings['a'] ?> <?= $settings['singular'] ?>');
} else {
	$this->set('TITLE', 'Ajout d\'<?= $settings['a'] ?> <?= $settings['singular'] ?>');
} ?]
	 
<div id="content">
	<div id="main" class="<?= strtolower($settings['collection']) ?>">
		[? if ($<?= $settings['model'] ?>['id']) : ?]
		<h1>Edition d'<?= $settings['a'] ?> <?= $settings['singular'] ?></h1>
		[? else: ?]
		<h1>Ajout d'<?= $settings['a'] ?> <?= $settings['singular'] ?></h1>
		[? endif ?]

		[?= $this->partial("flash") ?]

		<ul class="tools">
			<li><a class="button back" href="<?= ThisGeneratorHelper::getPath($app, $controller) ?>">Retour aux <?= $settings['plural'] ?></a></li>
		</ul>

		[? $i = 0 ?]
		<div class="form">
		[? if (!$<?= $settings['model'] ?>['id']) : ?]
		<form method="post" action="<?= ThisGeneratorHelper::getPath($app, $controller) ?>/add">
		[? else: ?]
		<form method="post" action="<?= ThisGeneratorHelper::getPath($app, $controller) ?>/edit/[?= $<?= $settings['model'] ?>['id'] ?]">
			<input type="hidden" name="id" value="[?= $<?= $settings['model'] ?>['id'] ?]">
		[? endif; ?]
			<fieldset>
			<legend>Informations sur <?= $settings['the'] ?><?= $settings['singular'] ?></legend>
				
<? $fields = Doctrine::getTable($model)->getColumns(); ?>
<? foreach($fields as $field => $options) : ?>
<? if (!in_array($field, $settings['exclude'])) : ?>
			<div class="[?= ++$i % 2 ? 'odd': 'even' ?] [?= FormHelper::getHasErrorClass('<?= $field ?>', $<?= $settings['model'] ?>, false); ?]">
				<label for="<?= $field ?>"><?= ucfirst(ThisGeneratorHelper::field($field, $settings['map'])) ?></label>
				<input size="40" type="text" id="<?= $field ?>" name="<?= $field ?>" value="[?= addslashes($<?= $settings['model'] ?>['<?= $field ?>']) ?]" [?= FormHelper::getErrorClass('<?= $field ?>', $<?= $settings['model'] ?>); ?]/>
				<small class="hint">Obligatoire</small>
				[?= FormHelper::displayErrors('<?= $field ?>', $<?= $settings['model'] ?>) ?]
			</div>

<? endif ?>
<? endforeach ?>
			</fieldset>	
			
			<div>
				<input class="button" type="submit" value="Enregistrer"> 
				ou
				<a class="cancel" href="<?= ThisGeneratorHelper::getPath($app, $controller) ?>">Annuler</a> 
			</div>

		</form>
		</div><!-- .form -->
  	</div><!-- #main -->
</div><!-- #content -->
