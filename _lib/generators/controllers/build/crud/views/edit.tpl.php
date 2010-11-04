[? 	$this->set('ID', "{#controller#}-page"); ?]		 
[? if (${#Model#}['id']) {
	$this->set('TITLE', "Edition d'{#a#}");
} else {
	$this->set('TITLE', "Ajout d'{#a#}");
} ?]
<? if(file_exists(ROOT.'/www/'.$app.'/js/tinymce/config.js')) : ?>
[? $this->addScript(base().'/js/tinymce/tiny_mce.js') ?]
[? $this->addScript(base().'/js/tinymce/config.js') ?]
<? endif ?>

<div id="content">
	<div id="main" class="{#collection#}">
		[? if (${#Model#}['id']) : ?]
		<h1>Edition d'{#a#}</h1>
		[? else: ?]
		<h1>Ajout d'{#a#}</h1>
		[? endif ?]

		[?= $this->partial('flash') ?]

		<ul class="toolbar">
			<li><a class="sprite prefix home" href="[?= UrlComponent::path(array('action' => 'index')) ?]">Retour aux {#plural#}</a></li>
		</ul>

		[? $i = 0 ?]
		<div class="form">
		[? if (!${#Model#}['id']) : ?]
		<form method="post" action="[?= UrlComponent::path(array('action' => 'add')) ?]">
		[? else: ?]
		<form method="post" action="[?= UrlComponent::path(array('action' => 'edit'), ${#Model#}['id']) ?]">
			<input type="hidden" name="id" value="[?= ${#Model#}['id'] ?]">
		[? endif; ?]
			<fieldset>
			<legend>Informations sur {#the#}</legend>
				
<? $fields = Doctrine::getTable($model)->getColumns(); ?>
<? foreach($fields as $field => $options) : ?>
<? if (!in_array($field, $exclude)) : ?>
			<div class="[?= ++$i % 2 ? 'odd': 'even' ?] [?= FormHelper::getErrorClass('<?= $field ?>', ${#Model#}, false); ?]">
				<label for="<?= $field ?>"><?= cfirst(ThisGeneratorHelper::field($field, $mapping)) ?></label>
				[?= <?= ThisGeneratorHelper::getFormElement($model, $field, '{#Model#}') ?> ?] <?= ThisGeneratorHelper::getFormHint($model, $field, '{#Model#}') ?>
				[?= FormHelper::displayErrors('<?= $field ?>', ${#Model#}) ?]
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