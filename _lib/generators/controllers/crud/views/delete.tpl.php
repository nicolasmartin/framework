[? $this->set('ID',    "<?= strtolower($settings['model']) ?>Page") ?]
[? $this->set('TITLE', "Suppression d'<?= $settings['a'] ?> <?= $settings['singular'] ?>") ?]

<div id="content">
	<div id="main" class="<?= strtolower($settings['collection']) ?>">
		<h1>Suppression d'<?= $settings['a'] ?><?= $settings['singular'] ?></h1>

		[?= $this->partial('flash') ?]

		<ul class="toolbar">
			<li><a class="sprite prefix home" href="[?= UrlComponent::path(array('action' => 'index')) ?]">Retour aux <?= $settings['plural'] ?></a></li>
		</ul>

		[? $i=0; ?]
<? $fields = Doctrine::getTable($model)->getColumns(); ?>
		<table class="summary">
			<colgroup>
				<col style="width:20%">
				<col>
			</colgroup>
			<tbody>
<? foreach($fields as $field => $options) : ?>
<? if (!in_array($field, $settings['exclude'])) : ?>
				<tr class="[?= ++$i % 2 ? 'odd': 'even' ?]">
					<th scope="row"><?= cfirst(ThisGeneratorHelper::field($field, $settings['map'])) ?></th>
					<td>[?= $<?= $settings['model'] ?>['<?= $field ?>'] ?]</td>
				</tr>
<? endif ?>
<? endforeach ?>
			</tbody>
		</table>

		<div class="form">
		<form method="post" action="[?= UrlComponent::path(array('action' => 'delete'), $<?= $settings['model'] ?>['id']) ?]">
			<input type="hidden" name="id" value="[?= $<?= $settings['model'] ?>['id'] ?]">
			
			<div>
				<input class="button" type="submit" value="Supprimer"> 
				ou
				<a class="cancel" href="[?= UrlComponent::path(array('action' => 'index')) ?]">Annuler</a> 
			</div>

		</form>
		</div><!-- .form -->
		
  </div><!-- #main -->
</div><!-- #content -->
