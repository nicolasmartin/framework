[? $this->set('ID',    "<?= strtolower($settings['model']) ?>Page") ?]
[? $this->set('TITLE', "Liste des <?= $settings['plural'] ?>") ?]

<div id="content">
	<div id="main" class="<?= strtolower($settings['collection']) ?>">
		<h1>Liste des <?= $settings['plural'] ?></h1>
			
		[?= $this->partial('flash') ?]

		<ul class="toolbar">
			<li><a class="sprite prefix add" href="[?= UrlComponent::path(array('action' => 'add')) ?]">Ajouter <?= $settings['a'] ?><?= $settings['singular'] ?></a></li>
		</ul>

		[? $i=0; ?]
		<form action="[?= UrlComponent::path(array('action' => 'batch')) ?]" method="post">
<? $fields = Doctrine::getTable($model)->getColumns(); ?>
		<table class="list">
			<colgroup>
				<col width="20" />
<? foreach($fields as $field => $options) : ?>
<? if (!in_array($field, $settings['exclude'])) : ?>
				<col />
<? endif ?>
<? endforeach ?>
				<col width="90" />
			</colgroup>
			<thead>
				<tr>
					<th scope="col"><input id="checkall" type="checkbox" /></th>
<? foreach($fields as $field => $options) : ?>
<? if (!in_array($field, $settings['exclude'])) : ?>
					<th scope="col">[?= UrlHelper::orderBy('<?= $field ?>', "<?= cfirst(ThisGeneratorHelper::field($field, $settings['map']))?>") ?]</th>
<? endif ?>
<? endforeach ?>
					<th scope="col">&nbsp;</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="2" class="batch-actions">
						<select name="action">
							<option value="">&#8212; Actions &#8212;</option>
							<option value="delete">Supprimer</option>
						</select>
						<input class="button" type="submit" value="Appliquer" />
					</td>
					<td colspan="100">
						[?= $this->partial('pagination', array('Pager' => $Pager)); ?]
					</td>
				</tr>
			</tfoot>
			<tbody>
				[? foreach ($<?= $settings['collection'] ?> as $<?= $settings['model'] ?>): ?]
				<tr class="[?= ++$i % 2 ? 'odd': 'even' ?]">
					<td class="checkboxes"><input type="checkbox" name="id[]" value="[?= $<?= $settings['model'] ?>['id'] ?]" /></td>
<? $r = 0; foreach($fields as $field => $options) : ?>
<? if (++$r == 2) : ?>
					<th scope="row">
						<a title="Voir le résumé" href="[?= UrlComponent::path(array('action' => 'show'), $<?= $settings['model'] ?>['id']) ?]">[?= $<?= $settings['model'] ?>['<?= $field ?>'] ?]</a>
					</th>
<? elseif (!in_array($field, $settings['exclude'])) : ?>
					<td>[?= $<?= $settings['model'] ?>['<?= $field ?>'] ?]</td>
<? endif ?>
<? endforeach ?>
					<td>
						<ul class="actions">
							<li><a class="sprite icon edit" title="Editer" href="[?= UrlComponent::path(array('action' => 'edit'), $<?= $settings['model'] ?>['id']) ?]">Editer</a></li>
							<li><a class="sprite icon delete" title="Supprimer" href="[?= UrlComponent::path(array('action' => 'delete'), $<?= $settings['model'] ?>['id']) ?]">Supprimer</a></li>
						</ul>
					</td>
				</tr>
				[? endforeach ?]

				[? if (!count($<?= $settings['collection'] ?>)) : ?]
				<tr class="empty [?= ++$i % 2 ? 'odd': 'even' ?]">
					<td colspan="100">Aucun<?= $settings['male'] ? '' : 'e' ?> <?= $settings['singular'] ?>.</td>
				</tr>
				[? endif ?]
			</tbody>
		</table>
		</form>
	</div><!-- #main -->
</div><!-- #content -->

<script type="text/javascript">
	// Coche / Décoche toutes les checkboxes
	$('table.list').delegate('input[type=checkbox]', 'click', function() {
		var $$ 		= $(this);
		var $table 	= $$.closest('table');
		
		if ($$.is('#checkall')) {
			$table.find('input[type=checkbox]')
				.attr('checked', $$.is(':checked'));
		}
		$table.find('tr')
			.removeClass('selected')
		.find('input[type=checkbox]:not(#checkall):checked')
			.closest('tr').addClass('selected');
	});
</script>