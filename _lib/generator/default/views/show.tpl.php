[? $this->set('ID',    '<?= strtolower($settings['model']) ?>Page') ?]
[? $this->set('TITLE', 'Résumé d\'<?= $settings['a'] ?> <?= $settings['singular'] ?>') ?]

<div id="content">
	<div id="main" class="<?= strtolower($settings['collection']) ?>">
		<h1>Résumé d'<?= $settings['a'] ?> <?= $settings['singular'] ?></h1>

[?= $this->partial("flash") ?]

		<ul class="tools">
			<li><a class="button back" href="<?= GeneratorHelper::getPath($app, $controller) ?>/">Retour aux <?= $settings['plural'] ?></a></li>
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
<? if ($field != 'id') : ?>
				<tr class="[?= ++$i % 2 ? 'odd': 'even' ?]">
					<th scope="row"><?= ucfirst(InflectionComponent::humanize($field)) ?></th>
					<td>[?= $<?= $settings['model'] ?>['<?= $field ?>'] ?]</td>
				</tr>
<? endif ?>
<? endforeach ?>
			</tbody>
		</table>

	</div><!-- #main -->
</div><!-- #content -->
