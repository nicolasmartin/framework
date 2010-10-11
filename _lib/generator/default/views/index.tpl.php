[? $this->set('ID',    '<?= strtolower($settings['model']) ?>Page') ?]
[? $this->set('TITLE', 'Liste des <?= $settings['plural'] ?>') ?]
<div id="content">
	<div id="main" class="<?= strtolower($settings['collection']) ?>">
		<h1>Liste des <?= $settings['plural'] ?></h1>
			
[?= $this->partial("flash") ?]

		<ul class="tools">
			<li><a class="button add" href="<?= GeneratorHelper::getPath($app, $controller) ?>/add/">Ajouter <?= $settings['a'] ?> <?= $settings['singular'] ?></a></li>
		</ul>

[? $i=0; ?]
<? $fields = Doctrine::getTable($model)->getColumns(); ?>
		<table class="list">
			<colgroup>
<? foreach($fields as $field => $options) : ?>
<? if (!in_array($field, $settings['exclude'])) : ?>
				<col />
<? endif ?>
<? endforeach ?>
				<col width="100" />
			</colgroup>
			<thead>
				<tr>
<? foreach($fields as $field => $options) : ?>
<? if (!in_array($field, $settings['exclude'])) : ?>
					<th scope="col"><?= ucfirst($field) ?></th>
<? endif ?>
<? endforeach ?>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="100">&nbsp;</td>
				</tr>
			</tfoot>
			<tbody>
[? foreach ($<?= $settings['collection'] ?> as $<?= $settings['model'] ?>): ?]
				<tr class="[?= ++$i % 2 ? 'odd': 'even' ?]">
<? $r = 0; foreach($fields as $field => $options) : ?>
<? if (++$r == 2) : ?>
					<th scope="row">
						<a title="Voir le résumé" href="<?= GeneratorHelper::getPath($app, $controller) ?>/show/[?= $<?= $settings['model'] ?>['id'] ?]">[?= $<?= $settings['model'] ?>['<?= $field ?>'] ?]</a>
					</th>
<? elseif (!in_array($field, $settings['exclude'])) : ?>
					<td>[?= $<?= $settings['model'] ?>['<?= $field ?>'] ?]</td>
<? endif ?>
<? endforeach ?>
					<td>
						<ul class="actions">
							<li><a class="sprite icon edit" title="Editer" href="<?= GeneratorHelper::getPath($app, $controller) ?>/edit/[?= $<?= $model ?>['id'] ?]">Editer</a></li>
							<li><a class="sprite icon delete" title="Supprimer" href="<?= GeneratorHelper::getPath($app, $controller) ?>/delete/[?= $<?= $model ?>['id'] ?]">Supprimer</a></li>
						</ul>
					</td>
				</tr>
[? endforeach ?]

[? if (!count($<?= $settings['collection'] ?>)) : ?]
				<tr class="empty [?= ++$i % 2 ? 'odd': 'even' ?]">
					<td colspan="100">Aucun<?= $settings['masc'] ? '' : 'e' ?> <?= $settings['singular'] ?>.</td>
				</tr>
[? endif ?]
			</tbody>
		</table>
		
	</div><!-- #main -->
</div><!-- #content -->

