[? $this->set('ID',    "{#controller#}-page") ?]
[? $this->set('TITLE', "Liste des {#plural#}") ?]

<div id="content">
	<div id="main" class="{#collection#}">
		<h1>Liste des {#plural#}</h1>
			
		[?= $this->partial('flash') ?]

		<ul class="toolbar">
			<li><a class="sprite prefix add" href="[?= UrlComponent::path(array('action' => 'add')) ?]">Ajouter {#a#}</a></li>
		</ul>

		[? $i=0; ?]
		<form action="[?= UrlComponent::path(array('action' => 'batch')) ?]" method="post">
<? $fields = Doctrine::getTable($model)->getColumns(); ?>
		<table class="list">
			<colgroup>
				<col style="width:20px">
<? foreach($fields as $field => $options) : ?>
<? if (!in_array($field, $exclude)) : ?>
				<col>
<? endif ?>
<? endforeach ?>
				<col style="width:90px">
			</colgroup>
			<thead>
				<tr>
					<th scope="col"><input id="checkall" type="checkbox"></th>
<? foreach($fields as $field => $options) : ?>
<? if (!in_array($field, $exclude)) : ?>
					<th scope="col">[?= UrlHelper::orderBy('<?= $field ?>', "<?= cfirst(ThisGeneratorHelper::field($field, $mapping))?>") ?]</th>
<? endif ?>
<? endforeach ?>
					<th scope="col">&nbsp;</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="2" class="batch">
						<select name="action">
							<option value="">&#8212; Actions &#8212;</option>
							<option value="delete">Supprimer</option>
						</select>
						<input class="button" type="submit" value="Appliquer">
					</td>
					<td colspan="100">
						[?= $this->partial('pagination', array('Pager' => $Pager)); ?]
					</td>
				</tr>
			</tfoot>
			<tbody>
				[? foreach (${#Collection#} as ${#Model#}): ?]
				<tr class="[?= ++$i % 2 ? 'odd': 'even' ?]">
					<td class="checkboxes"><input type="checkbox" name="id[]" value="[?= ${#Model#}['id'] ?]"></td>
<? $r = 0; foreach($fields as $field => $options) : ?>
<? if (++$r == 2) : ?>
					<th scope="row">
						<a title="Voir le résumé" href="[?= UrlComponent::path(array('action' => 'show'), ${#Model#}['id']) ?]">[?= ${#Model#}['<?= $field ?>'] ?]</a>
					</th>
<? elseif (!in_array($field, $exclude)) : ?>
					<td>[?= ${#Model#}['<?= $field ?>'] ?]</td>
<? endif ?>
<? endforeach ?>
					<td>
						<ul class="actions">
							<li><a class="sprite icon edit" title="Editer" href="[?= UrlComponent::path(array('action' => 'edit'), ${#Model#}['id']) ?]">Editer</a></li>
							<li><a class="sprite icon delete" title="Supprimer" href="[?= UrlComponent::path(array('action' => 'delete'), ${#Model#}['id']) ?]">Supprimer</a></li>
						</ul>
					</td>
				</tr>
				[? endforeach ?]

				[? if (!count(${#Collection#})) : ?]
				<tr class="empty [?= ++$i % 2 ? 'odd': 'even' ?]">
					<td colspan="100">Aucun{#female#} {#singular#}.</td>
				</tr>
				[? endif ?]
			</tbody>
		</table>
		</form>
		
		<ul class="toolbar">
			<li><a class="sprite prefix add" href="[?= UrlComponent::path(array('action' => 'add')) ?]">Ajouter {#a#}</a></li>
		</ul>
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