[? $this->set('ID',    '<?= strtolower($settings['model']) ?>Page') ?]
[? $this->set('TITLE', 'Résumé d\'<?= $settings['a'] ?> <?= $settings['singular'] ?>') ?]

<div id="content">
	<div id="main" class="<?= strtolower($settings['collection']) ?>">
		<h1>Résumé d'<?= $settings['a'] ?> <?= $settings['singular'] ?></h1>

[?= $this->partial("flash") ?]

		<ul class="tools">
			<li><a class="button back" href="<?= ThisGeneratorHelper::getPath($app, $controller) ?>/">Retour aux <?= $settings['plural'] ?></a></li>
		</ul>

[? $i=0; ?]
<? $fields = Doctrine::getTable($model)->getColumns(); ?>
		<table class="summary">
			<colgroup>
				<col width="30%" />
				<col />
			</colgroup>
			<tbody>
<? foreach($fields as $field => $options) : ?>
<? if (!in_array($field, $settings['exclude'])) : ?>
				<tr class="[?= ++$i % 2 ? 'odd': 'even' ?]">
					<th scope="row"><?= ucfirst(ThisGeneratorHelper::field($field, $settings['map'])) ?></th>
					<td>[?= $<?= $settings['model'] ?>['<?= $field ?>'] ?]</td>
				</tr>
<? endif ?>
<? endforeach ?>
			</tbody>
		</table>

		<ul class="actions">
			<li><a class="sprite left prefix edit" title="Editer" href="<?= ThisGeneratorHelper::getPath($app, $controller) ?>/edit/[?= $<?= $settings['model'] ?>['id'] ?]">Editer</a></li>
			<li><a class="sprite left prefix delete" title="Supprimer" href="<?= ThisGeneratorHelper::getPath($app, $controller) ?>/delete/[?= $<?= $settings['model'] ?>['id'] ?]">Supprimer</a></li>
		</ul>
		
	</div><!-- #main -->
</div><!-- #content -->
