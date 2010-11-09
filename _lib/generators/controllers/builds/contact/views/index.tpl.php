[? $this->set('ID', 			"{#controller#}-page"); ?]
[? $this->set('TITLE',			"Nous contacter"); ?]
[? $this->set('DESCRIPTION', 	"Notre formulaire de contact"); ?]

<div id="content">
	<div id="main" class="col3-4 first {#collection#}">
		<h1>Nous contacter</h1>

		[?= $this->partial('flash') ?]

		[? $i = 0 ?]
		<div class="form">
		<form method="post" action="[?= UrlComponent::path(array('action' => 'send')) ?]">
			<fieldset>
				
<? $fields = Doctrine::getTable("$model")->getColumns(); ?>
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
				<input class="button" type="submit" value="Envoyer le message"> 
			</div>

		</form>
		</div><!-- .form -->
  	</div><!-- #main -->

  	</div id="sidebar" class="col1-4 last">
	
  	</div><!-- #sidebar -->
</div><!-- #content -->