[? 	$this->set('ID', '<?= strtolower($settings['model']) ?>Page'); ?]		 
[? if ($<?= $model ?>['id']) {
	$this->set('TITLE', 'Edition d\'<?= $settings['a'] ?> <?= $settings['singular'] ?>');
} else {
	$this->set('TITLE', 'Ajout d\'<?= $settings['a'] ?> <?= $settings['singular'] ?>');
} ?]		 
<div id="content">
	<div id="main" class="<?= strtolower($settings['collection']) ?>">
[? if ($<?= $model ?>['id']) : ?]
		<h1>Edition d'<?= $settings['a'] ?> <?= $settings['singular'] ?></h1>
[? else: ?]
		<h1>Ajout d'<?= $settings['a'] ?> <?= $settings['singular'] ?></h1>
[? endif ?]

[?= $this->partial("flash") ?]

		<ul class="toolbar">
			<li><a class="button back" href="<?= GeneratorHelper::getPath($app, $controller) ?>/">Retour aux <?= $settings['plural'] ?></a></li>
		</ul>

		<div class="form">
		
[? if (!$<?= $model ?>['id']) : ?]
		<form method="post" action="<?= GeneratorHelper::getPath($app, $controller) ?>/add/">
[? else: ?]
		<form method="post" action="<?= GeneratorHelper::getPath($app, $controller) ?>/edit/[?= $<?= $settings['model'] ?>['id'] ?]">
			<input type="hidden" name="id" value="[?= $<?= $settings['model'] ?>['id'] ?]">
[? endif; $i = 0 ?]

			<fieldset>
			<legend>Informations sur <?= $settings['le'] ?> <?= $settings['singular'] ?></legend>
				
<? $fields = Doctrine::getTable($model)->getColumns(); ?>
<? foreach($fields as $field => $options) : ?>
<? if (!in_array($field, $settings['exclude'])) : ?>
			<div class="[?= ++$i % 2 ? 'odd': 'even' ?]">
				<label for="<?= $field ?>"><?= ucfirst(InflectionComponent::humanize($field)) ?></label>
				<input size="40" type="text" id="<?= $field ?>" name="<?= $field ?>" value="[?= addslashes($<?= $settings['model'] ?>['<?= $field ?>']) ?]" [?= FormHelper::getErrorClass('<?= $field ?>', $<?= $settings['model'] ?>); ?]/>
				<small class="hint">Obligatoire</small>
[?= FormHelper::displayErrors('<?= $field ?>', $<?= $settings['model'] ?>) ?]
			</div>

<? endif ?>
<? endforeach ?>
			<div class="[?= ++$i % 2 ? 'odd': 'even' ?]">
				<input class="button" type="submit" value="Enregistrer"> 
				ou
				<a class="cancel" href="<?= GeneratorHelper::getPath($app, $controller) ?>/">Annuler</a> 
			</div>
			
			</fieldset>	
		</form>
		
		</div><!-- .form -->
  	</div><!-- #main -->
</div><!-- #content -->
