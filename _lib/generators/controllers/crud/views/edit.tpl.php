[? 	$this->set('ID', "<?= strtolower($settings['model']) ?>Page"); ?]		 
[? if ($<?= $settings['model'] ?>['id']) {
	$this->set('TITLE', "Edition d'<?= $settings['a'] ?> <?= $settings['singular'] ?>");
} else {
	$this->set('TITLE', "Ajout d'<?= $settings['a'] ?> <?= $settings['singular'] ?>");
} ?]
	 
<div id="content">
	<div id="main" class="<?= strtolower($settings['collection']) ?>">
		[? if ($<?= $settings['model'] ?>['id']) : ?]
		<h1>Edition d'<?= $settings['a'] ?> <?= $settings['singular'] ?></h1>
		[? else: ?]
		<h1>Ajout d'<?= $settings['a'] ?> <?= $settings['singular'] ?></h1>
		[? endif ?]

		[?= $this->partial('flash') ?]

		<ul class="toolbar">
			<li><a class="sprite prefix home" href="[?= UrlComponent::path(array('action' => 'index')) ?]">Retour aux <?= $settings['plural'] ?></a></li>
		</ul>

		[? $i = 0 ?]
		<div class="form">
		[? if (!$<?= $settings['model'] ?>['id']) : ?]
		<form method="post" action="[?= UrlComponent::path(array('action' => 'add')) ?]">
		[? else: ?]
		<form method="post" action="[?= UrlComponent::path(array('action' => 'edit'), $<?= $settings['model'] ?>['id']) ?]">
			<input type="hidden" name="id" value="[?= $<?= $settings['model'] ?>['id'] ?]">
		[? endif; ?]
			<fieldset>
			<legend>Informations sur <?= $settings['the'] ?><?= $settings['singular'] ?></legend>
				
<? $fields = Doctrine::getTable($model)->getColumns(); ?>
<? foreach($fields as $field => $options) : ?>
<? if (!in_array($field, $settings['exclude'])) : ?>
			<div class="[?= ++$i % 2 ? 'odd': 'even' ?] [?= FormHelper::getErrorClass('<?= $field ?>', $<?= $settings['model'] ?>, false); ?]">
				<label for="<?= $field ?>"><?= cfirst(ThisGeneratorHelper::field($field, $settings['map'])) ?></label>
				[?= <?= ThisGeneratorHelper::getFormElement($model, $field, $settings['model']) ?> ?]
				<?= ThisGeneratorHelper::getFormHint($model, $field, $settings['model']) ?>
				[?= FormHelper::displayErrors('<?= $field ?>', $<?= $settings['model'] ?>) ?]
			</div>

<? endif ?>
<? endforeach ?>
			</fieldset>	
			
			<div>
				<input class="button" type="submit" value="Enregistrer"> 
				ou
				<a class="cancel" href="[?= UrlComponent::path(array('action' => 'index')) ?]">Annuler</a> 
			</div>

		</form>
		</div><!-- .form -->
  	</div><!-- #main -->
</div><!-- #content -->

[? $this->addStyle(base().'/js/yui-editor/skins/default/skin.css') ?]
[? $this->addScript(base().'/js/yui-editor/jquery.yui-editor.js') ?]
<script>
$(function() {    
    $('.editor').yuiEditor();
});
</script>