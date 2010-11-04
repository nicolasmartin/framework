<? $this->set('ID',    	"library-page") ?>
<? $this->set('TITLE', 	"Liste des images") ?>

<div id="content">
	<div id="main" class="pictures">
		<h1>Liste des images</h1>
			
		<?= $this->partial("flash") ?>

		<ul class="toolbar">
			<li><a class="sprite left prefix add" href="<?= UrlHelper::path(array('action' => 'add')) ?>">Ajouter une image</a></li>
			<li><a class="sprite left prefix download" href="<?= UrlHelper::path(array('action' => 'bunch')) ?>">Ajouter des images</a></li>
		</ul>

		<? $i=0; ?>
		<form action="<?= UrlHelper::path(array('action' => 'batch')) ?>" method="post">
		<table class="list">
			<colgroup>
				<col style="width:20px">
				<col style="width:100px">
				<col>
				<col style="width:200px">
				<col style="width:90px">
			</colgroup>
			<thead>
				<tr>
					<th scope="col"><input id="checkall" type="checkbox"></th>
					<th scope="col"><?= UrlHelper::orderBy('name', "Image") ?></th>
					<th scope="col">&nbsp;</th>
					<th scope="col"><?= UrlHelper::orderBy('created_at', "Mise en ligne") ?></th>
					<th scope="col">&nbsp;</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="3" class="batch-actions">
						<select name="action">
							<option value="">&#8212; Actions &#8212;</option>
							<option value="delete">Supprimer</option>
						</select>
						<input class="button" type="submit" value="Appliquer">
					</td>
					<td colspan="100">
						<?= $this->partial('pagination', array('Pager', $Pager)); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
				<? foreach ($Pictures as $Picture): ?>
				<tr class="<?= ++$i % 2 ? 'odd': 'even' ?>">
					<td class="checkboxes"><input type="checkbox" name="id[]" value="<?= $Picture['id'] ?>"></td>
					<td>
						<a href="<?= UrlHelper::path(array('action' => 'show'), $Picture['id']) ?>"><?= ImageHelper::thumbnail($Picture['path'], 55) ?></a>
					</td>
					<td>
						<strong><a href="<?= UrlHelper::path(array('action' => 'show'), $Picture['id']) ?>"><?= $Picture['name'] ?></a></strong><br>
						<?= $Picture['width'] ?> x <?= $Picture['height'] ?> pixels<br>
						<?= ucfirst($Picture['type']) ?><br>
					</td>
					<td><?= DateHelper::format($Picture['created_at'], '{dd} {month} {yy} à {HH}:{MM}') ?></td>
					<td>
						<ul class="actions">
							<li><a class="sprite icon edit" title="Editer" href="<?= UrlHelper::path(array('action' => 'edit'), $Picture['id']) ?>">Editer</a></li>
							<li><a class="sprite icon delete" title="Supprimer" href="<?= UrlHelper::path(array('action' => 'delete'), $Picture['id']) ?>">Supprimer</a></li>
						</ul>
					</td>
				</tr>
				<? endforeach ?>

				<? if (!count($Pictures)) : ?>
				<tr class="empty <?= ++$i % 2 ? 'odd': 'even' ?>">
					<td colspan="100">Aucune image.</td>
				</tr>
				<? endif ?>
			</tbody>
		</table>
		</form>
	</div><!-- #main -->
</div><!-- #content -->

<script type="text/javascript">
	$('table.list').delegate('input[type=checkbox]', 'click', function() {
		var $$ 		= $(this);
		var $table 	= $$.closest('table');
		
		if ($$.is('#checkall')) {
			$table
			.find('input[type=checkbox]')
				.attr('checked', $$.is(':checked'));
		}
		$table
		.find('tr')
			.removeClass('selected')
		.find('input[type=checkbox]:not(#checkall):checked')
			.closest('tr').addClass('selected');
	});
</script>